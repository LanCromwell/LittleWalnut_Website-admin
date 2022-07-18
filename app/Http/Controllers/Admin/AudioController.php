<?php
/**
 * File AudioController.php
 */

namespace App\Http\Controllers\Admin;

use App\Audio;
use App\Category;
use App\FrontUser;
use App\Http\Controllers\Controller;
use App\Http\Resources\AudioUserResource;
use App\Http\Resources\FrontUserResource;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\UserResource;
use App\Laravue\Acl;
use App\Laravue\JsonResponse;
use App\Laravue\Models\Permission;
use App\Laravue\Models\Role;
use App\Laravue\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Validator;

/**
 * Class AudioController
 *
 * @package App\Http\Controllers
 */
class AudioController extends Controller
{
    const ITEM_PER_PAGE = 15;

    /**
     * Display a listing of the user resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|ResourceCollection
     */
    public function index(Request $request)
    {
        $searchParams = $request->all();
        $userQuery = Audio::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $id = Arr::get($searchParams, 'id', '');
        $title = Arr::get($searchParams, 'title', '');
        $languageId = Arr::get($searchParams, 'language_id', '');
        $type = Arr::get($searchParams, 'type', '');
        $categoryId = Arr::get($searchParams, 'category_id', '');

        if (!empty($id)) {
            $userQuery->where('id', '=', $id);
        }
        if (!empty($title)) {
            $userQuery->where('title', 'like', "%{$title}%");
        }
        if (!empty($type)) {
            if ($type == 1) {
                $type = 0;
            } else {
                $type = 1;
            }
            $userQuery->where('type', '=', $type);
        }
        if (!empty($languageId)) {
            $userQuery->where('language_id', '=', $languageId);
        }
        if (!empty($categoryId)) {
            $userQuery->where('category_id', '=', $categoryId);
        }
        $userQuery->orderBy('id', 'desc');

        return (AudioUserResource::collection($userQuery->paginate($limit)));
    }

    /**
     * @param $id
     * @return array
     */
    public function getAudioInfo($id)
    {
        $info = Audio::where(['id' => $id])->first();
        return ['data' => $info];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
        $audioId = $request->input('id');
        $title = $request->input('title');
        $categoryId = $request->input('category_id');
        $duration = $request->input('duration');
        $searchContent = $request->input('search_content');
        $audioPath = $request->input('audio_path');
        $type = $request->input('type');
        $remindDate = $request->input('remind_date');
        $languageId = $request->input('language_id');
        $sort = $request->input('sort');
        $description = $request->input('description');
        $imgPath = (string)$request->input('img');

        $insertData = [
            'title' => $title,
            'category_id' => $categoryId,
            'duration' => $duration,
            'audio_path' => $audioPath,
            'language_id' => $languageId,
            'type' => $type,
            'remind_date' => $remindDate,
            'search_content' => $searchContent,
            'sort' => $sort,
            'add_time' => time(),
            'description' => $description,
            'img' => $imgPath,

        ];
        if ($audioId) {
            Audio::where('id', '=', $audioId)->update($insertData);
        } else {
            if ($type == 0) {
                $info = Audio::where(['type' => 0, 'remind_date' => $remindDate, 'language_id' => $languageId])->first();
                if ($info) {
                    return ['code' => 1, 'msg' => '该天提醒已经上传'];
                }
            }
            $audioId = Audio::insertGetId($insertData);
        }
        if ($audioId) {
            return ['code' => 200, 'msg' => '操作成功'];
        }
        return ['code' => 500, 'msg' => '操作失败'];
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User    $user
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $user)
    {
        if ($user === null) {
            return response()->json(['error' => 'User not found'], 404);
        }
        if ($user->isAdmin()) {
            return response()->json(['error' => 'Admin can not be modified'], 403);
        }

        $validator = Validator::make($request->all(), $this->getValidationRules(false));
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            $email = $request->get('email');
            $found = User::where('email', $email)->first();
            if ($found && $found->id !== $user->id) {
                return response()->json(['error' => 'Email has been taken'], 403);
            }

            $user->name = $request->get('name');
            $user->email = $email;
            $user->save();
            return new UserResource($user);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User    $user
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function updatePermissions(Request $request, User $user)
    {
        if ($user === null) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if ($user->isAdmin()) {
            return response()->json(['error' => 'Admin can not be modified'], 403);
        }

        $permissionIds = $request->get('permissions', []);
        $rolePermissionIds = array_map(
            function($permission) {
                return $permission['id'];
            },

            $user->getPermissionsViaRoles()->toArray()
        );

        $newPermissionIds = array_diff($permissionIds, $rolePermissionIds);
        $permissions = Permission::allowed()->whereIn('id', $newPermissionIds)->get();
        $user->syncPermissions($permissions);
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            response()->json(['error' => 'Ehhh! Can not delete admin user'], 403);
        }

        try {
            $user->delete();
        } catch (\Exception $ex) {
            response()->json(['error' => $ex->getMessage()], 403);
        }

        return response()->json(null, 204);
    }

    /**
     * Get permissions from role
     *
     * @param User $user
     * @return array|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function permissions(User $user)
    {
        try {
            return new JsonResponse([
                'user' => PermissionResource::collection($user->getDirectPermissions()),
                'role' => PermissionResource::collection($user->getPermissionsViaRoles()),
            ]);
        } catch (\Exception $ex) {
            response()->json(['error' => $ex->getMessage()], 403);
        }
    }

    /**
     * @param bool $isNew
     * @return array
     */
    private function getValidationRules($isNew = true)
    {
        return [
            'name' => 'required',
            'email' => $isNew ? 'required|email|unique:users' : 'required|email',
            'roles' => [
                'required',
                'array'
            ],
        ];
    }
}

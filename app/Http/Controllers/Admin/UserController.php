<?php
/**
 * File UserController.php
 *
 * @author Tuan Duong <bacduong@gmail.com>
 * @package Laravue
 * @version 1.0
 */

namespace App\Http\Controllers\Admin;

use App\FrontUser;
use App\Http\Controllers\Controller;
use App\Http\Resources\FrontUserResource;
use App\Laravue\JsonResponse;
use App\ChannelInviteLog;
use App\UserInviteLog;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Validator;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
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
        $userQuery = FrontUser::where(['is_del' => 0]);
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $phone = Arr::get($searchParams, 'phone', '');
        $id = Arr::get($searchParams, 'id', '');
        $userId = Arr::get($searchParams, 'user_id', '');
        $channelCode = Arr::get($searchParams, 'invitation_code', '');

        if (!empty($phone)) {
            $userQuery->where('phone', 'LIKE', '%' . $phone . '%');
        }
        if (!empty($id)) {
            $userQuery->where('id', '=',  $id);
        }
        if (!empty($channelCode)) {
            $userList = ChannelInviteLog::where(['channel_code' => $channelCode])->get();
            $userList = (array_column($userList->toArray(), 'user_id'));
            $userQuery->whereIn('id', $userList);
        }
        if (!empty($userId)) {
            $userList = UserInviteLog::where(['invited_user_id' => $userId])->get();
            $userList = (array_column($userList->toArray(), 'be_invited_user_id'));
            $userQuery->whereIn('id', $userList);
        }
        $userQuery = $userQuery->orderBy('id', 'desc');
        return (FrontUserResource::collection($userQuery->paginate($limit)));
    }

    public function getUserInfo($id)
    {
        $info = FrontUser::where(['id' => $id])->first();
        return ['data' => $info];
    }

    public function update(Request $request)
    {
        $remainderDays = $request->input('remainder_days');
        $id = $request->input('id');
        $data = ['remainder_days' => $remainderDays];
        FrontUser::where('id', $id)->update($data);
        return ['code' => 200, 'msg' => 'success'];
    }

    public function updatePwd(Request $request)
    {
        $pwd = $request->input('password');
        $id = $request->input('id');
        $data = ['password' => bcrypt($pwd)];
        FrontUser::where('id', $id)->update($data);
        return ['code' => 200, 'msg' => 'success'];
    }


}

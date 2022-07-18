<?php
/**
 * File ChannelController.php
 */

namespace App\Http\Controllers\Admin;

use App\Audio;
use App\Category;
use App\Channel;
use App\DatePoster;
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
use App\Libs\CommonHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Validator;

/**
 * Class DatePosterController
 *
 * @package App\Http\Controllers
 */
class DatePosterController extends Controller
{
    const ITEM_PER_PAGE = 15;

    /**
     * Display a listing of the user resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function index(Request $request)
    {
        $searchParams = $request->all();
        $userQuery = DatePoster::query();
        $name = Arr::get($searchParams, 'date', '');

        if (!empty($name)) {
            $userQuery->where('date', $name);
        }
        $userQuery->where('is_del', 0);

        $data = $userQuery->get();

        return ['data' => $data];
    }

    public function getDatePosterInfo($id)
    {
        $info = DatePoster::where('id', $id)->first();
        return ['code' => 200, 'data' => $info];
    }


    public function store(Request $request)
    {
        $datePosterId = $request->input('id');
        $remark = trim($request->input('remark'));
        $path = trim($request->input('path'));
        $date = trim($request->input('date'));
        $datePosterModel = DatePoster::where('id', $datePosterId)->first();
        if ($datePosterModel) {
            $datePosterModel->remark = $remark;
            $datePosterModel->path = $path;
            $datePosterModel->date = $date;
            $datePosterModel->save();
            $id = $datePosterId;
        } else {
            $datePosterModel = DatePoster::where('date', $date)->first();

            if ($datePosterModel) {
                return ['code' => 2, 'msg' => '当日海报已经存在'];
            }

            $insertData = ['path' => $path, 'date' => $date, 'remark' => $remark];
            $info = DatePoster::create($insertData);
            $id = $info->id;
        }
        if ($id) {
            return ['code' => 200, 'msg' => 'success'];
        } else {
            return ['code' => 1, 'msg' => 'fail'];
        }
    }

}

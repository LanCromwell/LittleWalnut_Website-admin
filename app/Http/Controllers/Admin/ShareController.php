<?php
/**
 * File ShareController.php
 */

namespace App\Http\Controllers\Admin;

use App\Audio;
use App\Category;
use App\Channel;
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
use App\PushMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Validator;

/**
 * Class ShareController
 *
 * @package App\Http\Controllers
 */
class ShareController extends Controller
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
        $imgUrl = DB::table('sharing_management')->orderBy('add_time', 'DESC')->first();
        $imgUrl = (env('OSS_URL').($imgUrl->img_url));
        return ['data' => $imgUrl];
    }

    public function edit(Request $request)
    {
        $adminUserId = $request->user()->id;
        $path = $request->input('img');
        $path = str_replace('https://mamaucan.oss-cn-beijing.aliyuncs.com/', '', $path);
        $insertData = [
            'admin_user_id' => $adminUserId,
            'img_url' => $path,
            'add_time' => time(),
        ];
        $id = $this->_create($insertData);
        if ($id) {
            return ['code' => 200, 'msg' => 'success'];
        }
        return ['code' => 500, 'msg' => 'fail'];
    }

    private function _create($data)
    {
        $id = DB::table('sharing_management')->insertGetId($data);
        return $id;
    }

}

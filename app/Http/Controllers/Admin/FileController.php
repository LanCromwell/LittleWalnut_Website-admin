<?php
/**
 * File FileController.php
 */

namespace App\Http\Controllers\Admin;

use App\FrontUser;
use App\Http\Controllers\Controller;
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
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Validator;

/**
 * Class FileController
 *
 * @package App\Http\Controllers
 */
class FileController extends Controller
{
    public function upload(Request $request)
    {
        $type1 = $request->input('type', '');

        $file = $request->file('file');
        if ($file->isValid()) {
            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $type = $file->getClientMimeType();     // image/jpeg
            if ($ext === 'mp3') {
                $filename = 'audio_info/' . date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
            } elseif ($type1 === 'date_poster') {
                $filename = 'date_poster/' . date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
            } else {
                $filename = 'category_icon/' . date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
            }
            //这里的uploads是配置文件的名称
            $bool = Storage::put($filename, file_get_contents($realPath));
            return env('OSS_URL').$filename;
        }


    }
}

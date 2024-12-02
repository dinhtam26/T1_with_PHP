<?php

namespace App\Controllers\Admin;

use App\Models\PermissionModel;
use App\Models\PermissionUserCatalogueModel;
use App\Models\UserCatalogueModel;
use Libs\Controller;
use Libs\Helper;
use Libs\Session;
use Libs\Validate;

class UserCatalogueController extends Controller
{

    private $userCatalogueModel;
    private $permissionUserCatalogueModel;
    public function __construct()
    {
        $this->loadFileTemplate($this, "Admin/layout", 'master');
        $this->userCatalogueModel = $this->model("userCatalogue");
        $this->permissionUserCatalogueModel = $this->model("permissionUserCatalogue");
        $this->request = array_merge($_POST, $_GET, $_FILES);
    }

    public function index()
    {
        $tableJoin      = "users";
        $relationship   = "user_catalogues.id  = $tableJoin.user_catalogue_id ";
        $select         = "user_catalogues.*, COUNT($tableJoin.id) AS quantity";

        $listUserCatalogue = $this->userCatalogueModel->table('user_catalogues')
            ->select($select)
            ->leftJoin($tableJoin, $relationship)
            ->groupBy("id")
            ->get();
        return $this->view("Admin/UserManagement/UserCatalogue/index", ['listUserCatalogue' => $listUserCatalogue]);
    }

    public function create()
    {
        $this->view("Admin/UserManagement/UserCatalogue/create");
    }

    public function store()
    {
        $rules = [
            'name'  => 'required|string|min:2|max:55',
            'description' => 'string|max:55',
        ];

        $validator = new Validate($this->request, $rules);
        if ($validator->validate() !== true) {
            $validator->getErrors();
            $this->view('Admin/UserManagement/UserCatalogue/create', ['data' =>  $validator->getResults()]);
            return;
        }

        $dataCreate = [];
        $dataCreate['name']         = $this->request['name'];
        $dataCreate['code']         = strtolower($this->request['name']);
        $dataCreate['publish']      = $this->request['publish'] ?? 0;
        $dataCreate['description']  = $this->request['description'];
        $dataCreate['created_at']           = Helper::dateTime();
        $dataCreate['updated_at']           = Helper::dateTime();
        UserCatalogueModel::create($dataCreate);
        Session::setSession('success', 'Created User Successfully');
        Helper::redirect('admin/userCatalogue');
    }

    public function edit($id)
    {
        $userCatalogue = UserCatalogueModel::find($id);
        $this->view("Admin/UserManagement/UserCatalogue/update", ['userCatalogue' => $userCatalogue]);
    }

    public function update($id)
    {
        $userCatalogue = UserCatalogueModel::find($id);
        $rules = [
            'name'  => 'required|string|min:2|max:55',
            'description' => 'string|max:55',
        ];

        $validator = new Validate($this->request, $rules);
        if ($validator->validate() !== true) {
            $validator->getErrors();
            $this->view('Admin/UserManagement/UserCatalogue/update', ['userCatalogue' => $userCatalogue]);
            return;
        }
        $userCatalogue['name'] = $this->request['name'];
        $userCatalogue['code']         = strtolower($this->request['name']);
        $userCatalogue['description'] = $this->request['description'];
        $userCatalogue['publish']            = $this->request['publish'] ?? 0;
        $userCatalogue['updated_at']           = Helper::dateTime();
        UserCatalogueModel::update($userCatalogue, $id);
        Session::setSession('success', 'Update User Catalogue Successfully');
        Helper::redirect('admin/userCatalogue/' . $id . '/edit');
    }

    public function delete($id)
    {
        try {
            $user = UserCatalogueModel::find($id);
            if (!$user) {
                echo json_encode(['status' => 'error', 'message' => 'User not found'], 404);
            }
            UserCatalogueModel::delete($id);
            echo json_encode(['status' => 'success', 'message' => 'Deleted Successfully', 'id' => $id]);
        } catch (\Throwable $e) {
            echo json_encode(['status' => 'error', 'message' => 'Something Wrong']);
        }
    }


    public function changeStatus($id)
    {
        try {
            $userCatalogue = UserCatalogueModel::find($id, ['id', 'name', 'publish']);
            $publish = ($userCatalogue['publish'] == 1) ? 0 : 1;
            $dataUpdate['publish'] = $publish;
            $dataUpdate['updated_at']           = Helper::dateTime();
            UserCatalogueModel::update($dataUpdate, $id);
            echo json_encode(['status' => 'success', 'message' => 'Update Publish Successfully']);
        } catch (\Throwable $e) {
            echo json_encode(['status' => 'error', 'message' => 'Something Wrong']);
        }
    }



    /** Chức năng phân quyền trong user_catalogue*/
    public function userCataloguePermission()
    {


        $this->setJs("admin/assets", "/customer/user_catalogue/permission");
        $listPermission             = PermissionModel::all();
        $listUserCatalogue          = $this->userCatalogueModel->table('user_catalogues')->select("*")->where('publish', '=', 1)->get();
        $permissionUserCatalogues   = PermissionUserCatalogueModel::all();
        $this->view("Admin/UserManagement/UserCatalogue/permission", ['listPermission' => $listPermission, 'listUserCatalogue' =>  $listUserCatalogue, 'permissionUserCatalogues' => $permissionUserCatalogues]);
    }

    public function userCatalogueStorePermission()
    {
        // Validate

        // Thêm
        $permission     = $this->request['permission'];
        $userCatalogue  = $this->request['userCatalogue'];

        $checkExits = $this->checkPermissionAndUserCatalogue($permission, $userCatalogue);
        try {

            $dataCreate['permission_id']        = $permission;
            $dataCreate['user_catalogue_id']    = $userCatalogue;
            if ($checkExits === false) {
                PermissionUserCatalogueModel::create($dataCreate);
            }

            echo json_encode(['status' => 'success', 'message' => 'Permission Successfully']);
        } catch (\Throwable $th) {
            echo json_encode(['status' => 'error', 'message' => 'Something Wrong']);
        }
    }

    private function checkPermissionAndUserCatalogue($permission, $userCatalogue)
    {
        $data = $this->permissionUserCatalogueModel
            ->table('permission_user_catalogue')
            ->select('*')
            ->where('user_catalogue_id', '=', $userCatalogue)
            ->where('permission_id', '=', $permission)->getOne();


        if (!empty($data)) {
            return true;
        }

        return false;
    }

    public function userCatalogueDeletePermission()
    {
        $permission     = $this->request['permission'];
        $userCatalogue  = $this->request['userCatalogue'];
        try {
            $dataDelete['permission_id']     = $permission;
            $dataDelete['user_catalogue_id'] = $userCatalogue;
            PermissionUserCatalogueModel::deleteMultiWhere($dataDelete);
            echo json_encode(['status' => 'success', 'message' => 'Permission Successfully']);
        } catch (\Throwable $th) {
            echo json_encode(['status' => 'error', 'message' => 'Something Wrong']);
        }
    }
}

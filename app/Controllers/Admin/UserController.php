<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use Libs\Controller;
use Libs\Helper;
use Libs\Session;
use Libs\Upload;
use Libs\Validate;

class UserController extends Controller
{
    private $userModel;
    private $userCatalogueModel;
    public function __construct()
    {
        parent::loadFileTemplate($this, "Admin/layout", "master");
        $this->userModel = $this->model('user');
        $this->userCatalogueModel = $this->model('userCatalogue');
        $this->request = array_merge($_POST, $_GET, $_FILES);
    }

    public function index()
    {
        $listUser = $this->userModel->userWithUserCatalogue();
        return $this->view("Admin/UserManagement/User/index", ['listUser' => $listUser]);
    }

    public function create()
    {
        $userCatalogues = $this->getUserCatalogue();
        return $this->view("Admin/UserManagement/User/create", ['userCatalogues' => $userCatalogues]);
    }

    public function store()
    {
        $rules = [
            'fullname'  => 'required|string|min:2|max:55',
            'email'     => 'required|email|unique:users',
            'avatar'    => 'image|max:3000',
            'password'  => 'required',
            'phone'     => 'phone',
        ];


        $validator = new Validate($this->request, $rules);
        if ($validator->validate() !== true) {
            $validator->getErrors();
            $this->view('Admin/UserManagement/User/create', ['data' =>  $validator->getResults(), 'userCatalogues' => $this->getUserCatalogue()]);
            return;
        }

        $dataCreate = [];
        $dataCreate['fullname']             = $this->request['fullname'];
        $dataCreate['user_catalogue_id']    = $this->request['user_catalogue_id'];
        $dataCreate['email']                = $this->request['email'];
        $dataCreate['password']             = $this->request['password'];
        $dataCreate['publish']              = $this->request['publish'] ?? 0;
        $dataCreate['phone']                = $this->request['phone'];
        $dataCreate['avatar']               = Upload::uploadFile($this->request['avatar'], "user", 75, 75);
        $dataCreate['created_at']           = Helper::dateTime();
        $dataCreate['updated_at']           = Helper::dateTime();

        // dd($dataCreate);
        UserModel::create($dataCreate);
        Session::setSession('success', 'Created User Successfully');
        Helper::redirect('admin/user');
    }

    public function edit($id)
    {
        $user = UserModel::find($id);
        return $this->view("Admin/UserManagement/User/update", ['user' => $user, 'userCatalogues' => $this->getUserCatalogue()]);
    }

    public function update($id)
    {

        $user = UserModel::find($id);
        $rules = [
            'fullname'  => 'required|string|min:2|max:55',
            'email'     => "required|email|unique:users:$id",
            'avatar'    => 'image|max:3000',
            'password'  => 'required',
            'phone'     => 'phone',
        ];


        $validator = new Validate($this->request, $rules);
        if ($validator->validate() !== true) {
            $validator->getErrors();
            $this->view('Admin/UserManagement/User/update', ['userCatalogues' => $this->getUserCatalogue(), 'user' => $user]);
            return;
        }

        $user['fullname']           = $this->request['fullname'];
        $user['email']              = $this->request['email'];
        $user['user_catalogue_id']  = $this->request['user_catalogue_id'];
        $user['password']           = $this->request['password'];
        $user['phone']              = $this->request['phone'];
        $user['publish']            = $this->request['publish'] ?? 0;
        if (is_array($this->request['avatar'])) {
            $oldAvatar = $user['avatar'];
            $user['avatar']             = Upload::uploadFile($this->request['avatar'], "user");
            Upload::deleteFileUpload("user", $oldAvatar);
        }
        $user['updated_at']           = Helper::dateTime();
        UserModel::update($user, $id);
        Session::setSession('success', 'Update Category Successfully');
        Helper::redirect('admin/user/' . $id . '/edit');
    }

    public function deleted($id)
    {
        try {
            $user = UserModel::find($id);
            if (!$user) {
                echo json_encode(['status' => 'error', 'message' => 'User not found'], 404);
            }
            UserModel::delete($id);

            if ($user['avatar']) {
                Upload::deleteFileUpload("user", $user['avatar']);
            }
            echo json_encode(['status' => 'success', 'message' => 'Deleted Successfully', 'id' => $id]);
        } catch (\Throwable $e) {
            echo json_encode(['status' => 'error', 'message' => 'Something Wrong']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $user = UserModel::find($id, ['id', 'fullname', 'email', 'publish']);
            $publish = ($user['publish'] == 1) ? 0 : 1;
            $dataUpdate['publish'] = $publish;
            $dataUpdate['updated_at']           = Helper::dateTime();

            UserModel::update($dataUpdate, $id);
            echo json_encode(['status' => 'success', 'message' => 'Update Publish Successfully']);
        } catch (\Throwable $e) {
            echo json_encode(['status' => 'error', 'message' => 'Something Wrong']);
        }
    }

    private function getUserCatalogue()
    {
        $userCatalogue = $this->userCatalogueModel->table('user_catalogues')->select(['id', 'name', 'code'])->where('publish', '=', '1')->get();
        return $userCatalogue;
    }
}

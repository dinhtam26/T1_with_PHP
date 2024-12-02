<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use Libs\Controller;
use Libs\Helper;
use Libs\Session;
use Libs\Upload;
use Libs\Validate;

class ProfileController extends Controller
{
    private $userModel;
    public function __construct()
    {
        $this->loadFileTemplate($this, "Admin/layout", 'master');
        $this->request = array_merge($_POST, $_GET, $_FILES);
        $this->userModel = $this->model('user');
    }

    public function index()
    {
        $user = Session::getSession('auth');
        $id = $user['id'];
        $user = UserModel::find($id);
        $this->setJs("admin/assets", "/page/components-multiple-upload");
        return $this->view("Admin/Profile/index", ['user' => $user]);
    }

    public function update()
    {
        $auth = Session::getSession('auth');
        $id = $auth['id'];
        $user = UserModel::find($id);

        $rules = [
            'fullname'  => 'required|string|min:2|max:55',
            'email'     => "required|email|unique:users:$id",
            'avatar'    => 'image|max:3000',
            'phone'     => 'phone'
        ];

        $validator = new Validate($this->request, $rules);
        if ($validator->validate() !== true) {
            $validator->getErrors();
            $this->view('Admin/Profile/index', ['user' => $user]);
            return;
        }


        $user['email']    = $this->request['email'];
        $user['fullname'] = $this->request['fullname'];
        $user['phone']    = $this->request['phone'];


        if (!empty($this->request['avatar']['name'])) {
            $oldAvatar = $user['avatar'];
            $user['avatar'] = Upload::uploadFile($this->request['avatar'], "user");
            Upload::deleteFileUpload("user", $oldAvatar);
        }

        $user['updated_at']           = Helper::dateTime();
        UserModel::update($user, $id);
        Session::setSession('success', 'Update Profile Successfully');
        Helper::redirect('admin/profile');
    }

    public function changePassword()
    {
        $auth = Session::getSession('auth');
        $id = $auth['id'];
        $user = UserModel::find($id);

        $rules = [
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',

        ];
        $validator = new Validate($this->request, $rules);
        if ($validator->validate() !== true) {
            $validator->getErrors();
            Helper::redirect('admin/profile');
            return;
        }


        $currentPassword    = $this->request['current_password'];
        $newPassword        = $this->request['new_password'];
        $confirmPassword    = $this->request['confirm_password'];

        $issetPassword =  $this->checkCurrentPassword($currentPassword);

        if (empty($issetPassword)) {
            Session::setSession('errors', ['Current Password not true']);
            Helper::redirect('admin/profile');
            return;
        }

        if ($newPassword !== $confirmPassword) {
            Session::setSession('errors', ['Something went wrong']);
            Helper::redirect('admin/profile');
            return;
        }

        $user['password'] = $this->request['new_password'];
        UserModel::update($user, $id);
        Session::setSession('success', 'Change Password Successfully');
        Helper::redirect('admin/profile');
    }

    private function checkCurrentPassword($currentPassword)
    {
        $auth = Session::getSession('auth');
        $id = $auth['id'];
        return $this->userModel->table('users')->select('id')->where('password', '=', $currentPassword)->where('id', '=', $id)->getOne();
    }
}

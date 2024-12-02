<?php

namespace App\Controllers\Auth;

use App\Models\UserModel;
use Libs\Controller;
use Libs\Helper;
use Libs\Session;
use Libs\Validate;

class AuthenticatedSessionController extends Controller
{
    public const ADMIN = "admin";
    const HOME  = "";
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('user');
        $this->request = array_merge($_POST, $_GET);
    }

    // Hiển thị giao diện login
    public function create()
    {
        if (Session::getSession('auth')) {
            Helper::redirect('admin');
        }
        $this->view("Auth/login", [null], false);
    }

    // Login
    public function store()
    {
        // Get data

        $email      = $this->request['email'];
        $password   = $this->request['password'];

        // Validate
        $rules = [
            'email'     => 'required|email',
            'password'  => 'required',
        ];

        $validator = new Validate($this->request, $rules);
        if ($validator->validate() !== true) {
            $validator->getErrors();
            $this->view("Auth/login", ['data' =>  $validator->getResults()], false);
            return;
        }


        // Check login
        $checkLogin = $this->userModel->table('users')->select('id')->where('email', '=', $email)->where('password', '=', $password)->getOne();
        if (empty($checkLogin)) {
            Session::setSession('errors', ['Email or Password not true']);
            $this->view("Auth/login", [], false);
            return;
        }

        // Login
        $userInfo = $this->userModel->getUserInfo($this->request['email'], $this->request['password']);
        Session::setSession('auth', $userInfo);

        if ($userInfo['user_catalogue']['code'] == "admin") {
            return  Helper::redirect("admin");
        }
        return Helper::redirect("");
    }

    public function register()
    {
        return $this->view("Auth/register", [null], false);
    }

    public function storeRegister()
    {
        // Get data
        $fullname           = $this->request['fullname'];
        $email              = $this->request['email'];
        $password           = $this->request['password'];
        $passwordConfirm    = $this->request['password-confirm'];

        // Validate
        $rules = [
            'fullname'  => 'required|string|min:2|max:60',
            'email'     => 'required|email|max:50|unique:users',
            'password'  => 'required',
            'password-confirm' => 'required',
        ];
        $validator = new Validate($this->request, $rules);
        if ($validator->validate() !== true) {
            $validator->getErrors();
            $this->view('Auth/register', ['data' => $validator->getResults()], false);
            return;
        }

        // prepare password and confirm password
        if ($password !== $passwordConfirm) {
            Session::setSession('errors', ['Passwords do not match']);
            $this->view('Auth/register', ['data' => $validator->getResults()], false);

            return;
        }
        // register
        $dataRegister['fullname'] = $fullname;
        $dataRegister['email'] = $email;
        $dataRegister['password'] = $fullname;
        $dataRegister['user_catalogue_id'] = 2;
        $dataRegister['publish'] = 1;
        $dataRegister['created_at']           = Helper::dateTime();
        $dataRegister['updated_at']           = Helper::dateTime();

        UserModel::create($dataRegister);
        Session::setSession('success', 'Register Successfully');



        Helper::redirect('login');
    }



    // Logout
    public function logout()
    {
        Session::destroy();
        Helper::redirect("");
    }
}

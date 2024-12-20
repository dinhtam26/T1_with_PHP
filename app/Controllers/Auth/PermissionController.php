<?php

namespace App\Controllers\Auth;

use Libs\Controller;
use Libs\Session;

class PermissionController extends Controller
{
    private $userModel;
    private $userCatalogueModel;
    private $permissionUserCatalogueModel;

    public function __construct()
    {
        $this->userModel = $this->model("user");
        $this->userCatalogueModel = $this->model("userCatalogue");
        $this->permissionUserCatalogueModel = $this->model("permissionUserCatalogue");
    }

    public function getPermissionUserCatalogue()
    {
        if (isset($_SESSION['auth'])) {
            $auth = Session::getSession('auth');
            $user_catalogue_id = $auth['user_catalogue_id'];
        }

        $listPermission = $this->permissionUserCatalogueModel->table("permission_user_catalogue")->select('permission_id')->where('user_catalogue_id', '=', 1)->get();
        // dd($listPermission);
    }
}

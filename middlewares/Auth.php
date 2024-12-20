<?php

namespace Middlewares;

use App\Models\PermissionUserCatalogueModel;
use Libs\Helper;
use Libs\Session;

class Auth
{
    private $permissionUserCatalogueModel;
    public function handle()
    {
        if (!isset($_SESSION['auth'])) {
            Helper::redirect('admin/login');
        } else {
            if (isset($_SESSION['auth'])) {
                $auth = Session::getSession('auth');
                $user_catalogue_id = $auth['user_catalogue_id'];
            }
            $tableJoin      = "permissions";
            $select         = "*";
            $relationship   = "permission_user_catalogue.permission_id  = $tableJoin.id ";
            $test = "/magento-ecommerce/admin/userCatalogue";
            // if ($_SERVER['REQUEST_URI'] == $test) {
            //     return;
            // }


            $this->permissionUserCatalogueModel = new PermissionUserCatalogueModel();
            // $listPermissionCatalogues = $this->permissionUserCatalogueModel->table("permission_user_catalogue")->select('*')->rightJoin($tableJoin, $relationship)->where('user_catalogue_id', '=', $user_catalogue_id)->get();
        }
    }
}

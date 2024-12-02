<?php

namespace App\Controllers\Admin;

use App\Models\CategoryModel;
use Libs\Controller;
use Libs\Helper;
use Libs\Session;
use Libs\Validate;

class DashboardController extends Controller
{

    private $categoryModel;
    public $request;

    public function __construct()
    {
        parent::loadFileTemplate($this, "Admin/layout", "master");
        $this->categoryModel = $this->model('category');
        $this->request = array_merge($_POST, $_GET, $_FILES);
    }

    public function index()
    {

        $this->setJs("admin/assets", "customer/user/index");
        return $this->view("Admin/Dashboard/index");
    }
}

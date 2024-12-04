<?php

namespace App\Controllers\Admin;

use Libs\Controller;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->loadFileTemplate($this, "Admin/layout", "master");
        $this->request = array_merge($_POST, $_GET, $_FILES);
    }

    public function index()
    {
        $this->view("Admin/ProductManagement/Product/index");
    }

    public function create()
    {
        $this->view("Admin/ProductManagement/Product/create");
    }
}

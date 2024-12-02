<?php

namespace App\Controllers\Admin;

use App\Models\PermissionModel;
use Libs\Controller;
use Libs\Helper;
use Libs\Session;
use Libs\Validate;

class PermissionController extends Controller
{

    private $permissionModel;
    public function __construct()
    {
        $this->loadFileTemplate($this, "Admin/layout", 'master');
        $this->permissionModel = $this->model("permission");
        $this->request = array_merge($_POST, $_GET, $_FILES);
    }

    public function index()
    {
        $permissions = PermissionModel::all();
        return $this->view("Admin/Permission/index", ['permissions' => $permissions]);
    }

    public function create()
    {
        return $this->view("Admin/Permission/create");
    }

    public function store()
    {
        if (!empty($this->request['create_fast'])) {
            $rules = [
                'create_fast' => 'required',
            ];
        } else {
            $rules = [
                'name'      => 'required|string|max:50',
                'module'    => 'required|string|max:50',
                'controller' => 'required|string|max:50',
                'action'    => 'required|string|max:50',
            ];
        }

        $validator = new Validate($this->request, $rules);
        if ($validator->validate() !== true) {
            $validator->getErrors();
            $this->view("Admin/Permission/create", ['data' =>  $validator->getResults()]);
            return;
        }
        $dataCreate['name'] = $this->request['name'];
        $dataCreate['module'] = $this->request['module'];
        $dataCreate['controller'] = $this->request['controller'];
        $dataCreate['action'] = $this->request['action'];
        $dataCreate['created_at']           = Helper::dateTime();
        $dataCreate['updated_at']           = Helper::dateTime();

        PermissionModel::create($dataCreate);
        Session::setSession('success', 'Created Permission Successfully');
        Helper::redirect('admin/permission');
    }

    public function edit($id) {}

    public function update($id) {}

    public function delete($id) {}
}

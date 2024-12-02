<?php

namespace App\Controllers\Admin;

use App\Models\BrandModel;
use Libs\Controller;
use Libs\Helper;
use Libs\Session;
use Libs\Upload;
use Libs\Validate;

class BrandController extends Controller
{
    protected $brandModel;
    public function __construct()
    {
        $this->loadFileTemplate($this, "Admin/layout", 'master');
        $this->brandModel = $this->model("brand");
        $this->request = array_merge($_POST, $_GET, $_FILES);
    }

    public function index()
    {
        $listBrands = $this->brandModel->table('brands')->select('*')->get();
        $this->setJs("admin/assets",  "/customer/brand/index");

        $this->view("Admin/Brand/index", ['listBrands' => $listBrands]);
    }

    public function create()
    {

        $this->view("Admin/Brand/create");
    }

    public function store()
    {
        $rules = [
            'name'          => 'required|string|min:2|max:255',
            'description'   => 'string',
            'image'         => 'image',
        ];
        // dd($this->request);

        $validator = new Validate($this->request, $rules);
        if ($validator->validate() !== true) {
            $validator->getErrors();
            $this->view("Admin/brand/create", ['data' =>  $validator->getResults()]);
            return;
        }
        $dataCreate = [];
        $dataCreate['name']        = $this->request['name'];
        $dataCreate['canonical']   = Helper::canonical($this->request['name']);
        $dataCreate['description'] = $this->request['description'];
        $dataCreate['publish']     = $this->request['publish'] ?? 0;
        $dataCreate['is_feature']  = $this->request['is_feature'] ?? 0;
        $dataCreate['image']       = Upload::uploadFile($this->request['image'], "brands");
        $dataCreate['created_at']  = Helper::dateTime();
        $dataCreate['updated_at']  = Helper::dateTime();


        BrandModel::create($dataCreate);
        Session::setSession('success', 'Created Brand Successfully');
        Helper::redirect('admin/brand');
    }

    public function edit($id)
    {
        $data = BrandModel::find($id);
        $this->view("Admin/Brand/update", ['data' => $data]);
    }

    public function update($id)
    {
        $brand = BrandModel::find($id);
        $rules = [
            'name'          => 'required|string|min:2|max:255',
            'description'   => 'string',
            'image'         => 'image',
        ];

        $validator = new Validate($this->request, $rules);
        if ($validator->validate() !== true) {
            $validator->getErrors();
            $this->view("Admin/brand/update", ['data' => $brand]);
            return;
        }

        $brand['name']        = $this->request['name'];
        $brand['canonical']   = Helper::canonical($this->request['name']);
        $brand['description'] = $this->request['description'];
        $brand['publish']     = $this->request['publish'] ?? 0;
        $brand['is_feature']  = $this->request['is_feature'] ?? 0;
        if (!empty($this->request['image']['name'])) {
            $oldImage = $brand['image'];
            $brand['image']    = Upload::uploadFile($this->request['image'], "brands");
            Upload::deleteFileUpload("brands", $oldImage);
        }
        $brand['updated_at']  = Helper::dateTime();
        BrandModel::update($brand, $id);
        Session::setSession('success', 'Update Brand Successfully');
        Helper::redirect('admin/brand/' . $id . '/edit');
    }

    public function delete($id)
    {
        try {
            $brand = BrandModel::find($id);
            if (!$brand) {
                echo json_encode(['status' => 'error', 'message' => 'Brand not found'], 404);
            }
            BrandModel::delete($id);

            if ($brand['image']) {
                Upload::deleteFileUpload("brand", $brand['image']);
            }
            echo json_encode(['status' => 'success', 'message' => 'Deleted Successfully', 'id' => $id]);
        } catch (\Throwable $e) {
            echo json_encode(['status' => 'error', 'message' => 'Something Wrong']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $brand = BrandModel::find($id, ['id', 'name', 'publish', 'is_feature']);
            $publish    = ($brand['publish'] == 1) ? 0 : 1;

            $dataUpdate['publish']      = $publish;
            $dataUpdate['updated_at']           = Helper::dateTime();

            BrandModel::update($dataUpdate, $id);
            echo json_encode(['status' => 'success', 'message' => 'Update Successfully']);
        } catch (\Throwable $e) {
            echo json_encode(['status' => 'error', 'message' => 'Something Wrong']);
        }
    }

    public function changeStatusIsFeature($id)
    {
        try {
            $brand = BrandModel::find($id, ['id', 'name', 'publish', 'is_feature']);
            $is_feature = ($brand['is_feature'] == 1) ? 0 : 1;

            $dataUpdate['is_feature']   = $is_feature;
            $dataUpdate['updated_at']           = Helper::dateTime();

            BrandModel::update($dataUpdate, $id);
            echo json_encode(['status' => 'success', 'message' => 'Update Successfully']);
        } catch (\Throwable $e) {
            echo json_encode(['status' => 'error', 'message' => 'Something Wrong']);
        }
    }
}

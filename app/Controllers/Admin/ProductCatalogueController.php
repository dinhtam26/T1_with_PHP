<?php

namespace App\Controllers\Admin;

use App\Models\ProductCatalogueModel;
use Libs\Controller;
use Libs\Helper;
use Libs\Session;
use Libs\Upload;
use Libs\Validate;

class ProductCatalogueController extends Controller
{
    protected $productCatalogueModel;

    public function __construct()
    {
        $this->loadFileTemplate($this, "Admin/layout", "master");
        $this->productCatalogueModel = $this->model("productCatalogue");
        $this->request = array_merge($_POST, $_GET, $_FILES);
    }

    public function index()
    {
        $listProductCatalogue = ProductCatalogueModel::all();
        return $this->view("Admin/ProductManagement/Catalogue/index", ['listProductCatalogue' => $listProductCatalogue]);
    }

    public function create()
    {
        $parentCatalogue = $this->getParentCatalogue();
        $this->view("Admin/ProductManagement/Catalogue/create", ['parentCatalogue' => $parentCatalogue]);
    }

    public function store()
    {
        $rules = [
            'name'          => 'required|string|min:2|max:255',
            'order'         => 'integer',
            'image'         => 'image',
            'description'   => 'string',
        ];

        $validator = new Validate($this->request, $rules);
        if ($validator->validate() !== true) {
            $validator->getErrors();
            $this->view("Admin/ProductManagement/Catalogue/create", ['data' =>  $validator->getResults()]);
            return;
        }
        $dataCreate['name']         = $this->request['name'];
        $dataCreate['canonical']    = Helper::canonical($this->request['name']);
        $dataCreate['description']  = trim($this->request['description']);
        $dataCreate['order']        = $this->request['order'];
        $dataCreate['parent_id']    = ($this->request['parent_id'] === "" ? "NULL" : $this->request['parent_id']);
        $dataCreate['publish']      = $this->request['publish'] ?? 0;
        $dataCreate['is_feature']   = $this->request['is_feature'] ?? 0;
        $dataCreate['image']        = Upload::uploadFile($this->request['image'], "productCatalogue");
        $dataCreate['created_at']   = Helper::dateTime();
        $dataCreate['updated_at']   = Helper::dateTime();
        ProductCatalogueModel::create($dataCreate);
        Session::setSession("success", "Created Product Catalogue Successfully");
        Helper::redirect("admin/productCatalogue");
    }

    public function edit($id)
    {
        $productCatalogue = ProductCatalogueModel::find($id);
        $parentCatalogue = $this->getParentCatalogue();

        $this->view("Admin/ProductManagement/Catalogue/update", ['productCatalogue' => $productCatalogue, 'parentCatalogue' => $parentCatalogue]);
    }

    public function update($id)
    {
        $productCatalogue = ProductCatalogueModel::find($id);

        $rules = [
            'name'          => 'required|string|min:2|max:255',
            'order'         => 'integer',
            'image'         => 'image',
            'description'   => 'string',
        ];

        $validator = new Validate($this->request, $rules);
        if ($validator->validate() !== true) {
            $validator->getErrors();
            $this->view("Admin/ProductManagement/Catalogue/update", ['productCatalogue' => $productCatalogue, 'parentCatalogue' => $this->getParentCatalogue()]);
            return;
        }

        $productCatalogue['name']         = $this->request['name'];
        $productCatalogue['canonical']    = Helper::canonical($this->request['name']);
        $productCatalogue['description']  = trim($this->request['description']);
        $productCatalogue['order']        = $this->request['order'];
        $productCatalogue['parent_id']    = ($this->request['parent_id'] === "" ? "NULL" : $this->request['parent_id']);
        $productCatalogue['publish']      = $this->request['publish'] ?? 0;
        $productCatalogue['is_feature']   = $this->request['is_feature'] ?? 0;


        if (!empty($this->request['image']['name'])) {
            $oldImage = $productCatalogue['image'];
            $productCatalogue['image']        = Upload::uploadFile($this->request['image'], "productCatalogue");
            Upload::deleteFileUpload("productCatalogue", $oldImage);
        }
        $productCatalogue['updated_at']   = Helper::dateTime();
        ProductCatalogueModel::update($productCatalogue, $id);
        Session::setSession("success", "Updated Product Catalogue Successfully");
        Helper::redirect("admin/productCatalogue/$id/edit");
    }

    public function delete($id)
    {
        try {
            $productCatalogue = ProductCatalogueModel::find($id);
            if (!$productCatalogue) {
                echo json_encode(['status' => 'error', 'message' => 'Product Catalogue not found'], 404);
            }
            ProductCatalogueModel::delete($id);

            if ($productCatalogue['image']) {
                Upload::deleteFileUpload("productCatalogue", $productCatalogue['image']);
            }
            echo json_encode(['status' => 'success', 'message' => 'Deleted Successfully', 'id' => $id]);
        } catch (\Throwable $e) {
            echo json_encode(['status' => 'error', 'message' => 'Something Wrong']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $productCatalogue = ProductCatalogueModel::find($id, ['id', 'name', 'publish', 'is_feature']);
            $publish    = ($productCatalogue['publish'] == 1) ? 0 : 1;

            $dataUpdate['publish']      = $publish;
            $dataUpdate['updated_at']           = Helper::dateTime();

            ProductCatalogueModel::update($dataUpdate, $id);
            echo json_encode(['status' => 'success', 'message' => 'Update Successfully']);
        } catch (\Throwable $e) {
            echo json_encode(['status' => 'error', 'message' => 'Something Wrong']);
        }
    }

    public function changeStatusIsFeature($id)
    {
        try {
            $productCatalogue = ProductCatalogueModel::find($id, ['id', 'name', 'publish', 'is_feature']);
            $is_feature = ($productCatalogue['is_feature'] == 1) ? 0 : 1;

            $dataUpdate['is_feature']   = $is_feature;
            $dataUpdate['updated_at']           = Helper::dateTime();

            ProductCatalogueModel::update($dataUpdate, $id);
            echo json_encode(['status' => 'success', 'message' => 'Update Successfully']);
        } catch (\Throwable $e) {
            echo json_encode(['status' => 'error', 'message' => 'Something Wrong']);
        }
    }



    private function getParentCatalogue()
    {
        $parentCatalogue = $this->productCatalogueModel->table("product_catalogues")->select("id, name")->where("publish", "=", 1)->get();
        return $parentCatalogue;
    }
}

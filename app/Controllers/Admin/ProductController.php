<?php

namespace App\Controllers\Admin;

use Libs\Controller;

class ProductController extends Controller
{
    protected $attributeModel;
    protected $attributeValueModel;
    protected $brandModel;
    protected $productCatalogueModel;
    public function __construct()
    {
        $this->loadFileTemplate($this, "Admin/layout", "master");
        $this->request = array_merge($_POST, $_GET, $_FILES);
        $this->attributeModel = $this->model("attribute");
        $this->attributeValueModel = $this->model("attributeValue");
        $this->brandModel = $this->model("brand");
        $this->productCatalogueModel = $this->model("productCatalogue");
    }

    public function index()
    {
        $this->view("Admin/ProductManagement/Product/index");
    }

    public function create()
    {
        if (!empty($this->request['attribute']) && !empty($this->request['attribute_value'])) {
            $this->saveAttribute($this->request);
        }
        $brandList     = $this->brandModel->table("brands")->select("id, name, publish")->where("publish", "=", 1)->get();
        $productCatalogueList = $this->productCatalogueModel->table("product_catalogues")->select("id, name, publish")->where("publish", "=", 1)->get();
        $attributeList = $this->attributeModel->table("attributes")->select("*")->get();
        if (!empty($this->request['loadAttributeID'])) {
            $this->loadAttributeValue($this->request);
        }
        $this->setJs("admin/assets", "/customer/product/create");
        $this->view(
            "Admin/ProductManagement/Product/create",
            [
                'attributeList'         => $attributeList,
                'attributeValues'       =>  $attributeValues ?? "",
                "brandList"             => $brandList,
                "productCatalogueList"  => $productCatalogueList,
            ]
        );
    }

    public function store()
    {
        dd($this->request);
        // Validate 
        /**
         * Tiêu đề
         * Mô tả sản phẩm
         * Ảnh sản phẩm
         * Thương hiệu
         * Loại sản phẩm
         * Giá bán
         * Giá vốn
         * Số lượng
         * 
         */
    }

    private function loadAttributeValue($request)
    {
        if (!empty($request['loadAttributeID'])) {
            $attributeIDs = $request['loadAttributeID'];
            foreach ($attributeIDs as $attributeId) {
                $listAttribute[$attributeId]    =  $this->attributeValueModel->table("attribute_values")
                    ->select("attributes.name, attribute_values.name AS attribute_value_name, attribute_values.attribute_id, attribute_values.id AS attribute_value_id")
                    ->join("attributes", "attributes.id = attribute_values.attribute_id")
                    ->where("attribute_id", "=", $attributeId)
                    ->get();
            }

            $data = [];
            foreach ($listAttribute as $key => $attribute) {
                foreach ($attribute as $keyB => $value) {
                    $data[$value->attribute_id]['attribute_name']   = $value->name;
                    $data[$value->attribute_id]['attribute_values'][$value->attribute_value_id] = $value->attribute_value_name;
                }
            }

            echo json_encode(['attribute' => $data]);
            exit;
        }
    }

    private function saveAttribute($request)
    {
        dd($request['attribute_value']);
        $attribute        = $request['attribute'];
        $attribute_values = $request['attribute_value'];
        // dd($attribute_values);
        foreach ($attribute_values as $key => $attribute_value) {
            foreach ($attribute_value as $key => $value) {
                echo "<pre/>";
                print_r($value);
                echo "<pre/>";
            }
        }
    }
}

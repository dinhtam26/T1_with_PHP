<?php

namespace App\Controllers\Admin;

use App\Models\PrdVariantHasAttributeModel;
use App\Models\ProductHasAttributeModel;
use App\Models\ProductModel;
use App\Models\ProductVariantModel;
use Libs\Controller;
use Libs\Helper;
use Libs\Session;
use Libs\Upload;

class ProductController extends Controller
{
    protected $attributeModel;
    protected $attributeValueModel;
    protected $productModel;
    protected $brandModel;
    protected $productCatalogueModel;
    public function __construct()
    {
        $this->loadFileTemplate($this, "Admin/layout", "master");
        $this->request = array_merge($_POST, $_GET, $_FILES);
        $this->productModel   = $this->model("product");
        $this->attributeModel = $this->model("attribute");
        $this->attributeValueModel = $this->model("attributeValue");
        $this->brandModel = $this->model("brand");
        $this->productCatalogueModel = $this->model("productCatalogue");
    }

    // Danh sách sản phẩm
    public function index()
    {
        $this->view("Admin/ProductManagement/Product/index");
    }

    // View thêm sản phẩm
    public function create()
    {

        $brandList     = $this->brandModel->table("brands")->select("id, name, publish")->where("publish", "=", 1)->get();
        $productCatalogueList = $this->productCatalogueModel->table("product_catalogues")->select("id, name, publish")->where("publish", "=", 1)->get();
        $attributeList = $this->attributeModel->table("attributes")->select("*")->get();
        if (!empty($this->request['loadAttributeID'])) {
            $this->loadAttributeValue($this->request);
        }
        if (!empty($this->request['attribute']) && !empty($this->request['attribute_value'])) {
            $this->saveAttribute($this->request);
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

    // Thêm sản phẩm
    public function store()
    {
        // dd($this->request);
        $rules = [
            'name' => 'required|string|min:2|max:255',
            'description' => 'string',
            'brand_id'    => 'required',
            'product_catalogue_id' => 'required|numeric',
            'image'                => 'required|image|min:1|max:200|extensions:jpG,jpeg,svg,gif',
            'album'                => 'required',
            'stock'                => 'required|integer',
            'price'                => 'required|numeric',
            'sale_price'           => 'numeric',
            'cost_price'           => 'numeric',
        ];


        // Thêm product trước
        // Thêm product_attribute
        // Thêm product variant
        // Thêm product_variant_attribute
        try {
            $this->productModel->beginTransaction();
            $product = $this->createProduct($this->request);
            $this->createProductHasAttribute($product, $this->request);
            $this->createProductVariant($product, $this->request);
            $this->productModel->commit();
        } catch (\Throwable $e) {
            $this->productModel->rollBack();
            echo "Transaction failed: " . $e->getMessage();
        }


        // Validate 
        /**'
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

    // Thêm sản phẩm vào bảng product
    private function createProduct($request)
    {
        $dataCreateProduct = [];
        $dataCreateProduct['name'] = $request['name'];
        $dataCreateProduct['brand_id'] = $request['brand_id'];
        $dataCreateProduct['product_catalogue_id'] = $request['product_catalogue_id'];
        $dataCreateProduct['type'] = $request['type'];
        $dataCreateProduct['canonical'] = Helper::canonical($request['name']);
        $dataCreateProduct['brand_id'] = $request['brand_id'];
        // $dataCreateProduct['experct'] = $request['experct'];
        $dataCreateProduct['description'] = $request['description'];
        $dataCreateProduct['shipping_ids'] = json_encode($request['shipping_ids']) ?? "";
        $dataCreateProduct['publish'] = 1;
        $dataCreateProduct['created_at'] = Helper::dateTime();
        $dataCreateProduct['updated_at'] = Helper::dateTime();

        $product = ProductModel::create($dataCreateProduct);
        return $product;
    }

    // Thêm sản phẩm vào bảng product_has_attribute
    private function createProductHasAttribute($product, $request)
    {
        $attribute = [];
        if (!empty($request['attribute_value'])) {
            foreach ($request['attribute_value'] as $attribute_id => $attribute_value) {
                $attribute[$attribute_id]['attribute_id'] = $attribute_id;
                $attribute[$attribute_id]['attribute_value'] = json_encode($attribute_value);
            }
        }

        if (!empty($request['enable_variant'])) {
            foreach ($request['enable_variant'] as $attribute_id => $enable_variant) {
                $attribute[$attribute_id]['enable_variant'] = $enable_variant;
            }
        }

        foreach ($attribute as $attribute_key => $attribute_value) {
            $dataCreateAttribute['product_id'] = $product;
            $dataCreateAttribute['attribute_id'] = $attribute_value['attribute_id'];
            $dataCreateAttribute['attribute_value_ids'] = $attribute_value['attribute_value'];
            $dataCreateAttribute['enable_variant'] = $attribute_value['enable_variant'] ?? 0;
            ProductHasAttributeModel::create($dataCreateAttribute);
        }
    }

    // Thêm sản phẩm vào bảng product_variant
    private function createProductVariant($product, $request)
    {
        if ($request['type'] == "simple") {
            $this->createProductVariantSimple($product, $request);
        } else if ($request['type'] ==  "variant") {
            $this->createProductVariants($product, $request);
        }
    }

    // Thêm sản phẩm vào bảng product variant type là simple
    private function createProductVariantSimple($product, $request)
    {
        $productVariantData = [];
        $productVariantData['name']             = $request['name'];
        $productVariantData['product_id']       = $product;
        $productVariantData['uuid']             = "";
        $productVariantData['sku']              = Helper::canonical($request['name']);;
        $productVariantData['slug']             = Helper::canonical($request['name']);
        $productVariantData['price']            = $request['price'];
        $productVariantData['sale_price']       = $request['sale_price'];
        $productVariantData['cost_price']       = $request['cost_price'];
        $productVariantData['stock']            = $request['stock'];
        $productVariantData['low_stock_amount'] = $request['low_stock_amount'];
        $productVariantData['weight']           = $request['weight'];
        $productVariantData['length']           = $request['length'];
        $productVariantData['width']            = $request['width'];
        $productVariantData['height']           = $request['height'];
        $productVariantData['publish']          = 1;
        $productVariantData['created_at']       = Helper::dateTime();
        $productVariantData['updated_at']       = Helper::dateTime();
        $folderUpload                           = "products/" . $this->folderUpload($request['product_catalogue_id']);
        $productVariantData['image']            = Upload::uploadFile($request['image'], $folderUpload);

        $productVariantData['album']            = $this->convertAlbum($request['album'], $folderUpload, true);
        ProductVariantModel::create($productVariantData);
    }

    // Thêm sản phẩm vào bảng product_variant ( type là variant )
    private function createProductVariants($product, $request)
    {
        $dataList = [];
        $nameVariant = $this->getAttributeVariant($request);
        foreach ($request['price'] as $key => $value) {
            $dataMain = [];
            $dataMain['product_id'] = $product;
            $dataMain['name']               = $request['name'] . " " . $nameVariant[$key];
            $dataMain['slug']               = Helper::canonical($dataMain['name']);
            $dataMain['sku']                = "";
            $dataMain['price']              = $value;
            $dataMain['sale_price']         = $request['sale_price'][$key];
            $dataMain['cost_price']         = $request['cost_price'][$key];
            $dataMain['stock']              = $request['stock'][$key];
            $dataMain['low_stock_amount']   = $request['low_stock_amount'][$key];
            $dataMain['weight']             = $request['weight'];
            $dataMain['length']             = $request['length'];
            $dataMain['width']              = $request['width'];
            $dataMain['height']             = $request['height'];
            $folderUpload                   = "products/" . $this->folderUpload($request['product_catalogue_id']);
            if (!empty($request['image_variant'])) {
                $dataMain['image']              = $this->convertImageVariant($request['image_variant'], $folderUpload, $key);
            } else {
                $dataMain['image']              = Upload::uploadFile($request['image'], $folderUpload);
            }

            if (!empty($request['album_variant'])) {
                $dataMain['album']              = $this->convertImageVariant($request['album_variant'], $folderUpload, $key);
            } else {
                $dataMain['album']              = $this->convertAlbum($request['album'], $folderUpload, true);
            }
            $dataMain['publish']            = 1;
            $dataList[] = $dataMain;
        }
        // dd($dataList);
        foreach ($dataList as $key => $dataVariant) {
            $product_variant = ProductVariantModel::create($dataVariant);
            $this->createProductVariantHasAttributeValue($product_variant, $request, $key);
        }
    }

    private function createProductVariantHasAttributeValue($product_variant, $request, $index)
    {
        foreach ($request['enable_variant'] as $key => $value) {
            if ($value == 1) {
                $attribute[$key] = explode(",", $request['attribute_value'][$key]);
            }
        }
        // dd($attribute);
        $result = [];
        foreach ($attribute[1] as $key1  => $value1) {
            foreach ($attribute[2] as $key2 => $value2) {
                $result[] = [$value1, $value2, $product_variant];
            }
        }

        $data = [];
        // dd($result);
        if (!empty($result[$index])) {
            $prefix = array_pop($result[$index]);
            foreach ($result[$index] as  $value) {
                $data[] = ['product_variant_id' =>  $prefix,  'attribute_value_id' => $value];
            }
            // dd($data);
            foreach ($data as $key => $value) {
                PrdVariantHasAttributeModel::create($value);
            }
        }
    }

    // Convert nhiều hình ảnh 
    private function convertAlbum($albums, $folderUpload)
    {
        foreach ($albums['name'] as $index => $name) {
            $outputAlbum[$index] = [
                "name"      => $albums["name"][$index],
                "full_path" => $albums["full_path"][$index],
                "type"      => $albums["type"][$index],
                "tmp_name"  => $albums["tmp_name"][$index],
                "error"     => $albums["error"][$index],
                "size"      => $albums["size"][$index]
            ];
        }
        foreach ($outputAlbum as $index => $value) {
            $result[] = Upload::uploadFile($value, $folderUpload);
        }
        return json_encode($result);
    }

    // Convert 1 hình ảnh cho từng sản phẩm
    private function convertImageVariant($albums, $folderUpload, $key)
    {
        if (!empty($albums)) {
            foreach ($albums['name'] as $index => $name) {
                $outputAlbum[$index] = [
                    "name"      => $albums["name"][$index],
                    "full_path" => $albums["full_path"][$index],
                    "type"      => $albums["type"][$index],
                    "tmp_name"  => $albums["tmp_name"][$index],
                    "error"     => $albums["error"][$index],
                    "size"      => $albums["size"][$index]
                ];
            }

            foreach ($outputAlbum as $index => $value) {
                if ($key == $index) {
                    return Upload::uploadFile($value, $folderUpload);
                }
            }
        }
    }

    // Convert nhiều hình ảnh cho từng sản phẩm
    private function convertAlbumVariant($albums, $folderUpload, $key)
    {
        if (!empty($albums)) {
            foreach ($albums['name'] as $index => $files) {
                foreach ($files as $fileIndex => $fileName) {
                    $outputAlbum[$index][] = [
                        'name' => $fileName,
                        'tmp_name' => $albums['tmp_name'][$index][$fileIndex],
                        "full_path" => $albums['full_path'][$index][$fileIndex],
                        "type"      => $albums['type'][$index][$fileIndex],
                        "error"     => $albums['error'][$index][$fileIndex],
                        "size"      => $albums['size'][$index][$fileIndex],
                    ];
                }
            }

            foreach ($outputAlbum as $index => $value) {
                if ($index == $key) {
                    foreach ($value as  $val) {
                        $result[] = Upload::uploadFile($val, $folderUpload);
                    }
                }
            }

            return json_encode($result);
        }
    }




    private function getAttributeVariant($request)
    {

        foreach ($request['enable_variant'] as $key => $value) {
            if ($value == 1) {
                $attribute[$key] = $request['attribute_value'][$key];
            }
        }

        $attribute_value_ids = "";
        foreach ($attribute as $key => $value) {
            $attribute_value_ids .=  "," . $value;
        }

        $attribute_value_ids = substr($attribute_value_ids, 1);
        $attribute_value_ids = explode(',', $attribute_value_ids);


        $attribute_value_ids = "'" . implode("','", $attribute_value_ids) . "'";

        $attribute_values_names = $this->attributeValueModel->table("attribute_values")->select("id, name")->inWhere("id", "IN", "(" . $attribute_value_ids . ")")->get();

        $attribute_values_name = [];
        foreach ($attribute_values_names as $value) {
            $attribute_values_name[$value->id] = $value->name;
        }

        $result = [];
        foreach ($attribute as $key => $ids) {

            $arrayIds =  explode(',', $ids);

            $result[$key] = array_map(function ($id) use ($attribute_values_name) {
                return $attribute_values_name[$id];
            }, $arrayIds);
        }



        $attribute_name = [];
        foreach ($result[2] as $storage) {
            foreach ($result[1] as $color) {
                $attribute_name[] = $storage . ' ' . $color;
            }
        }

        return $attribute_name;
    }


    // Tạo folder chứa các hình ảnh được upload lên
    private function folderUpload($product_catalogue_id)
    {
        switch ($product_catalogue_id) {
            case 24:
                $result = "iphone";
                break;
            case 25:
                $result = "macbook";
                break;
            case 28:
                $result = "ipad";
                break;
            case 29:
                $result = "watch";
                break;
            case 30:
                $result = "tai_nghe_loa";
                break;
            case 31:
                $result = "phu_kien";
                break;
            default:
                $result = "khac";
                break;
        }
        return $result;
    }


    // Load các giá trị trong attribute_value lên khi nhận được từ id attribute
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

    // Lưu thuộc tính để generate ra các sản phẩm biến thể
    private function saveAttribute($request)
    {
        $attribute        = $request['attribute'];
        $attribute_values = $request['attribute_value'];



        foreach ($attribute_values as $key => $attribute_value) {
            foreach ($attribute_value as $key1 => $value) {
                if ($key1 == "values") {
                    foreach ($value as $key => $val) {
                        $sql = $this->attributeValueModel->table("attribute_values")->select("id , name")->where("id", "=", $val)->get();
                        $data[] = $sql;
                    }
                }
            }
        }
        $result = [];
        foreach ($data as $item) {
            foreach ($item as $obj) {

                // Sử dụng id làm key và name làm value
                $result[$obj->id] = $obj->name;
            }
        }

        foreach ($attribute_values as $key => $attribute) {
            $attribute_values[$key]['values'] = array_map(function ($id) use ($result) {
                return $result[$id] ?? $id; // Nếu không tìm thấy tên, giữ nguyên id
            }, $attribute['values']);
        }

        // Lọc mảng
        $filterData = array_filter($attribute_values, function ($item) {
            return $item['enable_variant'] == "true";
        });

        $specifications =  array_filter($attribute_values, function ($item) {
            return $item['enable_variant'] == "false";
        });
        $data2 = [];
        $data2['attribute_variant'] = $filterData;
        $data2['specifications']     = $specifications;

        echo json_encode(['attribute_values' => $data2]);
        exit;
    }
}

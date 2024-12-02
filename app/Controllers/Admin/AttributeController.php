<?php

namespace App\Controllers\Admin;

use App\Models\AttributeModel;
use App\Models\AttributeValueModel;
use Libs\Controller;
use Libs\Helper;
use Libs\Session;
use Libs\Validate;

class AttributeController extends Controller
{
    protected $attributeValueModel;
    public function __construct()
    {
        $this->loadFileTemplate($this, "Admin/layout", "master");
        $this->request = array_merge($_POST, $_GET, $_FILES);
        $this->attributeValueModel = $this->model("attributeValue");
    }

    public function index()
    {
        $listAttributes = AttributeModel::all();
        $this->view("Admin/Attribute/index", ['listAttributes' => $listAttributes]);
    }

    /** Create */
    public function create()
    {
        return $this->view("Admin/Attribute/create");
    }

    /** Store */
    public function store()
    {
        $rules = [
            'name'          => 'require|string|min:2|max:255',
            'code'          => 'max:255',
            'description'   => 'string',
        ];
        $validator = new Validate($this->request, $rules);
        if ($validator->validate() !== true) {
            $validator->getErrors();
            $this->view("Admin/Attribute/create", ['data' => $validator->getResults()]);
            return;
        }

        $dataCreate['name']         = $this->request['name'];
        $dataCreate['code']         = Helper::canonical(($this->request['code'] == "" ? $this->request['name'] : $this->request['code']), true);
        $dataCreate['description']  = $this->request['description'];
        $dataCreate['created_at']   = Helper::dateTime();
        $dataCreate['updated_at']   = Helper::dateTime();
        AttributeModel::create($dataCreate);
        Session::setSession('success', 'Created Attribute Successfully');
        Helper::redirect("admin/attribute");
    }

    /** Edit */
    public function edit($id)
    {
        $attribute = AttributeModel::find($id);
        $attribute_value = $this->attributeValueModel->table('attribute_values')->select('*')->where('attribute_id', '=', $id)->get();
        $this->view("Admin/Attribute/update", ['attribute' => $attribute, 'attribute_value' => $attribute_value]);
    }

    /** Update */
    public function update($id)
    {
        $attribute = AttributeModel::find($id);
        $rules = [
            'name'          => 'require|string|min:2|max:255',
            'code'          => 'max:255',
            'description'   => 'string',
        ];
        $validator = new Validate($this->request, $rules);
        if ($validator->validate() !== true) {
            $validator->getErrors();
            Helper::redirect("admin/attribute/$id/edit");
            return;
        }

        $attribute['name']         = $this->request['name'];
        $attribute['code']         = Helper::canonical(($this->request['code'] == "" ? $this->request['name'] : $this->request['code']), true);
        $attribute['description']  = $this->request['description'];
        $attribute['updated_at']   = Helper::dateTime();
        AttributeModel::update($attribute, $id);
        Session::setSession('success', 'Updated Attribute Successfully');
        Helper::redirect("admin/attribute/$id/edit");
    }

    /** Delete */
    public function delete($id)
    {
        try {
            $brand = AttributeModel::find($id);
            if (!$brand) {
                echo json_encode(['status' => 'error', 'message' => 'Attribute not found'], 404);
            }
            AttributeModel::delete($id);
            echo json_encode(['status' => 'success', 'message' => 'Deleted Successfully', 'id' => $id]);
        } catch (\Throwable $e) {
            echo json_encode(['status' => 'error', 'message' => 'Something Wrong']);
        }
    }


    /** Attribute Value */
    public function storeValue()
    {
        $rules = [
            'name' => 'required|string|min:2|max:255',
            'attribute_id'   => 'numeric',
        ];
        $id = $this->request['attribute_id'];
        $validator = new Validate($this->request, $rules);
        if ($validator->validate() !== true) {
            $validator->getErrors();
            Helper::redirect("admin/attribute/$id/edit");
            return;
        }

        $dataCreate['name']         = $this->request['name'];
        $dataCreate['attribute_id'] = $id;
        $dataCreate['created_at']   = Helper::dateTime();
        $dataCreate['updated_at']   = Helper::dateTime();
        AttributeValueModel::create($dataCreate);
        Session::setSession('success', 'Created Attribute Value Successfully');
        Helper::redirect("admin/attribute/$id/edit");
    }

    public function editValue($id)
    {
        $attribute_value = AttributeValueModel::find($id);
        $attribute_id    = $attribute_value['attribute_id'];
        $attribute       = AttributeModel::find($attribute_id);
        return $this->view("Admin/Attribute/updateValue", ['attribute_value' => $attribute_value, 'attribute' => $attribute]);
    }

    public function updateValue($id)
    {

        $attribute_value = AttributeValueModel::find($id);
        $attribute_id    = $attribute_value['attribute_id'];
        $rules = [
            'name' => 'required|string|min:2|max:255',
        ];
        $validator = new Validate($this->request, $rules);
        if ($validator->validate() !== true) {
            $validator->getErrors();
            Helper::redirect("admin/attribute/value/$id/edit");
            return;
        }

        $attribute_value['name']   = $this->request['name'];
        $attribute_value['updated_at']  = Helper::dateTime();

        AttributeValueModel::update($attribute_value, $id);
        Session::setSession('success', 'Update Attribute Value Successfully');
        Helper::redirect("admin/attribute/$attribute_id/edit");
    }

    public function deleteValue($id)
    {
        try {
            $attribute_value = AttributeValueModel::find($id);
            if (!$attribute_value) {
                echo json_encode(['status' => 'error', 'message' => 'Attribute value not found'], 404);
            }
            AttributeValueModel::delete($id);
            echo json_encode(['status' => 'success', 'message' => 'Deleted Successfully', 'id' => $id]);
        } catch (\Throwable $e) {
            echo json_encode(['status' => 'error', 'message' => 'Something Wrong']);
        }
    }
}

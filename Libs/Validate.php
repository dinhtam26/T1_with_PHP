<?php

namespace Libs;

class Validate
{
    public $errors   = [];
    public $rules    = [];
    public $results  = [];
    public $data     = [];


    public function __construct($data, $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
    }

    public function validate()
    {
        foreach ($this->rules as $field => $ruleSet) {
            $rules = explode('|', $ruleSet);
            foreach ($rules as $rule) {
                $this->applyRule($field, $rule);
            }

            if (!array_key_exists($field, $this->errors)) {
                $this->results[$field] = $this->data[$field];
            }
        }
        $fieldNotValidate = array_diff_key($this->data, $this->errors);
        $this->results = array_merge($fieldNotValidate, $this->results);
        return empty($this->errors);
    }



    public function applyRule($field, $rule)
    {
        if (!isset($this->data[$field])) {
            // dd($field);
            // dd($this->data[$field]);
            $this->setError($field, 'Test');
        }

        switch ($rule) {
            case 'required':
                $this->validateRequired($field);
                break;
            case str_starts_with($rule, 'min:'):
                $this->validateMin($field, $rule);
                break;
            case str_starts_with($rule, 'max:'):
                $this->validateMax($field, $rule);
                break;
            case 'email':
                $this->validateEmail($field);
                break;
            case 'integer':
                $this->validateInteger($field);
                break;
            case 'numeric':
                $this->validateNumeric($field);
                break;
            case 'string':
                $this->validateString($field);
                break;
            case 'image':
                $this->validateImage($field);
                break;
            case str_starts_with($rule, 'extensions:'):
                $this->validateExtension($field, $rule);
                break;
            case str_starts_with($rule, 'unique:'):
                $this->validateUnique($field, $rule);
                break;
            case 'phone':
                $this->validatePhone($field);
                break;
            default:
                # code...
                break;
        }
    }

    /** Set Error */
    protected function setError($field, $message)
    {
        $this->errors[$field][] = $message;
    }

    /** Get Error */
    public function getErrors()
    {
        foreach ($this->errors as $key => $value) {
            $arr[] = $value[0];
            Session::setSession('errors', $arr);
        }
    }

    public function getResults()
    {
        return $this->results;
    }

    /** Required */
    private function validateRequired($field)
    {
        if (empty($this->data[$field])) {
            $this->setError($field, "The $field is required");
        }

        // Kiểm tra file có rỗng không
        if (is_array($this->data[$field])) {
            if ($this->data[$field]['size'] == 0) {
                $this->setError($field, "The $field is required");
            }
        }
    }


    /** Min */
    private function validateMin($field, $rule)
    {

        // Kiểm tra numeric
        if (is_numeric($this->data[$field])) {
            $minValue = (int)explode(':', $rule)[1];
            $this->checkMin($field, $minValue);
            if ($this->data[$field] < $minValue) {
                $this->setError($field, "The $field must be at least $minValue");
            }
            return;
        }


        // Kiểm tra string
        if (is_string($this->data[$field])) {
            $minValue = (int)explode(':', $rule)[1];
            $this->checkMin($field, $minValue);
            if (strlen($this->data[$field]) < $minValue) {
                $this->setError($field, "must be at least $minValue characters");
            }
            return;
        }


        // Kiểm tra file
        if (is_file($this->data[$field]['tmp_name'])) {
            $minValue = (int)explode(':', $rule)[1];
            $this->checkMin($field, $minValue);
            $minSize = ($this->data[$field]['size'] / 1024); // (Tính theo kb)
            if ($minSize < $minValue) {
                $this->setError($field, "The $field must be at least $minValue kilobytes.");
            }
            return;
        }
    }

    private function checkMin($field, $minValue)
    {
        if (str_contains($this->rules[$field], 'max')) {
            $parts = explode("|", $this->rules[$field]);
            foreach ($parts as $part) {
                if (strpos($part, 'max:') === 0) {
                    $maxValue = explode(':', $part)[1];
                    if ($maxValue <= $minValue) {
                        $this->setError($field, "Error validate min max please checked");
                        return;
                    }
                }
            }
        }
    }

    /** Max */
    private function validateMax($field, $rule)
    {

        // Kiểm tra numeric
        if (is_numeric($this->data[$field])) {
            $maxValue = (int)explode(':', $rule)[1];
            if ($this->data[$field] > $maxValue) {
                $this->setError($field, "The $field may not be greater than $maxValue");
            }
            return;
        }

        // Kiểm tra string
        if (is_string($this->data[$field])) {
            $maxValue = (int)explode(':', $rule)[1];
            if (strlen($this->data[$field]) > $maxValue) {
                $this->setError($field, "The $field may not be greater than $maxValue characters");
            }
            return;
        }



        // Kiểm tra file
        if (is_file($this->data[$field]['tmp_name'])) {
            $maxValue = (int)explode(':', $rule)[1];
            $minSize = ($this->data[$field]['size'] / 1024); // (Tính theo kb)
            if ($minSize > $maxValue) {
                $this->setError($field, "The $field may not be greater than $maxValue kilobytes.");
            }
            return;
        }
    }


    /** Email */
    private function validateEmail($field)
    {
        if (!filter_var(trim($this->data[$field]), FILTER_VALIDATE_EMAIL)) {
            $this->setError($field, 'is invalid email');
        }
    }

    /** Integer */
    private function validateInteger($field)
    {
        if (!filter_var($this->data[$field], FILTER_VALIDATE_INT)) {
            $this->setError($field, "The $field must be an integer.");
        }
    }


    /** Numeric */
    private function validateNumeric($field)
    {
        if (!is_numeric($this->data[$field])) {
            $this->setError($field, "The $field must be a number.");
        }
    }

    /** String */
    private function validateString($field)
    {
        if (!is_string($this->data[$field])) {
            $this->setError($field, "The $field must be a string.");
        }
    }

    /** Image */
    private function validateImage($field)
    {
        if ($this->data[$field]['type'] != null) {
            $type = $this->data[$field]['type'];
            $type = explode("/", $type);
            $typeImg = $type['0'];
            if ($typeImg !== "image") {
                $this->setError($field, "This file is not image");
            }
        }
    }

    /** Extension file */
    private function validateExtension($field, $rule)
    {
        // dd([$field, $rule]);
        $listEtx = strtolower(explode(":", $rule)[1]);
        // Lấy list extension file validate
        $arrExt  = explode(",", $listEtx);

        // Lấy extension của file
        $extFile = explode("/", $this->data[$field]['type'])[1];

        // Kiểm tra extension không tồn tại trong mảng extension validate
        if (!in_array($extFile, $arrExt)) {
            $this->setError($field, "The file must be a file of type: $listEtx.");
        }
    }


    private function validateUnique($field, $rule)
    {
        $model = new Model();
        $dataField = $this->data[$field];

        $arrUnique = explode(":", $rule);
        $table = $arrUnique[1];
        if (isset($arrUnique[2])) {
            $id    = $arrUnique[2];
            $exits = $model->table($table)->select('id')->where($field, '=', $dataField)->where('id', '!=', $id)->getOne();
            if (!empty($exits)) {
                $this->setError($field, "The $field has exits. Please change $field");
            }
            return;
        }



        $exits = $model->table($table)->select('id')->where($field, '=', $dataField)->getOne();

        if (!empty($exits)) {
            $this->setError($field, "The $field has exits. Please change $field");
        }
    }

    private function validatePhone($field)
    {
        $phone = $this->data[$field];
        if (!empty($phone)) {
            if (!preg_match("/^(?:\+84[0-9]{9}|[0-9]{10})$/", $phone)) {
                $this->setError($field, "The $field is not a valid phone number.");
            }
        }
    }



    /** How to use
     * 
     *   'name'      => 'required|string|min:2|max:10',
     *   'quantity'  => 'required|min:5|max:29',
     *   'password'  => 'required',
     *   'email'     => 'required|email',
     *   'file'      => 'required|image|min:1|max:200|extensions:jpG,jpeg,svg,gif',
     */
}

<?php

namespace App\Models;

use Libs\Model;

class CategoryModel extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->setTable('categories');
    }

    public function getAllProduct()
    {
        $cate = $this->table($this->tablename)->select(['id', 'nam', 'created_at'])->get();
        return $cate;
    }
}

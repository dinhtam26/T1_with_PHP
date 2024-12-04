<?php

namespace App\Models;

use Libs\Model;

class ProductModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable('products');
    }
}

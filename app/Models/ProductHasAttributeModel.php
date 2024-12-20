<?php

namespace App\Models;

use Libs\Model;

class ProductHasAttributeModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable('product_has_attributes');
    }
}

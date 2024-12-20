<?php

namespace App\Models;

use Libs\Model;

class ProductVariantModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable('product_variants');
    }
}

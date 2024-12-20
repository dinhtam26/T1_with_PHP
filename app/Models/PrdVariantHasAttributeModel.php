<?php

namespace App\Models;

use Libs\Model;

class PrdVariantHasAttributeModel extends Model
{

    protected $tablename;
    public function __construct()
    {
        parent::__construct();
        $this->tablename = 'product_variant_has_attributes';
    }
}

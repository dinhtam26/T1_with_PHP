<?php

namespace App\Models;

use Libs\Model;

class ProductCatalogueModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable('product_catalogues');
    }
}

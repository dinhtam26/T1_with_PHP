<?php

namespace App\Models;

use Libs\Model;

class BrandModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable('brands');
    }
}
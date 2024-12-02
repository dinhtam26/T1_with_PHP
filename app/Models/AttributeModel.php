<?php

namespace App\Models;

use Libs\Model;

class AttributeModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable('attributes');
    }
}

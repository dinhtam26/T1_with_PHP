<?php

namespace App\Models;

use Libs\Model;

class AttributeValueModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable('attribute_values');
    }
}

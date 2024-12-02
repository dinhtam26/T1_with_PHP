<?php

namespace App\Models;

use Libs\Model;

class PermissionModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable('permissions');
    }
}

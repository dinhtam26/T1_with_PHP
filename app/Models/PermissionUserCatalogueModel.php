<?php

namespace App\Models;

use Libs\Model;

class PermissionUserCatalogueModel extends Model
{

    protected $tablename;
    public function __construct()
    {
        parent::__construct();
        $this->tablename = 'permission_user_catalogue';
    }
}

<?php

namespace App\Models;

use Libs\Model;

class UserCatalogueModel extends Model
{

    protected $tablename;
    public function __construct()
    {
        parent::__construct();
        $this->tablename = 'user_catalogues';
    }
}

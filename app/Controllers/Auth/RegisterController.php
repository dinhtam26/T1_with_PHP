<?php

namespace App\Controllers\Auth;

use Libs\Controller;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->request = array_merge($_POST, $_GET, $_FILES);
    }
}

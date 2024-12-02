<?php

namespace Middlewares;

use Libs\Helper;
use Libs\Session;

class Admin
{
    public function handle()
    {

        if (isset($_SESSION['auth'])) {
            $auth = Session::getSession('auth');

            if ($auth['user_catalogue']['code'] !== "admin") {
                Session::setSession('errors', ['You do not have access to the system']);
                Helper::redirect("");
            }
        }
    }
}

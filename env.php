<?php

/** Định nghĩa các đường dẫn gốc */
define("DS", "/");
define("ROOT_PATH", dirname(__FILE__));
define("APP_PATH", ROOT_PATH . DS . "app" . DS);
define("LIBS_PATH", ROOT_PATH . DS . "Libs" . DS);
define("PUBLIC_PATH", ROOT_PATH . DS . "public" . DS);
define("UPLOAD_PATH", PUBLIC_PATH . "uploads" . DS);


/** Định nghĩa các đường dẫn tương đối */
define("ROOT_URL", "/magento-ecommerce" . DS);
define("APP_URL", ROOT_URL . "app" . DS);
define("PUBLIC_URL", ROOT_URL . "public" . DS);
define("ADMIN_URL", PUBLIC_URL . "admin" . DS);
define("FRONTEND_URL", PUBLIC_URL . "frontend" . DS);
define("UPLOAD_URL", PUBLIC_URL . "uploads" . DS);




/** Định nghĩa trường kết nối cơ sở dữ liệu */
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "magento-ecommerce");

function dd($key)
{
    echo "<pre/>";
    print_r($key);
    echo "<pre/>";

    die;
}

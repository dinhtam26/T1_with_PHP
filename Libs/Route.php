<?php

namespace Libs;

use Middlewares\Admin;
use Middlewares\Auth;

class Route
{
    //thuôc tính $routes để lưu trữ đường dẫn của website
    protected static $routes  = [];
    protected static $middlewares = [];
    /**
     * method get: khai báo đường dẫn theo phương thức get
     * $path: đường dẫn
     * $callback: hành đồng theo đường dẫn
     */

    public static function get($path, $callback, $middleware = [])
    {
        // dd($middleware);
        static::$routes['get'][$path] = $callback;


        if ($middleware) {
            static::$routes['get'][$path]['middleware'] = $middleware;
        }

        // dd(static::$routes);
    }
    public static function post($path, $callback, $middleware = [])
    {
        static::$routes['post'][$path] = $callback;
        if ($middleware) {
            static::$routes['post'][$path]['middleware'] = $middleware;
        }
    }

    public static function put($path, $callback, $middleware = [])
    {
        static::$routes['post'][$path] = $callback;
        if ($middleware) {
            static::$routes['post'][$path]['middleware'] = $middleware;
        }
    }

    public static function destroy($path, $callback, $middleware = [])
    {
        static::$routes['get'][$path] = $callback;
        if ($middleware) {
            static::$routes['get'][$path]['middleware'] = $middleware;
        }
    }




    //Method getmethod: để lấy thông tin của Method
    public function getMethod()
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    //Method resolve: thực hiện việc điều hướng theo routes
    public function resolve()
    {

        $method = $this->getMethod();
        //Lấy đường dẫn trên thanh địa chỉ trình duyệt
        $path = $_SERVER["REQUEST_URI"];
        //Tiến hành làm gọn đường dẫn
        $path = str_replace(ROOT_URL, "/", $path);

        //Tìm vị trí xuất hiện dấu ? ở trong $path
        $position = strpos($path, "?");
        //Nếu tìm được, thì tiến hành làm gòn $path
        if ($position) {
            $path = substr($path, 0, $position);
        }
        $callback = false;

        // Tìm đường dẫn khớp trong danh sách routes

        foreach (static::$routes[$method] as $routePath => $routeCallback) {
            // Tạo một regex để khớp với các đường dẫn chứa tham số động
            $regex = preg_replace('/\{(\w+)\}/', '(\w+)', $routePath);
            $regex = str_replace('/', '\/', $regex);
            $regex = "/^" . $regex . "$/";

            // Kiểm tra nếu đường dẫn khớp với regex
            if (preg_match($regex, $path, $matches)) {
                array_shift($matches); // Bỏ phần tử đầu tiên (là toàn bộ chuỗi khớp)
                $callback = $routeCallback;
                $params = $matches; // Các tham số động được lưu trong $params
                break;
            }
        }

        if ($callback === false) {
            echo "404 NOT FOUND";
            die;
        }

        $middlewares = [];
        if (isset($callback['middleware']) &&   is_array($callback['middleware'])) {
            $middlewares = $callback['middleware'];
            unset($callback['middleware']);
        }


        // Áp dụng middleware
        foreach ($middlewares as $middleware) {
            if ($middleware == "auth") {
                (new Auth)->handle();
            }

            if ($middleware == "admin") {
                (new Admin)->handle();
            }
        }


        // Áp dụng chức năng phân quyền



        if (is_callable($callback)) {
            return $callback();
        }


        //Kiểm tra xem $callback có phải mảng không
        // dd($callback);

        if (is_array($callback)) {
            $callback[0] = new $callback[0];

            return call_user_func_array($callback, $params ?? []);
        }
    }
}

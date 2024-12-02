<?php

namespace Libs;

use Libs\Template;


class Controller
{

    protected $template;
    public $templatePath;
    public $fileView;
    public $request;
    public $js;
    public $css;

    protected function loadFileTemplate($thisObj, $folderTemplate, $fileTemplate)
    {
        $this->template = new Template($thisObj);
        $this->template->setFolderTemplate($folderTemplate);
        $this->template->setFileTemplate($fileTemplate);
        $this->template->load();
    }

    public function view($viewName, $data = [], $full = true)
    {
        extract($data);
        // dd($data);
        $path = APP_PATH . "Views" . DS . $viewName . ".php";
        if (file_exists($path)) {
            if ($full == true) {
                $this->fileView = $viewName;
                require_once $this->templatePath;
            } else {
                require_once  $path;
            }
        } else {
            // Không tồn tại trả về file 404
            echo "File không tồn tại";
        }
    }

    public function model($name)
    {
        $modelName = ucfirst($name) . "Model";
        $fullModelName = "App\\Models\\" . $modelName;
        $pathModel = APP_PATH . "Models" . DS . $modelName . ".php";
        // dd($pathModel);
        if (file_exists($pathModel)) {
            require_once $pathModel;
            return new $fullModelName();
        } else {
            echo "Not Look $modelName";
        }
    }

    public function setJs($folderName, $fileName)
    {
        $filePath = PUBLIC_PATH . "$folderName"  . DS . "js" . DS . $fileName .  ".js";
        $fileRoot = PUBLIC_URL . "$folderName"  . DS . "js" . $fileName . ".js";
        if (file_exists($filePath)) {
            $this->js = $fileRoot;
        } else {
            echo "Js k ton tai";
        }
    }

    public function setCss() {}
}

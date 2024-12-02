<?php

namespace Libs;

class Template
{
    private $folderTemplate;
    private $fileTemplate;
    private $controller;
    public function __construct($controller)
    {
        $this->controller = $controller;
    }

    public function load()
    {
        $folderTemplate = $this->getFolderTemplate();
        $fileTemplate   = $this->getFileTemplate();
        $pathFile = APP_PATH . "Views" . DS . $folderTemplate . DS . $fileTemplate . ".php";
        if (file_exists($pathFile)) {
            $this->controller->templatePath = $pathFile;
        }
    }

    public function setFolderTemplate($folder = null)
    {
        $this->folderTemplate = $folder;
    }

    public function getFolderTemplate()
    {
        return $this->folderTemplate;
    }

    public function setFileTemplate($file = null)
    {
        $this->fileTemplate = $file;
    }

    public function getFileTemplate()
    {
        return $this->fileTemplate;
    }
}

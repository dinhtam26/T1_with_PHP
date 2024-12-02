<?php

namespace Libs;

class Upload
{
    public static function uploadFile($fileObject, $folderUpload, $width = null, $height = null)
    {
        if ($fileObject['tmp_name'] != null) {
            $uploadDir = UPLOAD_PATH . $folderUpload . "/";
            $newString = self::createString(10);
            $imagePath = $newString . basename($fileObject['name']);

            // Lấy thông tin ảnh
            $sourceProperties = getimagesize($fileObject['tmp_name']);

            $sourceImageWidth   = $sourceProperties[0];
            $sourceImageHeight  = $sourceProperties[1];
            $imageType          = $sourceProperties[2];


            // Xử lý theo loại ảnh
            $resourceType = self::createImageResource($fileObject['tmp_name'], $imageType);


            // Resize ảnh
            $imageLayer = self::resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $width ?? $sourceImageWidth, $height ?? $sourceImageHeight);

            // Lưu ảnh
            if (!self::saveImage($imageLayer, $uploadDir . $imagePath, $imageType)) {
                return null; // Lưu ảnh thất bại
            }
            return $imagePath;
        }
        return null;
    }

    private static function createString($length = 5)
    {
        $arrStr = array_merge(range("a", "z"), range(0, 9));
        $string = implode("", $arrStr);
        $string = str_shuffle($string);
        $string = substr($string, 3, $length);
        return $string;
    }

    private static function resizeImage($resourceType, $widthResource, $heightResource, $resizeWidth, $resizeHeight)
    {
        $imageLayer = imagecreatetruecolor($resizeWidth, $resizeHeight);
        imagecopyresampled($imageLayer, $resourceType, 0, 0, 0, 0, $resizeWidth, $resizeHeight, $widthResource, $heightResource);
        return $imageLayer;
    }

    private static function createImageResource($filePath, $imageType)
    {
        switch ($imageType) {
            case IMAGETYPE_PNG:
                return imagecreatefrompng($filePath);
            case IMAGETYPE_JPEG:
                return imagecreatefromjpeg($filePath);
            case IMAGETYPE_GIF:
                return imagecreatefromgif($filePath);
            case IMAGETYPE_WEBP:
                return imagecreatefromwebp($filePath);
            default:
                return null; // Không hỗ trợ loại ảnh
        }
    }

    private static function saveImage($imageLayer, $filePath, $imageType)
    {
        switch ($imageType) {
            case IMAGETYPE_PNG:
                return imagepng($imageLayer, $filePath);
            case IMAGETYPE_JPEG:
                return imagejpeg($imageLayer, $filePath, 85); // Chất lượng 85%
            case IMAGETYPE_GIF:
                return imagegif($imageLayer, $filePath);
            case IMAGETYPE_WEBP:
                return imagewebp($imageLayer, $filePath, 85); // Chất lượng 85%
            default:
                return false; // Không hỗ trợ lưu ảnh
        }
    }

    public static function deleteFileUpload($folderUpload, $fileNameOld)
    {
        $fileName = UPLOAD_PATH . $folderUpload . DS . $fileNameOld;
        if (file_exists($fileName)) {
            @unlink($fileName);
        }
    }
}

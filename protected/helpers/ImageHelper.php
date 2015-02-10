<?php

class ImageHelper {
    
    /**
 * Удаляет файл
 * @param string $file если указать относительный путь, то удалит из каталога по умолчанию, если абсолютный - удалит указанный файл
 */
    public static function delete($file) {
        if (substr($file, 0, 1)!='/') {
            $folder = Yii::getPathOfAlias('webroot') . Yii::app()->params['filePath'] . Yii::app()->controller->module->id . '/';
            $file = $folder . $file;
        }
        return unlink($file);
    }

    public static function upload($file) {
        if (substr($file, 0, 1)!='/') {
            $folder = Yii::getPathOfAlias('webroot') . Yii::app()->params['filePath'] . Yii::app()->controller->module->id . '/';
            $extAr = explode('.', $file);
            $ext = $extAr[count($extAr)-1];
            $name = FileHelper::generateUnicName($folder, $ext);
            $path = $folder . $name;
        }
        if ($file->saveAs($path)) {
            return $name;
        }
        return false;
    }

}

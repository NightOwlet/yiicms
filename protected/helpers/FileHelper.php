<?php

class FileHelper {

    /**
     * 
     * @param string $path каталог, в котором нужно сохранить файл
     * @param string $extention расширение файла
     * @param integer $length количество символов в имени файла, по умолчанию 8
     * @return string Возвращает имя файла, уникальное в текущем каталоге
     */
    public static function generateUnicName($path, $extention, $length = 8) {
        $extention = $extention ? '.' . $extention : '';
        $path = $path ? $path . '/' : '';
        do {
            $name = substr(md5(microtime() . rand(0, 9999)), 0, $length);
            $file = $path . $name . $extention;
        } while (file_exists($file));

        return $name.$extention;
    }
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

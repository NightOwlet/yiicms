<?php

/**
 * Description of TinyMce
 *
 * @author Owlet
 */
class Wysiwyg extends CWidget {

    public $plugin = 'tinymce';
    private $_assets;

    public function init() {
        if (defined(YII_DEBUG)) {
            $this->_assets = Yii::app()->assetManager->publish(
                    Yii::getPathOfAlias('ext.wysiwyg') . '/' . $this->plugin
            );
        } else {
            $this->_assets = Yii::app()->assetManager->publish(
                    Yii::getPathOfAlias('ext.wysiwyg') . '/' . $this->plugin, false, -1, true);
        }
    }

    public function run() {
        $cs = Yii::app()->clientScript;

        $cs->registerScriptFile($this->_assets . '/' . $this->plugin . '.min.js');
        $cs->registerScript('.wysiwyg', 'tinymce.init({
    selector: ".wysiwyg",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    language: "ru"
});
');
        $cs->registerCss('wysiwyg-wrapper', '.wysiwyg-wrapper{margin-left: 110px}');
    }

}

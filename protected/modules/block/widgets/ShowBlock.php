<?php
class ShowBlock extends CWidget {
    public $model;
    public $name;
    public $wrapperClass;
    public $hasWrapper = true;
    
    public function run() {
        $controller = Yii::app()->controller;
        if (isset($controller->blocks[$this->name])) {
            $model = $controller->blocks[$this->name];
        } else {
            Yii::import('application.modules.block.models.Block');
            $model = Block::model()->findByPk($this->name);
        }
        if ($model !== null) {
            $this->render('block', array('model'=>$model));
        }
    }
}
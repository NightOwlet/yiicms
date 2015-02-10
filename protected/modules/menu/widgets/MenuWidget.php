<?php

Yii::import('application.modules.menu.models.Menu');

class MenuWidget extends CWidget {

    public $parent = 0;

    /**
     *
     * @var integer 
     * Сколько уровней меню отображать; если 0 - отображать все уровни
     * По умолчанию 1 уровень
     */
    public $level = 1;

    //найти все пункты меню, у которых родитель = $this->parent 
    //и уровень от уровня родителя (не включая его) и ниже 
    //до уровня родителя + $this->level
    public function run() {
        $menu = array();
        if ($this->parent == 0) {
            $level_start = 0;
        } else {
            $level_start = Menu::model()->by_parent($this->parent)->find()->level;
        }
        $models = Menu::model()->by_level($level_start, $this->level)->findAll();
        
        //пока что простую реализацию для одного уровня, дальше будем разбираться с подробностями
//        foreach ($models as $model) {
//            $arr = array('label' => $model->title, 'url'=>$model->link);
//            $menu[] = $arr;
//        }
        return $this->widget('zii.widgets.CMenu', array('items' => Menu::menuItems($models)));
    }

}

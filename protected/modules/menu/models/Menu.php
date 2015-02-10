<?php

/**
 * This is the model class for table "{{menu}}".
 *
 * The followings are the available columns in table '{{menu}}':
 * @property integer $id
 * @property string $alias
 * @property string $title
 * @property integer $parent
 * @property integer $active
 * @property integer $deleted
 * @property string $route
 * @property string $params
 * @property integer $order
 * @property integer $level
 */
class Menu extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{menu}}';
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Menu the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function scopes() {
        return array(
        );
    }

    public function defaultScope() {
        return array(
            'order' => '`level` ASC, `parent` ASC, `order` ASC',
            'condition' => '`active`=1 && `deleted`=0',
        );
    }

    public function by_parent($parents) {
        $criteria = new CDbCriteria();
        if (is_numeric($parents)) {
            $criteria->condition = '`parent`=:parent';
            $criteria->params = array(':parent' => $parents);
        } elseif (is_array($parents)) {
            $criteria->condition = '`parent` IN (:parent)';
            $criteria->params = array(':parent' => implode(',', $parents));
        } elseif (is_string($parents)) {
            $criteria->condition = '`parent` IN (:parent)';
            $criteria->params = array(':parent' => $parents);
        }
        $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }

    public function by_level($level_start, $level_count = 1) {
        $criteria = new CDbCriteria();
        $criteria->params = array(':parent' => $parents);
        if ($level_count > 1) {
            $criteria->condition = '`level`>:ls && `level` <= :le';
            $criteria->params = array(':ls' => $level_start, ':le' => $level_start + $level_count);
        } elseif ($level_count == 1) {
            $criteria->condition = '`level`=:l';
            $criteria->params = array(':l' => $level_start + 1);
        } elseif ($level_count == 0) {
            $criteria->condition = '`level`>:ls';
            $criteria->params = array(':ls' => $level_start);
        }
        $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }

    public function getLink() {
        if ($this->outer_link) {
            return $this->outer_link;
        }
        $params = !empty($this->params) ? CJSON::decode($this->params) : array();
        return Yii::app()->createUrl($this->route, $params);
    }

    public static function menuItems($list) {
        $result = array();
//        $level_strat = null;
        $pathes = array();
        foreach ($list as $item) {
//            if ($level_strat === null) {
//                $level_strat = $item->level;
//            }
            if ($item->parent==0) {
                $result[$item->id] = array('label' => $item->title, 'url'=>$item->link);
                $pathes[$item->id] = &$result[$item->id];
            } else {
                if (!isset($pathes[$item->parent]['items'])) {
                    $pathes[$item->parent]['items'] = array();
                }
                $pathes[$item->parent]['items'][$item->id] = array('label' => $item->title, 'url'=>$item->link);
                $pathes[$item->id] = &$pathes[$item->parent]['items'][$item->id];
            }
        }
        return $result;
    }

}

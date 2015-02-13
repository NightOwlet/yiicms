<?php

/**
 * This is the model class for table "{{block}}".
 *
 * The followings are the available columns in table '{{block}}':
 * @property string $id
 * @property string $title
 * @property integer $show_title
 * @property string $content
 * @property integer $active
 */
class Block extends CActiveRecord {

    /**
     * @return string the associated database table id
     */
    public function tableName() {
        return '{{block}}';
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class id.
     * @return Block the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function scopes() {
        return array(
            'active' => array(
                'condition' => '`active`=1 && `deleted`=0',
            ),            
        );
    }

}

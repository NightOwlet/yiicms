<?php

/**
 * This is the model class for table "{{news}}".
 *
 * The followings are the available columns in table '{{news}}':
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $text
 * @property string $photo
 * @property integer $active
 * @property integer $deleted
 * @property string $time
 */
class News extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{news}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return News the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function getFormattedTime() {
        return Yii::app()->dateFormatter->format('d MMMM yyyy', $this->time);
    }
    
    public function defaultScope() {
        return array(
            'condition' => 'active=1 && deleted=0 && time<NOW()',
            'order' => 'time DESC',
        );
    }
    
    public function recently($count) {
        $criteria = new CDbCriteria(array('limit'=>$count));
        $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }

}

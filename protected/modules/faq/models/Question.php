<?php

/**
 * This is the model class for table "{{question}}".
 *
 * The followings are the available columns in table '{{question}}':
 * @property string $id
 * @property string $author
 * @property string $question
 * @property string $answer
 * @property string $create_date
 * @property string $answer_date
 * @property integer $active
 * @property integer $deleted
 */
class Question extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{question}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('author, question', 'required'),
            array('author', 'length', 'max' => 150),
            array('question', 'length', 'max' => 500),
            array('create_date', 'default', 'value' => new CDbExpression('NOW()')),
            array('active, deleted', 'default', 'value' => 0),
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
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'author' => 'Имя',
            'question' => 'Вопрос',
            'answer' => 'Ответ',
            'create_date' => 'Дата создания',
            'answer_date' => 'Дата ответа',
            'active' => 'активный',
            'deleted' => 'удален',
        );
    }
    
    public function defaultScope() {
        return array(
            'condition' => '`active`=1 && `deleted`=0',
            'order' => '`create_date` DESC',
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Question the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}

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
class AdminBlock extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{block}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id, title, content', 'required'),
            array('show_title, active', 'boolean'),
            array('id', 'length', 'max' => 50),
            array('title', 'length', 'max' => 200),
            array('content', 'length', 'max' => 1000),
            array('id', 'unique'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, show_title, content, active', 'safe', 'on' => 'search'),
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
            'id' => 'Идентификатор',
            'title' => 'Заголовок',
            'show_title' => 'Показывать заголовок',
            'content' => 'Контент',
            'active' => 'Активен',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('show_title', $this->show_title);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('active', $this->active);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Block the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function scopes() {
        return array(
            'active' => array(
                'condition' => '`active` = 1',
            ),            
        );
    }

}

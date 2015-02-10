<?php
/**
 * This is the model class for table "{{news}}".
 *
 * The followings are the available columns in table '{{news}}':
 * @property string $id
 * @property string $title
 * @property string $text
 * @property integer $active
 * @property integer $deleted
 */
class AdminPage extends AdmActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{page}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, text', 'required'),
            array('title', 'length', 'max' => 200),
            array('active', 'boolean'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, text, active, deleted', 'safe', 'on' => 'search'),
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
            'title' => 'Заголовок',
            'description' => 'Краткое описание',
            'text' => 'Текст',
            'photo' => 'Изображение',
            'active' => 'Доступна пользователям',
            'deleted' => 'Удалена',
            'time' => 'Время создания',
            'formatted_time' => 'Время публикации',
            'formatted_date' => 'Дата публикации',
            'delete_image' => 'Удалить изображения',
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
        $criteria->compare('text', $this->text, true);
        $criteria->compare('active', $this->active);
        $criteria->compare('deleted', $this->deleted);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
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

//    public function scopes() {
//        return array(
//            'active' => array(
//                'condition' => 'active='
//            ),
//        );
//    }

}

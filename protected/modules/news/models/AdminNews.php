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
 * @property string $formatted_time
 * @property string $formatted_date
 */
class AdminNews extends AdmActiveRecord {

    public $photo_file;
    public $delete_image;
    
    public $ft;
    public $fd;
    public $formatted_time;
    public $formatted_date;

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
            array('title, text', 'required'),
            array('title, description', 'length', 'max' => 200),
            array('photo', 'length', 'max' => 50),
            array('photo_file', 'file', 'allowEmpty' => true, 'maxFiles' => 1, 'maxSize' => 2097152/* 2M */, 'types' => 'jpg,jpeg,png,gif'),
            array('active, delete_image', 'boolean'),
            array('time', 'default', 'setOnEmpty' => true, 'value' => new CDbExpression('NOW()'), 'on'=>'insert'),
            array('formatted_time', 'date', 'format' => 'HH:mm:ss', 'timestampAttribute'=>'ft', 'on'=>'change_time'),
            array('formatted_date', 'date', 'format' => 'dd.MM.yyyy', 'timestampAttribute'=>'fd', 'on'=>'change_time'),
            array('formatted_time, formatted_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, description, text, photo, active, deleted, time', 'safe', 'on' => 'search'),
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
        $criteria->compare('description', $this->description, true);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('photo', $this->photo, true);
        $criteria->compare('active', $this->active);
        $criteria->compare('deleted', $this->deleted);
        $criteria->compare('time', $this->time, true);

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

    protected function beforeValidate() {
        if (!parent::beforeValidate()) {
            return false;
        }
        if ($this->photo_file = CUploadedFile::getInstance($this, 'photo_file')) {
            return true;
        }
        if (!$this->isNewRecord && 
                Yii::app()->dateFormatter->format('dd.MM.yyyy HH:mm:ss', $this->time) != $this->formatted_date . ' ' . $this->formatted_time
                ||
                $this->isNewRecord &&
                (!empty($this->formatted_date) || !empty($this->formatted_time))
                ) {
            $this->setScenario('change_time');
        }
        return true;
    }

    protected function beforeSave() {
        if (!parent::beforeSave()) {
            return false;
        }

        if ($this->photo_file) {
            if ($this->photo) {
                ImageHelper::delete($this->photo);
            }
            $this->photo = FileHelper::upload($this->photo_file);
        } elseif ($this->delete_image) {
            ImageHelper::delete($this->photo);
        }
        if ($this->ft || $this->fd) {
            if (!$this->ft) {
                Yii::app()->setTimeZone("Asia/Irkutsk");
                $this->ft = time();
            }
            echo date('d.m.Y H:i:s ', $this->ft);
            $this->ft -= strtotime('1 january this year');
            echo date('d.m.Y H:i:s ', $this->ft);
            if (!$this->fd) {
                $this->fd = strtotime('today');
            }
            $this->time = date('Y-m-d H:i:s', $this->fd + $this->ft);
        }
        return true;
    }
    
    protected function afterFind() {
        parent::afterFind();
        $this->formatted_date = Yii::app()->dateFormatter->format('dd.MM.yyyy', $this->time);
        $this->formatted_time = Yii::app()->dateFormatter->format('HH:mm:ss', $this->time);
    }

    public function getThumb() {
        return Yii::app()->params['filePath'] . Yii::app()->controller->module->id . '/' . $this->photo;
    }
    
//    public function getFormatted_time() {
//        return Yii::app()->dateFormatter->format('HH:mm:ss', $this->time);
//    }
//    public function getFormatted_date() {
//        return Yii::app()->dateFormatter->format('dd.MM.yyyy', $this->time);
//    }

}

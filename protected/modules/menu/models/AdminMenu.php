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
 * @property string $route
 * @property string $params
 * @property integer $model_id
 * @property integer $order
 * @property integer $level - уровень = уровень_родителя+1; если родитель=0, то уровень=1
 */
class AdminMenu extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{menu}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title', 'required'),
            array('parent, active', 'numerical', 'integerOnly' => true),
            array('alias', 'length', 'max' => 50),
            array('alias', 'default', 'value' => new CDbExpression('NULL'), 'setOnEmpty' => true),
            array('title', 'length', 'max' => 150),
            array('route', 'length', 'max' => 150),
            array('params', 'length', 'max' => 200),
            array('outer_link', 'url'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, alias, title, parent, active, deleted, order', 'safe', 'on' => 'search'),
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
            'alias' => 'псевдоним',
            'title' => 'заголовок',
            'parent' => 'родитель',
            'active' => 'активно',
            'module' => 'модуль',
            'controller' => 'модель',
            'action' => 'Action',
            'model_id' => 'страница',
            'order' => 'порядок',
            'level' => 'уровень вложенности',
            'route' => 'путь',
            'params' => 'параметры ссылки',
            'outer_link' => 'внешняя ссылка',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('alias', $this->alias, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('parent', $this->parent);
        $criteria->compare('active', $this->active);
        $criteria->compare('deleted', $this->deleted);
//        $criteria->compare('module', $this->module, true);
//        $criteria->compare('controller', $this->controller, true);
//        $criteria->compare('action', $this->action, true);
//        $criteria->compare('model_id', $this->model_id);
//        $criteria->compare('order', $this->order);
//        $criteria->compare('level', $this->order);

//        return new CActiveDataProvider($this, array(
//            'criteria' => $criteria,
//            'pagination' => array(
//                'pageSize' => 0,
//            ),
//        ));
        $rawData = $this->findAll($criteria);
        $rawDataSorted = array();
        $parent = array(0);
        while (count($rawData) > 0) {
            foreach($rawData as $key => $data) {
                if ($parent[count($parent)-1] == $data->parent) {
                    $rawDataSorted[] = $data;
                    $parent[] = $data->id;
                    unset($rawData[$key]);
                }
            }
            array_pop($parent);
        }
        return new CArrayDataProvider($rawDataSorted, array(
            'pagination' => array(
                'pageSize' => 0,
            ),
        ));
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

    /**
     * Элеммент выше текущего по списку
     * @param type $level
     * @param type $order
     * @return \AdminMenu
     */
    public function nearest_less() {
        $criteria = new CDbCriteria(array(
            'condition' => '`parent`=:parent && `level`=:level && `order`<:order',
            'params' => array(
                ':level' => $this->level, 
                ':order' => $this->order,
                ':parent' => $this->parent,
                ),
            'order' => '`order` DESC',
        ));
        $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }

    /**
     * Элеммент ниже текущего по списку
     * @param type $level
     * @param type $order
     * @return \AdminMenu
     */
    public function nearest_more() {
        $criteria = new CDbCriteria(array(
            'condition' => '`parent`=:parent && `level`=:level && `order`>:order',
            'params' => array(
                ':level' => $this->level, 
                ':order' => $this->order,
                ':parent' => $this->parent,
                ),
            'order' => '`order` ASC',
        ));
        $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }

    protected function beforeSave() {
        if ($this->parent == 0) {
            $this->level = 1;
        } else {
            $parent = $this->findByPk($this->parent);
            $this->level = $parent->level + 1;
        }
        if (is_numeric($this->params)) {
            $params = array('id' => $this->params);
            $this->params = CJSON::encode($params);
        } elseif (substr($this->params, 0, 1) != '{') {
            $array = explode('&', $this->params);
            foreach ($array as $param) {
                $param = explode('=', $param, 1);
                $params[$param[0]] = $params[$param[1]];
            }
            $this->params = CJSON::encode($params);
        }
        return parent::beforeSave();
    }

    protected function afterSave() {
        if ($this->isNewRecord) {
            $this->order = $this->id;
            $this->updateByPk($this->id, array('order' => $this->order));
        }
    }

    public function getLink() {
        if ($this->outer_link) {
            return $this->outer_link;
        }
        $params = !empty($this->params) ? CJSON::decode($this->params) : array();
        return Yii::app()->createUrl($this->route, $params);
    }

    public function getList($excludeId = null) {
        $criteria = new CDbCriteria();
        if ($excludeId) {
            $criteria->condition = '`deleted`=0 && `id`!=:id';
            $criteria->params = array(':id' => $excludeId);
        } else {
            $criteria->condition = '`deleted`=0';
        }
        $criteria->select = '`id`, `title`, `level`';
        $models = $this->findAll($criteria);
        for ($i = 0, $l = count($models); $i < $l; $i++) {
            $models[$i]->title = StringHelper::sameSymbols('-', $models[$i]->level - 1) . $models[$i]->title;
        }
        return CHtml::listData($models, 'id', 'title');
    }

    public function getModules() {
        $list = array();
        foreach (Yii::app()->modules as $key => $module) {
            if (is_int($key)) {
                
            } else {
                if (isset($module['menu_item']) && $module['menu_item']) {
                    $list[$key] = $module['shown_name'];
                }
            }
        }
        return $list;
    }

    public function getControllers() {
//        $list = array();
        $modules = $this->modules;
        foreach ($modules as $module => $title) {
            $alias = 'application.modules.' . $module . '.controllers';
            $dir = Yii::getPathOfAlias($alias);
            $nhdl = opendir($dir);
            $controllers = array();
            while ($nfile = readdir($nhdl)) {
                if (($nfile != ".") && ($nfile != "..") && $nfile != 'AdminController.php') {
                    $class = substr($nfile, 0, -4);
                    Yii::import($alias . '.' . $class);
                    $actions = array();
                    $nfile = substr($nfile, 0, -14);
                    $controller = strtolower(substr($nfile, 0, 1)) . substr($nfile, 1);
                    foreach (get_class_methods($class) as $method) {
                        if ($method != 'actions' && strpos($method, 'action') === 0) {
                            $action = substr($method, 6);
                            $action = strtolower(substr($action, 0, 1)) . substr($action, 1);
                            $actions["$module/$controller/$action"] = $action;
                        }
                    }
                    if (count($actions) == 0) {
                        continue;
                    }
                    $controllers[$controller] = $actions;
                }
            }
            closedir($nhdl);
            if (count($controllers) == 0) {
                unset($modules[$module]);
            } else {
                foreach ($controllers as $controller => $actions) {
                    if ($controller == 'default') {
//                        $modules[$module] = $actions;
                        $modules[$modules[$module]] = $actions;
                        unset($modules[$module]);
                        continue;
                    }
                    $modules[$module . '/' . $controller] = $actions;
                }
            }
        }
        return $modules;
    }

    public function defaultScope() {
        return array(
            'order' => '`level` ASC, `parent` ASC, `order` ASC',
//            'condition' => '',
        );
    }

}

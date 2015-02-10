<?php

class AdminController extends AdmController {

    public $modelName = 'AdminMenu';
    public $ajax_form_id = 'menu-form';

    public function accessRules() {
        $arr = array_merge(array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('moveUp', 'moveDown'),
                'users' => array('admin'),
            ),
                ), parent::accessRules());
        return $arr;
    }

    public function actionCreate($parent = null) {
        $model = new $this->modelName;
        $model->parent = $parent;

        $this->performAjaxValidation($model);

//            print_r($_POST);
//            die();
        if (isset($_POST[$this->modelName])) {
            $model->attributes = $_POST[$this->modelName];
            if ($model->save()) {
                $this->redirect(array('update', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionMoveUp($id) {
        $model = $this->loadModel($id);
        if ($model_neighbour = $model->nearest_less()->find()) {
            $ord = $model->order;
            $model->order = $model_neighbour->order;
            $model_neighbour->order = $ord;
            $model->save(false);
            $model_neighbour->save(false);
        }
        $this->redirect('admin');
    }

    public function actionMoveDown($id) {
        $model = $this->loadModel($id);
        if ($model_neighbour = $model->nearest_more()->find()) {
            $ord = $model->order;
            $model->order = $model_neighbour->order;
            $model_neighbour->order = $ord;
            $model->save(false);
            $model_neighbour->save(false);
        }
        $this->redirect('admin');
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Menu the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = AdminMenu::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}

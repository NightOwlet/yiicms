<?php

class DefaultController extends Controller {

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Question');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'model' => new Question,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Question;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Question'])) {
            $model->attributes = $_POST['Question'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success','Спасибо за вопрос!');
                if (Yii::app()->request->isAjaxRequest) {
                    echo Yii::app()->user->getFlash('success');
                    Yii::app()->end();
                } else {
                    $this->redirect(array('index'));
                }
            }
        }

        $this->renderPartial('_form', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Question the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Question::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'question-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}

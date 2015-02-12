<?php
/* @var $this QuestionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Вопрос-ответ',
);
?>

<h1>Вопрос-ответ</h1>
<div id="questionForm">
    <?php
    if (Yii::app()->user->hasFlash('success')) {
        echo Yii::app()->user->getFlash('success');
    } else {
        $this->renderPartial('_form', array('model' => $model));
    }
    ?>
</div>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>

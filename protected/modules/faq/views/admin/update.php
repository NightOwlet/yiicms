<?php
/* @var $this QuestionController */
/* @var $model Question */

$this->breadcrumbs=array(
	'Вопрос-ответ'=>array('админ'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Все вопросы', 'url'=>array('admin')),
);
?>

<h1>Вопрос №<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
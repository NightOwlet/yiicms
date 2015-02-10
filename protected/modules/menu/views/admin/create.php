<?php
/* @var $this MenuController */
/* @var $model Menu */

$this->breadcrumbs=array(
	'Меню'=>array('admin'),
	'Добавиьт пункт',
);

$this->menu=array(
	array('label'=>'Пункты меню', 'url'=>array('admin')),
);
?>

<h1>Добавиьт пункт меню</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
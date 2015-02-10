<?php
/* @var $this MenuController */
/* @var $model Menu */

$this->breadcrumbs=array(
	'Меню'=>array('admin'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Добавить пункт', 'url'=>array('create')),
	array('label'=>'Меню', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->title; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
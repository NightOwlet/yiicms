<?php
$this->breadcrumbs=array(
	'Администрирование'=>array('/admin'),
	'Блоки'=>array('admin'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Добавить блок','url'=>array('create')),
	array('label'=>'Все блоки','url'=>array('admin')),
);
?>

<h1><?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
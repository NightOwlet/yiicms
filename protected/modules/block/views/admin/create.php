<?php
$this->breadcrumbs=array(
	'Администрирование'=>array('/admin'),
	'Блоки'=>array('admin'),
	'Создание',
);

$this->menu=array(
	array('label'=>'Все блоки','url'=>array('admin')),
);
?>

<h1>Создание блока</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
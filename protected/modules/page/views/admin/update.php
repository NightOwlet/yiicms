<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs = array(
    'Страницы' => array('admin'),
    $model->title,
);

$this->menu=array(
	array('label'=>'Создать страницу', 'url'=>array('create')),
	array('label'=>'Все страницы', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->title; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
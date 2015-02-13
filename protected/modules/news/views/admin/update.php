<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs = array(
    'Новости' => array('admin'),
    $model->title,
);

$this->menu=array(
	array('label'=>'Добавить новость', 'url'=>array('create')),
	array('label'=>'Все новости', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->title; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs = array(
    'Новости' => array('admin'),
    'Создание'
);

$this->menu=array(
	array('label'=>'Все новости', 'url'=>array('admin')),
);
?>

<h1>Добавление новости</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
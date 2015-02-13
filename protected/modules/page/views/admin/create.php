<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs = array(
    'Страницы' => array('admin'),
    'Создание'
);

$this->menu=array(
	array('label'=>'Все страницы', 'url'=>array('admin')),
);
?>

<h1>Добавление новости</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
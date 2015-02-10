<?php
/* @var $this MenuController */
/* @var $model Menu */

$this->breadcrumbs = array(
    'Меню',
);

$this->menu = array(
    array('label' => 'Добавить пункт меню', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#menu-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Пункты меню</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$iconsUrl =  Yii::app()->request->getBaseUrl(true) . '/inc/glyplicons';
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'menu-grid',
    'dataProvider' => $model->search(),
    'filter' => null,
    'columns' => array(
//        'id',
        array(
            'name' => 'title',
            'value' => 'StringHelper::sameSymbols("—", $data->level-1).$data->title',
        ),
//        'alias',
//        'parent',
//        'active',
        array(
            'name' => 'route',
            'value' => '$data->link',
        ),
        /*
          'model_id',
          'order',
         */
        array(
            'class' => 'ButtonColumn',
            'template' => '{add} {move_up} {move_down} {update} {delete}',
            'buttons' => array(
                'add' => array(
                    'label' => 'Добавить подпункт',
                    'imageUrl' => $iconsUrl . '/glyphicons-433-plus.png',
                    'url' => 'Yii::app()->createUrl("/menu/admin/create", array("parent"=>$data->id))',
                ),
                'move_up' => array(
                    'label' => 'Переместить вверх',
                    'imageUrl' => $iconsUrl . '/glyphicons-214-up-arrow.png',
                    'url' => 'Yii::app()->createUrl("/menu/admin/moveUp", array("id"=>$data->id))',
                ),
                'move_down' => array(
                    'label' => 'Переместить вниз',
                    'imageUrl' => $iconsUrl . '/glyphicons-213-down-arrow.png',
                    'url' => 'Yii::app()->createUrl("/menu/admin/moveDown", array("id"=>$data->id))',
                ),
            ),
        ),
    ),
));
?>

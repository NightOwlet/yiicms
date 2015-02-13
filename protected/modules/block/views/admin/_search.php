<?php
/* @var $this AdminBlockController */
/* @var $model AdminBlock */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <div class="row">
        <?php echo $form->label($model,'id'); ?>
        <?php echo $form->textField($model,'id',array('size'=>50,'maxlength'=>50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>200)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'show_title'); ?>
        <?php echo $form->textField($model,'show_title'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'content'); ?>
        <?php echo $form->textField($model,'content',array('size'=>60,'maxlength'=>500)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'active'); ?>
        <?php echo $form->textField($model,'active'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'deleted'); ?>
        <?php echo $form->textField($model,'deleted'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
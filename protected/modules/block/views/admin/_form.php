<?php
/* @var $this AdminBlockController */
/* @var $model AdminBlock */
/* @var $form CActiveForm */
$this->widget('ext.wysiwyg.Wysiwyg');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'block-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>true,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'id'); ?>
        <?php echo $form->textField($model,'id',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>200)); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'content'); ?>
        <?php echo $form->textArea($model,'content',array('rows' => 6, 'cols' => 50, 'class'=>'wysiwyg')); ?>
        <?php echo $form->error($model,'content'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'show_title'); ?>
        <?php echo $form->checkBox($model,'show_title'); ?>
        <?php echo $form->error($model,'show_title'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'active'); ?>
        <?php echo $form->checkBox($model,'active'); ?>
        <?php echo $form->error($model,'active'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
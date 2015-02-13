<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */

$this->widget('ext.wysiwyg.Wysiwyg');
?>

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'news-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => true,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        )
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'text'); ?>
        <div class="wysiwyg-wrapper">
        <?php echo $form->textArea($model, 'text', array('rows' => 6, 'cols' => 50, 'class'=>'wysiwyg')); ?>
        </div>
        <?php echo $form->error($model, 'text'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'active'); ?>
        <?php echo $form->checkBox($model, 'active'); ?>
        <?php echo $form->error($model, 'active'); ?>
    </div>

    <div class="row">
        <?php // echo $form->labelEx($model, 'deleted');  ?>
        <?php // echo $form->textField($model, 'deleted');  ?>
        <?php // echo $form->error($model, 'deleted');  ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить изменения'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
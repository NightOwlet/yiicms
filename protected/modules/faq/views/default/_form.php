<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
?>

<div class="form">
    <h2>Задать вопрос</h2>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'question-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableClientValidation' => true,
        'action' => array('create'),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'author'); ?>
        <?php echo $form->textField($model, 'author', array('size' => 60, 'maxlength' => 150)); ?>
        <?php echo $form->error($model, 'author'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'question'); ?>
        <?php echo $form->textArea($model, 'question', array('cols' => 45, 'rows' => 5)); ?>
        <?php echo $form->error($model, 'question'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::ajaxSubmitButton('Отправить', array('create'), array('update'=>'#questionForm')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
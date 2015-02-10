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
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'text'); ?>
        <div class="wysiwyg-wrapper">
        <?php echo $form->textArea($model, 'text', array('rows' => 6, 'cols' => 50, 'class'=>'wysiwyg')); ?>
        </div>
        <?php echo $form->error($model, 'text'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'photo'); ?>
        <?php if ($model->photo) : ?>
            <?php echo CHtml::image($model->thumb, '', array('width' => 200)); ?>
            <!--<br>-->
            <div class="row">
                <?php echo $form->labelEx($model, 'delete_image'); ?>
                <?php echo $form->checkBox($model, 'delete_image'); ?>
            </div>
        <?php endif; ?>
        <?php echo $form->fileField($model, 'photo_file', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'photo_file'); ?>
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

    <div class="row">
        <?php echo $form->labelEx($model, 'formatted_date'); ?>
        <?php
//        echo $model->formatted_date;
//        echo $model->formatted_time;
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
//            'name' => 'formatted_date',
            'attribute' => 'formatted_date', // атрибут модели
            'model' => $model,
            'value' => $model->formatted_date, // атрибут модели
            'language' => 'ru',
                // additional javascript options for the date picker plugin
//            'options' => array(
//                'showAnim' => 'fold',
//            ),
        ));
        ?> (по умолчанию - текущая дата)
        <?php // echo $form->textField($model, 'time'); ?>
        <?php echo $form->error($model, 'formatted_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'formatted_time'); ?>
        <?php
        $this->widget('CMaskedTextField', array(
            'model' => $model, // модель
            'attribute' => 'formatted_time', // атрибут модели
            'mask' => '99:99:99', // маска ввода
//            'charMap' => array('2' => '[012]', '3' => '[0123]', '5' => '012345'),
            'htmlOptions' => array('size' => 6)
        ));
        ?> (по умолчанию - текущее время)
        <?php echo $form->error($model, 'formatted_time'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить изменения'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
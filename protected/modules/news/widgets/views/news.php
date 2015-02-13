<div class="<?= $this->class ?>">
    <?php if ($this->title) : ?>
    <h2 class="module-title"><?= $this->title; ?></h2>
    <?php endif; ?>
    <?php foreach ($models as $model) : ?>
        <div class="news-item">
            <div class="date"><?= Yii::app()->dateFormatter->formatDateTime($model->time); ?></div>
            <div class="title"><?= CHtml::link($model->title, array('/news/default/view', 'id'=>$model->id)); ?></div>
            <div class="short-text"><?= $model->description; ?></div>
        </div>
    <?php endforeach; ?>
    <?php if ($this->hasReadmore) : ?>
    <div class="readmore"><?= CHtml::link($this->readmoreText, array('/news/default/index')); ?></div>
    <?php endif; ?>
</div>
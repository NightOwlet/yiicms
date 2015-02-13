<?php /* @var $this ShowBlock */ ?>
<?php if ($this->hasWrapper) : ?>
<div class="module-block <?= $this->wrapperClass; ?>">
<?php endif; ?>
    <?php if ($model->show_title) : ?>
    <h3><?= $model->title ?></h3>
    <?php endif; ?>
    <div class="module-content">
        <?= $model->content ?>
    </div>
<?php if ($this->hasWrapper) : ?>
</div>
<?php endif; ?>
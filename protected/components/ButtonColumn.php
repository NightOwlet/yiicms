<?php

class ButtonColumn extends CButtonColumn {

    public $template = '{view} {update} {delete} {restore}';
    public $viewButtonUrl = 'Yii::app()->controller->createUrl("default/view",array("id"=>$data->primaryKey))';
    public $restoreButtonLabel;
    public $restoreButtonImageUrl;
    public $restoreButtonUrl = 'Yii::app()->controller->createUrl("restore",array("id"=>$data->primaryKey))';
    public $restoreButtonOptions = array('class' => 'restore');

    public function init() {
        $this->initDefaultButtons();

        foreach ($this->buttons as $id => $button) {
            if (strpos($this->template, '{' . $id . '}') === false)
                unset($this->buttons[$id]);
            elseif (isset($button['click'])) {
                if (!isset($button['options']['class']))
                    $this->buttons[$id]['options']['class'] = $id;
                if (!($button['click'] instanceof CJavaScriptExpression))
                    $this->buttons[$id]['click'] = new CJavaScriptExpression($button['click']);
            }
        }

        $this->registerClientScript();
    }

    protected function initDefaultButtons() {
        $baseUrl = Yii::app()->request->getBaseUrl(true) . '/inc/glyplicons';
        if ($this->viewButtonLabel === null)
            $this->viewButtonLabel = Yii::t('zii', 'View');
        if ($this->updateButtonLabel === null)
            $this->updateButtonLabel = Yii::t('zii', 'Update');
        if ($this->deleteButtonLabel === null)
            $this->deleteButtonLabel = Yii::t('zii', 'Delete');
        if ($this->restoreButtonLabel === null)
            $this->restoreButtonLabel = Yii::t('zii', 'Restore');
        if ($this->viewButtonImageUrl === null)
            $this->viewButtonImageUrl = $baseUrl . '/glyphicons-52-eye-open.png';
        if ($this->updateButtonImageUrl === null)
            $this->updateButtonImageUrl = $baseUrl . '/glyphicons-31-pencil.png';
        if ($this->deleteButtonImageUrl === null)
            $this->deleteButtonImageUrl = $baseUrl . '/glyphicons-208-remove-2.png';
        if ($this->restoreButtonImageUrl === null)
            $this->restoreButtonImageUrl = $baseUrl . '/glyphicons-436-undo.png';
        if ($this->deleteConfirmation === null)
            $this->deleteConfirmation = Yii::t('zii', 'Are you sure you want to delete this item?');

        foreach (array('view', 'update', 'delete', 'restore') as $id) {
            $button = array(
                'label' => $this->{$id . 'ButtonLabel'},
                'url' => $this->{$id . 'ButtonUrl'},
                'imageUrl' => $this->{$id . 'ButtonImageUrl'},
                'options' => $this->{$id . 'ButtonOptions'},
            );
            if (isset($this->buttons[$id]))
                $this->buttons[$id] = array_merge($button, $this->buttons[$id]);
            else
                $this->buttons[$id] = $button;
        }
        $this->buttons['view']['visible'] = '$data->active==1';
        $this->buttons['delete']['visible'] = '$data->deleted==0';
//        $this->buttons['restore']['visible'] = '$data->deleted==1';
        if (!isset($this->buttons['delete']['click'])) {
            if (is_string($this->deleteConfirmation))
                $confirmation = "if(!confirm(" . CJavaScript::encode($this->deleteConfirmation) . ")) return false;";
            else
                $confirmation = '';

            if (Yii::app()->request->enableCsrfValidation) {
                $csrfTokenName = Yii::app()->request->csrfTokenName;
                $csrfToken = Yii::app()->request->csrfToken;
                $csrf = "\n\t\tdata:{ '$csrfTokenName':'$csrfToken' },";
            } else
                $csrf = '';

            if ($this->afterDelete === null)
                $this->afterDelete = 'function(){}';

            $this->buttons['delete']['click'] = <<<EOD
function() {
	$confirmation
	var th = this,
		afterDelete = $this->afterDelete;
	jQuery('#{$this->grid->id}').yiiGridView('update', {
		type: 'POST',
		url: jQuery(this).attr('href'),$csrf
		success: function(data) {
			jQuery('#{$this->grid->id}').yiiGridView('update');
			afterDelete(th, true, data);
		},
		error: function(XHR) {
			return afterDelete(th, false, XHR);
		}
	});
	return false;
}
EOD;
        }
    }

}

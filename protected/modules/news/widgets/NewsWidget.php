<?php
Yii::import('application.modules.news.models.News');
class NewsWidget extends CWidget {
    public $count = 2;
    public $hasReadmore = true;
    public $readmoreText = 'Все новости';
    public $title = 'Последние новости';
    public $class = 'news';
    
    public function run() {
        $models = News::model()->recently($this->count)->findAll();
        if (count($models)>0) {
            $this->render('news', array('models'=>$models));
        }
    }
}

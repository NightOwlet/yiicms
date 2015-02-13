<?php /* @var $this Controller */
?><!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin.css" />

        <title>Администрирование</title>
    </head>
    <body>
        <div class="container" id="page">
            <div id="header">
                <div id="logo">Администрирование сайта <?php echo CHtml::encode(Yii::app()->name); ?></div>
            </div><!-- header -->

            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Меню', 'url' => array('/admin/menu')),
                        array('label' => 'Блоки', 'url' => array('/admin/block')),
                        array('label' => 'Новости', 'url' => array('/admin/news')),
                        array('label' => 'Страницы', 'url' => array('/admin/page')),
                        array('label' => 'Вопрос-ответ', 'url' => array('/admin/faq')),
                        array('label' => 'Вход на сайт', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Выход (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                    ),
                ));
                ?>
            </div><!-- mainmenu -->
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->breadcrumbs = array('Администрирование'=>'/admin') + $this->breadcrumbs;
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>
            <div class="span-19">
                <div id="content">
                    <?php echo $content; ?>
                </div><!-- content -->
            </div>
            <div class="span-5 last">
                <div id="sidebar">
                    <?php
                    $this->beginWidget('zii.widgets.CPortlet', array(
                        'title' => 'Операции',
                    ));
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => $this->menu,
                        'htmlOptions' => array('class' => 'operations'),
                    ));
                    $this->endWidget();
                    ?>
                </div><!-- sidebar -->
            </div>

            <div class="clear"></div>

            <div id="footer">
                Copyright &copy; 2015 ООО «Класс».<br/>
                Все права защищены.<br/>
                <?php echo Yii::powered(); ?>
            </div><!-- footer -->
        </div><!-- page -->

    </body>
</html>
<?php

class DefaultController extends AdmController
{
	public function actionIndex()
	{
		$this->render('index');
	}
}
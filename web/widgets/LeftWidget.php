<?php
namespace app\web\widgets;
use yii\base\Widget;

class LeftWidget extends Widget
{
	public $options;
	public function run() {
		return $this->render('leftwidget', [
			'options' => $this->options
			]);
	}
}
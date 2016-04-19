<?php
namespace app\web\widgets;
use yii\base\Widget;

class TopWidget extends Widget
{
	public $options;
	public function run() {
		return $this->render('topwidget', [
			'options' => $this->options
			]);
	}
}
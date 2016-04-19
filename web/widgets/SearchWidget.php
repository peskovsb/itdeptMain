<?php
namespace app\web\widgets;
use yii\base\Widget;

class SearchWidget extends Widget
{
	public $options;
	public function run() {
		return $this->render('searchwidget');
	}
}
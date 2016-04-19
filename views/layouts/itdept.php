<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\web\widgets\TopWidget;
use app\web\widgets\LeftWidget;
use app\web\widgets\SearchWidget;

AppAsset::register($this);

$this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="topWidget">
	<div class="wrapper">
		<a class="userProfile" href="#">
			<img src="<?=Yii::$app->getHomeUrl()?>imgs/user-alt-128.png">
			<span class=ToolT>
				<span class="ToolTinner">Профиль пользователя</span>
			</span>
		</a>
		<?= SearchWidget::widget();?>
		<?= TopWidget::widget([
			'options'=>[
				'Сотрудники' => 'contact',
				'Почта' => 'about',
				'Документы' => 'login',
				'Настройка системы' => '/',
				]
			]);
		?>
	</div>
</div>
<div class="leftWidget">
	<?= LeftWidget::widget([
		'options'=>[
				'WS' => [
					'link' => 'contact',
					'description' => 'Компьютерная техника'
				],
				'ORG' => [
					'link' => 'about',
					'description' => 'Орг. техника'
				],
				'WEB' => [
					'link' => 'login',
					'description' => 'Сеть'
				],
				'IP' => [
					'link' => './',
					'description' => 'IP адреса'
				],
				'MD' => [
					'link' => './',
					'description' => 'Модемы'
				],
				'TEL' => [
					'link' => './',
					'description' => 'Телефоны'
				],
				'SIM' => [
					'link' => './',
					'description' => 'Симкарты'
				],
			]
		]);
	?>
</div>
<div class="maincontainer">
	<div class="wrapper">
	<?= $content ?>
	</div>
</div>
	
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

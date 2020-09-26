<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Url;

$this->title = 'Chat';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php foreach($messages as $message) : ?>

    	<?php $isAdmin = $message->user->role->item_name == 'admin' ?? '' ?>
    	
		<div class="panel panel-default" <?= $isAdmin ? "style='border: 5px double red'" : '' ?>>
		  <div class="panel-heading">
		  	<?= $message->user->username ?>

		  	<span class="pull-right"><?= Yii::$app->formatter->asDate($message->created_at, "php:Y-m-d H:i:s") ?></span>
		  	<?php if ($showButton): ?>
		  	<a href="<?= Url::to(['/chat/off-message', 'id' => $message->id]) ?>" class="pull-right glyphicon glyphicon-off" title="Убрать сообщение" style="margin-right: 5px;cursor: pointer;"></a>
		  	<?php endif ?>
		  </div>
		  <div class="panel-body" <?= $message->status ? '' : "style='color: grey'" ?>><?= $message->text ?></div>
		</div>

	<?php endforeach; ?>

	<?php if (!Yii::$app->user->isGuest) : ?>
		<?php
		    $this->registerJs(
		        '$("document").ready(function(){
		            $("#new_message").on("pjax:end", function() {
		            	location.reload();
		       		});
		    });'
		    );
		?>
	
		<?php yii\widgets\Pjax::begin(['id' => 'new_message']) ?>
			<?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['data-pjax' => true]]); ?>
		
		        <?= $form->field($model, 'text')->textInput() ?>
		
		        <?= Html::submitButton('Send', ['class' => 'btn btn-success']) ?>
		
		    <?php ActiveForm::end(); ?>
		<?php Pjax::end(); ?>
	<?php endif; ?>
</div>

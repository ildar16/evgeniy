<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Messages;
use frontend\models\MessagesForm;
use yii\web\ForbiddenHttpException;

class ChatController extends \yii\web\Controller
{

    public function actionIndex()
    {

        $messagesModel = new Messages();
        $showButton = false;
        
        if (Yii::$app->user->can('changeMessageStatus')) {
        	$messages = $messagesModel->find()->with('user')->all();
        	$showButton = true;
        } else {
        	$messages = $messagesModel->find()->with('user')->where(['status' => 1])->all();
        }
        
		
        $model = new MessagesForm();
		if (Yii::$app->user->can('sendMessage')) {
        	if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	    header('Location: .');
        	}
		}

        return $this->render('index', [
            'messages' => $messages,
            'model' => $model,
            'showButton' => $showButton,
        ]);
    }

    public function actionOffMessage($id)
    {
    	if (Yii::$app->user->can('changeMessageStatus')) {
    		$messagesModel = new Messages();
    		$message = $messagesModel->find()->where(['id' => $id])->one();
    		$message->status = 0;
    		$message->save(false);

            return $this->redirect(Yii::$app->request->referrer);
    	} else {
    		throw new ForbiddenHttpException('Access denied');
    	}
    }

}

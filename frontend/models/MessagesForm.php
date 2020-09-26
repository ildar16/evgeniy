<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\Messages;


class MessagesForm extends Model
{
	public $user_id;
	public $text;

	public function rules()
    {
        return [
            [['text'], 'required'],
        ];
    }

    public function save()
    {
    	if (!$this->validate()) {
            return null;
        }

        $messages = new Messages();
        $messages->user_id = Yii::$app->user->identity->id;
        $messages->text = $this->text;
        $messages->save(false);
    }
}
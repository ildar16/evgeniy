<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\User;


class UserForm extends Model
{
	public $username;
	public $role;

	public function rules()
    {
        return [
            [['username', 'role'], 'required'],
        ];
    }

    public function save()
    {
    	if (!$this->validate()) {
            // return null;
        }

        $user = new User();
dd(11);
    }
}
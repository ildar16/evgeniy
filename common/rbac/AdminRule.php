<?php
namespace common\rbac;

class AdminRule extends yii\rbac\Rule
{
    public $name = 'isAadmin';

    public function execute($user, $item, $params)
    {
        return isset($params['news']) ? $params['news']->user_id == $user : false;
    }
}
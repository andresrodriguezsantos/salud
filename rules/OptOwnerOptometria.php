<?php

namespace app\rules;

use app\models\optometria\Optometria;

class OptOwnerOptometria extends \yii\rbac\Rule
{

    public $name = 'isOwnerOptometria';

    /**
     * Executes the rule.
     *
     * @param string|integer $user the user ID. This should be either an integer or a string representing
     * the unique identifier of a user. See [[\yii\web\User::id]].
     * @param \yii\rbac\Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to [[ManagerInterface::checkAccess()]].
     * @return boolean a value indicating whether the rule permits the auth item it is associated with.
     */
    public function execute($user, $item, $params)
    {
        /** @var Optometria[] $params */
        if (isset($params['optometria'])) {
            return $params['optometria']->historia->profesional->idusuario == $user;
        }

        return true;
    }
}
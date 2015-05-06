<?php
/**
 * Created by PhpStorm.
 * User: jhon
 * Date: 5/05/15
 * Time: 11:07 PM
 */

namespace app\rules;


use app\models\Historia;
use yii\rbac\Item;
use yii\rbac\Rule;

class HisOwnerUser extends Rule{


    public $name = 'HisOwnerUser';
    /**
     * Executes the rule.
     *
     * @param string|integer $user the user ID. This should be either an integer or a string representing
     * the unique identifier of a user. See [[\yii\web\User::id]].
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to [[ManagerInterface::checkAccess()]].
     * @return boolean a value indicating whether the rule permits the auth item it is associated with.
     */
    public function execute($user, $item, $params)
    {
        /** @var $params Historia[]  */
        if(isset($params['Historia']) ){
            return $params['Historia']->paciente->idusuario == $user;
        }
        return false;
    }
}
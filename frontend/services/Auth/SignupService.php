<?php
/**
 * Created by PhpStorm.
 * User: iskat
 * Date: 04.03.2018
 * Time: 22:43
 */

namespace frontend\services\Auth;


use common\models\User;
use frontend\models\SignupForm;

class SignupService
{

    /**
     * @param SignupForm $form
     * @return User
     */
    public function signup(SignupForm $form): User
    {


        $user = User::signup(
            $form->username,
            $form->email,
            $form->password

        );
        if (!$user->save()){
            throw new \runtimeException('Saving error. ');
        }
        return $user;
    }

}
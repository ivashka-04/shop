<?php
/**
 * Created by PhpStorm.
 * User: iskat
 * Date: 19.03.2018
 * Time: 11:16
 */

namespace frontend\controllers\auth;

use Yii;
use yii\web\Controller;
use shop\forms\auth\LoginForm;

class AuthController extends Controller
{


    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
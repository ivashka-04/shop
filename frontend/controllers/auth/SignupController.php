<?php
/**
 * Created by PhpStorm.
 * User: iskat
 * Date: 23.03.2018
 * Time: 19:20
 */

namespace frontend\controllers\auth;


use yii\web\Controller;
use shop\forms\auth\SignupForm;
use Yii;

class SignupController extends Controller
{

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = (new SignupService())->signup($model);
            if (Yii::$app->getUser()->login($user)) {
                return $this->goHome();
            }

        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

}
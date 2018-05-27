<?php
/**
 * Created by PhpStorm.
 * User: iskat
 * Date: 19.03.2018
 * Time: 11:30
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use shop\forms\ContactForm;

class ContactController extends Controller
{
    /**
     * Displays contact page.
     *
     * @return mixed
     */

    public function actionIndex()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }



}
<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 16-11-27
 * Time: 下午6:44
 */

namespace backend\controllers;
use yii\web\Controller;
use backend\models\User;

class UserinfoController extends Controller {
    public function actionIndex() {
        $model = new User();
        $userInfo = $model->getUserInfo();
        return $this->render('index',['userInfo' => $userInfo]);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 16-11-17
 * Time: 下午3:31
 */
namespace backend\controllers;
use yii\web\Controller;
use Yii;

class CommonController extends Controller {
    public function init() {
        if(empty(Yii::$app->session->get('isLogin'))) {
            return $this->redirect('/admin/site/login');
        }
    }
}
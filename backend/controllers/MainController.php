<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 16-11-17
 * Time: 下午12:33
 */
namespace backend\controllers;
use backend\controllers\CommonController;
/*use yii\filters\VerbFilter;
use yii\filters\AccessControl;*/
//use yii\web\User;
use Yii;

class MainController extends CommonController {

/*    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','reg'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }*/

    /**
     * @return string
     * 后台主页
     */
    public function actionIndex() {
        return $this->render('index');
    }


}
<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\User;
//use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','reg','index','logout'],
                        'allow' => true,
                    ],
 /*                   [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],*/
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    /**
     * 用户登录
     */
    public function actionLogin()
    {
        $model = new User();
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if($model->login($post)) {
                return $this->redirect(['main/index']);
            } else {
                Yii::$app->session->setFlash('info','用户名不存在或密码错误');
            }
        }
        return $this->render('login',['model' => $model]);
    }

    /**
     * 用户注册
     *
     */
    public function actionReg() {
        $model = new User();
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if($model->setAdmin($post)) {
                Yii::$app->session->setFlash('info','注册成功');
            } else {
                Yii::$app->session->setFlash('info','注册失败');
            }
        }
        return $this->render('reg',['model' => $model]);
    }

    /**
     * @return \yii\web\Response
     * 用户退出
     */
    public function actionLogout() {
        Yii::$app->session->destroy();
        return $this->redirect('login');
    }
}

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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 用户登录
     */
    public function actionLogin()
    {
        $model = new User();
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
//                var_dump($datas);
                Yii::$app->session->setFlash('info','注册失败');
//                echo $info;
            }
        }
        return $this->render('reg',['model' => $model]);
    }
}

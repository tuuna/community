<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 16-11-27
 * Time: 下午6:44
 */

namespace backend\controllers;
use backend\controllers\CommonController;
use backend\models\User;
use Yii;
use yii\data\Pagination;

class UserinfoController extends CommonController {
    public function actionIndex() {
        $query = User::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 10]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }

    public function actionAdd() {
        $model = new User();
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if($model->setAdmin($post)) {
                $this->redirect('index');
            } else {
                Yii::$app->session->setFlash('info','添加失败');
            }
        }

        return $this->render('add',['model' => $model]);
    }

    public function actionDel() {
        if(Yii::$app->request->isGet) {
            $model = User::findOne(Yii::$app->request->get()['id']);
            $model->delete() ?
                $this->redirect('index'):
                Yii::$app->session->setFlash('info','删除失败');
        }
    }
}
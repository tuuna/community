<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 16-11-28
 * Time: 上午10:41
 */

namespace backend\controllers;
use backend\controllers\CommonController;
use common\models\Category;
use Yii;

class CategoryController extends CommonController {
    public function actionIndex() {
        $model = new Category();
        $cateInfo = $model->cateInfo();
        return $this->render('index',['cateInfo' => $cateInfo]);
    }

    public function actionAdd() {
        $model = new Category();
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $model->addCate($post) ?
                $this->redirect('index') :
                Yii::$app->session->setFlash('info','添加分类失败');
        }

        return $this->render('add',['model' => $model]);
    }

    public function actionModify() {
        $model = new Category();
    }

    public function actionDel() {
        if(Yii::$app->request->isGet) {
            $model = Category::findOne(Yii::$app->request->get()['id']);
            $model->delete() ?
                $this->redirect('index'):
                Yii::$app->session->setFlash('info','删除失败');
        }
    }
}
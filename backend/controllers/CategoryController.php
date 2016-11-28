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
use yii\data\Pagination;

class CategoryController extends CommonController {
    public function actionIndex() {
        $query = Category::find();
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
        $id = Yii::$app->request->get()['id'];
        $cateInfo = $model->find()->where(['cateid' => $id])->one();
//        $data['Category']['catename'] = Yii::$app->request->post();
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $model->updateCate($post) ?
                $this->redirect('index') :
                Yii::$app->session->setFlash('info','修改失败');
        }

        return $this->render('modify',['cateInfo' => $cateInfo,'model' => $model]);
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
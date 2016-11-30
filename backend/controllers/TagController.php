<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 16-11-30
 * Time: 上午8:14
 */
namespace backend\controllers;
use backend\controllers\CommonController;
use yii\data\Pagination;
use Yii;
use common\models\Tag;

class TagController extends CommonController {
    public function actionIndex() {
        $query = Tag::find();
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
        $model = new Tag();
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if($model->addTags($post)) {
                Yii::$app->session->setFlash('info','添加成功');
                $this->redirect('index');
            } else {
                Yii::$app->session->setFlash('info','添加失败');
            }
        }
        return $this->render('add',['model' => $model]);
    }

    public function actionModify() {
        $model = new Tag();
        $id = Yii::$app->request->get()['id'];
        $tagInfo = $model->find()->where(['tagid' => $id])->one();
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $model->updateTag($post) ?
                $this->redirect('index') :
                Yii::$app->session->setFlash('info','修改失败');
        }

        return $this->render('modify',['tagInfo' => $tagInfo,'model' => $model]);
    }

    public function actionDel() {
        if(Yii::$app->request->isGet) {
            $model = Tag::findOne(Yii::$app->request->get()['id']);
            $model->delete() ?
                $this->redirect('index'):
                Yii::$app->session->setFlash('info','删除失败');
        }
    }
}
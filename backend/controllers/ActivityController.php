<?php
namespace backend\controllers;
use backend\controllers\CommonController;
use common\models\Activity;
use common\models\Tag;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use Yii;
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 16-11-28
 * Time: 下午8:23
 */

class ActivityController extends CommonController {

    public function actionIndex() {

        $query = Tag::find()->joinWith('tag');
        //$q = $query->where('activity_tag.tagid = :tagid' ,[':tagid' => 1])->all();
        //var_dump($q);
//        $activity = new Activity();
//        $tag = new Tag();
//        $data = $tag->find()->all();
//        $activity = link('tags',$tag);
//        $data = $activity->find()->all();
        /*$countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 10]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();*/
//        return $this->render('index', [
//            'models' => $models,
//            'pages' => $pages,
//        ]);
    }

    public function actionAdd() {
        $model = new Activity();
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if($model->addActivity($post)) {
                return $this->redirect('index');
            } else {
                Yii::$app->session->setFlash('info','添加失败');
            }
        }

        return $this->render('add',['model' => $model]);
    }

    public function actionModify() {
        $model = new Activity();
        $id = Yii::$app->request->get()['id'];
        $acInfo = $model->find()->where(['acid' => $id])->one();
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $model->updateActivity($post) ?
                $this->redirect('index') :
                Yii::$app->session->setFlash('info','修改失败');
        }

        return $this->render('modify',['acInfo' => $acInfo,'model' => $model]);
    }

    public function actionDel() {
        if(Yii::$app->request->isGet) {
            $model = Activity::findOne(Yii::$app->request->get()['id']);
            $model->delete() ?
                $this->redirect('index'):
                Yii::$app->session->setFlash('info','删除失败');
        }
    }
}
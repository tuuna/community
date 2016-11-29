<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 16-11-29
 * Time: 下午6:15
 */

namespace backend\controllers;
use backend\controllers\CommonController;
use common\models\Official;
use yii\data\Pagination;
use Yii;

class OfficialController extends CommonController {

    public function actionIndex() {
        $query = Official::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 10]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('offid DESC,status ASC')
            ->all();
        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }

    public function actionAdd() {
        $model = new Official();
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $model->addOfficial($post) ?
                $this->redirect('index') :
                Yii::$app->session->setFlash('info','添加失败');
        }
        return $this->render('add',['model' => $model]);
    }

    public function actionCheck() {
        $model = new Official();
        if(Yii::$app->request->isGet) {
            $id = Yii::$app->request->get()['id'];
            if($model->checkStatus($id)) {
                $this->redirect('index');
                Yii::$app->session->setFlash('info','审核完成');
            } else {

                Yii::$app->session->setFlash('info','审核失败');
            }
        }

    }

    public function actionModify() {
        $model = new Official();
        $id = Yii::$app->request->get()['id'];
        $offInfo = $model->find()->where(['offid' => $id])->one();
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $model->updateOfficial($post) ?
                $this->redirect('index') :
                Yii::$app->session->setFlash('info','修改失败');
        }

        return $this->render('modify',['offInfo' => $offInfo,'model' => $model]);
    }

    public function actionDel() {
        if(Yii::$app->request->isGet) {
            $model = Official::findOne(Yii::$app->request->get()['id']);
            $model->delete() ?
                $this->redirect('index'):
                Yii::$app->session->setFlash('info','删除失败');
        }
    }
}
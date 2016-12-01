<?php
namespace backend\controllers;
use backend\controllers\CommonController;
use common\models\Activity;
use common\models\Activity_tag;
use common\models\Tag;
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

        $query = Activity::find();
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
        /*$model = new Activity();
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if($model->addActivity($post)) {
                return $this->redirect('index');
            } else {
                Yii::$app->session->setFlash('info','添加失败');
            }
        }

        return $this->render('add',['model' => $model]);*/

        $model = new Activity();
        // 注意这里调用的是validate，非save,save我们放在了事务中处理了
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // 开启事务
            $transaction = Yii::$app->db->beginTransaction();
            try {
                /**
                 * current model save
                 */
                $model->save(false);
                // 注意我们这里是获取刚刚插入blog表的id
                $acId = $model->acid;
                /**
                 * batch insert category
                 * 我们在Blog模型中设置过category字段的验证方式是required,因此下面foreach使用之前无需再做判断
                 */
                $data = [];
                foreach ($model->tag as $k => $v) {
                    // 注意这里的属组形式[blog_id, category_id]，一定要跟下面batchInsert方法的第二个参数保持一致
                    $data[] = [$acId, $v];
                }
                // 获取BlogCategory模型的所有属性和表名
                $activityTag = new Activity_tag();
                $attributes = array_keys($activityTag->getAttributes());
                $tableName = $activityTag::tableName();
                // 批量插入栏目到BlogCategory::tableName()表,第一个参数是BlogCategory对应的数据表名，第二个参数是该模型对应的属性字段，第三个字段是我们需要批量插入到该模型的字段，记得第二个参数和第三个参数对应值一致哦
                Yii::$app->db->createCommand()->batchInsert(
                    $tableName,
                    $attributes,
                    $data
                )->execute();
                // 提交
                $transaction->commit();
                Yii::$app->session->setFlash('info','添加成功');
                return $this->redirect(['index']);
            } catch (Exception $e) {
                // 回滚
                $transaction->rollback();
                throw $e;
            }
        } else {
            return $this->render('add', [
                'model' => $model,
            ]);
        }
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
<?php
use yii\widgets\LinkPager;
?>
<div class="result-title">
    <div class="result-list">
        <a href="<?php echo yii\helpers\Url::to(['activity/add']);?>" class="btn btn-primary btn2">新增活动</a>
    </div>
    <div class="result-content">
        <table class="result-tab" width="100%">
            <tr>
                <th>活动主题</th>
                <th>活动地址</th>
                <th>活动时间</th>
                <th>活动内容</th>
                <th>点击量</th>
                <th>关注量</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            <?php foreach ($models as $activity) :?>
                <tr>
                    <td><?= $activity->title;?></td>
                    <td>
                        <?= $activity->address?>
                    </td>
                    <td>
                        <?= $activity->actime?>
                    </td>
                    <td>
                        <?= mb_substr($activity->content,0,20)?>
                    </td>
                    <td>
                        <?= $activity->click ?>
                    </td>
                    <td>
                        <?= $activity->like ?>
                    </td>
                    <td>
                        <?= Yii::$app->formatter->asDate($activity->created_at,'php:Y-m-d H:i:s')?>
                    </td>
                    <td>
                        <a class="link-update" href="<?= yii\helpers\Url::to(['activity/modify','id' => $activity->acid])?>">修改</a>
                        <a class="link-del" onclick="return confirm('您确定要删除吗?')" href="<?= yii\helpers\Url::to(['activity/del','id' => $activity->acid])?>">删除</a>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
        <div class="list-page">
            <?php echo LinkPager::widget([
                'pagination' => $pages,
            ])?>
        </div>
    </div>

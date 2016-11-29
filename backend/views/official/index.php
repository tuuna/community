<?php
use yii\widgets\LinkPager;
?>
<div class="result-title">
    <div class="result-list">
        <a href="<?php echo yii\helpers\Url::to(['official/add']);?>" class="btn btn-primary btn2">新增活动</a>
    </div>
    <div class="result-content">
        <table class="result-tab" width="100%">
            <tr>
                <th>活动号</th>
                <th>活动号邮箱</th>
                <th>活动号联系方式</th>
                <th>活动号负责人</th>
                <th>活动号状态</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            <?php foreach ($models as $official) :?>
                <tr>
                    <td><?= $official->offname;?></td>
                    <td>
                        <?= $official->offemail?>
                    </td>
                    <td>
                        <?= $official->offphone?>
                    </td>
                    <td>
                        <?= $official->manager?>
                    </td>
                    <td>
                        <?php if($official->status === 0) :?>
                            活动号待审核
                        <?php else :?>
                            活动号已激活
                        <?php endif;?>
                    </td>
                    <td>
                        <?= Yii::$app->formatter->asDate($official->created_at,'php:Y-m-d H:i:s')?>
                    </td>
                    <td>
                        <?php if ($official->status === 0): ?>
                            <a class="link-update" href="<?= yii\helpers\Url::to(['official/check','id' => $official->offid])?>">确认通过审核</a>
                        <?php else :?>
                            <a class="link-update" href="<?= yii\helpers\Url::to(['official/modify','id' => $official->offid])?>">修改</a>
                        <?php endif; ?>
                        <a class="link-del" onclick="return confirm('您确定要删除吗?')" href="<?= yii\helpers\Url::to(['official/del','id' => $official->offid])?>">删除</a>
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

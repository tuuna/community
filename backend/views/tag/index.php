<?php
use yii\widgets\LinkPager;
?>
<div class="result-title">
    <div class="result-list">
        <a href="<?php echo yii\helpers\Url::to(['tag/add']);?>" class="btn btn-primary btn2">新增分类</a>
    </div>
    <div class="result-content">
        <table class="result-tab" width="100%">
            <tr>
                <th>标签名</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            <?php foreach ($models as $tag) :?>
                <tr>
                    <td><?= $tag->tagcontent;?></td>
                    <td>
                        <?= Yii::$app->formatter->asDate($tag->created_at,'php:Y-m-d H:i:s')?>
                    </td>
                    <td>
                        <a class="link-update" href="<?= yii\helpers\Url::to(['tag/modify','id' => $tag->tagid])?>">修改</a>
                        <a class="link-del" onclick="return confirm('您确定要删除吗?')" href="<?= yii\helpers\Url::to(['tag/del','id' => $tag->tagid])?>">删除</a>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
        <div class="list-page">
            <?php echo LinkPager::widget([
            'pagination' => $pages,
            ])?></div>
    </div>

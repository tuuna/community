<div class="result-title">
    <div class="result-list">
        <a href="<?php echo yii\helpers\Url::to(['category/add']);?>" class="btn btn-primary btn2">新增分类</a>
    </div>
    <div class="result-content">
        <table class="result-tab" width="100%">
            <tr>
                <th>分类名</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            <?php foreach ($cateInfo as $cate) :?>
                <tr>
                    <td><?= $cate->catename;?></td>
                    <td>
                        <?= Yii::$app->formatter->asDate($cate->created_at,'php:Y-m-d H:i:s')?>
                    </td>
                    <td>
                        <a class="link-update" href="<?= yii\helpers\Url::to(['category/modify','id' => $cate->cateid])?>">修改</a>
                        <a class="link-del" onclick="return confirm('您确定要删除吗?')" href="<?= yii\helpers\Url::to(['category/del','id' => $cate->cateid])?>">删除</a>
                    </td>
                    <?php
                    if(Yii::$app->session->hasFlash('info')) {
                        echo Yii::$app->session->getFlash('info');
                    }
                    ?>
                </tr>
            <?php endforeach;?>
        </table>
        <div class="list-page">{$page}</div>
    </div>

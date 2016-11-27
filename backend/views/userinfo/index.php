<div class="result-title">
    <div class="result-list">
        <a href="<?php echo yii\helpers\Url::to(['userinfo/add']);?>" class="btn btn-primary btn2">新增用户</a>
    </div>
    <div class="result-content">
        <table class="result-tab" width="100%">
            <tr>
                <th>用户名</th>
                <th>学号</th>
                <th>邮件</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            <?php foreach ($userInfo as $user) :?>
            <tr>
                <td><?= $user->username;?></td>
                <td>
                    <?= $user->stuid?>
                <td>
                    <?= $user->email?>
                </td>
                <td>
                    <?= Yii::$app->formatter->asDate($user->created_at,'php:Y-m-d H:i:s')?>
                </td>
                <td>
                    <a class="link-update" href="<?= yii\helpers\Url::to(['userinfo/modify'])?>">修改</a>
                    <a class="link-del" onclick="return confirm('您确定要删除吗?')" href="<?= yii\helpers\Url::to(['userinfo/delete'])?>">删除</a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
        <div class="list-page">{$page}</div>
    </div>

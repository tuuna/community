<div class="result-wrap">
    <div class="result-title">
        <h1>系统基本信息</h1>
    </div>
    <div class="result-content">
        <ul class="sys-info-list">
            <li>
                <label class="res-lab">操作系统</label><span class="res-info"><?php echo php_uname('s');?></span>
            </li>
            <li>
                <label class="res-lab">PHP版本</label><span class="res-info"><?php echo PHP_VERSION;?></span>
            </li>
            <li>
                <label class="res-lab">PHP运行方式</label><span class="res-info"><?php echo php_sapi_name();?></span>
            </li>
            <li>
                <label class="res-lab">上传附件限制</label><span class="res-info">2M</span>
            </li>
            <li>
                <label class="res-lab">北京时间</label><span class="res-info"><?php echo date('Y-m-d h:i:sa');?></span>
            </li>
            <li>
                <label class="res-lab">服务器域名/IP</label><span class="res-info"><?php echo $_SERVER['REMOTE_ADDR'];?></span>
            </li>
            <li>
                <label class="res-lab">Host</label><span class="res-info"><?php echo $_SERVER['HTTP_HOST'];?></span>
            </li>
        </ul>
    </div>
</div>
<div class="result-wrap">
    <div class="result-title">
        <h1>使用帮助</h1>
    </div>
    <div class="result-content">
        <ul class="sys-info-list">
            <li>
                <label class="res-lab">有问题请联系管理员</label><span class="res-info">lj550566181@gmail.com</span>
            </li>

        </ul>
    </div>
</div>
</div>
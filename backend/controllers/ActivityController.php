<?php
use backend\controllers\CommonController;

/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 16-11-28
 * Time: 下午8:23
 */

class ActivityController extends CommonController {
    public function actionIndex() {
        return $this->render('index');
    }
}
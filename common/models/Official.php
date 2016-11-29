<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "official".
 *
 * @property integer $id
 * @property string $offname
 * @property string $offphone
 * @property string $idpic
 * @property string $offemail
 * @property string $manager
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Official extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'official';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['offname', 'offemail', 'manager'], 'required','message' => '该项不能为空','on' => ['addOfficial','updateOfficial']],
            [['offname', 'offemail'], 'unique','message' => '输入重复','on' => ['addOfficial','updateOfficial']],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['offname'], 'string', 'max' => 32],
            [['offphone'], 'string', 'max' => 60],
            [['idpic', 'offemail'], 'string', 'max' => 255],
            [['manager'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'offname' => '活动号名',
            'offphone' => '负责人手机号',
            'idpic' => 'Idpic',
            'offemail' => '活动号邮箱',
            'manager' => '负责人',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function addOfficial($data) {
        $this->scenario = 'addOfficial';
        if($this->load($data) && $this->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkStatus($data) {
        $new = $this->findOne($data);
        $new->status = 1;
        return $new->update();
    }
    
    public function updateOfficial($data) {
        $this->scenario = 'updateOfficial';
        $post = $this->findOne($data['Official']['offid']);
        $post->offname = $data['Official']['offname'];
        $post->offphone = $data['Official']['offphone'];
        $post->offemail = $data['Official']['offemail'];
        $post->manager = $data['Official']['manager'];
        $post->updated_at = time();
        if($post->save()) {
            return true;
        } else {
            return false;
        }
    }
}

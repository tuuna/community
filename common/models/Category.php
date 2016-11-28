<?php

namespace common\models;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $cateid
 * @property string $catename
 * @property integer $parentid
 * @property integer $created_at
 * @property integer $updated_at
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
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
            [['parentid', 'created_at', 'updated_at'], 'integer'],
//            [['created_at', 'updated_at'], 'required'],
            [['catename'], 'string', 'max' => 40,'message' => '分类名不能过长','on' => ['addCate','updateCate']],
            [['catename'], 'unique','message' => '分类名已存在','on' => ['addCate']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cateid' => 'Cateid',
            'catename' => '分类名',
            'parentid' => 'Parentid',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public  function cateInfo() {
        return $this->find()->all();
    }

    public function addCate($data) {
        $this->scenario = 'addCate';
        if($this->load($data) && $this->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateCate($data) {
        $this->scenario = 'updateCate';
        $datas = $this->findOne($data['Category']['cateid']);
        $datas->catename = $data['Category']['catename'];
        $datas->updated_at = time();
        if($datas->save()) {
            return true;
        } else {
            return false;
        }
    }


}

<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tag".
 *
 * @property integer $tagid
 * @property string $tagcontent
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
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
            [['tagcontent'], 'string', 'max' => 40],
            [['created_at','updated_at'],'integer'],
            ['tagcontent','required','message' => '标签名不能为空','on' =>['addTags','updateTag']],
            ['tagcontent','unique','message' => '标签名不能重复','on' => ['addTags','updateTag']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tagid' => 'Tagid',
            'tagcontent' => '标签名',
            'updated_at' => 'updateat',
        ];
    }

    /*public function getActivity() {
        return $this->hasMany(Activity::className(), ['acid' => 'acid']);
    }

    public function getActivity_tag() {
        return $this->hasMany(Activity_tag::className(),['tagid' => 'tagid']);
    }*/

    public function addTags($data) {
        $this->scenario = 'addTags';
        if($this->load($data) && $this->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateTag($data) {
        $this->scenario = 'updateOfficial';
        $post = $this->findOne($data['Tag']['tagid']);
        $post->tagcontent = $data['Tag']['tagcontent'];
        $post->updated_at = time();
        if($post->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function getActivity() {
        return $this->hasMany(Activity::className(), ['acid' => 'acid'])
            ->viaTable('activity_tag', ['acid' => 'id']);
    }

}

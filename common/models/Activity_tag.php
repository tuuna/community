<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "activity_tag".
 *
 * @property integer $acid
 * @property integer $tagid
 */
class Activity_tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['acid', 'tagid'], 'required'],
            [['acid', 'tagid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'acid' => 'Acid',
            'tagid' => 'Tagid',
        ];
    }

    public function getTag() {
        return $this->hasMany(Tag::className(),['tagid' => 'tagid']);
    }

    public function getActivity() {
        return $this->hasMany(Activity::className(),['acid' => 'acid']);
    }
}

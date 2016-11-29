<?php

namespace common\models;

use Yii;

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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tagcontent'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tagid' => 'Tagid',
            'tagcontent' => 'Tagcontent',
        ];
    }

    public function getActivity() {
        return $this->hasMany(Activity::className(), ['acid' => 'acid']);
    }

    public function getActivity_tag() {
        return $this->hasMany(Activity_tag::className(),['tagid' => 'tagid']);
    }
}

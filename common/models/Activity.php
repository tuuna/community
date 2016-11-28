<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property integer $acid
 * @property string $address
 * @property integer $actime
 * @property integer $exppeo
 * @property string $pic
 * @property string $content
 * @property integer $click
 * @property integer $like
 * @property integer $created_at
 * @property integer $updated_at
 */
class Activity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['actime', 'exppeo', 'click', 'like'], 'integer'],
            [['content'], 'string'],
            [['address'], 'string', 'max' => 60],
            [['pic'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'acid' => 'Acid',
            'address' => 'Address',
            'actime' => 'Actime',
            'exppeo' => 'Exppeo',
            'pic' => 'Pic',
            'content' => 'Content',
            'click' => 'Click',
            'like' => 'Like',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

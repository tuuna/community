<?php

namespace common\models;
use yii\behaviors\TimestampBehavior;
use common\models\Tag;
use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property integer $acid
 * @property string $title
 * @property string $address
 * @property string $actime
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
    public $tag;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity';
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
            [['exppeo', 'click', 'like'], 'integer'],
            [['content'], 'string'],
            [['actime'],'string','max' => 100],
            [['address'], 'string', 'max' => 60],
            [['pic'], 'string', 'max' => 100],
            ['title','required','message' => '需要输入活动标题'],
            ['title','unique','message' => '标题重复'],
            ['tag','safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'acid' => 'Acid',
            'title' => '活动主题',
            'address' => '活动地址',
            'actime' => '活动时间',
            'exppeo' => '预计人数',//预计人数
            'pic' => '图片地址',
            'content' => 'Content',
            'click' => '点击量',
            'like' => '关注量',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function addActivity($data) {
            $this->scenario = 'addActivity';
            if($this->load($data) && $this->save()) {
                return true;
            } else {
                return false;
            }
    }

    public function updateCate($data) {
        $this->scenario = 'updateActivity';
        $datas = $this->findOne($data['Activity']['acid']);
        $datas->title = $data['Activity']['title'];
        $datas->address = $data['Activity']['address'];
        $datas->actime = $data['Activity']['actime'];
        $datas->exppeo = $data['Activity']['exppeo'];
        $datas->content = $data['Activity']['content'];
        $datas->updated_at = time();
        if($datas->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function getTag() {
        return $this->hasMany(Tag::className(), ['tagid' => 'acid']);
    }


   /* public function getActivity_tag() {
        return $this->hasMany(Activity_tag::className(),['acid' => 'acid']);
    }*/

    /*public function getTag()
    {
        return $this->hasMany(Tag::className(), ['tagid' => 'tagid'])
            ->viaTable('activity_tag', ['acid' => 'acid']);
    }*/
}

<?php

namespace backend\models;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $stuid
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    public $password;
    CONST STATUS_ACTIVE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
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
            [['username', 'password','stuid', 'email'], 'required','on' => 'setAdmin'],
//            [['status', 'created_at', 'updated_at'], 'integer','on' => 'setAdmin'],
            [['username','password'],'required','on' => 'login'],
           /* ['auth_key','safe','on' => 'setAdmin'],
            ['password_hash','safe','on' => 'setAdmin'],*/
            [['username', 'auth_key'], 'string', 'max' => 32],
            [['password_hash',  'email'], 'string', 'max' => 255],
            [['stuid'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'stuid' => 'Student_id',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @param $data
     * @return bool
     * 用户注册
     */
    public function setAdmin($data) {
        $this->scenario = 'setAdmin';
        if($this->load($data) && $this->validate()) {
           $this->password_hash = $this->setPassword($data['User']['password']);
            $this->auth_key = Yii::$app->security->generateRandomString();
            if($this->save(false)) {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * 用户信息获取
     */
    public function getUserInfo() {
        return $this->find()->all();
    }

    /**
     * 用户登录
     */
    public function login($data) {
        $this->scenario = 'login';
        if($this->validateUser($data['User']['username'])) {
            if($this->validateStatus($data['User']['username']) && $this->validatePassword($data['User']['password'],$data['User']['username'])){
                $session = Yii::$app->session;
                $session['login_name'] = $data['User']['username'];
                $session['isLogin'] = 1;
                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }


    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param $user
     * @return bool
     * 验证用户是否存在
     */

    public function validateUser($user) {
        return (bool)User::find()->where(['username' => $user])->one();
    }


    /**
     * @param $user
     * @return mixed
     * 验证帐号是否可用
     */
    public function validateStatus($user) {
        return User::find()->where(['username' => $user])->one()->status;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password,$user)
    {
        return Yii::$app->security->validatePassword($password, $this->getPasswordHash($user));
    }

    public function getPasswordHash($user) {
        return $this->password_hash = User::find()->where(['username' => $user])->one()->password_hash;
    }
    public function setPassword($password)
    {
        return Yii::$app->security->generatePasswordHash($password);
    }
}

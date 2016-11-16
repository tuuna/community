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

    public function setAdmin($data) {
        $this->scenario = 'setAdmin';
        if($this->load($data) && $this->validate()) {
           $this->password_hash = $this->setPassword($data['User']['password']);
            $this->auth_key = Yii::$app->security->generateRandomString();
            if($this->save(false)) {
                return true;
            }

        } else {
//            return $this;
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }


    public function setPassword($password)
    {
        return Yii::$app->security->generatePasswordHash($password);
    }
}

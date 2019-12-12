<?php

namespace app\models;

use app\components\behaviors\ARCacheBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const EVENT_GENERATE_PASSWORD = 'generatePassword';
    const EVENT_SEND_EMAIL = 'sendEmail';

    public $password;

    public function init()
    {
        $this->on(self::EVENT_GENERATE_PASSWORD, [$this, 'generateRandomPassword']);
        $this->on(self::EVENT_SEND_EMAIL, [$this, 'sendEmail']);

        parent::init();
    }

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
            TimestampBehavior::class,
            ARCacheBehavior::class
        ];
    }

    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'password_reset_token', 'auth_key'], 'string'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param $password
     * @throws \yii\base\Exception
     */
    public function setPasswordHash($password)
    {
        $this->password_hash = \Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     *
     * @throws \yii\base\Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = \Yii::$app->security->generateRandomString();
    }

    /**
     * Generates random password
     *
     * @throws \yii\base\Exception
     */
    public function generateRandomPassword($event)
    {
        $this->password = \Yii::$app->security->generateRandomString(8);
    }

    /**
     * Send email to new user
     *
     * @param $event
     */
    public function sendEmail($event)
    {
        $body  = "<p>Login - {$this->username}</p>";
        $body .= "<p>Password - {$this->password}</p>";

        \Yii::$app->mailer->compose()
            ->setFrom('yii2calendar@domain.com')
            ->setTo($this->email)
            ->setSubject('User register data')
            ->setHtmlBody($body)
            ->send();
    }

    public static function findOne($condition)
    {
        $key = is_array($condition) ? serialize($condition) : $condition;

        if (\Yii::$app->cache->exists(self::class . "_" . $key)) {
            return \Yii::$app->cache->get(self::class . "_" . $key);
        } else {
            $result = parent::findOne($condition);
            \Yii::$app->cache->set(self::class . "_" . $key, $result);
            return $result;
        }
    }
}

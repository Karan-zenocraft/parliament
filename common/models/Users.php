<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\base\Security;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

class Users extends \common\models\base\UsersBase implements IdentityInterface
{

    const STATUS_ACTIVE = 1;
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->setAttribute('created_at', date('Y-m-d H:i:s'));
        }
        $this->setAttribute('updated_at', date('Y-m-d H:i:s'));

        return parent::beforeSave($insert);
    }
    public function rules()
    {
        return [
            [['role_id', 'status', 'age'], 'integer'],
            [['role_id', 'email', 'password', 'user_name', 'city', 'status', 'gender', 'age', 'education'], 'required'],
            [['created_at', 'updated_at', 'name', 'age'], 'safe'],
            [['email'], 'email'],
            [['years_hopr'], "number"],
            [['years_hopr', 'standing_commitee'], 'required', 'when' => function ($model) {
                return $model->role_id == Yii::$app->params['userroles']['user_agent'];
            }, 'whenClient' => "function (attribute, value) {
                return $('#users-role_id').val() == '" . Yii::$app->params['userroles']['user_agent'] . "';
            }", ],
            // ['age', 'is3NumbersOnly'],
            ['email', 'validateEmail'],
            //[['photo'], 'image', 'skipOnEmpty' => true, 'extensions' => 'jpg, jpeg, gif, png', 'on' => 'update'],

            [['email', 'password', 'user_name', 'education', 'city', 'standing_commitee'], 'string', 'max' => 255],
        ];
    }

    public function validateEmail()
    {
        $ASvalidateemail = Users::find()->where('email = "' . $this->email . '" and id != "' . $this->id . '"')->all();
        if (!empty($ASvalidateemail)) {
            $this->addError('email', 'This email address already registered.');
            return true;
        }
    }

    public function is3NumbersOnly($attribute)
    {
        if (!preg_match('/^[0-9]{3}$/', $this->$attribute)) {
            $this->addError($attribute, 'Invalid Age.');
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProjects()
    {
        return $this->hasMany(UserProjects::className(), ['user_id' => 'id']);
    }
    public function getFullName()
    {
        return $this->user_name . ' ' . $this->last_name;
    }

    /** INCLUDE USER LOGIN VALIDATION FUNCTIONS* */

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role',
            'email' => 'Email',
            'password' => 'Password',
            'user_name' => 'User Name',
            'status' => 'Status',
            'city' => 'Current City',
            'education' => 'Education',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'years_hopr' => 'Years in HOPR',
            'standing_commitee' => 'Standing Commitee',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['email' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return true;
        //return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Security::generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->verification_code = bin2hex(random_bytes(32));
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $user = new \common\models\Users;
        $user->password_reset_token = Security::generateRandomString() . '_' . time();
        return $user->password_reset_token;
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * Get list of all QA Users
     */
    public static function QaUsersDropDownArr()
    {

        $snQaUsers = ArrayHelper::map(Users::find()->where(['role_id' => Yii::$app->params['userroles']['qa'], 'status' => '1'])->asArray()->all(), 'id', function ($user) {
            return $user['user_name'];
        });
        return $snQaUsers;
    }
    //GET USER NAME BY ID//
    public static function get_user_name_by_id($id = '')
    {
        if (!empty($id)) {
            $snUserDetails = Users::find()->where(['id' => $id])->one();
        }
        return !empty($snUserDetails) ? $snUserDetails->user_name : '';
    }

}

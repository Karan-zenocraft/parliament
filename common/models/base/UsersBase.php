<?php

namespace common\models\base;

use common\models\UserRoles;
use common\models\Users;
use Yii;

/**
 * This is the model class for table "users".
 *
 * @property string $id
 * @property integer $role_id
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property UserRoles $role
 */
class UsersBase extends \yii\db\ActiveRecord
{
    /**
     *
     *
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     *
     *
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'status'], 'integer'],
            [['role_id', 'email', 'password', 'first_name', 'last_name', 'status'], 'required', 'on' => 'create'],
            [['role_id', 'email', 'first_name', 'last_name', 'status'], 'required', 'on' => 'update'],
            [['created_at', 'updated_at'], 'safe'],
            [['email'], 'email'],
            // ['email', 'validateEmail'],
            [['email', 'password', 'first_name', 'last_name'], 'string', 'max' => 255],
        ];
    }

    /*public function validateEmail()
    {
    $ASvalidateemail = Users::find()->where('email = "' . $this->email . '" and id != "' . $this->id . '"')->all();
    if (!empty($ASvalidateemail)) {
    $this->addError('email', 'This email address already registered.');
    return true;
    }
    }*/

    /**
     *
     *
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'email' => 'Email',
            'password' => 'Password',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     *
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(UserRoles::className(), ['id' => 'role_id']);
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->setAttribute('created_at', date('Y-m-d H:i:s'));
        } else {
            $this->setAttribute('updated_at', date('Y-m-d H:i:s'));
        }
        return parent::beforeSave($insert);
    }
}

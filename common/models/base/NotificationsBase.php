<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "notifications".
*
    * @property integer $id
    * @property integer $user_id
    * @property string $notification
    * @property string $created_at
    * @property string $updated_at
*/
class NotificationsBase extends \yii\db\ActiveRecord
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'notifications';
}

/**
* @inheritdoc
*/
public function rules()
{
        return [
            [['user_id', 'notification'], 'required'],
            [['user_id'], 'integer'],
            [['notification'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => 'ID',
    'user_id' => 'User ID',
    'notification' => 'Notification',
    'created_at' => 'Created At',
    'updated_at' => 'Updated At',
];
}
}
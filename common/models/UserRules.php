<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_rules".
 *
 * @property int $id
 * @property int $role_id
 * @property string $privileges_controller
 * @property string $privileges_actions
 * @property string $permission
 * @property string $permission_type
 */
class UserRules extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_rules';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id', 'privileges_controller', 'privileges_actions'], 'required'],
            [['role_id'], 'integer'],
            [['privileges_actions', 'permission'], 'string'],
            [['privileges_controller', 'permission_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'privileges_controller' => 'Privileges Controller',
            'privileges_actions' => 'Privileges Actions',
            'permission' => 'Permission',
            'permission_type' => 'Permission Type',
        ];
    }
}

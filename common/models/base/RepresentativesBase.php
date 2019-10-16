<?php

namespace common\models\base;

use common\models\RepresentativesQuery;
use Yii;

/**
 * This is the model class for table "representatives".
 *
 * @property integer $id
 * @property string $user_name
 * @property string $standing_commitee
 * @property string $photo
 */
class RepresentativesBase extends \yii\db\ActiveRecord
{
/**
 * @inheritdoc
 */
    public static function tableName()
    {
        return 'representatives';
    }

/**
 * @inheritdoc
 */
    public function rules()
    {
        return [
            [['user_name', 'standing_commitee'], 'required'],
            [['user_name', 'standing_commitee'], 'string', 'max' => 255],
            [['photo'], 'image', 'extensions' => 'jpg, jpeg, gif, png'],
        ];
    }

/**
 * @inheritdoc
 */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_name' => 'User Name',
            'standing_commitee' => 'Standing Commitee',
            'photo' => 'Photo',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\RepresentativesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RepresentativesQuery(get_called_class());
    }
}

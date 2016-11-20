<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ratings}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $picture_id
 * @property integer $rating
 * @property string $created_at
 *
 * @property Pictures $picture
 * @property User $user
 */
class Ratings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ratings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'picture_id', 'rating'], 'required'],
            [['user_id', 'picture_id', 'rating'], 'integer'],
            [['created_at'], 'safe'],
            [['picture_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pictures::className(), 'targetAttribute' => ['picture_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'picture_id' => 'Picture ID',
            'rating' => 'Rating',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPicture()
    {
        return $this->hasOne(Pictures::className(), ['id' => 'picture_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
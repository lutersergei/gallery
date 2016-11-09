<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * This is the model class for table "{{%image}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property integer $category_id
 * @property string $description
 * @property integer $views
 * @property integer $rating
 * @property string $created_at
 *
 * @property Category $category
 * @property User $user
 */
class Pictures extends \yii\db\ActiveRecord
{
    const IMAGE_DIR = '/upload/';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pictures}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category_id'], 'required'],
            [['user_id', 'category_id', 'views', 'rating'], 'integer'],
            [['created_at'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'name' => 'Name',
            'category_id' => 'Category ID',
            'description' => 'Description',
            'views' => 'Views',
            'rating' => 'Rating',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return string Full path to image
     */
    public function getPath()
    {
        return self::IMAGE_DIR . $this->name;
    }

    /**
     * @param $image UploadedFile
     * @return null|string name
     */
    public static function saveImage($image)
    {
        $image_dir = \Yii::getAlias('@webroot');

        $pictureFilename = $image_dir . '/' . 'upload' . '/' . $image->name;

        if ($image->saveAs($pictureFilename))
        {
            return $image->name;
        }
        else
        {
            return null;
        }
    }

    public static function getOneWithIncrement($id)
    {
        $image = self::find()->where(['id' => $id])->with('category')->one();
        $image->updateCounters(['views' => 1]);
        return $image;
    }

    /**
     * Increment count of view
     */
    public function countView()
    {
        $this->views++;
        $this->save();
    }
}

<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use frontend\controllers\FileController;

/**
 * This is the model class for table "{{%pictures}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property integer $category_id
 * @property string $description
 * @property integer $rating
 * @property string $created_at
 *
 * @property Category $category
 * @property User $user
 * @property Ratings[] $ratings
 * @property integer $average
 */
class Pictures extends \yii\db\ActiveRecord
{
    const IMAGE_DIR = '/upload/';
    const THUMB_DIR = '/thumbnails/';

    public $average;

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
            [['user_id', 'category_id', 'rating'], 'integer'],
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
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Ratings::className(), ['picture_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getPicturesWithAverage()
    {
        return static::find()
            ->select(['pictures.*, avg(ratings.rating) AS average'])
            ->leftJoin('ratings', 'ratings.picture_id = pictures.id')
            ->groupBy('pictures.id')
            ->with('ratings');
    }

    /**
     * @param $pictureId
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function getAverage($pictureId)
    {
        return static::find()
            ->select(['avg(ratings.rating) AS average'])
            ->leftJoin('ratings', 'ratings.picture_id = pictures.id')
            ->where(['pictures.id' => $pictureId])
            ->one();
    }

    /**
     * @return string Full path to image
     */
    public function getImagePath()
    {
        return static::IMAGE_DIR . $this->name;
    }

    /**
     * @return string Full path to image
     */
    public function getThumbPath()
    {
        return static::THUMB_DIR . $this->name;
    }

    /**
     * @param $image UploadedFile
     * @return null|string name
     */
    public static function saveImage($image)
    {
        $front= \Yii::getAlias('@webroot');

        $pictureFilename = $front . self::IMAGE_DIR . $image->name;

        $thumbFilename = $front . self::THUMB_DIR . $image->name;

        if ($image->saveAs($pictureFilename))
        {
            Image::thumbnail($pictureFilename, 400, 400)->save($thumbFilename, ['quality' => 80]);
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
//        $image->updateCounters(['views' => 1]);
        return $image;
    }

//    /**
//     * Increment count of view
//     */
//    public function countView()
//    {
//        $this->views++;
//        $this->save();
//    }

    /**
     * Delete image and thumb before delete from database
     *
     * @return bool
     */
    public function beforeDelete()
    {
        if (parent::beforeDelete() && FileController::actionDelete($this->name)) {
            return true;
        } else {
            return false;
        }
    }
}

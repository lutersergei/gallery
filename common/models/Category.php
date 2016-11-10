<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property integer $id
 * @property string $category
 * @property integer $count_pictures
 *
 * @property Pictures[] $images
 */
class Category extends \yii\db\ActiveRecord
{
    public $count_pictures;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category'], 'required'],
            [['category'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Pictures::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getCategoryWithCount()
    {
        $cat = self::find()
            ->select(['category.*, COUNT(pictures.id) AS count_pictures'])
            ->leftJoin(Pictures::tableName(), 'pictures.category_id = category.id')
            ->groupBy(['category.id']);
//        print_r($cat);
//        die();
        return $cat;
    }
}

<?php
namespace frontend\models;

use common\models\Image;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

/**
 * Image Upload Form
 */
class ImageUploadForm extends Model
{
    public $imageFile;
    public $description;
    public $category_id;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string', 'max' => 255],
            [['description'], 'trim'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'category_id' => 'Категория',
            'description' => 'Описание',
        ];
    }

    /**
     * @return Image|null
     */
    public function pictureUpload()
    {
        $image = new Image();
        $image->name = $this->imageFile;
        $image->category_id = $this->category_id;
        $image->description = $this->description;
        $image->user_id = Yii::$app->user->id;

        return $image->save() ? $image : null;
    }
}

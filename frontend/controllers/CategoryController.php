<?php
namespace frontend\controllers;

use common\models\Category;
use Yii;
use yii\web\Controller;
use yii\web\BadRequestHttpException;
use yii\web\Request;

/**
 * Category controller
 */
class CategoryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        ];
    }


    public static function actionAdd()
    {
        $post = Yii::$app->request->post();
        $newCategory = json_decode($post['category']);
        $category = new Category();
        $category->category = $newCategory->content;
        if ($category->save())
        {
            echo Yii::$app->db->getLastInsertID();
        }
        else
        {
            throw new BadRequestHttpException('Категория уже сужествует');
        }
    }
}

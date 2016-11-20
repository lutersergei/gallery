<?php
namespace frontend\controllers;

use common\models\Category;
use Yii;
use yii\web\Controller;
use yii\web\BadRequestHttpException;
use yii\web\Request;

/**
 * Rating controller
 */
class RatingController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        ];
    }


    public static function actionSend()
    {
        $post = Yii::$app->request->post();
        $picture = json_decode($post['picture']);
        $score = json_decode($post['score']);
        echo ("$picture . $score");
    }
}

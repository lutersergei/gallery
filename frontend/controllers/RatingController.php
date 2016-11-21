<?php
namespace frontend\controllers;

use common\models\Category;
use common\models\Ratings;
use Yii;
use yii\web\Controller;
use yii\web\BadRequestHttpException;
use yii\web\Request;
use common\models\Pictures;

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
        $pictureId = json_decode($post['pictureId']);
        $score = json_decode($post['score']);
        if (Ratings::setRating($score, $pictureId)) {
            $average = Pictures::getAverage($pictureId)->average;
            echo ($average ? round($average, 1) : 0);
        } else {
            echo ("error");
        }
    }
}

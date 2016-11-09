<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Pictures;
use yii\web\NotFoundHttpException;

/**
 * File controller
 */
class FileController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        ];
    }

    /**
     * @param $name
     * @return bool
     */
    public static function actionDelete($name)
    {
        $front= \Yii::getAlias('@webroot');

        $pictureFilename = $front . Pictures::IMAGE_DIR . $name;
        $thumbFilename = $front . Pictures::THUMB_DIR . $name;

        if (unlink($pictureFilename) && unlink($thumbFilename))
        {
            return true;
        }
        else return null;
    }

    /**
     * @return bool
     * @throws NotFoundHttpException
     */
    public function actionClearFolders()
    {
        $front= \Yii::getAlias('@webroot');
        $files = array_merge(glob($front . Pictures::IMAGE_DIR . '*'), glob($front . Pictures::THUMB_DIR . '*')) ;
        foreach ($files as $file)
        {
            if (is_file($file)) unlink($file);
        }
        return true;
    }
}

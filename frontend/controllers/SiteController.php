<?php
namespace frontend\controllers;

use common\models\Category;
use common\models\User;
use frontend\models\ImageUploadForm;
use Yii;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Pictures;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\web\ServerErrorHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'delete' => ['post'],
                    'update' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @param null Category
     * @return mixed
     */
    public function actionIndex($cat = null, $user = null)
    {

        if ($cat)
        {
            $images = Pictures::find()->where(['category_id' => $cat])->all();
        }
        elseif ($user)
        {
            $images = Pictures::find()->where(['user_id' => $user])->all();
        }
        else
        {
            $images = Pictures::find()->all();
        }
        $count_pictures = Pictures::find()->count();
        $this->layout = 'gallery.php';
        $categories = Category::getCategoriesWithCount()->all();
        $users = User::getUsersWithCount()->all();
        return $this->render('index', [
            'images' => $images,
            'categories' => $categories,
            'count_pictures' => $count_pictures,
            'users' => $users,
        ]);
    }

    /**
     * View one image
     *
     * @param null $id
     * @return mixed
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     */
    public function actionView($id = null)
    {
        if ($id) {
            $image = Pictures::getOneWithIncrement($id);
            if ($image) {
                return $this->render('view', [
                    'image' => $image,
                ]);
            } else {
                throw new NotFoundHttpException('Изображение не найдено');
            }
        } else {
            throw new BadRequestHttpException();
        }
    }

    /**
     * Adding image
     * If adding is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     * @throws ServerErrorHttpException
     */
    public function actionAddImage()
    {
        $model = new ImageUploadForm();
        $post = Yii::$app->request->post('ImageUploadForm');
        if (count($post)) {
            $image = UploadedFile::getInstance($model, 'imageFile');
            $imageName = Pictures::saveImage($image);
            if ($imageName) {
                $model->description = $post['description'];
                $model->category_id = $post['category_id'];
                $model->imageFile = $imageName;
                if ($model->pictureUpload()) {
                    Yii::$app->session->setFlash('success', "Изображение $imageName успешно загружено!");
                    return $this->refresh();
                } else {
                    throw new ServerErrorHttpException('Не удалось сохранить изображение');
                }
            } else {
                throw new ServerErrorHttpException('Не удалось загрузить изображение');
            }

        }

//        $type = FileHelper::getMimeType($picture->tempName); //TODO применить проверку на mime type
        $categories = Category::find()->select(['category', 'id'])->indexBy('id')->column();
        return $this->render('upload', [
            'model' => $model,
            'categories' => $categories,
        ]);
    }

    /**
     * Deletes an existing Image model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findImage($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionReset()
    {
        if (Pictures::deleteAll())
        {
            if (FileController::actionClearFolders())
            {
                Yii::$app->session->setFlash('success', 'БД и папки успешно очищены');
                return $this->redirect(['site/index']);
            }
        }
        else throw new NotFoundHttpException('БД уже очищена или произошла ошибка');
    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $image = $this->findImage($id);

        if ($image->load(Yii::$app->request->post()) && $image->save()) {
            return $this->redirect(['view', 'id' => $image->id]);
        } else {
            return $this->render('update', [
                'image' => $image,
            ]);
        }
    }

    /**
     * Finds the Image model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pictures the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findImage($id)
    {
        if (($model = Pictures::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
        }
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

}

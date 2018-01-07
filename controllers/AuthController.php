<?php
namespace app\controllers;

use app\models\SignupForm;
use app\models\User;
use yii\helpers\ArrayHelper;
use app\models\ArticleTag;
use app\models\Article;
use app\models\Category;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ImageUpload;
use yii\data\Pagination;
use yii\web\IdentityInterface;

class AuthController extends Controller
{
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if($model->signup())
            {
                return $this->redirect(['auth/login']);
            }
        }
        return $this->render('signup', ['model'=>$model]);
    }

    public function actionLoginVk($uid,$first_name,$photo)
    {
        $user =  new User();
        if($user->saveFromVk($uid,$first_name,$photo))
        {
            return $this->redirect(['site/index']);
        }
        return $this->redirect(['site/index']);
    }


    public function actionTest()
    {
        $user = User::findOne(1);
        Yii::$app->user->logout($user);
        if (Yii::$app->user->isGuest)
        {
            echo 'Гость';
        }
        else
        {
            echo 'Пользователь авторизован';
        }
    }



}
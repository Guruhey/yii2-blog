<?php

namespace app\controllers;

use app\models\CommentForm;
use app\models\Tag;
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
use app\models\Comment;

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
                'only' => ['logout'],
                'rules' => [
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
     * @return string
     */
    public function actionIndex()
    {
        $date = Article::getAll(1);
        $popular = Article::getPopular();
        $recent = Article::getRecent();
        $categories = Category::getAll();

        return $this->render('index',[
            'articles' => $date['articles'],
            'pagination' => $date['pagination'],
            'popular' => $popular,
            'recent' => $recent,
            'categories' => $categories
        ]);
    }


    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionView($id)
    {
        $article = Article::findOne($id);
        $mightlike = Article::find()->where(['category_id' => ($article->category_id)])->limit(6)->all();
        $tags = ArrayHelper::map($article->tags, 'id', 'title');

        $popular = Article::getPopular();
        $recent = Article::getRecent();
        $categories = Category::getAll();
        $comments = $article->getArticleComments();
        $commentForm =  new CommentForm();
        $article->viewedCounter();

        return $this->render('single',[
            'article' => $article,
            'mightlike' => $mightlike,
            'popular' => $popular,
            'recent' => $recent,
            'categories' => $categories,
            'tags' => $tags,
            'comments' => $comments,
            'commentForm' => $commentForm
        ]);
    }

    public function actionCategory($id)
    {
        $date = Category::getArticlesByCategory($id);

        $popular = Article::getPopular();
        $recent = Article::getRecent();
        $categories = Category::getAll();

        return $this->render('category',[
            'articles' => $date['articles'],
            'pagination' => $date['pagination'],
            'popular' => $popular,
            'recent' => $recent,
            'categories' => $categories
        ]);
    }

    public function actionTags($id)
    {
        $article = ArticleTag::find()->where(['article_id' => $id])->one();
        $query = ArticleTag::find()->where(['tag_id' => $article->tag_id])->all();
        $result = [];
        foreach ($query as $one)
        {
            $result[] =  Article::find()->where(['id' => $one['article_id']])->one();
        }

        $popular = Article::getPopular();
        $recent = Article::getRecent();
        $categories = Category::getAll();

        return $this->render('tags',[
            //'articles' => $date['articles'],
            //'pagination' => $date['pagination'],
            'popular' => $popular,
            'recent' => $recent,
            'articles' => $result,
            'categories' => $categories
        ]);
    }

    public function actionEdu()
    {
        return $this->render('test');
    }

    public function actionLearnScript()
    {
        return $this->render('learn');
    }

    public function actionComment($id)
    {
        $model = new CommentForm();

        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if($model->saveComment($id))
            {
                Yii::$app->getSession()->setFlash('comment', 'Your comment will be added soon!');
                return $this->redirect(['site/view','id'=>$id]);
            }
        }
    }
}

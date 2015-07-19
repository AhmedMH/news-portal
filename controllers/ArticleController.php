<?php

namespace app\controllers;

use Yii;
use app\models\Article;
use app\models\User;
use yii\data\Pagination;
use app\models\Uploader;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\helpers\StringHelper;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    public function behaviors()
    {
        return [     
         'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'delete','myarticles'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'delete','myarticles'],
                        'roles' => ['@'],
                    ]               
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }



    public function actionIndex()
    {

        $query = Article::find();
        $articles = $query->orderBy('id DESC')
            ->with('user')
            ->limit(10)
            ->all();

        return $this->render('index', [
            'articles' => $articles
        ]);
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionMyarticles()
    {

        $user = User::findOne(Yii::$app->user->identity->id);

        $query = $user->getArticles();


        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $articles = $query->orderBy('id DESC')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('myarticles', [
            'articles' => $articles,
            'pagination' => $pagination,
        ]);

    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'article' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
 
        $model = new Article();
        $uploader = new Uploader();

        if (Yii::$app->request->isPost) {
            $uploader->imageFile = UploadedFile::getInstance($uploader, 'imageFile');
            
               
        $model->user_id=Yii::$app->user->identity->id;
        $model->date=date("Y-m-d H:i:s");
        $model->image_tag=$uploader->imageFile->basename;
        $model->image_extension=$uploader->imageFile->extension;


        if ($model->load(Yii::$app->request->post()) && $model->save()  )
            {
            if ($uploader->upload($model->id)) 
            {
            return $this->redirect(['view', 'id' => $model->id]);
            }

            }
        }
            return $this->render('create', [
                'model' => $model,
            ]);
        
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        /*Yii::$app->user->identity->id*/
        $article=Article::findOne($id);
         $user = $article->user;
         if (Yii::$app->user->identity->id != $user->id) {
            return $this->goHome();
        }
        unlink('uploads/article_'.$article->id.'.'.$article->image_extension);
        $this->findModel($id)->delete();
        Yii::$app->getSession()->setFlash('success','Article has been deleted successfully');
        return $this->goHome();
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



}

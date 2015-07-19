<?php

namespace app\controllers;

use Yii;
use app\models\Article;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\Controller;
use yii\helpers\Url;
use yii\helpers\StringHelper;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class FeedController extends Controller
{
public function actionRss()
{
    $dataProvider = new ActiveDataProvider([
        'query' => Article::find()->with(['user'])->orderby('id DESC'),
        'pagination' => [
            'pageSize' => 10
        ],
    ]);
    $response = \Yii::$app->getResponse();
    \Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
    header("Content-Type: application/xml; charset=UTF-8");


    $response->content = \Zelenin\yii\extensions\Rss\RssView::widget([
        'dataProvider' => $dataProvider,
        'channel' => [
            'title' => Yii::$app->name,
            'link' => Url::toRoute('/', true),
            'description' => 'Articles ',
            'language' => Yii::$app->language
        ],
        'items' => [
            'title' => function ($model, $widget) {
                    return $model->title;
                },
            'description' => function ($model, $widget) {
                    return StringHelper::truncateWords($model->content, 50);
                },
            'link' => function ($model, $widget) {
                    return Url::toRoute(['article/view', 'id' => $model->id], true);
                },
            'author' => function ($model, $widget) {
                    return $model->user->email . ' (' . $model->user->name . ')';
                },
            'pubDate' => function ($model, $widget) {
                    $date = \DateTime::createFromFormat('Y-m-d H:i:s', $model->date);
                    return $date->format(DATE_RSS);
                }
        ]
    ]);
}
}
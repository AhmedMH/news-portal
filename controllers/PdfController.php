<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Html;
use mPDF;

class PdfController extends Controller
{

    public function actionDownload($id) {
        $article = ArticleController::findModel($id);
        $html=$this->getContent($article);
        $mpdf = new mPDF;
        $mpdf->WriteHTML($html);
        $mpdf->Output($article->title.'.pdf','D');
    }

    public function getContent ($article)
    {
        $formatter = \Yii::$app->formatter;
        return '<div><strong>'.$article->title.'</strong></div><br/><img src="/uploads/article_'.$article->id.'.'.$article->image_extension.'"><div><div>by <strong>'.Html::encode($article->user->name).'/</strong>'.Html::encode($article->user->email).' | '.$formatter->asDatetime($article->date , "long").'</div><br/>'.$article->content.'</div>';
    }
}
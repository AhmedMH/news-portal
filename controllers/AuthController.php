<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Password;
use app\models\Mailer;
use app\models\SignupForm;
use app\models\LoginForm;
use app\models\Article;
use yii\data\Pagination;


class AuthController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','confirm'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['confirm'],
                        'allow' => true,
                        'roles' => ['?'],
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

    public function actionSignup()
    {
        if (!\Yii::$app->user->isGuest) {
                return $this->goHome();
            }

        $model = new User();
        $model->generateConfirmToken();

        if ($model->load(Yii::$app->request->post()) && $model->save() ) {
            if ($model->validate()) {
                if(Mailer::send_confirmation($model))
                {
                    Yii::$app->getSession()->setFlash('success','Your account has been created successfully,We sent you a confirmation mail, Please check your mail & create your password');
                }
                return $this->goHome();

            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionConfirm($id, $token)
    {
        $user = User::findByConfirmToken($id,$token);

        if(!empty($user)){       
         return $this->createPassword($user);
        }
        else{
        Yii::$app->getSession()->setFlash('danger','Confirm token mismatch!');
        }
        return $this->goHome();
    }

    public function createPassword($user)
    {
        $model = new password();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                $user->verified=1;
                $user->setPassword($model->password);
                $user->save();
                Yii::$app->user->login($user, 3600*24*30 );
                Yii::$app->getSession()->setFlash('info','Welcome to News Portal');
                return $this->goHome();
            }
        }

        return $this->render('password', [
            'model' => $model,
        ]);
}

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
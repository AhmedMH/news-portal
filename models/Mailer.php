<?php

namespace app\models;

use Yii;

/**
 * This is the model class for sending Mail.
 */
class Mailer 
{

	public static function send_confirmation (User $user)
	{
    	return Yii::$app->mail->compose()
	     ->setFrom(['noreply@news-portal.dev' => 'News Portal'])
	     ->setTo([$user->email => $user->name])
	     ->setSubject("Confirmation Email")
	     ->setTextBody
				    (
				     	"Welcome to News Portal, Please click this link & create your password ".\yii\helpers\Html::a('confirm',
						Yii::$app->urlManager->createAbsoluteUrl(
						['confirm','id'=>$user->id,'token'=>$user->confirm_token]
						))
					)
	     ->send();
	}
}
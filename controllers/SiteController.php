<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\Сurrency;
use function GuzzleHttp\Psr7\uri_for;

class SiteController extends Controller
{
    public function beforeAction($action)
    {
        $headers = Yii::$app->request->headers;
        $accept = $headers->get('X-API-KEY');
        if ($accept == '123321'){
            return parent::beforeAction($action);
        }else{
            $error = ['status'=>'0',
                'message'=>'Authorize request error'];
            echo json_encode($error);
            die();
        }
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionExchange(){

        $request = Yii::$app->request;
        $model = new Сurrency();
        echo json_encode($model->getCurrency($request->get('currency')));






    }


}

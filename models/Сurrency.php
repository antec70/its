<?php


namespace app\models;


use yii\db\ActiveRecord;

class Сurrency
{
    public function getCurrency($currency = null){
        $pool = array('AUD','AZN','GBP','AMD','BYN',
            'BGN','BRL','HUF','HKD','DKK',
            'USD','EUR','INR','KZT','CAD',
            'KGS', 'CNY','MDL','NOK', 'PLN',
            'RON','XDR','SGD', 'TJS', 'TRY',
            'TMT', 'UZS', 'UAH', 'CZK', 'SEK',
            'CHF', 'ZAR', 'KRW', 'JPY');
        if ($currency == null){

            $set = array_rand($pool,1);
            $currency = $pool[$set];
        }
        if (!in_array($currency,$pool)){
            $error = ['status'=>'-1',
                'message'=>'Incorrect Currency'];
            return $error;

        }

       $allCourse =  file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js');
        $data = json_decode($allCourse,true);

        $needed = $data['Valute']["$currency"];

        $k = $needed['Value'];
        $pos = stripos($k,'1',1);
        if ($pos == true){
            $checkEnd =' рублю';
        }else{
            $checkEnd =' рублям';
        }
        $json = [$needed['CharCode'] => "1 ".$needed['Name']." равен ".$needed['Value'].$checkEnd];
      return $json;
    }


}
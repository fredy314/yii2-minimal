<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use Telegram;
use yii\web\Response;

class TelegramController extends Controller
{

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex($token = '') {
        $this->layout = false;
        $telegram = new Telegram(getenv('TELEGRAM_API_KEY'), false);
        $this->response->format=Response::FORMAT_JSON;
        if($token == 'set'){
            $url = $this->request->hostInfo . '/' . $this->id . '?token=' . getenv('TELEGRAM_API_KEY');
            $r = $telegram->setWebhook($url);
            if(isset($r['description']) && $r['description'] == 'Webhook is already set'){
                $telegram->deleteWebhook();
                $telegram->getUpdates();
                $r = $telegram->setWebhook($url);
            }
            return $r;
        }
        if($token != getenv('TELEGRAM_API_KEY')){
            return 'Error';
        }
        //file_put_contents(Yii::$app->runtimePath. '/test.txt', json_encode($telegram->getData(), JSON_PRETTY_PRINT));

        // @see https://github.com/Eleirbag89/TelegramBotPHP
        try{
            $chat_id = $telegram->ChatID();
            $text = $telegram->Text();
        }catch(\Exception $e) {
            return $telegram->respondSuccess();
        }
        $content = ['chat_id' => $chat_id, 'text' => 'Test'];
        $telegram->sendMessage($content);
        return $telegram->respondSuccess();
    }

}
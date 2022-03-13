<?php

namespace app\controllers;

use yii\web\Controller;
use Telegram;
use yii\web\Response;

class TelegramController extends Controller
{

    public function actionIndex($token = '') {
        $this->layout = false;
        $telegram = new Telegram(getenv('TELEGRAM_API_KEY'));
        $telegram->log_errors = false;
        $this->response->format=Response::FORMAT_JSON;
        if($token == 'set'){
            $url = $this->request->hostInfo . '/' . $this->id . '/?token=' . getenv('TELEGRAM_API_KEY');
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

        // @see https://github.com/Eleirbag89/TelegramBotPHP
        $chat_id = $telegram->ChatID();
        $content = ['chat_id' => $chat_id, 'text' => 'Test'];
        return $telegram->sendMessage($content);
    }

}
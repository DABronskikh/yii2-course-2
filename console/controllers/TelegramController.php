<?php

namespace console\controllers;

use common\models\Telegram;
use Yii;
use yii\console\Controller;

class TelegramController extends Controller
{
    private $bot;
    private $telegram;

    public function init()
    {
        $this->bot = Yii::$app->bot;
        $this->telegram = new Telegram();
    }

    public function actionIndex()
    {
        $updates = Yii::$app->bot->getUpdates($this->telegram->getOffset() + 1);
        if (count($updates) > 0) {
            echo "new mes: " . count($updates) . "\n";
        } else {
            echo "no new mes \n";
        }

        foreach ($updates as $update) {
            $this->processComand($update->getMessage());
            $this->telegram->updateOffset($update->getUpdateId());
        }
    }

    protected function processComand($message)
    {
        $params = explode(" ", $message->getText());
        $fromId = $message->getFrom()->getID();
        $command = $params[0];
        $user_mail = NULL;
        if (isset($params[1])) {
            $user_mail = $params[1];
        }

        switch ($command) {
            case "/help":
                $resp = "Доступные команды \n";
                $resp .= "/help - список команд \n";
                //$resp .= "/task_create ##login## - создание задачи \n";
                $resp .= "/subscribe_tasks ##mail_пользователя## - подписка на создание задачи \n";
                Yii::$app->bot->sendMessage($fromId, $resp);
                break;
            case "/subscribe_tasks":
                Yii::$app->bot->sendMessage($fromId, $this->telegram->createSubscription($user_mail, $fromId));
                break;
            default:
                Yii::$app->bot->sendMessage($fromId, "Не понимаю \n для получения справки введите /help");
                break;
        }
    }
}
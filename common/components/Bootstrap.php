<?php

namespace common\components;


use common\models\mailers\TaskMailer;
use common\models\tables\Tasks;
use common\models\tables\TelegramSubscription;
use common\models\Telegram;
use Yii;
use yii\base\Component;
use yii\base\Event;

class Bootstrap extends Component
{
    public function init()
    {
        $this->attachEventHandlers();
    }

    public function attachEventHandlers()
    {
        //Event::on(Tasks::class, Tasks::EVENT_AFTER_INSERT, function ($event) {
        Event::on(Tasks::class, Tasks::EVENT_AFTER_UPDATE, function ($event) {

            $task = $event->sender;
            $telegramSubscription = TelegramSubscription::find()
                ->where("user_id = :user_id",
                    [':user_id' => $task->responsible_id])->one();
            if ($telegramSubscription !== NULL) {
                $mes = "У вас новая задача: \n";
                $mes .= " \"{$task->name}\"\n";
                $mes .= "срок: {$task->deadline}\n";

                (new Telegram())->sendBroadcastMessages($telegramSubscription->telegram_user_id, $mes);
            }

            $subject = 'New task';
            $textBody = "hi, {$task->responsible->username}, you have a <a href=\"/tasks/view?id={$task->id}\"> new Task</a>:
                    {$task->name}}";
            (new TaskMailer())->sentTaskCreate($task, $subject, $textBody);
        });
    }


}
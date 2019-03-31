<?php

namespace common\models;

use common\models\tables\TelegramOffset;
use common\models\tables\TelegramSubscription;
use Yii;
use yii\base\Model;

class Telegram extends Model
{
    private $offset = 0;

    public function getOffset()
    {
        $max = TelegramOffset::find()
            ->select("id")
            ->max("id");
        if ($max > 0) {
            $this->offset = $max;
        }
        return $this->offset;
    }

    public function updateOffset(int $id)
    {
        (new TelegramOffset([
            'id' => $id,
            'timestamp' => date("Y-m-d H:i:s")
        ]))->save();
    }

    public function createSubscription($user_mail, $fromId)
    {
        if (!$user_mail) {
            return "необходимо указать mail пользователя";
        }
        if ($user = Users::find()->where("email = :email", [':email' => $user_mail])->one()) {

            $telegramSubscription = TelegramSubscription::find()
                ->where("user_id = :user_id AND telegram_user_id = :telegram_user_id",
                    [':user_id' => $user->id, ':telegram_user_id' => $fromId])->one();
            if ($telegramSubscription !== NULL) {
                return "Вы уже подписаны: \n от: {$telegramSubscription->created_at}";
            }
            (new TelegramSubscription([
                'user_id' => $user->id,
                'telegram_user_id' => $fromId,
            ]))->save();
            return "Подписка успешно создана \n Пользователь: {$user->username}";
        } else {
            return "Пользователь не найден";
        }
    }

    public function sendBroadcastMessages($fromId, $messages)
    {
        Yii::$app->bot->sendMessage($fromId, $messages);
    }
}
<?php

namespace common\models\mailers;


use common\models\tables\Tasks;
use Yii;
use yii\base\BaseObject;

class TaskMailer extends BaseObject
{
    public function sentTaskCreate(Tasks $task, $subject, $textBody)
    {
        Yii::$app->mailer->compose()
            //->setTo('admin@example.com')
            ->setTo(Yii::$app->params['adminEmail'])
            ->setFrom([$task->responsible->email])
            ->setSubject($subject)
            ->setTextBody($textBody)
            ->send();
    }
}
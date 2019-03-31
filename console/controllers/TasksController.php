<?php

namespace console\controllers;

use common\models\mailers\TaskMailer;
use common\models\tables\Tasks;
use yii\console\Controller;
use yii\helpers\Console;

class TasksController extends Controller
{
    /**
     * оповещение о задачах, у которыхзавтра истекает срок
     */
    public function actionIndex()
    {
        $tasks = Tasks::find()
            ->where(['deadline'=>date('Y-m-d', time() + (60*60*24))])
            ->with('responsible')
            ->all();
        $total =  (!count($tasks))? 0 : count($tasks)-1;

        Console::startProgress(0, $total);
        $TaskMailer = new TaskMailer();
        foreach ($tasks as $key => $task) {
            $subject = 'the due date of the task expires';
            $textBody = "hi, {$task->responsible->username}, the due date of the task expires | 
                    {$task->name}}";
            $TaskMailer->sentTaskCreate($task, $subject, $textBody);
            Console::updateProgress($key, $total);
        };
        Console::endProgress();
    }

}
<?php

namespace frontend\controllers;

use common\models\tables\Comment;
use common\models\tables\Files;
use common\models\tables\Tasks;
use common\models\tables\TaskStatuses;
use common\models\Users;
use Yii;
use common\models\filters\Tasks as TasksSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\UploadedFile;

class PjaxDemoController extends Controller
{

    public function actionIndex()
    {
        $time =  date('H:i:s');
        return $this->render('index',
            ['time' => $time]);
    }

}
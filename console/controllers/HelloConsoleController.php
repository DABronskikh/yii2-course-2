<?php

namespace console\controllers;

use yii\console\Controller;

class HelloConsoleController extends Controller
{
    public function actionIndex()
    {
        echo 'Hello, world';
    }

}
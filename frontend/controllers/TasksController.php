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

class TasksController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = Tasks::findOne($id);
        $taskStatuses = ArrayHelper::map(TaskStatuses::find()->all(), 'id', 'name');
        $user = ArrayHelper::map(Users::find()->all(), 'id', 'username');

        $newFormFile = new Files();
        $newFormFile->task_id = $id;
        $newFormFile->creator_id = Yii::$app->user->identity->id;

        $newFormComment = new Comment();
        $newFormComment->task_id = $id;
        $newFormComment->creator_id = Yii::$app->user->identity->id;
        $arrComments = Comment::find()->where(['task_id'=>$id])->with('creator')->all();
        $arrFiles = Files::find()->where(['task_id'=>$id])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'задача сохранена');
        }

        return $this->render('view', [
            'model' => $model,
            'taskStatuses' => $taskStatuses,
            'user' => $user,
            'newFormFile' => $newFormFile,
            'arrFiles' => $arrFiles,
            'newFormComment' => $newFormComment,
            'arrComments' => $arrComments,
        ]);
    }

    public function actionNewComment(){
        //var_dump(json_encode(Yii::$app->request->post())); die;
        $model = new Comment();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'новый комментарий');
            return $this->redirect(Yii::$app->request->referrer);
        }
        die('oops!');
    }

    public function actionNewImg(){
        $model = new Files();
        if ($model->load(Yii::$app->request->post())){
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->saveFile();

            $model->filename = $model->getFileName();
            $model->file = $model->getNewFileName();
            $model->save();

            Yii::$app->session->setFlash('success', 'новая картинка');
            return $this->redirect(Yii::$app->request->referrer);
        }
        die('oops!');
    }
}
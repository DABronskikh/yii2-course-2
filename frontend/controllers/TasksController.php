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
use yii\web\NotFoundHttpException;
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

    public function actionCreate()
    {
        if (!Yii::$app->request->isPost) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        $params = Yii::$app->request->post();
        $model = new Tasks();

        if ($model->load($params) && $model->save()) {
            return $this->redirect(['/project/view', 'id' => $model->project_id]);
        }

        $taskStatuses = ArrayHelper::map(TaskStatuses::find()->all(), 'id', 'name');
        $user = ArrayHelper::map(Users::find()->all(), 'id', 'username');
        $model->project_id = $params["project_id"];

        return $this->render('create', [
            'model' => $model,
            'taskStatuses' => $taskStatuses,
            'user' => $user,
        ]);
    }

    /**
     * @throws
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $taskStatuses = ArrayHelper::map(TaskStatuses::find()->all(), 'id', 'name');
        $user = ArrayHelper::map(Users::find()->all(), 'id', 'username');

        $newFormFile = new Files();
        $newFormFile->task_id = $id;
        $newFormFile->creator_id = Yii::$app->user->identity->id;

        $newComment = new Comment();
        if ($newComment->load(Yii::$app->request->post()) && $newComment->save()) {
            Yii::$app->session->setFlash('success', 'новый комментарий');
        }

        $newFormComment = new Comment();
        $newFormComment->task_id = $id;
        $newFormComment->creator_id = Yii::$app->user->identity->id;
        $arrComments = Comment::find()->where(['task_id' => $id])->with('creator')->all();
        $arrFiles = Files::find()->where(['task_id' => $id])->all();

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

    public function actionNewComment()
    {
        $model = new Comment();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'новый комментарий');
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            die('oops!');
        }
    }

    public function actionNewImg()
    {
        $model = new Files();
        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->saveFile();

            $model->filename = $model->getFileName();
            $model->file = $model->getNewFileName();
            $model->save();

            Yii::$app->session->setFlash('success', 'новая картинка');
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            die('oops!');
        }
    }

    /**
     * @throws
     */
    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Запрашиваемой задачи не существует!');
    }
}
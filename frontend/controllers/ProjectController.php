<?php

namespace frontend\controllers;

use common\models\tables\ProjectStatus;
use Yii;
use common\models\tables\Project;
use common\models\filters\Project as ProjectSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProjectController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $projectStatuses = ArrayHelper::map(ProjectStatus::find()->all(), 'id', 'name');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'projectStatuses' => $projectStatuses,
        ]);
    }

    /**
     * @throws
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $projectStatuses = ArrayHelper::map(ProjectStatus::find()->all(), 'id', 'name');
        $arrTasks = $model->tasks;
        return $this->render('view', [
            'model' => $model,
            'projectStatuses' => $projectStatuses,
            'arrTasks' => $arrTasks,
        ]);
    }


    public function actionCreate()
    {
        $model = new Project();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $model->creator_id = Yii::$app->user->identity->id;
        $projectStatuses = ArrayHelper::map(ProjectStatus::find()->all(), 'id', 'name');
        return $this->render('create', [
            'model' => $model,
            'projectStatuses' => $projectStatuses,
        ]);
    }

    /**
     * @throws
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $projectStatuses = ArrayHelper::map(ProjectStatus::find()->all(), 'id', 'name');

        return $this->render('update', [
            'model' => $model,
            'projectStatuses' => $projectStatuses,
        ]);
    }

    /**
     * @throws
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('запрощенного проекта не существует!');
    }
}

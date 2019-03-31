<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\tables\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <?= $this->render('_form', [
        'model' => $model,
        'projectStatuses' => $projectStatuses,
    ]) ?>
    <div>
        <?= Html::a(
            Html::submitButton('Добавить задачу', ['class' => 'btn btn-success']),
            ['tasks/create'], [
            'data-method' => 'POST',
            'data-params' => [
                'project_id' => $model->id,
            ],
        ]) ?>
    </div>

    <div class="row">
        <?php
        foreach ($arrTasks as $item) {
            echo $this->render('_preview_task', [
                'model' => $item,
            ]);
        } ?>
    </div>
</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\tables\Tasks */

$this->title = 'Create Tasks';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'taskStatuses' => $taskStatuses,
        'users' => $users,
    ]) ?>

</div>

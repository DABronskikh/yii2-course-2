<?php

use frontend\assets\TasksViewAsset;

TasksViewAsset::register($this);

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Задачи', 'url' => ['/tasks']];
$this->params['breadcrumbs'][] = 'Новая задача';
?>

<?php
echo frontend\widgets\TaskView::widget([
    'model' => $model,
    'taskStatuses' => $taskStatuses,
    'user' => $user,
]);
?>

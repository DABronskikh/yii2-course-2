<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\tables\ProjectStatus */

$this->title = 'Create Project Status';
$this->params['breadcrumbs'][] = ['label' => 'Project Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

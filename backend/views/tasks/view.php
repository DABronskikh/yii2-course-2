<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\tables\Tasks */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tasks-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'discription',
            //'creator_id',
            [
                'label' => $model->attributeLabels()['creator_id'],
                'value'=>$model->creator->username
            ],
            //'responsible_id',
            [
                'label' => $model->attributeLabels()['responsible_id'],
                'value'=>$model->responsible->username
            ],
            //'status_id',
            [
                'label' => $model->attributeLabels()['status_id'],
                'value'=>$model->status->name
            ],
            'created_at',
            'updated_at',
            'deadline',
        ],
    ]) ?>

</div>

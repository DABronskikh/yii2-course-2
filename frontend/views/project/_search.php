<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\filters\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="col-md-9">
        <?= $form->field($model, 'name', [
            'template' => '<div class="">{input}</div>
                           <div class="">{error}</div>'
        ])->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'status_project_id', [
            'template' => '<div class="">{input}</div>
                           <div class="">{error}</div>'
        ])->dropDownList($projectStatuses, ['class' => 'form-control']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

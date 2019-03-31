<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="project-form">
    <?php $form = ActiveForm::begin(); ?>
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
    <div class="col-md-1">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?= $form->field($model, 'creator_id')->hiddenInput()->label('') ?>
    <?php ActiveForm::end(); ?>
</div>

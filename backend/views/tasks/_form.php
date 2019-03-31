<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\tables\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discription')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'creator_id')->dropDownList($users, ['prompt' => 'укажите заказчика']) ?>

    <?= $form->field($model, 'responsible_id')->dropDownList($users, ['prompt' => 'укажите исполнителя']) ?>

    <?= $form->field($model, 'status_id')->dropDownList($taskStatuses) ?>

    <? /*= $form->field($model, 'created_at')->textInput() */ ?>
    <? /*= $form->field($model, 'updated_at')->textInput() */ ?>
    <?= $form->field($model, 'project_id')->textInput()  ?>

    <?= $form->field($model, 'deadline')->textInput(['type' => 'date', 'required'=>'true'])  ?>
    <?/*= $form->field($model, 'deadline')->widget(\yii\jui\DatePicker::class,
        ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd']) */?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

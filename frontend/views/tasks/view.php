<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Задачи', 'url' => ['/tasks']];
$this->params['breadcrumbs'][] = $model->name;
//$this->params['breadcrumbs'][] = 'Update';
?>
<? /*= \app\widgets\Alert::widget() */ ?>



<?php
//отрисовка виджета для просмотра и редактирования задачи
//var_dump($model);
echo frontend\widgets\TaskView::widget([
    'model' => $model,
    'taskStatuses' => $taskStatuses,
    'user' => $user,
]);
?>

<!--форма для загрузки картинок к задаче-->
<?php $form = ActiveForm::begin(['action' => 'new-img'], []); ?>
<?= $form->field($newFormFile, 'task_id')->hiddenInput()->label('') ?>
<?= $form->field($newFormFile, 'creator_id')->hiddenInput()->label('') ?>
<?= $form->field($newFormFile, 'file')->fileInput(['required' => true]) ?>
<div class="form-group">
    <?= Html::submitButton('добавить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>

<!--вывод файлов-->
<div>
    <?php
    foreach ($arrFiles as $item) {
        //echo "<div>{$item->creator->username} | {$item->comment}</div><hr>";
        echo "<a href='/files/img/{$item->file}' target='_blank'>
                <img src='/files/img-min/{$item->file}' alt='{$item->filename}'>
              </a>";
    }
    ?>
</div>


<!--форма для добавления комментариев к задаче-->
<?php $form = ActiveForm::begin(['action' => 'new-comment'], []); ?>
<?= $form->field($newFormComment, 'task_id')->hiddenInput()->label('') ?>
<?= $form->field($newFormComment, 'creator_id')->hiddenInput()->label('') ?>
<?= $form->field($newFormComment, 'comment')->textarea(['required' => true]) ?>
<div class="form-group">
    <?= Html::submitButton('добавить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>

<!--вывод комментаиев-->
<div>
    <?php
    foreach ($arrComments as $item) {
        echo "<div>{$item->creator->username} | {$item->comment}</div><hr>";
    }
    ?>
</div>

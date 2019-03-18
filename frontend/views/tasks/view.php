<?php

use common\widgets\Alert;
use frontend\assets\TasksViewAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

TasksViewAsset::register($this);

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Задачи', 'url' => ['/tasks']];
$this->params['breadcrumbs'][] = $model->name;
?>

<?php
//отрисовка виджета для просмотра и редактирования задачи
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
        echo "<a href='/files/img/{$item->file}' target='_blank'>
                <img src='/files/img-min/{$item->file}' alt='{$item->filename}'>
              </a>";
    }
    ?>
</div>

<!--форма для добавления комментариев к задаче-->
<h3>Работа с Pjax</h3>
<?php Pjax::begin(); ?>
<?php /*$form = ActiveForm::begin(['action' => 'new-comment']); */ ?>
<?php $form = ActiveForm::begin(['options' => ['data' => ['pjax' => true]]]); ?>
<?= $form->field($newFormComment, 'task_id')->hiddenInput()->label('') ?>
<?= $form->field($newFormComment, 'creator_id')->hiddenInput()->label('') ?>
<?= $form->field($newFormComment, 'comment')->textInput(['required' => true]) ?>
<div class="form-group">
    <?= Html::submitButton('добавить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>

<!--вывод комментаиев-->
<div class="new-comment">
    <?= Alert::widget() ?>
    <?php
    foreach ($arrComments as $item) {
        echo "<div>{$item->creator->username} | {$item->comment}</div><hr>";
    }
    ?>
</div>
<?php Pjax::end() ?>

<h3>Работа с WS</h3>
<form action="#" id="formComments">
    <input type="hidden" name="task_id" value='<?= $newFormComment->task_id ?>'>
    <input type="hidden" name="creator_id" value='<?= $newFormComment->creator_id ?>'>
    <label> Comment
        <input id="inputComment" type="text" name="comment" class="form-control">
    </label>
    <div class="form-group">
        <?= Html::submitButton('добавить', ['class' => 'btn btn-success']) ?>
    </div>
</form>
<div class="new-comment-WS"></div>

<script>
    let task_id = <?=$newFormComment->task_id ?>
</script>

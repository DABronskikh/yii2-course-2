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
<?php /*$form = ActiveForm::begin(['action' => 'new-comment']); */?><!--
<?/*= $form->field($newFormComment, 'task_id')->hiddenInput()->label('') */?>
<?/*= $form->field($newFormComment, 'creator_id')->hiddenInput()->label('') */?>
<?/*= $form->field($newFormComment, 'comment')->textInput(['required' => true]) */?>
<div class="form-group">
    <?/*= Html::submitButton('добавить', ['class' => 'btn btn-success']) */?>
</div>
--><?php /*ActiveForm::end(); */?>

<form action="#" id="formComments">
    <input type="hidden" name="task_id" value='<?= $newFormComment->task_id ?>'>
    <input type="hidden" name="creator_id" value='<?=$newFormComment->creator_id ?>'>
    <label> Comment
        <input id="inputComment" type="text" name="comment" class="form-control">
    </label>
    <div class="form-group">
        <?= Html::submitButton('добавить', ['class' => 'btn btn-success']) ?>
    </div>
</form>

<!--вывод комментаиев-->
<div class="new-comment">
    <?php
    foreach ($arrComments as $item) {
        echo "<div>{$item->creator->username} | {$item->comment}</div><hr>";
    }
    ?>
</div>

<script>
    if (!window.WebSocket) {
        alert("Ваш браузер не поддерживает Веб-сокеты");
    }

    const webSocket = new WebSocket("ws:/f.yii2.local:8080");
    document.querySelector('#formComments')
        .addEventListener('submit', () => {
            let newForm = [...document.querySelectorAll('#formComments input')];
            let Comment = {};
            for (const el of newForm) {
                Comment[el.name] = el.value;
            }
            webSocket.send(JSON.stringify(Comment));
            document.querySelector('#inputComment').value  = '';
            event.preventDefault();
            return false;
        });

    webSocket.onmessage = function (event) {
        el = JSON.parse(event.data);
        const newComeent = `<div>${el.username} | ${el.comment}</div><hr>`;
        document.querySelector('.new-comment')
            .insertAdjacentHTML('beforeend', newComeent);
    };
</script>
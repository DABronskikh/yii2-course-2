<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<!--форма для добавления комментариев к задаче-->
<?php \yii\widgets\Pjax::begin() ?>
<?php $form = ActiveForm::begin(['action' => 'new-comment']); ?>
<?= $form->field($newFormComment, 'task_id')->hiddenInput()->label('') ?>
<?= $form->field($newFormComment, 'creator_id')->hiddenInput()->label('') ?>
<?= $form->field($newFormComment, 'comment')->textInput(['required' => true]) ?>
<div class="form-group">
    <?= Html::submitButton('добавить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>


<!--вывод комментаиев-->
<div class="new-comment">
    <?php
    foreach ($arrComments as $item) {
        echo "<div>{$item->creator->username} | {$item->comment}</div><hr>";
    }
    ?>
</div>
<?php \yii\widgets\Pjax::end() ?>
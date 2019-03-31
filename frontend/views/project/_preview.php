<?php

use yii\helpers\Html;
use yii\helpers\Url; ?>

<div class="col-sm-6 col-md-3">
    <?= Html::a("
        <div class='thumbnail'>
            <div class='caption'>
                <h4>{$model->name}</h4>       
            </div>
        </div>
            ",
        Url::to(['view', 'id' => $model->id])) ?>
</div>

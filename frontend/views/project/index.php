<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\filters\Project */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', [
            'model' => $searchModel,
            'projectStatuses' => $projectStatuses,
    ]); ?>

    <p><?= Html::a('Новый проект', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_preview',
    ]) ?>

    <?php Pjax::end(); ?>
</div>

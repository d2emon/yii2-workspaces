<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model d2emon\workspace\models\Job */

$this->title = Yii::t('job', 'Update {modelClass}: ', [
    'modelClass' => 'Job',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('job', 'Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('job', 'Update');
?>
<div class="job-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

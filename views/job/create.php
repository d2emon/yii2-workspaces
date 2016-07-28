<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model d2emon\workspace\models\Job */

$this->title = Yii::t('job', 'Create Job');
$this->params['breadcrumbs'][] = ['label' => Yii::t('job', 'Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

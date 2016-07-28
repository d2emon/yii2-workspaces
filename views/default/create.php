<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model d2emon\workspace\models\Workspace */

$this->title = Yii::t('job', 'Create Workspace');
$this->params['breadcrumbs'][] = ['label' => Yii::t('job', 'Workspaces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workspace-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use d2emon\workspace\components\WorkspaceWidget;

/* @var $this yii\web\View */
/* @var $model d2emon\workspace\models\Job */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('job', 'Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('job', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('job', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('job', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
	    [
	      'attribute' => 'workspace',
	      'format' => 'raw',
              'value' => WorkspaceWidget::widget(['workspace' => $model->workspace, 'show_title' => True]),
	    ],
            'title',
            'image',
            'responsibilities:ntext',
	    [
	      'attribute' => 'profile',
	      'format' => 'raw',
              'value' => Html::a($model->profile->fullname, ['/site/profile', 'id' => $model->profile_id]),
	    ],
            'workspace_id',
            'profile_id',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
// use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use uxappetite\yii2image\components\ImagedDescWidget;

/* @var $this yii\web\View */
/* @var $model d2emon\workspace\models\Workspace */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('job', 'Workspaces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workspace-view">

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
	      'attribute' => 'description',
	      'format' => 'raw',
              'value' => ImagedDescWidget::widget(['model' => $model, 'show_title' => True]),
	    ],
	    [
	      'attribute' => 'jobs',
	      'format' => 'raw',
	      'value' => ListView::widget([
		'dataProvider' => new ArrayDataProvider([
		  'allModels' => $model->jobs,
		]),
		'itemView' => '_joblist',
	      ]),
	      /*
	      'value' => GridView::widget([
		'dataProvider' => new ArrayDataProvider([
		  'allModels' => $model->jobs,
		]),
	        'columns' => [
	            'title',
	            ['class' => 'yii\grid\ActionColumn'],
        	],
	      ]),
	       */
	    ],
        ],
    ]) ?>

</div>

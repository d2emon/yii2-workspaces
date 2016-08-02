<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use d2emon\workspace\models\Workspace;
use kartik\file\FileInput;
use uxappetite\yii2image\components\ThumbWidget;

/* @var $this yii\web\View */
/* @var $model d2emon\workspace\models\Job */
/* @var $form yii\widgets\ActiveForm */

$workspaces = ArrayHelper::map(Workspace::find()->all(), 'id', 'title');
?>

<div class="job-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php $extra = $model->isNewRecord ? [] : ['job_id' => $model->id]; ?>
    <?= $form->field($model, 'imageFile')->widget(FileInput::classname(), [
	'options' => [
	    'multiple' => False,
	    'accept' => 'image/*',
	],
	'pluginOptions' => [
	    'uploadUrl' => Url::to(['job/upload']),
            'uploadExtraData' => $extra,
	    // 'initialPreview' => [$model->avatar],
	    // 'initialPreviewAsData' => True,
	    // 'initialCaption' => $model->image,
	    'overwriteInitial' => True,
	    'showClose' => False,
	    'showCaption' => False,
	    'showBrowse' => False,
	    'browseOnZoneClick' => True,
	    'removeLabel' => '',
	    'removeIcon' => '<i class="glyphicon glyphicon-remove"></i>',
	    'removeTitle' => 'Cancel or reset',
	    'defaultPreviewContent' => ThumbWidget::widget(['model' => $model, 'suffix' => '_s', 'size' => 64]),
	    'layoutTemplates' => [
	        'main2' => '{preview} {remove} {browse}',
	    ],
    	],
    ]); ?>

    <?= $form->field($model, 'responsibilities')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'workspace_id')->dropDownList($workspaces, [
        'prompt' => Yii::t('job', 'Select workspace'),
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('job', 'Create') : Yii::t('job', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use uxappetite\yii2image\components\ThumbWidget;

/* @var $this yii\web\View */
/* @var $model d2emon\workspace\models\Workspace */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="workspace-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php $extra = $model->isNewRecord ? [] : ['workspace_id' => $model->id]; ?>
    <?= $form->field($model, 'imageFile')->widget(FileInput::classname(), [
	'options' => [
	    'multiple' => False,
	    'accept' => 'image/*',
	],
	'pluginOptions' => [
	    'uploadUrl' => Url::to(['/workspace/default/upload']),
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
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('job', 'Create') : Yii::t('job', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

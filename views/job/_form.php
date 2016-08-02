<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use d2emon\workspace\models\Workspace;

/* @var $this yii\web\View */
/* @var $model d2emon\workspace\models\Job */
/* @var $form yii\widgets\ActiveForm */

$workspaces = ArrayHelper::map(Workspace::find()->all(), 'id', 'title');
?>

<div class="job-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'responsibilities')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'workspace_id')->dropDownList($workspaces, [
        'prompt' => Yii::t('job', 'Select workspace'),
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('job', 'Create') : Yii::t('job', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

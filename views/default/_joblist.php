<?php
use yii\helpers\Html;
?>
<?= Html::a($model->title, ['job/view', 'id' => $model->id]); ?> - <?= Html::a($model->profile->fullname, ['/site/profile', 'id' => $model->profile_id]);?>


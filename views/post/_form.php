<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::className(),
    [ 'dateFormat' => 'php:Y-m-d',
      'clientOptions' => [
        'changeYear' => true,
        'changeMonth' => true,
        'yearRange' => '2020:2022',
        'altFormat' => 'yy-mm-dd',
      ]],['placeholder' => 'mm-dd-yyyy'])
    ->textInput(['placeholder' => \Yii::t('app', 'mm-dd-yyyy')]) ; ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->username, 'readonly'=>true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('post-content');
</script>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActivityForm */
/* @var $form ActiveForm */
$this->title = 'Activity';
$this->params['breadcrumbs'][] = $this->title;
?>
<h2 style="margin-top:20px;">Создать событие</h2>
<div class="activity-form">

    <?php $form = ActiveForm::begin(); ?>
      <?= $form->field($model, 'name')->label('Название события') ?>
	  <?= $form->field($model, 'description')->textarea(['rows' => '2'])->label('Описание события') ?>
	  <?= $form->field($model, 'dateTimeStart')->label('Дата старта')->input('date', ['class' => 'form_activity_date']) ?>
	  <?= $form->field($model, 'dateTimeAnd')->label('Дата завершения')->input('date', ['class' => 'form_activity_date']) ?>
	  <?//= Html::activeCheckbox($model, 'isBlock', ['class' => 'agreement']) ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Создать'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>

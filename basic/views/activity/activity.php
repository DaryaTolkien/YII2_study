<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
$this->title = 'Form activity';
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="default-activity">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'activity_name') ?>
        <?= $form->field($model, 'body')->textarea(); ?>

        <?= $form->field($model, 'activity_start_timestamp')->widget(
                'kartik\date\DatePicker',
                    [
                        'name'  => 'activity_start_timestamp',
                        'options' => [
                            'placeholder' =>'Выберите дату завершения события'
                        ],
                        'convertFormat' => true,
                           'pluginOptions' => [
                            'format' => 'yyyy-MM-dd',
                            'todayHighlight' => true,
                         ]
                    ]
        ) ?>
        <?= $form->field($model, 'activity_end_timestamp')->widget(
                'kartik\date\DatePicker',
            [
                'name'  => 'activity_end_timestamp',
                'options' => [
                        'placeholder' =>'Выберите дату завершения события'
                 ],
                'convertFormat' => true,
                'pluginOptions' => [
                'format' => 'yyyy-MM-dd',
                'todayHighlight' => true,
                ]
            ]
        )  ?>


    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), [
                    'class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- default-activity -->
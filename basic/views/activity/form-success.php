<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Success';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Название события: <?= Html::encode($model->name)?> </h1>
<h1>Описание события: <?= Html::encode($model->description)?> </h1>
<h1>Фото события: <img src="/images/img_event/<?= Html::encode($model->imageFile)?>" style="width:250px; height=:250px;"> </h1>


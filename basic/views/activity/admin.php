<?php 

use yii\grid\GridView;
//use Yii;

$this->title = 'Кабинет администратора';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
   echo GridView::widget([
	   'dataProvider' => $activitiesProvider,
	   'columns' => [
		  // ['class' => 'yii\grid\Serialcolumn'],
		   ['attribute' => 'id_activity'],
		   [
			   'label' => 'Название',
			   'attribute' => 'Activity_name',
			   'value' => function($data){return $data->activity_name;}
		   ],
		   [
			   'label' => 'Дата начала',
			   'attribute' => 'activity_start_timestamp',
			   //'value' => function($data){return date("d.m.Y", strtotime($data->activity_start_timestamp));}
			   'value' => function($model){
				   return Yii::$app->formatter->asDate($model->activity_start_timestamp, Yii::$app->params['format_date_view']);
			   }
		   ],
		   [
			   'label' => 'Дата завершения',
			   'attribute' => 'activity_end_timestamp',
			   'value' => function($data){return date("d.m.Y", strtotime($data->activity_end_timestamp));}
		   ],
		   ['class' => 'yii\grid\ActionColumn']
	   ]
   ])
?>
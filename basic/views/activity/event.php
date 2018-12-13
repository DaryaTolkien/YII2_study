<?php 

$this->title = 'Событие';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="event_content">
	
   <h3>Название события: <span class="event_span"><?= $list->activity_name ?></span></h3>
   <div class="event_div">Описание события: <span class="event_span"><?= $list->body ?></span></div>
   <div class="event_div">Начало: <span class="event_span"><?= $list->activity_start_timestamp ?></span></div>
   <div class="event_div">Конец: <span class="event_span"><?= $list->activity_end_timestamp ?></span></div>
 
   <img src="/images/img_event/<?= $list->imageFile ?>" class="img_event">
	
</div>



     
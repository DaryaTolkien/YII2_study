<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


$this->title = 'Календарь';
$this->params['breadcrumbs'][] = $this->title;
?>

<h2 style="margin-top:20px;">Календарь событий</h2>
<a href="index.php?r=activity%2Fform" class="a_calendar_create">Создать событие</a>

<?php foreach ($list as $item): ?>
    <div class="calendar_list">
			<a href="<?= Url::to(['activity/view', 'id' => $item->id_activity]);?>">
            <span class="calendar_span">Название события: <?= $item->activity_name ?></span><br>
		    <span class="calendar_span">Начало: <?= $item->activity_start_timestamp ?></span>
		    <span class="calendar_span">Конец: <?= $item->activity_end_timestamp ?></span>
		</a>
    </div>
<?php endforeach; ?>


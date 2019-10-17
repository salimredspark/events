<?php
    use yii\helpers\Html;
    use yii\helpers\Url; 
    use backend\models\Settings;
?>
<div class="container">
<script>
    function getCounter(date, divId){        
        var countDownDate = new Date(date).getTime();        
        var x = setInterval(function() {            
            var now = new Date().getTime();                        
            var distance = countDownDate - now;            
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);            

            var createStr = '';
            if(days > 0) createStr += days + "d ";
            if(hours > 0) createStr += hours + "h ";

            document.getElementById(divId).innerHTML = createStr + minutes + "m " + seconds + "s ";                        
            if (distance < 0) {
                clearInterval(x);
                document.getElementById(divId).innerHTML = " - ";
            }
        }, 1000);
    }
</script>
<div class="site-index">
    <div class="jumbotron"><h1>Events</h1></div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <h2>Active Events</h2>
                <?php if(count($active_events) > 0){?>
                    <?php foreach ($active_events as $e){?>
                        <div class="events-list">
                            <h4><?=$e->event_name;?></h4>
                            <p>Started on <?=Settings::getConfigDateTime($e->start_time,'number','time');?> (<?=Settings::getTimeAgo($e->start_time);?>)
                                <br />Complete on <span class="dark"><?=Settings::getConfigDateTime($e->end_time,'number','datetime');?></span></p>
                            <p><?=$e->event_location;?></p>                            
                            <?= Html::a('More &raquo;', ['events/view', 'id'=> $e->id], ['class'=>'btn btn-default btn-readmore']) ?>
                        </div>
                        <?php }?>
                    <?php }?>
            </div>
            <div class="col-lg-4">
                <h2>Todays Events</h2>
                <?php if(count($todays_events) > 0){?>
                    <?php foreach ($todays_events as $e){?>
                        <div class="events-list">
                            <h4><?=$e->event_name;?> will start on <?=Settings::getConfigDateTime($e->start_time,'number','time');?></h4>
                            <p>Event will start after <span id="todays_counter<?=$e->id;?>" class="dark"></span>
                                <script> getCounter("<?=$e->start_time;?>", "todays_counter<?=$e->id;?>"); </script>
                            </p>
                            <p><?=$e->event_location;?></p>                        
                            <?= Html::a('More &raquo;', ['events/view', 'id'=> $e->id], ['class'=>'btn btn-default btn-readmore']) ?>
                        </div>
                        <?php }?>
                    <?php }?>
            </div>
            <div class="col-lg-4">
                <h2>Upcoming Events</h2>
                <?php if(count($upcoming_events) > 0){?>
                    <?php foreach ($upcoming_events as $e){?>
                        <div class="events-list">
                            <h4><?=$e->event_name;?></h4>
                            <p>Schedule  on <?=Settings::getConfigDateTime($e->start_time,'number','datetime');?>
                                <br />Event will start after <span id="upcoming_counter<?=$e->id;?>" class="dark"></span>
                                <script> getCounter("<?=$e->start_time;?>", "upcoming_counter<?=$e->id;?>"); </script>
                            </p>
                            <p><?=$e->event_location;?></p>
                            <?= Html::a('More &raquo;', ['events/view', 'id'=> $e->id], ['class'=>'btn btn-default btn-readmore']) ?>
                        </div>
                        <?php }?>
                    <?php }?>
            </div>
        </div>

    </div>
</div>
</div>

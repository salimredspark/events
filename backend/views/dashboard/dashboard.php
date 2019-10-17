<?php 
use yii\helpers\Html;
use yii\helpers\Url;  
use backend\models\Settings;
?>
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
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="orange">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <div class="card-content">
                        <p class="category">Active / Scheduled</p>
                        <h3 class="title"><a href="<?= Url::to(['events/index']);?>"><?=count($active_events);?> / <?=$total_todays_events;?></a></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">date_range</i> Total <?=$total_events;?> Events are created.
                        </div>
                    </div>
                </div>
            </div>
            <?php /*<div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="green">
                        <i class="material-icons">event_available</i>
                    </div>
                    <div class="card-content">
                        <p class="category">Event Shows</p>
                        <h3 class="title"><a href="<?= Url::to(['event-show/search-event']);?>"><?=$total_active_eventshows;?></a></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">date_range</i> Total <?=$total_eventshows;?> Shows are created. 
                        </div>
                    </div>
                </div>
            </div>*/?>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="red">
                        <i class="fa fa-microphone"></i>
                    </div>
                    <div class="card-content">
                        <p class="category">Speakers</p>
                        <h3 class="title"><a href="<?= Url::to(['speakers/index']);?>"><?=$total_speakers;?></a></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">date_range</i> All Speakers
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="blue">
                        <i class="fa fa-address-card"></i>
                    </div>
                    <div class="card-content">
                        <p class="category">Exhibitors</p>
                        <h3 class="title"><a href="<?= Url::to(['exhibitors/index']);?>"><?=$total_exhibitors;?></a></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i> All Exhibitors
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="blue">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="card-content">
                        <p class="category">Visitors</p>
                        <h3 class="title"><a href="<?= Url::to(['visitors/index']);?>"><?=$total_visitors;?></a></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i> All Visitors
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">                                   
                    <div class="card-content">
                        <h4 class="title"><i class="fa fa-bell"></i> Active Events (<?=count($active_events);?>)</h4>
                        <p class="category">Latest active events</p>
                    </div>
                    <?php 
                        if(count($active_events) > 0){
                            foreach($active_events as $e){?>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">access_time</i> 
                                    <a href="<?= Url::to(['events/view', 'id'=>$e->id]);?>"><?=$e->event_name;?></a> started on <?=Settings::getConfigDateTime($e->start_time,'number','time');?><br />(<?=Settings::getTimeAgo($e->start_time);?>) | 
                                    Complete on <span class="dark"><?=Settings::getConfigDateTime($e->end_time,'number','datetime');?></span>
                                </div>
                            </div>
                            <?php } ?>
                        <?php }else{?>
                        <div class="card-footer">No Event Schedule Yet!</div> 
                        <?php }?>                    
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">                                    
                    <div class="card-content">
                        <h4 class="title"><i class="fa fa-clipboard"></i> Todays Events (<?=count($todays_events);?>)</h4>
                        <p class="category">Latest upcoming events</p>
                    </div>
                    <?php 
                        if(count($todays_events) > 0){
                            $rows=1;
                            foreach($todays_events as $e){?>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">access_time</i> <a href="<?= Url::to(['events/view', 'id'=>$e->id]);?>"><?=$e->event_name;?></a> will start on <?=Settings::getConfigDateTime($e->start_time,'number','time');?>
                                    <br />Event will start after <div id="todays_counter<?=$rows;?>" class="dark"></div>
                                    <script> getCounter("<?=$e->start_time;?>", "todays_counter<?=$rows;?>"); </script>
                                </div>
                            </div>
                            <?php $rows++;} ?>
                        <?php }else{?>
                        <div class="card-footer">No Event Schedule Yet!</div> 
                        <?php }?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">                                    
                    <div class="card-content">
                        <h4 class="title"><i class="fa fa-calendar"></i> Upcoming Events (<?=count($upcoming_events);?>)</h4>
                        <p class="category">Scheduled Events</p>
                    </div>
                    <?php 
                        if(count($upcoming_events) > 0){
                            $rows=1;    
                            foreach($upcoming_events as $e){?>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">access_time</i> <a href="<?= Url::to(['events/view', 'id'=>$e->id]);?>"><?=$e->event_name;?></a> Schedule  on <?=Settings::getConfigDateTime($e->start_time,'number','datetime');?>
                                    <br />Event will start after <div id="upcoming_counter<?=$rows;?>" class="dark"></div>
                                    <script> getCounter("<?=$e->start_time;?>", "upcoming_counter<?=$rows;?>"); </script>
                                </div>
                            </div>
                            <?php $rows++; } ?>
                        <?php }else{?>
                        <div class="card-footer">No Event Schedule Yet!</div> 
                        <?php }?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">                                    
                    <div class="card-content">
                        <h4 class="title"><i class="fa fa-address-card"></i> Exhibitors</h4>
                        <p class="category">Latest 10 Exhibitors</p>
                    </div>
                    <?php 
                        if(count($exhibitors_list) > 0){
                            foreach($exhibitors_list as $e){
                                if(!$e->id) continue; 
                                ?>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">person</i> <a href="<?= Url::to(['exhibitors/view', 'id'=>$e->id]);?>"><?=$e->user['firstname']." ".$e->user['lastname'];?></a> registered <?=Settings::getTimeAgo($e->created_at);?>
                                </div>
                            </div>
                            <?php }
                        }else{?><div class="card-footer">No Exhibitors!</div> <?php }?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">                                    
                    <div class="card-content">
                        <h4 class="title"><i class="fa fa-users"></i> Visitors</h4>
                        <p class="category">Latest 10 Visitors</p>
                    </div>
                    <?php 
                        if(count($visitors_list) > 0){
                            foreach($visitors_list as $e){
                                if(!$e->id) continue;
                                ?>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">person</i> <a href="<?= Url::to(['visitors/view', 'id'=>$e->id]);?>"><?=$e->user['firstname']." ".$e->user['lastname'];?></a> registered <?=Settings::getTimeAgo($e->created_at);?>
                                </div>
                            </div>
                            <?php }
                        }else{?><div class="card-footer">No Visitors!</div> <?php }?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="card">                                   
                    <div class="card-content">
                        <h4 class="title"><i class="fa fa-calendar"></i> Completed Events</h4>
                        <p class="category">Latest 10 Completed Events</p>
                    </div>
                    <?php 
                        if(count($completed_events) > 0){
                            foreach($completed_events as $e){?>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">access_time</i> <a href="<?= Url::to(['events/view', 'id'=>$e->id]);?>"><?=$e->event_name;?></a> completed on <?=Settings::getConfigDateTime($e->end_time,'number','datetime');?>
                                    <br />(<?=Settings::getTimeAgo($e->end_time);?>)
                                    <?php //echo Settings::getConfigDateTime($e->end_time,'number','datetime');?>
                                </div>
                            </div>
                            <?php }
                        }else{?><div class="card-footer">No Completed Events</div> <?php }?>                    
                </div>
            </div>
        </div>
    </div>
</div>   
<?php 
    use yii\helpers\Url;  
    use backend\models\Settings; 
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="orange">
                        <i class="material-icons">events</i>
                    </div>
                    <div class="card-content">
                        <p class="category">Active Events</p>
                        <h3 class="title"><a href="<?= Url::to(['events/index']);?>"><?=$total_active_events;?></a></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">date_range</i> Total <?=$total_events;?> Events are created.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
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
            </div>
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
                        <i class="fa fa-hotel"></i>
                    </div>
                    <div class="card-content">
                        <p class="category">Hotels</p>
                        <h3 class="title"><a href="<?= Url::to(['hotels/index']);?>"><?=$total_hotels;?></a></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i> All Hotels
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">                                   
                    <div class="card-content">
                        <h4 class="title"><i class="fa fa-bell"></i> Active Events (<?=count($ongoing_events);?>)</h4>
                        <p class="category">Latest active events</p>
                    </div>
                    <?php 
                        if(count($ongoing_events) > 0){
                               foreach($ongoing_events as $e){?>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">access_time</i> 
                                    <a href="<?= Url::to(['events/view', 'id'=>$e->id]);?>"><?=$e->event_name;?></a> started on <?=Settings::getConfigDateTime($e->start_time,'number','time');?> (<?=Settings::getTimeAgo($e->start_time);?>)<br />
                                    Events Close on <?=Settings::getConfigDateTime($e->end_time,'number','datetime');?>
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
                        <h4 class="title"><i class="fa fa-clipboard"></i> Todays Events (<?=count($upcoming_events);?>)</h4>
                        <p class="category">Latest upcoming events</p>
                    </div>
                    <?php 
                        if(count($upcoming_events) > 0){
                               foreach($upcoming_events as $e){?>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">access_time</i> <a href="<?= Url::to(['events/view', 'id'=>$e->id]);?>"><?=$e->event_name;?></a> will start on <?=Settings::getConfigDateTime($e->start_time,'number','time');?>
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
                        <h4 class="title"><i class="fa fa-calendar"></i> Upcoming Events (<?=count($active_events);?>)</h4>
                        <p class="category">Scheduled Events</p>
                    </div>
                   <?php 
                        if(count($active_events) > 0){
                               foreach($active_events as $e){?>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">access_time</i> <a href="<?= Url::to(['events/view', 'id'=>$e->id]);?>"><?=$e->event_name;?></a> Schedule  on <?=Settings::getConfigDateTime($e->start_time,'number','datetime');?>
                                </div>
                            </div>
                            <?php } ?>
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
                        <h4 class="title"><i class="fa fa-user"></i> Exhibitors (<?=count($total_exhibitors);?>)</h4>
                        <p class="category">Latest 10 Exhibitors</p>
                    </div>
                    <?php 
                        if(count($total_exhibitors) > 0){
                            foreach($total_exhibitors as $e){?>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> <a href="<?= Url::to(['exhibitors/view', 'id'=>$e->id]);?>"><?=$e->firstname." ".$e->lastname;?></a> registered <?=Settings::getTimeAgo($e->updated_at);?>
                        </div>
                    </div>
                    <?php }
                    }else{?><div class="card-footer">No Exhibitors!</div> <?php }?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">                                    
                    <div class="card-content">
                        <h4 class="title"><i class="fa fa-user"></i> Visitors (<?=count($total_visitors);?>)</h4>
                        <p class="category">Latest 10 Visitors</p>
                    </div>
                    <?php 
                        if(count($total_visitors) > 0){
                            foreach($total_visitors as $e){?>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> <a href="<?= Url::to(['visitors/view', 'id'=>$e->id]);?>"><?=$e->visitor_name;?></a> registered <?=Settings::getTimeAgo($e->created_at);?>
                        </div>
                    </div>
                    <?php }
                    }else{?><div class="card-footer">No Visitors!</div> <?php }?>

                </div>
            </div>

            <div class="col-md-4">
                <div class="card">                                   
                    <div class="card-content">
                        <h4 class="title"><i class="fa fa-calendar"></i> Completed Events (<?=count($completed_events);?>)</h4>
                        <p class="category">Latest 10 Completed Events</p>
                    </div>
                    <?php 
                        if(count($completed_events) > 0){
                            foreach($completed_events as $e){?>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">access_time</i> <a href="<?= Url::to(['events/view', 'id'=>$e->id]);?>"><?=$e->event_name;?></a> completed on <?=Settings::getConfigDateTime($e->end_time,'number','datetime');?><br />(<?=Settings::getTimeAgo($e->end_time);?>)
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
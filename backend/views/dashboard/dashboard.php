<?php 
use yii\helpers\Url; 
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
                            <i class="material-icons">date_range</i> Total <?=$total_eventshows;?> Events are created. 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="red">
                        <i class="material-icons">mice</i>
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
                        <i class="fa fa-twitter"></i>
                    </div>
                    <div class="card-content">
                        <p class="category">Followers</p>
                        <h3 class="title">+245</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i> Just Updated
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">                                    
                    <div class="card-content">
                        <h4 class="title">Daily Sales</h4>
                        <p class="category"><span class="text-success"><i class="fa fa-long-arrow-up"></i> 55%  </span> increase in today sales.</p>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> updated 4 minutes ago
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">                                    
                    <div class="card-content">
                        <h4 class="title">Email Subscriptions</h4>
                        <p class="category">Last Campaign Performance</p>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> campaign sent 2 days ago
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="card">                                   
                    <div class="card-content">
                        <h4 class="title">Completed Tasks</h4>
                        <p class="category">Last Campaign Performance</p>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> campaign sent 2 days ago
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
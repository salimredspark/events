<?php

    /* @var $this \yii\web\View */
    /* @var $content string */

    use backend\assets\AppAsset;
    use yii\helpers\Html;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use yii\widgets\Breadcrumbs;
    use common\widgets\Alert;
    use yii\helpers\Url;

    AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode(Yii::$app->name .' - '.$this->title) ?></title>
        <?php $this->head() ?>                
    </head>
    <body>
        <?php $this->beginBody() ?>
        <?php
            $controller = Yii::$app->controller->id;
            $controllerAction = Yii::$app->controller->action->id;
        ?>
        <div class="wrapper">
            <?php if(Yii::$app->user->id){?>
                <div class="sidebar" data-color="purple" data-image="<?=Yii::$app->request->baseUrl;?>/img/sidebar-<?=rand(1,4);?>.jpg">
                    <div class="logo">
                        <a href="<?= Url::to(['user/view', 'id'=>Yii::$app->user->identity->id]);?>" class="simple-text"><?=Yii::$app->user->identity->username;?></a>
                        <div>Last Updated: <?=date("d M, Y h:i A",Yii::$app->user->identity->updated_at);?></div>
                    </div>                
                    <div class="sidebar-wrapper">
                        <ul class="nav">
                            <li class="<?=($controller=='dashboard')?'active':'';?>">
                                <a href="<?=Url::to(['dashboard/index']);?>">
                                    <i class="material-icons">dashboard</i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="<?=(strpos($controller,'user') !== false )?'active':'';?>">
                                <a href="<?=Url::to(['user/index']);?>">
                                    <i class="material-icons">person</i>
                                    <p>Users</p>
                                </a>
                            </li>
                            <li class="<?=(strpos($controller,'event') !== false && strpos($controller,'exhibitors') === false )?'active':'';?>">
                                <a href="<?=Url::to(['events/index']);?>">
                                    <i class="material-icons">content_paste</i>
                                    <p>Events</p>
                                </a>
                                <ul class="sub-menu">                                    
                                    <li class="<?=($controller=='events')?'sub-active':'';?>">
                                        <a href="<?=Url::to(['events/index']);?>">
                                        <i class="material-icons">event_available</i>
                                        <p>Event List</p>
                                        </a>
                                    </li>
                                    <li class="<?=($controller=='is-event-speaker')?'sub-active':'';?>">
                                        <a href="<?=Url::to(['is-event-speaker/search-event']);?>">
                                        <i class="material-icons">event_available</i>
                                        <p>Event Speakers</p>
                                        </a>
                                    </li>
                                    <li class="<?=($controller=='event-show')?'sub-active':'';?>">
                                        <a href="<?=Url::to(['event-show/search-event']);?>">
                                        <i class="material-icons">event_available</i>
                                        <p>Event Show</p>
                                        </a>
                                    </li>
                                    <li class="<?=($controller=='event-type')?'sub-active':'';?>">
                                        <a href="<?=Url::to(['event-type/index']);?>">
                                        <i class="material-icons">event_available</i>
                                        <p>Event Type</p>
                                        </a>
                                    </li>
                                    <li class="<?=($controller=='event-location')?'sub-active':'';?>">
                                        <a href="<?=Url::to(['event-location/index']);?>">
                                        <i class="material-icons">event_available</i>
                                        <p>Event Location</p>
                                        </a>
                                    </li>
                                    <li class="<?=($controller=='event-location-slots')?'sub-active':'';?>">
                                        <a href="<?=Url::to(['event-location-slots/index']);?>">
                                        <i class="material-icons">event_available</i>
                                        <p>Event Location Slot</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="<?=((strpos($controller,'speakers') !== false) || (strpos($controller,'speaker-role') !== false ) || (strpos($controller,'hotels') !== false ))?'active':'';?>">
                                <a href="<?=Url::to(['speakers/index']);?>">
                                    <i class="material-icons">mice</i>
                                    <p>Speakers</p>
                                </a>
                                <ul class="sub-menu">                                    
                                    <li class="<?=($controller=='speakers')?'sub-active':'';?>">
                                        <a href="<?=Url::to(['speakers/index']);?>">
                                        <i class="material-icons">event_available</i>
                                        <p>Speaker List</p>
                                        </a>
                                    </li>
                                    <li class="<?=($controller=='speaker-role')?'sub-active':'';?>">
                                        <a href="<?=Url::to(['speaker-role/index']);?>">
                                        <i class="material-icons">event_available</i>
                                        <p>Speaker Role</p>
                                        </a>
                                    </li> 
                                    <li class="<?=($controller=='hotels')?'sub-active':'';?>">
                                        <a href="<?=Url::to(['hotels/index']);?>">
                                            <i class="material-icons">event_available</i>
                                            <p>Hotels</p>
                                        </a>
                                    </li>                                    
                                </ul>
                            </li>                            
                            <li class="<?=(strpos($controller,'exhibitors') !== false )?'active':'';?>">
                                <a href="<?=Url::to(['exhibitors/index']);?>">
                                    <i class="material-icons">groups</i>
                                    <p>Exhibitors</p>
                                </a>
                                 <ul class="sub-menu">                                    
                                    <li class="<?=($controller=='exhibitors')?'sub-active':'';?>">
                                        <a href="<?=Url::to(['exhibitors/index']);?>">
                                        <i class="material-icons">event_available</i>
                                        <p>Exhibitors List</p>
                                        </a>
                                    </li>
                                    <li class="<?=($controller=='is-event-exhibitors')?'sub-active':'';?>">
                                        <a href="<?=Url::to(['is-event-exhibitors/index']);?>">
                                        <i class="material-icons">event_available</i>
                                        <p>Assign Exhibitors</p>
                                        </a>
                                    </li>
                                 </ul>
                            </li>
                            <li class="<?=(strpos($controller,'visitors') !== false )?'active':'';?>">
                                <a href="<?=Url::to(['visitors/index']);?>">
                                    <i class="material-icons">groups</i>
                                    <p>Visitors</p>
                                </a>
                            </li>
                            <li class="<?=($controller=='settings')?'active':'';?>">
                                <a href="<?=Url::to(['settings/index']);?>">
                                    <i class="material-icons">settings_applications</i>
                                    <p>System Configuration</p>
                                </a>
                            </li>
                            <li class="<?=($controller=='usersa')?'active':'';?>">
                                <a href="<?=Url::to(['site/logout']);?>">
                                    <i class="material-icons text-gray">logout</i>
                                    <?php
                                            echo Html::beginForm(['/site/logout'], 'post')
                                            . Html::submitButton(
                                            'Logout (' . Yii::$app->user->identity->username . ')',
                                            ['class' => 'btn btn-primary btn-simple btn-xs']
                                            )
                                            . Html::endForm();
                                        ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php }?>   
            <div class="main-panel <?php if(!Yii::$app->user->id){?>-guest<?php }?>">
                <?php
                    /*
                    NavBar::begin([
                    'brandLabel' => Yii::$app->name,
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                    ],
                    ]);

                    $menuItems = [
                    //['label' => 'Home', 'url' => ['/site/index']],
                    ];

                    if (Yii::$app->user->isGuest) {
                    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
                    } else {
                    $menuItems[] = '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>';
                    }

                    echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => $menuItems,
                    ]);                        

                    NavBar::end();
                    */
                ?>
                <?php if (!Yii::$app->user->isGuest) { ?>
                    <nav class="navbar navbar-transparent navbar-absolute">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>                                
                                    <a class="navbar-brand <?=(strpos($controller,'dashboard') !== false )?'top-menu-active dark':'';?>" href="<?= Url::to(['dashboard/index']);?>">Dashboard</a>
                                    <a class="navbar-brand <?=(strpos($controller,'user') !== false )?'top-menu-active dark':'';?>" href="<?= Url::to(['user/index']);?>">Users</a>
                                    <a class="navbar-brand <?=(strpos($controller,'event') !== false && strpos($controller,'exhibitors') === false )?'top-menu-active dark':'';?>" href="<?= Url::to(['events/index']);?>">Events</a>
                                    <a class="navbar-brand <?=((strpos($controller,'speakers') !== false) || (strpos($controller,'speaker-role') !== false ) || (strpos($controller,'hotels') !== false ))?'top-menu-active dark':'';?>" href="<?= Url::to(['speakers/index']);?>">Speakers</a>
                                    <a class="navbar-brand <?=(strpos($controller,'exhibitors') !== false )?'top-menu-active dark':'';?>" href="<?= Url::to(['exhibitors/index']);?>">Exhibitors</a>
                                    <a class="navbar-brand <?=(strpos($controller,'visitors') !== false )?'top-menu-active dark':'';?>" href="<?= Url::to(['visitors/index']);?>">Visitors</a>                                
                            </div>
                            <div class="collapse navbar-collapse">
                                <ul class="nav navbar-nav navbar-right">                
                                    <li>
                                        <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="material-icons">person</i>
                                            <p class="hidden-lg hidden-md">Profile</p>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?= Url::to(['user/view', 'id'=>Yii::$app->user->identity->id]);?>">Profile</a></li>                        
                                            <li>
                                                <?php
                                                    echo Html::beginForm(['/site/logout'], 'post')
                                                    . Html::submitButton(
                                                    'Logout (' . Yii::$app->user->identity->username . ')',
                                                    ['class' => 'btn btn-primary btn-simple btn-xs']
                                                    )
                                                    . Html::endForm();
                                                ?>
                                            </li>                        
                                        </ul>
                                    </li>
                                </ul>                            
                            </div>
                        </div>
                    </nav>
                    <?php } ?>

                <?php
                    /*Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])*/ ?>
                <?= Alert::widget() ?>
                <div class="content">
                    <div class="container-fluid">
                        <?= $content ?>
                    </div>
                </div>


                <footer class="footer">
                    <div class="container-fluid">
                        <nav class="pull-left">
                            <?php if (!Yii::$app->user->isGuest) { ?>
                                <ul>
                                    <li><a href="<?= Url::to(['dashboard/index']);?>" class="<?=(strpos($controller,'dashboard') !== false )?'footer-menu-active dark':'';?>">Dashboard</a></li>
                                    <li><a href="<?= Url::to(['user/index']);?>" class="<?=(strpos($controller,'user') !== false )?'footer-menu-active dark':'';?>">Users</a></li>
                                    <li><a href="<?= Url::to(['events/index']);?>" class="<?=(strpos($controller,'event') !== false && strpos($controller,'exhibitors') === false )?'footer-menu-active dark':'';?>">Events</a></li>
                                    <li><a href="<?= Url::to(['speakers/index']);?>" class="<?=((strpos($controller,'speakers') !== false) || (strpos($controller,'speaker-role') !== false ) || (strpos($controller,'hotels') !== false ))?'footer-menu-active dark':'';?>">Speakers</a></li>
                                    <li><a href="<?= Url::to(['exhibitors/index']);?>" class="<?=(strpos($controller,'exhibitors') !== false )?'footer-menu-active dark':'';?>">Exhibitors</a></li>
                                    <li><a href="<?= Url::to(['visitors/index']);?>" class="<?=(strpos($controller,'visitors') !== false )?'footer-menu-active dark':'';?>">Visitors</a></li>                                    
                                </ul>
                                <?php }?>
                        </nav>
                        <p class="copyright pull-right">
                            &copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?> | Powered by <a href="https://www.redsparkinfo.com" target="_blank">Redspark</a>
                        </p>
                    </div>
                </footer> 
            </div> 
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

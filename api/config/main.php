<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
    //require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),    
    'bootstrap' => ['log'],
    'modules' => [
        'event' => [
            'basePath' => '@app/modules/event',
            'class' => 'api\modules\event\Module'
        ]
    ],
    'components' => [ 
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'htmlLayout' => false,
        ],       
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        
        

    'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'event/user',
                    'extraPatterns' => [
                        'POST login' =>'login',
                        'POST speakers' =>'speakers',
                        'GET events' =>'events',
                        'GET eventstest' =>'eventstest',
                        'POST exibitors' =>'exibitors',
                        'POST attendevent' =>'attendevent',
                        'POST meetingrequest' =>'meetingrequest',
                        'POST meetingrequestlist' =>'meetingrequestlist',
                        'POST meetingconfirmation' =>'meetingconfirmation',
                        /*'POST signup' =>'signup',
                        'POST reset-password' =>'reset-password',
                        'POST social-login' =>'social-login',*/
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ]
                ],
            ],        
        ],
         'request' => [
            // Set Parser to JsonParser to accept Json in request
            'parsers' => [
                'application/json'  => 'yii\web\JsonParser',
            ]
        ],
    ],
    
    'params' => $params,
];




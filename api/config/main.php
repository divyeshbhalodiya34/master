<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'US/Central',
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'   // here is our v1 modules
        ]
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
        ],
        'request' => [
            'class' => '\yii\web\Request',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser'
            ]
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
            //'pagination' => false,
            'rules' => [
                [ 'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/admin-login','v1/front-login','v1/admin-register-users','v1/stripe-subscription','v1/admin-project','v1/master-data','v1/front-project','v1/projects'],
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ]
                ],
                'POST v1/projects/list-projects' => 'v1/projects/list-projects', //for project list
                'POST v1/projects/project-detail' => 'v1/projects/project-detail', //for project detail
                'POST v1/projects/save-project' => 'v1/projects/save-project', //for save project detail
                'POST v1/projects/delete-project' => 'v1/projects/delete-project', //for delete project
                
                'POST v1/tasks/list-tasks' => 'v1/tasks/list-tasks', //for task list
                'POST v1/tasks/task-detail' => 'v1/tasks/task-detail', //for task detail
                'POST v1/tasks/save-task' => 'v1/tasks/save-task', //for save task detail
                'POST v1/tasks/delete-task' => 'v1/tasks/delete-task', //for delete task

                'POST v1/tasks/add-comment' => 'v1/tasks/add-comment', //for add comment
                'POST v1/login/check-login' => 'v1/login/check-login', //for add comment
                'POST v1/login/logout' => 'v1/login/logout', //for add comment
                


                'POST v1/admin-login/login' => 'v1/admin-login/login', //for login admin panel
                'POST v1/admin-login/create-user' => 'v1/admin-login/create-user', //for createnew user in admin panel
                'POST v1/admin-login/create-front-user' => 'v1/admin-login/create-front-user', //for createnew user in admin panel
                'POST v1/admin-login/list-master-data' => 'v1/admin-login/list-master-data', //for createnew user in admin panel
                'GET v1/admin-login/list-user' => 'v1/admin-login/list-user', //for createnew user in admin panel
                'POST v1/admin-login/delete-user' => 'v1/admin-login/delete-user', //for delete user in admin panel
                'POST v1/admin-login/user-details' => 'v1/admin-login/user-details', //for update and retrive user details in admin panel
                'POST v1/front-login/login' => 'v1/front-login/login', //for login for front users
                'POST v1/front-login/register' => 'v1/front-login/register', //for login for front users
                'POST v1/front-login/forget-password' => 'v1/front-login/forget-password', //for get reset pasword link
                'POST v1/front-login/reset-password' => 'v1/front-login/reset-password', //for get reset pasword link
                'GET v1/front-login/activate-account' => 'v1/front-login/activate-account', //for Activate user Account
                'GET v1/front-login/check-user' => 'v1/front-login/check-user', //for register user check if exists
                'GET v1/front-login/list-company-type' => 'v1/front-login/list-company-type', //for listing companytype for registration
                'GET v1/admin-register-users/list-register-users' => 'v1/admin-register-users/list-register-users', //for createnew user in admin panel
                'POST v1/stripe-subscription/get-plan-details' => 'v1/stripe-subscription/get-plan-details', //for get Selected details of subscription plan
                'POST v1/stripe-subscription/start-subscription' => 'v1/stripe-subscription/start-subscription', //for Starting subscription
                'POST v1/stripe-subscription/stipe-webhooks' => 'v1/stripe-subscription/stipe-webhooks', //for createnew user in admin panel
                'GET v1/stripe-subscription/list-stripe-plan' => 'v1/stripe-subscription/list-stripe-plan', //for createnew user in admin panel
                'POST v1/admin-register-users/delete-user' => 'v1/admin-register-users/delete-user', //for createnew user in admin panel
                'POST v1/admin-register-users/update-user' => 'v1/admin-register-users/update-user', //for createnew user in admin panel
                'POST v1/admin-project/list-project-master-data' => 'v1/admin-project/list-project-master-data', //for login admin panel
                'POST v1/admin-project/create-project' => 'v1/admin-project/create-project', //for login admin panel
                'POST v1/admin-project/publish-project' => 'v1/admin-project/publish-project', //for login admin panel
                'POST v1/admin-project/unpublish-project' => 'v1/admin-project/unpublish-project', //for login admin panel
                'POST v1/admin-project/upload-project-documents' => 'v1/admin-project/upload-project-documents', //for login admin panel
                'POST v1/admin-project/upload-project-specs-documents' => 'v1/admin-project/upload-project-specs-documents', //for login admin panel
                'POST v1/admin-project/upload-project-drawing-documents' => 'v1/admin-project/upload-project-drawing-documents', //for login admin panel
                'GET  v1/admin-project/list-projects' => 'v1/admin-project/list-projects', //for login admin panel
                'POST v1/admin-project/delete-project' => 'v1/admin-project/delete-project', //for login admin panel
                'POST v1/admin-project/get-project-details' => 'v1/admin-project/get-project-details', //for login admin panel
                'POST v1/admin-project/update-project' => 'v1/admin-project/update-project', //for login admin panel
                'GET  v1/master-data/list-project-type' => 'v1/master-data/list-project-type', //for login admin panel
                'GET  v1/master-data/list-work-type' => 'v1/master-data/list-work-type', //for login admin panel
                'GET  v1/master-data/list-contractor-type' => 'v1/master-data/list-contractor-type', //for login admin panel
                'GET  v1/master-data/list-bidstage-type' => 'v1/master-data/list-bidstage-type', //for login admin panel
                'GET  v1/master-data/list-projectvalue-type' => 'v1/master-data/list-projectvalue-type', //for login admin panel
                'GET  v1/master-data/list-construction-type' => 'v1/master-data/list-construction-type', //for login admin panel
                'GET  v1/master-data/list-geography-type' => 'v1/master-data/list-geography-type', //for login admin panel
                'GET  v1/master-data/list-engineeringfirm-type' => 'v1/master-data/list-engineeringfirm-type', //for login admin panel
                'GET  v1/master-data/list-equipment-type' => 'v1/master-data/list-equipment-type', //for login admin panel
                'GET  v1/master-data/list-company-type' => 'v1/master-data/list-company-type', //for login admin panel
                'POST  v1/master-data/project-type-master-operation' => 'v1/master-data/project-type-master-operation', //for login admin panel
                'POST  v1/master-data/work-type-master-operation' => 'v1/master-data/work-type-master-operation', //for login admin panel
                'POST  v1/master-data/contractor-type-master-operation' => 'v1/master-data/contractor-type-master-operation', //for login admin panel
                'POST  v1/master-data/bidstage-type-master-operation' => 'v1/master-data/bidstage-type-master-operation', //for login admin panel
                'POST  v1/master-data/projectvalue-type-master-operation' => 'v1/master-data/projectvalue-type-master-operation', //for login admin panel
                'POST  v1/master-data/geography-type-master-operation' => 'v1/master-data/geography-type-master-operation', //for login admin panel
                'POST  v1/master-data/engineeringfirm-type-master-operation' => 'v1/master-data/engineeringfirm-type-master-operation', //for login admin panel
                'POST  v1/master-data/equipment-type-master-operation' => 'v1/master-data/equipment-type-master-operation', //for login admin panel
                'POST  v1/master-data/construction-type-master-operation' => 'v1/master-data/construction-type-master-operation', //for login admin panel
                'POST  v1/master-data/company-type-master-operation' => 'v1/master-data/company-type-master-operation', //for login admin panel
                'POST v1/front-project/list-project' => 'v1/front-project/list-project', //for login admin panel
                'POST v1/front-project/get-project-details' => 'v1/front-project/get-project-details', //for login admin panel
                'POST v1/front-project/add-as-favorite' => 'v1/front-project/add-as-favorite', //for login admin panel
                'POST v1/front-project/share-project' => 'v1/front-project/share-project', //for login admin panel
                'POST v1/front-project/get-shared-project-details' => 'v1/front-project/get-shared-project-details', //for login admin panel
                'POST v1/front-project/get-favorite-project' => 'v1/front-project/get-favorite-project', //for login admin panel
                'POST v1/front-project/get-user-profile-details' => 'v1/front-project/get-user-profile-details', //for login admin panel
                'GET v1/front-project/list-project-unsub' => 'v1/front-project/list-project-unsub', //for login admin panel

                'POST v1/front-project/list-category' => 'v1/front-project/list-category', //for login admin panel
                'POST v1/front-project/list-products' => 'v1/front-project/list-products', //for login admin panel
            ],
        ]
    ],
    'params' => $params,
];


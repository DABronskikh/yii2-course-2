<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'bootstrap'=>[
            'class' => \common\components\Bootstrap::class,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];

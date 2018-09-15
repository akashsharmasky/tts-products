<?php
return array(
    'components'=>array(
        //database of Magento1
        'db1' => array(
            'connectionString' => 'mysql:host=localhost;port=3306;dbname=ttsprodu_new',
            'emulatePrepare' => true,
            'username' => 'tts-products',
            'password' => 'PhEhP0Megot8BMVq',
            'charset' => 'utf8',
            'tablePrefix' => '',
            'class' => 'CDbConnection'
        ),
        //database of Magento 2 (we use this database for this tool too)
        'db' => array(
            'connectionString' => 'mysql:host=localhost;port=3306;dbname=ttsprodu_live',
            'emulatePrepare' => true,
            'username' => 'tts-products',
            'password' => 'PhEhP0Megot8BMVq',
            'charset' => 'utf8',
            'tablePrefix' => '',
            'class' => 'CDbConnection'
        ),
    )
);

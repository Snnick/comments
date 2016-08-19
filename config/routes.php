<?php

return array(


    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',

    // Управление постами:
    'admin/comment/create' => 'adminPost/create',
    'admin/comment/update/([0-9]+)' => 'adminPost/update/$1',
    'admin/comment/delete/([0-9]+)' => 'adminPost/delete/$1',
    'admin/comment' => 'adminPost/index',


    // Админпанель:
    'admin' => 'admin/index',

    'date/([0-9]+)/page-([0-9]+)' => 'comments/date/$1/$2',
    'page-([0-9]+)' => 'comments/index/$1',
    'date/([0-9]+)' => 'comments/date/$1',
    'name/([0-9]+)' => 'comments/name/$1',
    'email/([0-9]+)' => 'comments/email/$1',
    '' => 'comments/index',
);
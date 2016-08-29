<?php

$app->get('/install', '\Frimar\AppController:install')->setName('install');

$app->get('/contact/list', '\Frimar\ContactController:show_list')->setName('contact_list');
$app->any('/contact/new', '\Frimar\ContactController:create_new')->setName('contact_new');
$app->any('/contact/update/{id}', '\Frimar\ContactController:update')->setName('contact_update');
$app->get('/contact/delete/{id}', '\Frimar\ContactController:delete')->setName('contact_delete');

$app->post('/street/json_source', '\Frimar\StreetController:json_source')->setName('streets_json_source');

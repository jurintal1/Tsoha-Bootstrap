<?php

  $routes->get('/', function() {
    RecipeController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });




  $routes->get('/resepti/:id', function($id) {
    RecipeController::show($id);
  });

   $routes->get('/resepti/:id/muokkaa', function($id) {
    RecipeController::edit($id);
  });


  $routes->post('/resepti/:id/muokkaa', function($id) {
    RecipeController::update($id);
  });

  $routes->post('/resepti/:id/poista', function($id) {
    RecipeController::delete($id);
  });




  $routes->get('/lisaa_resepti', function() {
    RecipeController::add();
  });

  $routes->post('/lisaa_resepti', function() {
    RecipeController::store();
  });



  $routes->get('/muokkaa_kayttajaa', function() {
    HelloWorldController::editUser();
  });

  $routes->get('/login', function() {
    UserAccountController::login();
  });

  $routes->post('/login', function() {
    UserAccountController::handle_login();
  });





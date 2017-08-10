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

  $routes->get('/lisaa_resepti', function() {
    RecipeController::add();
  });

  $routes->post('/lisaa_resepti', function() {
    RecipeController::store();
  });




  $routes->get('/kayttajalista', function() {
    HelloWorldController::listUsers();
  });

  $routes->get('/kayttajalista', function() {
    HelloWorldController::listUsers();
  });


  $routes->get('/muokkaa_reseptia', function() {
    HelloWorldController::editRecipe();
  });

  $routes->get('/muokkaa_kayttajaa', function() {
    HelloWorldController::editUser();
  });





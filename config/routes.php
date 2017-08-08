<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/resepti', function() {
    HelloWorldController::recipe();
  });

  $routes->get('/reseptilista', function() {
    HelloWorldController::listRecipes();
  });

  $routes->get('/reseptilista', function() {
    HelloWorldController::listUsers();
  });

  $routes->get('/muokkaa_reseptia', function() {
    HelloWorldController::editRecipe();
  });

  $routes->get('/muokkaa_kayttajaa', function() {
    HelloWorldController::editUser();
  });



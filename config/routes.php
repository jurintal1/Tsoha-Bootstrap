<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/resepti', function() {
    HelloWorldController::resepti();
  });

  $routes->get('/lista', function() {
    HelloWorldController::lista();
  });

  $routes->get('/muokkaa', function() {
    HelloWorldController::muokkaa();
  });

  $routes->get('/etusivu', function() {
    HelloWorldController::etusivu();
  });
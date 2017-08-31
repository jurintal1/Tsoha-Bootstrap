<?php

function check_logged_in(){
  BaseController::check_logged_in();
}

function check_admin_logged_in(){
  BaseController::check_logged_in();
}

$routes->get('/', function() {
  RecipeController::index();
});


$routes->get('/resepti/:id', function($id) {
  RecipeController::show($id);
});

$routes->get('/resepti/:id/muokkaa','check_admin_logged_in', function($id) {
  RecipeController::edit($id);
});


$routes->post('/resepti/:id/muokkaa', 'check_admin_logged_in', function($id) {
  RecipeController::update($id);
});

$routes->post('/resepti/:id/poista', 'check_admin_logged_in', function($id) {
  RecipeController::delete($id);
});

$routes->get('/lisaa_resepti','check_logged_in', function() {
  RecipeController::add();
});

$routes->post('/lisaa_resepti', 'check_logged_in', function() {
  RecipeController::store();
});

$routes->get('/lisaa_kayttaja', function() {
  UserAccountController::add();
});

$routes->post('/lisaa_kayttaja', function() {
  UserAccountController::store();
});



$routes->get('/kayttaja/:id', 'check_admin_logged_in', function($id) {
  UserAccountController::edit($id);
});

$routes->post('/kayttaja/:id', 'check_admin_logged_in', function($id) {
  UserAccountController::update($id);
});

$routes->post('/kayttaja/:id/poista', 'check_admin_logged_in', function($id)
{
  UserAccountController::delete($id);
});

$routes->get('/kayttajat', 'check_admin_logged_in', function() {
  UserAccountController::index();
});




$routes->get('/login', function() {
  UserAccountController::login();
});

$routes->post('/login', function() {
  UserAccountController::handle_login();
});



$routes->post('/logout', function(){
  UserAccountController::logout();
});



$routes->get('/ainesosat', function(){
  IngredientController::ingredientList();
});

$routes->get('/ainesosa/:id', function($id) {
  IngredientController::showRecipes($id);
});







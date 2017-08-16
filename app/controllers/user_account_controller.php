<?php

	class UserAccountController extends BaseController {
	
		public static function index() {
			$users = UserAccount::all();
			View::make('user/userList.html', array('users' => $users));
		}

		public static function show($id) {
			$user = UserAccount::find($id);												
			View::make('user/user_list.html', array('user' => $user));
		}

		public static function login() {
				View::make('user/login.html');
		}

		public static function handle_login() {
			$params = $_POST;
			$user = UserAccount::authenticate($params['name'], $params['password']);

			if(!$user){
      			View::make('user/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'name' => $params['name']));
    		}else{
      			$_SESSION['user'] = $user->id;
      			Redirect::to('/', array('message' => 'Olet kirjautunut sisään tunnuksella ' . $user->name . '.'));  
      		}
		}


	}
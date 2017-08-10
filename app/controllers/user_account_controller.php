<?php

	class UserAccountController extends BaseController {
	
		public static function index() {
			$users = UserAccount::all();
			View::make('user/userList.html', array('users' => $users));
		}

		public static function show($id) {
			$user = UserAccount::find($id);												
			View::make('user/user_list.html', array('user' => $user);
		}
	}
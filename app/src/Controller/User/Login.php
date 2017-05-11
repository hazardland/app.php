<?php

	namespace App\Controller;

	Route::post('/login','User@login');
	Route::post('/logout','User@logout');

	class User
	{
		public function index ()
		{

		}
		public function login()
		{
			if ($_POST['username']!='' && $_POST['password']!='')
			{
				Auth::getDriver('basic')->login($_POST['username'],$_POST['password']);
				if (Auth::check())
				{
					return 1;
				}
			}
			return 0;
		}
		public function logout()
		{
			Auth::getDriver('basic')->logout();
		}
	}
<?php
	
	class Session
	{
		
		public static function init()
		{
			if (version_compare(phpversion(), '5.4.0','>')) 
			{
				if (session_id() == '')
				 {
					session_start();
				 }
				 else
				 {
				 	if (session_status() == PHP_SESSION_NONE)
				 	 {
				 	   session_start();
				 	 }
				 }
			}
		}

		public static function set($key , $val)
		{
			$_SESSION[$key] = $val;
		}
		public static function get($key)
		{
			if (isset($_SESSION[$key])) 
			{
				return $_SESSION[$key];
			}
			else
			{
				return false;
			}
		}
		
		public static function check_admin_login()
		{
			if (self::get("admin_login") != true) 
			{
				header("Location: Admin_Login_page.php");
			}
		}
		public static function check_staff_login()
		{
			if (self::get("staff_login") != true) 
			{
				header("Location: index.php");
			}
		}
		public static function check_student_login()
		{
			if (self::get("student_login") != true) 
			{
				header("Location: index.php");
			}
		}

		public static function destroy()
		{
			session_destroy();
			session_unset();
			header("Location: index.php");
		}
	

 }


?>
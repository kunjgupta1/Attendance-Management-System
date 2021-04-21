<?php
	include_once 'Session.php'; 
	include 'Database.php';
	Session::init();

	class Admin 
	{
		private $db;
		function __construct()
		{
			$this->db = new Database();
		}
/*----------------------------Admin----------------------------------------------------- */
		public function admin_addCourse($data)
		{
			$course_name = $data['course_name'];
			$check_course = $this->checkCourse($course_name);
		
			if (ctype_alpha($course_name) === false)
			 {
            	$msg = "<div><strong>Error! </strong>Name must only contain letters!</div>";
            	return $msg;
			 }
			if($check_course == true)
			 {
				$msg = "<div><strong>Error! </strong>Course Alredy exist</div>";
				return $msg;
			 }

			$sql = "INSERT INTO admin_add_course(course_name) VALUES(:course_name)";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':course_name' , strtoupper($course_name));
			$result = $query->execute();
			if ($result) 
			{
				$msg = "<div>Done</div>";
				return $msg;
			}
			else 
			{
				$msg = "<div>Error!</div>";
				return $msg;
			}
		}

		public function checkCourse($course_name)
		{
			$sql  = "SELECT * FROM admin_add_course WHERE course_name = :course_name";
		 			$query= $this->db->pdo->prepare($sql);
		 			$query->bindValue(':course_name' , strtoupper( $course_name));
		 			$query->execute();
		 			if($query->rowCount() > 0)
					{
						return true;
					}
					else
					{
						return false;
					}
		}
		public function admin_showCourse()
			{
				$sql = "SELECT * FROM admin_add_course ORDER BY course_name ASC";
				$query = $this->db->pdo->prepare($sql);
				$query->execute();
			    $result = $query->fetchAll();
			    return $result;			
			}

		public function admin_deleteCourse($course_id)
		{
			$sql = "DELETE FROM admin_add_course WHERE course_id = :course_id";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(":course_id",$course_id);
			$result = $query->execute();
			if ($result) 
			{
				$msg = "<div><strong>Success! </strong></div>";
				return $msg;
			}
			else
			 {
				$msg = "<div><strong>Sorry! </strong></div>";
				return $msg;
			}
		}

		/* Course add fuctionality*/


		public function admin_addStandard($data)
		{
			$standard_name = $data['standard_name'];
			$course_name = $data['course_name'];
			$check_standard = $this->checkStandard($standard_name,$course_name);
		
			if (!preg_match('/[?=(^1-9)][?=(^*s)][?=(^*t)]+$/', $standard_name)) 
            {
                $msg = "<div>Error!</div>";
                return $msg;
            }
			if (strlen($standard_name)>3) 
			{
				$msg = "<div>Error!</div>";
				return $msg;
			}
			if ($check_standard === true) 
			{
				$msg = "<div>Error!</div>";
				return $msg;
			}



			$sql = "INSERT INTO admin_add_standard(standard_name , course_name) VALUES(:standard_name,:course_name)";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':standard_name' , strtolower($standard_name));
			$query->bindValue(':course_name' , $course_name);
			$result = $query->execute();
			if ($result) 
			{
				$msg = "<div>Done</div>";
				return $msg;
			}
		}
		public function checkStandard($standard_name,$course_name)
		 		{
		 			$sql  = "SELECT * FROM admin_add_standard WHERE standard_name = :standard_name AND course_name = :course_name";
		 			$query= $this->db->pdo->prepare($sql);
		 			$query->bindValue(':standard_name' , $standard_name);
		 			$query->bindValue(':course_name' , $course_name);
		 			$query->execute();
		 			if($query->rowCount() > 0)
					{
						return true;
					}
					else
					{
						return false;
					}
		 		}
		public function admin_showStandard()
			{
				$sql = "SELECT * FROM admin_add_standard ORDER BY course_name ASC";
				$query = $this->db->pdo->prepare($sql);
				$query->execute();
			    $result = $query->fetchAll();
			    return $result;			
			}

		public function admin_deleteStandard($standard_id)
		{
			$sql = "DELETE FROM admin_add_standard WHERE standard_id = :standard_id";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(":standard_id",$standard_id);
			$result = $query->execute();
			if ($result) 
			{
				$msg = "<div><strong>Success! </strong></div>";
				return $msg;
			}
			else
			 {
				$msg = "<div><strong>Sorry! </strong></div>";
				return $msg;
			}
		}

		/* Standard add fuctionality*/

	   public function admin_addDivison($data)
		{
			$division_name      = $data['division_name'];
			$seat               = $data['seat'];
			$standard_name      = $data['standard'];
			$course_name        = $data['course_name'];
			$check_division     = $this->checkDivision($division_name,$standard_name,$course_name);

			
			if (filter_var($seat, FILTER_VALIDATE_INT) === false)
			{
				$msg = "<div>Seat!only have numbers</div>";
				return $msg;
			}
			if ($seat<50  || $seat>100)
			{
				$msg = "<div>Seat!greter then 50 or less then 100</div>";
				return $msg;
			}
			if (preg_match('/[^a-dA-D]/', $division_name)) 
			{
				$msg = "<div>division have character between a-d</div>";
				return $msg;
			}
			if (strlen($division_name)>1) 
			{
				$msg = "<div>division have character between A-D</div>";
				return $msg;
			}
			if ($check_division === true) 
			{
				$msg = "<div>Error!division and standard Alredy alloted</div>";
				return $msg;
			}

			$sql = "INSERT INTO admin_add_division(division_name , division_seat , standard_name,course_name) VALUES(:division_name , :seat , :standard_name,:course_name)";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':division_name' , strtoupper($division_name));
			$query->bindValue(':seat' , $seat);
			$query->bindValue(':standard_name' , $standard_name);
			$query->bindValue(':course_name' , $course_name);
			$result = $query->execute();

			if ($result) 
			{
				
			 $course_table_name = sprintf("%s_%s_%s",$course_name,$standard_name,$division_name);
			 $course_table_name =strtolower( $course_table_name );

			 $sql = "CREATE TABLE  $course_table_name (student_rollno_id INT PRIMARY KEY AUTO_INCREMENT,course_name VARCHAR(50),standard_name VARCHAR(50),division_name VARCHAR(50),student_name VARCHAR(30),student_mobile VARCHAR(30),student_email VARCHAR(30),student_dob VARCHAR(20),student_address VARCHAR(50),student_city VARCHAR(50),student_pincode VARCHAR(50),student_gender VARCHAR(50),student_photo VARCHAR(50),student_username VARCHAR(50),student_password VARCHAR(50))";
			 $query= $this->db->pdo->prepare($sql);	
		 	 $query->execute();

		 	 $course_table_name = sprintf("%s_%s_%s_%s",$course_name,$standard_name,$division_name,'Attendance');
		 	 $course_table_name =strtolower( $course_table_name );
			 $sql = "CREATE TABLE  $course_table_name (attendance_id INT PRIMARY KEY AUTO_INCREMENT,student_rollno INT,attendance_date date,attendance_status VARCHAR(50),attendance_by VARCHAR(50))";
			 $query= $this->db->pdo->prepare($sql);	
		 	 $query->execute();	

		 	 $msg = "<div>Done</div>";
			 return $msg;

			}		  	 												    
		}

		
		public function checkDivision($division_name,$standard_name,$course_name)
		 		{
		 			$sql  = "SELECT * FROM admin_add_division WHERE division_name = :division_name AND standard_name = :standard_name AND course_name = :course_name ";
		 			$query= $this->db->pdo->prepare($sql);
		 			$query->bindValue(':division_name' , $division_name);
		 			$query->bindValue(':standard_name' , $standard_name);
		 			$query->bindValue(':course_name' , $course_name);
		 			$query->execute();
		 			if($query->rowCount() > 0)
					{
						return true;
					}
					else
					{
						return false;
					}
		 		}

		public function admin_showStandard_ByCourse($course_name)
			{
				$sql = "SELECT standard_name FROM admin_add_standard WHERE course_name = :course_name";
				$query = $this->db->pdo->prepare($sql);
				$query->bindValue(":course_name" ,$course_name);
				$query->execute();
			    $result = $query->fetchAll();
			    return $result;
			}

		public function admin_showDivision()
			{
				$sql = "SELECT * FROM admin_add_division";
				$query = $this->db->pdo->prepare($sql);
				$query->execute();
			    $result = $query->fetchAll();
			    return $result;			
			}

		public function admin_deleteDivison($division_id)
		{ 
			$sql = "DELETE FROM admin_add_division WHERE division_id = :division_id";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(":division_id",$division_id);
			$result = $query->execute();
			if ($result) 
			{
				$msg = "<div><strong>Success! </strong></div>";
				return $msg;
			}
			else
			 {
				$msg = "<div><strong>Sorry! </strong></div>";
				return $msg;
			}
		}

		/* ADMIN Division  fuctionality*/
		// filter data
		public function filter_data($data) 
		{
			  $data = trim($data);
			  $data = stripslashes($data);
			  $data = htmlspecialchars($data);
			  return $data;
			}

		public function admin_addStaff($data,$file_temp,$uploaded_image)
		 		{				
		 			$staff_name       = $this->filter_data($data['staff_name']);
		 			$email 			  = $this->filter_data($data['email']);
		 			$mobile 		  = $this->filter_data($data['mobile']);
		 			$qualification    = $this->filter_data($data['qualification']);
		 			$address 		  = $this->filter_data($data['address']);
		 			$city		 	  = $this->filter_data($data['city']);
		 			$pincode 		  = $this->filter_data($data['pincode']);
		 			$gender 		  = $this->filter_data($data['gender']);
		 			$course_name      = $this->filter_data($data['course_name']);
		 			$standard_name    = $this->filter_data($data['standard']);
		 			$username 		  = $this->filter_data($data['username']);
		 			$password 		  = $this->filter_data(md5($data['password']));
		 			$confirm_password = $this->filter_data(md5($data['confirm_password']));
		 			$check_email      = $this-> checkEmail($email);
		 			$check_phonenumber=	$this-> check_phonenumber($mobile);
		 			$check_username   =$this->check_username($username);

		 			if (ctype_alpha($staff_name) === false)
					 {
		            	$msg = "<div><strong>Error! </strong>Name must only contain letters!</div>";
		            	return $msg;
					 }


					if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) 
					 {
						$msg = "<div><strong>Error! </strong>Email address is not valid!</div>";
						return $msg;
					 }
					if (strlen($username) < 4) 
					 {
						$msg = "<div><strong>Error! </strong>Username to short</div>";
						return $msg;
					 }
					 if (preg_match("/[^a-zA-Z0-9., ]/",$address))
					  {
					 	$msg = "<div><strong>Error! </strong>enter valid address!</div>";
						return $msg;
					 }
					 if (preg_match("/[^a-zA-Z, ]/",$qualification))
					  {
					 	$msg = "<div><strong>Error! </strong>enter valid qualification!</div>";
						return $msg;
					 }
					
					if($check_email == true)
					 {
						$msg = "<div><strong>Error! </strong>email Alredy exist</div>";
						return $msg;
					 }

					 if(preg_match('/[^0-9]+/i',$mobile))
					{
						$msg = "<div><strong>Error! </strong>phone number must only contain number!</div>";
						return $msg;
					}
					
					
					if(strlen($mobile)>10 OR strlen($mobile)<10)
					{
						$msg = "<div><strong>Error! </strong>Phone number is not valid</div>";
						return $msg;
					}
					if($check_phonenumber == true)
					{
						$msg = "<div><strong>Error! </strong>phone number Alredy exist</div>";
						return $msg;
					}

					if($check_username == true)
					{
						$msg = "<div><strong>Error! </strong>Username  Alredy exist</div>";
						return $msg;
					}

					if (ctype_alpha($city) === false)
					 {
		            	$msg = "<div><strong>Error! </strong>city must only contain letters!</div>";
		            	return $msg;
					 }
					if (filter_var($pincode, FILTER_VALIDATE_INT) === false)
					{
						$msg = "<div>pincode!only have number</div>";
						return $msg;
					}
		 			if ($password != $confirm_password)
		 			 {
		 				$msg = "<div><strong>Sorry! </strong></div>";
						return $msg;

		 			}		
					
					  

		 			$sql = "INSERT INTO admin_add_staff(staff_name , staff_email , staff_mobile ,staff_qualification ,staff_address,staff_city,staff_pincode,staff_gender	,staff_photo,staff_course_name,staff_std_name, staff_username, staff_password)

		 			    VALUES(:staff_name , :email , :mobile, :qualification ,:address ,:city,:pincode,:gender,:uploaded_image,:course_name,:standard_name,:username,:password)";

					$query = $this->db->pdo->prepare($sql);
					$query->bindValue(':staff_name' , $staff_name);
					$query->bindValue(':email' , $email);
					$query->bindValue(':mobile' , $mobile);
					$query->bindValue(':qualification' , $qualification);
					$query->bindValue(':address' , $address);
					$query->bindValue(':city' , $city);
					$query->bindValue(':pincode' , $pincode);
					$query->bindValue(':gender' , $gender);

					$query->bindValue(':uploaded_image' , $uploaded_image);
					$query->bindValue(':course_name' , $course_name);
					$query->bindValue(':standard_name' , $standard_name);
					$query->bindValue(':username' , $username);
					$query->bindValue(':password' , $password);
					
					$result = $query->execute();
					if ($result) 
					{
						move_uploaded_file($file_temp,$uploaded_image);
						$msg = "<div><strong>Success! </strong></div>";
						return $msg;
					}
					else
					 {
						$msg = "<div><strong>Sorry! </strong></div>";
						return $msg;
					}
		 		}
		 	public function checkEmail($email)
		 		{
		 			$sql  = "SELECT * FROM admin_add_staff WHERE staff_email = :email";
		 			$query= $this->db->pdo->prepare($sql);
		 			$query->bindValue(':email' , $email);
		 			$query->execute();
		 			if($query->rowCount() > 0)
					{
						return true;
					}
					else
					{
						return false;
					}
		 		}
		 		
		 	public function check_phonenumber($mobile)
		 		{
		 			$sql = "SELECT * FROM admin_add_staff WHERE staff_mobile = :mobile";
		 			$query= $this->db->pdo->prepare($sql);
		 			$query->bindValue(':mobile' , $mobile);
		 			$query->execute();
		 			if($query->rowCount() > 0)
					{
						return true;
					}
					else
					{
						return false;
					}
		 		}
		 		public function check_username($username)
		 		{
		 			$sql = "SELECT * FROM admin_add_staff WHERE staff_username = :username";
		 			$query= $this->db->pdo->prepare($sql);
		 			$query->bindValue(':username' , $username);
		 			$query->execute();
		 			if($query->rowCount() > 0)
					{
						return true;
					}
					else
					{
						return false;
					}
		 		}


		 	public function showStaffDetails()
	 		 		{
	 		 			$sql = "SELECT * FROM admin_add_staff";
						$query = $this->db->pdo->prepare($sql);
						$query->execute();
					    $result = $query->fetchAll();
					    return $result;	
	 		 		}

	 		public function admin_deleteStaff_report($staff_id)
			{   
				$sql = "SELECT staff_photo FROM admin_add_staff WHERE staff_id = :staff_id";
				$query = $this->db->pdo->prepare($sql);
				$query->bindValue(":staff_id",$staff_id);
				$query->execute();
				$result = $query->fetch(PDO::FETCH_OBJ);
				if ($result) 
				{
						
			    	$name = $result->staff_photo;
				}

				$sql = "DELETE FROM admin_add_staff WHERE staff_id = :staff_id";
				$query = $this->db->pdo->prepare($sql);
				$query->bindValue(":staff_id",$staff_id);
				$result = $query->execute();
				if ($result) 
				{	
					unlink($name);
					$msg = "<div><strong>Success! </strong></div>";
					return $msg;
				}
				else
				 {
					$msg = "<div><strong>Sorry! </strong></div>";
					return $msg;
				}
			}

			public function get_Student($course_table_name,$rollno)
			{
				$sql = "SELECT * FROM $course_table_name WHERE student_rollno_id = :rollno LIMIT 1";
				$query = $this->db->pdo->prepare($sql);
				$query->bindValue(':rollno', $rollno);
				$query->execute();
				$result = $query->fetch(PDO::FETCH_OBJ);
				return $result;
			}
/*----------------------------Admin  End----------------------------------------------------- */			
/*  -------------------------------------------------------------------------------------*/			 	

			public function staff_LoginStaff($data)
			{
				$username = $data['username'];
				$password = md5($data['password']);

				$sql = "SELECT * FROM admin_add_staff WHERE staff_username = :username AND staff_password = :password";
				$query = $this->db->pdo->prepare($sql);
				$query->bindValue(':username' , $username);
				$query->bindValue(':password' , $password);
				$query->execute();

				$result = $query->fetch(PDO::FETCH_OBJ);
				if ($result) 
				{
						
			    	Session::init();
			    	Session::set("staff_login" , true);
			    	Session::set("staff_id" , $result->staff_id);
			    	Session::set("staff_name" , $result->staff_name);
			    	Session::set("staff_username" , $result->staff_username);
			    	Session::set("staff_std_name" , $result->staff_std_name);
			    	Session::set("staff_course_name" , $result->staff_course_name);
			    	Session::set("staff_photo" , $result->staff_photo);
			    	Session::set("loginmsg" , "<div> <strong>Sucess! </strong>You are logged in!</div>");
				    header("Location: Staff_page.php");
				}
				 else
				 {
				 	$msg = "<div ><strong>Error! </strong>data not found</div>";
					return $msg;
				 }

			}


			public function staff_show_homepage($staff_id)
			{
				$sql = "SELECT * FROM admin_add_staff WHERE staff_id = :staff_id LIMIT 1";
				$query = $this->db->pdo->prepare($sql);
				$query->bindValue(':staff_id', $staff_id);
				$query->execute();
				$result = $query->fetch(PDO::FETCH_OBJ);
				return $result;
			}
			public function photoupdate($staff_id)
			{
				$sql = "SELECT staff_photo FROM admin_add_staff WHERE staff_id = :staff_id";
				$query = $this->db->pdo->prepare($sql);
				$query->bindValue(":staff_id",$staff_id);
				$query->execute();
				$result = $query->fetch(PDO::FETCH_OBJ);
				return $result;
			}
			public function staff_update_homepage($staff_id , $data , $uploaded_image , $file_temp)
			{
				$email   	= $data['email'];
				$mobile  	= $data['mobile'];	
				$address 	= $data['address'];
				$city    	= $data['city'];
				$pincode    = $data['pincode'];
 

				if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) 
				 {
					$msg = "<div><strong>Error! </strong>Email address is not valid!</div>";
					return $msg;
				 }
				
			    if(preg_match('/[^0-9]+/i',$mobile))
			   	 {
					$msg = "<div><strong>Error! </strong>phone number must only contain number!</div>";
					return $msg;
				 }
				if(strlen($mobile)>10 OR strlen($mobile)<10)
				 {
					$msg = "<div><strong>Error! </strong>Phone number is not valid</div>";
					return $msg;
				 }
				 if (ctype_alpha($city) === false)
				 {
	            	$msg = "<div><strong>Error! </strong>city must only contain letters!</div>";
	            	return $msg;
				 }
				if (filter_var($pincode, FILTER_VALIDATE_INT) === false)
				{
					$msg = "<div>pincode!only have number</div>";
					return $msg;
				}

				$sql = "UPDATE admin_add_staff set
						staff_email  = :email,
						staff_mobile = :mobile,
						staff_address=:address,
						staff_city   =:city,
						staff_pincode=:pincode,
						staff_photo  = :uploaded_image
						WHERE staff_id = :staff_id";
				$query = $this->db->pdo->prepare($sql);
				$query->bindValue(':email', $email);
				$query->bindValue(':mobile', $mobile);
				$query->bindValue(':address', $address);
				$query->bindValue(':city', $city);
				$query->bindValue(':pincode', $pincode);
				$query->bindValue(':uploaded_image', $uploaded_image);
				$query->bindValue(':staff_id', $staff_id);

				$result = $query->execute();		
				if ($result) 
				{
					Session::set("staff_photo" , $uploaded_image);
					move_uploaded_file($file_temp,$uploaded_image);

					$msg = "<div class='alert alert-success'><strong>Success! </strong>Update successfully</div>";
					return $msg;

				}
				else
				 {
					$msg = "<div class='alert alert-danger'><strong>Sorry! </strong>NOt Update</div>";
					return $msg;
				}									
				
			}

			public function staff_showDivision($course_name,$standard)
			{
				$sql  = "SELECT * FROM admin_add_division WHERE standard_name = :standard_name AND course_name = :course_name";
		 			$query= $this->db->pdo->prepare($sql);
		 			$query->bindValue(':standard_name' , $standard);
		 			$query->bindValue(':course_name' , $course_name);
		 			$query->execute();
		 			$result = $query->fetchAll();
			    	return $result;	
			}
			
			public function staff_addStudentdata($data,$check_student_table,$course_name,$standard,$division_name,$file_temp,$uploaded_image)
			{
				$student_name     			= $data["student_name"];
				$student_mobile         	= $data["student_mobile"];
				$student_email    			= $data["student_email"];
				$student_dob      			= $data["student_dob"];
				$student_address  			= $data["student_address"];
				$student_city     			= $data["student_city"];
				$student_pincode  			= $data["pincode"];
				$student_gender   			= $data["gender"];
				$student_username        	= $data["student_username"];
				$student_password           = md5($data["student_password"]);
				$student_confirm_password   = md5($data["student_confirm_password"]);

				$Checked_User_Name			= $this->Check_User_Name($student_username);
				$Checked_User_email			= $this->Check_User_Email($student_email);
				$Checked_User_mobile		= $this->Check_User_Mobile($student_mobile);

				if ($Checked_User_Name === true)
					 {
		            	$msg = "<div><strong>Error! </strong>username already used</div>";
		            	return $msg;
					 }
				if ($Checked_User_email === true)
					 {
		            	$msg = "<div><strong>Error! </strong>email already used</div>";
		            	return $msg;
					 }	 
				if ($Checked_User_mobile === true)
					 {
		            	$msg = "<div><strong>Error! </strong>mobile already used</div>";
		            	return $msg;
					 }	 

				if (ctype_alpha($student_name) === false)
					 {
		            	$msg = "<div><strong>Error! </strong>Name must only contain letters!</div>";
		            	return $msg;
					 }

				if (filter_var($student_email, FILTER_VALIDATE_EMAIL) === false) 
				 {
					$msg = "<div><strong>Error! </strong>Email address is not valid!</div>";
					return $msg;
				 }

				

				 if(preg_match('/[^0-9]+/i',$student_mobile))
				{
					$msg = "<div><strong>Error! </strong>phone number must only contain number!</div>";
					return $msg;
				}
					
				if(strlen($student_mobile)>10 OR strlen($student_mobile)<10)
				{
					$msg = "<div><strong>Error! </strong>Phone number is not valid</div>";
					return $msg;
				}
				
				if (ctype_alpha($student_city) === false)
				 {
	            	$msg = "<div><strong>Error! </strong>city must only contain letters!</div>";
	            	return $msg;
				 }
				 if (filter_var($student_pincode, FILTER_VALIDATE_INT) === false)
				{
					$msg = "<div>pincode!only have number</div>";
					return $msg;
				}
	 			if ($student_password  != $student_confirm_password)
	 			 {
	 				$msg = "<div><strong>Enter correct password! </strong></div>";
					return $msg;

	 			}
		 
				$sql = "INSERT INTO $check_student_table(course_name,standard_name,
									division_name,student_name,student_mobile,student_email,
									student_dob,student_address,student_city,student_pincode,
									student_gender,student_photo,student_username,
									student_password)

		 			    VALUES(:course_name,:standard_name,:division_name,:student_name,
		 			    		:student_mobile,:student_email, :student_dob,:student_address,
		 			    		:student_city,:student_pincode,:student_gender,:student_photo,
		 			    		:student_username,:student_password)";

		 		$query = $this->db->pdo->prepare($sql); 		

		 		$query->bindValue(":course_name" ,$course_name);
		 		$query->bindValue(":standard_name" ,$standard);
		 		$query->bindValue(":division_name" ,$division_name);
		 		
		 		$query->bindValue(":student_name" ,$student_name);
		 		$query->bindValue(":student_mobile" ,$student_mobile);
		 		$query->bindValue(":student_email" ,$student_email);
		 		$query->bindValue(":student_dob" ,$student_dob);
		 		$query->bindValue(":student_address" ,$student_address);
		 		$query->bindValue(":student_city" ,$student_city);
		 		$query->bindValue(":student_pincode" ,$student_pincode);
		 		$query->bindValue(":student_gender" ,$student_gender);
		 		$query->bindValue(":student_photo" ,$uploaded_image);
		 		$query->bindValue(":student_username" ,$student_username);
		 		$query->bindValue(":student_password" ,$student_password);	
		 		
		 		$result = $query->execute();
					if ($result) 
					{
						move_uploaded_file($file_temp,$uploaded_image);
						$msg = "<div><strong>Success! </strong></div>";
						return $msg;
					}
					else
					 {
						$msg = "<div><strong>Sorry! </strong></div>";
						return $msg;
					}    
			}
		public function Check_User_Name($username)
		{	
			$value ;
			$sql   = "SELECT course_name FROM admin_add_course";
			$query = $this->db->pdo->prepare($sql);
		    $query->execute();
		 	$course = $query->fetchAll();
			if ($course) 
			{
					foreach ($course as $course_n) 
					{
						
						$sql   = "SELECT standard_name FROM admin_add_standard WHERE course_name = :course_n";
						$query = $this->db->pdo->prepare($sql);
						$query->bindValue(":course_n" ,$course_n["course_name"]);
					    $query->execute();
					 	$standard = $query->fetchAll();
					 	if ($standard) 
					 	{
					 		foreach ($standard as $standard_n) 
					 		{
					 			$sql   = "SELECT division_name FROM admin_add_division WHERE standard_name = :standard_n";
								$query = $this->db->pdo->prepare($sql);
								$query->bindValue(":standard_n" ,$standard_n["standard_name"]);
							    $query->execute();
							 	$division = $query->fetchAll();
							 	if ($division) 
							 	{
							 		foreach ($division as $division_n) 
							 		{
							 			$table_name = strtolower(sprintf('%s_%s_%s',$course_n["course_name"],$standard_n["standard_name"],$division_n["division_name"]));
							 			$sql   = "SELECT * FROM $table_name WHERE student_username = :student_usern";
										$query = $this->db->pdo->prepare($sql);
										$query->bindValue(":student_usern" ,$username);
							    		$query->execute();
							 			if($query->rowCount() > 0)
										{
											return true;
										}
										
							 		}
							 	}
					 		}	
					 	}
					}
					return false;
			}

		}
		public function Check_User_Email($email)
		{	$value;

			$sql   = "SELECT course_name FROM admin_add_course";
			$query = $this->db->pdo->prepare($sql);
		    $query->execute();
		 	$course = $query->fetchAll();
			if ($course) 
			{
					foreach ($course as $course_n) 
					{
						
						$sql   = "SELECT standard_name FROM admin_add_standard WHERE course_name = :course_n";
						$query = $this->db->pdo->prepare($sql);
						$query->bindValue(":course_n" ,$course_n["course_name"]);
					    $query->execute();
					 	$standard = $query->fetchAll();
					 	if ($standard) 
					 	{
					 		foreach ($standard as $standard_n) 
					 		{
					 			$sql   = "SELECT division_name FROM admin_add_division WHERE standard_name = :standard_n";
								$query = $this->db->pdo->prepare($sql);
								$query->bindValue(":standard_n" ,$standard_n["standard_name"]);
							    $query->execute();
							 	$division = $query->fetchAll();
							 	if ($division) 
							 	{
							 		foreach ($division as $division_n) 
							 		{
							 			$table_name = strtolower(sprintf('%s_%s_%s',$course_n["course_name"],$standard_n["standard_name"],$division_n["division_name"]));
							 			$sql   = "SELECT * FROM $table_name WHERE student_email = :student_email";
										$query = $this->db->pdo->prepare($sql);
										$query->bindValue(":student_email" ,$email);
							    		$query->execute();
							 			if($query->rowCount() > 0)
										{
											return true;
										}
										
							 		}
							 	}
					 		}	
					 	}
					}
					return false;
			}
		}
		public function Check_User_Mobile($mobile)
		{
			$value;
			$sql   = "SELECT course_name FROM admin_add_course";
			$query = $this->db->pdo->prepare($sql);
		    $query->execute();
		 	$course = $query->fetchAll();
			if ($course) 
			{
					foreach ($course as $course_n) 
					{
						
						$sql   = "SELECT standard_name FROM admin_add_standard WHERE course_name = :course_n";
						$query = $this->db->pdo->prepare($sql);
						$query->bindValue(":course_n" ,$course_n["course_name"]);
					    $query->execute();
					 	$standard = $query->fetchAll();
					 	if ($standard) 
					 	{
					 		foreach ($standard as $standard_n) 
					 		{
					 			$sql   = "SELECT division_name FROM admin_add_division WHERE standard_name = :standard_n";
								$query = $this->db->pdo->prepare($sql);
								$query->bindValue(":standard_n" ,$standard_n["standard_name"]);
							    $query->execute();
							 	$division = $query->fetchAll();
							 	if ($division) 
							 	{
							 		foreach ($division as $division_n) 
							 		{
							 			$table_name = strtolower(sprintf('%s_%s_%s',$course_n["course_name"],$standard_n["standard_name"],$division_n["division_name"]));
							 			$sql   = "SELECT * FROM $table_name WHERE student_mobile = :student_mobile";
										$query = $this->db->pdo->prepare($sql);
										$query->bindValue(":student_mobile" ,$mobile);
							    		$query->execute();
							 			if($query->rowCount() > 0)
										{
											return true;
										}
										
							 		}
							 	}
					 		}	
					 	}
					}
					return false;
			}
		}
		
		public function checkDevisionSeat($division_name,$standard,$course_name)
			{
				$sql = "SELECT *FROM admin_add_division WHERE division_name =:division_name AND standard_name= :standard_name AND course_name= :course_name";
				$query = $this->db->pdo->prepare($sql);
				$query->bindValue(":division_name" ,$division_name);
		 		$query->bindValue(":standard_name" ,$standard);
		 		$query->bindValue(":course_name" ,$course_name);
		 		$query->execute();
				$result = $query->fetch(PDO::FETCH_OBJ);
				return $result;
			}	


/* staff_page_add_student functionality*/

			public function CountSeats($check_student_table)
			{
				$sql = "SELECT Count(*) FROM $check_student_table";
				$query = $this->db->pdo->prepare($sql);
		 		$query->execute();
				$result = $query->fetchColumn();
				return $result;
			}

			public function Getrollno($check_student_table)
			{
				$sql = "SELECT max(student_rollno_id) FROM $check_student_table";
				$query = $this->db->pdo->prepare($sql);
		 		$query->execute();
				$result = $query->fetchColumn();
				if ($result == NULL ) 
				{
					return 1;
				}
				else
				{
				 return $result+1;
			   }
			} 						


/* student report page*/
	
			public function staff_report_standard($course_name)
			 {
				$sql = "SELECT DISTINCT standard_name FROM admin_add_division WHERE course_name = :course_name";
				$query = $this->db->pdo->prepare($sql);
				$query->bindValue(":course_name" ,$course_name);
				$query->execute();
			    $result = $query->fetchAll();
			    return $result;		 	
			 }


			 public function staff_report_ShowStudent($check_student_table)
			 {
				$sql = "SELECT * FROM $check_student_table";
				$query = $this->db->pdo->prepare($sql);
				$query->execute();
			    $result = $query->fetchAll();
			    return $result;		 	
			 }
			 public function staff_deleteStudent($student_id,$check_student_table)
			 {
				$sql = "DELETE FROM $check_student_table WHERE student_rollno_id = :student_id";
				$query = $this->db->pdo->prepare($sql);
				$query->bindValue(":student_id",$student_id);
				$result = $query->execute();
				if ($result) 
				{
					$msg = "<div><strong>Success! </strong></div>";
					return $msg;
				}
				else
				 {
					$msg = "<div><strong>Sorry! </strong></div>";
					return $msg;
				}
			 }	
/* student report page end*/

			 public function student_add_attendance($attendance_status = array(),$date,$check_student_table,$staff_name)
 				{
 				
 					$check_student_table_att = sprintf("%s_%s",$check_student_table,'attendance');

 					$sql = "SELECT attendance_date FROM $check_student_table_att";
 					$query= $this->db->pdo->prepare($sql);
 					$query->execute();
 					$att_date = $query->fetchAll();
 					if ($att_date) 
 					{
 						foreach ($att_date as $attendance) 
 						{
 							 $db_att_date = $attendance['attendance_date'];
 							 if ($date == $db_att_date)
 							  {
 							 	 $msg = "<div class='alert alert-danger'><strong>Error !</strong>Attandace was taken !</div>";
         						 return $msg; 
 							  }
 						}
 					}

 					foreach ($attendance_status as $attendance_key => $attendance_value) 
 					{
 						if ($attendance_value == "Absent") 
 						{ 
 							$sql = "INSERT INTO $check_student_table_att(student_rollno,attendance_date,attendance_status,attendance_by)

 							    VALUES(:student_rollno,:attendance_date,:attendance_status,:attendance_by)";
 							$query= $this->db->pdo->prepare($sql);
 							$query->bindValue(':student_rollno',$attendance_key);
 							$query->bindValue(':attendance_date',$date);
 							$query->bindValue(':attendance_status','Absent');
 							$query->bindValue(':attendance_by',$staff_name);
 							$result = $query->execute();
 				
 						}

 						if ($attendance_value == "Present") 
 						{
 							$sql = "INSERT INTO $check_student_table_att(student_rollno,attendance_date,attendance_status,attendance_by)

 							    VALUES(:student_rollno,:attendance_date,:attendance_status,:attendance_by)";
 							$query= $this->db->pdo->prepare($sql);
 							$query->bindValue(':student_rollno',$attendance_key);
 							$query->bindValue(':attendance_date',$date);
 							$query->bindValue(':attendance_status','Present');
 							$query->bindValue(':attendance_by',$staff_name);
 							$result = $query->execute();
 							
 						}

 					}
 					if ($result) 
 					{
 						$msg = "<div><strong>Sucess !</strong> Student attendance inserted sucessfully</div>";
      					return $msg;
 					}

 					else
				    {
				      $msg = "<div><strong>Error !</strong>Student attendance not inserted!</div>";
				      return $msg;
				    }
			    	
 				}				
						/*student Attendance Report*/


				public function student_att_report($date,$check_student_table)
					{
						$check_student_table_att = sprintf("%s_%s",$check_student_table,'attendance');
						$sql = "SELECT $check_student_table.student_name,$check_student_table_att.*
								FROM $check_student_table
								INNER JOIN $check_student_table_att
								ON $check_student_table.student_rollno_id = $check_student_table_att.student_rollno
								WHERE attendance_date = :att_date";
						$query = $this->db->pdo->prepare($sql);
						$query->bindValue(":att_date",$date);
						$query->execute();
						$result = $query->fetchAll();
						return $result;		
					}		

					/*staff Advance report*/

				public function get_AllStudent_Data($check_student_table)
					{
						$sql = "SELECT student_rollno_id,student_name FROM $check_student_table";
						$query = $this->db->pdo->prepare($sql);
						$query->execute();
					    $result = $query->fetchAll();
					    return $result;
					}

				public function get_Student_data($check_student_table,$rollno)
					{
						$sql = "SELECT * FROM $check_student_table WHERE student_rollno_id = :rollno";
						$query = $this->db->pdo->prepare($sql);
						$query->bindValue(':rollno',$rollno);
						$query->execute();
					    $result = $query->fetchAll();
					    return $result;
					}

					/*Advance att report*/
				public function student_data_Byroll($student_roll,$check_student_table)
					{
						$check_student_table_att = sprintf("%s_%s",$check_student_table,'attendance');
						$sql = "SELECT $check_student_table.student_name,$check_student_table_att.*
								FROM $check_student_table
								INNER JOIN $check_student_table_att
								ON $check_student_table.student_rollno_id = $check_student_table_att.student_rollno
								WHERE student_rollno = :student_rollno";
						$query = $this->db->pdo->prepare($sql);
						$query->bindValue(":student_rollno",$student_roll);
						$query->execute();
						$result = $query->fetchAll();
						return $result;		
					}
				
				/*change password*/

		public function checkPassword($staff_id , $old_password)
		{
			$password = md5($old_password);
			$sql = "SELECT staff_password FROM admin_add_staff WHERE staff_id = :staff_id AND staff_password = :password";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':staff_id', $staff_id);
			$query->bindValue(':password', $password);
			$query->execute();
			if($query->rowCount() > 0)
			{
				return true;
			}
			else
			{
				return false;
			}

		}
		
			public function staff_changePassword($staff_id ,$data)
			{
				$old_password     = $data['old_password'];
				$new_password     = $data['new_password'];
				$confirm_password = $data['confirm_password'];

				$check_password   = $this->checkPassword($staff_id,$old_password);

				if ($check_password == false) 
				{
					$msg = "<div><strong>Sorry! </strong>old password not exsist</div>";
					return $msg;
				}
				if (strlen($new_password) < 6) 
				{
					$msg = "<div><strong>Sorry! </strong>password to short</div>";
					return $msg;
				}
				elseif ($new_password != $confirm_password)
				{
					$msg = "<div><strong>Sorry! </strong>password must be same</div>";
					return $msg;
			   }

				$password = md5($new_password);
				$sql = "UPDATE admin_add_staff set
				   staff_password = :password
				   WHERE staff_id	= :staff_id";
				$query = $this->db->pdo->prepare($sql);
				
				$query->bindValue(':password', $password);
				$query->bindValue(':staff_id', $staff_id);
				$result = $query->execute();
				if ($result) 
				{
					$msg = "<div><strong>Success! </strong>Update successfully</div>";
					return $msg;
				}
				else
				 {
					$msg = "<div><strong>Sorry! </strong>password NOt Update</div>";
					return $msg;
				}
			}

			/*Student login functionality*/


			public function Student_LoginStudent($data)
			{
				$username = $data['username'];
				$password = md5($data['password']);
				$sql   = "SELECT course_name FROM admin_add_course";
				$query = $this->db->pdo->prepare($sql);
			    $query->execute();
			 	$course = $query->fetchAll();
				if ($course) 
				{
					foreach ($course as $course_n) 
					{
						
						$sql   = "SELECT standard_name FROM admin_add_standard WHERE course_name = :course_n";
						$query = $this->db->pdo->prepare($sql);
						$query->bindValue(":course_n" ,$course_n["course_name"]);
					    $query->execute();
					 	$standard = $query->fetchAll();
					 	if ($standard) 
					 	{
					 		foreach ($standard as $standard_n) 
					 		{
					 			$sql   = "SELECT division_name FROM admin_add_division WHERE standard_name = :standard_n";
								$query = $this->db->pdo->prepare($sql);
								$query->bindValue(":standard_n" ,$standard_n["standard_name"]);
							    $query->execute();
							 	$division = $query->fetchAll();
							 	if ($division) 
							 	{
							 		foreach ($division as $division_n) 
							 		{
							 			$table_name = strtolower(sprintf('%s_%s_%s',$course_n["course_name"],$standard_n["standard_name"],$division_n["division_name"]));
							 			$sql   = "SELECT * FROM $table_name WHERE student_username = :student_username AND student_password = :student_password";
										$query = $this->db->pdo->prepare($sql);
										$query->bindValue(":student_username" ,$username);
										$query->bindValue(":student_password" ,$password);
							    		$query->execute();
							    		if($query->rowCount() > 0)
										  {
											$result = $query->fetch(PDO::FETCH_OBJ);
											if ($result) 
											{
													
										    	Session::init();
										    	Session::set("student_login" , true);
										    	Session::set("student_id" , $result->student_rollno_id);
										    	Session::set("student_name" , $result->student_name);
										    	Session::set("student_username" , $result->student_username);
										    	Session::set("student_course" , $result->course_name);
										    	Session::set("student_standard" , $result->standard_name);
										    	Session::set("student_division" , $result->division_name);

										    	Session::set("student_photo" , $result->student_photo);
										    	
										    	Session::set("loginmsg" , "<div> <strong>Sucess! </strong>You are logged in!</div>");
											    header("Location: Student_page.php");
											}
											 else
											 {
											 	$msg = "<div ><strong>Error! </strong>data not found</div>";
												return $msg;
											 }
										  }
							    		
							    		}

							 		}
							 	}
					 		}	
					 	}
					 	return false;
					}
					
				
			}

		
			
			/* student home page   */
			public function student_home_page($student_rollno,$course_table_name)
			{
				$sql = "SELECT Count(*) FROM $course_table_name WHERE student_rollno = $student_rollno";
				$query = $this->db->pdo->prepare($sql);
		 		$query->execute();
				$result = $query->fetchColumn();
				return $result;
			}
			public function student_Attendance_present($student_rollno,$course_table_name)
			{
				$sql = "SELECT Count(*) FROM $course_table_name WHERE student_rollno = $student_rollno AND attendance_status = :Present ";
				$query = $this->db->pdo->prepare($sql);
				$query->bindValue(':Present','Present');
		 		$query->execute();
				$result = $query->fetchColumn();
				return $result;
			}
			public function student_Attendance_absent($student_rollno,$course_table_name)
			{
				$sql = "SELECT Count(*) FROM $course_table_name WHERE student_rollno = $student_rollno AND attendance_status = :Absent";
				$query = $this->db->pdo->prepare($sql);
				$query->bindValue(':Absent','Absent');
		 		$query->execute();
				$result = $query->fetchColumn();
				return $result;
			}
			

			/* student home page end */

			/* My profile page*/
			public function student_show_homepage($student_rollno,$course_table_name)
				{
					$sql = "SELECT * FROM $course_table_name WHERE student_rollno_id = :student_rollno LIMIT 1";
					$query = $this->db->pdo->prepare($sql);
					$query->bindValue(':student_rollno',$student_rollno);
					$query->execute();
					$result = $query->fetch(PDO::FETCH_OBJ);
					return $result;
				}
			
		    public function student_photo_update($student_rollno,$course_table_name)
			{
				$sql = "SELECT student_photo FROM $course_table_name WHERE student_rollno_id = :student_rollno";
				$query = $this->db->pdo->prepare($sql);
				$query->bindValue(":student_rollno",$student_rollno);
				$query->execute();
				$result = $query->fetch(PDO::FETCH_OBJ);
				return $result;
			}
			public function student_update_homepage($student_rollno , $data , $uploaded_image , $file_temp,$course_table_name)
			{
				$email   	= $data['email'];
				$mobile  	= $data['mobile'];	
				$address 	= $data['address'];
				$city    	= $data['city'];
				$pincode    = $data['pincode'];
 

				if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) 
				 {
					$msg = "<div><strong>Error! </strong>Email address is not valid!</div>";
					return $msg;
				 }
				
			    if(preg_match('/[^0-9]+/i',$mobile))
			   	 {
					$msg = "<div><strong>Error! </strong>phone number must only contain number!</div>";
					return $msg;
				 }
				if(strlen($mobile)>10 OR strlen($mobile)<10)
				 {
					$msg = "<div><strong>Error! </strong>Phone number is not valid</div>";
					return $msg;
				 }
				 if (ctype_alpha($city) === false)
				 {
	            	$msg = "<div><strong>Error! </strong>city must only contain letters!</div>";
	            	return $msg;
				 }
				if (filter_var($pincode, FILTER_VALIDATE_INT) === false)
				{
					$msg = "<div>pincode!only have number</div>";
					return $msg;
				}

				$sql = "UPDATE $course_table_name set
						student_email  = :email,
						student_mobile = :mobile,
						student_address=:address,
						student_city   =:city,
						student_pincode=:pincode,
						student_photo  = :uploaded_image
						WHERE student_rollno_id = :student_rollno";
				$query = $this->db->pdo->prepare($sql);
				$query->bindValue(':email', $email);
				$query->bindValue(':mobile', $mobile);
				$query->bindValue(':address', $address);
				$query->bindValue(':city', $city);
				$query->bindValue(':pincode', $pincode);
				$query->bindValue(':uploaded_image', $uploaded_image);
				$query->bindValue(':student_rollno', $student_rollno);

				$result = $query->execute();		
				if ($result) 
				{
					Session::set("student_photo" , $uploaded_image);
					move_uploaded_file($file_temp,$uploaded_image);

					$msg = "<div class='alert alert-success'><strong>Success! </strong>Update successfully</div>";
					return $msg;

				}
				else
				 {
					$msg = "<div class='alert alert-danger'><strong>Sorry! </strong>NOt Update</div>";
					return $msg;
				}									
				
			}
			/* My profile page end*/
			
			/* student attendance report */

			public function stu_attendace_report($date,$check_student_table,$student_rollno)
			{
				$sql =  "SELECT * FROM $check_student_table WHERE student_rollno = $student_rollno AND MONTH(attendance_date) = $date AND YEAR(attendance_date) = YEAR(CURDATE())";
				$query = $this->db->pdo->prepare($sql);
				 $query->execute();
				$result = $query->fetchAll();
				return $result; 
			}
			/* student attendance report end */

			/* student password change */
			public function check_student_Password($student_rollno,$old_password,$course_table_name)
			{
				$password = md5($old_password);
				$sql = "SELECT student_password FROM $course_table_name WHERE student_rollno_id = :student_rollno AND student_password = :student_password";
				$query = $this->db->pdo->prepare($sql);
				$query->bindValue(':student_rollno', $student_rollno);
				$query->bindValue(':student_password', $password);
				$query->execute();
				if($query->rowCount() > 0)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		
			public function student_changePassword($data, $course_table_name,$student_rollno)
			{
				$old_password     = $data['old_password'];
				$new_password     = $data['new_password'];
				$confirm_password = $data['confirm_password'];

				$check_password   = $this->check_student_Password($student_rollno,$old_password,$course_table_name);

				if ($check_password == false) 
				{
					$msg = "<div><strong>Sorry! </strong>old password not exsist</div>";
					return $msg;
				}
				if (strlen($new_password) < 6) 
				{
					$msg = "<div><strong>Sorry! </strong>password to short</div>";
					return $msg;
				}
				elseif ($new_password != $confirm_password)
				{
					$msg = "<div><strong>Sorry! </strong>password must be same</div>";
					return $msg;
			   }

				$password = md5($new_password);
				$sql = "UPDATE $course_table_name set
				   student_password = :password
				   WHERE student_rollno_id	= :student_rollno";
				$query = $this->db->pdo->prepare($sql);
				
				$query->bindValue(':password', $password);
				$query->bindValue(':student_rollno', $student_rollno);
				$result = $query->execute();
				if ($result) 
				{
					$msg = "<div><strong>Success! </strong>Update successfully</div>";
					return $msg;
				}
				else
				 {
					$msg = "<div><strong>Sorry! </strong>password Not Update</div>";
					return $msg;
				}
			}



	}
?>
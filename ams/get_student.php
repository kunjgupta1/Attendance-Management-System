<?php
		
    include 'include/manage.php';  
    $admin = new Admin();  
    $standard = SESSION::get("staff_std_name");
    $staff_id = SESSION::get("staff_id");
    $course_name = SESSION::get("staff_course_name");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
		  <option value="">Select </option>
           <?php
             
                 $division = $_REQUEST["q"];
                 $course_table_name = sprintf("%s_%s_%s",$course_name, $standard,$division);
                 $check_student_table = strtolower($course_table_name);

                 $select = $admin->get_AllStudent_Data($check_student_table);
                if ($select) 
                {
                    foreach ($select as $rollno) {                 
                
            ?> 
                <option value="<?php echo $rollno['student_rollno_id'];?>"><?php echo $division.$rollno['student_rollno_id']."..".$rollno['student_name'];?></option>
               
            <?php } } ?>
</body>
</html>

<?php
		
    include 'include/manage.php';  
    $admin = new Admin();  
    
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
          <option value="">Select</option>
           <?php
               $standard_name = $_REQUEST["q"];
               $course_name = SESSION::get("staff_course_name");
                $division = $admin->staff_showDivision($course_name,$standard_name);
                if ($division) 
                {
                   foreach ($division as $s_division) 
                   {
                                                    
            ?>
            <option value="<?php echo $s_division['division_name'];?>"><?php echo $s_division['division_name'];?></option>

            <?php } }?>
</body>
</html>

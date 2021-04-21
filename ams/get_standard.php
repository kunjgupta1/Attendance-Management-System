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
		  <option value="">Select </option>
           <?php
             
                $course_name = $_REQUEST["q"];

                $select = $admin->admin_showStandard_ByCourse($course_name);
                if ($select) 
                {
                    foreach ($select as $standard) {                 
                
            ?> 
                <option value="<?php echo $standard['standard_name'];?>"><?php echo $standard['standard_name'];?></option>
               
            <?php } } ?>
</body>
</html>

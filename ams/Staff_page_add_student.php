<?php
        include 'include/manage.php';
        Session::check_staff_login();
        $admin = new Admin();
        $standard = SESSION::get("staff_std_name");
        $staff_id = SESSION::get("staff_id");
        $course_name = SESSION::get("staff_course_name");
?>
<?php
     
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Add']))
      {     
         $division_name = $_POST['division'];
         SESSION::set('division_name',$division_name);
         $course_table_name = sprintf("%s_%s_%s",$course_name,$standard,$division_name);
         $check_student_table = strtolower($course_table_name);
      }
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_student']))
      {     
         $division_name = SESSION::get('division_name');
         $course_table_name = sprintf("%s_%s_%s",$course_name,$standard,$division_name);
         $check_student_table = strtolower($course_table_name);
         /*
         image upload function
         */
                $file_name = $_FILES['image']['name'];
                $file_temp = $_FILES['image']['tmp_name'];
                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "images/student/".$unique_image;
          /*
         image upload function end
         */      

         $add_student_Bydivision = $admin->staff_addStudentdata($_POST,$check_student_table,$course_name,$standard,$division_name,$file_temp,$uploaded_image);
      }
                
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
           @font-face {
                font-family: rThin;
                src: url(fonts/Roboto-Thin.ttf);
            }
            @font-face {
                font-family: rRegular;
                src: url(fonts/Roboto-Regular.ttf);
            }
            @font-face {
                font-family: rLight;
                src: url(fonts/Roboto-Light.ttf);
            }
            body {
                margin: 0px;
                padding: 0px;
                font-family: rLight;
                height: 100%;
                width: 100%;
            }
            input[type=submit]:focus {
                outline: none;
            }
            input[type=submit] {
                font-family: rRegular;
                letter-spacing: 0.1vw;
                margin-top: 1%;
                margin-bottom: 1%;
                padding: 2.5% 10%;
                text-align: center;
                border: 0.4vh solid rgba(0, 0, 0, 0.3);
                border-radius: 4px;
                cursor: pointer;   
                background-color: rgba(255, 255, 255, 0.2);
            }
            input[type=text] {
                outline: none;
                border: 1px solid rgba(0, 255, 0, .7);
            }
            input[type=text],input[type=password],input[type=date],textarea{
                padding: 1.5%;
                font-family: rRegular;
                border: 0.35vh solid rgba(0, 0, 0, 0.2);
                border-radius: 5px;
            }
            select{
                width: 15vw;
                min-width: 100px;
                padding: 1.5%;
                font-family: rRegular;
                border-radius: 5px;   
            }
            td{
                font-weight: bold;
                padding: 1%;
            }
            #mainRightContainerBottomE-1 {
                    margin: 1%;
                    padding: 1%;
                    font-family: rRegular;
                    font-weight: bold;
                    letter-spacing: .2vw;
                    text-align: center;
                    border: 1px solid blue;
                    overflow-y: auto;
                    white-space: nowrap; 

                }  
                #mainRightContainerBottomE-2 {
                    border: 1px solid blue;
                    margin: 1%;
                    text-align : left;
                    padding-top: 3%;
                    overflow-y: auto;
                    white-space: nowrap;                     
                }
                #mainRightContainerBottomE-3 {
                    margin:1%;
                    overflow-y: auto;
                    border: 1px solid blue;
                    height: 57vh;
                    overflow-y: auto;
                    white-space: nowrap; 
                }
               
                #mainRightContainerBottomE-3 input[type=submit]{
                    font-family: rRegular;
                    letter-spacing: 0.1vw;
                    margin-top: 1%;
                    margin-bottom: 1%;
                    padding: 2.5% 5%;
                    text-align: center;
                    border: 0.4vh solid rgba(0, 0, 0, 0.3);
                    border-radius: 4px;
                    cursor: pointer;   
                    background-color: rgba(255, 255, 255, 0.2);
                }
            #mainRightContainerBottomE-4{
                    margin: 1%;
                    padding: 1%;
                    font-family: rRegular;
                    text-align: center;
                    letter-spacing: .2vw;
                    
               } 
               #mainRightContainerBottomE-4 span{
                margin-right: 10%;

               }
            /* add style */
            #mainRightContainerBottomE-1 {
                border-radius: 5px;
                border: 1.5px solid rgb(0, 0, 0,.5)
            }
            #mainRightContainerBottomE-2 {
                border-radius: 5px;
                border: 1.5px solid rgb(0, 0, 0,.5)
            }
            #mainRightContainerBottomE-3 {
                border-radius: 5px;
                border: 1.5px solid rgb(0, 0, 0,.5)
            }
        </style>
            
    </head>
    <body>
        <div id="mainRightContainerBottom">
            <div id="mainRightContainerBottomE-1">
                <span>Add New Student Data</span>
               <?php
                    if (isset($add_student_Bydivision)) 
                    {
                       echo $add_student_Bydivision;
                    }

                ?>
            </div>
            <div id="mainRightContainerBottomE-2">
                <form style="margin: auto;" method="post">
                    <table style="margin: auto;">
                        
                        <tr>
                          <td>Course</td>
                          <td><?php echo $course_name;?></td>  
                          
                        </tr>
                        <tr>
                          <td>Standard</td>
                          <td><?php echo $standard;?></td>  
                          
                        </tr>
                        <tr>
                          <td>Select Division</td>
                          <td>
                            <select name="division" required>
                                <option value="">Select</option>
                            <?php
                                $select = $admin-> staff_showDivision($course_name,$standard);
                                if ($select) 
                                {
                                    foreach ($select as $division) {                 
                                
                            ?>
                                <option value="<?php echo $division['division_name'];?>"><?php echo $division['division_name'];?></option>
                               
                            <?php } }?>
                                
                            </select>
                          </td>  
                        </tr> 
                        <tr>
                            <td></td>
                            <td><input type="submit" name="Add" value="Add"></td>
                        </tr>
                    </table>
                  </form>
            </div>
            <?php 
                if (isset($division_name))
                {
                      
            ?>
            <div id="mainRightContainerBottomE-3">
             
                
                 <form style="margin: auto;" method="post" enctype="multipart/form-data">
                    <div id="mainRightContainerBottomE-4">
                    <?php 
                        $seats = $admin->checkDevisionSeat($division_name,$standard,$course_name);
                        if ($seats) {
                          
                    ?>
                        <span>Total Seat = <?php echo $total = $seats->division_seat;?></span>

                    <?php }?>      
                        <?php
                          $count = $admin->CountSeats($check_student_table);
                          if ($count) 
                          {
                      
                        ?>
                        <span>Total Admitted  = <?php echo $count ;?></span>
                        <span>Reamaning Student = <?php echo $total-$count ;?></span>
                    <?php }?>

                 
                    </div>
                   
                    <table style="margin: auto;">
                     <?php 

                        if ($total == $count) 
                        {
                    ?>
                        <tr>
                          
                          <td></td>   
                          <td>Seats are full</td>     
                          
                        </tr>
                    <?php } else {?>
                       <tr>
                          <td>Roll no</td>
                         <?php 

                          $rollno = $admin->Getrollno($check_student_table);
                          if ($rollno) 
                          {
                             
                         ?>
                          <td><?php echo $division_name.$rollno?></td>     
                          <?php } ?>
                        </tr>
                       
                        <tr>
                          <td>Student Name</td>
                          <td><input type="text" name="student_name" required></td>  
                        </tr>
                        <tr>
                          <td>Mobile</td>
                          <td><input type="text" name="student_mobile" required></td>  
                        </tr> 
                        <tr>
                          <td>Email</td>
                          <td><input type="text" name="student_email" required></td>  
                        </tr>
                        <tr>
                          <td>DOB</td>
                          <td><input type="date" name="student_dob" required></td>

                        </tr> 
                        <tr>
                          <td>Address</td>
                          <td><input type="text" name="student_address" required></td>  
                        </tr> 
                        <tr>
                          <td>City</td>
                          <td><input type="text" name="student_city" required></td>  
                        </tr> 
                         <tr>
                          <td>Pincode</td>
                          <td><input type="text" name="pincode" required></td>  
                        </tr> 
                         <tr>
                           <td>Gender</td>
                           <td>
                                 <select name="gender" required>
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                 </select>
                           </td>  
                         </tr> 
                          <tr>
                          <td>Photo</td>
                          <td><input type="file" name="image" required></td>  
                        </tr>
                        <tr>
                            <td>UserName</td>
                            <td><input type="text" name="student_username" required></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" name="student_password" required></td>
                        </tr>
                        <tr>
                            <td>Confirm Password</td>
                            <td><input type="password" name="student_confirm_password" required></td>
                        </tr>
                     
                        <tr>
                            <td></td>
                            <td><input type="submit" name="add_student" value="Add Student"></td>
                        </tr>
                       
                       
                    </table>
                    <?php }?>
                  </form>
                

            </div> 
            <?php }?>    
        </div>
    </body>
</html>
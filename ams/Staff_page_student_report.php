<?php
        include 'include/manage.php';
        Session::check_staff_login();
        $admin = new Admin();
        $standard = SESSION::get("staff_std_name");
        $staff_id = SESSION::get("staff_id");
        $course_name = SESSION::get("staff_course_name");
?>
<?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add']))
              {     
                 $division_name = $_POST['division_name'];
                 $standard_name = $_POST['standard_name'];
                
                 $course_table_name = sprintf("%s_%s_%s",$course_name, $standard_name,$division_name);
                 $check_student_table = strtolower($course_table_name);
                 Session::set("check_student_table",$check_student_table);
                 $student_table_report = $admin->staff_report_ShowStudent($check_student_table);
             
        } 
        if (isset($_GET['action']))
                {
                    $check_student_table = SESSION::get('check_student_table');
                    $student_id = $_GET['action'];
                    $delete = $admin->staff_deleteStudent($student_id,$check_student_table); 
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
            a{
                text-decoration: none;
                color: black;
                font-weight: bold;
            }
            input[type=submit]:focus {
                outline: none;
            }
            input[type=submit] {
                font-family: rRegular;
                letter-spacing: 0.1vw;
                margin-top: 1%;
                margin-bottom: 1%;
                padding: .5% 10%;
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
            input[type=text],input[type=password]{
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
                    text-align : center;
                    padding-top: 3%;
                    overflow-y: auto;
                    white-space: nowrap;                     
                }
                #mainRightContainerBottomE-3 {
                    margin:1%;
                    padding: 1%;
                    overflow-y: auto;
                    border: 1px solid blue;
                    height: 57vh;
                }
                 td{
                    text-align: center;
                }
                td,th,tr {
                    white-space: nowrap;
                    padding: 1vw;
                }

                 #mainRightContainerBottomE-3  table
                {
                    border:1px solid rgba(0,0,0,.5);
                    border-radius: 10px;
                    padding: 1%;
                    width: 100%;
                }
               #mainRightContainerBottomE-3 td,th{
                    padding: 1vw;
                    border:1px solid rgba(0,0,0,.5);
                    border-radius: 5px;
                    
                }
                #mainRightContainerBottomE-3 th{
                    text-transform: uppercase;
                    padding: 1vw;
                }

               #mainRightContainerBottomE-3 td,th,tr {
                    white-space: nowrap;
                }
                 img {
                    height: 100px;
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
            #table-image {
                margin: 0 auto;
                width: 100px;
                overflow: hidden;
                height: 100px;
                border-radius: 50%;
            }
        </style>
        <script>
            
            function changeFunc() {
            var selectBox = document.getElementById("standard_name");
            
            var selectedValue = selectBox.options[selectBox.selectedIndex].value; 

                if (selectedValue) 
                {
                    var a = document.getElementById('division_name').disabled = false;

                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                      if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("division_name").innerHTML = this.responseText;
                      }
                    };
                    xmlhttp.open("GET", "get_division.php?q=" + selectedValue, true);
                    xmlhttp.send();
                }
            
            } 
        </script>
    </head>
    <body>
        <div id="mainRightContainerBottom">
            <div id="mainRightContainerBottomE-1">
                <span>Student Report</span>
            </div>
            <div id="mainRightContainerBottomE-2">
                <form style="margin: auto;" method="post">
                    <table style="margin: auto;">
                    <tr>
                        <td>Course</td>
                        <td><?php echo $course_name;?></td>
                    </tr>    
                    </tr>
                      <tr>
                          <td>Select Standard</td>
                          <td>
                            <select name="standard_name" id= "standard_name" onchange="changeFunc()" required>
                                <option value="">Select</option>
                                <?php
                                    $standard = $admin->staff_report_standard($course_name);
                                    if ($standard) 
                                    {
                                       foreach ($standard as $s_standard) 
                                       {
                                                                        
                                ?>
                                <option value="<?php echo $s_standard['standard_name'];?>"><?php echo $s_standard['standard_name'];?></option>

                                <?php } }?>
                            </select>
                          </td>  
                        </tr> 
                        <tr>
                          <td>Select Division</td>
                          <td>
                            <select name="division_name" id ='division_name' disabled required>
                                
                            </select>
                          </td>  
                        </tr> 
                        <tr>
                            <td></td>
                            <td><input type="submit" name="add" value="Select"></td>
                        </tr>
                    </table>
                  </form>
            </div>
 <?php
            if (isset($student_table_report)) 
             {   
                
?>

            <div id="mainRightContainerBottomE-3">
            
                <table border="black">
                    <tr>
                        <th>Action</th>
                        <th>Photo</th>
                        <th>Roll No.</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Birth Date</th>
                    </tr>
           <?php 
                    foreach ($student_table_report as $student_data) 
                   {             


           ?>
                    <tr>
                        <td>
                          <a href="?action=<?php echo $student_data['student_rollno_id'];?>">Delete</a>
                        </td>
                        <td>
                            <div id="table-image">
                                <img src="<?php  echo $student_data['student_photo'];?>">
                            </div>
                        </td>
                        <td><?php  echo $division_name.$student_data['student_rollno_id'];?></td>
                        <td><?php  echo $student_data['student_name'];?></td>
                        <td><?php  echo $student_data['student_mobile'];?></td>
                        <td><?php  echo $student_data['student_email'];?></td>
                        <td><?php  echo $student_data['student_dob'];?></td>
                    </tr>
                    
                 <?php }?>
                </table>

            </div>  
             <?php } ?>

             
        </div>
    </body>
</html>
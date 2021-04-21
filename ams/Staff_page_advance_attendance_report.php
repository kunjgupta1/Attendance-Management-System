<?php
        include 'include/manage.php';
        Session::check_staff_login();
        $admin = new Admin();
        $standard = SESSION::get("staff_std_name");
        $staff_name = SESSION::get("staff_name");
        $course_name = SESSION::get("staff_course_name");
?>
<?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['select']))
        {     
                 $division_name = $_POST['division_name'];
                 $student_roll  = $_POST['student_roll'];
                 
                 $course_table_name = sprintf("%s_%s_%s",$course_name, $standard,$division_name);
                 $check_student_table = strtolower($course_table_name);

                 $student_att_report = $admin->student_data_Byroll($student_roll,$check_student_table);
           
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
                margin-top: 4%;
                margin-bottom: 1%;
                padding: .8% 8%;
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
            input[type=password], textarea{
                outline: none;
                border-radius: 10px;
                border: 0.35vh solid rgba(0, 0, 0, 0.2);
                padding: 1.5%;
            }
            input[type=text]{
                padding: 1.5%;
                font-family: rRegular;
                border: 0.35vh solid rgba(0, 0, 0, 0.2);
                border-radius: 10px;
            }
            select{
                padding: 1.5%;
                font-family: rRegular;
                border: 0.35vh solid rgba(0, 0, 0, 0.2);
                border-radius: 5px;
                width: 15vw;
                min-width: 100px;

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
                    overflow-y: auto;
                    white-space: nowrap; 
                                       
                }
                
                 #mainRightContainerBottomE-3 {
                    margin:1%;
                    padding: 1%;
                    overflow-y: auto;
                    border: 1px solid blue;
                    height: 57vh;
                    overflow-y: auto;
                    white-space: nowrap; 
                }
                 td{
                    text-align: left;
                    font-weight: bold;
                    padding: 2%;
                }
                td,th,tr {
                    white-space: nowrap;
                }

                 #mainRightContainerBottomE-3  table
                {
                    border:1px solid rgba(0,0,0,.5);
                    border-radius: 10px;
                    padding: 1%;
                    width: 100%;
                }
               #mainRightContainerBottomE-3 td,th{
                    padding: 1%;
                    border:1px solid rgba(0,0,0,.5);
                    border-radius: 5px;
                    text-align: center;
                    
                }
                #mainRightContainerBottomE-3 th{
                    text-transform: uppercase;
                }

               #mainRightContainerBottomE-3 td,th,tr {
                    white-space: nowrap;
                }
             th{
                padding: 1vw;
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
        <script>
            
            function changeFunc() {
            var selectBox = document.getElementById("division_name");
            
            var selectedValue = selectBox.options[selectBox.selectedIndex].value; 

                if (selectedValue) 
                {
                    var a = document.getElementById('student_roll').disabled = false;

                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                      if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("student_roll").innerHTML = this.responseText;
                      }
                    };
                    xmlhttp.open("GET", "get_student.php?q=" + selectedValue, true);
                    xmlhttp.send();
                }
            
            } 
        </script>
    </head>
    <body>
        <div id="mainRightContainerBottom">
            <div id="mainRightContainerBottomE-1">
                <span>Advance Student Attendance Report</span>
            </div>
            <div id="mainRightContainerBottomE-2">
                <form style="margin: auto;" method="post">
                    <table style="margin: auto;">
                       <tr>
                          <td>Select Standard</td>
                          <td><?php echo $standard;?></td>  
                        </tr>
                        <tr>
                          <td>Select Division</td>
                          <td>
                              <select name="division_name" id= "division_name" onchange="changeFunc()" required>
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
                          <td>Select Student</td>
                          <td>
                            <select name="student_roll" id ='student_roll' disabled required>
                                
                            </select>
                          </td>  
                        </tr> 
                        
                        <tr>
                            <td></td>
                            <td><input type="submit" name="select" value="Select"></td>
                        </tr>
                    </table>
                  </form>
            </div>
<?php
            if (isset($student_att_report)) 
             {   
                           

?>
            <div id="mainRightContainerBottomE-3">

                <table>
                    <tr>
                        <th>Roll No.</th>
                        <th>Student Name</th>
                        <th>Attendance</th>
                        <th>Attendance By</th>
                        <th>Attendance Date</th>
                    </tr>
                     <?php 
                        foreach ($student_att_report as $student_data) 
                        {  
                    ?>
                    <tr>          
                        <td><?php echo $division_name.$student_data['student_rollno'];?></td>
                        <td><?php echo $student_data['student_name'];?></td>
                        <td><?php echo $student_data['attendance_status'];?></td>
                        <td><?php echo $student_data['attendance_by']?></td>
                        <td><?php echo $student_data['attendance_date'];?></td>
                    </tr>
                    
            <?php }?>            
                </table>

            </div>
        <?php }?>
        </div>
    </body>
</html>
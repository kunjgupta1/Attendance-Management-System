<?php
        include 'include/manage.php';
        Session::check_staff_login();
        $admin = new Admin();
        $staff_name = SESSION::get("staff_name");
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
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Attendance']))
      {     
         $division_name = SESSION::get('division_name');
         $course_table_name = sprintf("%s_%s_%s",$course_name,$standard,$division_name);
         $check_student_table = strtolower($course_table_name);

         $attendance = $_POST['attendance'];
         $date       = $_POST['date'];
         
         $add_student_attendance = $admin->student_add_attendance($attendance,$date,$check_student_table, $staff_name);
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
                padding: 1.5%;
                font-family: rRegular;
                border-radius: 5px; 
                min-width: 100px;  
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
                    padding: 1%;
                    overflow-x: auto;
                    border: 1px solid blue;
                    height: 57vh;
                    
                }
               
                #mainRightContainerBottomE-3 input[type=submit]{
                    font-family: rRegular;
                    letter-spacing: 0.1vw;
                    margin-top: 1%;
                    margin-bottom: 1%;
                    padding: .5% 2%;
                    text-align: center;
                    border: 0.4vh solid rgba(0, 0, 0, 0.3);
                    border-radius: 4px;
                    cursor: pointer;   
                    background-color: rgba(255, 255, 255, 0.2);
                }
                 #mainRightContainerBottomE-3  table
                {
                    width: 100%;
                }
               #mainRightContainerBottomE-3 th{
                    padding: 1%;
                    border:1px solid rgba(0,0,0,.5);
                    border-radius: 5px;
                    text-align: center;
                }
                #mainRightContainerBottomE-3 td{
                   
                    text-align: center;
                }
                #mainRightContainerBottomE-3 th{
                    text-transform: uppercase;
                    padding: 1vw;
                }

               #mainRightContainerBottomE-3 td,th,tr {
                    white-space: nowrap;
                }
                #mainRightContainerBottomE-3-calander
                {
                   
                    text-align: center;
                    padding: 1%;
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
                <span>Add Attendance</span>
                <?php
                        if (isset($add_student_attendance)) {
                          echo $add_student_attendance;
                        }
                 ?>
            </div>
            <div id="mainRightContainerBottomE-2">
                <form style="margin: auto;" method="post">
                    <table style="margin: auto;">
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
            <?php 
                $student_table_data = $admin->staff_report_ShowStudent($check_student_table);
                if ($student_table_data) 
                {
                    
                      
               ?>
            <div id="mainRightContainerBottomE-3">
                 <form method="post">
                     <div id="mainRightContainerBottomE-3-calander" > 
                        <input type="date" name="date" required>
                        <input type="submit" name="Attendance" value="Attendance">
                     </div>
                     <div id="mainRightContainerBottomE-3-att">
                     <table>
                         <tr>
                             <th>Roll No.</th>
                             <th>Student Name</th>
                             <th>Attendance</th>       
                         </tr>
                         <?php
                            foreach ($student_table_data as $student_data) 
                              {

                         ?>
                         <tr>
                          <td><?php echo $division_name.$student_data['student_rollno_id']?></td>
                          <td><?php echo $student_data['student_name']?></td>
                          <td>
                            <input type="radio" name="attendance[<?php echo $student_data['student_rollno_id'];?>]" value="Absent">Absent
                            <input type="radio" name="attendance[<?php echo $student_data['student_rollno_id'];?>]" value="Present">Present
                            
                          </td>  
                        </tr> 
                       
                      <?php } ?>
                     </table>

                    </div>
                 </form>
            
            </div> 
             <?php }  }?>    
        </div>
    </body>
</html>
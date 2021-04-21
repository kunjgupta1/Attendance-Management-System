<?php
    include "include/manage.php";
    Session::check_student_login();
?>
<?php
         $admin = new Admin();
         $course    = Session::get('student_course');
         $division  = Session::get('student_division');
         $standard  = Session::get('student_standard');
         $student_rollno= Session::get('student_id');
         $course_table_name = strtolower(sprintf("%s_%s_%s_%s",$course,$standard,$division,'attendance'));
          if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add']))
        {     
                 
                 $date          = $_POST['Month'];
               
                 $student_att_report = $admin->stu_attendace_report($date, $course_table_name,$student_rollno);
           
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
            input[type=text],input[type=password],input[type=date]{
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
                    border: 1px solid blue;
                    height: 57vh;
                    overflow-y: auto;
                    white-space: nowrap;
                }
                 td{
                    text-align: left;
                    font-weight: bold;
                    
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
    </head>
    <body>
        <div id="mainRightContainerBottom">
            <div id="mainRightContainerBottomE-1">
                <span>My Attendance Report</span>
            </div>
            <div id="mainRightContainerBottomE-2">
                <form style="margin: auto;" method="POST">
                    <table style="margin: auto;">
                      
                        <tr>
                          <td>Select Month</td>
                          <td>
                            <select name="Month">
                                  <option  value="">Select</option>
                                  <option  value="1">January</option>
                                  <option  value="2">February</option>
                                  <option  value="3">March</option>
                                  <option  value="4">April</option>
                                  <option  value="5">May</option>
                                  <option  value="6">June</option>
                                  <option  value="7">July</option>
                                  <option  value="8">August</option>
                                  <option  value="9">September</option>
                                  <option  value="10">October</option>
                                  <option  value="11">November</option>
                                  <option  value="12">December</option>
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
                if (isset($student_att_report)) 
                {
                  
        ?>
            <div id="mainRightContainerBottomE-3">
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Attendance</th>
                        
                    </tr>
                    <?php 
                            foreach ($student_att_report as $att ) 
                            {
                                
                            
                    ?>
                    <tr>    
                        <td><?php echo $att['attendance_date'];?></td>      
                        <td><?php echo $att['attendance_status'];?></td>
                            
                    </tr>
                    <?php }?>
                    
                </table>

            </div>
            <?php }?>     
        </div>
    </body>
</html>
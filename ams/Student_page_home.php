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
            input[type="submit"]{
                padding: 2%;
                margin: 2%;
                width: 50%;
            }
            textarea{
                width: 15vw;
                padding: 1.5%;
                font-family: rRegular;
                border-radius: 5px;  
            }
       
            select{
                width: 10vw;
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
                    padding: 1%; 
                    overflow-y: auto;
                    white-space: nowrap;                   
                }
                 #mainRightContainerBottomE-2 td{
                    width: 50vw;
                    white-space: nowrap;
                }
                 
                #mainRightContainerBottomE-3 {
                    margin:1%;
                    padding: 1%;
                    overflow-y: auto;
                    border: 1px solid blue;
                    
                }
                
               
               #mainRightContainerBottomE-2-Top{
                    padding: 1%;
                    text-align: center;
                    border: 1px solid;
                    overflow-y: auto;
                    white-space: nowrap;
                    min-width: 300px;
               }

               #mainRightContainerBottomE-2-Bottom{
                    border: 1px solid;
                    text-align: center;
                    font-weight: bold;
                    padding: 1%;
                    overflow-y: auto;
                    white-space: nowrap;
                    min-width: 300px;
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
            #mainRightContainerBottomE-2-Top {
                border-radius: 5px;
                border: 1.5px solid rgb(0, 0, 0,.5)
            }
            #mainRightContainerBottomE-2-Bottom {
                border-radius: 5px;
                border: 1.5px solid rgb(0, 0, 0,.5)
            }
            #mainRightContainerBottomE-3 {
                border-radius: 5px;
                border: 1.5px solid rgb(0, 0, 0,.5)
            }
            #mainRightContainerBottomE-3-Top {
                border-radius: 5px;
                border: 1.5px solid rgb(0, 0, 0,.5)
            }
            #mainRightContainerBottomE-3-Bottom {
                border-radius: 5px;
                border: 1.5px solid rgb(0, 0, 0,.5)
            }

        </style>
    </head>
    <body>
        <div id="mainRightContainerBottom">
            <div id="mainRightContainerBottomE-1">
                <span>Welcome ! <?php echo Session::get('student_name');?></span>
            </div>
            <div id="mainRightContainerBottomE-2">

               <div id="mainRightContainerBottomE-2-Top">
                   <span>My Attendance</span>
                   
               </div>
               <div id="mainRightContainerBottomE-2-Bottom">
                   <div id="mainRightContainerBottomE-2-Bottom-1" style="width: 30%;float: left;">
                       <div>Total</div>
                       <?php
                          $total_attendance  = $admin->student_home_page($student_rollno,$course_table_name);
                          if ($total_attendance) 
                          {
                          
                   ?>
                       <div><?php echo $total_attendance?></div>
                    <?php } else {?>
                      <div>0</div>
                    <?php }?>
                   </div>
                   <div id="mainRightContainerBottomE-2-Bottom-2" style="width: 30%;float: left;">
                       <div>Present</div>
                       <?php
                        $Present  = $admin->student_Attendance_present($student_rollno,$course_table_name);
                        if ($Present) 
                        {   
                       ?>
                       <div><?php echo $Present?></div>
                      <?php }else{?>
                        <div>0</div>
                      <?php }?>
                   </div>
                   <div id="mainRightContainerBottomE-2-Bottom-3" style="width: 30%;float: left;">
                       <div>Absent</div>
                       <?php
                        $Absent  = $admin->student_Attendance_absent($student_rollno,$course_table_name);
                        if ($Absent) 
                        {   
                       ?>
                       <div><?php echo $Absent?></div>
                      <?php } else{?>
                        <div>0</div>
                      <?php }?>
                   </div>
                  
               </div>

            </div>
            
           
        </div>
    </body>
</html>
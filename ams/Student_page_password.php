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
         $course_table_name = strtolower(sprintf("%s_%s_%s",$course,$standard,$division));
          if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update']))
        {     
                 
               
                 $student_changePassword = $admin->student_changePassword($_POST, $course_table_name,$student_rollno);
           
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
            input[type=password] {
                outline: none;
                border: 1px solid rgba(0, 255, 0, .7);
            }
            input[type=password]{
                height: 5vh;
                width: 15vw;
                font-family: rRegular;
                border: 0.35vh solid rgba(0, 0, 0, 0.2);
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
                    padding: 2%; 
                    font-weight: bold;
                    font-size: 20px; 
                    overflow-y: auto;
                    white-space: nowrap;                  
                }
                #mainRightContainerBottomE-2 td{
                    padding: 3%;
                    font-weight: bold;
                    white-space: nowrap;
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
        </style>
    </head>
    <body>
        <div id="mainRightContainerBottom">
            <div id="mainRightContainerBottomE-1">
                <span>Change Password</span>
                <?php
                        if (isset($student_changePassword)) 
                        {
                            echo $student_changePassword ;
                        }
                ?>
            </div>
            <div id="mainRightContainerBottomE-2">
                <form style="margin: auto;" method = "POST"> 
                    <table style="margin: auto;">
                        <tr>
                          <td>Current Password</td>
                          <td><input type="password" name="old_password" placeholder="123456"></td>  
                        </tr>
                        <tr>
                          <td>New Password</td>
                          <td><input type="password" name="new_password" placeholder="123456"></td>  
                        </tr>  
                        <tr>
                          <td>Confirm Password</td>
                          <td><input type="password" name="confirm_password" placeholder="123456"></td>
                        </tr> 
                         
                        <tr>
                            <td></td>
                            <td><input type="submit" name="update" value="Update"></td>
                        </tr>
                    </table>
               </form>
            </div>
                
        </div>
    </body>
</html>
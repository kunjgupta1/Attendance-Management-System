<?php
     include 'include/manage.php';
     Session::check_student_login();  
    
?>
<?php
         $admin = new Admin();
         $course    = Session::get('student_course');
         $division  = Session::get('student_division');
         $standard  = Session::get('student_standard');
         $student_rollno= Session::get('student_id');
         $course_table_name = strtolower(sprintf("%s_%s_%s",$course,$standard,$division));
          
?>
<?php
         if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) 
          {     
            
                $file_name = $_FILES['image']['name'];
                $file_temp = $_FILES['image']['tmp_name'];
               if (empty($file_name))
               {
                   $image = $admin->student_photo_update($student_rollno,$course_table_name);
                   if ($image) 
                   {
                        $uploaded_image = $image->student_photo;
                    } 
                }
                else
                {
                   $image = $admin->student_photo_update($student_rollno,$course_table_name);
                   if ($image)
                   {
                        $image = $image->student_photo;
                        unlink($image);
                    } 
                    
                    $div = explode('.', $file_name);
                    $file_ext = strtolower(end($div));
                    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                    $uploaded_image = "images/student/".$unique_image;
                }
                    
                    $UpdateStudent = $admin->student_update_homepage($student_rollno , $_POST ,$uploaded_image,$file_temp,$course_table_name);
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
            input[type=text],textarea{
                height: 5vh;
                font-family: rRegular;
                border: 0.35vh solid rgba(0, 0, 0, 0.2);
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
                    padding: 2%; 
                    font-weight: bold;
                    font-size: 20px;
                    overflow-y: auto;
                    white-space: nowrap;                   
                }
                #mainRightContainerBottomE-3 {
                    margin:1%;
                    padding: 1%;
                    border: 1px solid blue;
                    overflow-y: auto;
                    white-space: nowrap;
                }
                #mainRightContainerBottomE-3 td{
                    padding: 1%;
                    font-weight: bold;
                }
                td{
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
            #mainRightContainerBottomE-3 {
                border-radius: 5px;
                border: 1.5px solid rgb(0, 0, 0,.5)
            }    
        </style>
    </head>
    <body>
        <div id="mainRightContainerBottom">
            <div id="mainRightContainerBottomE-1">
                <span>My Profile</span>
                 <?php
                    if (isset($UpdateStudent)) 
                    {
                        echo $UpdateStudent;
                    }
                ?>
            </div>

            <?php
                $student_show_data = $admin->student_show_homepage($student_rollno,$course_table_name);
                if ($student_show_data) 
                {
                
            ?> 
            <div id="mainRightContainerBottomE-2">
                <table>
                    <tr>
                        <td>Course<span style="float: right;">:</span></td>
                        <td><?php echo $student_show_data->course_name;?></td>
                    </tr>
                    <tr>
                        <td>Standard<span style="float: right;">:</span></td>
                        <td><?php echo $student_show_data->standard_name;?></td>
                    </tr>
                    <tr>
                        <td>Name<span style="float: right;">:</span></td>
                        <td><?php echo $student_show_data->student_name;?></td>
                    </tr>
                    <tr>
                       <td>Rollno<span style="float: right;">:</span></td>
                        <td><?php echo $division.$student_show_data->student_rollno_id;?></td>
                    </tr>
                </table>
            </div>
            <div id="mainRightContainerBottomE-3">
               <form style="margin: auto;" enctype="multipart/form-data" method="POST"> 
                    <table style="margin: auto;">
                        <tr>
                          <td>Email</td>
                          <td><input type="text" name="email" value="<?php echo $student_show_data->student_email;?>"></td>  
                        </tr>
                        <tr>
                          <td>Mobile</td>
                          <td><input type="text" name="mobile" value="<?php echo $student_show_data->student_mobile;?>"></td>  
                        </tr>  
                        <tr>
                          <td>Address</td>
                          <td>
                            <input type="text" name="address" value="<?php echo  $student_show_data->student_address;?>"> 
                          </td>    
                        </tr> 
                        <tr>
                          <td>City</td>
                          <td><input type="text" name="city" value="<?php echo  $student_show_data->student_city;?>"></td>  
                        </tr> 
                        <tr>
                          <td>Pincode</td>
                          <td><input type="text" name="pincode" value="<?php echo  $student_show_data->student_pincode;?>"></td>  
                        </tr> 
                        <tr>
                          <td>Upload Photo</td>
                          <td><input type="file" name="image"></td>  
                        </tr> 
                        <tr>
                            <td></td>
                            <td><input type="submit" name="update" value="Update"></td>
                        </tr>
                    </table>
               </form>
            </div>
            <?php }?>      
        </div>
    </body>
</html>
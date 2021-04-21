<?php
        include 'include/manage.php';
        Session::check_staff_login();
?>
<?php
        $staff_id = Session::get("staff_id");
        $admin = new Admin();
?>
<?php
         if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) 
          {     
            
                $file_name = $_FILES['image']['name'];
                $file_temp = $_FILES['image']['tmp_name'];
               if (empty($file_name))
               {
                   $image = $admin->photoupdate($staff_id);
                   if ($image) 
                   {
                        $uploaded_image = $image->staff_photo;
                    } 
                }
                else
                {
                   $image = $admin->photoupdate($staff_id);
                   if ($image)
                   {
                        $image = $image->staff_photo;
                        unlink($image);
                    } 
                    
                    $div = explode('.', $file_name);
                    $file_ext = strtolower(end($div));
                    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                    $uploaded_image = "images/staff/".$unique_image;
                }
                    
                    $UpdateStaff = $admin->staff_update_homepage($staff_id , $_POST ,$uploaded_image,$file_temp);
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
            input[type=text]{
                height: 10%;
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
                <span>Add Profile</span>
                <?php
                    if (isset($UpdateStaff)) 
                    {
                        echo $UpdateStaff;
                    }
                ?>
            </div>
            <?php
                $staff_show_data = $admin->staff_show_homepage($staff_id);
                if ($staff_show_data) 
                {
                
            ?>

            <div id="mainRightContainerBottomE-2">
                <table>
                    <tr>
                        <td>Name<span style="float: right;">:</span></td>
                        <td><?php echo $staff_show_data->staff_name;?></td>
                    </tr>
                    <tr>
                        <td>Course<span style="float: right;">:</span></td>
                        <td><?php echo $staff_show_data->staff_course_name;?></td>
                    </tr>
                    <tr>
                        <td>Standard<span style="float: right;">:</span></td>
                        <td><?php echo $staff_show_data->staff_std_name;?></td>
                    </tr>
                </table>
            </div>
            <div id="mainRightContainerBottomE-3">
               <form style="margin: auto;" method="post" enctype="multipart/form-data"> 
                    <table style="margin: auto;">
                        <tr>
                          <td>Email</td>
                          <td><input type="text" name="email" value="<?php echo $staff_show_data->staff_email;?>"></td>  
                        </tr>
                        <tr>
                          <td>Mobile</td>
                          <td><input type="text" name="mobile" value="<?php echo $staff_show_data->staff_mobile;?>"></td>  
                        </tr>  
                        <tr>
                          <td>Address</td>
                          <td>
                            <input type="text" name="address" value="<?php echo $staff_show_data->staff_address;?>"> 
                          </td>  
                        </tr> 
                        <tr>
                          <td>City</td>
                          <td><input type="text" name="city" value="<?php echo $staff_show_data->staff_city;?>"></td>  
                        </tr> 
                        <tr>
                          <td>Pincode</td>
                          <td><input type="text" name="pincode" value="<?php echo $staff_show_data->staff_pincode;?>"></td>  
                        </tr> 
                        <tr>
                          <td>Upload Photo</td>
                          <td><input type="file" name="image" ></td>  
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
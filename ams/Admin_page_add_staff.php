<?php
        include 'include/manage.php';
        Session::check_admin_login();
?>
<?php
        $admin = new Admin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Add'])) 
          {     
                $file_name = $_FILES['image']['name'];
                $file_temp = $_FILES['image']['tmp_name'];
                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "images/staff/".$unique_image;

                $staff = $admin->admin_addStaff($_POST,$file_temp,$uploaded_image);

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
            input[type=text],input[type=password], textarea{
                padding: 1.5%;
                font-family: rRegular;
                border: 0.35vh solid rgba(0, 0, 0, 0.2);
                border-radius: 5px;
            }
            select{
                padding: 1.5%;
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
                    text-align : center;
                    overflow-y: auto;       
                }
                td{
                    text-align: left;
                    padding: 1%;
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
        <script>
            
            function changeFunc() {
            var selectBox = document.getElementById("course_name");
            
            var selectedValue = selectBox.options[selectBox.selectedIndex].value; 

                if (selectedValue) 
                {
                    var a = document.getElementById('standard').disabled = false;

                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                      if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("standard").innerHTML = this.responseText;
                      }
                    };
                    xmlhttp.open("GET", "get_standard.php?q=" + selectedValue, true);
                    xmlhttp.send();
                }
            
            } 
        
 
            
        </script>
            
    </head>
    <body>
        <div id="mainRightContainerBottom">
            <div id="mainRightContainerBottomE-1">
                <?php 
                        if (isset($staff)) 
                        {
                            echo $staff;
                        }

                ?>
                <span>Add Staff</span>
            </div>
            <div id="mainRightContainerBottomE-2">
                <form style="margin: auto;" method="post" enctype="multipart/form-data">
                    <table style="margin: auto;">
                       <tr>
                          <td>Staff Name</td>
                          <td><input type="text" name="staff_name" placeholder="kunj" required></td>  
                        </tr>
                        <tr>
                          <td>Email</td>
                          <td><input type="text" name="email" placeholder="kunj@gmail.com" required></td>  
                        </tr>
                        <tr>
                          <td>Mobile</td>
                          <td><input type="text" name="mobile" placeholder="1234567890" required></td>  
                        </tr> 
                        <tr>
                          <td>Qualification</td>
                          <td><input type="text" name="qualification" placeholder="Bca,Mca" required></td>  
                        </tr> 
                        <tr>
                          <td>Address</td>
                          <td><textarea name="address" placeholder="Kotra" required></textarea></td>  
                        </tr> 
                        <tr>
                          <td>City</td>
                          <td><input type="text" name="city" placeholder="Ajmer" required></td>  
                        </tr> 
                         <tr>
                          <td>Pincode</td>
                          <td><input type="text" name="pincode" placeholder="305001" required></td>  
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
                            <td>Select Course</td>
                            <td>
                                 <select name="course_name"  id="course_name" onchange='changeFunc()' required>
                            
                                <option value="">Select</option>
                            <?php
                                $select = $admin-> admin_showCourse();
                                if ($select) 
                                {
                                    foreach ($select as $course) {                 
                                
                            ?>
                                <option value="<?php echo $course['course_name'];?>"><?php echo $course['course_name'];?></option>
                               
                            <?php } }?>
                            </select>
                           </td>  
                        </tr>
                        <tr>
                            <td>Std Name</td>
                            <td>
                                 <select name="standard" id="standard" disabled required>
                            
                                 </select>
                           </td>  
                        </tr>
                        <tr>
                            <td>UserName</td>
                            <td><input type="text" name="username" placeholder="kunj123 " required></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" name="password" placeholder="123456" required></td>
                        </tr>
                        <tr>
                            <td>Confirm Password</td>
                            <td><input type="password" name="confirm_password" placeholder="123456" required></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td><input type="submit" name="Add" value="Add"></td>
                        </tr>
                    </table>
                  </form>
            </div>
        </div>
    </body>
</html>
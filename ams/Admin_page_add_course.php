<?php
        include "include/manage.php";
        $admin = new Admin();
        Session::check_admin_login();
         
?>
<?php  
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Add'])) 
        {
             $admin_standard = $admin->admin_addCourse($_POST); 
        }

?>
<?php  
        if(isset($_GET['action']))
      {
       $course_id = $_GET['action'];
       $delete = $admin->admin_deleteCourse($course_id);
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
                padding: .5% 2%;
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
                padding: .5%;
                font-family: rRegular;
                border: 0.35vh solid rgba(0, 0, 0, 0.2);
                border-radius: 10px;
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
                    padding: 5%;            
                    overflow-y: auto;
                    white-space: nowrap;    
                }
                #mainRightContainerBottomE-3 {
                    padding: 1%;
                    margin:1%;
                    overflow-y: auto;
                    border: 1px solid blue;
                    height: 57vh;
                }
                 td{
                    text-align: center;
                }
                td,th,tr {
                    white-space: nowrap;
                }

                 #mainRightContainerBottomE-3  table
                {
                    border:1px solid rgba(0,0,0,.5);
                    border-radius: 10px;
                    padding: 1%;
                    width: 50%;
                    min-width: 300px;
                }
               #mainRightContainerBottomE-3 td,th{
                    
                    border:1px solid rgba(0,0,0,.5);
                    border-radius: 5px;
                    
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
                <span>Add Course</span>
                <?php
                        if (isset($admin_standard)) 
                        {
                           echo $admin_standard;
                        }
                ?>

            </div>
            <div id="mainRightContainerBottomE-2">
                <form action="" method="post">
                    <label name="Course name">Course Name:</label>
                    <input type = "text" name="course_name" style="margin:1%;" required><br>
                    <input type="submit" name="Add" value="Add">
                </form>
            </div>
           <?php 
           $course_name = $admin->admin_showCourse();
            if ($course_name) 
                { 
            ?> 
            <div id="mainRightContainerBottomE-3">           
                <form style="margin: auto;" method="get">
                    <table style="margin: auto; text-align: center; ">
                        <tr>
                            <th>Action</th>
                            <th>Course Name</th>
                        </tr>
                  <?php
                        if ($course_name) 
                        {
                            foreach ($course_name as $course) 
                            {
                  ?>
                        <tr>
                            <td>
                                <a href="?action=<?php echo $course['course_id']?>">Delete</a>
                            </td>

                            <td><?php  echo $course['course_name']?></td>
                        </tr>
                  <?php } }?>      

                    </table>
                </form>

            </div> 
           <?php }?> 
 
        </div>
    </body>
</html>
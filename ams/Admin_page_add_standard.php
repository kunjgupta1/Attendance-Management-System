<?php
    include 'include/manage.php';
    Session::check_admin_login(); 
?>
<?php  
        $admin = new Admin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Add'])) 
        {
             $admin_standard = $admin->admin_addStandard($_POST); 
        }

?>
<?php  
        if(isset($_GET['action']))
      {
       $standard_id = $_GET['action'];
       $delete = $admin->admin_deleteStandard($standard_id);
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
            input[type=text],input[type=password]{
                padding: 1.5%;
                font-family: rRegular;
                border: 0.35vh solid rgba(0, 0, 0, 0.2);
                border-radius: 5px;
            }
            select{
                width: 100%;
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
                <?php 
                    if (isset($admin_standard)) {
                        echo $admin_standard;
                    }

                ?>
                <?php 
                    if (isset($delete)) {
                        echo $delete;
                    }

                ?>
                <span>Add Standard</span>
            </div>
            <div id="mainRightContainerBottomE-2">
                <form style="margin: auto;" method="post">
                    <table style="margin: auto;">
                        <tr>
                          <td>Course</td>
                          <td>
                            <select name="course_name" required>
                            
                                <option value="">Select</option>
                            <?php
                                $select = $admin-> admin_showCourse();
                                if ($select) 
                                {
                                    foreach ($select as $Course) {                 
                                
                            ?>
                                <option value="<?php echo $Course['course_name'];?>"><?php echo $Course['course_name'];?></option>
                               
                            <?php } }?>
                            </select>
                          </td>  
                        </tr> 
                       <tr>
                          <td>Standard Name</td>
                          <td><input type="text" name="standard_name" required></td>  
                        </tr>
                        
                        <tr>
                            <td></td>
                            <td><input type="submit" name="Add" value="Add"></td>
                        </tr>
                    </table>
                  </form>
            </div>
            
            
          <?php 
            $admin_standard_table = $admin->admin_showStandard();
            if ($admin_standard_table) {
                
            
          ?> 
            <div id="mainRightContainerBottomE-3">           
                <form style="margin: auto;" method="get">
                    <table style="margin: auto; text-align: center; ">
                        <tr>
                            <th>Action</th>
                            <th>Course Name</th>
                            <th>Standard Name</th>
                        </tr>
                    <?php
                        
                        if ($admin_standard_table) 
                        {
                            foreach ($admin_standard_table as $admin_st) 
                            {
                                
                    ?>    
                        <tr>
                            <td>
                                <a href="?action=<?php echo $admin_st['standard_id'];?>">Delete</a>
                            </td>
                            <td><?php echo $admin_st['course_name'];?></td>
                            <td><?php echo $admin_st['standard_name'];?></td>
                        </tr>
                   <?php } } ?>
                    </table>
                </form>

            </div> 
            <?php } ?>  
        </div>
    </body>
</html>
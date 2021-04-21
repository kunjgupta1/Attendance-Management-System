<?php
    include 'include/manage.php'; 
     Session::check_admin_login(); 
?>
<?php
         $admin = new Admin();
         if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Add'])) 
          {
                $division = $admin->admin_addDivison($_POST);
          }
                         
?>

<?php  
        if(isset($_GET['action']))
      {
       $division_id = $_GET['action'];
       $delete = $admin->admin_deleteDivison($division_id);
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
                font-weight: bold;
                color: black;
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
                    padding-top: 3%;            
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
                    width: 100%;
                    min-width: 200px;
                }
               #mainRightContainerBottomE-3 td,th{
                    padding: 1vw;
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
                        if (isset($division)) 
                        {
                            echo $division;    
                        }
                ?>
                <span>Add Division</span>
            </div>
            <div id="mainRightContainerBottomE-2">
                <form style="margin: auto;" method="post">
                    <table style="margin: auto;">
                         <tr>
                          <td>Select Course</td>
                          <td>
                            <select name="course_name" id="course_name" onchange='changeFunc()' required>
                            
                                <option value="">Select</option>
                            <?php
                                
                                $select = $admin->admin_showCourse();
                                if ($select) 
                                {
                                    foreach ($select as $Course) {                 
                                       
                            ?>
                            <option value="<?php echo $Course['course_name'];?>"><?php echo $Course['course_name'];?></option>
                                    
                               
                            <?php } } ?>
                            </select>
                          </td>  
                        </tr> 
                         <tr>
                          <td>Select Standard</td>
                          <td>
                            <select name="standard" id="standard" disabled required>
                            
                              
                            </select>
                          </td>  
                        </tr> 
                       <tr>
                          <td>Division Name</td>
                          <td><input type="text" name="division_name" required></td>  
                        </tr>
                        <tr>
                          <td>Seat</td>
                          <td><input type="text" name="seat" required></td>  
                        </tr>

                        <tr>
                            <td></td>
                            <td><input type="submit" name="Add" value="Add"></td>
                        </tr>
                    </table>
                  </form>
            </div>

        <?php 
            $admin_division_table = $admin->admin_showDivision();
            if ($admin_division_table) {
                
            
        ?> 

            <div id="mainRightContainerBottomE-3">
                <table border="black" style="margin: auto; width: 100%;" >
                    <tr>
                        <th>Action</th>
                        <th>Course</th>
                        <th>Standard </th>
                        <th>Division</th>
                        <th>Seat</th>
                    </tr>
                    <?php
                        $admin_division_table = $admin->admin_showDivision();
                        if ($admin_division_table) 
                        {
                            foreach ($admin_division_table as $admin_division) 
                            {
                                
                    ?>    
                    <tr>
                        <td>
                            <a href="?action=<?php echo $admin_division['division_id'];?>">Delete</a>
                        </td>
                        <td><?php echo $admin_division['course_name'];?></td>
                        <td><?php echo $admin_division['standard_name'];?></td>
                        <td><?php echo $admin_division['division_name'];?></td>          
                        <td><?php echo $admin_division['division_seat'];?></td>
                    </tr>
                    <?php } } ?>
                </table>

            </div> 
            <?php }?>    
        </div>
    </body>
</html>
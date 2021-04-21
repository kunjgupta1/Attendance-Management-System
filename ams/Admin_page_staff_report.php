<?php 
        include 'include/manage.php';
         Session::check_admin_login();
?>
<?php
        $admin = new Admin();
        if (isset($_GET['action']))
        {
            $staff_id = $_GET['action'];
            $delete = $admin->admin_deleteStaff_report($staff_id); 
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
            input[type=password], textarea{
                outline: none;
                border-radius: 10px;
                border: 0.35vh solid rgba(0, 0, 0, 0.2);
                 padding: .5%;
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
                    white-space: nowrap;
                    overflow-y: auto;
                }  
                #mainRightContainerBottomE-2 {
                    border: 1px solid blue;
                    margin: 1%;
                    padding: 1%;
                    text-align : center;
                    overflow-x:auto;                   
                }
                 #mainRightContainerBottomE-2 table
                {
                    border:1px solid rgba(0,0,0,.5);
                    border-radius: 10px;
                    width: 100%;
                }
               #mainRightContainerBottomE-2 td,th{
                    border:1px solid rgba(0,0,0,.5);
                    border-radius: 5px;
                    
                }
                #mainRightContainerBottomE-2 th{
                    
                    text-transform: uppercase;                    
                }


                #mainRightContainerBottomE-2 td,th,tr {
                    overflow: hidden;
                    padding: 1vw;
                }
                img {
                    height: 100px;
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
            #table-image {
                margin: 0 auto;
                width: 100px;
                overflow: hidden;
                height: 100px;
                border-radius: 50%;
            }
        </style>
    </head>
    <body>


        
        <div id="mainRightContainerBottom">
            <div id="mainRightContainerBottomE-1">
                <span>Staff Report</span>
            </div>
        <?php
             $staff_report = $admin->showStaffDetails();
                if ($staff_report) 
                    {

        ?>
            <div id="mainRightContainerBottomE-2">
                <form method="post">
                    <table>
                      <tr>
                        <th>Action</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Qualification</th>
                        <th>City</th>
                        <th>Pincode</th>
                      </tr>


                      <?php
                        
                        $staff_report = $admin->showStaffDetails();
                        if ($staff_report) 
                        {
                            foreach ($staff_report as $staff) {
                        
                      ?>
                      <tr>
                        <td>
                            <a href="?action=<?php echo $staff['staff_id'];?>">Delete</a>
                        </td>
                        <td>
                            <div id="table-image">
                                <img src="<?php  echo $staff['staff_photo'];?>">
                            </div>
                        </td>
                        <td><?php  echo $staff['staff_name'];?></td>
                        <td><?php  echo $staff['staff_email'];?></td>
                        <td><?php  echo $staff['staff_mobile'];?></td>
                        <td><?php  echo $staff['staff_qualification'];?></td>
                        <td><?php  echo $staff['staff_city'];?></td>
                        <td><?php  echo $staff['staff_pincode'];?></td>
                      </tr>
                     <?php } } ?>   
                     
                    </table>
                </form>      
            </div>
            <?php }  else{?>
                <div id="mainRightContainerBottomE-2" style="border: none;font-weight: bold;">
                     <span>No data yet.....</span>
                 </div>
            <?php }?>
        </div>

    </body>
</html>
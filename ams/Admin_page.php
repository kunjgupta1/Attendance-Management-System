<?php
        
        include_once 'include/Session.php';
        Session::init();
        Session::check_admin_login();
?>

<?php
     
      if(isset($_GET['action']) && $_GET['action'] == 'logout')
      {
        Session :: destroy();
      } 
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
            }
            a{
                text-decoration: none;
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

            #mainLeftContainer {
                overflow:hidden;
                float: left;
                width: 25%;
            }

                #mainLeftContainerTop{
                    overflow: hidden;
                    margin: 1%;
                    margin-top: 2.5%;
                    margin-bottom: 2%;
                    border:1px solid red;

                }
                    #mainLeftContainerE-1{
                        
                        overflow: hidden;
                        margin: 1%;
                        padding-top: 0.5%;
                    }
                        #mainLeftContainerE-1-img {
                            width: 30%;
                            display: block;
                            margin: 0 auto;
                            border:1px solid green;
                            border-radius: 50%;
                        }
                        #mainLeftContainerE-1-name {
                            white-space: nowrap;
                            margin-top: 3.5%;
                            margin-left: 3%;
                            padding: 1%;
                            text-align:center;
                            width: 90%;
                            font-family: rRegular;
                            float: left;
                            border:1px solid green;
                            overflow-y: auto;
                            white-space: nowrap;

                        }
                        #mainLeftContainerE-1-username {
                            white-space: nowrap;
                            width:  90%;
                            margin-top: 3.5%;
                            margin-left: 3%;
                            margin-bottom: 3%;
                            padding: 1%;
                            float: left;
                            text-align: center;
                            font-family: rRegular;
                            overflow-y: auto;
                            white-space: nowrap;
                            border:1px solid green;
                        }
                    #mainLeftContainerBottom{
                        overflow: hidden;
                        margin: 1%;
                        padding: 4%;
                        border:1px solid red;
                        
                    }
                    #mainLeftContainerBottomE-0 {
                        margin: 1%;
                        border: 1px solid red;
                        padding: 1%;
                        font-weight: bold;
                        font-family: rRegular;
                        text-align: center;
                        letter-spacing: .2vw;
                        overflow-y: auto;
                        white-space: nowrap;


                    }

                    #mainLeftContainerBottomE-1 {
                        margin: 1%;
                        border: 1px solid red;
                        padding: 1%;
                        margin-top: 6%;
                        font-weight: bold;
                        font-family: rRegular;
                        text-align: center;
                        letter-spacing: .2vw;
                        overflow-y: auto;
                        white-space: nowrap;


                    }

                    #mainLeftContainerBottomE-2 {
                        margin: 1%;
                        margin-top: 6%;
                        border: 1px solid red;
                        padding: 1%;
                        font-weight: bold;
                        font-family: rRegular;
                        text-align: center;
                        letter-spacing: .2vw;
                        overflow-y: auto;
                        white-space: nowrap;


                    }
                    
                    #mainLeftContainerBottomE-3 {
                        margin: 1%;
                        margin-top: 6%;
                        border: 1px solid red;
                        padding: 1%;
                        font-weight: bold;
                        font-family: rRegular;
                        text-align: center;
                        letter-spacing: .2vw;
                        overflow-y: auto;
                        white-space: nowrap;


                    }
                    #mainLeftContainerBottomE-4 {
                        margin: 1%;
                        margin-top: 6%;
                        border: 1px solid red;
                        padding: 1%;
                        font-weight: bold;
                        font-family: rRegular;
                        text-align: center;
                        letter-spacing: .2vw;
                        overflow-y: auto;
                        white-space: nowrap;

                    }   
                   
                    #mainLeftContainerBottomE-7 {
                        margin: 1%;
                        margin-top: 6%;
                        border: 1px solid red;
                        padding: 1%;
                        font-weight: bold;
                        font-family: rRegular;
                        text-align: center;
                        letter-spacing: .2vw;
                        overflow-y: auto;
                        white-space: nowrap;

                    }
                    #mainLeftContainerBottomE-8 {
                        margin: 1%;
                        margin-top: 6%;
                        border: 1px solid red;
                        padding: 1%;
                        font-weight: bold;
                        font-family: rRegular;
                        text-align: center;
                        letter-spacing: .2vw;
                        overflow-y: auto;
                        white-space: nowrap;

                    }
            #mainRightContainer {
                width: 75%;
                overflow: hidden;
                float: right;
            }
            #mainRightContainerTop {
                margin-left: 4px;
                margin: 1%;
                overflow: hidden;
                border: 1px solid red;

            }
                #mainRightContainerTopE-1{
                    overflow: hidden;
                    margin-left: 4px;
                    margin: 1%;
                    padding: .5% 1%;
                    font-family: rRegular;
                    float: right;
                    border: 1px solid red;
                    cursor: pointer;
                    letter-spacing: .05vw;
                    border: 0.4vh solid      rgba(0, 0, 0, 0.3);
                    border-radius: 4px;
                } 

            #mainRightContainerBottom {
                height: 82vh;
                border: 1px solid red;
                margin: 1%; 
            }  
            @media (max-width: 1200px){
                body {
                }
                #mainLeftContainer {
                    width: 30%;
                }
                #mainRightContainer {
                    width: 70%;
                }
            }        
            @media (max-width: 1100px){
                body {
                }
                #mainLeftContainer {
                    width: 35%;
                }

                #mainRightContainer {
                    width: 65%;
                }
            }
            @media (max-width: 1000px){
                body {
                }
                #mainLeftContainer {
                    width: 100%;
                }
                #mainLeftContainerE-1-img {
                    width: 20%;
                    margin: 1%;
                    float: left;
                }
                #mainLeftContainerE-1-name {
                    width: 70%;
                    float: left;;
                }
                #mainLeftContainerE-1-username {
                    width: 69%;
                    float: left;
                }
                #mainLeftContainerBottom {
                    padding: 1%;
                }
                 #mainLeftContainerBottomE-0 {
                    margin-top: 0;
                }   
                #mainLeftContainerBottomE-1 {
                    margin-top: 0;
                }
                #mainLeftContainerBottomE-2 {
                    margin-top: 0;
                }
                #mainLeftContainerBottomE-3 {
                    margin-top: 0;
                }
                #mainLeftContainerBottomE-4 {
                    margin-top: 0;
                }
                
                #mainLeftContainerBottomE-7 {
                    margin-top: 0;
                    margin-bottom: 0;
                }

                #mainRightContainer {
                    width: 100%;
                }
            }
            @media (max-width: 900px){
                body {
                }
                #mainLeftContainer {
                    border: 1px solid blue;
                }
            }
            @media (max-width: 800px){
                body {
                }
                #mainLeftContainer {
                    border: 1px solid blue;
                }
            }
            @media (max-width: 700px){
                body {
                }
                #mainLeftContainer {
                    border: 1px solid blue;
                }
            }
            @media (max-width: 600px){
                body {
                }
                #mainLeftContainer {
                    border: 1px solid blue;
                }
            }
            @media (max-width: 500px){
                body {
                }
                #mainLeftContainer {
                    border: 1px solid rgb(99, 99, 20);
                }
            }
            @media (max-width: 400){
                body {
                }
                #mainLeftContainer {
                    border: 1px solid yellow;
                }
            }
           /* add style */
           #mainLeftContainerTop {
               border-radius: 15px;
               border: 1px solid rgba(104, 104, 104, 0.500);
               box-shadow:rgba(104, 104, 104, 0.500) 0px 0px 1vw 2px inset;
           }
           #mainLeftContainerE-1-img {
               border: 1px solid rgba(104, 104, 104, 0.500);
               box-shadow:rgba(104, 104, 104, 0.500) 0px 0px 1vw 2px ;    
           }
           #mainLeftContainerE-1-name {
                border-radius: 15px;
               border: 1px solid rgba(104, 104, 104, 0.100);
               box-shadow:rgba(104, 104, 104, 0.100) 0px 0px 1vw 2px ; 
           }
           #mainLeftContainerE-1-username {
               border-radius: 15px;
               border: 1px solid rgba(104, 104, 104, 0.100);
               box-shadow:rgba(104, 104, 104, 0.100) 0px 0px 1vw 2px ; 
           }
           #mainLeftContainerBottom {
                border-radius: 15px;
                border: 1px solid rgba(104, 104, 104, 0.500);
                box-shadow:rgba(104, 104, 104, 0.500) 0px 0px 1vw 2px inset;   
            }
            #mainLeftContainerBottomE-0 {
               border-radius: 10px;
               border: 2px solid rgba(104, 104, 104, 0.5);
               box-shadow:rgba(104, 104, 104, 0.100) 0px 0px 1vw 2px ; 
            }
            #mainLeftContainerBottomE-1 {
               border-radius: 10px;
               border: 2px solid rgba(104, 104, 104, 0.5);
               box-shadow:rgba(104, 104, 104, 0.100) 0px 0px 1vw 2px ; 
            }
            #mainLeftContainerBottomE-2 {
               border-radius: 10px;
               border: 2px solid rgba(104, 104, 104, 0.5);
               box-shadow:rgba(104, 104, 104, 0.100) 0px 0px 1vw 2px ; 
            }
            #mainLeftContainerBottomE-3 {
               border-radius: 10px;
               border: 2px solid rgba(104, 104, 104, 0.5);
               box-shadow:rgba(104, 104, 104, 0.100) 0px 0px 1vw 2px ; 
            }
            #mainLeftContainerBottomE-4 {
               border-radius: 10px;
               border: 2px solid rgba(104, 104, 104, 0.5);
               box-shadow:rgba(104, 104, 104, 0.100) 0px 0px 1vw 2px ; 
            }
           
            #mainLeftContainerBottomE-7 {
               border-radius: 10px;
               border: 2px solid rgba(104, 104, 104, 0.5);
               box-shadow:rgba(104, 104, 104, 0.100) 0px 0px 1vw 2px ; 
            }
            #mainRightContainerTop {
               border-radius: 15px;
               border: 1px solid rgba(104, 104, 104, 0.5);
               box-shadow:rgba(104, 104, 104, 0.300) 0px 0px 1vw 2px inset;
               
            }
            #mainRightContainerTopE-1{
                margin: 1.5%;
                margin-right: 3.5%;
                padding: .18% 1%;
                border-radius: 4px;
                border: 1px solid rgba(104, 104, 104, 1);
                box-shadow:rgba(104, 104, 104, 0.3) 0px 0px .05vw 1px;
               
            }
            #mainRightContainerBottom{
                overflow: hidden;
               border-radius: 10px;
               border: 1px solid rgba(104, 104, 104, 0.500);
               box-shadow:rgba(104, 104, 104, 0.500) 0px 0px 1vw 2px inset;
            }
            a {
                color:rgba(0, 0, 0, 0.9); 
                text-decoration: none;
            }
            a:active {
                color:rgba(0,0,0,0.6);
            }
        </style>
        <script>  
        function addCoursePage() {
                 document.getElementById("mainRightContainerBottom").innerHTML = '<object type="text/html" data="Admin_page_add_course.php" style="width: 100%; height: 100%; "></object>'; 
           }  
            function addStandardPage() {
                 document.getElementById("mainRightContainerBottom").innerHTML = '<object type="text/html" data="Admin_page_add_standard.php" style="width: 100%; height: 100%; "></object>'; 
           }
           function addDivisionPage() {
                 document.getElementById("mainRightContainerBottom").innerHTML = '<object type="text/html" data="Admin_page_add_division.php" style="width: 100%; height: 100%;"></object>'; 
           }
           function addStaffPage() {
               document.getElementById("mainRightContainerBottom").innerHTML = '<object type="text/html" data="Admin_page_add_staff.php" style="width: 100%; height: 100%;"></object>'; 
           }
           function addStaffreportPage() {
                document.getElementById("mainRightContainerBottom").innerHTML = '<object type="text/html" data="Admin_page_staff_report.php" style="width: 100%; height: 100%;"></object>'; 
           }
       
           function addStudentReportPage() {
                 document.getElementById("mainRightContainerBottom").innerHTML = '<object type="text/html" data="Admin_page_student_report.php" style="width: 100%; height: 100%;"></object>'; 
           }
           

        </script>
    </head>
    <body onload="addCoursePage()">
        <div id="main">
            <div id="mainLeftContainer">
                <div id="mainLeftContainerTop">
                    <div id="mainLeftContainerE-1">
                        <img id="mainLeftContainerE-1-img" src="images/user.png" alt="User Photo">
                        <span id="mainLeftContainerE-1-name">Name: Hemant Ajmera</span>
                        <span id="mainLeftContainerE-1-username">Username: kunjGupta123</span>
                    </div>
                </div>
                <div id="mainLeftContainerBottom">
                     <a href="#" onclick="addCoursePage()">
                        <div id="mainLeftContainerBottomE-0">
                            <span>Add Course</span>
                        </div>
                    </a>
                    <a href="#" onclick="addStandardPage()">
                        <div id="mainLeftContainerBottomE-1">
                            <span>Add Standard</span>
                        </div>
                    </a>
                    <a href="#" onclick="addDivisionPage()">
                        <div id="mainLeftContainerBottomE-2">
                            <span>Add Divison</span>
                        </div>
                    </a>
                    <a href="#" onclick="addStaffPage()">
                        <div id="mainLeftContainerBottomE-3">
                            <span>Add Staff</span>
                        </div>
                    </a>
                    <a href="#" onclick="addStaffreportPage()">
                        <div id="mainLeftContainerBottomE-4">
                            <span>Staff Report</span>
                        </div>
                    </a>
                    
                    <a href="#" onclick="addStudentReportPage()">
                        <div id="mainLeftContainerBottomE-7">
                            <span>Student Report</span>
                        </div>
                    </a>
                </div>
            </div>
            <div id="mainRightContainer">
                <div id="mainRightContainerTop">
                    <div id="mainRightContainerTopE-1">                  
                        <span><a href="?action=logout"> Logout </a></span>
                    </div>
                </div>
                <div id="mainRightContainerBottom">
                    
                </div>
            </div>
        </div>
    </body>
</html>

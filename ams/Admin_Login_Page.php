<?php
            include 'include/Session.php';
            Session::init();
           
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Login']))
             {
                $Username = $_POST['username'];
                $Password = $_POST['password'];  
                if ($Username == "hemant" && $Password == "kunj")
                 {
                      
                      Session::set("admin_login",true);
                      header("Location: Admin_page.php");
                      
                  }  
            }

?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <title>A.M.S</title>
        <meta name="viewport" content="width=device-width, initial-scale= 1.0">
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
                margin: 0;
                padding: 0;
            }
            a{
                text-decoration: none;
            }
            #topMain {
                padding: 1%;
                box-shadow: 0px 3px 5px rgba(104, 104, 104, 0.500);
            }
            #topContainer {
                overflow: hidden;
                padding: 1%;
            }
            #topLeftElements {
                font-size: 200%;
                float: left;
            }
            #topRightElements {
                float: right;
            }
            #site-name-span {
                font-family: rRegular;
                font-weight: bold;
                letter-spacing: 5px;
            }
            #admin-login-button {
                outline: none;
            }
            #admin-login-button {

                white-space: nowrap;
                font-size: 130%;
                padding: 3% 10px;
                cursor: pointer;
                font-family: rLight;
                background-color: rgba(255, 255, 255, 0.815);
                border-radius: 5px;
                border: 1px solid rgba(0,0,0,0.5);
                box-shadow: rgba(0,0,0,0.1) 0px 0px 2px 2px;
            }
            #centerMainContainer {
                width: 50%;
                margin: 5% auto;
                border-radius: 10px;
                box-shadow: 0px 0px  4px 3px rgba(104, 104, 104, 0.500) inset;
                border: .5px solid rgba(255, 255, 255, 0.562);
            }
            
            #centerMainContainerTop {
                margin: 1%;
            }
            

            #centerMainContainerTop {
                border-radius: 8px;
                border: 1.5px solid rgba(90, 90, 90, 0.3);  
                box-shadow: 0px 0px  4px 3px rgba(104, 104, 104, 0.100) inset;
                text-align: center;
                padding: 1%;
            }
            #login-label {
                white-space: nowrap;
                overflow-x: auto;
                padding: 2%;
                margin: 1%;
                border-radius: 8px;
                border: 1.5px solid rgba(90, 90, 90, 0.719);
            }
            #login-form{
                border-radius: 8px;
                border: 1.5px solid rgba(90, 90, 90, 0.719);
                padding: 5%;
                margin: 1%;
                overflow-x: auto;
            } 
            #login-username-label {
                font-family: rRegular;
                letter-spacing: 1px;
            }
            #login-password-label {
                font-family: rRegular;
                letter-spacing: 1px;
            }
            #form-top-elements {
                width: 100%;
                margin: 1%;
                white-space: nowrap;
                display: inline-block;
            }
            #form-center-elements {
                width: 100%;
                margin: 1%;
                white-space: nowrap;
                display: inline-block;
            }
            #form-bottom-elements {
                width: 100%;
                text-align: center;
                margin: 1%;
            }
            input[type=text], input[type=password] {
                padding: 1% .8%;
                width: 40%;
                font-family: rThin;
                font-weight: bold;  
                letter-spacing: 1px;
                border-radius: 5px;
                border: 2px solid rgba(0, 0, 0, 0.2);
                min-width: 140px;
            }
            input[type=text]:focus, input[type=password]:focus {
                outline: none;
                border: 2px solid rgba(12, 145, 185, 0.8);
            }
            input[type=submit] {
                font-family: rLight;
                font-weight: bold;  
                letter-spacing: 1.5px;
                text-align: center;
                padding: 1%; 
                cursor: pointer;
                background-color: rgba(255, 255, 255, 0.3);
                border: 1px solid rgba(0,0,0,0.3);
                border-radius: 4px;
            }
            form {
                margin: auto;
            }

            @media (max-width: 1000px){
                #centerMainContainer {
                    width: 90%;
                }
            }
        </style>
    </head>
    <body>
        <div id="topMain">
            <div id= "topContainer">
                <div id="topLeftElements">
                    <span id="site-name-span">A.M.S</span>
                </div>
                <div id="topRightElements">
                    <button id="admin-login-button">
                        <span><a href="index.php"> Home </a></span>
                    </button>
                </div>
            </div>          
        </div>
        <div id="centerMain">
            <div id="centerMainContainer">
                <div id="centerMainContainerTop">
                    <div id="login-label">
                        <span style="font-family: rRegular; font-size: 150%;">Admin Login</span>
                    </div>
                    <div id="login-form">
                        <form action="" method="POST">
                            <div id="form-top-elements">
                                <label id="login-username-label">Username :</label>
                                <input type="text" name="username" placeholder="Enter Username" required>
                            </div>
                            <div id="form-center-elements">
                                <label id="login-password-label">Password : </label>
                                <input type="password" name="password" placeholder="Enter Password" required>
                            </div>
                            <div id="form-bottom-elements">
                                <input type="submit" name="Login" value="Login">
                            </div>                                
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>VSchool Manager Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="layout" content="main"/>
    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>

    
    <link href="css/customize-template.css" type="text/css" media="screen, projection" rel="stylesheet" />

    <style>
    </style>
</head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container" style="padding-top:5px">
                    <img src="assets/img/E2U-Logo-design.png" alt="Logo" / style="width: 150px; padding: 5px">                   
                </div>
            </div>
        </div>
        <div id="body-container">
                    <div id="body-content">
                        
                        
            <div class='container'>
                
                <div class="signin-row row">
                    <div class="span4"></div>
                    <div class="span8">
                        <div class="container-signin">
                            <legend>Please Login</legend>
                            <form action='indexA' method='POST' id='loginForm' class='form-signin' autocomplete='off'>
                                <div class="form-inner">
                                    <?php if(!empty($errors)){echo $errors;} ?>
                                    <div class="input-prepend">
                                        <span class="add-on" rel="tooltip" title="Username or E-Mail Address" data-placement="top"><i class="icon-envelope"></i></span>
                                        <input type='text' class='span4' id='user' name="user"/>
                                    </div>

                                    <div class="input-prepend">
                                        
                                        <span class="add-on"><i class="icon-key"></i></span>
                                        <input type='password' class='span4' id='password' name="password"/>
                                    </div>
                                    <label class="checkbox" for='remember_me'>Remember me
                                        <input type='checkbox' id='remember_me' name="password"/>
                                    </label>
                                </div>
                                <footer class="signin-actions">
                                    <input class="btn btn-primary" type='submit' id="submit" value='Log in' name="Submitc"/>
                                </footer>
                            </form>
                        </div>
                    </div>
                    <div class="span3"></div>
                </div>

                <!-- <div class="signin-row row">
                    <div class="span4"></div>
                    <div class="span8">
                        <div class="well well-small well-shadow">
                            <legend class="lead" style="color:#F00">Username/password combination incorrect.<br />
					Please make sure your caps lock key is off and try again.</legend>
                        </div>
                    </div>
                    <div class="span8"></div>
                </div>               -->
            <!--<div class="span4">

                </div>-->
            </div>
    

            </div>
        </div>
        <div id="spinner" class="spinner" style="display:none;">
            Loading&hellip;
        </div>

        <!-- <footer class="application-footer">
            <div class="container">
                <p>Developed by Norak Technologies Ltd..</p>
                <div class="disclaimer">
                    <p>All right reserved.</p>
                    <p>Copyright © Norak Technologies Ltd.. </p>
                </div>
            </div>
        </footer> -->
        
	</body>
</html>


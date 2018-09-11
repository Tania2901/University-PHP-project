<head>
     
    <style>
   <?php
 include("../css/autentificare.css");

    ?>
    </style>

</head>

<div class="login_background">
<center>
 <a href="..\index.php"> <img id="logo" src="http://taniamarin.weebly.com/uploads/1/9/9/5/19958899/1454616862.png" alt="logo"></a>  
<form name="login" action="login.php" method="post">
      <div class="login">
            <div class="login-screen">
                <div class="app-title">
                    <h1>Login</h1>
                </div>

                <div class="login-form">
                    <div class="control-group">
                        <input type="text" name="user" class="login-field" value="" placeholder="username" id="login-name" >
                        <label class="login-field-icon fui-user" for="login-name"></label>
                    </div>

                    <div class="control-group">
                        <input type="password"  name="pass" class="login-field" value="" placeholder="password" id="login-pass">
                        <label class="login-field-icon fui-lock" for="login-pass"></label>
                    </div>

                
                    <input class="btn btn-primary btn-large btn-block"  type="submit" value="Autentifica-te" />
                    <a class="login-link" href="#">Lost your password?</a>
                </div>
            </div>
        </div>
</div>
</form></center>

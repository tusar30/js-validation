<?php 
    require "DbConnect.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login form</title>
    </head>

    <body>

         <?php 

            $flag=false;
            $userNameErr=$successfulMessage=$errorMessage=$passwordErr="";

            if($_SERVER['REQUEST_METHOD']=='POST')
            {
            $userName=test_name($_POST['username']);
            $password=test_name($_POST['password']);

            if(empty($_POST['username']))
            {
                $userNameErr="*required";
                $flag=true;
                
            }
            if(empty($_POST['password']))
            {
                $passwordErr="*required";
                $flag=true;
                
                
            }


            if(!$flag)
            {
                $result=login($userName,$password);

                if($result)
                {
                    session_start();
                    $_SESSION['userName']=$userName;
                    header("Location:Home.php");
                }
                else
                {
                    $errorMessage="login Failed";
                }
                
            }
            

            }


            function test_name($data)
            {
            $data=trim($data);
            $data=stripcslashes($data);
            $data=htmlspecialchars($data);
            return $data;
            }

        ?>
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" name="login" onsubmit="return isvalid()" >
            
            <h1>Login Form</h1>
            <fieldset>
            <Legend>Log in :</Legend>
                
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" ><span id="userNameErr" style="color : green;"><?php echo $userNameErr; ?></span>
                <br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" pattern=".{4,}" ><span id="passwordErr" style="color : green;"><?php echo $passwordErr; ?></span>
                 <br><br>
                <input type="submit" value="submit">
            </fieldset>

        </form>

        <p><a href="Registration.php"><b style="color:green;">Click here for registration </b></a></p>

        <span style =" color : green;"><?php echo "<b>" .$successfulMessage  ."</b>"; ?></span>
         <span style =" color : green;"><?php echo "<b>" .$errorMessage  ."</b>"; ?></span>
        
         <script>
             function isvalid()
             {
                 var flag = true;
                 var userNameErr=document.getElementById("userNameErr");
                 var passwordErr=document.getElementById("passwordErr");
                 var username=document.forms["login"]["username"].value;
                 var password=document.forms["login"]["password"].value;

                 userNameErr.innerHTML="";
                 passwordErr.innerHTML="";
                if(username =="")
                {
                    userNameErr.innerHTML="*required";
                    flag=false;
                }

                if(password =="")
                {
                    passwordErr.innerHTML="*required";
                    flag=false;
                }

                return flag;

             }
         </script>
    </body>
</html>
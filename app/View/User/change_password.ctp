<html>
    <head>
        <style>
            header {
                background-color:black;
                color:white;
                text-align:center;
                padding:1px; 
            }
        </style>
        <script type="text/javascript">
            
            $(document).ready(function () {
       
                $("#submit").click(function () {
                    alert("hello");
                });
            });
    
        </script>
        <title>change password</title>
    </head>
    <body>
        <header>
            <h3>Change Password</h3>
        </header><br>
        <div>
            <form name="changepassword" action="changePassword" method="post">
                <input type="hidden" name="user_id" value="<?php echo $userInfo['User']['user_id']; ?>"/>
                <label>Old Password</label>:<br><input id="password" name="password" value="<?php echo $userInfo['User']['password']; ?>" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Password" readonly style="width:350px" required /><br>
                <label>New Password</label>:<br><input id="password" name="password" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Password" style="width:350px" required /><br>
                <label>Confirm Password</label>:<br><input id="cpassword" name="c_password" title="Please enter the same Password as above." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Confirm Password" style="width:350px"><br><br>
                <input type="submit" value="Update">
                <input type="reset" value="Reset">
            </form>
        </div>
    </body>
</html>
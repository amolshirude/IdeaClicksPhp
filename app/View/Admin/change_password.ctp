<!DOCTYPE html>
<html>
    <head>
        <style>
            header {
                background-color:black;
                color:white;
                text-align:center;
                padding:1px; 
            }
            footer {
                background-color:black;
                color:white;
                text-align:left;
                padding:1px; 
            }
        </style>
        
        <script type="text/javascript">

            document.addEventListener("DOMContentLoaded", function() {

                // JavaScript form validation

                var checkPassword = function(str)
                {
                    var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
                    return re.test(str);
                };

                var checkForm = function(e)
                {
                    if(this.password.value != "" && this.password.value == this.c_password.value) {
                        if(!checkPassword(this.password.value)) {
                            alert("The password you have entered is not valid!");
                            this.password.focus();
                            e.preventDefault();
                            return;
                        }
                    } else {
                        alert("Error: Please check that you've entered and confirmed your password!");
                        this.password.focus();
                        e.preventDefault();
                        return;
                    }
                };

                var myForm = document.getElementById("myForm");
                myForm.addEventListener("submit", checkForm, true);

                // HTML5 form validation

                var supports_input_validity = function()
                {
                    var i = document.createElement("input");
                    return "setCustomValidity" in i;
                }

                if(supports_input_validity()) {
                    
                    var passwordInput = document.getElementById("password");
                    passwordInput.setCustomValidity(passwordInput.title);

                    var c_passwordInput = document.getElementById("cpassword");

                    // input key handlers

                    usernameInput.addEventListener("keyup", function() {
                        usernameInput.setCustomValidity(this.validity.patternMismatch ? usernameInput.title : "");
                    }, false);

                    passwordInput.addEventListener("keyup", function() {
                        this.setCustomValidity(this.validity.patternMismatch ? passwordInput.title : "");
                        if(this.checkValidity()) {
                            c_passwordInput.pattern = this.value;
                            c_passwordInput.setCustomValidity(c_passwordInput.title);
                        } else {
                            c_passwordInput.pattern = this.pattern;
                            c_passwordInput.setCustomValidity("");
                        }
                    }, false);

                    c_passwordInput.addEventListener("keyup", function() {
                        this.setCustomValidity(this.validity.patternMismatch ? c_passwordInput.title : "");
                    }, false);

                }

            }, false);

        </script>
        <title>change password</title>
    </head>
    <body>
        <header>
            <h3>Change Password</h3>
            <?php echo $this->element('../Pages/admin_header'); ?>
        </header>        
        <br>
        <table width="100%" border="1">
            <tr valign="top">
                <td bgcolor="#b5dcb3" >
                    <div align="left">

                        <form id="myForm" name="changepassword" action="changePassword" method="post">
                            <input type="hidden" name="group_id" value="<?php echo $groupInfo['CreateGroup']['group_id']; ?>"/>
                            <label>Old Password</label>:<br><input id="opassword" name="opassword" value="<?php echo $groupInfo['CreateGroup']['password']; ?>" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Password" readonly style="height: 25px;width:350px" required /><br>
                            <label>New Password</label>:<br><input id="password" name="password" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Password" style="height: 25px; width:350px" required /><br>
                            <label>Confirm Password</label>:<br><input id="cpassword" name="c_password" title="Please enter the same Password as above." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Confirm Password" style="height: 25px; width:350px"><br><br>
                            <input type="submit" value="Update">
                            <input type="reset" value="Reset">
                        </form>
                         <?php
                            $message = $this->Session->consume('pcmessage');
                            echo '<h4 style="color: #FF0000">';
                            echo $message;
                            echo '</h4>';
                            ?>
                    </div></td></table>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <footer>
            <?php echo $this->element('../Pages/footer1'); ?>
        </footer>
    </body>
</html>
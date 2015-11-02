<html>
    <head>
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
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
            nav {
                line-height:30px;
                height:420px;
                width:200px;
                float:left;
                padding:5px; 
            }
            section {
                width:350px;
                float:left;
                padding:10px; 
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
                    var usernameInput = document.getElementById("field_username");
                    usernameInput.setCustomValidity(usernameInput.title);

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
    </head>
    <body>
        <header>
            <h3>User profile</h3>
            <?php echo $this->element('../Pages/header1'); ?>
        </header>
        <table width="100%" border="1">
            <tr valign="top">
                <td bgcolor="#b5dcb3" height="200" width="30%">
                 <div align="left">
                        <h3> Join Group </h3>
                        <form name="joinGroup" action="joinGroup" method="post">
                            <label>Group Code:</label>
                            <select name="group_code" style="height: 30px;width: 120px" required>
                                <option value="">Select Group</option>
                                <?php foreach ($groupInfo as $row): ?>
                                    <option value ="<?php echo $row['GetRegisteredGroupData']['group_code']; ?>">
                                        <?php echo $row['GetRegisteredGroupData']['group_code']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="submit" value="Join" style="height: 30px;width: 70px;">
                        </form>
                    </div>
                    <h3 align="left">Request Status</h3>
                    <div align="left">
                        <table border="1">
                            <tr>
                                <th>Group code</th>
                                <th>Status</th>
                            </tr>
                            <?php foreach ($joinGroupRequest as $row): ?> 
                            <tr>
                                <td><?php echo $row['JoinGroup']['group_code']; ?></td>
                                <td><?php echo $row['JoinGroup']['status']; ?></td> 
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>   

                </td>
                <td bgcolor="#aaa" align="left" width="40%">
                    <form name="updateProfile" enctype="multipart/form-data" action='updateProfile' method="post">
                        <input type="hidden" name="user_id" value="<?php echo $userInfo['User']['user_id']; ?>"/>
                        <input type="text" name="image" style="height: 100px;width: 85px"><br>
                        <input type="file" name="profile_image"><br>
                        <label>Full Name</label>:<br><input type="text" name="user_name" id="user_name" placeholder="Full Name" value="<?php echo $userInfo['User']['user_name']; ?>" style="width:350px" /><br>
                        <label>Gender:</label><select name="gender"><option><?php echo $userInfo['User']['gender']; ?><option value="">Select</option><option value="Male">Male</option><option value="Female">Female</option></select><br>
                        <label>Email Id</label>:<br><input type="email"  name="user_email" id="email_id" placeholder="Email Id" value="<?php echo $userInfo['User']['user_email']; ?>" style="width:350px" readonly="true"/><br>
                        <label>Mobile:</label><br><input type="tel" name="user_mobile" value="<?php echo $userInfo['User']['user_mobile']; ?>" placeholder="Mobile No" style="width:350px"><br>
                        <label>Address</label>:<br><textarea name="user_address" id="user_address" placeholder="Address" value="<?php echo $userInfo['User']['user_address']; ?>" style="height:100px ;width:350px"></textarea><br><br>
                        <label>Country</label><label style="margin-left: 38%">State</label><br>
                        <select name="country" style="width: 40%"><option><?php echo $userInfo['User']['country']; ?></option><option>Select Country</option><option>India</option><option>USA</option></select>
                        <select name="state" style="width: 40%;margin-left: 7%"><option><?php echo $userInfo['User']['state']; ?></option><option>Select State</option><option>Maharashtra</option><option>Gujrat</option></select><br><br>
                        <label>City</label><label style="margin-left: 45%">Pin Code</label><br>
                        <select name="city" style="width: 41%"><option><?php echo $userInfo['User']['city']; ?></option><option>Select City</option><option>Pune</option><option>Mumbai</option></select>
                        <input type="text" name="pincode" id="pincode" value="<?php echo $userInfo['User']['pincode']; ?>" placeholder="pin code" style="width: 41%;margin-left: 6%"><br><br>
                        <input type="submit" id="submit" value="Update" onclick="checkpassword()"/>
                    </form>
                </td>
                <td bgcolor="#b5dcb3" align="center" height="220" width="30%">
                    <div><a class="button" href="../User/change_password">change password</a></div><br>
                    <div align="left">
                        <h3> Invite Your Friend </h3>
                        <form name="InviteUser" action="#" method="post">
                            <label>Email Id:</label><input type="text" name="invite_user" style="height: 30px;width: 200px" required><br><br>
                            <input type="submit" value="Invite" style="height: 30px;width: 100px; margin-left: 60px">
                        </form>
                    </div>
                    
                </td>
            </tr>
        </table>
    <footer>
        <?php echo $this->element('../Pages/footer1'); ?>
   </footer>
</html>
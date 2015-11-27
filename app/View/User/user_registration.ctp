<html>
    <head>

        <style>
            header {
                background-color:#068097;
                color:white;
                text-align:center;
                padding:1px; 
            }
            footer {
                background-color:#068097;
                color:white;
                text-align:left;
                padding:1px; 
            }
            nav {
                line-height:30px;
                background-color:#eeeeee;
                height:420px;
                width:200px;
                float:right;
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
    </style>
    <script type="text/javascript">
        window.tokn = $.md5('<?php echo $saltKey; ?>');
        $(document).ready(function() {
            $('#LoginValidationsPassword').val('');
            $('#reload').click(function() {
                var captcha = $("#captcha_image");
                captcha.attr('src', captcha.attr('src') + '?' + Math.random());
                return false;
            });
            $('#close').click(function () {
                $('#lightDistData').hide();
                $('#fadeDistData').hide();
                $('#distdata,#blkdata,#schdata,#divdata,#studdata').html('');
            
            });
        });
    </script>

    <script type="text/javascript">
        $(function() {
            $('#LoginValidationsCaptcha').keyup(function() {
                if (this.value.match(/[^0-9]/g)) {
                    this.value = this.value.replace(/[^0-9]/g, '');
                }
            });
            //        $('#LoginValidationsCaptcha').keyup(function() {
            //            if (this.value.match(/[^a-zA-Z]/g)) {
            //                this.value = this.value.replace(/[^a-zA-Z]/g, '');
            //            }
            //        });
            //        $('#LoginValidationsCaptcha').keyup(function() {
            //            if (this.value.match(/[^a-zA-Z0-9]/g)) {
            //                this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');
            //            }
            //        });
        });
        function disply_district_data(id)
        {
            jQuery.post('../Users/get_dist_tchr_cnt', {distcd: id}, function (data) { 
                $('#lightDistData').show();
                $('#fadeDistData').show();
                $('#distdata').html(data);
                $('#distdata').show();
                //alert(data);
                //window.open("../Reports/get_district_studcnt",'_blank','toolbar=0,location=no,menubar=0,height=600,width=900,left=300, top=300');          
            });
            //window.open("excel_admm_stat_blk_detail");
        }
    </script>
</head>
<body>
    <div>
        <header>
            <h3>User Registration</h3>
            <?php echo $this->element('../Pages/header2'); ?>
        </header>
    </div>
    <div>
        <section>
            <?php
            $message = $this->Session->consume('user_reg_message');
            echo '<h4 style="color: #FF0000">';
            echo $message;
            echo '</h4>';
            ?>
            <form id="myForm" name="userRegistration" action='userRegistration' method="post">

                <label>Name</label><b style="color: red;">*</b>:<br><input type="text" name="user_name" id="group_name" placeholder="User Name" style="width:350px" required/><br>
                <label>Email Id</label><b style="color: red;">*</b>:<br><input type="email"  name="user_email" id="email_id" placeholder="Email Id" style="width:350px" required/><br>
                <label>Password</label><b style="color: red;">*</b>:<br><input id="password" name="password" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Password" style="width:350px" required><br>
                <label>Confirm Password</label><b style="color: red;">*</b>:<br><input id="cpassword" name="c_password" title="Please enter the same Password as above." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Confirm Password" style="width:350px" required><br>
                <label>Mobile:</label><br><input type="tel" name="user_mobile" style="width:350px"><br>
                <p><input type="checkbox" id="field_terms" onchange="this.setCustomValidity(validity.valueMissing ? 'Please indicate that you accept the Terms and Conditions' : '');" name="check" value="check" required >I accept <a href="..\Admin\termsandcondition">Terms and Conditions</a></p>
                <input type="submit" id="submit" value="Register" />
            </form>

        </section>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <footer>
        <?php echo $this->element('../Pages/footer1'); ?>
    </footer>
</body>
</html>  
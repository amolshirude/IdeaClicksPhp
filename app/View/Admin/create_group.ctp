<?php echo $this->element('../Pages/init'); ?>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<style>
    nav {
        line-height:30px;
        background-color:#9BDBDE;
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
</head>
<body>
    <div>
        <header>
            <h3>Create Group</h3>
            <?php echo $this->element('../Pages/header2'); ?>
        </header>
    </div>
    <nav>
        <div align="left"><h4>Group name ( Group Code )</h4></div>
        <marquee direction="up" height="250">
            <?php foreach ($groupInfo as $row): ?>
                <div align="left"><?php echo $row['GetRegisteredGroupData']['group_name'] . ' ( ' . $row['GetRegisteredGroupData']['group_code'] . ' ) '; ?></div>    
            <?php endforeach; ?>
        </marquee>
    </nav>
    <section>
        <?php
        $message = $this->Session->consume('group_reg_message');
        if ($message == "Registration successful") {
            echo '<div> <h3 style="color: #008000">';
            echo $message;
            echo '</h3></div>';
        } else {
            echo '<div> <h3 style="color: #FF0000">';
            echo $message;
            echo '</h3></div>';
        }
        ?>
        <form id="myForm" name="register" action='register' method="post">
            <label>Group Name:</label><input type="text" class="textbox" name="group_name" id="group_name" placeholder="Group Name" style="width:350px" required/>
            <label>Group code:</label><input type="text" class="textbox" name="group_code" id="group_code" placeholder="Group Code" style="width:350px" required/>
            <label>Group Type:</label><br>
            <select class="textbox" name="group_type" style="width:350px" required>
                <option value="">Select Group Type</option>
                <?php foreach ($groupTypes as $row): ?>
                    <option value ="<?php echo $row['SelectGroupType']['type']; ?>">
                        <?php echo $row['SelectGroupType']['type']; ?>
                    </option>
                <?php endforeach; ?>
            </select><br>
            <label>Email Id:</label><input type="email" class="textbox" name="group_admin_email" id="email_id" placeholder="Email Id" style="width:350px" required/>
            <label>Password:</label> <input id="password" class="textbox" name="password" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Password" style="width:350px" required>
            <label>Confirm Password:</label> <input id="cpassword" class="textbox" name="c_password" title="Please enter the same Password as above." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Confirm Password" style="width:350px" required>
            <p><input type="checkbox" name="group_status" value="open">Open Group</p>
            <p><input type="checkbox" id="field_terms" onchange="this.setCustomValidity(validity.valueMissing ? 'Please indicate that you accept the Terms and Conditions' : '');" name="check" value="check" required >I accept <b><a style="color: #9BDBDE" href="termsandcondition">Terms and Conditions</a></b></p>
            <input type="submit" class="buttonclass" id="submit" value="Register" />
        </form>
     
    </section>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <footer>
        <?php echo $this->element('../Pages/footer1'); ?>
    </footer>
</body>
</html>
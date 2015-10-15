<div class="">

 <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

<form name="CreateGroup" action='register' method="post">
<p>Create Group</p>
<label>Group Name:</label><input type="text" name="group_name" id="group_name" placeholder="Group Name" style="width:350px" required/>
<label>Group code:</label><input type="text" name="group_code" id="group_code" placeholder="Group Code" style="width:350px" required/>
<label>Group Type:</label><?php echo $this->Form->input('GroupListWithCode', array('options' => $groupListWithCode, 'label' => false, 'empty' => '-- Select Type--', 'id' => 'group_type' , 'name' => 'group_type' , 'style' => 'width:350px'));?>
<label>Email Id:</label><input type="email"  name="group_admin_email" id="email_id" placeholder="Email Id" style="width:350px" required/>
<label>Password:</label> <input id="password" name="password" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Password" style="width:350px" required>
<label>Confirm Password:</label> <input id="cpassword" name="c_password" title="Please enter the same Password as above." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Confirm Password" style="width:350px" required><br><br>
<p><input type="checkbox" id="check" name="check" value="check">Agree terms and condition</p>
<input type="submit" id="submit" value="Register" />
</form>
</div>
<script>
    $(document).ready(function() {
        
        $("#group_code").focus(function() {
            var flag = 1;
            var str = "";
            var group_name = $('#group_name').val();
            if (group_name ==='') {
                flag = 0;
                str = "ERR...Group Name Empty.";
            }
            if (!flag) {
                alert(str);
            }

        });
        
        $("#group_type").focus(function() {
            var flag = 1;
            var str = "";
            var group_code = $('#group_code').val();
            if (group_code ==='') {
                flag = 0;
                str = "ERR...Group Code Empty.";
            }
            if (!flag) {
                alert(str);
            }

        });
           $("#email_id").focus(function() {
            var flag = 1;
            var str = "";
            var group_type = $('#group_type').val();
            if (group_type ==='') {
                flag = 0;
                str = "ERR...Select Group Type.";
            }
            if (!flag) {
                alert(str);
            }

        });
        
         $("#password").focus(function() {
            var flag = 1;
            var str = "";
            var email_id = $('#email_id').val();
            if (email_id ==='') {
                flag = 0;
                str = "ERR...Email Id is Empty.";
            }
            if (!flag) {
                alert(str);
            }

        });
        
        $("#cpassword").focus(function() {
            var flag = 1;
            var str = "";
            var password = $('#password').val();
                     
            if (password ==='') {
                flag = 0;
                str = "ERR...Enter Password.";
            }
            if (!flag) {
                alert(str);
            }
        });
       
    
        
    $("#submit").click(function() {
           var x = document.getElementById("check").checked;
           alert(x);
            
        });
              
</script>

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


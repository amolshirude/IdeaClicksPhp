<?php echo $this->element('../Pages/init'); ?>
<style>
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
    function onSubmit(group_id,group_name){
            group_request_form.group_id.value = group_id;
            group_request_form.group_name.value = group_name;
            group_request_form.submit();
    }  
</script>

<title>User profile</title>
</head>
<body>
    <header>
        <h3>View User Profile</h3>
        <?php echo $this->element('../Pages/header1'); ?>
    </header><br>
    <table>
        <tr valign="top">
            <td height="200" width="30%" class="userprofiletd" style='padding:5px 10px 5px 10px'>
                <div align="left">
                    <h3> Join Group </h3>
                    <form name="joinGroup" action="joinGroup" method="post">
                        <label>Group Name:</label><br>
                        <select name="group_id" class="textbox" style="height: 30px;width: 120px" required>
                            <option value="">Select Group</option>
                            <?php foreach ($groupInfo as $row): ?>
                                <option value ="<?php echo $row['create_group']['group_id']; ?>">
                                    <?php echo $row['create_group']['group_name']; ?>
                                </option>
                            <?php endforeach; ?>
                            <option>Other</option>
                        </select>
                        <input type="submit" class="buttonclass" value="Join" style="height: 30px;width: 70px;">
                    </form>
                </div>
                <h3 align="left">Request Status</h3>
                <div align="left">
                    <table class="TFtable">
                        <tr style="background-color: lightslategray;color:white;">
                            <th align="left">Group Name</th>
                            <th align="left">Status</th>
                        </tr>
                        <?php foreach ($joinGroupRequest as $row): ?> 
                            <tr>
                            <form id="group_request_form" action="../Pages/group_page" method="post">
                                <input type="hidden" id="group_id" name="group_id">
                                <input type="hidden" id="group_name" name="group_name">
                                <td><a id="group_name_link" onclick="onSubmit('<?php echo $row['JoinGroup']['group_id']; ?>','<?php echo $row['JoinGroup']['group_name']; ?>')"><?php echo $row['JoinGroup']['group_name']; ?></a></td>
                                <td><?php echo $row['JoinGroup']['status']; ?></td> 
                            </form>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>   

            </td>
            <td align="left" width="40%" class="userprofiletd" style='padding:5px 10px 5px 10px'>
                <form name="updateProfile" enctype="multipart/form-data" action='updateProfile' method="post">
                    <input type="hidden" name="user_id" value="<?php echo $userInfo['User']['user_id']; ?>"/>
                    <img src="<?php echo $userInfo['User']['image_path']; ?>" style="height: 100px;width: 85px"><br>
                    <input type="file" name="profile_image"><br><br>
                    <label>Full Name</label>:<br><input type="text" class="textbox" name="user_name" id="user_name" placeholder="Full Name" value="<?php echo $userInfo['User']['user_name']; ?>" style="width:350px" /><br>
                    <label>Gender</label>:<br><select class="textbox" name="gender">
                        <?php if (!empty($userInfo['User']['gender'])) {
                            echo '<option>';
                            echo $userInfo['User']['gender'];
                            echo '</option>';
                        }?>
                        <option value="">Select</option><option value="Male">Male</option><option value="Female">Female</option></select><br>
                    <label>Email Id</label>:<br><input type="email"  class="textbox" name="user_email" id="email_id" placeholder="Email Id" value="<?php echo $userInfo['User']['user_email']; ?>" style="width:350px" readonly="true"/><br>
                    <label>Mobile:</label><br><input type="tel" class="textbox" name="user_mobile" value="<?php echo $userInfo['User']['user_mobile']; ?>" placeholder="Mobile No" style="width:350px"><br>
                    <label>Address</label>:<br><textarea class="textbox" name="user_address" id="user_address" placeholder="Address" style="height:100px ;width:350px"><?php echo $userInfo['User']['user_address']; ?></textarea><br><br>
                    <label>Country</label><label style="margin-left: 38%">State</label><br>
                    <select name="country" class="textbox" style="height :35%; width: 40%">
                        <?php if (!empty($userInfo['User']['country'])) {
                            echo '<option>';
                            echo $userInfo['User']['country'];
                            echo '</option>';
                        }?>
                        <option>Select Country</option><option>India</option><option>USA</option><option>Other</option></select>
                    <select name="state" class="textbox" style="width: 40%;margin-left: 7%">
                        <?php if (!empty($userInfo['User']['state'])) {
                            echo '<option>';
                            echo $userInfo['User']['state'];
                            echo '</option>';
                        }?>
                        <option>Select State</option><option>Maharashtra</option><option>Gujrat</option><option>Other</option></select><br><br>
                    <label>City</label><label style="margin-left: 45%">Pin Code</label><br>
                    <select name="city" class="textbox" style="width: 41%">
                        <?php if (!empty($userInfo['User']['city'])) {
                            echo '<option>';
                            echo $userInfo['User']['city'];
                            echo '</option>';
                        }?>
                        <option value="">Select City</option><option>Pune</option><option>Mumbai</option><option>other</option></select>
                    <input type="text" class="textbox" name="pincode" id="pincode" value="<?php echo $userInfo['User']['pincode']; ?>" placeholder="pin code" style="width: 41%;margin-left: 6%"><br><br>
                    <input type="submit" class="buttonclass" id="submit" value="Update" onclick="checkpassword()"/>
                </form>
            </td>
            <td align="center" height="220" width="30%"  class="userprofiletd" style='padding:5px 10px 5px 10px'>
                <div><a style="color: #068097" href="../User/change_password">change password</a></div><br>
                <div align="left">
                    <h3> Invite Your Friend </h3>
                    <form name="InviteUser" action="#" method="post">
                        <label>Email Id:</label><br><input type="text" class="textbox" name="invite_user" style="height: 30px;width: 200px" required><br><br>
                        <input type="submit" class="buttonclass" value="Invite" style="height: 30px;width: 70px">
                    </form>
                </div>

            </td>
        </tr>
    </table>
    <footer>
        <?php echo $this->element('../Pages/footer1'); ?>
    </footer>
</html>
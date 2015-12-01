<?php echo $this->element('../Pages/init'); ?>
<style>
    nav {
        line-height:30px;
        background-color:#eeeeee;
        height:420px;
        width:200px;
        float:right;
        padding:5px; 
    }
    .tableborder{
        border: 1px solid black;
        margin-left: 10px;
        margin-bottom: 5px;
        display:block;
        overflow: auto;
    }
    .image:hover{
    }
</style>
<title>Group Profile</title>
</head>
<body>
    <header>
        <h3>View Group Profile</h3>
        <?php echo $this->element('../Pages/admin_header'); ?>
    </header><br>
    <table>
        <tr valign="top">
            <td width="25%" class="userprofiletd" style='padding:5px 10px 5px 10px'>
                <div>
                    <table>
                        <tr>
                            <td>
                                <label>Total Ideas : </label><?php echo $TotalIdeas; ?><br>
                                <?php
                                foreach ($groupCategoriesList as $row):
                                    echo $row['Category']['category_name'] . ' : ';
                                    echo '<br>';
                                endforeach;
                                ?>
                            </td>
                        </tr>
                    </table> 
                </div>
                <h3 align="left">Requests</h3>
                <div align="left">
                    <table class="TFtable">
                        <tr style="background-color: lightslategray;color:white">
                            <th align="left">Email Id</th>
                            <th align="left">Status</th>
                        </tr>
                              <?php foreach ($JoinGroupRequest as $row): ?> 
                            <tr>
                                <td><?php echo $row['JoinGroup']['user_email']; ?></td>
                                <td>
                                    <form name="joinGroupStatus" action="joinGroupStatus" method="post">
                                        <input type="hidden" name="request_id" value="<?php echo $row['JoinGroup']['request_id']; ?>">
                                        <?php if ($row['JoinGroup']['status'] == "Accepted") { ?>
                                            <input type="submit" class="buttonclass" name="button_value" value="Reject">
                                        <?php } else if ($row['JoinGroup']['status'] == "Rejected") { ?>
                                            <input type="submit" class="buttonclass" name="button_value" value="Accept">
                                        <?php } else { ?>
                                            <input type="submit" class="buttonclass" name="button_value" value="Accept">
                                            <input type="submit" class="buttonclass" name="button_value" value="Reject">
                                        <?php } ?>    
                                    </form>
                                </td> 
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </td>
            <td align="left" width="40%" class="userprofiletd" style='padding:5px 10px 5px 10px'>
                <form name="updateGroupProfile" enctype="multipart/form-data" action="updateGroupProfile" method="post">
                    <input type="hidden" name="group_id" value="<?php echo $groupInfo['CreateGroup']['group_id']; ?>">
                    <input type="text" name="image" style="height: 100px;width: 85px"><br>
                    <input type="file" name="profile_image"><br>
                    <label>Group Name:</label><br><input type="text" class="textbox" name="group_name" value="<?php echo $groupInfo['CreateGroup']['group_name']; ?>" id="group_name" /><br>
                    <label>Group Code :</label><br><input type="text" class="textbox" name="group_code" value="<?php echo $groupInfo['CreateGroup']['group_code']; ?>" id="group_code" /><br>
                    <label>Group Type:</label><br>
                    <select name="group_type" class="textbox">
                        <option><?php echo $groupInfo['CreateGroup']['group_type']; ?> </option>
                        <option value="">Select Group Type</option>
                            <?php foreach ($groupTypes as $row): ?>
                            <option value ="<?php echo $row['SelectGroupType']['type']; ?>">
                            <?php echo $row['SelectGroupType']['type']; ?>
                            </option>
<?php endforeach; ?>
                    </select><br>
                    <label>Email Id:</label><br><input type="email" class="textbox" name="group_admin_email" id="email_id" value="<?php echo $groupInfo['CreateGroup']['group_admin_email']; ?>" required/><br>
                    <label>Contact No:</label><br><input type="tel" class="textbox" name="contact_no" id="contact_no" value="<?php echo $groupInfo['CreateGroup']['contact_no']; ?>" /><br>
                    <label>Address :</label><br><textarea name="address" class="textbox" placeholder="Address" style="height:100px;"><?php echo $groupInfo['CreateGroup']['address']; ?></textarea><br>
                    <label>Country</label><label style="margin-left: 26%">State</label><br>
                    <select name="country" class="textbox" style="height :35%; width: 40%">
                        <?php
                        if (!empty($groupInfo['CreateGroup']['country'])) {
                            echo '<option>';
                            echo $groupInfo['CreateGroup']['country'];
                            echo '</option>';
                        }
                        ?>
                        <option>Select Country</option><option>India</option><option>USA</option><option>Other</option></select>
                    <select name="state" class="textbox" style="height :35%; width: 40%">
                        <?php
                        if (!empty($groupInfo['CreateGroup']['state'])) {
                            echo '<option>';
                            echo $groupInfo['CreateGroup']['state'];
                            echo '</option>';
                        }
                        ?>
                        <option>Select State</option><option>Maharashtra</option><option>Gujrat</option><option>Other</option></select><br>
                    <label>City</label><label style="margin-left: 33%">Pin Code</label><br>
                    <select name="city" class="textbox" style="height :35%; width: 40%">
                        <?php
                        if (!empty($groupInfo['CreateGroup']['city'])) {
                            echo '<option>';
                            echo $groupInfo['CreateGroup']['city'];
                            echo '</option>';
                        }
                        ?>
                        <option>Select City</option><option>Pune</option><option>Mumbai</option><option>Other</option></select>
                    <input type="text" class="textbox" name="pincode" id="pincode" value="<?php echo $groupInfo['CreateGroup']['pincode']; ?>" placeholder="pin code" style="height :30%; width: 40%"><br><br>
                    <input type="submit" class="buttonclass" value="Update">
                </form>




            </td>
            <td align="center" width="35%" class="userprofiletd" style='padding:5px 10px 5px 10px'>
                <div style="margin-left: 30%"><a style="color: #068097" class="button" href="../Admin/change_password">change password</a></div><br>
                <div align="center">
                    <form name="deleteGroup" action="deleteGroup" method="post">
                        <input class="myButton" type="submit" value="Delete Group" onclick="return confirm('Are you sure you want to delete this group?')">
                    </form>
                </div>
                <h4 align="center">Add Category</h4>
                <div>
                    <table class="TFtable">
                        <tr>
                            <td>
                                <form name="addCategory" action="addCategory" method="post">
                                    <label>Category</label><br>
                                    <input type="text" class="textbox" name="category_name" id="category" style="height:20px; width:200px " required/>
                                    <input type="submit" class="buttonclass" value="Add">
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>

                <div>
                    <table class="TFtable">
                        <tr style="background-color: lightslategray;color:white;">
                            <th align="left">Category</th>
                            <th align="left">Edit</th>
                            <th align="left">Delete</th>
                        </tr>
                        <?php
                        if (!empty($groupCateoriesList)) {
                            foreach ($groupCateoriesList AS $arr => $value):
                                ?>
                                <tr>
                                    <th>
                                        <?php echo $value; ?>
                                    </th>
                                    <th>

                                <form name="" action="" method="post">
                                    <input type="hidden" name="category_id" value="<?php echo $arr; ?>" />
                                    <input type="image" class="image" src="../app/webroot/img/edit.png" alt="Submit" height="20" width="20">

                                </form>
                                </th>
                                <th>
                                <form name="deleteCategory" action="deleteCategory" method="post">
                                    <input type="hidden" name="category_id" value="<?php echo $arr; ?>" />
                                    <input type="image" src="../app/webroot/img/delete.png" alt="Submit" height="20" width="20" onclick="return confirm('Are you sure you want to delete this category?')">
                                </form>

                                </th>
                                </tr>
                                <?php
                            endforeach;
                        }
                        ?>
                    </table>
                </div>
                <h4 align="center">Create Campaign</h4>
                <div>
                    <table class="TFtable">
                        <tr>
                            <td>
                                <form name="createCampaign" action="createCampaign" method="post">
                                    <label>Campaign Name</label>
                                    <input type="text" class="textbox" name="campaign_name" id="campaign" style="height:20px; width:99%" required />
                                    <label>Start Date</label><label style="margin-left: 32%">End Date</label><br>
                                    <input name="start_date" class="textbox" type="datetime-local" style="height :30%; width: 45%" required />
                                    <input name="end_date" class="textbox" type="datetime-local" style="height :30%; width: 45%" required /><br>
                                    <input type="submit" class="buttonclass" value="Create">
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
                <div>
                    <table  class="TFtable">
                        <tr style="background-color: lightslategray;color:white;">
                            <th>Campaign Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>

                        </tr>
                                <?php foreach ($groupCampaignsList as $row): ?>
                            <tr>
                                <th>
                                    <?php echo $row['Campaign']['campaign_name']; ?>
                                </th>
                                <th>
                                    <?php echo $row['Campaign']['start_date']; ?>
                                </th>
                                <th>
                                    <?php echo $row['Campaign']['end_date']; ?>
                                </th>
                                <th>
    <?php echo $row['Campaign']['status']; ?>
                                </th>
                                <th>
                            <form name="edit_campaign" action="edit_campaign" method="post">
                                <input type="hidden" name="campaign_id" value="<?php echo $row['Campaign']['campaign_id']; ?>" />
                                <input type="image" src="../app/webroot/img/edit.png" alt="Submit" height="20" width="20">
                            </form>
                            <form name="deleteCampaign" action="deleteCampaign" method="post">
                                <input type="hidden" name="campaign_id" value="<?php echo $row['Campaign']['campaign_id']; ?>" />
                                <input type="image" src="../app/webroot/img/delete.png" alt="Submit" height="20" width="20" onclick="return confirm('Are you sure you want to delete this campaign?')">
                            </form>
                            </th>
                            </tr>
<?php endforeach; ?>
                    </table>
                </div>
            </td>
        </tr>
        <table>
            <footer>
<?php echo $this->element('../Pages/footer1'); ?>
            </footer>
            </body>
            </html
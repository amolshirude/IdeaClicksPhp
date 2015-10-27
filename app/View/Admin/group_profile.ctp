<!DOCTYPE html>
<html>
    <head>
        <style>
            #header {
                background-color: #0a0;
                color:white;
                text-align:center;
                padding:3px;
            }
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

        </style>

        <title>Group Profile</title>
    </head>
    <body>
        <div id="header">
            <h3>View Profile</h3>
        </div>
        <table width="100%" border="1">
            <tr valign="top">
                <td bgcolor="#aaa" align="center" width="20%">
                    <div>
                        <table>
                            <tr>
                                <td>
                                    <label>Total Ideas:</label>100<br>
                                    <label>Mobile :</label>10<br>
                                    <label>Healthcare:</label>20<br>  
                                </td>
                            </tr>
                        </table> 
                    </div>
                </td>
                <td bgcolor="#b5dcb3" height="220" width="40%">
                    <div>
                        <table align="left">
                            <tr>
                                <td>
                                    <form name="editGroupProfile" action="editGroupProfile" method="post">
                                        <label>Group Name:</label><br><input type="text" name="group_name" value="" id="group_name" style=" height:20px; width:200px "/><br>
                                        <label>Group Code :</label><br><input type="text" name="group_code" value="" id="group_code" style=" height:20px; width:200px"/><br>
                                        <label>Group Type:</label><?php echo $this->Form->input('GroupListWithCode', array('options' => $groupListWithCode, 'label' => false, 'empty' => '-- Select Type--', 'id' => 'group_type', 'name' => 'group_type', 'style' => 'height:25px; width:200px')); ?>
                                        <label>Email Id:</label><br><input type="email" name="group_admin_email" id="email_id" style="height:20px; width:200px" required/><br>
                                        <label>Contact No:</label><br><input type="tel" name="contact_no" id="contact_no" style="height:20px; width:200px" required/><br>
                                        <label>Address :</label><br><input type="text" name="contact_no" id="address" style="height:100px; width:200px"><br>
                                        <label>Country</label><label style="margin-left: 60px">State</label><br>
                                        <select style="height :35%; width: 40%"><option>Select</option><option>India</option><option>USA</option></select>
                                        <select style="height :35%; width: 40%"><option>Select</option><option>Maharashtra</option><option>Gujrat</option></select><br>
                                        <label>City</label><label style="margin-left: 32%">Pin Code</label><br>
                                        <select style="height :35%; width: 40%"><option>Select</option><option>Pune</option><option>Mumbai</option></select>
                                        <input type="text" name="pincode" id="pincode" placeholder="pin code" style="height :30%; width: 40%"><br><br>
                                        <input type="submit" style="height:25px; width:60px; background-color: #0a0" value="Save">
                                    </form>
                                </td> 

                            </tr>

                        </table> 
                    </div>
                </td>
                <td bgcolor="#aaa" width="40%">
                    <div align="center">
                        <form name="deleteGroup" action="deleteGroup" method="post">
                            <input type="hidden" name="group_id" value="<?php echo $group_id; ?>" />
                            <input type="submit" style="height: 50px;width: 100px; background-color: #0a0" value="Delete Group">
                        </form>
                    </div>
                    <h4 align="center">Add Category</h4>
                    <div>
                        <table class="tableborder">
                            <tr>
                                <td>
                                    <form name="addCategory" action="addCategory" method="post">
                                        <label>Category</label><br>
                                        <input type="text" name="category_name" id="category" style="height:20px; width:200px "/>
                                        <input type="submit" style="height:25px; width:60px; background-color: #0a0" value="Add">
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div>
                        <table  border="1" class="tableborder">
                            <?php foreach ($groupCateoriesList AS $arr => $value): ?>
                                <tr>
                                    <th>
                                        <?php echo $value; ?>
                                    </th>
                                    <th>
                                <form name="" action="" method="post">
                                    <input type="hidden" name="category_id" value="<?php echo $arr; ?>" />
                                    <input type="submit" style="height:25px; width:60px; margin-left:20px; background-color: #0a0" value="Edit">
                                </form>
                                <form name="deleteCategory" action="deleteCategory" method="post">
                                    <input type="hidden" name="category_id" value="<?php echo $arr; ?>" />
                                    <input type="submit" style="height:25px; width:60px; margin-left:20px; background-color: #0a0" value="Delete" onclick="return confirm('Are you sure you want to delete this category?')">
                                </form>
                                </th>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <h4 align="center">Create Campaign</h4>
                    <div>
                        <table class="tableborder">
                            <tr>
                                <td>
                                    <form name="createCampaign" action="createCampaign" method="post">
                                        <label>Campaign Name</label>
                                        <input type="text" name="campaign_name" id="campaign" style="height:20px; width:99%"/>
                                        <label>Start Date</label><label style="margin-left: 32%">End Date</label><br>
                                        <input name="start_date" type="datetime-local" style="height :30%; width: 45%">
                                        <input name="end_date" type="datetime-local" style="height :30%; width: 45%"><br>
                                        <input type="submit" style="height:25px; width:60px; background-color: #0a0" value="Create">
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table  border="1" class="tableborder">
                            <tr>
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
                                <form name="" action="" method="post">
                                    <input type="hidden" name="campaign_id" value="<?php echo $row['Campaign']['campaign_id']; ?>" />
                                    <input type="submit" style="height:25px; width:60px; margin-left:20px; background-color: #0a0" value="Edit">
                                </form>
                                <form name="deleteCampaign" action="deleteCampaign" method="post">
                                    <input type="hidden" name="campaign_id" value="<?php echo $row['Campaign']['campaign_id']; ?>" />
                                    <input type="submit" style="height:25px; width:60px; margin-left:20px; background-color: #0a0" value="Delete" onclick="return confirm('Are you sure you want to delete this campaign?')">
                                </form>
                                </th>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </td>
            </tr>
            <table>
                </body>
                </html
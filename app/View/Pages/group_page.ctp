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
        <?php echo $this->element('../Pages/header1'); ?>
    </header>
    <table class="TFtable">
        <tr valign="top">
            <td width="25%" style='padding:5px 10px 5px 10px'>
                <div>
                    <table>
                        <tr>
                            <td>
                                <label>Total Ideas : </label><?php echo $TotalIdeas; ?><br>
                                <label>Group Categories : </label><br>
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
            </td>
            <td width="40%">
                <div>
                    <table class="TFtable">
                        <tr >
                            <td style='padding:5px 10px 5px 10px'>

                                <input type="hidden" name="group_id" value="<?php echo $groupInfo['CreateGroup']['group_id']; ?>">
                                <label>Group Name:</label><?php echo $groupInfo['CreateGroup']['group_name']; ?><br>
                                <label>Group Code :</label><?php echo $groupInfo['CreateGroup']['group_code']; ?><br>
                                <label>Group Type:</label><?php echo $groupInfo['CreateGroup']['group_type']; ?><br>
                                <label>Email Id:</label><?php echo $groupInfo['CreateGroup']['group_admin_email']; ?><br>
                                <label>Contact No:</label><?php echo $groupInfo['CreateGroup']['contact_no']; ?><br>
                                <label>Address :</label><?php echo $groupInfo['CreateGroup']['address']; ?><br>
                                <label>Country :</label><?php
                                if (!empty($groupInfo['CreateGroup']['country'])) {
                                    echo '<option>';
                                    echo $groupInfo['CreateGroup']['country'];
                                    echo '</option>';
                                }
                                ?><br>
                                <label>State :</label><?php
                                if (!empty($groupInfo['CreateGroup']['state'])) {
                                    echo '<option>';
                                    echo $groupInfo['CreateGroup']['state'];
                                    echo '</option>';
                                }
                                ?><br>


                                <label>City :</label><?php
                                if (!empty($groupInfo['CreateGroup']['city'])) {
                                    echo '<option>';
                                    echo $groupInfo['CreateGroup']['city'];
                                    echo '</option>';
                                }
                                ?><br>
                                <label>Pin Code :</label><?php echo $groupInfo['CreateGroup']['pincode']; ?><br>
                            </td> 
                        </tr>
                    </table> 
                </div>
            </td>
            <td width="40%" style='padding:5px 10px 5px 10px'>
                <table class="TFtable">
                    <tr style="background-color: lightslategray;color:white;">
                        <th align="left">Campaign Name</th>
                        <th align="left">Start Date</th>
                        <th align="left">End Date</th>
                        <th align="left">Status</th>

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
                            </th>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </td>
        </tr>
    </table>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <footer>
        <?php echo $this->element('../Pages/footer1'); ?>
    </footer>
</body>
</html>
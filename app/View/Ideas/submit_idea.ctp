<?php echo $this->element('../Pages/init'); ?>
<script src="jquery.js"></script> 
<script> 
    $(function(){
        $("#includedContent").load("footer.ctp"); 
    });
</script> 
<title>Submit Idea</title>
</head>
<body>
    <header>
        <h3>Submit Idea</h3>
        <?php echo $this->element('../Pages/header1'); ?>
    </header>
    <table width="100%" border="1">
        <tr valign="top">
            <td bgcolor="#9BDBDE">
                <div align="left">

                    <form name="sibmitIdea" action="submitIdea" method="post">
                        <div class="box" style="margin-left: auto; margin-right: auto;">
                            <label>Idea Title</label><b style="color: red;">*</b>:<br>
                            <input type="text" class="textbox" name="idea_title" placeholder="Idea Title" style="height: 25px;width: 40%"required/><br>
                        </div><br>
                        <div class="box" style="margin-left: auto; margin-right: auto;">
                            <label>Idea Description</label><b style="color: red;">*</b>:<br>
                            <textarea class="textbox" placeholder="Idea Description" style="height: 150px;width: 40%" name="idea_description" required></textarea><br>
                        </div><br>
                        <div class="box" style="margin-left: auto; margin-right: auto;">
                            <label>Idea Category</label><b style="color: red;">*</b>:<br>
                            <select name="idea_category" class="textbox" style="height: 25px;width: 40%" required>
                                <option value="">Select Category</option>
                                <?php foreach ($groupCategoriesList as $row): ?>
                                    <option value ="<?php echo $row['Category']['category_name']; ?>">
                                        <?php echo $row['Category']['category_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div><br>
                        <div class="box" style="margin-left: auto; margin-right: auto;">
                            <label>Select Group</label><b style="color: red;">*</b>:<br>
                            <select name="group_name" class="textbox" style="height: 25px;width: 40%" required>
                                <option value="">Select Group</option>
                                <?php foreach ($userJoinedGroupList as $row): ?>
                                    <option value ="<?php echo $row['JoinGroup']['group_name']; ?>">
                                        <?php echo $row['JoinGroup']['group_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div><br>
                        <div class="button" style="margin-left: auto; margin-right: auto;">
                            <input type="checkbox" name="idea_status" value="private">Confidential
                        </div><br>
                        <div class="button" style="margin-left: auto; margin-right: auto;">
                            <input class="buttonclass" type="submit" value="Save">
                        </div>
                    </form>
                </div></td></table>
    <footer>
        <?php echo $this->element('../Pages/footer1'); ?>
    </footer>
</body>
</html>

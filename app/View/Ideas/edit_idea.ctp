<?php echo $this->element('../Pages/init'); ?>
        <script type="text/javascript">
            function check() {
                if("<?php echo $Idea['IdeaModel']['idea_status']; ?>" == "private"){
                    document.getElementById("idea_status").checked = true;}
            }
        </script>
        <title>update Idea</title>
    </head>
    <body onload="check()">
        <header>
            <h3>Update Your Idea</h3>
            <?php echo $this->element('../Pages/header1'); ?>
        </header>
        <table width="100%" border="1">
            <tr valign="top">
                <td bgcolor="#9BDBDE">
                    <div align="left">
                        <form name="updateIdea" action="updateIdea" method="post">
                            <input type="hidden" name="idea_id" value="<?php echo $Idea['IdeaModel']['idea_id']; ?>"/>
                            <div class="box" style="margin-left: auto; margin-right: auto;">
                                <label>Title</label><b style="color: red;">*</b>:<br><input type="text" name="idea_title" placeholder="Idea Title" value="<?php echo $Idea['IdeaModel']['idea_title']; ?>" style="height: 25px;width: 40%"required/><br>
                            </div><br>
                            <div class="box" style="margin-left: auto; margin-right: auto;">
                                <label>Description</label><b style="color: red;">*</b>:<br><textarea placeholder="Idea Description" style="height: 150px;width: 40%" name="idea_description" required><?php echo $Idea['IdeaModel']['idea_description']; ?></textarea><br>
                            </div><br>
                            <div class="box" style="margin-left: auto; margin-right: auto;">
                                <label>Category</label><b style="color: red;">*</b>:<br>
                                <select name="idea_category" style="height: 25px;width: 40%" required>
                                    <option value="<?php echo $Idea['IdeaModel']['idea_category']; ?>"><?php echo $Idea['IdeaModel']['idea_category']; ?></option>
                                    <?php foreach ($groupCategoriesList as $row): ?>
                                        <option value ="<?php echo $row['Category']['category_name']; ?>">
                                            <?php echo $row['Category']['category_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div><br>
                            <div class="box" style="margin-left: auto; margin-right: auto;">
                                <label>Select Group</label><b style="color: red;">*</b>:<br>
                                <select name="group_name" style="height: 25px;width: 40%" required>
                                    <option value="<?php echo $Idea['IdeaModel']['group_name']; ?>"><?php echo $Idea['IdeaModel']['group_name']; ?></option>
                                    <?php foreach ($userJoinedGroupList as $row): ?>
                                        <option value ="<?php echo $row['JoinGroup']['group_name']; ?>">
                                            <?php echo $row['JoinGroup']['group_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div><br>
                            <div class="button" style="margin-left: auto; margin-right: auto;">

                                <input type="checkbox" name="idea_status" id="idea_status" value="private">Confidential
                            </div><br>
                            <div style="margin-left: auto; margin-right: auto;">
                                <input type="submit" class="buttonclass" value="Update">
                            </div><br>
                        </form>
                    </div></td></table>
        
        <footer>
            <?php echo $this->element('../Pages/footer1'); ?>
        </footer>
    </body>
</html>

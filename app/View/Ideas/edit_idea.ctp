<html>
    <head>
        <style type="text/css">
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
            .box {
                font-size: 15px;
                font-family: 'Titillium Web', sans-serif;
                color :#000000;
            }
            button{
                background-color: #025776;
                color: #FFFFFF;
                height: 30px;
                font-weight: bold;
            }
        </style>
        <title>update Idea</title>
    </head>
    <body>
        <header>
            <h3>Update Your Idea</h3>
             <?php echo $this->element('../Pages/header1'); ?>
        </header><br>
        <table width="100%" border="1">
            <tr valign="top">
                <td bgcolor="#b5dcb3" >
                    <div align="left">
            <form name="updateIdea" action="updateIdea" method="post">
                <input type="hidden" name="idea_id" value="<?php echo $Idea['IdeaModel']['idea_id']; ?>"/>
                <div class="box" style="margin-left: auto; margin-right: auto;">
                    <label>Title</label><b style="color: red;">*</b>:<br><input type="text" name="idea_title" placeholder="Idea Title" value="<?php echo $Idea['IdeaModel']['idea_title']; ?>" style="height: 5%;width: 40%"required/><br>
                </div><br>
                <div class="box" style="margin-left: auto; margin-right: auto;">
                    <label>Description</label><b style="color: red;">*</b>:<br><input type="textarea" placeholder="Idea Description" value="<?php echo $Idea['IdeaModel']['idea_description']; ?>" style="height: 150px;width: 40%" name="idea_description" required/><br>
                </div><br>
                <div class="box" style="margin-left: auto; margin-right: auto;">
                    <label>Category</label><b style="color: red;">*</b>:<br>
                    <select name="idea_category" style="height: 5%;width: 40%" required>
                        <option value="<?php echo $Idea['IdeaModel']['idea_category']; ?>"><?php echo $Idea['IdeaModel']['idea_category']; ?></option>
                        <option value="">Select category</option>
                        <?php foreach ($groupCategoriesList as $row): ?>
                            <option value ="<?php echo $row['Category']['category_name']; ?>">
                                <?php echo $row['Category']['category_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div><br>
                <div class="button" style="margin-left: auto; margin-right: auto;">
                    <input type="checkbox" name="idea_status" value="private">Confidential
                </div><br>
                <div class="button" style="margin-left: auto; margin-right: auto;">
                    <input type="submit" value="Update">
                    <input type="reset" value="Reset">
                </div><br>
            </form>
        </div></td></table>
        <br><br>
        <footer>
            <?php echo $this->element('../Pages/footer1'); ?>
        </footer>
    </body>
</html>

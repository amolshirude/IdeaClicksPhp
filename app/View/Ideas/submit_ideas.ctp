<html>
    <head>
        <style type="text/css">
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
        <title>Submit Ideas</title>
    </head>
    <body>
        <div>
            <form name="sibmit_idea" action="submit_idea" method="post">
                <div class="box" style="margin-left: auto; margin-right: auto;">
                <label>Title</label><b style="color: red;">*</b>:<br><input type="text" name="ideas_title" placeholder="Ideas Title" required="required"/><br>
                </div><br>
                <div class="box" style="margin-left: auto; margin-right: auto;">
                <label>Description</label><b style="color: red;">*</b>:<br><input type="textarea" placeholder="Ideas Description" style="height: 25%; width:17% " name="ideas_description" required="required"/><br>
                </div><br>
                <div class="box" style="margin-left: auto; margin-right: auto;">
                <label>Category</label><b style="color: red;">*</b>:<br>
                <select name="ideas_category" style="width: 17%">
                    <option value="">Select category</option>
                 <?php foreach ($groupCategoriesList as $row): ?>
                    <option value ="<?php echo $row['Category']['category_name']; ?>">
                    <?php echo $row['Category']['category_name']; ?>
                    </option>
                 <?php endforeach; ?>
                </select>
                </div><br>
                 <div class="button" style="margin-left: auto; margin-right: auto;">
                     <input type="checkbox" name="ideas_status" value="private">Confidential
                 </div><br>
                <div class="button" style="margin-left: auto; margin-right: auto;">
                <input type="submit" value="Save">
                <input type="reset" value="Reset">
                </div><br>
            </form>
        </div>
    </body>
</html>

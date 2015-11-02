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
        </header><br>
        <table width="100%" border="1">
            <tr valign="top">
                <td bgcolor="#b5dcb3" >
                    <div align="left">

                        <form name="sibmitIdea" action="submitIdea" method="post">
                            <div class="box" style="margin-left: auto; margin-right: auto;">
                                <label>Idea Title</label><b style="color: red;">*</b>:<br><input type="text" name="idea_title" placeholder="Idea Title" style="height: 25px;width: 40%"required/><br>
                            </div><br>
                            <div class="box" style="margin-left: auto; margin-right: auto;">
                                <label>Idea Description</label><b style="color: red;">*</b>:<br>
                                <textarea placeholder="Idea Description" style="height: 150px;width: 40%" name="idea_description" required></textarea><br>
                            </div><br>
                            <div class="box" style="margin-left: auto; margin-right: auto;">
                                <label>Idea Category</label><b style="color: red;">*</b>:<br>
                                <select name="idea_category" style="height: 25px;width: 40%" required>
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
                                <input type="submit" value="Save">
                            </div><br>
                        </form>
                    </div></td></tr></table>
        <br><br>
        <footer>
            <?php echo $this->element('../Pages/footer1'); ?>
        </footer>
        
    </body>
</html>

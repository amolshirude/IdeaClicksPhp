<html>
  <head>
        <title>View Ideas</title>
        <style type="text/css">
            .box {
                font-size: 15px;
                font-family: 'Titillium Web', sans-serif;
                color :#000000;
            }
            .view-idea-container {
                width: 70%;
                float: left;
                display: inline-block;
                clear: both;
                height: auto;
                font-weight: bold;
                /*overflow-y: scroll;
                    height: 600px;*/
            }

            .idea-container {
                border: solid;
                border-width: 2px;
                border-color: #0094BC;
                border-radius: 10px;
                padding: 10px;
            }

            .idea-container a.idea-tile {
                font-size: 24px;
                color: #005777;
                font-weight: bold;
                cursor: pointer;
                overflow: hidden;
                word-break: break-word;
                /*text-decoration: none;*/
            }

            .idea-container .idea-description {
                font-size: 18px;
                color: #1182FA;
                margin-top: 10px;
                height: 70px;
                overflow: hidden;
                word-break: break-word;
                background-color: #FFFFFF;
                border: none;
            }

            .idea-container .idea-details-container .category {
                background-color: #CBCBCB;
                color: #FFFFFF;
                padding: 3px;
            }

            .idea-container .idea-details-container .submit-by {
                color: #0094BC;
            }

            .categories-container {
                display: inline-block;
                /*margin-left: 30px;*/
                width: 200px;
                /*margin-top: 60px;*/
                height: auto;
                background-color: #e6e6e6;
                padding-left: 30px;
                padding-bottom: 20px;
                border-radius: 10px;
            }

            .categories-container .category a {
                cursor: pointer;
                text-decoration: none;
                font-size: 16px;
            }

            .categories-container .category {
                margin-top: 10px;
            }

            .search-container {
                padding-left: 40px;
            }

            .search-container input[type="text"].search-idea {
                width: 75%;
                margin-bottom: 0px;
                border-radius: 0px 10px 0px 10px;
            }

            .show-idea-container {
                border: solid;
                border-width: 2px;
                border-color: #0094bc;
                border-radius: 10px;
                padding: 10px;
                height: auto;
                font-weight: bold;
            }

            .show-idea-container .show-idea-description {
                font-size: 18px;
                color: #1182FA;
                margin-top: 10px;
                height: auto;
            }

            .show-idea-container .show-idea-category {
                background-color: #CBCBCB;
                color: #FFFFFF;
                padding: 3px;
            }

            .show-idea-container .show-idea-author {
                color: #0094BC;
            }

            .show-ide-title {
                font-size: 24px;
                color: #005777;
                font-weight: bold;
            }
            .right-container{
                float: right;
            }
        </style>
    </head>
<body>
  <div class="box" style="margin-left: auto; margin-right: auto;">
		
			<div class="view-idea-container">
		        	 
					<div class="idea-container">
                                                <label>Title:</label>
						<span class="idea-description"> <?php echo $Idea['IdeasModel']['ideas_title']; ?></span> <br>
						<label>Description:</label>
                                                <pre class="idea-description"><?php echo $Idea['IdeasModel']['ideas_description']; ?></pre>
						<br>
						<div class="idea-details-container">
							<label>Category:</label>
							<span class="category"> <?php echo $Idea['IdeasModel']['ideas_category']; ?> </span> <br>
                                                        <label>submitted by:</label>
							<span class="submit-by"></span>
                                                </div><br>	
                                                <div>
                                                    <form name="edit_idea" action="edit_idea" method="post">
                                                        <input type="hidden" name="ideas_id" value="<?php echo $Idea['IdeasModel']['ideas_id']; ?>" /> 
                                                        <input type="submit" value="Edit">
                                                    </form>
                                                    <form name="deleteIdea" action="deleteIdea" method="post">
                                                        <input type="hidden" name="ideas_id" value="<?php echo $Idea['IdeasModel']['ideas_id']; ?>" />
                                                        <input type="submit" value="Delete">
                                                    </form>
                                               </div>
                                        </div>
                   </div>
	</div>
	<!-- end of main -->   

</body>

</html>
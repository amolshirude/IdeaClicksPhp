<?php echo $this->element('../Pages/init'); ?>
        <title>View Ideas</title>
      </head>
    <body>
        <header>
            <h3>view Idea</h3>
            <?php echo $this->element('../Pages/admin_header'); ?>
        </header><br>
        <div class="box" style="margin-left: auto; margin-right: auto;">
		
			<div class="view-idea-container">
                            
		        	 <?php if(!empty($allIdeas)) { foreach ($allIdeas as $row): ?>
					<div class="idea-container">
                                                <label>Title:</label>
						<a class="idea-tile" value="<?php echo $row['IdeaModel']['idea_id']; ?>" href="like_dislike_comment"><?php echo $row['IdeaModel']['idea_title']; ?></a> <br>
						<label>Description:</label>
                                                <pre class="idea-description"><?php echo $row['IdeaModel']['idea_description']; ?></pre>
						<br>
						<div class="idea-details-container">
							<label>Category:</label>
							<span class="category"> <?php echo $row['IdeaModel']['idea_category']; ?> </span> <br>
                                                        <label>submitted by:</label>
							<span class="submit-by"><?php echo $row['IdeaModel']['submitted_by']; ?></span><br>
                                                        <label>Group Name:</label>
                                                        <span class="submit-by"><?php echo $row['IdeaModel']['group_name']; ?></span>
                                                </div>	
					</div>
					<br>
				<?php endforeach; }else{echo 'No Ideas';}?>
			</div>
                    <div class="right-container">
                    <div class="search-container">
                        <input type="search" name="searchIdeas" class="search-idea"/>
                        <input type="button" value="Search">
                    </div>
                    </div><br><br>
			<div class="right-container">
			
				<div class="box">
					<b>Categories</b>
				</div>
				<div class="categories-container">
                                    <a href="../Admin/view_ideas">View all Ideas</a><br>
					 <?php foreach ($groupCategoriesList as $row): ?>
						<a class="category" href="../Admin/filter_ideas?category=<?php echo $row['Category']['category_name'];?>"><?php echo $row['Category']['category_name']; ?></a>
						<br>
                                         <?php endforeach; ?>
				</div>
			</div>
		
	</div>
	<!-- end of main -->
    </body>
</html>
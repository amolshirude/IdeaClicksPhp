<?php echo $this->element('../Pages/init'); ?>
<title>Like, Dislike, comment on Idea</title>    
</head>
<body>
    <header>
        <h3>view Idea</h3>
        <?php echo $this->element('../Pages/header1'); ?>
    </header><br>
    <div class="box" style="margin-left: auto; margin-right: auto;">

        <div class="view-idea-container">

            <div class="idea-container">
                <input type="hidden" name="idea_id" id="idea_id" value="<?php echo $Idea['IdeaModel']['idea_id']; ?>">
                <label>Title:</label>
                <span class="idea-description"> <?php echo $Idea['IdeaModel']['idea_title']; ?></span> <br>
                <label>Description:</label><br>
                <pre class="idea-description"><?php echo $Idea['IdeaModel']['idea_description']; ?></pre>
                <br>
                <div class="idea-details-container">
                    <label>Category:</label>
                    <span class="category"> <?php echo $Idea['IdeaModel']['idea_category']; ?> </span> <br>
                    <label>submitted by:</label>
                    <span class="submit-by"><?php echo $Idea['IdeaModel']['submitted_by']; ?></span> <br>
                    <label>Group Name:</label>
                    <span class="submit-by"><?php echo $Idea['IdeaModel']['group_name']; ?></span>
                </div><br>	
                <?php if ($session_email == $Idea['IdeaModel']['submitted_by']) { ?>
                    <div>
                        <form name="edit_idea" action="edit_idea" method="post">
                            <input type="hidden" name="idea_id" value="<?php echo $Idea['IdeaModel']['idea_id']; ?>" /> 
                            <input type="submit" class="buttonclass" value="Edit">
                            <input type="button" class="buttonclass" value="Back" onClick="history.go(-1);return true;">
                        </form>
                    </div>
                    <?php
                } else {
                    echo '<input type="button" class="buttonclass" value="Back" onClick="history.go(-1);return true;"><br><br>';
                }
                ?> 
                <div id="like_dislike">
                    <img id="like" src="../app/webroot/img/thumbs-up.png"/>
                    <input type="hidden" name="like_count" id="like_count" value="<?php echo $likes; ?>">
                    <?php echo $likes; ?>
                    <img id="dislike" src="../app/webroot/img/thumbs-down.png"/>
                    <input type="hidden" name="dislike_count" id="dislike_count" value="<?php echo $dislikes; ?>">
                    <?php echo $dislikes; ?>
                </div>
                <button type="button" class="i-comment" value="Comment">Comment</button>
                <div id="comment" class="box comment-container" style="margin-left: auto; margin-right: auto;display:none">
                    <input type="hidden" value="idea" id="comment_id" class="comment-id"/>
                    <input type="hidden" name="idea_id" value="<?php echo $Idea['IdeaModel']['idea_id']; ?>" />
                    <textarea class="comment-box" id="commentsText" name="commentsText"
                              title="Submit Your comment"
                              style="width: 95%; height: 50px;"></textarea>

                    <button class="submitComment" id="commentsubmit"name="submit" value="submit" style="width:100px" >Submit</button>	
                </div>
            </div>

            <div>
                <?php foreach ($comments as $row): ?>
                    <?php echo $row['CommentModel']['comment_text']; ?><br>
                <?php endforeach; ?> 
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br>
    <footer>
        <?php echo $this->element('../Pages/footer1'); ?>
    </footer>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        $('.i-comment').click(function(){
            var p1 = $(this).parent().get(0);
            $(p1).parent().find('.comment-container').eq(0).show();
            $(this).hide();
        });
        $( ".submitComment" ).click(function() 
        { 
            //            var data = {commentText: $(this).closest('.comment-container').find('.comment-box').eq(0).val()},
            //            commentId=$(this).closest('.comment-container').find('.comment-id').eq(0).val();
            //            data.commentId=-1;
            var commentId = $(this).closest('.comment-container').find('.comment-id').eq(0).val();
            var comment_text = $('#commentsText').val();
            var idea_id = $('#idea_id').val();    
            //            if(commentId!="idea"){
            //                data.commentId = commentId;
            //            }
            
                    
            jQuery.post('saveComment', {ideaId:idea_id ,commentText: comment_text,commentId:commentId}, function(data) {
                // $("#comment").html(data);
            });
            //$(this).disable();
            //                    $.ajax({ 
            //                        url: "${saveComment}" , 
            //                        type: 'POST', 
            //                        datatype:'json', 
            //                        data: data, 
            //                        success: function(data){ 
            //                            console.log('success:save comment');	
            //                        } 
            //                    }); 
        });
    });
</script>
<script>
    $(document).ready(function () {
        
        $("#like").click(function () {
            
            var idea_id = $('#idea_id').val();
            var like_count = $('#like_count').val();
            jQuery.post('like_idea', {ideaId: idea_id, likeCount: like_count}, function(data) {
                $('#like_dislike').html(data); 
            });
        });  
        
        $("#dislike").click(function () {
            var idea_id = $('#idea_id').val();
            var dislike_count = $('#dislike_count').val();
            jQuery.post('dislike_idea', {ideaId: idea_id, dislikeCount: dislike_count}, function(data) {
                $('#like_dislike').html(data);

            });
        }); 
    });
</script> 
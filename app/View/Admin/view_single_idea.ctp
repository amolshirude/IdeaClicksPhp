<?php echo $this->element('../Pages/init'); ?>
    <head>
        <title>View Ideas</title>
    </head>
    <body>
        <header>
            <h3>view Idea</h3>
            <?php echo $this->element('../Pages/admin_header'); ?>
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
                    <div>          
                        <form name="deleteIdea" action="deleteIdea" method="post">
                            <input type="hidden" name="idea_id" value="<?php echo $Idea['IdeaModel']['idea_id']; ?>" />
                            <input class="buttonclass" type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this idea?')">
                            <input type="button" class="buttonclass" value="Back" onClick="history.go(-1);return true;">
                        </form>
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
                //$('#likes').html(data);    
                
            });
        });  
        
        $("#dislike").click(function () {
            var idea_id = $('#idea_id').val();
            var dislike_count = $('#dislike_count').val();
            jQuery.post('dislike_idea', {ideaId: idea_id, dislikeCount: dislike_count}, function(data) {
                //$('#dislikes').html(data);
               
            });
        }); 
    });
</script> 
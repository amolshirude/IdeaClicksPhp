<?php
//echo $this->Html->meta('icon');
//echo $this->fetch('meta');
//echo $this->fetch('css');
//echo $this->fetch('script');
echo $this->Html->script('jquery-1.7.2');
//echo $this->Html->script('jquery.min');
//echo $this->Html->css('style');
//echo $this->Html->css('style_menu');
//echo $this->Html->script('common');
//echo $this->Html->script('datetimepicker_css');
//echo $this->Html->script('https://www.google.com/jsapi');
//echo $this->Session->flash();
?>
<html>
    <head>
        <title>View Ideas</title>
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
            .view-idea-container {
                width: 100%;
                float: left;
                display: inline-block;
                clear: both;
                height: auto;
                font-weight: bold;
                /*overflow-y: scroll;
                    height: 600px;*/
            }

            .idea-container {
                background-color: #b5dcb3;
                border: solid;
                border-width: 2px;
                border-color: #0094BC;
                border-radius: 10px;
                padding: 12px;
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
                    <label>Description:</label>
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
                        <form name="edit_idea" action="edit_idea" method="post">
                            <input type="hidden" name="idea_id" value="<?php echo $Idea['IdeaModel']['idea_id']; ?>" /> 
                            <input type="submit" value="Edit">
                        </form>
                        <form name="deleteIdea" action="deleteIdea" method="post">
                            <input type="hidden" name="idea_id" value="<?php echo $Idea['IdeaModel']['idea_id']; ?>" />
                            <input type="submit" value="Delete">
                        </form>

                    </div>

                    <div id="like_dislike">
                        <img id="like" src="../app/webroot/img/thumbs-up.png"/>
                        <input type="hidden" name="like_count" id="like_count" value="<?php echo $likes; ?>">
                        <?php echo $likes; ?>
                        <img id="dislike" src="../app/webroot/img/thumbs-down.png"/>
                        <input type="hidden" name="dislike_count" id="dislike_count" value="<?php echo $dislikes; ?>">
                        <?php echo $dislikes; ?>

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
                    <div id="likes"></div>
                    <div id="dislikes"></div>
                    <div>
                        <?php foreach ($comments as $row): ?>
                            <?php echo $row['CommentModel']['comment_text']; ?><br>
                        <?php endforeach; ?> 
                    </div>
                </div>
            </div>
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
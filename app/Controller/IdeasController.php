<?php

App::uses('AppController', 'Controller');

class IdeasController extends AppController {

    public function submit_idea() {
        $this->layout = '';
        $this->loadModel('IdeaModel');
        /* display ideas categories */
        $this->displayCategories();
    }

    /* view ideas */

    public function view_ideas() {
        $this->layout = '';
        $this->loadModel('IdeaModel');
        /* display ideas categories */
        $this->displayCategories();
        /* display all group ideas */
        $allIdeas = $this->IdeaModel->find('all', array(
            'order' => array('IdeaModel.idea_id' => 'desc')));
        $this->set('allIdeas', $allIdeas);
    }

    /* like dislike and comments on idea */

    public function like_dislike_comment($id = null) {
        $this->layout = '';
        $this->loadModel('IdeaModel');
        if (!empty($this->params['url']['id'])) {
            $id = $this->params['url']['id'];

            $idea = $this->IdeaModel->find('first', array(
                'conditions' => array('IdeaModel.idea_id' => $id)));
            $this->set('Idea', $idea);
        }
        
        $this->layout = 'ajax';
        $this->loadModel('LikeDislikeStatus');
        
        $condition1 = array(
            'conditions' => array(
                'and' => array(
                    'LikeDislikeStatus.idea_id' => $id,
                    'LikeDislikeStatus.like_dislike_status' => 1)));
        
        $likes = $this->LikeDislikeStatus->find('all', $condition1);
        $likeCount = sizeof($likes);
        $this->set('likes', $likeCount);
        
        $condition2 = array(
            'conditions' => array(
                'and' => array(
                    'LikeDislikeStatus.idea_id' => $id,
                    'LikeDislikeStatus.like_dislike_status' => 0)));
        
        $dislikes = $this->LikeDislikeStatus->find('all', $condition2);
        $dislikeCount = sizeof($dislikes);
        $this->set('dislikes', $dislikeCount);    
        
        
//        if (!empty($_POST['likeCount'])) {
//            $this->layout = 'ajax';
//            $likeCount = $_POST['likeCount'];
//            $this->set('likeCount', $likeCount);          
//        }
//        
//        if (!empty($_POST['dislikeCount'])) {
//            $this->layout = 'ajax';
//            $likeCount = $_POST['dislikeCount'];
//            $this->set('dislikeCount', $dislikeCount);          
//        }
        
        // display all comments
        $this->loadModel('CommentModel');
        $commentList = $this->CommentModel->find('all', array(
            'conditions' => array('parent_idea_id' => $id)));
        $this->set('comments',$commentList);
    }

    /* Like idea */

    public function like_idea() {
        $this->layout = 'ajax';
        $idea_id = $_POST['ideaId'];
        $like_count = $_POST['likeCount'];
                
        $this->loadModel('LikeDislikeStatus');
        $this->loadModel('IdeaModel');
        
        $like_count++;
        $session_userId = CakeSession::read('user_id');
        
        $opts = array(
            'conditions' => array(
                'and' => array(
                    'LikeDislikeStatus.user_id' => $session_userId,
                    'LikeDislikeStatus.idea_id' => $idea_id)));

        $getLikeDislikeStatusFromDb = $this->LikeDislikeStatus->find('first', $opts);
        if (!empty($getLikeDislikeStatusFromDb)) {
            if ($getLikeDislikeStatusFromDb['LikeDislikeStatus']['like_dislike_status']) {
                $this->redirect('../Ideas/like_dislike_comment');
            } else {
                
                $this->LikeDislikeStatus->updateAll(array('like_dislike_status' => 1),array('AND' => array('LikeDislikeStatus.user_id' => $session_userId,
                    'LikeDislikeStatus.idea_id' => $idea_id )));
                              
                $this->redirect('../Ideas/like_dislike_comment');
            }
        } else {

            $this->LikeDislikeStatus->save(array('user_id' => $session_userId, 'idea_id' => $idea_id,
                'like_dislike_status' => 1));
            $this->redirect('../Ideas/like_dislike_comment');
        }
        
    }

    /* Dislike idea */

    public function dislike_idea() {
        $this->layout = 'ajax';
        $idea_id = $_POST['ideaId'];
        $dislike_count = $_POST['dislikeCount'];
        
        $this->loadModel('LikeDislikeStatus');
        $this->loadModel('IdeaModel');
       
        $dislike_count++;
        $session_userId = CakeSession::read('user_id');

        $opts = array(
            'conditions' => array(
                'and' => array(
                    'LikeDislikeStatus.user_id' => $session_userId,
                    'LikeDislikeStatus.idea_id' => $idea_id)));

        $getLikeDislikeStatusFromDb = $this->LikeDislikeStatus->find('first', $opts);
        if (!empty($getLikeDislikeStatusFromDb)) {
            if ($getLikeDislikeStatusFromDb['LikeDislikeStatus']['like_dislike_status']) {
                
                $this->LikeDislikeStatus->updateAll(array('like_dislike_status' => 0),array('AND' => array('LikeDislikeStatus.user_id' => $session_userId,
                    'LikeDislikeStatus.idea_id' => $idea_id )));
                $this->redirect('../Ideas/like_dislike_comment');
            } else {
                $this->redirect('../Ideas/like_dislike_comment');
            }
        } else {
            $this->LikeDislikeStatus->save(array('user_id' => $session_userId, 'idea_id' => $idea_id,
                'like_dislike_status' => 0));
            $this->redirect('../Ideas/like_dislike_comment');
        }
    }
    
    /* Save comment */

    public function saveComment() {
        $this->layout = 'ajax';
        $commentText = $_POST['commentText'];
        $parentCommentId = $_POST['commentId'];
        $ideaId = $_POST['ideaId'];
        $sessionEmail = CakeSession::read('email');
        
        $this->loadModel('CommentModel');
        
        
        $this->CommentModel->save(array('comment_text' => $commentText,'parent_comment_id' => $parentCommentId,
                                        'parent_idea_id' => $ideaId,'submitted_by' => $sessionEmail));
        
        
        
    }

    /* edit idea */

    public function edit_idea() {
        $this->layout = '';
        $this->loadModel('IdeaModel');
        $idea_id = trim($this->request->data['idea_id']);
        $idea = $this->IdeaModel->find('first', array(
            'conditions' => array('IdeaModel.idea_id' => $idea_id)));
        $this->set('Idea', $idea);
        /* display ideas categories */
        $this->displayCategories();
    }

    /* edit idea */

    public function updateIdea() {
        $this->loadModel('IdeaModel');
        $ideaId = trim($this->request->data['idea_id']);
        $title = trim($this->request->data['idea_title']);
        $description = trim($this->request->data['idea_description']);
        $category = trim($this->request->data['idea_category']);
        $status = trim($this->request->data['idea_status']);

        if ($status == '') {
            $status = "public";
        }

        if ($this->IdeaModel->updateAll(array('idea_title' => "'$title'", 'idea_description' => "'$description'",
                    'idea_category' => "'$category'", 'idea_status' => "'$status'"), array('idea_id' => $ideaId))) {
            $this->Session->write('message', 'updated successful');
            $this->redirect('../Ideas/view_ideas');
        } else {
            $this->Session->write('message', 'Your Idea not updated');
            $this->redirect('../Ideas/edit_idea');
        }
    }

    /* delete idea */

    public function deleteIdea() {
        $this->loadModel('IdeaModel');
        $idea_id = trim($this->request->data['idea_id']);
        if ($this->IdeaModel->delete(array('group_id' => $idea_id))) {
            $this->redirect('../Ideas/view_ideas');
        } else {
            $this->redirect('../Ideas/like_dislike_comment');
        }
    }

    /* Post submit Idea */

    public function submitIdea() {

        $this->loadModel('IdeaModel');
        $result = $this->request->data;
        $error = $this->IdeaModel->validation($result);

        if ($error === '') {
            $title = trim($this->request->data['idea_title']);
            $description = trim($this->request->data['idea_description']);
            $category = trim($this->request->data['idea_category']);
            $status = $this->request->data['idea_status'];
            $submitted_by = CakeSession::read('email');
            if ($status == '') {
                $status = 'public';
            }
            $session_group_id = 1;

            if (!empty($result)) {
                if ($this->IdeaModel->save(array('idea_title' => $title,
                            'idea_description' => $description, 'idea_category' => $category,
                            'idea_status' => $status, 'group_id' => $session_group_id, 'submitted_by' => $submitted_by))) {
                    $this->Session->write('message', 'Registration successful');
                    $this->redirect('../Ideas/view_ideas');
                } else {
                    $this->Session->write('message', 'Your Idea not submitted please submit your idea');
                    $this->redirect('../Ideas/submit_ideas');
                }
            }
        } else {
            $this->Session->setFlash($error);
        }
    }

    /* filter Idea */

    public function filter_ideas() {
        $this->layout = '';
        $this->loadModel('IdeaModel');
        $category = $this->params['url']['category'];
        ;
        $filterIdeas = $this->IdeaModel->find('all', array('conditions' => array('IdeaModel.idea_category' => $category)));

        $this->set('allIdeas', $filterIdeas);
        /* display ideas categories */
        $this->displayCategories();
    }

    public function displayCategories() {

        $this->loadModel('Category');
        $groupCategoriesList = $this->Category->find('all', array(
            'order' => array('Category.category_name' => 'asc')));
        $this->set('groupCategoriesList', $groupCategoriesList);
    }

}

?>
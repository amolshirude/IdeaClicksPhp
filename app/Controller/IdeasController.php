<?php

App::uses('AppController', 'Controller');

class IdeasController extends AppController {
    
public function submit_ideas(){
    $this->layout = '';
    $this->loadModel('IdeasModel');
    /*display ideas categories*/
    $this->displayCategories();
}
/*view ideas*/
public function view_ideas(){
    $this->layout = '';
    $this->loadModel('IdeasModel');
    /*display ideas categories*/
    $this->displayCategories();
    /*display all group ideas*/
    $allIdeas = $this->IdeasModel->find('all', array(
            'order' => array('IdeasModel.ideas_id' => 'desc')));
    $this->set('allIdeas', $allIdeas);
}
/*like dislike and comments on idea*/
public function like_dislike_comment(){
    $this->layout = '';
    $this->loadModel('IdeasModel');
    $ideas_id = trim($this->request->data['ideas_id']);
    $idea = $this->IdeasModel->find('first', array(
        'conditions' => array('IdeasModel.ideas_id' => 1)));
    $this->set('Idea', $idea);
}

/*edit idea*/  
public function edit_idea(){
    $this->layout = '';
    $this->loadModel('IdeasModel');
    $ideas_id = trim($this->request->data['ideas_id']);
    $idea = $this->IdeasModel->find('first', array(
        'conditions' => array('IdeasModel.ideas_id' => $ideas_id)));
    $this->set('Idea', $idea);
    /*display ideas categories*/
    $this->displayCategories();
}

/*edit idea*/
public function updateIdea(){
     $this->loadModel('IdeasModel');
     $ideasId = trim($this->request->data['ideas_id']);
     $title = trim($this->request->data['ideas_title']);
     $description = trim($this->request->data['ideas_description']);
     $category = trim($this->request->data['ideas_category']);
     $status = trim($this->request->data['ideas_status']);
     
     if($status == ''){ $status = "public";}
     
      if($this->IdeasModel->updateAll(array('ideas_title' => "'$title'", 'ideas_description' => "'$description'",
         'ideas_category' => "'$category'" ,'ideas_status' => "'$status'"), array('ideas_id' => $ideasId))){
             $this->Session->write('message', 'updated successful');
             $this->redirect('../Ideas/view_ideas');
       } else {
             $this->Session->write('message', 'Your Idea not updated');
             $this->redirect('../Ideas/edit_idea');
        }
}

/*delete idea*/
public function deleteIdea(){
     $this->loadModel('IdeasModel');
     $ideas_id = trim($this->request->data['ideas_id']);
     if ($this->IdeasModel->delete(array('group_id' => $ideas_id))){
        $this->redirect('../Ideas/view_ideas'); 
     }
     else{
         $this->redirect('../Ideas/like_dislike_comment');
     }
}
/* submit Idea*/
public function submit_idea(){
    
    $this->loadModel('IdeasModel');
    $result = $this->request->data;
    $error = $this->IdeasModel->validation($result);

    if ($error === '') {
        $title = trim($this->request->data['ideas_title']);
        $description = trim($this->request->data['ideas_description']);
        $category = trim($this->request->data['ideas_category']);
        $status = trim($this->request->data['ideas_status']);
        if($status == ''){ $status = "public";}
        $session_group_id = 1;
        
        if (!empty($result)) {
                if ($this->IdeasModel->save(array('ideas_title' => $title,
                     'ideas_description' => $description,
                     'ideas_category' => $category,'ideas_status' => $status,'group_id' => $session_group_id))) {
                     $this->Session->write('message', 'Registration successful');
                     $this->redirect('../Ideas/view_ideas');
                } else {
                    $this->Session->write('message', 'Your Idea not submitted please submit your idea');
                    $this->redirect('../Ideas/submit_ideas');
                }
        }
        else{
            
        }
     }
     else{
          $this->Session->setFlash($error);   
     }
}
/*filter Idea*/
public function filter_ideas(){
    $this->layout = '';
    $this->loadModel('IdeasModel');
    $category = 'Healthcare';
    $filterIdeas = $this->IdeasModel->find('all', 
             array('conditions' => array('IdeasModel.ideas_category' => $category)));
 
    $this->set('allIdeas', $filterIdeas); 
    /*display ideas categories*/
    $this->displayCategories();
}
public function displayCategories(){
    
        $this->loadModel('Category');
        $groupCategoriesList = $this->Category->find('all', array(
            'order' => array('Category.category_name' => 'asc')));
        $this->set('groupCategoriesList', $groupCategoriesList);    
}
}
?>
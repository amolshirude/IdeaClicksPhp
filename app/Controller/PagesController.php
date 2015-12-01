<?php

App::uses('ConnectionManager', 'Model');
App::uses('AppController', 'Controller');

class PagesController extends AppController {
    
      public function group_page() {
        $this->layout = '';
        //session
        $session_user_id = CakeSession::read('session_id');
        //$session_group_name = CakeSession::read('session_name');
        
        $group_id = trim($this->request->data['group_id']);
        $group_name = trim($this->request->data['group_name']);
                
        if (empty($session_user_id)) {
            $this->redirect('../login/home');
        }
        // display group admin profile
        $this->loadModel('CreateGroup');
        $groupInfo = $this->CreateGroup->find('first', array(
            'conditions' => array('CreateGroup.group_id' => $group_id)));
        $this->set('groupInfo', $groupInfo);
        
        // display group categories
        $this->loadModel('Category');
        $groupcategories = $this->Category->find('all', array(
            'conditions' => array('Category.group_id' => $group_id),
            'order' => array('Category.category_name' => 'asc')));

        foreach ($groupcategories AS $value) {

            $db_category_id = trim($value['Category']['category_id']);
            $db_category_name = trim($value['Category']['category_name']);
            $groupCateoriesList[$db_category_id] = $db_category_name;
        }
        if (!empty($groupCateoriesList)) {
            $this->set('groupCateoriesList', $groupCateoriesList);
        }
        // display group campaign
        $this->loadModel('Campaign');
        $groupcampaigns = $this->Campaign->find('all', array(
            'conditions' => array('Campaign.group_id' => $group_id)));
        $this->set('groupCampaignsList', $groupcampaigns);

        
        //count no of ideas
        $this->loadModel('Ideas');
        $Total_Ideas = $this->Ideas->find('all', array(
            'conditions' => array('group_name' => $group_name)));
        $count = sizeof($Total_Ideas);
        $this->set('TotalIdeas', $count);

        /* display ideas categories */
        $this->loadModel('Category');
        $groupCategoriesList = $this->Category->find('all', array('conditions' => array('group_id' => $group_id)), array('fields' => array('DISTINCT category_name')), array('order' => array('Category.category_name' => 'asc')));
        $this->set('groupCategoriesList', $groupCategoriesList);     
    }

    public function about_us() {
        $this->layout = '';
    }

    public function contact_us() {
        $this->layout = '';
    }

    public function header1() {
        $this->layout = '';
    }

    public function footer1() {
        $this->layout = '';
    }
}
?>
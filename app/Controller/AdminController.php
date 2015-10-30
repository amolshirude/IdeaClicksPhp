<?php

App::uses('AppController', 'Controller');

class AdminController extends AppController {

    public $uses = array();

    /* View Profile- Display group categories and campaigns */

    public function group_profile() {
        $this->layout = '';
        $curtm = date(" H:i:s", time());
        //date('Y-m-d H:i:s');
        $todaydate = date("d/m/Y", strtotime($curtm));
//        echo "<pre>";
//        print_r($curtm);
//        die();
        //set group_id in session for delete group.
        $session_group_id = 1;
        $this->set('group_id', $session_group_id);

        // display group type
        $this->displayGroupType();
        // display group categories
        $this->loadModel('Category');
        $groupcategories = $this->Category->find('all', array(
            'order' => array('Category.category_name' => 'asc')));

        foreach ($groupcategories AS $arr => $value) {

            $db_category_id = trim($value['Category']['category_id']);
            $db_category_name = trim($value['Category']['category_name']);
            $groupCateoriesList[$db_category_id] = $db_category_name;
        }

        $this->set('groupCateoriesList', $groupCateoriesList);

        // display group campaign
        $this->loadModel('Campaign');
        $groupcampaigns = $this->Campaign->find('all');
        $this->set('groupCampaignsList', $groupcampaigns);

        //display join group request
        $session_group_code = '3dplm';

        $this->loadModel('JoinGroup');
        $joinGroupRequest = $this->JoinGroup->find('all', array(
            'conditions' => array('group_code' => $session_group_code)));

        $this->set('joinGroupRequest', $joinGroupRequest);
    }

    public function termsandcondition() {
        
    }

    /* Display no of groups on create group page */

    public function create_group() {
        $this->layout = '';

        $this->displayGroupType();

        $this->loadModel('GetRegisteredGroupData');
        $group_info = $this->GetRegisteredGroupData->find('all', array(
            'order' => array('GetRegisteredGroupData.group_name' => 'asc')));

        $this->set('groupInfo', $group_info);
    }

    function register() {

        $this->loadModel('CreateGroup');
        $result = $this->request->data;
        $error = $this->CreateGroup->validation($result);
//        echo "<pre>";
//                print_r($error);die();
        if ($error === '') {
            $groupname = trim($this->request->data['group_name']);
            $groupcode = trim($this->request->data['group_code']);
            $grouptype = trim($this->request->data['group_type']);
            $groupadminemail = trim($this->request->data['group_admin_email']);
            $password = trim($this->request->data['password']);
            $cpassword = trim($this->request->data['c_password']);

            if (!empty($result)) {

                $flag = true;
                $this->loadModel('GetRegisteredGroupData');
                $group_info = $this->GetRegisteredGroupData->find('all');

                foreach ($group_info AS $arr => $value) {

                    $group_admin_email = trim($value['GetRegisteredGroupData']['group_admin_email']);

                    if ($group_admin_email == $groupadminemail) {
                        $flag = false;
                        break;
                    }
                }
                if ($flag == true) {
                    if ($this->CreateGroup->save(array('group_name' => $groupname, 'group_code' => $groupcode,
                                'group_type' => $grouptype, 'group_admin_email' => $groupadminemail,
                                'password' => $password, 'c_password' => $cpassword))) {
                        $this->Session->write('message', 'Registration successful');
                        $this->redirect('../Admin/create_group');
                    } else {
                        $this->Session->write('message', 'Registration unsuccessful');
                        $this->Session->delete($name);
                        $this->redirect('../Admin/create_group');
                    }
                } else {
                    $this->Session->write('message', 'Already registered');
                    $this->redirect('../Admin/create_group');
                }
            }
        } else {
            $this->Session->setFlash($error);
            //$this->redirect('../Admin/creategroup');
        }
    }

    /* Edit Profile */

    public function editGroupProfile() {
        $this->loadModel('CreateGroup');

        $groupname = trim($this->request->data['group_name']);
        $groupcode = trim($this->request->data['group_code']);
        $grouptype = trim($this->request->data['group_type']);
        $groupadminemail = trim($this->request->data['group_admin_email']);
    }

    /* Delete Group */

    public function deleteGroup() {

        $this->loadModel('CreateGroup');

        $groupId = trim($this->request->data['group_id']);

        if ($this->CreateGroup->delete(array('group_id' => $groupId))) {
            $this->Session->write('message', 'Group deleted');
            $this->redirect('../Admin/group_profile');
        } else {
            $this->Session->write('message', 'Group can not deleted');
            $this->redirect('../Admin/group_profile');
        }
    }

    /* add category */

    public function addCategory() {

        $this->loadModel('Category');
        $result = $this->request->data;
        $error = $this->Category->validation($result);
        if ($error === '') {
            $category_name = trim($this->request->data['category_name']);
            $session_group_id = 1;
            if (!empty($result)) {

                $flag = true;
                $this->loadModel('Category');
                $groupcategories = $this->Category->find('all');

                foreach ($groupcategories AS $arr => $value) {

                    $db_category_name = trim($value['Category']['category_name']);

                    if ($db_category_name == $category_name) {
                        $flag = false;
                        break;
                    }
                }
                if ($flag == true) {
                    if ($this->Category->save(array('category_name' => $category_name,
                                'group_id' => $session_group_id))) {
                        $this->Session->write('message', 'Category added');
                        $this->redirect('../Admin/group_profile');
                    } else {
                        $this->Session->write('message', 'Category not added');
                        $this->redirect('../Admin/group_profile');
                    }
                } else {
                    $this->Session->write('message', 'Same category available');
                    $this->redirect('../Admin/group_profile');
                }
            } else {
                $this->Session->setFlash($error);
            }
        }
    }

    /* Delete Category */

    public function deleteCategory() {

        $this->loadModel('Category');

        $category_id = trim($this->request->data['category_id']);

        if ($this->Category->delete(array('category_id' => $category_id))) {
            $this->Session->write('message', 'Category deleted');
            $this->redirect('../Admin/group_profile');
        } else {
            $this->Session->write('message', 'Category not deleted');
            $this->redirect('../Admin/group_profile');
        }
    }

    /* Create campaign */

    public function createCampaign() {

        $this->loadModel('Campaign');
        $result = $this->request->data;
        $error = $this->Campaign->validation($result);
        if ($error === '') {
            $campaign_name = trim($this->request->data['campaign_name']);
            $start_date = trim($this->request->data['start_date']);
            $end_date = trim($this->request->data['end_date']);
            $session_group_id = 1;
            echo 'cname' . $campaign_name;
            echo 'sdate' . $start_date;
            echo 'enddate' . $end_date;
            if (!empty($result)) {

                $flag = true;
                $this->loadModel('Campaign');

                if ($this->Campaign->save(array('campaign_name' => $campaign_name,
                            'start_date' => $start_date, 'end_date' => $end_date,
                            'group_id' => $session_group_id))) {
                    $this->Session->write('message', 'Campaign created');
                    $this->redirect('../Admin/group_profile');
                } else {
                    $this->Session->write('message', 'Campaign not created');
                    $this->redirect('../Admin/group_profile');
                }
            } else {
                $this->Session->setFlash($error);
                $this->redirect('../Admin/group_profile');
            }
        }
    }

    /* Delete Campaign */

    public function deleteCampaign() {

        $this->loadModel('Campaign');

        $campaign_id = trim($this->request->data['campaign_id']);

        if ($this->Campaign->delete(array('campaign_id' => $campaign_id))) {
            $this->Session->write('message', 'Campaign deleted');
            $this->redirect('../Admin/group_profile');
        } else {
            $this->Session->write('message', 'Campaign not deleted');
            $this->redirect('../Admin/group_profile');
        }
    }

    /* Edit campaign */

    public function edit_campaign() {
        $this->layout = ''; 
        $this->loadModel('Campaign');
        $campaign_id = trim($this->request->data['campaign_id']);
        $campaign = $this->Campaign->find('first', array(
        'conditions' => array('Campaign.campaign_id' => $campaign_id)));
         
        $this->set('Campaign', $campaign);
    }

    /* Display group type in dropdown list */

    public function displayGroupType() {

        $this->loadModel('SelectGroupType');
        $group_types = $this->SelectGroupType->find('all');

        $this->set('groupTypes', $group_types);
    }

    /* set campaign status */

    public function campaignStatus() {
        $curtm = date('Y-m-d H:i:s');
        $todaydate = date("d/m/Y", strtotime($curtm));
    }

    public function joinGroupStatus() {
        $this->loadModel('JoinGroup');
        $requestId = trim($this->request->data['request_id']);
        $buttonValue = trim($this->request->data['button_value']);

        if ($buttonValue == 'Accept') {
            
        } else {
            if ($this->JoinGroup->delete(array('request_id' => $requestId))) {
                $this->Session->write('message', 'User Request has been deleted');
                $this->redirect('../Admin/group_profile');
            } else {
                $this->Session->write('message', 'User Request not deleted');
                $this->redirect('../Admin/group_profile');
            }
        }
    }

}
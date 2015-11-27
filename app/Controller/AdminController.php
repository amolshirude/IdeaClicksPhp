<?php

App::uses('AppController', 'Controller');
App::uses('Security', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class AdminController extends AppController {

    public $uses = array();

    /* View Profile- Display group categories and campaigns */

    public function group_profile() {
        $this->layout = '';
        $curtm = date(" H:i:s", time());
        //date('Y-m-d H:i:s');
        $todaydate = date("d/m/Y", strtotime($curtm));

        //session
        $session_group_id = CakeSession::read('session_id');
        $session_group_name = CakeSession::read('session_name');
        $session_group_code = CakeSession::read('session_code');
        $session_group_admin_email = CakeSession::read('session_email');

        if (empty($session_group_id)) {
            $this->redirect('../login/home');
        }
        // display group admin profile
        $this->loadModel('CreateGroup');
        $groupInfo = $this->CreateGroup->find('first', array(
            'conditions' => array('CreateGroup.group_id' => $session_group_id)));
        $this->set('groupInfo', $groupInfo);

        // display group type
        $this->displayGroupType();

        // display group categories
        $this->loadModel('Category');
        $groupcategories = $this->Category->find('all', array(
            'conditions' => array('Category.group_id' => $session_group_id),
            'order' => array('Category.category_name' => 'asc')));

        foreach ($groupcategories AS $arr => $value) {

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
            'conditions' => array('Campaign.group_id' => $session_group_id)));
        $this->set('groupCampaignsList', $groupcampaigns);

        //display join group request
        $this->loadModel('JoinGroup');
        $joinGroupRequest = $this->JoinGroup->find('all', array(
            'conditions' => array('group_code' => $session_group_code)));

        $this->set('JoinGroupRequest', $joinGroupRequest);

        //count no of ideas
        $this->loadModel('Ideas');
        $Total_Ideas = $this->Ideas->find('all', array(
            'conditions' => array('group_name' => $session_group_name)));
        $count = sizeof($Total_Ideas);
        $this->set('TotalIdeas', $count);
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
        $key = 'iznWsaal5lKhOKu4f7f0YagKW81ClEBXqVuTjrFovrXXtOggrqHdDJqkGXsQpHf';
//      
        if ($error === '') {
            $groupname = trim($this->request->data['group_name']);
            $groupcode = trim($this->request->data['group_code']);
            $grouptype = trim($this->request->data['group_type']);
            $groupadminemail = trim($this->request->data['group_admin_email']);
            $password = trim($this->request->data['password']);
            $cpassword = trim($this->request->data['c_password']);
            $group_status = $this->request->data['group_status'];
            // Encrypt your text with my_key
            $encrypted_password = Security::cipher($password, $key);
            if ($group_status == '') {
                $group_status = 'close';
            }
            if (!empty($result)) {

                $flag = true;
                $this->loadModel('GetRegisteredGroupData');
                $group_info = $this->GetRegisteredGroupData->find('all');

                $this->loadModel('User');
                $userInfo = $this->User->find('all');

                foreach ($group_info AS $value) {

                    $group_admin_email = trim($value['GetRegisteredGroupData']['group_admin_email']);

                    if ($group_admin_email == $groupadminemail) {
                        $flag = false;
                        break;
                    }
                }
                foreach ($userInfo AS $value) {

                    $user_email = trim($value['User']['user_email']);

                    if ($user_email == $groupadminemail) {
                        $flag = false;
                        break;
                    }
                }
                if ($flag == true) {
                    if ($this->CreateGroup->save(array('group_name' => $groupname, 'group_code' => $groupcode,
                                'group_type' => $grouptype, 'group_admin_email' => $groupadminemail,
                                'password' => $encrypted_password, 'group_status' => $group_status))) {

                        $result = $this->CreateGroup->find('first', array(
                            'conditions' => array('CreateGroup.group_admin_email' => $groupadminemail)));
                        //session
                        CakeSession::write('session_id', $result['CreateGroup']['group_id']);
                        CakeSession::write('session_name', $groupname);
                        CakeSession::write('session_code', $groupcode);
                        CakeSession::write('session_email', $groupadminemail);

                        $this->redirect('../Admin/group_profile');
                    } else {
                        $this->Session->write('group_reg_message', 'Registration unsuccessful');
                        $this->Session->delete($name);
                        $this->redirect('../Admin/create_group');
                    }
                } else {
                    $this->Session->write('group_reg_message', 'Already registered');
                    $this->redirect('../Admin/create_group');
                }
            }
        } else {
            $this->Session->setFlash($error);
            //$this->redirect('../Admin/creategroup');
        }
    }

    /* Edit Profile */

    public function updateGroupProfile() {
        $this->loadModel('CreateGroup');

        $groupId = trim($this->request->data['group_id']);
        $groupname = trim($this->request->data['group_name']);
        $groupcode = trim($this->request->data['group_code']);
        $grouptype = trim($this->request->data['group_type']);
        $groupadminemail = trim($this->request->data['group_admin_email']);
        $contactNo = trim($this->request->data['contact_no']);
        $address = trim($this->request->data['address']);
        $country = trim($this->request->data['country']);
        $state = trim($this->request->data['state']);
        $city = trim($this->request->data['city']);
        $pincode = trim($this->request->data['pincode']);

        if ($this->CreateGroup->updateAll(array('group_name' => "'$groupname'",
                    'group_code' => "'$groupcode'", 'group_type' => "'$grouptype'",
                    'group_admin_email' => "'$groupadminemail'", 'contact_no' => "'$contactNo'"
                    , 'address' => "'$address'", 'country' => "'$country'", 'state' => "'$state'",
                    'city' => "'$city'", 'pincode' => "'$pincode'"), array('group_id' => $groupId))) {

            $this->Session->write('message', 'Your profile updated successful');
            $this->redirect('../Admin/group_profile');
        } else {
            $this->Session->write('message', 'Your profile not updated');
            $this->redirect('../Admin/group_profile');
        }
    }

    /* Display change password page */

    public function change_password() {
        $this->layout = '';
        //session
        $session_group_id = CakeSession::read('session_id');
        if (empty($session_group_id)) {
            $this->redirect('../login/home');
        }
        $this->loadModel('CreateGroup');
        $groupInfo = $this->CreateGroup->find('first', array(
            'conditions' => array('CreateGroup.group_id' => $session_group_id)));
        $this->set('groupInfo', $groupInfo);
    }

    /* post change password */

    public function changePassword() {
        $this->loadModel('CreateGroup');
        $key = 'iznWsaal5lKhOKu4f7f0YagKW81ClEBXqVuTjrFovrXXtOggrqHdDJqkGXsQpHf';
        $groupId = trim($this->request->data['group_id']);
        $password = trim($this->request->data['password']);
        $cpassword = trim($this->request->data['c_password']);
        $encrypted_password = Security::cipher($password, $key);
        if ($password == $cpassword) {
            if ($this->CreateGroup->updateAll(array('password' => "'$encrypted_password'"), array('user_id' => $groupId))) {
                $this->Session->write('pcmessage', 'password changed successfully');
                $this->redirect('../Admin/change_password');
            } else {
                $this->Session->write('pcmessage', 'Password not changed');
                $this->redirect('../Admin/change_password');
            }
        } else {
            $this->Session->write('pcmessage', 'password and confirm pasword different');
            $this->redirect('../Admin/change_password');
        }
    }

    /* Delete Group */

    public function deleteGroup() {
        $this->loadModel('CreateGroup');
        $session_group_id = CakeSession::read('session_id');

        if ($this->CreateGroup->delete(array('group_id' => $session_group_id))) {
            $this->Session->write('message', 'Group deleted');
            $this->redirect('../Login/home');
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
            $session_group_id = CakeSession::read('session_id');

            if (!empty($result)) {

                $flag = true;
                $this->loadModel('Category');
                $groupcategories = $this->Category->find('all', array(
                    'conditions' => array('Category.group_id' => $session_group_id)));

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
            $session_group_id = CakeSession::read('session_id');
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
            $status = "Accepted";
            $this->JoinGroup->updateAll(array('status' => "'$status'"), array('request_id' => $requestId));
            $this->redirect('../Admin/group_profile');
        } else if ($buttonValue == 'Reject') {
            $status = "Rejected";
            $this->JoinGroup->updateAll(array('status' => "'$status'"), array('request_id' => $requestId));
            $this->redirect('../Admin/group_profile');
        }
    }

    public function view_ideas() {
        $this->layout = '';
        $this->loadModel('IdeaModel');
        $session_group_name = CakeSession::read('session_name');
        if (empty($session_group_name)) {
            $this->redirect('../login/home');
        }
        $allIdeas = $this->IdeaModel->find('all', array('conditions' => array('group_name' => $session_group_name)));
        $this->set('allIdeas', $allIdeas);

        /* display ideas categories */
        $this->displayCategories();
    }

    public function view_single_idea($id = null) {
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

        // display all comments
        $this->loadModel('CommentModel');
        $commentList = $this->CommentModel->find('all', array(
            'conditions' => array('parent_idea_id' => $id)));
        $this->set('comments', $commentList);
    }

    /* Like idea */

    public function like_idea() {
        $this->layout = 'ajax';
        $idea_id = $_POST['ideaId'];
        $like_count = $_POST['likeCount'];

        $this->loadModel('LikeDislikeStatus');
        $this->loadModel('IdeaModel');

        $like_count++;
        $session_userId = CakeSession::read('session_id');

        $opts = array(
            'conditions' => array(
                'and' => array(
                    'LikeDislikeStatus.user_id' => $session_userId,
                    'LikeDislikeStatus.idea_id' => $idea_id)));

        $getLikeDislikeStatusFromDb = $this->LikeDislikeStatus->find('first', $opts);
        if (!empty($getLikeDislikeStatusFromDb)) {
            if ($getLikeDislikeStatusFromDb['LikeDislikeStatus']['like_dislike_status']) {
                $this->redirect('../Admin/view_single_idea');
            } else {

                $this->LikeDislikeStatus->updateAll(array('like_dislike_status' => 1), array('AND' => array('LikeDislikeStatus.user_id' => $session_userId,
                        'LikeDislikeStatus.idea_id' => $idea_id)));

                $this->redirect('../Admin/view_single_idea');
            }
        } else {

            $this->LikeDislikeStatus->save(array('user_id' => $session_userId, 'idea_id' => $idea_id,
                'like_dislike_status' => 1));
            $this->redirect('../Admin/view_single_idea');
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
        $session_userId = CakeSession::read('session_id');

        $opts = array(
            'conditions' => array(
                'and' => array(
                    'LikeDislikeStatus.user_id' => $session_userId,
                    'LikeDislikeStatus.idea_id' => $idea_id)));

        $getLikeDislikeStatusFromDb = $this->LikeDislikeStatus->find('first', $opts);
        if (!empty($getLikeDislikeStatusFromDb)) {
            if ($getLikeDislikeStatusFromDb['LikeDislikeStatus']['like_dislike_status']) {

                $this->LikeDislikeStatus->updateAll(array('like_dislike_status' => 0), array('AND' => array('LikeDislikeStatus.user_id' => $session_userId,
                        'LikeDislikeStatus.idea_id' => $idea_id)));
                $this->redirect('../Admin/view_single_idea');
            } else {
                $this->redirect('../Admin/view_single_idea');
            }
        } else {
            $this->LikeDislikeStatus->save(array('user_id' => $session_userId, 'idea_id' => $idea_id,
                'like_dislike_status' => 0));
            $this->redirect('../Admin/view_single_idea');
        }
    }

    /* delete idea */

    public function deleteIdea() {
        $this->loadModel('IdeaModel');
        $idea_id = trim($this->request->data['idea_id']);
        if ($this->IdeaModel->delete(array('group_id' => $idea_id))) {
            $this->redirect('../Admin/view_ideas');
        } else {
            $this->redirect('../Admin/view_single_idea');
        }
    }
    
    /* filter Idea */

    public function filter_ideas() {
        $this->layout = '';
        $this->loadModel('IdeaModel');
        $category = $this->params['url']['category'];
        $session_group_name = CakeSession::read('session_name');
        $opts = array(
            'conditions' => array(
                'and' => array(
                    'IdeaModel.group_name' => $session_group_name,
                    'IdeaModel.idea_category' => $category)));
        
        $filterIdeas = $this->IdeaModel->find('all',$opts);

        $this->set('allIdeas', $filterIdeas);
        /* display ideas categories */
        $this->displayCategories();
    }

    public function displayCategories() {
        $this->loadModel('Category');
        $session_group_id = CakeSession::read('session_id');
        $groupCategoriesList = $this->Category->find('all', array('conditions' => array('group_id' => $session_group_id)), array('order' => array('Category.category_name' => 'asc')));

        $this->set('groupCategoriesList', $groupCategoriesList);
    }

}
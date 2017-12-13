<?php
/**
 * Created by PhpStorm.
 * User: roamadmin
 * Date: 30-10-2017
 * Time: 15:58
 */
namespace App\Controller\Partners;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('partner');

    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow([
            'login'
        ]);
    }

    public function login() {
        if(!empty($this->Auth->user())){
            if($this->Auth->redirectUrl() == '/') {
                return $this->redirect(PARTNER_BASE_URL.'users/dashboard');
            }else {
                return $this->redirect($this->Auth->redirectUrl());
            }

        }else if($this->request->is('post')){
            $user = $this->Auth->identify();
            if(!empty($user) && ($user['role_id'] == 2)){
                $this->Auth->setUser($user);
                return $this->redirect(PARTNER_BASE_URL.'users/dashboard');
            }else{
                $this->Flash->error('Invalid username or password, try again');
            }
        }
    }

    public function dashboard() {

    }

    public function changepassword() {
        if($this->request->is('post')) {
            if($this->request->getData('password')) {
                $userEntity = $this->Users->newEntity();
                $patchEntity = $this->Users->patchEntity($userEntity,$this->request->getData());
                $patchEntity['id'] = $this->Auth->user('id');
                $saveEntity = $this->Users->save($patchEntity);

                $this->Flash->success(__('Password changed successful'));
                return $this->redirect(PARTNER_BASE_URL.'users/changepassword');
            }
        }
    }

    public function logout() {

        $this->Auth->logout();
        $this->Flash->success(__('Logout successful.'));
        return $this->redirect(PARTNER_BASE_URL);
    }
}
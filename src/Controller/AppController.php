<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth');

        $this->prefix = (!empty($this->request->params['prefix']))
            ? $this->request->params['prefix'] : '';

        if ($this->prefix === 'eatadmin') {
            $this->loadComponent('Auth', [
                'loginRedirect' => [
                    'controller' => 'Users',
                    'action' => 'login'
                ],
                'logoutRedirect' => [
                    'controller' => 'Users',
                    'action' => 'logout'
                ]
            ]);

            if (!empty($this->Auth->user()) && $this->Auth->user('role_id') === 2) {
                $this->Flash->success('Please logout our frontend');
                return $this->redirect(BASE_URL);
            }
        } else if ($this->prefix === 'partners') {

            $this->loadComponent('Auth', [
                'loginRedirect' => [
                    'controller' => 'Users',
                    'action' => 'login'
                ],
                'logoutRedirect' => [
                    'controller' => 'Users',
                    'action' => 'logout'
                ]
            ]);

            if (!empty($this->Auth->user()) && $this->Auth->user('role_id') === 1) {
                $this->Flash->success('Please logout our Admin panel');
                return $this->redirect(ADMIN_BASE_URL);
            }else if (!empty($this->Auth->user()) && $this->Auth->user('role_id') === 3) {
                $this->Flash->success('Please logout our frontend');
                return $this->redirect(BASE_URL);
            }
        }else {

            $this->loadComponent('Auth', [
                'loginRedirect' => [
                    'controller' => 'Users',
                    'action' => 'login'
                ],
                'logoutRedirect' => [
                    'controller' => 'Users',
                    'action' => 'logout'
                ]
            ]);

            if (!empty($this->Auth->user()) && $this->Auth->user('role_id') === 1) {
                $this->Flash->success('Please logout our Admin panel');
                return $this->redirect(ADMIN_BASE_URL);
            }else if (!empty($this->Auth->user()) && $this->Auth->user('role_id') === 2) {
                $this->Flash->success('Please logout our partner panel');
                return $this->redirect(PARTNER_BASE_URL);
            }

        }


        $controller = $this->request->params['controller'];
        $action     = $this->request->params['action'];

        //Logged User
        if(!empty($this->Auth->user()))
            $this->set('logginUser', $this->Auth->user());
        else
            $this->set('logginUser', '');

        define('STRIPE_API_KEY','sk_test_BQokikJOvBiI2HlWgH4olfQ2');
        define('STRIPE_PUBLISHERKEY','pk_test_6pRNASCoBOKtIshFeQd4XMUh');

        $this->set(compact('controller', 'action'));
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}

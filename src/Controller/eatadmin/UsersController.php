<?php
/**
 * Created by PhpStorm.
 * User: Sundar
 * Date: 29-09-2017
 * Time: 15:01
 */
namespace App\Controller\Eatadmin;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\Table;

class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('backend');

        $this->loadModel('Users');
        $this->loadModel('Sitesettings');
        $this->loadModel('Timezones');
    }
    public function beforeFilter(Event $event)
    {
        // Before Login , these are the function we can access
        $this->Auth->allow([
            'login'
        ]);
    }

    public function login() {

        if(!empty($this->Auth->user())){
            if($this->Auth->redirectUrl() == '/') {
                return $this->redirect(ADMIN_BASE_URL.'users/dashboard');
            }else {
                return $this->redirect($this->Auth->redirectUrl());
            }

        }else if($this->request->is('post')){
            $user = $this->Auth->identify();
            if(!empty($user) && ($user['role_id'] == 1)){

                $this->Auth->setUser($user);
                return $this->redirect(ADMIN_BASE_URL.'users/dashboard');
            }else{
                $this->Flash->error('Invalid username or password, try again');
            }
        }
    }

    public function dashboard() {

    }

    public function index() {
        echo 'come';die();
    }
    public function site() {

        //echo "<pre>"; print_r($this->request->data); die();
        if($this->request->is('post')){
            $sitesetting  = $this->Sitesettings->newEntity();
            $sitesetting  = $this->Sitesettings->patchEntity($sitesetting, $this->request->data);

            $sitesetting->id  = $this->Auth->user('role_id');
            $sitesettingEditInfo  = $this->Sitesettings->get($this->Auth->user('role_id'));

            //Site Logo ------------------------------------------------------------
            $invalid = '0';
            if(isset($this->request->data['sitelogo']['name']) && !empty($this->request->data['sitelogo']['name'])
            ){
                $valid     = getimagesize($_FILES['sitelogo']['tmp_name']);
                $filePart  = pathinfo($this->request->data['sitelogo']['name']);
                $logo      = ['jpg','jpeg','gif','png'];

                if( $this->request->data['sitelogo']['error'] == 0 &&
                    ($this->request->data['sitelogo']['size'] > 0 ) &&
                    in_array(strtolower($filePart['extension']),$logo) && !empty($valid) ) {

                    $img_path       = SITESETTINGS_LOGO_PATH;
                    if(isset($sitesettingEditInfo['site_logo']) && !empty($sitesettingEditInfo['site_logo'])
                        && file_exists(SITESETTINGS_LOGO_PATH.'/'.$sitesettingEditInfo['site_logo']))
                        $this->Common->unlinkFile($sitesettingEditInfo['site_logo'], $img_path);
                    $image_detail   = $this->Common->UploadFile($this->request->data['sitelogo'], $img_path);
                    $sitesetting->site_logo  = $image_detail['refName'];

                } else{

                    $invalid = '1';
                    $site_data = $this->Sitesettings->find('all')->first();
                    $this->set(compact('id','site_data'));
                    $this->Flash->error(_("Site Logo should be valid image type"));
                }

            }
            else
                $sitesetting->site_logo      = $sitesettingEditInfo['site_logo'];

            // Site FavIcon ----------------------------------------------------
            if(isset($this->request->data['sitefav']['name']) && !empty($this->request->data['sitefav']['name'])
            ){

                $valide   = getimagesize($_FILES['sitefav']['tmp_name']);
                $file     = pathinfo($this->request->data['sitefav']['name']);
                $fav      = ['ico'];

                if( $this->request->data['sitefav']['error'] == 0 &&
                    ($this->request->data['sitefav']['size'] > 0 ) &&
                    in_array(strtolower($file['extension']),$fav) && !empty($valid) ) {

                    $img_path       = SITESETTINGS_LOGO_PATH;
                    if(isset($sitesettingEditInfo['site_favicon']) && !empty($sitesettingEditInfo['site_favicon'])
                        && file_exists(SITESETTINGS_LOGO_PATH.'/'.$sitesettingEditInfo['site_favicon']))
                        $this->Common->unlinkFile($sitesettingEditInfo['site_favicon'], $img_path);

                    $image_detail   = $this->Common->UploadFile($this->request->data['sitefav'], $img_path);
                    $sitesetting->site_favicon  = $image_detail['refName'];

                } else{

                    $invalid = '1';
                    $site_data = $this->Sitesettings->find('all')->first();
                    $this->set(compact('id','site_data'));
                    $this->Flash->error(_("Site FavIcon should be valid .ico type"));
                }
            }
            else
                $sitesetting->site_favicon      = $sitesettingEditInfo['site_favicon'];
            //---------------------------------------------------------------------------------------

            if($invalid == 0) {
                if ($this->Sitesettings->save($sitesetting)){
                    $this->Flash->success(_('Site details are updated successfully'));
                    return $this->redirect(ADMIN_BASE_URL.'users/site/');
                }
            }
        }

        $site_data = $this->Sitesettings->find('all',[
            'fields' => [
                'site_name',
                'site_logo',
                'site_favicon',
                'site_currency',
                'drop_timing',
                'upfront_option',
                'pickup_app',
                'search_by',
                'normal_type'
            ]
        ])->hydrate(false)->toArray();


        if(!empty($site_data))
            $this->request->data = $site_data[0];
        $this->set('site_data',$site_data[0]);
    }
    #-----------------------------------------------------------------------------------------------------------------
    public function contact(){

        if($this->request->is('post')) {
            $contact = $this->Sitesettings->newEntity();
            $contact = $this->Sitesettings->patchEntity($contact, $this->request->data);
            $contact->id = $this->Auth->user('role_id');

            if ($this->Sitesettings->save($contact)){
                $this->Flash->success(_('Contact Setting details are updated successfully'));
                return $this->redirect(ADMIN_BASE_URL.'users/contact/');
            }
        }

        $time1hrs = ['24' => '24'];
        $time2hrs = ['48' => '48'];

        $this->set(compact('time1hrs','time2hrs'));
        $contact_data = $this->Sitesettings->find('all',[
            'fields' => [
                'admin_name',
                'admin_email',
                'order_email',
                'contactus_email',
                'site_phonenumber'
            ]
        ])->hydrate(false)->toArray();

        if(!empty($contact_data))
            $this->request->data = $contact_data[0];
        $this->set('site_data',$contact_data[0]);
    }
    #-----------------------------------------------------------------------------------------------------------------
    public function location(){

        if($this->request->is('post')) {
            $location = $this->Sitesettings->newEntity();
            $location = $this->Sitesettings->patchEntity($location, $this->request->data);
            $location->id = $this->Auth->user('role_id');

            if ($this->Sitesettings->save($location)){
                $this->Flash->success(_('Location Setting details are updated successfully'));
                return $this->redirect(ADMIN_BASE_URL.'users/location/');
            }
        }

        $zone = $this->Timezones->find('list',[
            'keyField' => 'id',
            'valueField' => 'timezone_name',
            'conditions' => [
                'id IS NOT NULL'
            ]
        ])->hydrate(false)->toArray();
        $this->set(compact('zone'));

        $locat_data = $this->Sitesettings->find('all',[
            'fields' => [
                'site_address',
                'site_city',
                'site_zipcode',
                'site_state',
                'site_country',
                'timezone'
            ]
        ])->hydrate(false)->toArray();


        if(!empty($locat_data))
            $this->request->data = $locat_data[0];
        $this->set('site_data',$locat_data[0]);
    }
    #-----------------------------------------------------------------------------------------------------------------
    public function payment(){

        if($this->request->is('post')) {

            $payment = $this->Sitesettings->newEntity();
            $payment = $this->Sitesettings->patchEntity($payment, $this->request->data);
            $payment->id = $this->Auth->user('role_id');

            if ($this->Sitesettings->save($payment)){
                $this->Flash->success(_('Payment Setting details are updated successfully'));
                return $this->redirect(ADMIN_BASE_URL.'users/payment/');
            }
        }

        $paydemo  = ['Test' => 'Test'];
        $paylive  = ['Live' => 'Live'];
        $this->set(compact('paydemo','paylive'));

        $pay_data = $this->Sitesettings->find('all',[
            'fields' => [
                'stripe_payment_mode',
                'stripe_apikey_test',
                'stripe_apikey_live',
                'publisher_key_test',
                'publisher_key_live',
            ]
        ])->hydrate(false)->toArray();

        if(!empty($pay_data))
            $this->request->data = $pay_data[0];
        $this->set('site_data',$pay_data[0]);
    }
    #-----------------------------------------------------------------------------------------------------------------
    public function sms(){

        if($this->request->is('post')) {
            $smssetting = $this->Sitesettings->newEntity();
            $smssetting = $this->Sitesettings->patchEntity($smssetting, $this->request->data);
            $smssetting->id = $this->Auth->user('role_id');

            if ($this->Sitesettings->save($smssetting)){
                $this->Flash->success(_('SMS Setting details are updated successfully'));
                return $this->redirect(ADMIN_BASE_URL.'users/sms/');
            }
        }

        $smsoff  = ['OFF' => 'OFF'];
        $smson   = ['ON' => 'ON'];
        $this->set(compact('smsoff','smson'));

        $sms_data = $this->Sitesettings->find('all',[
            'fields' => [
                'sms_mode',
                'twilio_token_id',
                'twilio_secret_key',
                'twilio_from_no'
            ]
        ])->hydrate(false)->toArray();
        //echo "<pre>"; print_r($sms_data); die();

        if(!empty($sms_data))
            $this->request->data = $sms_data[0];
        $this->set('site_data',$sms_data[0]);
    }

    public function logout() {
        $this->Auth->logout();
        return $this->redirect(ADMIN_BASE_URL.'');
    }

    public function banners() {
        if($this->request->is('post')) {
            //pr($this->request->getData());die();

            require_once(ROOT . DS . 'vendor' . DS . 'Cloudinary' . DS . 'Cloudinary.php');
            require_once(ROOT . DS . 'vendor' . DS . 'Cloudinary' . DS . 'Uploader.php');
            require_once(ROOT . DS . 'vendor' . DS . 'Cloudinary' . DS . 'Api.php');

            \Cloudinary::config(array(
                "cloud_name" => "dntzmscli",
                "api_key" => "213258421718748",
                "api_secret" => "vTrAbTdKHswpiOQZcHvCv9LqZ3M"
            ));
            if(!empty($this->request->getData('banner1'))) {

                $data = \Cloudinary\Uploader::upload($_FILES["banner1"]["tmp_name"],
                    array(
                        "public_id" => 'banner1'
                    ));
                $updateBanner['banner1'] = $data['url'];

            }
            if(!empty($this->request->getData('banner2'))) {

                $data = \Cloudinary\Uploader::upload($_FILES["banner2"]["tmp_name"],
                    array(
                        "public_id" => 'banner2'
                    ));
                $updateBanner['banner2'] = $data['url'];

            }

            if(!empty($this->request->getData('banner3'))) {

                $data = \Cloudinary\Uploader::upload($_FILES["banner3"]["tmp_name"],
                    array(
                        "public_id" => 'banner3'
                    ));
                #echo $data['eager'][0]['secure_url'];
                #print_r($data);die();
                $updateBanner['banner3'] = $data['url'];

            }

            if(!empty($this->request->getData('banner4'))) {

                $data = \Cloudinary\Uploader::upload($_FILES["banner4"]["tmp_name"],
                    array(
                        "public_id" => 'banner4'
                    ));
                #echo $data['eager'][0]['secure_url'];
                #print_r($data);die();
                $updateBanner['banner4'] = $data['url'];

            }

            $smssetting = $this->Sitesettings->newEntity();
            $smssetting = $this->Sitesettings->patchEntity($smssetting, $updateBanner);
            $smssetting->id = $this->Auth->user('role_id');

            if ($this->Sitesettings->save($smssetting)){
                $this->Flash->success(_('Banner Image uplaod successful'));
                return $this->redirect(ADMIN_BASE_URL.'users/banners/');
            }
        }

        $bannerData = $this->Sitesettings->find('all',[
            'fields' => [
                'banner1',
                'banner2',
                'banner3',
                'banner4'
            ]
        ])->hydrate(false)->first();


        $this->set('bannerData',$bannerData);

    }
}
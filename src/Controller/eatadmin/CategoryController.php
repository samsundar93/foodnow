<?php
/**
 * Created by PhpStorm.
 * User: Sundar
 * Date: 9/29/2017
 * Time: 10:40 PM
 */
namespace App\Controller\Eatadmin;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\Table;
use Excel\Controller\ExcelReaderController;

class CategoryController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('backend');

        $this->loadModel('Users');
        $this->loadModel('Sitesettings');
        $this->loadModel('Timezones');
    }

    public function index($process = null) {
        $this->loadModel('Categories');
        $categoryList = $this->Categories->find('all', [
            'conditions' => [
                'Categories.id IS NOT NULL'
            ],
            'contain' => [
                'Restaurants' => [
                    'fields' => [
                        'restaurant_name'
                    ]
                ]
            ],
            'order' => 'Categories.sortorder'
        ])->hydrate(false)->toArray();


        $this->set(compact('categoryList'));

        if($process == 'Categories' ){
            $value = array($categoryList);
            return $value;
        }

    }

    public function addedit($id = null) {
        $this->loadModel('Restaurants');
        $this->loadModel('Categories');
        if($this->request->is('post')) {
            if($this->request->data['editedId'] != '') {
                $this->request->data['id'] = $this->request->data['editedId'];
            }
            $this->request->data['seo_url'] = $this->seoUrl($this->request->data['catname']);

            $category = $this->Categories->newEntity();
            $categoryPatch = $this->Categories->patchEntity($category,$this->request->data);
            $saveCategory = $this->Categories->save($categoryPatch);
            if($saveCategory) {
                if($this->request->data['editedId'] != '') {
                    $this->Flash->success(__('Category edited successful'));
                }else {
                    $this->Flash->success(__('Category added successful'));
                }
                return $this->redirect(ADMIN_BASE_URL.'category');
            }
        }

        $restaurantList = $this->Restaurants->find('list',[
            'keyField'   => 'id',
            'valueField' => 'restaurant_name',
            'conditions' => [
                'delete_status' => 'N',
                'status' => '1'
            ]
        ])->hydrate(false)->toArray();

        $categoryList = $this->Categories->find('all', [
            'conditions' => [
                'id' => $id
            ]
        ])->hydrate(false)->first();

        $this->set(compact('restaurantList','id','categoryList'));

    }

    public function ajaxaction(){

        $this->loadModel('Categories');

        if($this->request->is('ajax')){
            if($this->request->data['action'] == 'catstatuschange'){

                $category         = $this->Categories->newEntity();
                $category         = $this->Categories->patchEntity($category,$this->request->data);
                $category->id     = $this->request->data['id'];
                $category->status = $this->request->data['changestaus'];
                $this->Categories->save($category);

                $this->set('id', $this->request->data['id']);
                $this->set('action', 'catstatuschange');
                $this->set('field', $this->request->data['field']);
                $this->set('status', (($this->request->data['changestaus'] == 0) ? 'deactive' : 'active'));
            }
        }
    }

    public function deletecate($id = null){

        $this->loadModel('Categories');

        if($this->request->is('ajax')){
            if($this->request->data['action'] == 'Categories' && $this->request->data['id'] != ''){

                $id       = $this->request->data['id'];

                $entity = $this->Categories->get($id);
                $result = $this->Categories->delete($entity);

                list($catList) = $this->index('Categories');
                if($this->request->is('ajax')) {
                    $action         = 'Categories';
                    $this->set(compact('action', 'catList'));
                    $this->render('ajaxaction');
                }
            }
        }
    }

    public function checkCategory() {
        $this->loadModel('Categories');
        if($this->request->data['id'] != '') {
            $conditions = [
                'id !=' => $this->request->data['id'],
                'restaurant_id' => $this->request->data['restaurant_id'],
                'seo_url' => $this->seoUrl($this->request->data['catname'])
            ];

        }else {
            $conditions = [
                'restaurant_id' => $this->request->data['restaurant_id'],
                'seo_url' => $this->seoUrl($this->request->data['catname'])
            ];
        }

        $categoryCount = $this->Categories->find('all', [
            'conditions' => $conditions
        ])->count();
        if($categoryCount == 0) {
            echo 'true';die();
        }else {
            echo 'false';die();
        }
        die();
    }

    public function seoUrl($string)
    {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $string);

        // trim
        $text = trim($text, '-');

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if(strlen($text) > 70) {
            $text = substr($text, 0, 70);
        }

        if (empty($text))
        {
            //return 'n-a';
            return time();
        }

        return $text;
    }

    public function updateSortOrder() {
        $this->loadModel('Categories');

        $updateRecords = explode("^", $this->request->data['data']);
        $limit         = $this->limit;

        foreach ($updateRecords as $key => $value){
            if (!empty($value)){
                $cccnt = $key + 1;
                $category                 = $this->Categories->newEntity();
                $updateSort['sortorder']  = $cccnt;
                $updateSort['id']         = $value;
                $categorySave             = $this->Categories->patchEntity($category,$updateSort);
                $this->Categories->save($categorySave);
            }
        }
        echo 'done';die();
    }
}
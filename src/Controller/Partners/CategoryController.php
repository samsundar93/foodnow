<?php
/**
 * Created by PhpStorm.
 * User: Sundar
 * Date: 9/29/2017
 * Time: 10:40 PM
 */
namespace App\Controller\Partners;
use Cake\Event\Event;
use App\Controller\AppController;


class CategoryController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('partner');

        $this->loadModel('Users');
        $this->loadModel('Categories');
    }

    public function index($process = null) {
        $this->loadModel('Categories');
        $categoryList = $this->Categories->find('all', [
            'conditions' => [
                'Categories.id IS NOT NULL',
                'Categories.restaurant_id' => $this->Auth->user('user_id')
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

    public function add() {

        $this->loadModel('Restaurants');


        if($this->request->is('post')) {
            $seoUrl = $this->seoUrl($this->request->getData('catname'));

            $category = $this->Categories->newEntity();
            $categoryPatch = $this->Categories->patchEntity($category,$this->request->getData());
            $categoryPatch->restaurant_id = $this->Auth->user('user_id');
            $categoryPatch->seo_url = $seoUrl;
            $saveCategory = $this->Categories->save($categoryPatch);
            if($saveCategory) {
                $this->Flash->success(__('Category added successful'));
                return $this->redirect(PARTNER_BASE_URL.'category');
            }
        }
    }

    public function edit($id = null) {

        if($this->request->is('post')) {

            //pr($this->request->getData());die();
            $seoUrl = $this->seoUrl($this->request->getData('catname'));

            $category = $this->Categories->newEntity();
            $categoryPatch = $this->Categories->patchEntity($category,$this->request->getData());
            $categoryPatch->restaurant_id = $this->Auth->user('user_id');
            $categoryPatch->seo_url = $seoUrl;
            $categoryPatch->id = $this->request->getData('editId');
            $saveCategory = $this->Categories->save($categoryPatch);
            if($saveCategory) {
                $this->Flash->success(__('Category added successful'));
                return $this->redirect(PARTNER_BASE_URL.'category');
            }

        }

        $categoryList = $this->Categories->find('all', [
            'conditions' => [
                'id' => $id
            ]
        ])->hydrate(false)->first();

        $this->set(compact('id','categoryList'));
    }


    public function categoryCheck() {

        if($this->request->getData('categoryname') != '') {
            if($this->request->getData('id') != '') {
                $conditions = [
                    'id !=' => $this->request->getData('id'),
                    'catname' => $this->request->getData('categoryname'),
                    'delete_status' => 'N'
                ];

            }else {
                $conditions = [
                    'catname' => $this->request->getData('categoryname'),
                    'delete_status' => 'N'
                ];
            }

            $categoryCount = $this->Categories->find('all', [
                'conditions' => $conditions
            ])->count();

            if($categoryCount == 0) {
                echo '0';
            }else {
                echo '1';
            }
            die();
        }
    }

    public function ajaxaction(){

        $this->loadModel('Categories');

        if($this->request->is('ajax')){
            if($this->request->getData('action') == 'categorystatuschange'){

                $category         = $this->Categories->newEntity();
                $category         = $this->Categories->patchEntity($category,$this->request->getData());
                $category->id     = $this->request->getData('id');
                $category->status = $this->request->getData('changestaus');
                $this->Categories->save($category);

                $this->set('id', $this->request->getData('id'));
                $this->set('action', 'categorystatuschange');
                $this->set('field', $this->request->getData('field'));
                $this->set('status', (($this->request->getData('changestaus') == 0) ? 'deactive' : 'active'));
            }
        }
    }

    public function deletecategory($id = null){

        $this->loadModel('Categories');

        if($this->request->is('ajax')){
            if($this->request->getData('action') == 'Category' && $this->request->getData('id') != ''){

                $id       = $this->request->getData('id');

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
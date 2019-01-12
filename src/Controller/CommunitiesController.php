<?php
// src/Controller/CommunitiesController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\Network\Email\Email;
use App\Model\Table\CommunitiesResponses;
//use App\Model\Entity\ClaimType;


class CommunitiesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
		//Configure::write('debug', 0);
        $this->session = $this->request->session();
				 //TableRegistry::get('CommunitiesResponses');
				 				 $this->loadModel('CommunitiesResponses');


        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }
	
	public function beforeFilter(Event $event) {
		//parent::beforeFilter($event);
		if($this->Auth->User('id')){
			$this->Auth->allow();
		}
    }

    public function view()
	{
		$allPosts = $this->Paginator->paginate($this->Communities->find('all' ));
        $this->set(compact('allPosts'));
	}
	
	public function yourPost()
	{
		$allPosts = $this->Paginator->paginate($this->Communities->find('all', [
					'conditions' => ['Communities.user_id' => $this->Auth->User('id')]]));
        $this->set(compact('allPosts'));
	}
	
	public function yourResponses()
	{
		$CommunitiesResponses = TableRegistry::get('CommunitiesResponses');
		//$allPosts = $this->Communities->find('all')->contain(['CommunitiesResponses'])->toArray();
		
foreach ($query as $address) {
//	pr($address);die;
    //echo $address->user->username;
}

		$allPosts = $this->Paginator->paginate($CommunitiesResponses->find('all', [
					'conditions' => ['CommunitiesResponses.user_id' => $this->Auth->User('id'), 'CommunitiesResponses.response !=' => '']]));
        $this->set(compact('allPosts'));
	}
	
	public function yourLikes()
	{
		$query = $this->Communities->find()->where(['communities.user_id' => $this->Auth->User('id')])->hydrate(false)->join([
			'table' => 'community_response',
			'alias' => 'a',
			'type' => 'LEFT',
			'conditions' => ['a.community_post_id = communities.id', 'a.likes = 1']
		 ])->autoFields(true) //selecting all fields from current table
		   ->select(["a.likes,a.response"]); //selecting some fields from table community_response

		return $query->toArray();
	}
	
    public function add()
    {
		$this->set('errorMsg','');
        $community = $this->Communities->newEntity();

		// Data now looks like
        if ($this->request->is('post')) {
			$postedData = $this->request->data;

			//pr($postedData);die;
			$community = $this->Communities->patchEntity($community, $postedData);
			$community->user_id = $this->Auth->User('id');
			//pr($community);die;
			if ($this->Communities->save($community)) {
				$this->Flash->success(__('Your community details has been saved.'));
				return $this->redirect(['action' => 'view']);
			}
				
			$errdata='';
			if(count($community->errors())>0){
				foreach($community->errors() as $ind =>$value){
					$errdata .='<br/>';//pr($value);
					echo $errdata .= implode(",",array_values($value));
				}	
				$this->set('errorMsg',$errdata);//pr($community->errors());die;
			}		
			$this->Flash->error(__('Unable to add your community.'));		
		}

        $this->set('community', $community);
    }
	
	
	public function addresponse()
    {
		$this->set('errorMsg','');
		 $this->loadModel('CommunitiesResponses');
        //$CommunitiesResponses = 
		$CommunitiesResponses = $this->CommunitiesResponses->newEntity();
	//pr($CommunitiesResponses);die;
		// Data now looks like
        if ($this->request->is('post')) {
			$postedData = $this->request->data;

			//pr($postedData);die;
			$CommunitiesResponses = $this->CommunitiesResponses->patchEntity($CommunitiesResponses, $postedData);
			$CommunitiesResponses->user_id = $this->Auth->User('id');
			//pr($community);die;
			if ($this->CommunitiesResponses->save($CommunitiesResponses)) {
				$this->Flash->success(__('Your community response has been saved.'));
				return $this->redirect(['action' => 'view']);
			}
				
			$errdata='';
			if(count($CommunitiesResponses->errors())>0){
				foreach($CommunitiesResponses->errors() as $ind =>$value){
					$errdata .='<br/>';//pr($value);
					echo $errdata .= implode(",",array_values($value));
				}	
				$this->set('errorMsg',$errdata);//pr($community->errors());die;
			}		
			$this->Flash->error(__('Unable to add your community response.'));		
		}

        $this->set('CommunitiesResponses', $CommunitiesResponses);
    }

	public function response($id)
	{
		$postedData = $this->request->data;

		if(empty($id)){
			$id= $postedData['id'];
		}//die;
		
		$community = $this->Communities->findById($id)->firstOrFail();
				
		if ($this->request->is(['post', 'put'])) {
			$community = $this->Communities->patchEntity($community, $postedData);
			$community->user_id = $this->Auth->User('id');
			if ($this->Communities->save($community)) {
				$this->Flash->success(__('Your community details has been updated.'));
				return $this->redirect(['action' => 'edit', $id]);
			}
			$errdata='';

			if(count($community->errors())>0){
				foreach($community->errors() as $ind =>$value){
					$errdata .='<br/>';
					$errdata .= implode(",",array_values($value));
				}
				$this->set('errorMsg',$errdata);
			}
			$this->Flash->error(__('Unable to response.'));
		}									
		$this->set('community', $community);
	}
	
	
	public function allresponse($communityId)
	{
		

		$allPostsResponse =[];
		if(!empty($communityId)){
			$allPostsResponse = $this->Communities->find('all',[
					'conditions' => ['Communities.id' => $communityId]])->contain(['CommunitiesResponses'])->toArray();
		//	$allPostsResponse = $this->CommunitiesResponses->find('all',[
			//		'conditions' => ['CommunitiesResponses.community_id' => $communityId]])->contain(['Communities'])->toArray();

		}		//pr($allPostsResponse);die;
										
        $this->set(compact('allPostsResponse'));
	}
}

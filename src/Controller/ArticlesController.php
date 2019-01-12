<?php
// src/Controller/ArticlesController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\Network\Email\Email;

class ArticlesController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->session = $this->request->session();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }
	
	public function beforeFilter(Event $event) {

    //parent::beforeFilter($event);
	if($this->Auth->User('id')){
        $this->Auth->allow();
	
		}
		
    }

    public function index()
    {
         return $this->redirect(['action' => 'add']);

        $articles = $this->Paginator->paginate($this->Articles->find());
        $this->set(compact('articles'));
    }

    public function view($slug)
    {
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        $this->set(compact('article'));
    }

    public function add()
    {
		$this->set('errorMsg','');
        $article = $this->Articles->newEntity();			
		$fileuplodStatus=true;
		$policy_typeStatus=true;

        if ($this->request->is('post')) {
			$postedData = $this->request->data;
			if(isset($postedData['policy_type']) && count($postedData['policy_type'])>0){
				$postedData['policy_type'] = implode(",",$postedData['policy_type']);
				
			} else {
				$policy_typeStatus = false;
				
			}
				
			if(!empty($postedData['expiration_date']))
			$postedData['expiration_date'] = Date("Y-m-d",strtotime($postedData['expiration_date']));
									
			if(!empty($postedData['effective_date']))
			$postedData['effective_date'] = Date("Y-m-d",strtotime($postedData['effective_date']));
		
			if(isset($postedData['policy_path']['name']) && !empty($postedData['policy_path']['name'])){				
				$filename =  basename($postedData['policy_path']['name']);
				$tmp_name = $postedData['policy_path']["tmp_name"];
				$extFile = pathinfo($filename, PATHINFO_EXTENSION);
				$timestmpFilename = strtotime(Date('Y-m-d H:i:s')).".".$extFile;
				$destPath = WWW_ROOT.DS.'policyfiles'.DS.$timestmpFilename;
				$fileuplodSucess =  move_uploaded_file($tmp_name, $destPath);
				if($fileuplodSucess){			
					$postedData['policy_path'] = $timestmpFilename;
				}else{								
					$fileuplodStatus= false;
					
				}
			}
			if($policy_typeStatus===false || $fileuplodStatus===false){
					$this->set('errorMsg','Unable to add your policy .');
					$this->Flash->error(__('Unable to add your policy.'));

			} else {
				
				$article = $this->Articles->patchEntity($article, $postedData);
				$article->user_id = $this->Auth->User('id');
					if ($this->Articles->save($article)) {
					$this->Flash->success(__('Your policy details has been saved.'));
					return $this->redirect(['action' => 'add']);
				}			
			}			
			
            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            
			
						$this->set('errorMsg','Unable to add your policy .');

						$this->Flash->error(__('Unable to add your policy.'));
			}
			

			
        
        $this->set('article', $article);
		$articles = $this->Paginator->paginate($this->Articles->find('all', [
					'conditions' => ['Articles.user_id' => $this->Auth->User('id')]]));
        $this->set(compact('articles'));
    
    }
	
	
	public function edit($id)
	{
			$postedData = $this->request->data;
			$fileuplodStatus=true;
			$policy_typeStatus=true;
			if(empty($id)){
				$id= $postedData['id'];
			}//die;
			
			$article = $this->Articles->findById($id)->firstOrFail();
				
		if ($this->request->is(['post', 'put'])) {
			if(isset($postedData['policy_type']) && count($postedData['policy_type'])>0){		
				$postedData['policy_type'] = implode(",",$postedData['policy_type']);
				
			}else{
				$policy_typeStatus= false;
			}
		$postedData['expiration_date'] = Date("Y-m-d",strtotime($postedData['expiration_date']));//die;
		$postedData['effective_date'] = Date("Y-m-d",strtotime($postedData['effective_date']));
		if(isset($postedData['policy_path']['name']) && !empty($postedData['policy_path']['name'])){				
			$filename =  basename($postedData['policy_path']['name']);
			$tmp_name = $postedData['policy_path']["tmp_name"];
			$extFile = pathinfo($filename, PATHINFO_EXTENSION);
			$timestmpFilename = strtotime(Date('Y-m-d H:i:s')).".".$extFile;
			$destPath = WWW_ROOT.DS.'policyfiles'.DS.$timestmpFilename;
			$fileuplodSucess =  move_uploaded_file($tmp_name, $destPath);
				if($fileuplodSucess){			
					$postedData['policy_path'] = $timestmpFilename;
				}else{
					$fileuplodStatus= false;				
				}
			}
			
			if($policy_typeStatus===false || $fileuplodStatus===false){
				$this->set('errorMsg','Unable to add your policy .');
					$this->Flash->error(__('Unable to add your policy .'));

			}else{
				
				$article = $this->Articles->patchEntity($article, $postedData);
				//$article->id=
				$article->user_id = $this->Auth->User('id');
					if ($this->Articles->save($article)) {
					$this->Flash->success(__('Your policy details has been updated.'));
					return $this->redirect(['action' => 'edit',$id]);
				}
							$this->set('errorMsg','Unable to edit your policy .');

			}	

						
			
            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            
			

			$this->Flash->error(__('Unable to edit your policy.'));
			}
			
				
													
		    $this->set('article', $article);

    

		$articles = $this->Paginator->paginate($this->Articles->find('all', [
					'conditions' => ['Articles.user_id' => $this->Auth->User('id')]]));
        $this->set(compact('articles'));
	}
	
	
	public function download($filename=''){
	//$name= $_GET['nama'];
	if(!empty($filename)){
	$destPath = WWW_ROOT.DS.'policyfiles';
    header('Content-Description: File Transfer');
    header('Content-Type: application/force-download');
    header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\";");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));
    ob_clean();
    flush();
    readfile($destPath.DS.$filename); //showing the path to the server where the file is to be download
    exit;
	}
	}

}

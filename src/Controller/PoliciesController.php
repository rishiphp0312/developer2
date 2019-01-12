<?php
// src/Controller/PoliciesController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\Network\Email\Email;
use App\Model\Table\PolicyTypesTable;
use App\Model\Entity\PolicyType;


class PoliciesController extends AppController
{

    public function initialize()
    {
        parent::initialize();
		//Configure::write('debug', 0);

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

        $articles = $this->Paginator->paginate($this->Policies->find());
        $this->set(compact('articles'));
    }

    public function view($slug)
    {
        $article = $this->Policies->findBySlug($slug)->firstOrFail();
        $this->set(compact('article'));
    }

    public function add()
    {
		$this->set('errorMsg','');
        $article = $this->Policies->newEntity();
		$PolicyTypes = TableRegistry::get('PolicyTypes');
		
        //$PolicyTypes = $this->PolicyTypes->newEntity();			
		$fileuplodStatus=true;
		$policy_typeStatus=true;
		$selectListquery = $PolicyTypes->find('list',[		
							'keyField' => 'id',
							'valueField' => 'policy_name'	
		]);
		$selectListdata = $selectListquery->toArray();
		$this->set('selectListdata', $selectListdata);


		// Data now looks like

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
			 if($fileuplodStatus===false){
					//$this->set('errorMsg','File not uploaded .');
					$this->Flash->error(__('File not uploaded'));

			} else {
				//pr($postedData);die;
				$article = $this->Policies->patchEntity($article, $postedData);
				$article->user_id = $this->Auth->User('id');
				//pr($article);die;
					if ($this->Policies->save($article)) {
					$this->Flash->success(__('Your policy details has been saved.'));
					return $this->redirect(['action' => 'add']);
				}
					
						$errdata='';
			if(count($article->errors())>0){
			
			foreach($article->errors() as $ind =>$value){
				$errdata .='<br/>';//pr($value);
				echo $errdata .= implode(",",array_values($value));

			}	
							$this->set('errorMsg',$errdata);//pr($article->errors());die;

			}		

						$this->Flash->error(__('Unable to add your policy.'));	
			}			
			
            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            
			
						
			}
			

			
        
        $this->set('article', $article);
		$articles = $this->Paginator->paginate($this->Policies->find('all', [
					'conditions' => ['Policies.user_id' => $this->Auth->User('id')]]));
        $this->set(compact('articles'));
    
    }
	
	
	public function edit($id)
	{
			$postedData = $this->request->data;
			$fileuplodStatus=true;
			$policy_typeStatus=true;
					$PolicyTypes = TableRegistry::get('PolicyTypes');

			$selectListquery = $PolicyTypes->find('list',[		
							'keyField' => 'id',
							'valueField' => 'policy_name'	
		]);
		$selectListdata = $selectListquery->toArray();
		$this->set('selectListdata', $selectListdata);

			if(empty($id)){
				$id= $postedData['id'];
			}//die;
			
			$article = $this->Policies->findById($id)->firstOrFail();
				
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
				//$this->set('errorMsg','File not uploaded  .');
					$this->Flash->error(__('File not uploaded  .'));

			}else{
				
				$article = $this->Policies->patchEntity($article, $postedData);
				//$article->id=
				$article->user_id = $this->Auth->User('id');
					if ($this->Policies->save($article)) {
					$this->Flash->success(__('Your policy details has been updated.'));
					return $this->redirect(['action' => 'edit',$id]);
				}
						$errdata='';
			if(count($article->errors())>0){
			
			foreach($article->errors() as $ind =>$value){
				$errdata .='<br/>';
				$errdata .= implode(",",array_values($value));

			}	
							$this->set('errorMsg',$errdata);

			}		
										$this->Flash->error(__('Unable to edit your policy.'));


			}	

						
			
            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            
			

			}
			
				
													
		    $this->set('article', $article);

    

		$articles = $this->Paginator->paginate($this->Policies->find('all', [
					'conditions' => ['Policies.user_id' => $this->Auth->User('id')]]));
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

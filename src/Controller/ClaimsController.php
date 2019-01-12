<?php
// src/Controller/ClaimsController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\Network\Email\Email;
use App\Model\Table\ClaimTypesTable;
use App\Model\Entity\ClaimType;


class ClaimsController extends AppController
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
        $claims = $this->Paginator->paginate($this->Claims->find());
        $this->set(compact('claims'));
    }

    public function view($slug)
    {
        $claim = $this->Claims->findBySlug($slug)->firstOrFail();
        $this->set(compact('claim'));
    }

    public function add()
    {
		$this->set('errorMsg','');
        $claim = $this->Claims->newEntity();
		$ClaimTypes = TableRegistry::get('ClaimTypes');
		
        //$ClaimTypes = $this->ClaimTypes->newEntity();			
		$fileuplodStatus=true;
		//$claim_typeStatus=true;
		$selectListquery = $ClaimTypes->find('list',[		
							'keyField' => 'id',
							'valueField' => 'claim_name'	
		]);
		$selectListdata = $selectListquery->toArray();
		$this->set('selectListdata', $selectListdata);

		// Data now looks like
        if ($this->request->is('post')) {
			$postedData = $this->request->data;
			if(isset($postedData['claim_type']) && count($postedData['claim_type'])>0){
				$postedData['claim_type'] = implode(",",$postedData['claim_type']);
				
			} /*else {
				$claim_typeStatus = false;
			}*/
				
			if(!empty($postedData['loss_date']))
			$postedData['loss_date'] = Date("Y-m-d",strtotime($postedData['loss_date']));

			if(isset($postedData['claim_file']['name']) && !empty($postedData['claim_file']['name'])){			
				$filename =  basename($postedData['claim_file']['name']);
				$tmp_name = $postedData['claim_file']["tmp_name"];
				$extFile = pathinfo($filename, PATHINFO_EXTENSION);
				$timestmpFilename = strtotime(Date('Y-m-d H:i:s')).".".$extFile;
				$destPath = WWW_ROOT.DS.'claimfiles'.DS.$timestmpFilename;
				$fileuplodSucess =  move_uploaded_file($tmp_name, $destPath);
				if($fileuplodSucess){			
					$postedData['claim_file'] = $timestmpFilename;
				}else{								
					$fileuplodStatus= false;
				}
			}
			 if($fileuplodStatus===false){
					//$this->set('errorMsg','File not uploaded .');
					$this->Flash->error(__('File could not be uploaded.'));

			} else {
				//pr($postedData);die;
				$claim = $this->Claims->patchEntity($claim, $postedData);
				$claim->user_id = $this->Auth->User('id');
				//pr($claim);die;
				if ($this->Claims->save($claim)) {
					$this->Flash->success(__('Your claim details has been saved.'));
					return $this->redirect(['action' => 'add']);
				}
					
				$errdata='';
				if(count($claim->errors())>0){
					foreach($claim->errors() as $ind =>$value){
						$errdata .='<br/>';//pr($value);
						echo $errdata .= implode(",",array_values($value));
					}	
					$this->set('errorMsg',$errdata);//pr($claim->errors());die;
				}		
				$this->Flash->error(__('Unable to add your claim.'));	
			}
            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.		
		}

        $this->set('claim', $claim);
		$claims = $this->Paginator->paginate($this->Claims->find('all', [
					'conditions' => ['Claims.user_id' => $this->Auth->User('id')]]));
        $this->set(compact('claims'));
    }

	public function edit($id)
	{
		$postedData = $this->request->data;
		$fileuplodStatus=true;
		//$claim_typeStatus=true;
		$ClaimTypes = TableRegistry::get('ClaimTypes');

		$selectListquery = $ClaimTypes->find('list',[		
						'keyField' => 'id',
						'valueField' => 'claim_name'	
		]);
		$selectListdata = $selectListquery->toArray();
		$this->set('selectListdata', $selectListdata);

		if(empty($id)){
			$id= $postedData['id'];
		}//die;
		
		$claim = $this->Claims->findById($id)->firstOrFail();
				
		if ($this->request->is(['post', 'put'])) {
			if(isset($postedData['claim_type']) && count($postedData['claim_type'])>0){	
				$postedData['claim_type'] = implode(",",$postedData['claim_type']);
			}/*else{
				$claim_typeStatus= false;
			}*/
			
			//echo '---> '.$postedData['claim_type']; die;
			
			if(!empty($postedData['loss_date']))
				$postedData['loss_date'] = Date("Y-m-d",strtotime($postedData['loss_date'])); //die;

			if(isset($postedData['claim_file']['name']) && !empty($postedData['claim_file']['name'])){	
				$filename =  basename($postedData['claim_file']['name']);
				$tmp_name = $postedData['claim_file']["tmp_name"];
				$extFile = pathinfo($filename, PATHINFO_EXTENSION);
				$timestmpFilename = strtotime(Date('Y-m-d H:i:s')).".".$extFile;
				$destPath = WWW_ROOT.DS.'claimfiles'.DS.$timestmpFilename;
				$fileuplodSucess =  move_uploaded_file($tmp_name, $destPath);
				if($fileuplodSucess){			
					$postedData['claim_file'] = $timestmpFilename;
				}else{
					$fileuplodStatus= false;				
				}
			}

			if($fileuplodStatus===false){
			//if($claim_typeStatus===false || $fileuplodStatus===false){
				//$this->set('errorMsg','File not uploaded  .');
				$this->Flash->error(__('File could not be uploaded.'));
			}else{
				$claim = $this->Claims->patchEntity($claim, $postedData);
				//$claim->id=
				$claim->user_id = $this->Auth->User('id');
				if ($this->Claims->save($claim)) {
					$this->Flash->success(__('Your claim details has been updated.'));
					return $this->redirect(['action' => 'edit',$id]);
				}
				$errdata='';

				if(count($claim->errors())>0){
					foreach($claim->errors() as $ind =>$value){
						$errdata .='<br/>';
						$errdata .= implode(",",array_values($value));
					}
					$this->set('errorMsg',$errdata);
				}
				$this->Flash->error(__('Unable to edit your claim.'));
			}
			// Hardcoding the user_id is temporary, and will be removed later
			// when we build authentication out.
		}									
		$this->set('claim', $claim);
		$claims = $this->Paginator->paginate($this->Claims->find('all', [
					'conditions' => ['Claims.user_id' => $this->Auth->User('id')]]));
        $this->set(compact('claims'));
	}

	public function delete($id)
	{
		$this->request->allowMethod(['post', 'delete']);
		$claim = $this->Claims->get($id);
		if ($this->Claims->delete($claim)) {
			$this->Flash->success(__('The claim with id: {0} has been deleted.', h($id)));
			return $this->redirect(['action' => 'index']);
		}
	}

	public function download($filename=''){
		//$name= $_GET['nama'];
		if(!empty($filename)){
			$destPath = WWW_ROOT.DS.'claimfiles';
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

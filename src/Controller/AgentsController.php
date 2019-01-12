<?php
namespace App\Controller;
use Cake\Core\Configure;
use App\Controller\AppController;

class AgentsController extends AppController{

    // $uses is where you specify which models this controller uses
   // var $uses = array('agent');
	
	public function initialize()
    {	
		parent::initialize();
		Configure::write('debug', 1);
                
		$this->loadComponent('Flash'); // Include the FlashComponent
		// Auth component allow visitors to access add action to register and access logout action 
		if($this->Auth->User('id')){
			$this->Auth->allow(['logout', 'edit']);
	
		}else{
			$this->Auth->allow(['logout', 'add']);
		}
    }
	
	public function dashboard()
	{
		
	}
	
	public function login()
	{
		if ($this->request->is('post')) {
			// Auth component identify if sent user data belongs to a user
			$agent = $this->Auth->identify();
			if ($agent) {
				$this->Auth->setUser($agent);
				return $this->redirect(['action'=>'edit']);
			}
			$this->Flash->error(__('Invalid agentname or password, try again.'));
		}
	}
	
	public function logout(){
		$this->request->session()->destroy();
		$this->Flash->success('You successfully have loged out');	
		return $this->redirect(['action'=>'login']);
	}

	public function view($id)
	{
		$agent = $this->Agents->get($id);
		$this->set('agent',$agent);
	}
	
	public function index()
	{
		$this->set('agent',$this->Agents->find('all'));		
	}
	
	public function add()
	{
		$agent = $this->Agents->newEntity();
		if($this->request->is('post')) {
			$this->Agents->patchEntity($agent, $this->request->data);
			if($this->Agents->save($agent)){
				$this->Flash->success(__('Your account has been registered .'));
				return $this->redirect(['action' => 'index']);
			}

			$errdata='';
			if(count($agent->errors())>0){
				foreach($agent->errors() as $ind =>$value){
					$errdata .='<br/>';
					$errdata .= implode(",",array_values($value));
				}
				$this->set('errorMsg',$errdata);
			}		
			$this->Flash->error(__('Unable to register your account.'));
		}
		$this->set('agent',$agent);
	}
	public function edit()
	{
		$id = $this->Auth->User('id');
		$agent = $this->Agents->get($id);
		if ($this->request->is(['post', 'put'])) {
			$this->Agents->patchEntity($agent, $this->request->data);
			//pr($agent->errors());die;
			if ($this->Agents->save($agent)) {
				$this->Flash->success(__('Your profile data has been updated.'));
				return $this->redirect(['action' => 'index']);
			}
			$errdata='';
			if(count($agent->errors())>0){
				foreach($agent->errors() as $ind =>$value){
					$errdata .='<br/>';
					$errdata .= implode(",",array_values($value));

				}	
				$this->set('errorMsg',$errdata);
			}			
			$this->Flash->error(__('Unable to update your profile .'));
		}
		$this->set('agent', $agent);
	}
	public function delete($id)
	{
		$this->request->allowMethod(['post', 'delete']);
		$agent = $this->Agents->get($id);
		if ($this->Agents->delete($agent)) {
			$this->Flash->success(__('The agent with id: {0} has been deleted.', h($id)));
			return $this->redirect(['action' => 'index']);
		}		
		
	}

	/*public function beforeFilter(Event $event) {    
		$this->Auth->allow(['login']);
	}*/
}
?>
<?php
namespace App\Controller;
use Cake\Core\Configure;
use App\Controller\AppController;

class UsersController extends AppController{

    public function initialize()
    {	
		parent::initialize();
		Configure::write('debug', 1);
                
		$this->loadComponent('Flash'); // Include the FlashComponent
		// Auth component allow visitors to access add action to register  and access logout action 
		if($this->Auth->User('id')){
			$this->Auth->allow(['logout', 'edit', 'dashboard']);
	
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
			$user = $this->Auth->identify();
			if ($user) {
				$this->Auth->setUser($user);
				return $this->redirect(['action'=>'dashboard']);
			}
			$this->Flash->error(__('Invalid username or password, try again.'));
		}
	}
	
	public function logout(){
		$this->request->session()->destroy();
		$this->Flash->success('You successfully have loged out');	
		return $this->redirect(['action'=>'login']);
	}
	
	public function index()
	{
		$this->set('users',$this->Users->find('all'));		
	}
	
	public function view($id)
	{
		$user = $this->Users->get($id);
		$this->set('user',$user);
	}
	
	public function add()
	{
		$user = $this->Users->newEntity();
		if($this->request->is('post')) {
			$this->Users->patchEntity($user, $this->request->data);
			if($this->Users->save($user)){
				$this->Flash->success(__('Your account has been registered .'));
				return $this->redirect(['action' => 'index']);
			}

			$errdata='';
			if(count($user->errors())>0){
				foreach($user->errors() as $ind =>$value){
					$errdata .='<br/>';
					$errdata .= implode(",",array_values($value));
				}
				$this->set('errorMsg',$errdata);
			}		
			$this->Flash->error(__('Unable to register your account.'));
		}
		$this->set('user',$user);
	}
	
	public function edit()
	{
		$id = $this->Auth->User('id');
		$user = $this->Users->get($id);
		if ($this->request->is(['post', 'put'])) {
			$this->Users->patchEntity($user, $this->request->data);
			//pr($user->errors());die;
			if ($this->Users->save($user)) {
				$this->Flash->success(__('Your profile data has been updated.'));
				return $this->redirect(['action' => 'index']);
			}
			$errdata='';
			if(count($user->errors())>0){
				foreach($user->errors() as $ind =>$value){
					$errdata .='<br/>';
					$errdata .= implode(",",array_values($value));

				}	
				$this->set('errorMsg',$errdata);
			}			
			$this->Flash->error(__('Unable to update your profile .'));
		}
		$this->set('user', $user);
	}
	
	public function delete($id)
	{
		$this->request->allowMethod(['post', 'delete']);
	
		$user = $this->Users->get($id);
		if ($this->Users->delete($user)) {
			$this->Flash->success(__('The user with id: {0} has been deleted.', h($id)));
			return $this->redirect(['action' => 'index']);
		}		
		
	}	
}
?>
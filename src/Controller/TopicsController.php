<?php 

namespace App\Controller;

use App\Controller\AppController;
use Cake\Cache\Cache;
class TopicsController extends AppController
{

    public function initialize()
    {

        parent::initialize();

        $this->loadComponent('Flash'); // Include the FlashComponent

				
    }
	public function isAuthorized($user)
	{
		$action = $this->request->params['action'];
		//  registered users can add topics and view index
		if (in_array($action, ['index', 'add','topics'])) {
		return true;
		}
		// All other actions require an id or users cannot do it 
		if (empty($this->request->params['pass'][0])) {
			return false;
		}		
		
		// The owner of a topic can edit and delete it
		// the owner of topic is known by its id and user_id value of topic .
		if (in_array($this->request->action, ['edit', 'delete'])) {
		// get topic id from the request 	
		$topicId = (int)$this->request->params['pass'][0];
		// check if the topic is owned by the user 
		if ($this->Topics->isOwnedBy($topicId, $user['id'])) {
		return true;
		}
		}
		return parent::isAuthorized($user);


	}

    public function index()
    {
		// find('all') get all records from Topics model
		// We uses set() to pass data to view 
        $this->set('topics', $this->Topics->find('all'));
    }

    public function view($id)
    {
		// get() method get only one topic record using 
		// the $id paraameter is received from the requested url 
		// if request is /topics/view/5   the $id parameter value is 3
        $topic = $this->Topics->get($id);
        $this->set(compact('topic'));
    }

    public function add()
    {
        $topic = $this->Topics->newEntity();
		//if the user topics data to your application, the POST request  informations are registered in $this->request   
        if ($this->request->is('post')) { // 
            $topic = $this->Topics->patchEntity($topic, $this->request->data);
			$topic->user_id = $this->Auth->user('id');
            if ($this->Topics->save($topic)) {
				// success() method of FlashComponent restore messages in session variable.
				// Flash messages are displayed in views 
                $this->Flash->success(__('Your topic has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your topic.'));
        }
        $this->set('topic', $topic);
    }
	public function edit($id = null)
	{
		$topic = $this->Topics->get($id);
		if ($this->request->is(['post', 'put'])) {
			$this->Topics->patchEntity($topic, $this->request->data);
			if ($this->Topics->save($topic)) {
				$this->Flash->success(__('Your topic has been updated.'));
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('Unable to update your topic.'));
		}
	
		$this->set('topic', $topic);
	}
	public function delete($id)
	{
		//if user wants to delete a record by a GET request ,allowMethod() method give an Exception as the only available request for deleting is POST
		$this->request->allowMethod(['post', 'delete']);
	
		$topic = $this->Topics->get($id);
		if ($this->Topics->delete($topic)) {
			$this->Flash->success(__('The topic with id: {0} has been deleted.', h($id)));
			return $this->redirect(['action' => 'index']);
		}
	}
}
?>
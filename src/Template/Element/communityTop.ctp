 <ul class="innerHeadButtons">
				<li><?php echo $this->Html->link('View Posts', array('controller' => 'communities', 'action' => 'view'));?></li>
				<li><?php echo $this->Html->link('My Posts', array('controller' => 'communities', 'action' => 'your_post'));?></li>
				<li><?php echo $this->Html->link('My Responses', array('controller' => 'communities', 'action' => 'your_responses'));?></li>
				<li><?php echo $this->Html->link('My Likes', array('controller' => 'communities', 'action' => 'your_likes'));?></li>
				<li><?php echo $this->Html->link('Add Posts', array('controller' => 'communities', 'action' => 'add'));?></li>
			  </ul>
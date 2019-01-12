<div class="col-md-2 leftMenuArea">
	<ul>
		<li><a href="#user_dashboard.php">User Dashboard</a></li>
		<li>			<?php echo	$this->Html->link('Update Profile Step One', 
									array('controller' => 'users', 'action' => 'edit')); 
			?>
									
									
									</li>
									<li><?php echo	$this->Html->link('Add Policy One', array('controller' => 'policies', 'action' => 'add')); 
			?></li>
		<li><a href="#add_policy_two.php">Add Policy Two</a></li>
		<li><a href="#user_sumarry.php">User Summary</a></li>
		<li><a href="#claim_summaries.php">Claim Summaries</a></li>
		<li><a href="#talk_to_an_expert.php">Talk to an Expert</a></li>
		<li><a href="#community_forum_post.php">Community Forum Post</a></li>
		<li><a href="#community_forum_respond.php">Community Forum Respond</a></li>
					<?php  if ($this->request->session()->read('Auth.User')){ ?>
					<li>
					<?=$this->Html->Link(__('Log out'),['controller'=>'users','action'=>'logout']) ?>  </li>
	<?php }else{  ?><li>
		 <?=$this->Html->Link(__('Login'),['controller'=>'users','action'=>'login']) ?>  

				</li>				<?php } ?>
	</ul>
</div>


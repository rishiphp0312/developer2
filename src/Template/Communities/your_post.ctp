	
<div class="col-md-10 rightAreaInner">
   <div class="updateProfileBox">
	  <div class="row">
		<div class="col-md-12">
		   <?php 
				echo $this->element('communityTop');
			?>
			
		</div>
	  </div>
	<h3>My Posts<span style="font-size:15px;text-align:right;width:100%;color:red;"><?php if(isset($errorMsg)){ echo  $errorMsg;} ?></span></h3>
	  <!--View All Posts table -->
		  <div class="table-responsvie">
			<table class="table table-bordered">
			  <thead>
				<tr>
				  <th>S No.</th>
				  <th>subject</th>
				  <th>Details</th>
				  <th>Likes</th>
				  <th>Responses</th>
				  <th>Want to Send a Response</th>
				</tr>
			  </thead>
			  <tbody>
			  
			<?php 
			$sNo = 1;
			foreach ($allPosts as $communityPost):
			?>
				<tr>
				  <td><?php echo $sNo;?></td>
				  <td><?php echo $this->Html->link($communityPost->subject, array('controller' => 'communities', 'action' => 'allresponse', $communityPost->id));?></td>

				  <td><?php echo $communityPost->details;?></td>
				  <td><?php 
				  if(isset($communityPost['communities_likes']) && count($communityPost['communities_likes'])>0) 
					echo  count($communityPost['communities_likes']) ;
				  else 
					echo '0';
				  ?></td>
				   <td><?php 
				  if(isset($communityPost['communities_responses']) && count($communityPost['communities_responses'])>0) 
					echo  count($communityPost['communities_responses']) ;
				  else 
					echo '0';
				  ?></td>
				  <td><?php echo $this->Html->link('Post Respons', array('controller' => 'communities', 'action' => 'response', $communityPost->id));?></td>
				</tr>
			<?php 
			$sNo++;
			endforeach;
			?>
			
			  </tbody>
			</table>
		  </div>
		  <!--View All Posts table ends -->

	   </div>
	 </div>
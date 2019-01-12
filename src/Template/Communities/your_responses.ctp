	
<div class="col-md-10 rightAreaInner">
   <div class="updateProfileBox">
	  <div class="row">
		<div class="col-md-12">
		   <?php 
				echo $this->element('communityTop');
			?>
			
		</div>
	  </div>
	<h3>My Responses<span style="font-size:15px;text-align:right;width:100%;color:red;"><?php if(isset($errorMsg)){ echo  $errorMsg;} ?></span></h3>
	  <!--View All Posts table -->
	  			                <div class="panel-heading" style="color:green;font-size:15px;" ><?php echo  $this->Flash->render() ?></div>

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
			foreach ($myResponse as $communityPost):
			?>
				<tr>
				  <td><?php echo $sNo;?></td>
				   <td><?php echo $this->Html->link($communityPost['subject'], array('controller' => 'communities', 'action' => 'allresponse', $communityPost['community_id']));?></td>

				  <td><?php echo $communityPost['details'];?></td>
				  <td><?php echo $communityPost['countLikes'];?></td>
				  				  <td><?php echo $communityPost['countResponse'];?></td>

				  <td><?php echo $this->Html->link('Post Response', array('controller' => 'communities', 'action' => 'response', $communityPost['community_id']));?></td>
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
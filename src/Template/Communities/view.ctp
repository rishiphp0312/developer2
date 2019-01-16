	
<div class="col-md-10 rightAreaInner">
   <div class="updateProfileBox">
	  <div class="row">
		<div class="col-md-12">
		  <?php 
				echo $this->element('communityTop');
			?>
			
		</div>
	  </div>
	<h3>View All Posts<span style="font-size:15px;text-align:right;width:100%;color:red;"><?php if(isset($errorMsg)){ echo  $errorMsg;} ?></span></h3>
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
			foreach ($allPosts as $communityPost):
			
			?>
				<tr>
				  <td><?php echo $sNo;?></td>
				  				  <td>
								
								  <a href="#" class="modalClassAjax"  id="<?php echo $communityPost->id?>" > <?php echo $communityPost->subject.'==';?></a>
								  <?php 
								  
	/*							  
								  echo $this->Html->link(
   $communityPost->subject,
    array(
	
        'controller'=>'',
        'action'=>'',
       // $page['StaticPage']['id']
    ),
    array(
        'rel'                 => 'modal:open'
        )
);*/
								  //echo $this->Html->link($communityPost->subject,array('rel'=>'modal:open'));
								  
								  //array('controller' => 'communities', 'action' => 'allresponse', $communityPost->id)
								  ?></td>

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
				  
				  <td><?php echo $this->Html->link('Post Response', array('controller' => 'communities', 'action' => 'response', $communityPost->id));?></td>
				</tr>
			<?php 
			$sNo++;
			endforeach;
			?>
			
			  </tbody>
			</table>
		  </div>
		  <!--View All Posts table ends -->

<!-- Link to open the modal -->
	   </div>
	 </div>
	 

<!-- The Modal -->
<style>
.modal a.close-modal{width: 17%;
    height: 20%;}
</style>
<div class="modal" >
  
</div>
<!--
<div id="ex1" class="modal">
  <p>Thanks for clicking. That felt good.</p>
  <a href="#" rel="modal:close">Close</a>
</div>-->
<script>
$('.modalClassAjax').click(function(event) {
  event.preventDefault();
  var commId =$(this).attr('id');
  var comUrl = '<?php echo $this->Url->build(["controller" => "Communities",  "action" => "allresponse"]);?>';
  alert(comUrl+'/'+commId);
  //this.blur(); // Manually remove focus from clicked link.
  $.get(comUrl+'/'+commId
  , function(html) {
  alert(html);
  var dataHtml = $('#ajax-content').html(html);  alert($('#ajax-content').html());

    $(dataHtml).appendTo('body').modal();
	//$('#ajax-content').remove();
  });
});
</script>

<div id="ajax-content"></div>
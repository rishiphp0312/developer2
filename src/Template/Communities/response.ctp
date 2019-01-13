<!-- File: src/Template/Communities/response.ctp -->
<script>
$(function() {

$('#linkforLikeId').click(function(event) { 
    event.preventDefault(); 
	var comId = $("#comId").val();
	//alert(comId);
	$.ajax({
	  type: "GET",
	  url: "/communities/addlike/"+comId,
	  url: '<?php echo $this->Url->build([
    "controller" => "Communities",
    "action" => "addlike",
    $community->id,
]);
?>',
	  //data: comId,
	  cache: false,
	  success: function(data){
	  alert('You Liked It');
		 $("#resultarea").text(data);
		 $("#linkforLikeId").remove();
	  }
	});
    return false; // for good measure
});

	// validate CommunityResponse form on submit
	$("#CommunityResponse").validate({
		rules: {
			response: {
				required: true
			}
		},
		messages: {
			response: "Please enter Response."
		}
	});
});
</script>
		<div class="col-md-10 rightAreaInner">
           <div class="signUpBox">
		   
		   <div class="row">
			<div class="col-md-12">
			  <?php 
				echo $this->element('communityTop');
			?>
			
			</div>
		  </div>
		   
		   <h3>User Respond</h3>
            <div class="panel panel-default">
			                <div class="panel-heading" style="color:green;font-size:15px;" ><?php echo  $this->Flash->render() ?></div>
			                <div style="color:green;font-size:15px;text-align:right;" >
							<!-- <a href="#" id="linkforLikeId">Like It </a> -->
							<span style="color:green;text-align:right;" >
		  
					<?php
		  
						if($numRowsLiked>0)
							echo "You Liked It";
					else
				  echo $this->Html->link('Like It', array('controller' => 'communities', 'action' => 'addlike', $community->id),
				  
				      ['id'=>'linkforLikeId']

				  );?>

				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>

              <div class="panel-body">
			<?php echo $this->Form->create('', ['id'=>'CommunityResponse', 'url' => ['action' => 'addresponse']]);?>
              <div class="form-group"><input type="text" id="comId" value="<?php echo $community->id;?>">
                <label class="control-label col-sm-3" for="email">Subject:</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                  	<?php echo $community->subject;?>
				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  </br>(Total Like = <span id="resultarea" ><?php echo $numRowsLiked;?>)</span>							
				  				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

				  (Total Reply = <?php echo $numRowsResponses;?>)
                </div>
              </div>
			  <div class="form-group">
                <label class="control-label col-sm-3" for="email">Details:</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
					<?php echo $community->details;?>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="email">Reply:</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
					<input type="hidden" value="<?php echo $community->id;?>" name="community_id">
					<textarea name="response" id="response" rows="6" cols="52"></textarea>
                </div>
              </div>
               <div class="form-group">
                <div class="col-md-12 text-right">
				  <button type="submit" class="btn btn-primary">Reply</button>
                </div>
              </div>
			<?php echo $this->Form->end();?>
			</div>
            </div>
		 </div>
         </div>
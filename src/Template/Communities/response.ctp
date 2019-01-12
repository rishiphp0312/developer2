<!-- File: src/Template/Communities/response.ctp -->
<script>
$(function() {
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

              <div class="panel-body">
			<?php echo $this->Form->create('', ['id'=>'CommunityResponse', 'url' => ['action' => 'addresponse']]);?>
              <div class="form-group">
                <label class="control-label col-sm-3" for="email">Subject:</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                  	<?php echo $community->subject;?>
				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  </br>(Total Like = <?php echo $community->like;?>)
				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  (Total Reply = <?php echo $community->reply;?>)
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
                  <button type="submit" class="btn btn-primary">Like</button>
				  <button type="submit" class="btn btn-primary">Reply</button>
                </div>
              </div>
			<?php echo $this->Form->end();?>
			</div>
            </div>
		 </div>
         </div>
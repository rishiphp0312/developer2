<!-- File: src/Template/Communities/post.ctp -->
<script>
$(function() {
	// validate CommunityPost form on submit
	$("#CommunityPost").validate({
		rules: {
			subject: {
				required: true
			},
			details: {
				required: true
			}
		},
		messages: {
			subject: "Please enter Subject.",								
			details: "Please enter Details."
		}
	});
});
</script>
		<div class="col-md-10 rightAreaInner">
           <div class="signUpBox">
		   <h3><span style="font-size:15px;text-align:right;width:100%;color:red;">
<?php if(isset($errorMsg)){
echo  $errorMsg;
	}	
	?></span></h3>
		   <div class="row">
			<div class="col-md-12">
			 <?php 
				echo $this->element('communityTop');
			?>
			</div>
		  </div>

		   <h3>Community Post</h3>
            <div class="panel panel-default">
              <div class="panel-heading">Some Title Related to Community Post</div>
              <div class="panel-body">
				<?php echo $this->Form->create('', ['id'=>'CommunityPost', 'url' => ['action' => 'add']]);?>
				  <div class="form-group">
					<label class="control-label col-sm-3" for="email">Subject:</label>
					<div class="col-sm-9 col-md-9 col-lg-8">
					  <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter Subject">
					</div>
				  </div>
				  <div class="form-group">
					<label class="control-label col-sm-3" for="email">Details:</label>
					<div class="col-sm-9 col-md-9 col-lg-9">
						<textarea name="details" id="details" rows="6" cols="52"></textarea>
					</div>
				  </div>
				   <div class="form-group">
					<div class="col-md-11 text-right">
					  <button type="submit" class="btn btn-primary">Post</button>
					</div>
				  </div>
				<?php echo $this->Form->end();?>
			</div>
            </div>
		 </div>
         </div>
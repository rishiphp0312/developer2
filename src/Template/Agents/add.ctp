<script>
$( function() {
	// validate signup form on keyup and submit
	$("#UserForm").validate({
		rules: {
			email: {
				required: true,
				email: true
			},
			password: {
				required: true,
				minlength: 5
			},
			cnfpassword: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			}
		},
		messages: {
			email: "Please enter a valid email address",
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			confirm_password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			}
		}
	});	
});
</script>
		<div class="col-md-12">
           <div class="signUpBox">
		   <h3>User Registration</h3>
		   <h3><span style="font-size:15px;text-align:right;width:100%;color:red;"><?php if(isset($errorMsg)){ echo  $errorMsg;} ?></span></h3>
            <div class="panel panel-default">
              <div class="panel-heading" style="color:green;font-size:15px;" ><?php echo  $this->Flash->render() ?></div>
              <div class="panel-body">
			<?php 
			echo $this->Form->create($user ,['type' => 'file','id'=>'UserForm']);
			echo $this->Flash->render('auth');
			?>
              <div class="form-group vertical-center">
                <label class="control-label col-sm-4" for="email">Email: <span class="labelComment">(We will send you an email to confirm the address)</span>
				</label>
                <div class="col-sm-9  col-md-9 col-lg-8">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="Password">Password:</label>
                <div class="col-sm-9 col-md-9 col-lg-8">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="Confirm Password">Confirm Password:</label>
                <div class="col-sm-9 col-md-9 col-lg-8">
                  <input type="password" class="form-control" name="cnfpassword" id="cnfpassword" placeholder="Enter confirm password">
                </div>
              </div>
               <div class="form-group">
				<div class="col-md-12 text-right">
                  <button type="submit" class="btn btn-primary">Register</button>
                </div>
              </div>
            <?php echo $this->Form->end();?>
			  </div>
              </div>
			</div>
         </div>
<?php echo $this->Form->create($user ,['type' => 'file','id'=>'UserForm']);
 echo $this->Flash->render('auth');

   ?>

<script>
	
  $( function() {
		// validate the comment form when it is submitted

		// validate signup form on keyup and submit
		$("#UserForm").validate({
			rules: {
				name: "required"				
				,
				email: {
					required: true,
					email: true
				}
				,address: {
					required: true
				}
				,			
				city: {
					required: true
				}
				,
				state: {
					required: true
				}
				,
				zip: {
					required: true,
					number:true
				}
				
			},
			messages: {
				name: "Please enter your name",
				email: "Please enter a valid email address",
				address: "Please enter  address",
				city: "Please enter  city",
				state: "Please enter  state",
				zip: {
						required:"Please enter  zip",
						number:"Please enter number only for  zip"
				}
			}
		});

		

		
	});
	
	/*$.validator.addMethod("integer", function(value, element) {
	return this.optional(element) || /^-?\d+$/.test(value);
}, "A positive or negative non-decimal number please");
*/
	</script>
<div class="col-md-10 rightAreaInner">
           <div class="signUpBox">
		   <h3>User Registration<span style="font-size:15px;text-align:right;width:100%;color:red;">
<?php if(isset($errorMsg)){
echo  $errorMsg;

	}	
	?></span></h3>
            <div class="panel panel-default">
			                  <div class="panel-heading" style="color:green;font-size:15px;" ><?php echo  $this->Flash->render() ?></div>
              <div class="panel-body">
              <div class="form-group">
                <label class="control-label col-sm-3" for="email">Name:</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                  <input type="text" class="form-control" id="name" name="name" placeholder="" value="<?php  echo  $user->name;?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="email">Email:</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                  <input type="email" class="form-control" id="email" name="email" placeholder="" value="<?php  echo  $user->email;?>">
                </div>
              </div>
              <!--<div class="form-group">
                <label class="control-label col-sm-3" for="pwd">Password:</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                  <input type="password" class="form-control" name="password" id="pwd" placeholder="Enter password">
                </div>
              </div>
            -->
              <div class="form-group">
                <label class="control-label col-sm-3" for="pwd">Account Type </label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <label class="radio-inline">
                    <input type="radio" name="account_type"  <?php  if($user->account_type=='individual') echo "checked";?> value="individual" >Individual
                    </label>
                    <label class="radio-inline">
                    <input type="radio" name="account_type" <?php if ($user->account_type=='business') echo "checked";?> value="business">Business Owner
                    </label>
                </div>
              </div>
               <div class="form-group">
				<div class="col-md-12 text-right">
                </div>
              </div>
			  </div>
              </div>
			
            <div class="panel panel-default">
              <div class="panel-body">
              <div class="form-group">
                <label class="control-label col-sm-3" for="email">Address:</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                  <input type="text" class="form-control" name="address" id="address" placeholder="" value="<?php  echo  $user->address;?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="city">City:</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                  <input type="text" class="form-control" name="city" id="city" placeholder="" value="<?php  echo  $user->city;?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="state">State:</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                  <input type="text" class="form-control" id="state" name="state" placeholder="" value="<?php  echo  $user->state;?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="zip">Zip:</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                  <input  class="form-control" id="zip" name="zip" type="text"  value="<?php  echo  $user->zip;?>">
                </div>
              </div>
               <div class="form-group">
				<div class="col-md-12 text-right">
                </div>
              </div>
			  
			</div>
			            </div>

			<div class="panel panel-default">
              <div class="panel-body">
              <div class="form-group">
                <label class="control-label col-sm-5" for="how_many_homes">How many homes do you own:</label>
                <div class="col-sm-9 col-md-9 col-lg-7">
                  <input type="number" min="0" class="form-control" id="how_many_homes"  name="how_many_homes" placeholder="" 
				  value="<?php  echo  $user->how_many_homes;?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-5" for="how_many_cars">How many cars do you own:</label>
                <div class="col-sm-9 col-md-9 col-lg-7">
                  <input type="number" min="0" class="form-control" id="how_many_cars"  name="how_many_cars" placeholder=""
				  value="<?php  echo  $user->how_many_cars;?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-5" for="boat_exists">Do you own a boat:</label>
                
				
				<div class="col-sm-9 col-md-9 col-lg-7">
					<label class="radio-inline">
                    <input type="radio" name="boat_exists"  <?php  if($user->boat_exists=='1') echo "checked";?> value="1">Yes
                    </label>
                    <label class="radio-inline">
                    <input type="radio" name="boat_exists" <?php  if($user->boat_exists=='0') echo "checked";?> value="0">No
                    </label>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-5" for="married">Are you married:</label>
                <div class="col-sm-9 col-md-9 col-lg-7">
					<label class="radio-inline">
                    <input type="radio" name="married" value="1"  <?php  if($user->married=='1') echo "checked";?>>Yes
                    </label>
                    <label class="radio-inline">
                    <input type="radio" name="married"  <?php  if($user->married=='0') echo "checked";?>  value="0" >No
                    </label>
                </div>
              </div>
			  <div class="form-group">
                <label class="control-label col-sm-5" for="how_many_children">How many children do you have:</label>
                <div class="col-sm-9 col-md-9 col-lg-7">
                  <input type="number" min="0" class="form-control" id="how_many_children"  name="how_many_children" placeholder=""
				  				  value="<?php  echo  $user->how_many_children;?>">

                </div>
              </div>
			  <div class="form-group">
                <label class="control-label col-sm-5" for="pwd">Do you own a small business:</label>
                <div class="col-sm-9 col-md-9 col-lg-7">
					<label class="radio-inline">
                    <input type="radio" name="small_business_exists" <?php  if($user->small_business_exists=='1') echo "checked";?> value="1">Yes
                    </label>
                    <label class="radio-inline">
                    <input type="radio" name="small_business_exists" <?php  if($user->small_business_exists=='0') echo "checked";?>  value="0">No
                    </label>
                </div>
              </div>
			  <div class="form-group">
                <label class="control-label col-sm-5" for="business_name">Business Name:</label>
                <div class="col-sm-9 col-md-9 col-lg-7">
                  <input type="text" class="form-control" name="business_name" id="business_name" placeholder="" 				  				  value="<?php  echo  $user->business_name;?>">

                </div>
              </div>
               <div class="form-group">
                <div class="col-md-12 text-right">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
			</div>
            </div>
			
		 </div>
         </div>   <?php  echo $this->Form->end();?>

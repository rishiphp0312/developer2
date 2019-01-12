<!-- File: src/Template/Articles/add.ctp -->
<?php echo $this->Form->create($article ,['type' => 'file','id'=>'ArticleForm']);

   ?>
<script>
  $( function() {
    $( "#expiration_date" ).datepicker();
    $( "#effective_date" ).datepicker(); 

	// validate the comment form when it is submitted

		// validate signup form on keyup and submit
		$("#ArticleForm").validate({
			rules: {
				carrier: "required",			
				
				policy_number: {
					required: true
				}
				,expiration_date: {
					required: true
				}
				,			
				effective_date: {
					required: true
				}
				,
				policy_premium: {
					required: true

				}
				
				
			},
			messages: {
				carrier: "Please enter your carrier",								
				policy_number: "Please enter a policy number",
				address: "Please enter  address",
				expiration_date: "Please enter  expiration date",
				effective_date: "Please enter  effective date",
				policy_premium: "Please enter  premium "
			}
		});
	});
	
	
    
	</script>
<div class="col-md-10 rightAreaInner">
           <div class="updateProfileBox">
              <div class="row">
                <div class="col-md-12">
                  <ul class="innerHeadButtons">
                    <li><a href="#">Update Profile</a></li>
                    <li><a href="#">Add Policies</a></li>
                    <li><a href="#">Add Claims</a></li>
                  </ul>
                </div>
              </div>
				<h3>Add Policy<span style="font-size:15px;text-align:right;width:100%;color:red;">
<?php if(isset($errorMsg)){
echo  $errorMsg;
	}	
	?></span></h3>
              <div class="panel panel-default">
                <div class="panel-heading">Help Text - Some text related to policy</div>
                <div class="panel-body">
                    <div class="form-group">
                      <div class="col-md-4">
                        <label>Policy Type <span>(Individual/Family Account)</span></label>
                        <select id="example-selectAllJustVisible" class="my-select" name="policy_type[]" multiple="multiple">
						
						 
                          <option value="Auto">Auto</option>
                          <option value="Home Owner">Home Owner</option>
                          <option value="Renter">Renter</option>
                          <option value="Life">Life</option>
                          <option value="Boat">Boat</option>
                          <option value="Bike">Bike</option>
                          <option value="Liability/Umbrella">Liability/Umbrella</option>
                          <option value="Other">Other</option>
                        </select>
                       </div>
                      <div class="col-md-4">
                          <label>Insurance Carrier</label>
                          <input type="text" name="carrier"  id="carrier" id="carrier" class="form-control">
                      </div>
                      <div class="col-md-4">
                        <label>Policy Number</label>
                        <input type="text" name="policy_number"  id="policy_number" class="form-control">
                       </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4">
                               </div>
                        <div class="col-md-4">
                          <label>Effective Date</label>
                          <input name="effective_date"  id="effective_date" type="text" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label>Expiration Date</label>
                          <input name="expiration_date" id="expiration_date" type="text" class="form-control">
                        </div>

                      </div>

                      <div class="form-group">
                        <div class="col-md-4">
                          <label>Premium</label>
                          <input name="policy_premium" type="text"   id="policy_premium" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label>Upload File</label>
                          <input name="policy_path"  type="file" class="form-control">
                        </div>

                        <div class="col-md-4 text-right">
                         <div class="addPolicyBtn"><input type="submit" class="btn btn-primary" value="Add Policy"></div>
                        </div>

                      </div>

                </div>
              </div> <!--ends of from Panel -->
              
              <!--claim table -->
              <div class="table-responsvie">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Policy Number</th>
                      <th>Policy Type</th>
                      <th>Expiration Date</th>
                      <th>Effective Date</th>
                      <th>Premium</th>
                      <th>Insurance Carrier</th>
                      <th>Download</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
				  
<?php foreach ($articles as $article): ?>
    
                    <tr>
                      <td><?php echo $article->policy_number;?></td>
                      <td><?php echo $article->policy_type;?></td>
                      <td><?php echo Date("d/m/Y",strtotime($article->expiration_date)); ?></td>
                      <td><?php echo Date("d/m/Y",strtotime($article->effective_date));?></td>
                      <td><?php echo $article->policy_premium;?></td>
                      <td><?php echo $article->carrier;?></td>
                      <td><?= $this->Html->link(''.$article->policy_path , ['action' => 'download', $article->policy_path]) ?></td>
                      <td><?= $this->Html->link('Edit', ['action' => 'edit', $article->id]) ?>
						</td>
                    </tr>
					
<?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!--claim table ends -->

           </div>
         </div>


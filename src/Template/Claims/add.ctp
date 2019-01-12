<!-- File: src/Template/Claims/add.ctp -->
<script>
$( function() {
    $( "#loss_date" ).datepicker();

	// validate signup form on keyup and submit
	$("#ClaimForm").validate({
		rules: {
			claim_number: {
				required: true
			},
			policy_number: {
				required: true
			},
			loss_date: {
				required: true
			},
			adjustor_name: {
				required: true
			},
			adjustor_phone_number: {
				required: true
			},
			adjustor_email: {
				required: true,
				email: true
			}
		},
		messages: {
			claim_number: "Please enter Claim Number.",								
			policy_number: "Please enter a Policy Number.",
			loss_date: "Please enter Loss Date.",
			adjustor_name: "Please enter Adjustor.",
			adjustor_phone_number: "Please enter Adjustor Phone Number.",
			adjustor_email: {
				required: "Please enter Adjustor Email.",
				email: "Please enter a valid email address"
			}
		}
	});
});
</script>
		
	<div class="col-md-10 rightAreaInner">
	   <div class="updateProfileBox">
			<h3>Add Claim<span style="font-size:15px;text-align:right;width:100%;color:red;"><?php if(isset($errorMsg)){ echo  $errorMsg; }	?></span></h3>
		  
		  <div class="panel panel-default">
			<div class="panel-heading" style="color:green;font-size:16px;" ><?php echo  $this->Flash->render() ?></div>
			<div class="panel-body">
			<?php echo $this->Form->create($claim ,['type' => 'file','id'=>'ClaimForm']);?>
				<div class="form-group">
				  <div class="col-md-4">
					<label>Claim Type</label>
					<select id="example-selectAllJustVisible" class="my-select" name="claim_type[]" multiple="multiple">
					<?php
					$cnt=0;
					foreach($selectListdata as $claimid => $claimType){	?>
						<option value="<?php echo $claimid;?>" <?php if($cnt==0) echo 'selected';?>><?php echo $claimType;?></option>						 
					<?php $cnt++; } ?>
					</select>
				   </div>
				  <div class="col-md-4">
					  <label>Claim Number:</label>
					  <input type="text" name="claim_number" id="claim_number" class="form-control">
				  </div>
				  <div class="col-md-4">
					<label>Policy Number</label>
					<input type="text" name="policy_number" id="policy_number" class="form-control">
				   </div>
				</div>

				<div class="form-group">
					<div class="col-md-4">
					  <label>Loss Date:</label>
					  <input type="text" name="loss_date" id="loss_date" class="form-control">
					</div>
					<div class="col-md-4">
					  <label>Adjustor:</label>
					  <input name="adjustor_name" id="adjustor_name" type="text" class="form-control">
					</div>
					<div class="col-md-4">
					  <label>Adjustor Phone Number:</label>
					  <input name="adjustor_phone_number" id="adjustor_phone_number" type="text" class="form-control">
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-4">
					  <label>Adjustor Email:</label>
					  <input name="adjustor_email" type="text" id="adjustor_email" class="form-control">
					</div>
					<div class="col-md-4">
					  <label>Upload Claim File</label>
					  <input name="claim_file" type="file" class="form-control">
					</div>

					<div class="col-md-4 text-right">
					 <div class="addPolicyBtn"><input type="submit" class="btn btn-primary" value="Add Claim"></div>
					</div>
				</div>
				<?php echo $this->Form->end();?>
			</div>
		  </div> <!--ends of from Panel -->
		  
		  <!--claim table -->
		  <div class="table-responsvie">
			<table class="table table-bordered">
			  <thead>
				<tr>
				  <th>Claim Number</th>
				  <th>Claim Type </th>
				  <th>Policy Number</th>
				  <th>Loss Date</th>
				  <th>Adjustor</th>
				  <th>Adjustor Phone Number</th>
				  <th>Adjustor Email</th>
				  <th>Download</th>
				  <th></th>
				</tr>
			  </thead>
			  <tbody>
			  
			<?php foreach ($claims as $claim): ?>
				<tr>
				  <td><?php echo $claim->claim_number;?></td>
				  <td>
				  <?php
					$claim_typeexp = [];
					if(!empty($claim->claim_type)){
						$claim_typeexp = explode(",",$claim->claim_type);
					}

					$allClaimType=[];
					foreach($claim_typeexp as $id){
						$allClaimType[]= (isset($selectListdata[$id]))?$selectListdata[$id]:'';
					}
					echo  implode(",",$allClaimType);
					?>
				  </td>
				  <td><?php echo $claim->policy_number;?></td>
				  <td><?php echo Date("d/m/Y",strtotime($claim->loss_date)); ?></td>
				  <td><?php echo $claim->adjustor_name;?></td>
				  <td><?php echo $claim->adjustor_phone_number;?></td>
				  <td><?php echo $claim->adjustor_email;?></td>
				  <td><?= $this->Html->link(''.$claim->claim_file , ['action' => 'download', $claim->claim_file]) ?></td>
				  <td><?= $this->Html->link('Edit', ['action' => 'edit', $claim->id])?></td>
				</tr>
			<?php endforeach; ?>
			  </tbody>
			</table>
		  </div>
		  <!--claim table ends -->

	   </div>
	 </div>
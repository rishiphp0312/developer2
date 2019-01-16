<!-- File: src/Template/Communities/allresponse.ctp -->

		   
		  
		   
            <div class="panel panel-default">		   <h3>User Responses</h3>

			                <div class="panel-heading" style="color:green;font-size:15px;" ><?php echo  $this->Flash->render() ?></div>

              <div class="panel-body">
              <!--<div class="form-group">
                <label class="control-label col-sm-3" for="email">Subject:</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                  	<?php 
					//if(isset($allPostsResponse[0]->subject))
					//echo $allPostsResponse[0]->subject;?>
				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
              </div>
			  <div class="form-group">
                <label class="control-label col-sm-3" for="email">Details:</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
					<?php  
								//		if(isset($allPostsResponse[0]->details))

					//echo $allPostsResponse[0]->details;
					?>
                </div>
              </div>-->
              <div class="form-group">
                <label class="control-label col-sm-3" for="email">Replies:</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
					<table>
					<?php if(isset($allPostsResponse[0]['communities_responses']) &&  count($allPostsResponse[0]['communities_responses'])>0) { 
					$cnt=1;
					foreach($allPostsResponse[0]['communities_responses'] as $value){
					?>
					<tr><td><?php echo   $cnt++;?>)</td> 
					<td>&nbsp;</td>
					<td><?php echo  $value->response; ?></td>
					</tr>
						<?php }}?>
					</table>
				</div>
              </div>
               <div class="form-group">
                <div class="col-md-12 text-right">
                  
                </div>
              </div>
			</div>
            </div>

<?php 
//debug($displayCaseArray);
//if(!empty($displayTestArray)){ 
?>			
														
										<td>
										<table width="100%" cellpadding="0" cellspacing="0">
										<tbody>

										<tr>
										<td>
										<table cellspacing="0" cellpadding="0" border="0"
										bgcolor="#DBD6D5" align="center" width="100%" style="margin-top: 7px;">
										<tbody>
										<tr>
										<td>
										<table cellspacing="0" cellpadding="7" border="0" bgcolor="#C7BDBB" width="100%"  id="myTable3">
										<thead>
              							<tr>
                             
								
								<td width="5%" align="left" class="grid-tbl-title"></td>
								<td width="15%" align="left" class="grid-tbl-title">Test Generic Name</td>
								<td width="15%" align="left" class="grid-tbl-title">Test Name</td>
								<td width="10%" align="center" class="grid-tbl-title">Clinic Name</td>
                                                                <td width="10%" align="center" class="grid-tbl-title">Clinic Location</td>
                                                                <td width="10%" align="center" class="grid-tbl-title">Created Status</td>
                                                                <td width="25%" align="center" class="grid-tbl-title">Errors</td>
                                                                
								<td width="10%" align="center" class="grid-tbl-title">Actions</td>
							</tr>
                			</thead>
							<tbody >
							
							
							<?php
							
								if( !empty($displayTestArray) )
								{
									$i=0;
									foreach($displayTestArray as $k=>$testDetails)
									{
										
										$oddcolor = Configure::read('odd_color');
										$evencolor = Configure::read('even_color');
										$defaultcolor = "";
										
										if ($i%2==0) {
											$defaultcolor = $oddcolor;
										} else {
											$defaultcolor = $evencolor;
										}
										
										//debug($defaultcolor);
										
									?>	
                          
							<tr class="grid-tbl-td1 td" bgcolor='<?php echo $defaultcolor; ?> '>
                        	
                        	<td align="left" nowrap="nowrap" >
                        		<?php
                                        
                                                                
								if(empty($testDetails['Errors'])){
									//debug($k);
									//echo $this->Form->input('test_array_index', array('type'=>'checkbox', 'label'=>false,'value'=>'','id'=>'testarrayindex_'.$k ));
								}
                                                                
                                                                echo $k+1;
                                                                
								?>
                        	</td>
                        
                        	<td  align="left" nowrap="nowrap" >
                        		<?php echo $testDetails['TestCategory'];?>
                        	</td>
                        	<td align="left" nowrap="nowrap" >
                        		<?php echo $testDetails['TestName'];?>
                        	</td>
                                <td  align="left" nowrap="nowrap" >
                        		<?php echo $testDetails['ClinicName'];?>
                        	</td>
                                <td  align="left" nowrap="nowrap" >
                        		<?php echo $testDetails['ClinicArea'];?>
                        	</td>
                                 <td  align="left" nowrap="nowrap" >
                        		<?php echo $testDetails['CreatedStatus'];?>
                        	</td>
                                <td  align="left" nowrap="nowrap" >
                        		<?php 
                                        //debug($caseDetails['Errors']);
                                        if(!empty($testDetails['Errors'])){
                                            foreach($testDetails['Errors'] as $errors){
                                                echo '<span style="color:red">'.$errors."</span>";
                                            }
                                            
                                        }
                                        
                                        ?>
                        	</td>
                        	<td width="10%" align="middle" nowrap="nowrap" >
                        	<div>
								<?php
								if(empty($testDetails['Errors'])){
									//debug($k);
									//echo $this->Html->image('upload-icon.png', array('url' => 'javascript:void(0);','onclick' => "create_test(".$k.")", 'title' => 'Upload Test', 'border' => 0));
								}
								?>
								</div>
                        	</td>
								
                            </tr>
                                
                                <?php 
                                
                                $i++;
								} ?>
								
								
							
                            
							<?php
								 	
								}
								else
								{
							?>
							<tr>
								<td colspan="7" align="center" style="color:#FF0000; font-size:12px; font-weight:bold">No results found</td>
							</tr>
							<?php
								}
							?>
							
							
						</tbody>
						</table>
					</td>
				</tr>
			</tbody>
			</table>
		</td>
	</tr>
	
        
        <?php //if($file_type!="xml"){ 
        /*
        ?>
	<tr id="save_form"  class="grid-tbl-td1">
	<td>
        <table width="100%" border="0"
        cellspacing="5" cellpadding="5">
																<tr >
																	<td width="93%" align="right">
																		
																	</td>
																	<td width="7%" align="right">
																		<?php print $this->form->submit('create_btn.png', array('div' => false, 'style' => array('width'=> '63', 'height' => '18'),'value' => 'create','onclick'=>'return create_multiple_case();')); ?>
																	</td>
																</tr>
															</table>
        </td>														
	</tr>
        <?php //} 
         * 
         */ ?>
         
	
</tbody>
</table>
<?php //} ?>
</td>
										
										

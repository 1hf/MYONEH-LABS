<?php //pr($eventCategoryList);?>

<div style="text-align:right; padding-right:20px;padding-top:5px; color: #FF6600; font-size:14px; "> <strong> You are Viewing: ( <?php echo "Page " . $current_page = $this->Paginator->param('page'); ?>  of <?php echo $number_of_pages = $this->Paginator->param('pageCount'); ?> Pages ) No of Records: &nbsp;<?php echo $total_records = $this->Paginator->param('count'); ?> </strong></div>

<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#DBD6D5 " style="margin-top: 7px; margin-bottom:5px;">

<tbody>
	<tr>
		<td valign="top"  align="left" class="listElementsTbl">

			<table width="100%" border="0" cellpadding="3" cellspacing="1" id="add_current_post">
			<tbody>
				<tr>
					<td width="5%" align="left" class="grid-tbl-title">#</td>
                                        <td width="15%" align="left" class="grid-tbl-title">Area Name</td>
					<td width="15%" align="left" class="grid-tbl-title">City</td>
                                        <td width="15%" align="center" class="grid-tbl-title">Status</td>
                                        <td width="10%" align="center" class="grid-tbl-title">Edit </td>
					<td width="10%" align="center" class="grid-tbl-title">Delete </td>
				</tr>
				<?php
                                        //$current_page = $this->Paginator->counter('{:page}');
                                        
                                        
                                        $page  = $this->Paginator->param('page');
                                        
                                        $limit = $this->Paginator->param('limit');
                                        
                                       
                                
					if(!empty($areaList))
					{
						$i=0;
						foreach($areaList as $area)
						{
				?>
				<tr class="grid-tbl-td1">
                                        <td valign="top" align="left"><?php 
					
                                                echo $counter = ($page * $limit) - $limit + $i+1;
						
                                                
					?></td>
					<td valign="top" align="left"><?php 
					
						echo $area['Area']['area_name'];
                                                
					?></td>
					<td valign="top" align="left">
					<?php 
					
                                                echo $area['City']['city_name'];
					?>
					</td>
					
					<td valign="top" align="center"><?php 
					
					$statuses = array(
							Configure::read('Active_id') => Configure::read('Active_val'),
							Configure::read('Inactive_id') => Configure::read('Inactive_val')
					);
						
					$status_id = $area['Area']['status_id'];
					
					echo $this->Form->input('status_id', array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'style'=>'width:80px;', 'type'=>'select', 'id' =>'status_id_'.$i,'options'=>$statuses, 'selected'=>$status_id, 'empty'=>false, 'onchange' => 'perform_operation_area_status("ChangeStatus","'.$area['Area']['id'].'","'.$status_id.'", "'.$i.'");'));
					
					?></td>
				
						
			
					<td valign="top" align="center">
						<table width="100%" border="0"  cellspacing="1" cellpadding="1">
							<tr>
								<td width="52%" align="center">
									
										<a href="<?php echo $this->webroot;?>manage_area/add_edit_area/<?php echo $area['Area']['id'];?>" >
										<?php echo $this->Html->image('edit.png', array('alt'=>'Edit', 'title'=>'Edit', 'border' => '0')); ?>
										</a>
									
									
								</td>
							</tr>
						</table>
					</td>
					
					<td valign="top" align="center">
						<table width="100%" border="0"  cellspacing="1" cellpadding="1">
							<tr>
								<td width="52%" align="center">
								
									<a href="javascript:void(0);" onclick="javascript:return perform_delete(<?php echo $area['Area']['id'];?>)" >
										<?php echo $this->Html->image('cross.png', array('alt'=>'Delete', 'title'=>'Delete', 'border' => '0')); ?>
									</a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<?php
						$i++;
						}
				?>
				<tr>
					<td colspan="6" align="left">
						<?php echo $this->Element('pagination'); ?>
					</td>
				</tr>
				<?php
					}
					else
					{
				?>
				<tr class="grid-tbl-td1">
					<td colspan="6" align="center">
						<span class="search-no-results">No Results Found.</span>
					</td>
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



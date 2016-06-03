<?php //pr($eventCategoryList);?>
<!--<p style="text-align: right; margin-right:100px; color:#30F;"> Total No Of records:<?php if(!empty($BookingList))
					{ // echo count($BookingList);
					
					} ?> </p>-->
<div style="text-align:right; padding-right:20px;padding-top:5px; color: #FF6600; font-size:14px; "> <strong> You are Viewing: ( <?php echo "Page " . $current_page = $this->Paginator->param('page'); ?>  of <?php echo $number_of_pages = $this->Paginator->param('pageCount'); ?> Pages ) No of Records: &nbsp;<?php echo $total_records = $this->Paginator->param('count'); ?> </strong></div>

<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#DBD6D5 " style="margin-top: 7px; margin-bottom:5px;">

<tbody>
	<tr>
		<td valign="top"  align="left" class="listElementsTbl">

			<table width="100%" border="0" cellpadding="3" cellspacing="1" id="add_current_post">
			<tbody>
				<tr>
					<td width="5%" align="left" class="grid-tbl-title">#</td>
					<td width="18%" align="left" class="grid-tbl-title">Patient Details</td>
					<td width="20%" align="left" class="grid-tbl-title">Contact Person</td>
					<td width="15%" align="center" class="grid-tbl-title">Clinic info</td>
					<td width="10%" align="center" class="grid-tbl-title">Contact Email</td>
					<td width="10%" align="center" class="grid-tbl-title">Contact Mobile</td>
                    <td width="10%" align="center" class="grid-tbl-title">Test/ Packages </td>
                    <td width="10%" align="center" class="grid-tbl-title">Total Actual Price </td>
                    <td width="10%" align="center" class="grid-tbl-title">Total Offer Price </td>
                    <td width="10%" align="center" class="grid-tbl-title">Discount Amount </td>
                    
                    <td width="10%" align="center" class="grid-tbl-title">VoucherID </td>
                    <td width="10%" align="center" class="grid-tbl-title">Booking Date </td>
                    <td width="10%" align="center" class="grid-tbl-title">Valid Upto </td>
                    <!--<td width="10%" align="center" class="grid-tbl-title">Status </td>	-->				
					<td width="10%" align="center" class="grid-tbl-title">Actions </td>
				</tr>
				<?php
					if(!empty($BookingList))
					{
                                                $page  = $this->Paginator->param('page');
                                        
                                                $limit = $this->Paginator->param('limit');
                                            
						$j=0;
						foreach($BookingList as $booking)
						{
				?>
				<tr class="grid-tbl-td1">
					<td valign="top" align="left"><?php 
                                        
                                        
					echo $counter = ($page * $limit) - $limit + $j+1;
							
					?></td>
					<td valign="top" align="left">
					<?php 
					
					if($booking['Booking']['patient_name']!=""){							
							echo "<strong>".$booking['Booking']['patient_name']." </strong>\n";
							//echo $booking['Booking']['patient_dob'].", ";
							//echo date_diff(date_create($booking['Booking']['patient_dob']), date_create('today'))->y ."Yrs";
							echo ", ".$booking['Booking']['patient_gender'];
							//echo ", \n".$booking['Booking']['home_collection_address'];
						}
					?>
					</td>
					<td valign="top" align="left">
					<?php 
					if($booking['Booking']['contact_name']!=''){
						
					echo "<strong>".$booking['Booking']['contact_name']."</strong>\n";
                                        // $booking['Booking']['home_collection_address'];
					}
						?>
					</td>
                    <td valign="top" align="left">
					<?php 
					if($booking['Clinic']['clinic_name']!=''){
						
					echo "<strong>". $booking['Clinic']['clinic_name']."</strong> \n".$booking['Area']['area_name'];
					}
						?>
					</td>
					<td valign="top" align="center"><?php 	
					echo $booking['Booking']['contact_email']." /".$booking['Booking']['patient_email'];
				?></td>
                <td valign="top" align="center"><?php 	
					echo $booking['Booking']['contact_mobile']." /".$booking['Booking']['patient_mobile'];
				?></td>
				<td valign="top" align="center"><?php 		
                                        echo $booking['test_included'];
					?></td>
			<td valign="top" align="center"><?php 				
					echo  $booking['Booking']['total_price_actual'];					
					?></td>
                    <td valign="top" align="center"><?php 				
					echo  $booking['Booking']['total_price_offer'];					
					?></td>
                    <td valign="top" align="center"><?php 				
					echo  $booking['Booking']['total_discount'];					
					?></td>
                    
                     <td valign="top" align="center"><?php 				
					echo  $booking['Booking']['voucher_unique_id'];					
					?></td>
                     <td valign="top" align="center"><?php 				
					echo  date('d-m-Y g:i A',strtotime($booking['Booking']['booking_date']));					
					?></td>
                     
                     <td valign="top" align="center"><?php 	
                                        $validity_upto = date('d-m-Y', strtotime($booking['Booking']['booking_date']." +7 days"));
                     
					echo $validity_upto;					
					?></td>
                   
					
					<td valign="top" align="center">
						<table width="100%" border="0"  cellspacing="1" cellpadding="1">
							<tr>
								<td width="52%" align="center">
								
                                                                        <?php
        echo $this->Html->link(
         $this->Html->image('search_icon.png', array('alt'=>'View Voucher', 'title'=>'View Voucher', 'border' => '0')),
    array(
        'controller'=>'booking',
        'action'=>'download_pdf_file',
        $this->General->enCrypt($booking['Booking']['id'])
    ),
    array(
        'target'=>'_blank',
        
        'escape'=>false  
    )
    );?>
                                                                    
									<!--<a href="javascript:void(0);" onclick="javascript:return perform_delete(<?php echo $booking['Booking']['id'];?>)" >
										<?php //echo $this->Html->image('cross.png', array('alt'=>'Delete', 'title'=>'Delete', 'border' => '0')); ?>
									</a>-->
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<?php
						$j++;
						}
				?>
				<tr>
					<td colspan="14" align="left">
						<?php echo $this->Element('pagination'); ?>
					</td>
				</tr>
				<?php
					}
					else
					{
				?>
				<tr class="grid-tbl-td1">
					<td colspan="14" align="center">
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



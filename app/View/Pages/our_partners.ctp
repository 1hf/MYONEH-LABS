<script type="text/javascript"> jQuery.noConflict(); </script>
<?php

echo $this->Html->script('jquery-v1.8.3.js');
echo $this->Html->script('bootstrap.min.js');
echo $this->Html->script("jquery.json-2.2.min.js");
?>

<div class="container">
  <div class="row clearfix">
    <div class="col-md-12">
      <div class="breadcrumb"> <a href="<?php echo Configure::read('medtest_root_path');?>"> HealthX.in </a> <span class="sep"></span> Our Partners</div>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-md-8 inner_content">
      <div class="row clearfix title_block">
        <div class="col-md-12">
          <h3 class="title">Our <span>Partners</span></h3>
        </div>
      </div>
      <!--<div class="row clearfix">
        <div class="col-md-12">
          <p class="text">HealthX is an initiative that creates awareness about the latest health checkup packages being offered by diagnostic clinics and hospitals alike. This enterprise combines the ease of internet access with comprehensive descriptions of health packages and the ability to purchase them with the simple click of a button.  </p>
        </div>
      </div>-->
      <div class="row clearfix">
        <div class="col-md-12">
        
         <?php
         foreach($clinic_details as $cinic){
         ?>
            <div class="row clearfix content_row">
            <div class="col-md-3 img_col">
            <?php if(!empty($cinic['Clinic']['logo'])){
                $logo_file = $filePath = "upload/clinics/".$cinic['Clinic']['id']."/".$cinic['Clinic']['logo']; 
            ?>  
                <?php echo $this->Html->image($this->webroot.$logo_file, array('alt' => 'logo', 'border' => '0','width'=>'77','height'=>'77')); ?>
           <?php }else{ ?>
                <?php echo $this->Html->image('default_clinic.png', array('alt' => 'logo', 'border' => '0','width'=>'77','height'=>'77')); ?>
            <?php } ?>    
            </div>
            <div class="col-md-9">
            <h3><?php echo $cinic['Clinic']['clinic_name'].' - '.$cinic['Area']['area_name'];?></h3>
            <p class="address"><?php echo $cinic['Clinic']['address_line1'].','.$cinic['Clinic']['address_line2'].', '.$cinic['Area']['area_name'].', '.$cinic['City']['city_name'].' - '.$cinic['Clinic']['postcode']; ?></p>
            <p><?php echo $cinic['Clinic']['description'];?></p>
            <p>
                <!--<a href="<?php echo $cinic['Clinic']['website'];?>"><?php echo $cinic['Clinic']['website'];?></a>-->
                <?php echo $cinic['Clinic']['website'];?>
            </p>
            </div>
            </div>
         
         <?php }
         
         ?>
            
       
      
      
          
          
          
        </div>
      </div>
    </div>
    <div class="col-md-4  ">
      <?php echo $this->Element('Common/side_call_back'); ?>
      <div class="ad">
          <?php //echo $this->Html->image('ad2.jpg', array('alt' => 'ad', 'border' => '0','width'=>'300','height'=>'600')); ?>
      </div></div>
  </div>
</div>


<div class="modal fade" id="myModalRequestCallBack" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>-->
        <h4 class="modal-title" id="myModalLabel"> Request Call Back</h4>
      </div>
      <div class="modal-body">
        Thank you for contacting us. We will get back to you shortly!!! <br /><br /> -Team HealthX.
        
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
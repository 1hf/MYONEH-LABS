<script type="text/javascript">
    
    var medtest_root_path = "<?php echo $this->webroot;?>";
  
    $(document).ready(function(){
        
        $('#myModal').modal({backdrop: 'static'});  
    });
    
    function success_redirect(){
        //$('#myModal').modal('hide');
        window.location.href = medtest_root_path;
    }
</script>

<div class="container">
  <div class="row clearfix">
    <div class="col-md-12">
      <div class="breadcrumb"> One Health <span class="sep"></span><span class="active"> Checkout</span></div>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-md-12 accord_block">
      <h2></h2>
      <div style="min-height: 300px;"">
        
       
       
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>-->
        <h4 class="modal-title" id="myModalLabel">Successfully Booked</h4>
      </div>
      <div class="modal-body">
        Your medical investigation has been booked successfully. We have mailed details to your email.<br/>
        Click 
        <?php
        echo $this->Html->link(
        'here',
    array(
        'controller'=>'booking',
        'action'=>'download_pdf_file',
        $this->General->enCrypt($booking_id)
    ),
    array(
        'target'=>'_blank',
        
        'escape'=>false  
    )
    );?>
       
        to download voucher.
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        <button type="button" class="btn btn-primary" onclick="javascript:success_redirect();">OK</button>
      </div>
    </div>
  </div>
</div>
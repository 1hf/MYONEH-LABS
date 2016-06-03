<div class="row-fluid wrap">
     <div class="title_bg">
   		<div class="login_block">
        <h2> 
       
        <?php echo $this->Html->image('lock.png', array('alt' => 'lock', 'border' => '0','width'=>'28','height'=>'27'));
        ?>
        <span>Admin Login</span> </h2>
         
         <?php echo $this->Form->create('User', array('id'=>'loginForm','class'=>'form-horizontal','url' => array('action' => 'login'), 'onsubmit' => 'javascript:return validate_login();'))?>
         <div class="control-group">
         				<span class="red-mark text-center"> <?php echo $this->Session->flash(); ?></span>
                        <label class="control-label" for="username">Username<span class="red-mark">*</span></label>
                        <div class="controls">
                         <?php echo $this->Form->input('admin', array('type'=>'hidden', 'value' => 'yes'));?>
                        <?php echo $this->Form->input('username', array('id'=>'username','autocomplete'=>'off','required' => true,'div' => false, 'placeholder'=>'Username','label'=>false,'type'=>'text', 'tabIndex' => 1));?>
                       	<br/>
    							<span id="error_username" class="red-mark" style="display: none;"></span>
                        </div>
                      	</div>
                      	<div class="control-group">
                        <label class="control-label" for="password">Password<span class="red-mark">*</span></label>
                        <div class="controls">
                          <?php echo $this->Form->input('password', array('id'=>'password','autocomplete'=>'off','div' => false, 'placeholder'=>'Password','label'=>false, 'tabIndex' => 2)); ?>
                          <br/>
    							<span id="error_password" class="red-mark" style="display: none;"></span>
                        </div>
                      </div>
                      <div class="control-group">
                                              <div class="controls">
                          
                          <?php echo $this->Form->submit('Login',array('div' => false,'class'=>'btn btn-primary'));?>
                        </div>
                       
                      </div>
        	<?php echo $this->Form->end();?>
        </div>
           
        </div><!--/span-->
</div>

<script type="text/javascript">

function hide_form_errors()
{
	$("#error_contact_name").hide();
	$("#error_contact_email").hide();
}

function validate_login(){

	hide_contact_form_errors();
	var errMessage = new Array();
	var errMessageIndex = new Array();

	if( $("#username").val() == '' ) {
		errMessage.push('Please enter data for username.');
		errMessageIndex.push('username');
	}

	if( $("#password").val() == '' ) {
		errMessage.push('Please enter data for password.');
		errMessageIndex.push('password');
	}
	

	//Display message
	for(i=0; i<errMessageIndex.length; i++) {
		$("#error_"+errMessageIndex[i]).html(errMessage[i]);
		$("#error_"+errMessageIndex[i]).show();
	}
	
	if(errMessageIndex.length > 0) {
		for(i=0; i<errMessageIndex.length; i++) {
			$("#"+errMessageIndex[i]).focus();
			break;
		}
		return false;
	}
	else {
		$('#loginForm').submit();
		
	}
	return false;
}
</script>
        
<?php
	$this->Html->script("jquery.blockUI.js", array('inline' => false));
	$this->Html->script("common_functions.js", array('inline' => false));

	$current_page = $this->Paginator->counter('{:page}');
	$end_page = $this->Paginator->counter('{:pages}');
?>

<table border="0" class="pager">
<tbody>
	<tr>
		<td>
			<?php
				if ($current_page == 1){
					echo $this->Html->image('arrow-stop-180.gif', array('alt' => 'first', 'class' => 'disabled first'));
				}
				else{
					echo $this->Html->image('arrow-stop-180.gif', array('alt' => 'first', 'class' => 'disabled first', 'url' => "$limit/page:1"));
				}
			?>			
		</td>
		<td>
			<?php
				$prev_image = $this->Html->image('arrow-180.gif', array('alt' => 'first', 'escape' => false, 'class' => 'prev'));
				echo $this->Paginator->prev(__($prev_image, true), array('escape' => false, 'class'=>'disabled prev'));
			?>			
		</td>
		<td>
			<?php
				$number_of_pages = $this->Paginator->counter('{:page} of {:pages}');
				echo $this->Form->input('pagedisplay', array('div'=>false, 'label'=>false, 'type'=>'text','class' => 'pagedisplay input-short align-center', 'id'=>'pageDisplay', 'value' => $number_of_pages, 'readonly' => true));
				
			?>			
		</td>
		<td>
			<?php
				$next_image = $this->Html->image('arrow.gif', array('alt' => 'next', 'escape' => false, 'class' => 'next'));
				echo $this->Paginator->next(__($next_image, true), array('escape' => false, 'class' => 'disabled next'));			
			?>			
		</td>
		<td>
			<?php
				if ($current_page == $end_page) {
					echo $this->Html->image('arrow-stop.gif', array('escape' => false, 'alt' => 'last', 'class' => 'last'));
				} else {
					echo $this->Html->image('arrow-stop.gif', array('escape' => false, 'alt' => 'last', 'class' => 'last', 'url' => "$limit/page:$end_page"));
				}
				
			?>			
		</td>
		<td>
			<?php
				$options = array('10'=>'10', '20'=>'20', '30' => '30', '40' => '40', '50' => '50');
				//$options = array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', '6'=>'6', '7'=>'7', '8'=>'8');
				echo $this->Form->input('pageSize', array('div'=>false, 'label'=>false, 'type'=>'select', 'class'=>'pagesize input-short align-center', 'id' =>'pageSize', 'options'=>$options, 'selected' => $limit, 'empty'=>false));
			?>
		</td>
	</tr>
</tbody>
</table>
					
					
<script type="text/javascript">

function callAjax(){
	
        
	if ($('#pageSize').val() == undefined) {
		var limit = 10;
	} else {
		var limit = $('#pageSize').val();
	}
	//alert(jString);
	var thisHref = "<?php echo $this->webroot; ?>"+url+limit+"/page:<?php echo $current_page; ?>/?jString="+jString;
	//alert(thisHref);
	//return false;	
	show_loading();
	$('div#listContainer').load(thisHref, function(){
		$('#pageSize').val(limit);
		hide_loading();
	});
	
	return false;
}

$('#pageSize').change(function(){
	callAjax();
	return false;
});


$(document).ready(function() {

	$('.pager a').click(function(){
		var limit = $('#pageSize').val();

		var href = this.href;
		var subHref = href.split(":");
		subHref = subHref[subHref.length-1];
		pageNum = subHref.split("?");
		
		if (pageNum.length > 1) {
			pageNum = pageNum[pageNum.length-2];
		} else {
			pageNum = pageNum;
		}
		
		var thisHref = "<?php echo $this->webroot; ?>"+url+limit+"/page:"+pageNum+"/?jString="+jString;
		
		
		show_loading();
		$('div#listContainer').load(thisHref, function(){
			$('#pageSize').val(limit);
			hide_loading();
		});
		return false;
		
	});

});
</script>
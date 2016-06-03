<?php
class DestinationFile extends Destination {
  var $_link_text;
  var $file_dest_path;

  function DestinationFile($filename, $link_text = null, $file_dest_path) {
    $this->Destination($filename);

    $this->_link_text = $link_text;
	$this->file_dest_path = $file_dest_path;
	//echo $file_dest_path;
  }

  function process($tmp_filename, $content_type) {
	//echo OUTPUT_NEW_FILE_DIRECTORY; exit;
    $dest_filename = $this->file_dest_path.$this->filename_escape($this->get_filename()).".".$content_type->default_extension;
	//$dest_filename = $file_dest_path.$this->filename_escape($this->get_filename()).".".$content_type->default_extension;

    copy($tmp_filename, $dest_filename);

    $text = $this->_link_text;
    $text = preg_replace('/%link%/', 'file://'.$dest_filename, $text);
    $text = preg_replace('/%name%/', $this->get_filename(), $text);
    print $text;
  }
}
?>
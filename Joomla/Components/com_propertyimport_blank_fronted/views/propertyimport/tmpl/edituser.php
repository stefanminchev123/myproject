<?php
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
foreach($this->users as $key => $value) {
	//echo "<pre>".print_r($value,true) ."</pre>";
}
?>



<div id="element-box">
 <fieldset class="adminform">
 <?php 
 	
 	if(isset($this->saveMsg["txt"])){
 	if($this->saveMsg["code"] == 1){
 		
 		JError::raiseWarning( 100, $this->saveMsg["txt"] );
 }else{
 	JFactory::getApplication()->enqueueMessage($this->saveMsg["txt"]);
 }
 }
 ?>
<legend>Ftp User Create</legend>
<form name="adminForm" method="POST" action="index.php" enctype="multipart/form-data" >
 <select name="Users" id="Users" class="dropdown"  onchange="formpopulate();">
 	<option value="">Изберете Потребител</option>
<?php
	foreach($this->users as $key => $value) {
		
		echo "<option value=".$value["id"].">".$value["name"].' - '.$value["username"]."</option>";	
	}
?> 
</select>
 	<label>FTP Host</label>
	<input type="text" name="hostname" id="hostname" value="<?php echo $this->data['host']; ?>" />
	<label>FTP Port</label>
	<input type="text" name="ports" id="ports" value="<?php echo $this->data['port']; ?>" />
	<label>FTP Path</label>
	<input type="text" name="folders" id="folders"  value="<?php echo  $this->data['folder']; ?>" />
	<label>FTP Username</label>
	<input type="text" name="usernames" id="usernames" value="<?php echo  $this->data['username']; ?>" />
	<label>FTP Password</label>
	<label>ID :  <?php echo $this->data['id']; ?></label>	
	
	<input type="password" name="ftppass" id="ftppass" />
	<input type="hidden" name="userid"  id="userid" value="<?php echo $this->data['user_id']; ?>" />
	<input type="hidden" name="net2ftp_id"  id="net2ftp_id" value="<?php echo $this->data['id']; ?>" />
	<input type="hidden" name="option"  value="com_net2ftp" />
    <input type="hidden" name="view"  value="net2ftp" />
    <input type="hidden" name="task" value="" />

    <?php echo JHtml::_('form.token'); ?>
	
</form>

  </fieldset>
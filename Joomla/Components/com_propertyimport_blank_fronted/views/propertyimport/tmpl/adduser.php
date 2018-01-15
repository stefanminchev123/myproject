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

	<label>Хост</label>
	<input type="text" name="hostname" id="hostname" value="<?php echo DEFAULT_HOST; ?>" />
	<label>Порт</label>
	<input type="text" name="ports" id="ports" value="<?php echo DEFAULT_PORT; ?>" />
	<label>Папка</label>
	<input type="text" name="folders" id="folders" />
	<label>Потребителско Име</label>
	<input type="text" name="usernames" id="usernames" />
	<label>Парола</label>
	<input type="password" name="ftppass" id="ftppass" />
	<input type="hidden" name="userid"  id="userid" />
	<input type="hidden" name="editusr"  id="editusr" value="0" />
	<input type="hidden" name="option"  value="com_net2ftp" />
    <input type="hidden" name="view"  value="net2ftp" />
    <input type="hidden" name="task" value="" />

    <?php echo JHtml::_('form.token'); ?>

</form>

  </fieldset>
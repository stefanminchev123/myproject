<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('bootstrap.tooltip');


 ?>

<form name="adminForm" id="adminForm" method="POST" action="index.php" enctype="multipart/form-data" >

 <label>FTP Host</label>
 <input type="text" name="hostname" id="hostname" value="<?php echo $this->data['host']; ?>" />
 <label>FTP Port</label>
 <input type="text" name="port" id="port" value="<?php echo $this->data['port']; ?>" />
 <label>FTP Path</label>
 <input type="text" name="folder" id="folder"  value="<?php echo  $this->data['folder']; ?>" />
 <label>FTP Username</label>
 <input type="text" name="username" id="username" value="<?php echo  $this->data['username']; ?>" />
 <label>FTP Password</label>
 <input type="password" name="ftppass" id="ftppass" />
<!-- <input type="hidden" name="userid"  id="userid" value="--><?php //echo $this->data['user_id']; ?><!--" />-->
<!-- <input type="hidden" name="net2ftp_id"  id="net2ftp_id" value="--><?php //echo $this->data['id']; ?><!--" />-->
 <input type="hidden" name="option"  value="com_propertyimport" />
 <input type="hidden" name="view"  value="propertyimport" />
 <input type="hidden" name="task" value="save" />

 <?php echo JHtml::_('form.token'); ?>

</form>
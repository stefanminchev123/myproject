<?php
/**
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JHtml::script(Juri::base() . 'components/com_mapview/js/exportAjax.js');

global $CONFIGS_SERVICES_LANG;

?>

<div class="container">
<h3>Export</h3>
    <form class="form-inline" id="exportForm">
        <div class="form-group">
            <select name="catId" class="form-control col-md-6">
                <option value="<?php echo $CONFIGS_SERVICES_LANG[10]['catid']; ?>"><?php echo $CONFIGS_SERVICES_LANG[10]['lang']['bg-BG']; ?></option>
                <option value="<?php echo $CONFIGS_SERVICES_LANG[20]['catid']; ?>"><?php echo $CONFIGS_SERVICES_LANG[20]['lang']['bg-BG']; ?></option>
                <option value="<?php echo $CONFIGS_SERVICES_LANG[30]['catid']; ?>"><?php echo $CONFIGS_SERVICES_LANG[30]['lang']['bg-BG']; ?></option>
            </select>
        </div>
        <button type="submit" class="btn btn-default" id="ExportExcelBtn">Export</button>
        <span class="exportExcelMsg"><img class="exportLoader" src="<?php echo Juri::base() . 'components/com_mapview/images/magnify_loader.gif'; ?>"></span>
    </form>
</div>


<?php

//echo "<pre>DEBUG>>>" . print_r($this->list, 1) . "<<<DEBUG</pre>";
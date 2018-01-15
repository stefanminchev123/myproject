<?php

$document = JFactory::getDocument();
$document->addScript(JURI::base() . '/components/com_mapview/js/map.js');
$document->addStyleSheet('//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css');
$document->addScript('//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js');
require_once JPATH_COMPONENT_ADMINISTRATOR . '/libs/config.php';

$lang = JFactory::getLanguage();

$jinput = JFactory::getApplication()->input;
$searchField = $jinput->get('searchField', '', 'filter');
$clubs = $jinput->get('clubs', '', 'filter');
$objects = $jinput->get('objects', '', 'filter');
$federations = $jinput->get('federations', '', 'filter');

?>

    <div class="well">
        <form id="searchform" method="POST" action="">
        <div class="row">
            <div class="col-md-12"><h2>Искам да спортувам</h2></div></div>
        <div class="row">
            <div class="col-md-9">
                <div class="cats-filter">
                    <small style="font-size: 14px; margin-right: 10px;">Изберете категория:</small>
<!--                    <input type="checkbox" name="cats[]" id="events" value="--><?php //echo $CONFIGS_SERVICES_LANG['40']['catid']; ?><!--" checked><label for="events"><img src="--><?php //echo $CONFIGS_SERVICES_LANG['40']['icon']; ?><!--" class="filterLabelIcon">--><?php //echo  $CONFIGS_SERVICES_LANG['40']['lang'][$lang->getTag()]; ?><!--</label>-->
                    <input type="checkbox" name="cats[]" id="clubs" value="<?php echo $CONFIGS_SERVICES_LANG['10']['catid']; ?>" <?php if($clubs) echo "checked"; ?>><label for="clubs"><img src="<?php echo $CONFIGS_SERVICES_LANG['10']['icon']; ?>" class="filterLabelIcon"><?php echo $CONFIGS_SERVICES_LANG['10']['lang'][$lang->getTag()]; ?></label>
                    <input type="checkbox" name="cats[]" id="federations" value="<?php echo $CONFIGS_SERVICES_LANG['20']['catid']; ?>" <?php if($federations) echo "checked"; ?>><label for="federations"><img src="<?php echo $CONFIGS_SERVICES_LANG['20']['icon']; ?>" class="filterLabelIcon"><?php echo $CONFIGS_SERVICES_LANG['20']['lang'][$lang->getTag()]; ?></label>
                    <input type="checkbox" name="cats[]" id="objects" value="<?php echo $CONFIGS_SERVICES_LANG['30']['catid']; ?>" <?php if($objects) echo "checked"; ?>><label for="objects"><img src="<?php echo $CONFIGS_SERVICES_LANG['30']['icon']; ?>" class="filterLabelIcon"><?php echo $CONFIGS_SERVICES_LANG['30']['lang'][$lang->getTag()]; ?></label>
                </div>
                <div id="eventsC" class="pull-left input-group search-input" style="display: none;">
                    <small>Всички събития за тази година - <a href="http://sofia2018.bg/events">Календар</a> / <a target="_blank" href="http://sofia2018.bg/uploads/documents/2015_EVENTS.pdf">*.pdf</a> / <a target="_blank" href="http://sofia2018.bg/uploads/documents/2015_EVENTS.xls">*.xls</a></small>
                </div>


                    <div class="pull-left input-group search-input">
                        <input name="searchField" placeholder="Въведете спорт" value="<?php echo $searchField ?>" id="searchField" class="form-control" type="text">
                        <input name="submitFed" class="searchBtn" id="searchBtn" type="button" value="Търси"> <small> Списък на федерациите - <a target="_blank" href="http://sofia2018.bg/uploads/documents/SPORT_FEDERATIONS_IN_SOFIA.pdf">*.pdf</a> / <a target="_blank" href="http://sofia2018.bg/uploads/documents/SPORT_FEDERATIONS_IN_SOFIA.xlsx">*.xls</a></small>
                    </div>


                <div id="placesC" class="pull-left input-group search-input" style="display: none;">
                    <input name="" placeholder="Име на обект" class="form-control" type="text">
                    <!-- <input placeholder="Спорт" class="form-control" type="text"> -->
                    <input class="" type="submit" value="Търси">
                </div>
            </div>
        </div>
        </form>
        <div class="mapViewResShow">
            <ul class="nav nav-tabs" role="tablist" id="mapViewTabs">
               <li role="presentation" class="active"><a href="#mapTab" aria-controls="mapTab" role="tab" data-toggle="tab">Карта</a></li>
               <li role="presentation" class="tableView"><a href="#listTab" aria-controls="listTab" role="tab" data-toggle="tab">Списък</a></li>
                <img id="filterLoader" src="<?php echo JURI::root() ."/components/com_mapview/images/magnify_loader.gif" ?>">
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="mapTab"> <div id="map"></div></div>
                <div role="tabpanel" class="tab-pane fade" id="listTab">
                    <div id="listView">
                        <table id="listViewTable" class="display">
<!--                            <thead>-->
<!--                                <tr>-->
<!--                                    <th>Col 1</th>-->
<!--                                    <th>Col 2</th>-->
<!--                                    <th>Col 3</th>-->
<!--                                </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            </tbody>-->
                        </table>
                    </div>
                </div>
            </div>
        </div>
       

    </div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<script>
jQuery('#mapViewTabs a').click(function (e) {
  e.preventDefault()
  jQuery(this).tab('show')
})
</script>


<script src="https://maps.google.com/maps/api/js"></script>
<script type="text/javascript">
    google.maps.event.addDomListener( window, 'load', initMap );
</script>

<script>

jQuery(document).ready(function(){
    jQuery('#listViewTable').DataTable();
});

</script>



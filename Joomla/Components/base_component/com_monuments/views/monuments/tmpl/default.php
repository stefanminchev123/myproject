<?php

$monuments = $this->monuments;

  if( count($monuments) > 0 ) $h2 = '<h2>'. count($monuments). ' Паметника намерени </h2>';
   else  $h2 = '<h2> Няма намерени Паметници  </h2>';

?>

<?php  echo $h2  ?>

<div class="monuments-list">
 <?php foreach($monuments as $monument): ?>
     <div class="row monument">
         <div class="col-md-3">
          <img width="100%" src="<?php echo $monument->image; ?>">
         </div>
         <div class="col-md-9">
           <h2><?php echo $monument->title; ?></h2>
           <div class="note">
            <?php echo $monument->note; ?>
           </div>
          <div class="monument_type">
           <?php echo $monument->monument_type; ?>
          </div>
          <div class="monument_area">
           <?php echo $monument->area; ?>
          </div>
          <div class="monument_city">
           <?php echo $monument->city; ?>
          </div>

          <div class="monument_district">
           <?php echo $monument->district; ?>
          </div>

          <div class="monument_number">
           <?php echo $monument->number; ?>
          </div>

          <div class="monument_latitude">
           <?php echo $monument->latitude; ?>
          </div>

          <div class="monument_longitude">
           <?php echo $monument->longitude; ?>
          </div>

         </div>
     </div>
 <?php endforeach; ?>
</div>

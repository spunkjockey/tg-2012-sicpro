/app/views/elements/update_fuentefinanciamiento.ctp
<?php
if(!empty($fuentes)) {
  foreach($fuentes as $k => $v) {
    echo "<option value='$v'>$k</option>";
  }
 }
?>
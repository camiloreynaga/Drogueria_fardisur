<?php
echo "<div>".CHtml::link($data['name'],array('producto/view','id'=>$data['id']))." [".$data['stock']." (unds)]</div>";
?>

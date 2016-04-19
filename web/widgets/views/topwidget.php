<?php
echo '<ul class="top-menu-widget">';
	foreach($options as $item => $rote){
		echo "<li><a href='{$rote}'>{$item}</a></li>";
	}
echo '</ul>';
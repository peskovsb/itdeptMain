<?php
echo '<ul class="left-menu-widget">';
	foreach($options as $item => $rote){
		echo "<li>
			<a href='{$rote['link']}'>{$item}</a>
			<span class='ToolTleft'>
				<span class='ToolTleftInner'>{$rote['description']}</span>
			</span>
		</li>";
	}
echo '</ul>';
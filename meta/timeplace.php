<?php
global $post;
?>
<p>
	<strong><?php _e('Start', 'skryf-cpt-events') ?></strong>
	<input name="skryf-cpt-events-start" id="skryf-cpt-events-start" type="text" value="" class="large-text" /> 
	<span class="description"><?php _e('Event start time', 'skryf-cpt-events') ?></span>
</p>
<p>
	<strong><?php _e('End', 'skryf-cpt-events') ?></strong>
	<input name="skryf-cpt-events-end" id="skryf-cpt-events-end" type="text" value="" class="large-text" /> 
	<span class="description"><?php _e('Event end time', 'skryf-cpt-events') ?></span>
</p>
<p>
	<strong><?php _e('Location', 'skryf-cpt-events') ?></strong>
	<input name="skryf-cpt-events-location" id="skryf-cpt-events-location" type="text" value="" class="large-text" /> 
	<span class="description"><?php _e('Event location', 'skryf-cpt-events') ?></span>
</p>
<?php 
echo '<input type="hidden" name="skryf-cpt-events-noncename" value="' . wp_create_nonce(__FILE__) . '" />';
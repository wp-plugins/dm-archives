<h2>DM Archives Options</h2>
<form name="dm_archives_form" id="dm_archives_form" action="options.php" method="POST">
	<?php wp_nonce_field('update-options'); ?>
	<p>Select whether you want to display the post excerpts in the archives</p>
	<select name="dm_excerpts_option" value="<?php echo get_option('dm_excerpts_option'); ?>">
		<option value="false" <?php if(get_option('dm_excerpts_option')=='false') echo "selected='selected'";?>>false</option>
		<option value="true" <?php if(get_option('dm_excerpts_option')=='true') echo "selected='selected'";?>>true</option>
    </select>
	<p>Select whether you want to display the calendar icon besides the months</p>
	<select name="dm_img_option" value="<?php echo get_option('dm_img_option'); ?>">
		<option value="false" <?php if(get_option('dm_img_option')=='false') echo "selected='selected'";?>>false</option>
		<option value="true" <?php if(get_option('dm_img_option')=='true') echo "selected='selected'";?>>true</option>
    </select>
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="dm_excerpts_option,dm_img_option" />
	<p class="submit">
	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	</p>
</form>
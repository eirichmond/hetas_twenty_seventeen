<div class="my_meta_control">
 
	<p>This content is shown to all businesses who login unless it is isolate to the following competency.</p>
	
	<?php $competencies = get_terms( 'competencies', array( 'hide_empty' => true, ) ); ?>
	
	<?php foreach ($competencies as $competency) {?>
	
		<?php $mb->the_field($competency->slug); ?>
		<input type="checkbox" name="<?php $mb->the_name(); ?>" value="1"<?php $mb->the_checkbox_state('1'); ?>/> <?php echo $competency->name; ?><br/>
		
	<?php } ?>
	
		<p>When a business is not given access to view this content, this is the text to show.</p>

		<textarea class="noperm" name="<?php $metabox->the_name('no_permission_to_view'); ?>" ><?php $metabox->the_value('no_permission_to_view'); ?></textarea>



</div>
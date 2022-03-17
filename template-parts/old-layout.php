<?php if(empty($_GET) && 'preview-app' != $_GET['status']) { ?>

<p><strong><?php custom_taxonomy($post->ID, 'appliance_type'); ?></strong></p>
<p>Burns: <strong><?php custom_taxonomy($post->ID, 'fuel_types'); ?></strong></p>

<p><?php custom_taxonomy($post->ID, 'appliance_fuel_options'); ?></p>

<?php
$hetas_approved = get_custom_field($post->ID, 'hetas_approved');
$mcs_approved = get_custom_field($post->ID, 'app_mcs_approved');
$hetas_ecodesign = get_custom_field($post->ID, 'hetas_eco_design');
$defra_approved = get_custom_field($post->ID, 'app_clean_air_exempt');

if ($hetas_approved != 'Yes' && $defra_approved != 'Yes' && $mcs_approved != 'Yes' && $hetas_ecodesign == 'Yes') { ?>

<?php } else { ?>
	<div class="data-area">
		
		<?php if (has_terms( array('b22','b31','b32','e1','e2','e3'), 'appliance_type_code', $post->ID)) : ?>
		
			<table class="data">
				<tr>
					<th>&nbsp;</th>
					<td><strong>Rated Output Room (kW)</strong></td>
					<td><strong>Gross Efficiency (%)</strong></td>
					<td><strong>Net Efficiency (%)</strong></td>
					<td><strong>Refuel Period (h)</strong></td>
				</tr>
				<tr>
					<th>Burning<br>Wood</th>
					<td><strong><?php custom_field($post->ID, 'full_load_output_room_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'app_refuel_period_wood'); ?></strong></td>
				</tr>
				<tr>
					<th>Burning<br>Mineral Fuel</th>
					<td><strong><?php custom_field($post->ID, 'full_load_output_mineral'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_mineral'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_mineral'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'refuel_period_mineral'); ?></strong></td>
				</tr>
			</table>
		
		<?php endif; ?>

		<?php if (has_terms( array('e4'), 'appliance_type_code', $post->ID)) : ?>
		
			<table class="data">
				<tr>
					<th>&nbsp;</th>
					<td><strong>Rated Output Room (kW)</strong></td>
					<td><strong>Gross Efficiency (%)</strong></td>
					<td><strong>Net Efficiency (%)</strong></td>
					<td><strong>Refuel Period (h)</strong></td>
				</tr>
				<tr>
					<th>Full Load<br>Pellet</th>
					<td><strong><?php custom_field($post->ID, 'full_load_output_room_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_burn_rate_wood'); ?></strong></td>
				</tr>
				<tr>
					<th>Part Load<br>Pellet</th>
					<td><strong><?php custom_field($post->ID, 'part_load_output_room_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'part_load_gross_efficiency_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'part_load_net_efficiency_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'part_load_burn_rate_wood'); ?></strong></td>
				</tr>
			</table>
		
		<?php endif; ?>

		<?php if (has_terms( array('e5'), 'appliance_type_code', $post->ID)) : ?>
		
			<table class="data">
				<tr>
					<th>&nbsp;</th>
					<td><strong>Heat Capacity Room (kWh)</strong></td>
					<td><strong>Gross Efficiency (%)</strong></td>
					<td><strong>Net Efficiency (%)</strong></td>
					<td><strong>Heat Release (h)</strong></td>
				</tr>
				<tr>
					<th>Burning<br>wood</th>
					<td><strong><?php custom_field($post->ID, 'full_load_output_room_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'app_refuel_period_wood'); ?></strong></td>
				</tr>
				<tr>
					<th>Burning<br>Mineral Fuel</th>
					<td><strong><?php custom_field($post->ID, 'full_load_output_mineral'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_mineral'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_mineral'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'refuel_period_mineral'); ?></strong></td>
				</tr>
			</table>
		
		<?php endif; ?>

		<?php if (has_terms( array('f1','f2','f3','g12','g13','g21'), 'appliance_type_code', $post->ID)) : ?>
		
			<table class="data">
				<tr>
					<th>&nbsp;</th>
					<td><strong>Rated Output Room (kW)</strong></td>
					<td><strong>Rated Output Water (kW)</strong></td>
					<td><strong>Gross Efficiency (%)</strong></td>
					<td><strong>Net Efficiency (%)</strong></td>
					<td><strong>Refuel Period (h)</strong></td>
				</tr>
				<tr>
					<th>Burning<br>wood</th>
					<td><strong><?php custom_field($post->ID, 'full_load_output_room_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_output_water_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'app_refuel_period_wood'); ?></strong></td>
				</tr>
				<tr>
					<th>Burning<br>Mineral Fuel</th>
					<td><strong><?php custom_field($post->ID, 'full_load_output_mineral'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_output_water_mineral'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_mineral'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_mineral'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'refuel_period_mineral'); ?></strong></td>
				</tr>
			</table>
		
		<?php endif; ?>
		
		<?php if (has_terms( array('f4'), 'appliance_type_code', $post->ID)) : ?>
		
			<table class="data">
					<tr>
						<th>&nbsp;</th>
						<td><strong>Rated Output Room (kW)</strong></td>
						<td><strong>Rated Output Water (kW)</strong></td>
						<td><strong>Gross Efficiency (%)</strong></td>
						<td><strong>Net Efficiency (%)</strong></td>
						<td><strong>Refuel Period (h)</strong></td>
					</tr>
					<tr>
						<th>Full Load<br>Pellet</th>
						<td><strong><?php custom_field($post->ID, 'full_load_output_room_wood'); ?></strong></td>
						<td><strong><?php custom_field($post->ID, 'full_load_output_water_wood'); ?></strong></td>
						<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_wood'); ?></strong></td>
						<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_wood'); ?></strong></td>
						<td><strong><?php custom_field($post->ID, 'full_load_burn_rate_wood'); ?></strong></td>
					</tr>
					<tr>
						<th>Part Load<br>Pellet</th>
						<td><strong><?php custom_field($post->ID, 'part_load_output_room_wood'); ?></strong></td>
						<td><strong><?php custom_field($post->ID, 'part_load_output_water_wood'); ?></strong></td>
						<td><strong><?php custom_field($post->ID, 'part_load_gross_efficiency_wood'); ?></strong></td>
						<td><strong><?php custom_field($post->ID, 'part_load_net_efficiency_wood'); ?></strong></td>
						<td><strong><?php custom_field($post->ID, 'part_load_burn_rate_wood'); ?></strong></td>
					</tr>
				</table>
		
		<?php endif; ?>

		<?php if (has_terms( array('g21','g22','g23'), 'appliance_type_code', $post->ID)) : ?>
		
			<table class="data">
			<tr>
				<th>&nbsp;</th>
				<td><strong>Rated Output Room (kW)</strong></td>
				<td><strong>Rated Output Water (kW)</strong></td>
				<td><strong>Gross Efficiency (%)</strong></td>
				<td><strong>Net Efficiency (%)</strong></td>
				<td><strong>Refuel Period (h)</strong></td>
			</tr>
			<tr>
				<th>Winter Wood</th>
				<td><strong><?php custom_field($post->ID, 'rated_output_winter_room_wood'); ?></strong></td>
				<td><strong><?php custom_field($post->ID, 'rated_output_winter_water_wood'); ?></strong></td>
				<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_wood'); ?></strong></td>
				<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_wood'); ?></strong></td>
				<td><strong><?php custom_field($post->ID, 'refuel_period_winter_wood'); ?></strong></td>
			</tr>
			<tr>
				<th>Summer Wood</th>
				<td><strong><?php custom_field($post->ID, 'rated_output_summer_room_wood'); ?></strong></td>
				<td><strong><?php custom_field($post->ID, 'rated_output_summer_water_wood'); ?></strong></td>
				<td><strong><?php custom_field($post->ID, 'part_load_gross_efficiency_wood'); ?></strong></td>
				<td><strong><?php custom_field($post->ID, 'part_load_net_efficiency_wood'); ?></strong></td>
				<td><strong><?php custom_field($post->ID, 'refuel_period_summer_wood'); ?></strong></td>
			</tr>
			<tr>
				<th>Winter Mineral</th>
				<td><strong><?php custom_field($post->ID, 'rated_output_winter_room_mineral'); ?></strong></td>
				<td><strong><?php custom_field($post->ID, 'rated_output_winter_water_mineral'); ?></strong></td>
				<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_mineral'); ?></strong></td>
				<td><strong><?php custom_field($post->ID, 'part_load_net_efficiency_wood'); ?></strong></td>
				<td><strong><?php custom_field($post->ID, 'refuel_period_winter_mineral'); ?></strong></td>
			</tr>
			<tr>
				<th>Summer Mineral</th>
				<td><strong><?php custom_field($post->ID, 'rated_output_summer_room_mineral'); ?></strong></td>
				<td><strong><?php custom_field($post->ID, 'rated_output_summer_water_mineral'); ?></strong></td>
				<td><strong><?php custom_field($post->ID, 'part_load_gross_efficiency_mineral'); ?></strong></td>
				<td><strong><?php custom_field($post->ID, 'part_load_net_efficiency_mineral'); ?></strong></td>
				<td><strong><?php custom_field($post->ID, 'refuel_period_summer_mineral'); ?></strong></td>
			</tr>
		</table>
		
		<?php endif; ?>
		
		<?php if (has_terms( array('j2','j4'), 'appliance_type_code', $post->ID)) : ?>

			<table class="data">
				<tr>
					<th>&nbsp;</th>
					<td><strong>Rated Output Water (kW)</strong></td>
					<td><strong>Gross Efficiency (%)</strong></td>
					<td><strong>Net Efficiency (%)</strong></td>
					<td><strong>Burn Rate (kg/h)</strong></td>
				</tr>
				<tr>
					<th>Burning<br>Wood</th>
					<td><strong><?php custom_field($post->ID, 'full_load_output_water_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_burn_rate_wood'); ?></strong></td>
				</tr>
				<tr>
					<th>Burning<br>Smokeless</th>
					<td><strong><?php custom_field($post->ID, 'full_load_output_water_mineral'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_mineral'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_mineral'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'refuel_period_mineral'); ?></strong></td>
				</tr>
			</table>

		<?php endif; ?>
		
		<?php if (has_terms( array('j5','j6',), 'appliance_type_code', $post->ID)) : ?>
		
			<table class="data">
				<tr>
					<th>&nbsp;</th>
					<td><strong>Rated Output Water (kW)</strong></td>
					<td><strong>Gross Efficiency (%)</strong></td>
					<td><strong>Net Efficiency (%)</strong></td>
					<td><strong>Burn Rate (kg/h)</strong></td>
				</tr>
				<tr>
					<th>Full Load<br>Pellet</th>
					<td><strong><?php custom_field($post->ID, 'full_load_output_water_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'full_load_burn_rate_wood'); ?></strong></td>
				</tr>
				<tr>
					<th>Part Load<br>Pellet</th>
					<td><strong><?php custom_field($post->ID, 'part_load_output_water_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'part_load_gross_efficiency_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'part_load_net_efficiency_wood'); ?></strong></td>
					<td><strong><?php custom_field($post->ID, 'part_load_burn_rate_wood'); ?></strong></td>
				</tr>
			</table>
		
		<?php endif; ?>

		<?php list_feature_icons($post->ID); ?>

	</div>
<?php } ?>
<dl class="dlist">
	<dt>HETAS No</dt>
	<dd><?php custom_taxonomy($post->ID, 'appliance_type_code'); ?><?php custom_field($post->ID, 'app_id'); ?></dd>
	<?php if (has_field($post->ID, 'app_manufacturer')) : ?>
		<dt>Manufacturer:</dt>
		<dd><?php custom_field($post->ID, 'app_manufacturer'); ?></dd>
	<?php endif; ?>

	<?php if (has_field($post->ID, 'system')) : ?>
		<dt>System:</dt>
		<dd><?php custom_field($post->ID, 'system'); ?></dd>
	<?php endif; ?>

	<?php if (has_field($post->ID, 'certificate_reference')) : ?>
		<dt>Certificate No:</dt>
		<dd><?php custom_field($post->ID, 'certificate_reference'); ?></dd>
	<?php endif; ?>

	<?php if (has_field($post->ID, 'ecolabel_class_rating')) : ?>
		<dt>EcoLabel Class Rating:</dt>
		<dd><?php custom_field($post->ID, 'ecolabel_class_rating'); ?></dd>
	<?php endif; ?>

	<?php if (has_field($post->ID, 'app_manufacturers_remarks')) : ?>
		<dt>Manufacturers Remarks:</dt>
		<dd><?php custom_field($post->ID, 'app_manufacturers_remarks'); ?></dd>
	<?php endif; ?>


	
	<?php if (has_field($post->ID, 'app_sap_efficiency')) : ?>
		<dt>Combined SAP efficiency:</dt>
		<dd><?php custom_field($post->ID, 'app_sap_efficiency'); ?> %</dd>
	<?php endif; ?>

	<?php if (has_field($post->ID, 'chimney_flue_sizes')) : ?>
		<dt>Flue Sizes:</dt>
		<dd><?php custom_field($post->ID, 'chimney_flue_sizes'); ?></dd>
	<?php endif; ?>
	<?php if (has_field($post->ID, 'chimney_designated')) : ?>
		<dt>Designated:</dt>
		<dd><?php custom_field($post->ID, 'chimney_designated'); ?></dd>
	<?php endif; ?>
	<?php if (has_field($post->ID, 'chimney_firestop')) : ?>
		<dt>Firestop:</dt>
		<dd><?php custom_field($post->ID, 'chimney_firestop'); ?></dd>
	<?php endif; ?>
	

	<?php if (has_field($post->ID, 'chimney_tested')) : ?>
		<dt>Tested:</dt>
		<dd><?php custom_field($post->ID, 'chimney_tested'); ?></dd>
	<?php endif; ?>
	
	<?php if (has_field($post->ID, 'chimney_ce_mark_certificate')) : ?>
		<dt>CE Mark Certificate:</dt>
		<dd><?php custom_field($post->ID, 'chimney_ce_mark_certificate'); ?></dd>
	<?php endif; ?>
	
	<?php if (has_field($post->ID, 'chimney_testing_remarks')) : ?>
		<dt>Testing Remarks:</dt>
		<dd><?php custom_field($post->ID, 'chimney_testing_remarks'); ?></dd>
	<?php endif; ?>
	
	<?php if (has_tax($post->ID, 'fuel_types')) : ?>
		<dt>Fuel Types:</dt>
		<dd><?php custom_taxonomy($post->ID, 'fuel_types'); ?></dd>
	<?php endif; ?>											
	
</dl>

<?php } ?>

<?php if(!empty($_GET) && 'preview-app' == $_GET['status']) { ?>


<?php } ?>

<?php if(empty($_GET) && 'preview-app' != $_GET['status']) { ?>

<?php if (has_field($post->ID, 'app_manufacturer_email')) : ?>

	<?php echo do_shortcode( '[ninja_form id=42]' ); ?>

<?php endif; ?>

<?php } ?>

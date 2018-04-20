<?php

if (!defined('ABSPATH')) exit;


// shortcode [yottie]
function elfsight_yottie_shortcode($atts) {
	global $elfsight_yottie_defaults, $elfsight_yottie_add_scripts;

	$elfsight_yottie_add_scripts = true;
	
	foreach ($elfsight_yottie_defaults as $name => $value) {
		if (isset($atts[$name]) && is_bool($value)) {
			$atts[$name] = !empty($atts[$name]) && $atts[$name] != 'false';
		}
	}

	$options = shortcode_atts($defaults = $elfsight_yottie_defaults, $atts, 'yottie');

	$result = '<div data-yt';

	foreach ($options as $name => $value) {
		if ($value !== $elfsight_yottie_defaults[$name]) {

			// boolean
			if (is_bool($value)) {
				$value = $value ? 'true' : 'false';
			}

			// images
			if (($name == 'header_channel_logo' || $name == 'header_channel_banner') && is_numeric($value)) {
				$image_src = wp_get_attachment_image_src($value, 'full');
				$value = array_shift($image_src);
			}

			// source groups
			if ($name == 'source_groups') {
				$value = json_decode(rawurldecode($value));

				if (!is_array($value)) {
					continue;
				}

				foreach($value as $key => $group) {
					if (empty($group->sources)) {
						unset($value[$key]);
					}
					elseif (is_string($group->sources)) {
						$group->sources = preg_split('/[\s\n]/', $group->sources);
					}
				}
				
				$value = !empty($value) ? rawurlencode(json_encode($value)) : '';
			}

			// responsive
			if ($name == 'content_responsive') {
				$value = json_decode(rawurldecode($value));

				if (is_array($value)) {
					$new_value = array();
					foreach($value as $key => $responsive_item) {
						if (!empty($responsive_item->window_width) && (!empty($responsive_item->columns) || !empty($responsive_item->rows) || !empty($responsive_item->gutter))) {
							$new_value[intval($responsive_item->window_width)] = array(
								'columns' => !empty($responsive_item->columns) ? $responsive_item->columns : '',
								'rows' => !empty($responsive_item->rows) ? $responsive_item->rows : '',
								'gutter' => !empty($responsive_item->gutter) ? $responsive_item->gutter : ''
							);
						}
					}

					$value = $new_value;
				}
				
				$value = rawurlencode(json_encode($value));
			}
			
			$result .= sprintf(' data-yt-%s="%s"', str_replace('_', '-', $name), esc_attr($value));
		}
	}
	
	$result .= '></div>';

	return $result;
}
add_shortcode('yottie', 'elfsight_yottie_shortcode');

?>
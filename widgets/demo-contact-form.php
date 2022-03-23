<?php

class Demo_Contact_Form extends \Elementor\Widget_Base
{
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		wp_register_script( 'demo_contact_form_js',  plugins_url( '/OBPress_Contact_Form/widgets/assets/js/demo-contact-form.js'));
		wp_localize_script('demo_contact_form_js', 'contactAjax', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
		));

		wp_register_style( 'demo_contact_form_css', plugins_url( '/OBPress_Contact_Form/widgets/assets/css/demo-contact-form.css') );                 
	}

	public function get_script_depends()
	{
		return ['demo_contact_form_js'];
	}

	public function get_style_depends()
	{
		return ['demo_contact_form_css'];
	}

	public function get_name()
	{
		return 'DemoContactForm';
	}

	public function get_title()
	{
		return __('Demo Contact Form', 'OBPress_Contact_Form');
	}

	public function get_icon()
	{
		return 'fa fa-calendar';
	}

	public function get_categories()
	{
		return ['OBPress'];
	}

	protected function _register_controls()
	{

		// Add option for user to choose in which e-mail messsages will be received
		$this->start_controls_section(
			'email',
			[
				'label' => esc_html__( 'Email', 'OBPress_Contact_Form' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'obpress_contact_email',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'On which email to receive messages?', 'OBPress_Contact_Form' ),
				'min' => 20,
				'max' => 100,
				'label_block' => true
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'main_style_section',
			[
				'label' => __('Form Main Style', 'OBPress_Contact_Form'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'form_inputs_margin',
			[
				'label' => __( 'Inputs Margin', 'OBPress_Contact_Form' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '33',
					'left' => '0',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.obpress-contact-form-holder .obpress-input-holder' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'form_inputs_border',
				'label' => __( 'Inputs Border', 'OBPress_Contact_Form' ),
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width' => [
						'default' => [
							'top' => '1',
							'right' => '1',
							'bottom' => '1',
							'left' => '1',
							'isLinked' => true,
						],
					],
					'color' => [
						'default' => '#c5c5c5',
					],
				],
				'selector' => '.obpress-contact-form-holder .obpress-input-holder input, .obpress-contact-form-holder .obpress-input-holder textarea',
			]
		);

		$this->add_control(
			'form_inputs_border_radius',
			[
				'label' => __( 'Inputs Border Radius', 'OBPress_Contact_Form' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => true
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.obpress-contact-form-holder .obpress-input-holder input, .obpress-contact-form-holder .obpress-input-holder textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'form_inputs_padding',
			[
				'label' => __( 'Inputs Padding', 'OBPress_Contact_Form' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'default' => [
					'top' => '14',
					'right' => '16',
					'bottom' => '13',
					'left' => '16',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.obpress-contact-form-holder .obpress-input-holder input, .obpress-contact-form-holder .obpress-input-holder textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'form_inputs_bg_color',
			[
				'label' => __('Inputs Background Color', 'OBPress_Contact_Form'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#fff',
				'selectors' => [
					'.obpress-contact-form-holder .obpress-input-holder input, .obpress-contact-form-holder .obpress-input-holder textarea' => 'background-color: {{form_inputs_bg_color}}',
				],
			]
		);

		$this->add_control(
			'form_inputs_fonts_color',
			[
				'label' => __('Inputs Fonts Color', 'OBPress_Contact_Form'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#000',
				'selectors' => [
					'.obpress-contact-form-holder .obpress-input-holder input' => 'color: {{form_inputs_fonts_color}}',
					'.obpress-contact-form-holder .obpress-input-holder textarea' => 'color: {{form_inputs_fonts_color}}',
					'.obpress-contact-form-holder .obpress-input-holder input::placeholder' => 'color: {{form_inputs_fonts_color}}',
					'.obpress-contact-form-holder .obpress-input-holder textarea::placeholder' => 'color: {{form_inputs_fonts_color}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'form_inputs_fonts_typography',
				'label' => __('Cards Room Icons Typography', 'OBPress_Contact_Form'),
				'selector' => '.obpress-contact-form-holder .obpress-input-holder input, .obpress-contact-form-holder .obpress-input-holder textarea, .obpress-contact-form-holder .obpress-input-holder input::placeholder, .obpress-contact-form-holder .obpress-input-holder textarea::placeholder',
				'fields_options' => [
					'typography' => [
						'default' => 'yes'
					],
					'font_family' => [
						'default' => 'Montserrat',
					],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '14',
						],
					],
					'font_weight' => [
						'default' => '400',
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'main_style_section',
			[
				'label' => __('Form Main Style', 'OBPress_Contact_Form'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'button_alignment',
			[
				'label' => __( 'Button Alignment', 'OBPress_Contact_Form' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => __( 'Left', 'OBPress_Contact_Form' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'OBPress_Contact_Form' ),
						'icon' => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => __( 'Right', 'OBPress_Contact_Form' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'.obpress-contact-form-holder .obpress-contact-submit' => 'align-self: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}



	protected function render()
	{

		$settings = $this->get_settings_for_display();

		$prevIcon = "url('../icons/back.svg')";
		$nextIcon = "url('../icons/next.svg')";

		$chainId = get_option('chain_id');

        $hotelFolders = BeApi::ApiCache('hotel_folders_'.$chainId, BeApi::$cache_time['hotel_folders'], function() use ($chainId){
            return BeApi::getClientPropertyFolders($chainId)->Result;
        });

		$counter_for_hotel = 0;

		foreach ($hotelFolders as $hotel_in_folder_key => $hotel_in_folder) {
			if ($hotel_in_folder->IsPropertyFolder == false) {
				$counter_for_hotel++;
			}
			if(isset($removedHotels) && $removedHotels != null) {
				foreach ($removedHotels as $removedHotel) {
					if (isset($hotel_in_folder->Property_UID) && $hotel_in_folder->Property_UID != null) {
						if ($hotel_in_folder->Property_UID == $removedHotel) {
							unset($hotelFolders[$hotel_in_folder_key]);
						}
					}
				}
			}
		}
		$hotelFolders = array_values($hotelFolders);

		// var_dump($hotelFolders);

		// if (isset($settings['obpress_custom_slider_top_pagination_bullet_back_icon']['value']['url']) && !empty($settings['obpress_custom_slider_top_pagination_bullet_back_icon']['value']['url'])) {
		// 	$prevIcon = $settings['obpress_custom_slider_top_pagination_bullet_back_icon']['value']['url'];
		// }

		// if (isset($settings['obpress_custom_slider_top_pagination_bullet_next_icon']['value']['url']) && !empty($settings['obpress_custom_slider_top_pagination_bullet_next_icon']['value']['url'])) {
		// 	$nextIcon = $settings['obpress_custom_slider_top_pagination_bullet_next_icon']['value']['url'];
		// }

		require_once(WP_PLUGIN_DIR . '/OBPress_Contact_Form/widgets/assets/templates/demo-contact-form.php');
	}
}

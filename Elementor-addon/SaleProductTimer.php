<?php
namespace MN\Sale_Timer\Elementor;

use MN\Sale_Timer\Utils;

class SaleProductTimer extends \Elementor\Widget_Base {
	public function get_name() {
		return 'mn_el_sale_product_timer';
	}

	public function get_title() {
		return esc_html__( 'Show Sale Product with timer', 'mn_pst' );
	}

	public function get_icon() {
		return 'eicon-counter-circle';
	}

	public function get_categories() {
		return ['mn-rtl', 'basic'];
	}

	public function get_keywords() {
		return ['product', 'products','sale', 'sale product', 'timer', 'counter', 'محصول', 'محصولات', 'آرشیو', 'تایمر', 'تخفیف'];
	}

	protected function register_controls() {
		// Content Tab
		$this->product_control();

		// Style Tab
		$this->style_product_title_control();
		$this->style_product_desc_control();
		$this->style_product_img_control();
		$this->style_product_review_control();
		$this->style_product_price_control();
		$this->style_product_sale_badge_control();
		$this->style_timer_control();
		$this->style_sale_end_text_control();
	}

	private function product_control() {
		$this->start_controls_section(
			'product_section',
			[
				'label' => esc_html__( 'Product Settings', 'mn_pst' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		// Select Product section
		$this->add_control(
			'product',
			[
				'label'			=> esc_html__( "Select Product", 'mn_pst' ),
				'label_block'	=> true,
				'type' 			=> \ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
				'autocomplete'	=> [
					'object'	=> \ElementorPro\Modules\QueryControl\Module::QUERY_OBJECT_POST,
					'query'		=> [
						'post_type'	=> 'product',
					],
				],
			]
		);
		
		// Show sale badge
		$this->add_control(
			'show_sale_badge',
			[
				'label' => esc_html__( 'Show Sale Badge', 'mn_pst' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'mn_pst' ),
				'label_off' => esc_html__( 'Hide', 'mn_pst' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();
	}

	private function style_product_title_control() {
		$selector = "{{WRAPPER}} .product-title";
		$this->start_controls_section(
			'style_pro_title_section',
			[
				'label'	=> esc_html__( 'Product Title style', 'mn_pst' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Padding
		$this->add_responsive_control(
			'pro_title_padding',
			[
				'label'			=> esc_html__( 'Padding', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Margin
		$this->add_responsive_control(
			'pro_title_margin',
			[
				'label'			=> esc_html__( 'Margin', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'selector'	=> "{$selector} a",
				'name'		=> 'pro_title_typography'
			]
		);

		// Text align
		$this->add_responsive_control( 
			'pro_title_text-align',
			[
				'type'	=> \Elementor\Controls_Manager::CHOOSE,
				'label'			=> esc_html__( 'Text align', 'mn_pst' ),
				'options'		=> [
					'left'		=> [
						'title'	=> esc_html__( 'Left', 'mn_pst' ),
						'icon'	=> 'eicon-text-align-left',
					],
					'center'	=> [
						'title'	=> esc_html__( 'Center', 'mn_pst' ),
						'icon'	=> 'eicon-text-align-center',
					],
					'right'		=> [
						'title'	=> esc_html__( 'Right', 'mn_pst' ),
						'icon'	=> 'eicon-text-align-right',
					],
					'justify'	=> [
						'title'	=> esc_html__( 'Justify', 'mn_pst' ),
						'icon'	=> 'eicon-text-align-justify',
					],
				],
				'selectors'		=> [
					$selector	=> 'text-align: {{VALUE}};'
				],
			]
		);

		// Color
		$this->add_control(
			'pro_title_color',
			[
				'label'			=> esc_html__( 'Color', 'mn_pst' ),
				'type'			=> \Elementor\Controls_Manager::COLOR,
				'selectors'		=> [
					"{$selector} a"	=> 'color: {{VALUE}};',
				],
			]
		);

		// Background
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_title_background'
			]
		);

		// Border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_title_border'
			]
		);

		// Border radius
		$this->add_responsive_control(
			'pro_title_border_radius',
			[
				'label'			=> esc_html__( 'Border Radius', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Box shadow
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_title_box_shadow'
			]
		);

		// Text shadow
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_title_text_shadow'
			]
		);

		$this->end_controls_section();
	}

	private function style_product_desc_control() {
		$selector = "{{WRAPPER}} .product_desc";
		$this->start_controls_section(
			'style_desc_section',
			[
				'label'	=> esc_html__( 'Product Excerpt style', 'mn_pst' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Padding
		$this->add_responsive_control(
			'desc_padding',
			[
				'label'			=> esc_html__( 'Padding', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Margin
		$this->add_responsive_control(
			'desc_margin',
			[
				'label'			=> esc_html__( 'Margin', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'desc_typography'
			]
		);

		// Text align
		$this->add_responsive_control( 
			'desc_text-align',
			[
				'type'	=> \Elementor\Controls_Manager::CHOOSE,
				'label'			=> esc_html__( 'Text align', 'mn_pst' ),
				'options'		=> [
					'left'		=> [
						'title'	=> esc_html__( 'Left', 'mn_pst' ),
						'icon'	=> 'eicon-text-align-left',
					],
					'center'	=> [
						'title'	=> esc_html__( 'Center', 'mn_pst' ),
						'icon'	=> 'eicon-text-align-center',
					],
					'right'		=> [
						'title'	=> esc_html__( 'Right', 'mn_pst' ),
						'icon'	=> 'eicon-text-align-right',
					],
					'justify'	=> [
						'title'	=> esc_html__( 'Justify', 'mn_pst' ),
						'icon'	=> 'eicon-text-align-justify',
					],
				],
				'selectors'		=> [
					$selector	=> 'text-align: {{VALUE}};'
				],
			]
		);

		// Color
		$this->add_control(
			'desc_color',
			[
				'label'			=> esc_html__( 'Color', 'mn_pst' ),
				'type'			=> \Elementor\Controls_Manager::COLOR,
				'selectors'		=> [
					$selector	=> 'color: {{VALUE}};',
					"{$selector}::before"	=> 'background-color: {{VALUE}}'
				],
			]
		);

		// Background
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'desc_background'
			]
		);

		// Border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'desc_border'
			]
		);

		// Border radius
		$this->add_responsive_control(
			'desc_border_radius',
			[
				'label'			=> esc_html__( 'Border Radius', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Box shadow
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'desc_box_shadow'
			]
		);

		// Text shadow
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'desc_text_shadow'
			]
		);

		$this->end_controls_section();
	}

	private function style_product_img_control() {
		$selector = "{{WRAPPER}} .product-image img";
		$this->start_controls_section(
			'style_pro_img_section',
			[
				'label'	=> esc_html__( 'Product Image style', 'mn_pst' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Padding
		$this->add_responsive_control(
			'pro_img_padding',
			[
				'label'			=> esc_html__( 'Padding', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Margin
		$this->add_responsive_control(
			'pro_img_margin',
			[
				'label'			=> esc_html__( 'Margin', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_img_border'
			]
		);

		// Border radius
		$this->add_responsive_control(
			'pro_img_border_radius',
			[
				'label'			=> esc_html__( 'Border Radius', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Box shadow
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_img_box_shadow'
			]
		);

		$this->end_controls_section();
	}

	private function style_product_review_control() {
		$selector = "{{WRAPPER}} .product-review";
		$this->start_controls_section(
			'style_pro_review_section',
			[
				'label'	=> esc_html__( 'Product Review style', 'mn_pst' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Padding
		$this->add_responsive_control(
			'pro_review_padding',
			[
				'label'			=> esc_html__( 'Padding', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Margin
		$this->add_responsive_control(
			'pro_review_margin',
			[
				'label'			=> esc_html__( 'Margin', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'selector'	=> "{$selector} .product-review-text",
				'name'		=> 'pro_review_typography'
			]
		);

		// Text align
		$this->add_responsive_control( 
			'pro_review_text-align',
			[
				'type'	=> \Elementor\Controls_Manager::CHOOSE,
				'label'			=> esc_html__( 'Text align', 'mn_pst' ),
				'options'		=> [
					'left'		=> [
						'title'	=> esc_html__( 'Left', 'mn_pst' ),
						'icon'	=> 'eicon-text-align-left',
					],
					'center'	=> [
						'title'	=> esc_html__( 'Center', 'mn_pst' ),
						'icon'	=> 'eicon-text-align-center',
					],
					'right'		=> [
						'title'	=> esc_html__( 'Right', 'mn_pst' ),
						'icon'	=> 'eicon-text-align-right',
					],
					'justify'	=> [
						'title'	=> esc_html__( 'Justify', 'mn_pst' ),
						'icon'	=> 'eicon-text-align-justify',
					],
				],
				'selectors'		=> [
					$selector	=> 'text-align: {{VALUE}};'
				],
			]
		);

		// Color
		$this->add_control(
			'pro_review_color',
			[
				'label'			=> esc_html__( 'Color', 'mn_pst' ),
				'type'			=> \Elementor\Controls_Manager::COLOR,
				'selectors'		=> [
					"{$selector} .product-review-text"	=> 'color: {{VALUE}};',
				],
			]
		);

		// Background
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_review_background'
			]
		);

		// Border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_review_border'
			]
		);

		// Border radius
		$this->add_responsive_control(
			'pro_review_border_radius',
			[
				'label'			=> esc_html__( 'Border Radius', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Box shadow
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_review_box_shadow'
			]
		);

		// Text shadow
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'selector'	=> "{$selector} .product-review-text",
				'name'		=> 'pro_review_text_shadow'
			]
		);

		$this->end_controls_section();
	}

	private function style_product_price_control() {
		$selector = "{{WRAPPER}} .product-price";
		$this->start_controls_section(
			'style_pro_price_section',
			[
				'label'	=> esc_html__( 'Product Price style', 'mn_pst' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Padding
		$this->add_responsive_control(
			'pro_price_padding',
			[
				'label'			=> esc_html__( 'Padding', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Margin
		$this->add_responsive_control(
			'pro_price_margin',
			[
				'label'			=> esc_html__( 'Margin', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'selector'	=> "{$selector} .amount, {$selector} .woocommerce-Price-currencySymbol",
				'name'		=> 'pro_price_typography'
			]
		);

		// Text align
		$this->add_responsive_control( 
			'pro_price_text-align',
			[
				'type'	=> \Elementor\Controls_Manager::CHOOSE,
				'label'			=> esc_html__( 'Text align', 'mn_pst' ),
				'options'		=> [
					'left'		=> [
						'title'	=> esc_html__( 'Left', 'mn_pst' ),
						'icon'	=> 'eicon-text-align-left',
					],
					'center'	=> [
						'title'	=> esc_html__( 'Center', 'mn_pst' ),
						'icon'	=> 'eicon-text-align-center',
					],
					'right'		=> [
						'title'	=> esc_html__( 'Right', 'mn_pst' ),
						'icon'	=> 'eicon-text-align-right',
					],
					'justify'	=> [
						'title'	=> esc_html__( 'Justify', 'mn_pst' ),
						'icon'	=> 'eicon-text-align-justify',
					],
				],
				'selectors'		=> [
					$selector	=> 'text-align: {{VALUE}};'
				],
			]
		);

		// Color
		$this->add_control(
			'pro_price_color',
			[
				'label'			=> esc_html__( 'Color', 'mn_pst' ),
				'type'			=> \Elementor\Controls_Manager::COLOR,
				'selectors'		=> [
					"{$selector} span"	=> 'color: {{VALUE}};',
				],
			]
		);

		// Background
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_price_background'
			]
		);

		// Border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_price_border'
			]
		);

		// Border radius
		$this->add_responsive_control(
			'pro_price_border_radius',
			[
				'label'			=> esc_html__( 'Border Radius', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Box shadow
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_price_box_shadow'
			]
		);

		// Text shadow
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_price_text_shadow'
			]
		);

		$this->end_controls_section();
	}

	private function style_product_sale_badge_control() {
		$selector = "{{WRAPPER}} .sale-tag";
		$this->start_controls_section(
			'style_pro_sale_badge_section',
			[
				'label'		=> esc_html__( 'Product Sale badge style', 'mn_pst' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_STYLE,
				'condition'	=> [
					'show_sale_badge'	=> 'yes'
				]
			]
		);

		// Position
		$this->add_responsive_control( 
			'pro_sale_badge_position',
			[
				'type'	=> \Elementor\Controls_Manager::SELECT,
				'label'			=> esc_html__( 'Position', 'mn_pst' ),
				'options'		=> [
					'left'		=> esc_html__( 'Left', 'mn_pst' ),
					'right'		=> esc_html__( 'Right', 'mn_pst' ),
				],
				'default'		=> 'right'
			]
		);

		// Padding
		$this->add_responsive_control(
			'pro_sale_badge_padding',
			[
				'label'			=> esc_html__( 'Padding', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Margin
		$this->add_responsive_control(
			'pro_sale_badge_margin',
			[
				'label'			=> esc_html__( 'Margin', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_sale_badge_typography'
			]
		);

		// Color
		$this->add_control(
			'pro_sale_badge_color',
			[
				'label'			=> esc_html__( 'Color', 'mn_pst' ),
				'type'			=> \Elementor\Controls_Manager::COLOR,
				'selectors'		=> [
					"{$selector}"	=> 'color: {{VALUE}};',
				],
			]
		);

		// Background
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_sale_badge_background'
			]
		);

		// Border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_sale_badge_border'
			]
		);

		// Border radius
		$this->add_responsive_control(
			'pro_sale_badge_border_radius',
			[
				'label'			=> esc_html__( 'Border Radius', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Box shadow
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_sale_badge_box_shadow'
			]
		);

		// Text shadow
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_sale_badge_text_shadow'
			]
		);

		$this->end_controls_section();
	}

	private function style_timer_control() {
		$selector = "{{WRAPPER}} .product-sale-timer";
		$this->start_controls_section(
			'style_pro_sale_timer_section',
			[
				'label'	=> esc_html__( 'Product Timer style', 'mn_pst' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'selector'	=> "{$selector} h1, {$selector} h2",
				'name'		=> 'pro_timer_typography'
			]
		);

		// Color
		$this->add_control(
			'pro_timer_color',
			[
				'label'			=> esc_html__( 'Color', 'mn_pst' ),
				'type'			=> \Elementor\Controls_Manager::COLOR,
				'selectors'		=> [
					"{$selector} h1, {$selector} h2"	=> 'color: {{VALUE}};',
				],
			]
		);

		// Background
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_timer_background'
			]
		);

		// Border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_timer_border'
			]
		);

		// Border radius
		$this->add_responsive_control(
			'pro_timer_border_radius',
			[
				'label'			=> esc_html__( 'Border Radius', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Box shadow
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_timer_box_shadow'
			]
		);

		// Text shadow
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_timer_text_shadow'
			]
		);

		$this->end_controls_section();
	}

	private function style_sale_end_text_control() {
		$selector = "{{WRAPPER}} .end-sale-alert";
		$this->start_controls_section(
			'style_pro_sale_end_text_section',
			[
				'label'	=> esc_html__( 'Product End of Sale Text style', 'mn_pst' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Padding
		$this->add_responsive_control(
			'pro_sale_end_text_padding',
			[
				'label'			=> esc_html__( 'Padding', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Margin
		$this->add_responsive_control(
			'pro_sale_end_text_margin',
			[
				'label'			=> esc_html__( 'Margin', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'selector'	=> "{$selector} h1",
				'name'		=> 'pro_sale_end_text_typography'
			]
		);

		// Text align
		$this->add_responsive_control( 
			'pro_sale_end_text_text-align',
			[
				'type'	=> \Elementor\Controls_Manager::CHOOSE,
				'label'			=> esc_html__( 'Text align', 'mn_pst' ),
				'options'		=> [
					'left'		=> [
						'title'	=> esc_html__( 'Left', 'mn_pst' ),
						'icon'	=> 'eicon-text-align-left',
					],
					'center'	=> [
						'title'	=> esc_html__( 'Center', 'mn_pst' ),
						'icon'	=> 'eicon-text-align-center',
					],
					'right'		=> [
						'title'	=> esc_html__( 'Right', 'mn_pst' ),
						'icon'	=> 'eicon-text-align-right',
					],
					'justify'	=> [
						'title'	=> esc_html__( 'Justify', 'mn_pst' ),
						'icon'	=> 'eicon-text-align-justify',
					],
				],
				'selectors'		=> [
					"{$selector} h1"	=> 'text-align: {{VALUE}};'
				],
			]
		);

		// Color
		$this->add_control(
			'pro_sale_end_text_color',
			[
				'label'			=> esc_html__( 'Color', 'mn_pst' ),
				'type'			=> \Elementor\Controls_Manager::COLOR,
				'selectors'		=> [
					"{$selector} h1"	=> 'color: {{VALUE}};',
				],
			]
		);

		// Background
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_sale_end_text_background'
			]
		);

		// Border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_sale_end_text_border'
			]
		);

		// Border radius
		$this->add_responsive_control(
			'pro_sale_end_text_border_radius',
			[
				'label'			=> esc_html__( 'Border Radius', 'mn_pst' ),
				'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'		=> [
					$selector	=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Box shadow
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'selector'	=> $selector,
				'name'		=> 'pro_sale_end_text_box_shadow'
			]
		);

		// Text shadow
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'selector'	=> "{$selector} h1",
				'name'		=> 'pro_sale_end_text_text_shadow'
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if( empty( $settings['product'] ) ) return "";
		$product = Utils::convert_chars( $settings['product'], true, 'absint' );
		$show_sale_badge = !empty( $settings['show_sale_badge'] ) && Utils::to_bool( $settings['show_sale_badge'] );

		// Styles
		$pro_sale_badge_position = Utils::convert_chars( $settings['pro_sale_badge_position'] );

		$product = wc_get_product( $product );

		if( wc_review_ratings_enabled() ) {
			$average_rating	= $product->get_average_rating();
		}
		?>
		<section class="special-offer section">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-12 col-12">
						<div class="offer-content">
							<div class="image product-image">
								<?php echo $product->get_image(); ?>
								<?php if( $show_sale_badge && is_numeric( $product->get_sale_price() ) && is_numeric( $product->get_regular_price() ) ) {
									// Calc sale percent
									$sale_percent = '-' . (100 - round( $product->get_sale_price() / $product->get_regular_price() * 100 )) . '%';
									?>
									<span class="sale-tag<?php echo $pro_sale_badge_position == 'right' ? " sale-tag-right" : "" ?>"><?php echo $sale_percent ?></span>
								<?php } ?>
							</div>
							<div class="text">
								<h2 class="product-title"><a href="<?php echo get_permalink( $product->get_id() ); ?>"><?php echo $product->get_name(); ?></a></h2>
								<?php if( wc_review_ratings_enabled() ) { ?>
									<ul class="review product-review">
										<?php for ($i=0; $i <= 5; $i++) { ?>
											<li><i class="lni lni-star<?php $average_rating <= 1 ? '-filled' : ''?>"></i></li>
										<?php } ?>
										<li><span class="product-review-text"><?php echo $average_rating ?> <?php esc_html_e( 'Review(s)', 'mn_pst' ) ?></span></li>
									</ul>
								<?php } ?>
								<div class="price product-price">
									<span><?php echo $product->get_price_html() ?></span>
								</div>
								<?php if( !empty( $pro_desc = $product->get_short_description() ) ) { ?>
									<p class="product_desc"><?php echo $pro_desc; ?></p>
								<?php }?>
							</div>
							<?php if( $product->is_on_sale() ) { ?>
								<?php
									// Calc times
									$final_date = $product->get_date_on_sale_to()->format( 'U' );
									$now = time(); // Converting to milliseconds
    								$diff = $final_date - $now;
									if( $diff < 0 ) {
										$days = '000';
										$hours = '00';
										$minutes = '00';
										$seconds = '00';
									} else {
										// Calculate time components
										$days = floor($diff / (60 * 60 * 24));
										$hours = floor(($diff % (60 * 60 * 24)) / (60 * 60));
										$minutes = floor(($diff % (60 * 60)) / (60));
										$seconds = floor(($diff % (60)));

										// Format time components
										$days = str_pad($days, 3, '0', STR_PAD_LEFT);
										$hours = str_pad($hours, 2, '0', STR_PAD_LEFT);
										$minutes = str_pad($minutes, 2, '0', STR_PAD_LEFT);
										$seconds = str_pad($seconds, 2, '0', STR_PAD_LEFT);
									}
								?>
								<div class="box-head product-sale-timer" data-final-date="<?php echo $final_date; ?>">
									<div class="box">
										<h1 id="days"><?php echo $days ?></h1>
										<h2 id="daystxt">Days</h2>
									</div>
									<div class="box">
										<h1 id="hours"><?php echo $hours ?></h1>
										<h2 id="hourstxt">Hours</h2>
									</div>
									<div class="box">
										<h1 id="minutes"><?php echo $minutes ?></h1>
										<h2 id="minutestxt">Minutes</h2>
									</div>
									<div class="box">
										<h1 id="seconds"><?php echo $seconds ?></h1>
										<h2 id="secondstxt">Secondes</h2>
									</div>
								</div>
							<?php } ?>
							<div class="end-sale-alert">
								<h1><?php printf( esc_html__( 'You are late! Product %s discount is over :(', 'mn_pst' ), $product->get_name() ) ?></h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}
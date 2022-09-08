<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
 
class Rline_Launch_Card_Widget extends \Elementor\Widget_Base {
  
    public function get_name() {
        return 'rline-launch-card';
    }
  
    public function get_title() {
        return __( 'Launch Card', 'rline-elementor-add-on' );
    }
  
    public function get_icon() {
        return 'eicon-carousel';
    }
  
    public function get_categories() {
        return [ 'rline-widgets' ];
    }
 
    public function get_script_depends() {
        wp_register_script("bootstrap-js", "https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js", array(), false, true);
         
        return [
            'bootstrap-js'
        ];
    }
 
    public function get_style_depends() {
        wp_register_style( "bootstrap-css", "https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css", array(), false, "all" );
        wp_register_style( 'rline-launch-card-widget', plugins_url( 'css/rline-launch-card-widget.css', __FILE__ ), array(), false, "all" );
        return [
            'bootstrap-css',
            'rline-launch-card-widget'
        ];
    }
  
    protected function register_controls() {
  
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'rline-elementor-add-on' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'launch_card_title',
			[
				'label' => esc_html__( 'Title', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Launch Title' , 'rline-elementor-add-on' ),
                'label_block' => true,
				'placeholder' => esc_html__( 'Enter your title', 'rline-elementor-add-on' ),
			]
		);
  
        $this->add_control(
            'launch_card_image',
            [
                'label' => esc_html__( 'Choose Image', 'rline-elementor-add-on' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
			'launch_button_text',
			[
				'label' => esc_html__( 'Button Text', 'rline-elementor-add-on' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Conheça' , 'rline-elementor-add-on' ),
                'label_block' => true,
			]
		);

        $this->add_control(
			'launch_card_link',
			[
				'label' => esc_html__( 'Link', 'rline-elementor-add-on' ),
				'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
			]
		);
  
        $this->end_controls_section();

        $this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Style', 'rline-elementor-add-on' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
                'label' => esc_html__( 'Title', 'rline-elementor-add-on' ), 
				'selector' => '{{WRAPPER}} .launch-card .card-title',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
                'label' => esc_html__( 'Product Text', 'rline-elementor-add-on' ),
				'selector' => '{{WRAPPER}} .launch-card .card-text',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_text_typography',
                'label' => esc_html__( 'Button Text', 'rline-elementor-add-on' ),
				'selector' => '{{WRAPPER}} .launch-card .btn',
			]
		);
  
		$this->end_controls_section();

    }
      
    protected function render() {
        // generate the final HTML on the frontend using PHP
        $settings = $this->get_settings_for_display();
        
        ?>
            <div class="card launch-card text-center">
                <img class="card-img-top" src="<?php echo $settings['launch_card_image']['url']; ?>" alt="<?php echo $settings['launch_card_title']; ?>">
                <div class="card-body">
                    <div class="card-product">
                        <span class="card-text">Linha</span>
                        <h5 class="card-title"><?php echo $settings['launch_card_title']; ?></h5>
                    </div>
                    <a href="<?php echo $settings['launch_card_link']['url']; ?>" class="btn stretched-link"><?php echo $settings['launch_button_text']; ?></a>
                </div>
            </div>
            <?php
    }
}
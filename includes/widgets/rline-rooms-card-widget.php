<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
 
class Rline_Rooms_Card_Widget extends \Elementor\Widget_Base {
  
    public function get_name() {
        return 'rline-rooms-card';
    }
  
    public function get_title() {
        return __( 'Rooms Card', 'rline-elementor-add-on' );
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
        wp_register_style( 'rline-rooms-card-widget', plugins_url( 'css/rline-rooms-card-widget.css', __FILE__ ), array(), false, "all" );
        return [
            'bootstrap-css',
            'rline-rooms-card-widget'
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
			'room_card_title',
			[
				'label' => esc_html__( 'Title', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Room Title' , 'rline-elementor-add-on' ),
                'label_block' => true,
				'placeholder' => esc_html__( 'Enter your title', 'rline-elementor-add-on' ),
			]
		);
  
        $this->add_control(
            'room_card_image',
            [
                'label' => esc_html__( 'Choose Image', 'rline-elementor-add-on' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
			'room_card_link',
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
				'selector' => '{{WRAPPER}} .room-link span',
			]
		);
  
		$this->end_controls_section();

    }
      
    protected function render() {
        // generate the final HTML on the frontend using PHP
        $settings = $this->get_settings_for_display();
        
        ?>
            <div class="card room-card">
                <div class="card-img-top">
                    <img src="<?php echo $settings['room_card_image']['url']; ?>"
                        alt="<?php echo $settings['room_card_title']; ?>">
                </div>
                <div class="card-body">
                    <svg class="right-arrow" width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                        fill-rule="evenodd" clip-rule="evenodd">
                        <path
                            d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z" />
                    </svg>
                    <a href="<?php echo $settings['room_card_link']['url']; ?>" class="room-link stretched-link">
                        <span><?php echo $settings['room_card_title']; ?></span>
                    </a>
                </div>
            </div>
            <?php
    }
}
<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
 
class Rline_Home_Carousel_Widget extends \Elementor\Widget_Base {
  
    public function get_name() {
        return 'rline-home-carousel';
    }
  
    public function get_title() {
        return __( 'Home Carousel', 'rline-elementor-add-on' );
    }
  
    public function get_icon() {
        return 'eicon-carousel';
    }
  
    public function get_categories() {
        return [ 'rline-widgets' ];
    }
 
    public function get_script_depends() {
        wp_register_script("bootstrap-js", "https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js", array(), false, true);
		wp_register_script( 'rline-home-carousel-widget', plugins_url( 'js/rline-home-carousel-widget.js', __FILE__ ), array(), false, true);
         
        return [
            'bootstrap-js',
            'rline-home-carousel-widget'
        ];
    }
 
    public function get_style_depends() {
        wp_register_style( "bootstrap-css", "https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css", array(), false, "all" );
        wp_register_style( 'rline-home-carousel-widget', plugins_url( 'css/rline-home-carousel-widget.css', __FILE__ ), array(), false, "all" );
        return [
            'bootstrap-css',
            'rline-home-carousel-widget'
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
  
        $repeater = new \Elementor\Repeater();
  
        $repeater->add_control(
            'home_title', [
                'label' => esc_html__( 'Title', 'rline-elementor-add-on' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'List Title' , 'rline-elementor-add-on' ),
                'label_block' => true,
            ]
        );
  
        $repeater->add_control(
            'home_image',
            [
                'label' => esc_html__( 'Choose Image', 'rline-elementor-add-on' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
  
        $this->add_control(
            'home',
            [
                'label' => esc_html__( 'Slides', 'rline-elementor-add-on' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'home_title' => esc_html__( 'Title #1', 'rline-elementor-add-on' ),
                        'home_image' => esc_html__( 'Item image.', 'rline-elementor-add-on' ),
                    ],
                    [
                        'home_title' => esc_html__( 'Title #2', 'rline-elementor-add-on' ),
                        'home_image' => esc_html__( 'Item image.', 'rline-elementor-add-on' ),
                    ],
                ],
                'title_field' => '{{{ home_title }}}',
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
				'selector' => '{{WRAPPER}} .home-carousel-item .carousel-title h2',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'progress_bar_typography',
                'label' => esc_html__( 'Progress Bar Text', 'rline-elementor-add-on' ),
				'selector' => '{{WRAPPER}} .home-carousel-indicators [data-bs-target] p',
			]
		);
  
		$this->end_controls_section();
    }
      
    protected function render() {
        // generate the final HTML on the frontend using PHP
        $settings = $this->get_settings_for_display();
  
        if ( $settings['home'] ) {
            ?>
                <div id="homeCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-pause="true">
                    <div class="home-carousel-indicators carousel-indicators">
                        <?php $i = 0; ?>
                        <?php foreach (  $settings['home'] as $item ) { ?>
                        <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="<?php echo $i; ?>" <?php if($i==0){ ?> class="active" aria-current="true" <?php } ?>
                            aria-label="<?php echo $item['home_title']; ?>">
                            <p><?php echo $item['home_title']; ?></p>
                            <span></span>
                        </button>
                        <?php $i++; ?>
                        <?php } ?>
                    </div>
                    <div class="carousel-inner">
                        <?php $i = 0; ?>
                        <?php foreach (  $settings['home'] as $item ) { ?>
                            <div class="home-carousel-item carousel-item  <?php echo ($i==0) ? 'active':''; ?>">
                                <img src="<?php echo $item['home_image']['url']; ?>" class="d-block" alt="<?php echo $item['home_title']; ?>">
                                <div class="carousel-title">
                                    <h2><?php echo $item['home_title']; ?></h2>
                                </div>
                            </div>
                        <?php $i++; ?>
                        <?php } ?>
                    </div>
                    <div class="home-carousel-control carousel-control">
                        <button type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
                            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"
                                aria-hidden="true">
                                <path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z" />
                            </svg>
                            <span class="visually-hidden">Next</span>
                        </button>
                        <button type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
                            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"
                                aria-hidden="true">
                                <path d="M2.117 12l7.527 6.235-.644.765-9-7.521 9-7.479.645.764-7.529 6.236h21.884v1h-21.883z" />
                            </svg>
                            <span class="visually-hidden">Previous</span>
                        </button>
                    </div>
                </div>
            <?php
        }
    }
}
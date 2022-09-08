<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
 
class Rline_Product_Carousel_Widget extends \Elementor\Widget_Base {
  
    public function get_name() {
        return 'rline-product-carousel';
    }
  
    public function get_title() {
        return __( 'Product Carousel', 'rline-elementor-add-on' );
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
        wp_register_style( 'rline-product-carousel-widget', plugins_url( 'css/rline-product-carousel-widget.css', __FILE__ ), array(), false, "all" );
        return [
            'bootstrap-css',
            'rline-product-carousel-widget'
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
            'product_title', [
                'label' => esc_html__( 'Product Title', 'rline-elementor-add-on' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'List Title' , 'rline-elementor-add-on' ),
                'label_block' => true,
            ]
        );
  
        $repeater->add_control(
            'product_text', [
                'label' => esc_html__( 'Product Text', 'rline-elementor-add-on' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'label_block' => true,
            ]
        );
  
        $repeater->add_control(
            'product_image',
            [
                'label' => esc_html__( 'Choose Image', 'rline-elementor-add-on' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'product_button_text', [
                'label' => esc_html__( 'Button Text', 'rline-elementor-add-on' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Conheça' , 'rline-elementor-add-on' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'product_link', [
                'label' => esc_html__( 'Product Link', 'rline-elementor-add-on' ),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
  
        $this->add_control(
            'list',
            [
                'label' => esc_html__( 'Slides', 'rline-elementor-add-on' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'product_title' => esc_html__( 'Product #1', 'rline-elementor-add-on' ),
                        'product_image' => esc_html__( 'Image #1', 'rline-elementor-add-on' ),
                        'product_button_text' =>esc_html__( 'Conheça', 'rline-elementor-add-on' ),
                    ],
                    [
                        'product_title' => esc_html__( 'Title #2', 'rline-elementor-add-on' ),
                        'product_image' => esc_html__( 'Image #2', 'rline-elementor-add-on' ),
                        'product_button_text' =>esc_html__( 'Conheça', 'rline-elementor-add-on' ),
                    ],
                ],
                'title_field' => '{{{ product_title }}}',
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
				'selector' => '{{WRAPPER}} .product-space h3',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
                'label' => esc_html__( 'Product Text', 'rline-elementor-add-on' ),
				'selector' => '{{WRAPPER}} .product-text p',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_text_typography',
                'label' => esc_html__( 'Button Text', 'rline-elementor-add-on' ),
				'selector' => '{{WRAPPER}} .product-space .btn',
			]
		);
  
		$this->end_controls_section();

    }
      
    protected function render() {
        // generate the final HTML on the frontend using PHP
        $settings = $this->get_settings_for_display();
  
        if ( $settings['list'] ) {
            ?>
                <div id="productCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php $i = 0; ?>
                        <?php foreach (  $settings['list'] as $item ) { ?>
                            <div class="carousel-item <?php echo ($i==0) ? 'active':''; ?>">
                                <div class="row">
                                    <div class="col-md-5 product-text">
                                        <div>
                                            <?php echo $item['product_text']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-7 product-space">
                                        <h3><?php echo $item['product_title']; ?></h3>
                                        <img src="<?php echo $item['product_image']['url']; ?>"
                                            class="product-image" alt="<?php echo $item['product_title']; ?>">
                                        <div class="d-flex">
                                            <button class="carousel-control-next" data-bs-target="#productCarousel"
                                                data-bs-slide="next">
                                                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                                    clip-rule="evenodd" aria-hidden="true">
                                                    <path
                                                        d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z" />
                                                </svg>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                            <a class="btn" href="<?php echo $item['product_link']['url']; ?>" role="button"><?php echo $item['product_button_text']; ?></a>
                                        </div>
                                    </div>
                                    <div class="col-md-12 carousel-ballast"></div>
                                </div>
                            </div>
                        <?php $i++; ?>
                        <?php } ?>
                    </div>
                </div>
            <?php
        }
    }
}
<?php

if ( ! defined( 'ABSPATH' ) ) {

    exit; // Exit if accessed directly.

}

 

class Rline_Gallery_Carousel_Widget extends \Elementor\Widget_Base {

  

    public function get_name() {

        return 'rline-gallery-carousel';

    }

  

    public function get_title() {

        return __( 'Gallery Carousel', 'rline-elementor-add-on' );

    }

  

    public function get_icon() {

        return 'eicon-carousel';

    }

  

    public function get_categories() {

        return [ 'rline-widgets' ];

    }

 

    public function get_script_depends() {

        wp_register_script("bootstrap-js", "https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js", array(), false, true);

		wp_register_script( 'rline-gallery-carousel-widget', plugins_url( 'js/rline-gallery-carousel-widget.js', __FILE__ ), array(), false, true);

        return [

            'bootstrap-js',

            'rline-gallery-carousel-widget'

        ];

    }

 

    public function get_style_depends() {

        wp_register_style( "bootstrap-css", "https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css", array(), false, "all" );

        wp_register_style( 'rline-gallery-carousel-widget', plugins_url( 'css/rline-gallery-carousel-widget.css', __FILE__ ), array(), false, "all" );

        return [

            'bootstrap-css',

            'rline-gallery-carousel-widget'

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

            'gallery_text', [

                'label' => esc_html__( 'Gallery Text', 'rline-elementor-add-on' ),

                'type' => \Elementor\Controls_Manager::WYSIWYG,

                'label_block' => true,

            ]

        );

  

        $repeater = new \Elementor\Repeater();

  

        $repeater->add_control(

            'gallery_image',

            [

                'label' => esc_html__( 'Choose Image', 'rline-elementor-add-on' ),

                'type' => \Elementor\Controls_Manager::MEDIA,

                'default' => [

                    'url' => \Elementor\Utils::get_placeholder_image_src(),

                ],

            ]

        );

  

        $repeater->add_control(

            'gallery_image_title', [

                'label' => esc_html__( 'Image Title', 'rline-elementor-add-on' ),

                'type' => \Elementor\Controls_Manager::TEXT,

                'default' => esc_html__( 'Image Title' , 'rline-elementor-add-on' ),

                'label_block' => true,

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

                        'gallery_image' => esc_html__( 'Image #1', 'rline-elementor-add-on' ),

                        'gallery_image_title' => esc_html__( 'Title #1', 'rline-elementor-add-on' ),

                        

                    ],

                    [

                        'gallery_image' => esc_html__( 'Image #2', 'rline-elementor-add-on' ),

                        'gallery_image_title' => esc_html__( 'Title #2', 'rline-elementor-add-on' ),

                    ],

                ],

                'title_field' => '{{{ gallery_image_title }}}',

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

				'selector' => '{{WRAPPER}} .gallery-text p',

			]

		);

  

		$this->end_controls_section();



    }

      

    protected function render() {

        // generate the final HTML on the frontend using PHP

        $settings = $this->get_settings_for_display();

  

        if ( $settings['list'] ) {

            ?>

                <div id="galleryCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">

                    <div class="carousel-inner">

                        <div class="container-fluid">

                            <div class="row justify-content-end">

                                <div class="col-md-3 p-0 gallery-text">

                                    <div>

                                        <?php echo $settings['gallery_text']; ?>

                                    </div>

                                </div>

                                <div class="col-md-9 p-0">

                                    <?php $i = 0; ?>

                                    <?php foreach (  $settings['list'] as $item ) { ?>

                                        <div class="gallery-item carousel-item active">

                                            <img src="<?php echo $item['gallery_image']['url']; ?>"

                                                class="image-modal-trigger stretched-link" alt="<?php echo $item['gallery_image_title']; ?>">

                                            <div class="zoom-photo">

                                                <span class="btn zoom-button">

                                                    <svg version="1.1" width="24" height="24" id="Camada_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"

                                                        viewBox="0 0 338.8 337.7" style="enable-background:new 0 0 338.8 337.7;" xml:space="preserve">

                                                        <style type="text/css">

                                                            .st0{fill:#FFFFFF;}

                                                        </style>

                                                        <g>

                                                            <path class="st0" d="M217.8,147.8h-51.5V96.3c0-5.1-4.1-9.2-9.2-9.2s-9.2,4.1-9.2,9.2v51.5H96.4c-5.1,0-9.2,4.1-9.2,9.2

                                                                s4.1,9.2,9.2,9.2h51.5v51.5c0,5.1,4.1,9.2,9.2,9.2s9.2-4.1,9.2-9.2v-51.5h51.5c5.1,0,9.2-4.1,9.2-9.2S222.9,147.8,217.8,147.8z"/>

                                                            <path class="st0" d="M334.4,316.9L272.9,260c24.6-27.6,39.5-64,39.5-103.8C312.4,69.9,242.5,0,156.2,0S0,69.9,0,156.2

                                                                s69.9,156.2,156.2,156.2c37.9,0,72.7-13.5,99.8-36l62.4,57.8c4.8,4.4,12.2,4.1,16.6-0.6S339.1,321.3,334.4,316.9z M156.2,289

                                                                c-73.3,0-132.8-59.5-132.8-132.8S82.9,23.4,156.2,23.4S289,82.9,289,156.2S229.5,289,156.2,289z"/>

                                                        </g>

                                                    </svg>

                                                </span>

                                            </div>

                                        </div>

                                    <?php $i++; ?>

                                    <?php } ?>

                                </div>

                                <div class="col-12 px-1 py-0">

                                    <div class="gallery-carousel-indicators carousel-indicators">

                                        <?php $i = 0; ?>

                                        <?php foreach (  $settings['list'] as $item ) { ?>

                                            <button style="width: <?php echo floor(75/count($settings['list']))."vw" ?>;" data-bs-target="#galleryCarousel"

                                            data-bs-slide-to="<?php echo $i; ?>" <?php if($i==0){ ?> class="active" aria-current="true" <?php } ?> aria-label="<?php echo $item['gallery_image_title']; ?>">

                                                <span></span>

                                            </button>

                                        <?php $i++; ?>

                                        <?php } ?>

                                    </div>

                                    <div class="gallery-carousel-control carousel-control">

                                        <button type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">

                                            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"

                                                clip-rule="evenodd" aria-hidden="true">

                                                <path

                                                    d="M2.117 12l7.527 6.235-.644.765-9-7.521 9-7.479.645.764-7.529 6.236h21.884v1h-21.883z" />

                                            </svg>

                                            <span class="visually-hidden">Previous</span>

                                        </button>

                                        <button type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">

                                            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"

                                                clip-rule="evenodd" aria-hidden="true">

                                                <path

                                                    d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z" />

                                            </svg>

                                            <span class="visually-hidden">Next</span>

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>



                <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"

                    aria-hidden="true">

                    <div class="modal-dialog modal-lg bg-transparent" role="document">

                        <div class="modal-content bg-transparent border-0">

                            <div class="modal-body">

                                <button type="button" class="close" data-bs-dismiss="modal"

                                    aria-label="Close">

                                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">

                                        <!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->

                                        <path

                                            d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z" />

                                    </svg>

                                </button>

                                <img src="" class="img-fluid shadow">

                            </div>

                        </div>

                    </div>

                </div>

            <?php

        }

    }

}
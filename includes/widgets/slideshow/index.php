<?php

namespace Elementor;
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class shyinuaddons_slideshow extends Widget_Base
{

    public function get_name()
    {
        return 'shyinuaddons-slideshow';
    }

    public function get_title()
    {
        return __('Slideshow Addons', 'shyinuaddons');
    }

    public function get_categories()
    {
        return ['shyinuaddons-addons'];
    }

    public function get_icon()
    {
        return 'eicon-posts-group';
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Slideshow', 'shyinuaddons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'title',
            [
                'label' => __( 'Title', 'velanto' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Extra 15% off the up to 80% off sale', 'velanto' ),
            ]
        );
        $repeater->add_control(
            'description',
            [
                'label' => __( 'Info', 'velanto' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Casual pieces for chilling at home', 'velanto' ),
            ]
        );
        $repeater->add_control(
            'link', [
                'label' => __('Link', 'velanto'),
                'type' => Controls_Manager::URL,
                'show_external' => true,
                'default' => [
                    'url' => 'https://unikforce.com',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $repeater->add_control(
            'image',
            [
                'label' => __( 'Image', 'velanto' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'image_m',
            [
                'label' => __( 'Image Mobile', 'velanto' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'slideshow',
            [
                'label' => __( 'Slideshow', 'velanto' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'image' =>[
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' =>[
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' =>[
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],

                ],
                'title_field' => '{{{ title }}}',
            ]
        );
        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $slideshow = $settings['slideshow'];
        $my_current_lang = apply_filters( 'wpml_current_language', NULL );
        ?>
        <section class="search-bar is-relative d-lg-none"><search-bar></search-bar></section>
        <section class="slideshow shinyu-home-banner">
            <div class="swiper-container slideshow-swiper-container bannerSwiper">
                <div class="swiper-wrapper">
                    <?php if ($slideshow): ?>
                        <?php foreach ($slideshow as $slide) : ?>
                            <?php
                            $image_url = wp_get_attachment_image_url($slide['image']['id'], 'slideshow');
                            $image_mobile_url = wp_get_attachment_image_url($slide['image_m']['id'], 'full');

                            if (!$image_mobile_url) $image_mobile_url = $image_url;
                            ?>
                            <div class="swiper-slide slideshow-item d-flex justify-content-center align-items-center text-center">
                                <?php if ($link = $slide['link']['url']) echo '<a class="is-block" href="' . $link . '" target="_blank">'; ?>
                                <div class="slideshow-content d-flex justify-content-center align-items-center text-center">
                                    <div class="slideshow-content-inner">
                                        <h2 class="slideshow-title"><?php echo $slide['title']; ?></h2>
                                        <p class="slideshow-description"><?php echo $slide['description']; ?></p>
                                    </div>
                                </div>
                                <img src="<?php echo $image_url; ?>" class="swiper-lazy d-none d-lg-block" alt="Slideshow">
                                <img src="<?php echo $image_mobile_url; ?>" class="swiper-lazy d-lg-none" alt="Slideshow">
                                <?php if ($slide['link']['url']) echo '</a>'; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="slideshow-navigation swiper-navigation d-flex justify-content-between">
                    <button class="prev">Prev</button>
                    <button class="next">Next</button>
                </div>
                <div class="container">
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
        <section class="search-box">
            <search-box></search-box>
        </section>
        <?php
    }


    protected function content_template()
    {
    }

    public function render_plain_content($instance = [])
    {
    }

}

Plugin::instance()->widgets_manager->register(new shyinuaddons_slideshow());
?>
<?php

namespace Elementor;
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class shyinuaddons_testimonial extends Widget_Base
{

    public function get_name()
    {
        return 'shyinuaddons-testimonial';
    }

    public function get_title()
    {
        return __('Testimonial Addons', 'shyinuaddons');
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
                'label' => __('Content', 'shyinuaddons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'select_page',
            [
                'label' => __('Select Page', 'velanto'),
                'type' => Controls_Manager::SELECT2,
                'options' => shyinuaddons_drop_posts('page'),
                'multiple' => false,
                'label_block' => true,
//                'condition' => [
//                    'query_type' => 'individual',
//                ],
            ]
        ); // Post query
        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $my_current_lang = apply_filters( 'wpml_current_language', NULL );
        $slideshow = $settings['select_page'];
        ?>
        <?php if ($testimonials = get_field('_page_home_testimonial')) : ?>
            <section class="section home-testimonial testimonial">
            <div class="container py-6">
                <h3 class="has-text-primary has-text-centered">
                    <?php if($my_current_lang == 'th'){ echo('เสียงตอบรับจากลูกค้า'); } elseif($my_current_lang == 'ja'){ echo('レビュー'); } else{ echo('Reviews'); } ?>
                </h3>
                <div class="swiper-container testimonial-swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach ($testimonials as $testimonial) : ?>
                            <div class="swiper-slide">
                                <?php echo wp_get_attachment_image($testimonial['image'], 'thumb-room'); ?>
                                <div class="testimonial-item">
                                    <p><strong>“</strong><?php echo $testimonial['message']; ?></p>
                                    <h4><?php echo $testimonial['name']; ?></h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
        <?php endif; ?>
        <?php
    }


    protected function content_template()
    {
    }

    public function render_plain_content($instance = [])
    {
    }

}

Plugin::instance()->widgets_manager->register(new shyinuaddons_testimonial());
?>
<?php

namespace Elementor;
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class shyinuaddons_partner extends Widget_Base
{

    public function get_name()
    {
        return 'shyinuaddons-partner';
    }

    public function get_title()
    {
        return __('Partner Addons', 'shyinuaddons');
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
        <section class="partner d-none d-lg-block">
            <div class="container">
                <h2 class="section-title text-center">
                    <?php if($my_current_lang == 'th'){ echo('พาร์ทเนอร์ของเรา'); } elseif($my_current_lang == 'ja'){ echo('パートナー'); } else{ echo('Our special partners'); } ?>
                </h2>
                <p class="section-description text-center">
                    <?php if($my_current_lang == 'th'){ echo('เพราะเราต้องคัดสรรสิ่งที่ดีที่สุดเพื่อลูกค้าของเรา'); } elseif($my_current_lang == 'ja'){ echo('より良いものをご提供するため'); } else{ echo('Because we need to bring the best things to our customers'); } ?>
                </p>

                <div class="swiper-container partner-swiper-container">
                    <div class="swiper-wrapper">
                        <?php
                        $args = [
                            'post_type'          => 'partner',
                            'posts_per_page'     => -1,
                            'post_status'        => 'publish',
                            'order'              => 'ASC',
                        ];

                        $the_query = new \WP_Query( $args );

                        if ($the_query->have_posts()) :
                            while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                <div class="swiper-slide text-center">
                                    <a href="" target="_blank" class="partner-item d-block"><?php the_post_thumbnail('medium') ?></a>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                    <div class="container">
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
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

Plugin::instance()->widgets_manager->register(new shyinuaddons_partner());
?>
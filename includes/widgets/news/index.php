<?php

namespace Elementor;
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class shyinuaddons_news extends Widget_Base
{

    public function get_name()
    {
        return 'shyinuaddons-news';
    }

    public function get_title()
    {
        return __('News Addons', 'shyinuaddons');
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
        <section class="news">

            <div class="container">
                <h2 class="section-title text-center">
                    <?php if($my_current_lang == 'th'){ echo('ข่าวสารแวดวงอสังหาริมทรัพย์'); } elseif($my_current_lang == 'ja'){ echo('不動産情報'); } else{ echo('Real estate trend, news, and updates'); } ?>
                    <a class="d-none d-md-block" href="<?php echo get_post_type_archive_link('news'); ?>">+</a>
                </h2>
                <p class="section-description text-center">
                    <?php if($my_current_lang == 'th'){ echo('พบกับข่าวสารจากผู้เชี่ยวชาญด้านอสังหาริมทรัพยที่อัพเดทล่าสุด'); } elseif($my_current_lang == 'ja'){ echo('最新のニュース'); } else{ echo('Latest updates and news about real estate and brokerage industry from experienced specialists'); } ?>
                    <a class="d-block d-md-none" href="<?php echo get_post_type_archive_link('news'); ?>"><?php pll_e('View all') ?></a>
                </p>
                <div class="swiper-container news-swiper-container">
                    <div class="swiper-wrapper">
                        <?php
                        $args = [
                            'post_type'          => 'news',
                            'posts_per_page'     => 9,
                            'post_status'        => 'publish',
                            'order'              => 'DESC',
                        ];

                        $the_query = new \WP_Query( $args );

                        if ($the_query->have_posts()) :
                            while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                <div class="swiper-slide">
                                    <div class="news-item card">
                                        <a class="card-image" href="<?php the_permalink(); ?>">
                                            <?php
                                            if (has_post_thumbnail()) : echo get_the_post_thumbnail(get_the_ID(), 'thumb-news');
                                            else : echo "<img src='https://via.placeholder.com/358x210/FFFF00/000000'>";
                                            endif
                                            ?>
                                        </a>
                                        <div class="news-content card-content">
                                            <h4 class="news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                            <a class="news-read" href="<?php the_permalink(); ?>">อ่านเพิ่มเติม</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                    <div class="swiper-pagination"></div>
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

Plugin::instance()->widgets_manager->register(new shyinuaddons_news());
?>
<?php

namespace Elementor;
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class shyinuaddons_services extends Widget_Base
{

    public function get_name()
    {
        return 'shyinuaddons-services';
    }

    public function get_title()
    {
        return __('Services Addons', 'shyinuaddons');
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
        <section class="service">
            <div class="service-background d-none d-lg-block"></div>
            <div class="container">
                <div class="service-inner">
                    <h2 class="section-title text-center">
                        <?php if($my_current_lang == 'th'){ echo('บริการทั้งหมดของชินยู'); } elseif($my_current_lang == 'ja'){ echo('私達のサービスについて'); } else{ echo('Our Service'); } ?>
                    </h2>
                    <p class="section-description text-center">
                        <?php if($my_current_lang == 'th'){ echo('Shinyu Real Estate คือเพื่อนสนิทที่ตอบโจทย์คุณ ด้วยความเชี่ยวชาญทางด้านการลงทุน อสังหาริมทรัพย์ที่มีความเชี่ยวชาญ ทั้งตลาดในไทยและต่างประเทศ'); } elseif($my_current_lang == 'ja'){ echo(''); } else{ echo('Shinyu Real Estate is your true friend who can assist you on real estate investment with specialized experience in both Thai and overseas market.'); } ?></p>
                    <div class="columns is-multiline">
                        <?php
                        $args = [
                            'post_type'          => 'service',
                            'posts_per_page'     => 6,
                            'post_status'        => 'publish',
                            'order'              => 'DESC',
                        ];

                        $the_query = new \WP_Query( $args );

                        if ($the_query->have_posts()) :
                            while ($the_query->have_posts()) : $the_query->the_post();
                                $link = get_permalink();
                                $product_id = get_field('_service_product');
                                if ($product_id) $link = get_permalink($product_id);
                                ?>
                                <div class="column is-4">
                                    <div class="service-item card">
                                        <a class="service-image card-image" href="<?php echo $link; ?>">
                                            <?php
                                            if (has_post_thumbnail()) : echo get_the_post_thumbnail(get_the_ID(), 'thumb-news');
                                            else : echo "<img src='https://via.placeholder.com/358x210/FFFF00/000000'>";
                                            endif
                                            ?>
                                        </a>
                                        <div class="service-content card-content">
                                            <h4 class="service-title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h4>
                                            <p class="service-description"><?php the_field('_service_description'); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>
            </div>
            <p class="has-text-centered"><a class="" href="<?php echo get_post_type_archive_link('service'); ?>"><strong><?php pll_e('View all Services'); ?></strong></a></p>
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

Plugin::instance()->widgets_manager->register(new shyinuaddons_services());
?>
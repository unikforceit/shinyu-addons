<?php

namespace Elementor;
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class shyinuaddons_channel extends Widget_Base
{

    public function get_name()
    {
        return 'shyinuaddons-channel';
    }

    public function get_title()
    {
        return __('Channel Addons', 'shyinuaddons');
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
        <section class="shinyu-channel">
            <div class="container">
                <h2 class="section-title">SHINYU CHANNEL</h2>
                <p class="section-description"><?php pll_e('Another channel for you to stay updated with and learn a wide range of  real estate news and technique : follow us on'); ?></p>
                <div class="columns">
                    <?php
                    $args = [
                        'post_type'          => 'video',
                        'posts_per_page'     => 5,
                        'post_status'        => 'publish',
                        'order'              => 'DESC',
                    ];

                    $i = 0;
                    $big = '';
                    $small = '';

                    $the_query = new \WP_Query( $args );

                    if ($the_query->have_posts()) :
                        while ($the_query->have_posts()) : $the_query->the_post();
                            $i++;

                            if ($i === 1) :
                                $big .= '<a class="media big d-block glightbox" href="'. get_field('_video_url') .'">';
                                $big .= '<figure class="image">';
                                $big .= '<img src="'. webp(get_the_post_thumbnail_url(get_the_ID(), 'large')) .'">';
                                $big .= '</figure>';
                                $big .= '<div class="media-content">';
                                $big .= '<h4 class="pt-4">'. get_the_title() .'</h4>';
                                $big .= '</div>';
                                $big .= '</a>';
                            else :
                                $small .= '<a class="media glightbox" href="'. get_field('_video_url') .'">';
                                $small .= '<div class="media-left">';
                                $small .= '<figure class="image">';
                                $small .= '<img src="'. webp(get_the_post_thumbnail_url(get_the_ID(), 'thumb-video')) .'">';
                                $small .= '</figure>';
                                $small .= '</div>';
                                $small .= '<div class="media-content">';
                                $small .= '<h4>'. get_the_title() .'</h4>';
                                $small .= '</div>';
                                $small .= '</a>';
                            endif;

                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                    <div class="column is-7"><?php echo $big; ?></div>
                    <div class="column is-5">
                        <?php echo $small; ?>
                        <a class="button is-fullwidth mt-5" href="https://www.youtube.com/channel/UCL3QLc5C06VxE6zQvqAwuCw" target="_blank">SHINYU YOUTUBE CHANNEL</a>
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

Plugin::instance()->widgets_manager->register(new shyinuaddons_channel());
?>
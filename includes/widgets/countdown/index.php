<?php

namespace Elementor;
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class shyinuaddons_countdown extends Widget_Base
{

    public function get_name()
    {
        return 'shyinuaddons-countdown';
    }

    public function get_title()
    {
        return __('Countdown Addons', 'shyinuaddons');
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
                'label' => __('Countdown', 'shyinuaddons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_pagi',
            [
                'label' => __( 'Show Pagination', 'shyinuaddons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => esc_html__( 'Show', 'shyinuaddons' ),
                'label_off' => esc_html__( 'Hide', 'shyinuaddons' ),
                'return_value' => 'yes',
            ]
        );
        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $args = array(
            'post_type' => 'product',
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_type',
                    'field'    => 'slug',
                    'terms'    => 'shyinu',
                ),
            ),
            'meta_key' => '_lty_end_date',
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'posts_per_page' => 1,
            'meta_query' => array(
                array(
                    'key' => '_lty_shyinu_status',
                    'value' => 'lty_shyinu_finished',
                    'compare' => '!='
                )
            ),
        );
        $query = new \WP_Query($args);
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                global $product; ?>
                    <div class="lty-shop-timer-wrapper-addon">
                        <div class="lty-shop-timer-container lty-shyinu-countdown-timer" data-time="<?php echo esc_attr( $product->get_countdown_timer_enddate() ) ; ?>">
                            <div class="lty-shop-timer-section"><span id="lty_shyinu_days" class="lty-addon-count-timer"></span><span class="lty-addon-title"><?php echo wp_kses_post( lty_get_shop_page_timer_days_label() ) ; ?></span></div>
                            <div class="lty-shop-timer-section"><span id="lty_shyinu_hours" class="lty-addon-count-timer"></span><span class="lty-addon-title"><?php echo wp_kses_post( lty_get_shop_page_timer_hours_label() ) ; ?></span></div>
                            <div class="lty-shop-timer-section"><span id="lty_shyinu_minutes" class="lty-addon-count-timer"></span><span class="lty-addon-title"><?php echo wp_kses_post( lty_get_shop_page_timer_minutes_label() ) ; ?></span></div>
                            <div class="lty-shop-timer-section"><span id="lty_shyinu_seconds" class="lty-addon-count-timer"></span><span class="lty-addon-title"><?php echo wp_kses_post( lty_get_shop_page_timer_seconds_label() ) ; ?></span></div>
                        </div>
                    </div>
                <?php
                }
            wp_reset_postdata();
        }
    }


    protected function content_template()
    {
    }

    public function render_plain_content($instance = [])
    {
    }

}

Plugin::instance()->widgets_manager->register(new shyinuaddons_countdown());
?>
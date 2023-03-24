<?php

namespace Elementor;
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class shyinuaddons_winners extends Widget_Base
{

    public function get_name()
    {
        return 'shyinuaddons-winners';
    }

    public function get_title()
    {
        return __('Winner List', 'shyinuaddons');
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
                'label' => __('Winner List', 'shyinuaddons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'number_winner',
            [
                'label' => esc_html__('Number Of Winner', 'shyinuaddons'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 10,
            ]
        );
        $this->add_control(
            'show_image',
            [
                'label' => __( 'Show Image', 'shyinuaddons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => esc_html__( 'Show', 'shyinuaddons' ),
                'label_off' => esc_html__( 'Hide', 'shyinuaddons' ),
                'return_value' => 'yes',
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
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array(
            'post_type' => 'lty_shyinu_winner',
            'post_status' => array('lty_publish'),
            'posts_per_page' => $settings['number_winner'],
            'fields' => 'ids',
            'orderby' => 'ID',
            'paged' => $paged
        );
        ?>
        <div class="lty-winner-lists-wrapper">
            <div class="winner-lists-shyinu-addons">
                <?php
                $query = new \WP_Query($args);
                if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $winner = lty_get_shyinu_winner(get_the_ID());
                    $order_id = $winner->get_order_id();
                    $order = wc_get_order($order_id);
                    $end_date = \LTY_Date_Time::get_wp_format_datetime_from_gmt( $winner->get_product()->get_lty_end_date_gmt(), false, ' ', false );
                    ?>
                    <div class="winners-box-lt-a">
                        <?php
                            if ($settings['show_image']) {
                        ?>
                        <div class="winner-img-lty-a">
                            <?php echo wp_kses_post($winner->get_product()->get_image('full')); ?>
                        </div>
                         <?php } ?>
                        <div class="winner-body-txt">
                            <h4><?php echo esc_html($winner->get_product()->get_title()); ?></h4>
                            <p><?php echo esc_html($winner->get_user()->first_name); ?> <?php echo esc_html($winner->get_user()->last_name); ?> from <?php echo esc_html($order->get_billing_city()); ?>
                                <?php echo esc_html( $end_date ); ?></p>
                            <span>Ticket #<?php echo esc_html($winner->get_shyinu_ticket_number()); ?></span>
                        </div>
                    </div>
                    <?php
                }
                // Display pagination links
                ?>
            </div>
            <div class="lty-pagination-wrap">
                <?php
                    if ($settings['show_pagi']) {
                        // Display pagination links
                        $big = 999999999; // need an unlikely integer
                        echo paginate_links(array(
                            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                            'format' => '?paged=%#%',
                            'current' => max(1, $paged),
                            'total' => $query->max_num_pages,
                            'prev_text' => __('« Prev'),
                            'next_text' => __('Next »'),
                            'mid_size' => 4, // number of page links to show on each side of the current page
                            'type' => 'list', // output pagination links as an unordered list
                        ));
                    }
                ?>
            </div>
            <?php
            }
            wp_reset_postdata();
            ?>
        </div>
        <?php
    }


    protected function content_template()
    {
    }

    public function render_plain_content($instance = [])
    {
    }

}

Plugin::instance()->widgets_manager->register(new shyinuaddons_winners());
?>
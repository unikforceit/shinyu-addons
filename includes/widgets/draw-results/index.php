<?php

namespace Elementor;
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class shyinuaddons_draw_res extends Widget_Base
{

    public function get_name()
    {
        return 'shyinuaddons-draw_res';
    }

    public function get_title()
    {
        return __('Draw Results', 'shyinuaddons');
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
                'label' => __('Draw List', 'shyinuaddons'),
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
            'post_type' => 'product',
            'posts_per_page' => $settings['number_winner'],
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_type',
                    'field'    => 'slug',
                    'terms'    => 'shyinu',
                ),
            ),
            'paged' => $paged
        );
        ?>
        <div class="lty-a-competition-results-wrapper">
        <div class="lty-a-result-wrap">
        <?php
        $query = new \WP_Query($args);
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                global $product;
                $tickets = get_post_meta(get_the_ID(), '_lty_hold_tickets', true);
                $status = get_post_meta(get_the_ID(), '_lty_shyinu_status', true);
                $end = get_post_meta(get_the_ID(), '_lty_finished_date', true);
                if ($status == 'lty_shyinu_finished'){
                ?>
                <div class="lty-a-winner-card">
                    <div class="lty-a-card-body">
                        <h4 class="lty-a-card-title"><?php echo esc_html($end); ?></h4>
                        <?php foreach ($tickets as $ticket){ ?>
                        <div class="lty-a-single-result">
                            <strong><?php echo wp_kses_post('$'.$product->get_sale_price());?> <?php the_title(); ?> Winners:</strong>
                            <span class="ticket-winner-name">Jhon Martin</span>
                            <span class="ticket-winner-tn"> - Ticket #<?php echo esc_html($ticket); ?></span>
                        </div>
                    <?php } ?>
                    </div>
                </div>
                <?php
                }
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

Plugin::instance()->widgets_manager->register(new shyinuaddons_draw_res());
?>
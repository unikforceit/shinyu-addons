<?php

namespace Elementor;
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class shyinuaddons_contactform extends Widget_Base
{

    public function get_name()
    {
        return 'shyinuaddons-contactform';
    }

    public function get_title()
    {
        return __('Contact Form Addons', 'shyinuaddons');
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
        <section class="search-bar is-relative custom-global-search">
            <div class="search-box-item">
                <div class="container">
                    <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <div class="autocomplete control">
                            <div class="control is-medium is-clearfix">
                                <div class="columns">
                                    <div class="column is-10">
                                        <input type="search" class="search-field input is-medium" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder', 'your-text-domain' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                                    </div>
                                    <div class="column is-2">
                                        <button type="submit" class="search-submit button is-medium is-danger"><span><?php echo _x( 'Search', 'submit button', 'shyinuaddons' ); ?></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <section class="page-header mb-0">
            <div class="container">
                <h1 class="page-title"><?php the_title(); ?></h1>
                <?php woocommerce_breadcrumb(); ?>
            </div>
        </section><!-- .page-header -->
        <main class="main-content">
            <div class="container">
                <div class="contact-form"><contact-form></contact-form></div>
            </div>
        </main>
        <?php
    }


    protected function content_template()
    {
    }

    public function render_plain_content($instance = [])
    {
    }

}

Plugin::instance()->widgets_manager->register(new shyinuaddons_contactform());
?>
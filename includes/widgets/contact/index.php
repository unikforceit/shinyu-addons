<?php

namespace Elementor;
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class shyinuaddons_contact extends Widget_Base
{

    public function get_name()
    {
        return 'shyinuaddons-contact';
    }

    public function get_title()
    {
        return __('Contact Addons', 'shyinuaddons');
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
        <section class="search-bar is-relative"><search-bar></search-bar></section>
        <section class="page-header mb-0">
            <div class="container">
                <h1 class="page-title"><?php the_title(); ?></h1>
                <?php woocommerce_breadcrumb(); ?>
            </div>
        </section><!-- .page-header -->
        <main class="main-content">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <section class="contact-address">
                        <div class="container">
                            <h3 class="contact-address-name has-text-primary">SHINYU RESIDENCE</h3>
                            <small  class="contact-address-fullname"><?php pll_e('Shinyu Real Estate Co.,Ltd. (Head Office)') ?></small>
                            <div class="columns">
                                <div class="column is-6"><?php the_content(); ?></div>
                                <div class="column pl-sm-6">
                                    <ul>
                                        <li>
                                            <a href="tel:020013033"><?php pll_e('Tel'); ?> : 02-001-3033</a>
                                        </li>
                                        <li>
                                            <a href="mailto:info@shinyurealestate.com"><?php pll_e('Email'); ?> : info@shinyurealestate.com</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="section">
                        <div class="container">
                            <div class="columns">
                                <div class="column is-6">
                                    <?php
                                    $src = 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31007.45807364113!2d100.580582!3d13.722551!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc69dd70382e55f5d!2sShinyu%20Real%20Estate!5e0!3m2!1sen!2sth!4v1615105702371!5m2!1sen!2sth';
                                    if (pll_current_language('locale') === 'th') $src = 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31007.45807364113!2d100.580582!3d13.722551!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc69dd70382e55f5d!2sShinyu%20Real%20Estate!5e0!3m2!1sth!2sth!4v1615105817937!5m2!1sth!2sth';
                                    ?>
                                    <iframe class="contact-map" src="<?php echo $src; ?>" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                </div>
                                <div class="column pl-sm-6">
                                    <div class="contact-form"><contact-form></contact-form></div>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php endwhile; ?>
            <?php endif ?>
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

Plugin::instance()->widgets_manager->register(new shyinuaddons_contact());
?>
<?php

namespace Elementor;
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class shyinuaddons_slideshow extends Widget_Base
{

    public function get_name()
    {
        return 'shyinuaddons-slideshow';
    }

    public function get_title()
    {
        return __('Slideshow Addons', 'shyinuaddons');
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
        $slideshow = $settings['select_page'];
        ?>
        <!--        <section class="search-bar is-relative d-lg-none"><search-bar></search-bar></section>-->
        <section class="slideshow is-loading">
            <div class="swiper-container slideshow-swiper-container">
                <div class="swiper-wrapper">
                    <?php if ($slideshow = get_field('_page_home_slideshow')): ?>
                        <?php foreach ($slideshow as $key => $value) : ?>
                            <?php
                            $image_url = wp_get_attachment_image_url($value['image'], 'slideshow');
                            $image_mobile_url = wp_get_attachment_image_url($value['image_mobile'], 'full');

                            if (!$image_mobile_url) $image_mobile_url = $image_url;
                            ?>
                            <div class="swiper-slide slideshow-item d-flex justify-content-center align-items-center text-center">
                                <?php if ($link = $value['link']) echo '<a class="is-block" href="' . $link . '" target="_blank">'; ?>
                                <div class="slideshow-content d-flex justify-content-center align-items-center text-center">
                                    <div class="slideshow-content-inner">
                                        <h2 class="slideshow-title"><?php echo $value['title']; ?></h2>
                                        <p class="slideshow-description"><?php echo $value['description']; ?></p>
                                    </div>
                                </div>
                                <img data-src="<?php echo $image_url; ?>" class="swiper-lazy d-none d-lg-block">
                                <img data-src="<?php echo $image_mobile_url; ?>" class="swiper-lazy d-lg-none">
                                <?php if ($value['link']) echo '</a>'; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="slideshow-navigation swiper-navigation d-flex justify-content-between">
                    <button class="prev">Prev</button>
                    <button class="next">Next</button>
                </div>
                <div class="container">
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
        <!--        <section class="search-box">-->
        <!--            <search-box></search-box>-->
        <!--        </section>-->
        <section class="search-box custom-global-search">
            <div class="search-box-item">
                <div class="container">
                    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="autocomplete control">
                            <?php shinyu_cs_filter();?>
                            <div class="control is-medium is-clearfix">
                                <div class="columns">
                                    <div class="column is-10">
                                        <input type="search" class="search-field input is-medium"
                                               placeholder="<?php echo esc_attr_x('Search …', 'placeholder', 'your-text-domain'); ?>"
                                               value="<?php echo get_search_query(); ?>" name="s"/>
                                    </div>
                                    <div class="column is-2">
                                        <button type="submit" class="search-submit button is-medium is-danger">
                                            <span><?php echo _x('Search', 'submit button', 'shyinuaddons'); ?></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <?php
    }


    protected
    function content_template()
    {
    }

    public
    function render_plain_content($instance = [])
    {
    }

}

Plugin::instance()->widgets_manager->register(new shyinuaddons_slideshow());
?>
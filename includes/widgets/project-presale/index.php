<?php

namespace Elementor;
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class shyinuaddons_projectpresale extends Widget_Base
{

    public function get_name()
    {
        return 'shyinuaddons-projectpresale';
    }

    public function get_title()
    {
        return __('Project Presale Addons', 'shyinuaddons');
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
        $page_id = $settings['select_page'];
        ?>
        <section class="project-presale d-none d-lg-block">
            <div class="container">
                <h2 class="section-title text-center"><?php pll_e('Pre-sale projects'); ?></h2>
                <p class="section-description text-center"><?php pll_e('Shinyu collects quality projects exclusively for you along with special promotions'); ?></p>
                <?php if (have_rows('_page_home_project')) : ?>
                    <?php $i = 0; ?>
                    <?php while (have_rows('_page_home_project')) : the_row(); ?>
                        <?php $images = get_sub_field('gallery', false, false); ?>
                        <div class="project-presale-item">
                            <div class="columns is-gapless<?php if ($i % 2 != 0) echo ' is-flex-direction-row-reverse' ?>">
                                <div class="column is-6">
                                    <div class="project-presale-gallery">
                                        <?php if ($images ) : ?>
                                            <div class="swiper-container project-swiper-container">
                                                <div class="swiper-wrapper">
                                                    <?php foreach ($images as $image) : ?>
                                                        <div class="swiper-slide">
                                                            <div class="project-presale-gallery-item">
                                                                <img src="<?php echo webp(wp_get_attachment_image_url($image, 'large')); ?>" alt="">
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                    <div class="swiper-pagination"></div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="column is-6">
                                    <div class="project-presale-content">
                                        <h4 class="project-presale-title"><a href="<?php the_sub_field('link'); ?>"><?php the_sub_field('title'); ?></a></h4>
                                        <small class="project-presale-developer">by <?php the_sub_field('developer'); ?></small>
                                        <p class="project-presale-description"><?php the_sub_field('description'); ?></p>
                                        <a href="<?php the_sub_field('link'); ?>" class="project-presale-price"><?php the_sub_field('price'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $i++; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
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

Plugin::instance()->widgets_manager->register(new shyinuaddons_projectpresale());
?>
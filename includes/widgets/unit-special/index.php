<?php

namespace Elementor;
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class shyinuaddons_unitspecial extends Widget_Base
{

    public function get_name()
    {
        return 'shyinuaddons-unitspecial';
    }

    public function get_title()
    {
        return __('Unit special Addons', 'shyinuaddons');
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
        <section class="unit-special">
            <div class="container">
                <h2 class="text-center">
                    <?php if($my_current_lang == 'th'){ echo('ยูนิตคัดพิเศษ'); } elseif($my_current_lang == 'ja'){ echo('おすすめ物件'); } else{ echo('Special Units'); } ?>
                    <small>
                        <?php if($my_current_lang == 'th'){ echo('ชินยู นำมาให้คุณได้เลือกก่อนใคร'); } elseif($my_current_lang == 'ja'){ echo(''); } else{ echo('Special Units for you to choose'); } ?>
                    </small>
                </h2>
                <div class="unit-special-app"><unit-special></unit-special></div>
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

Plugin::instance()->widgets_manager->register(new shyinuaddons_unitspecial());
?>
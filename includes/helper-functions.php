<?php
function shyinuaddons_check_odd_even($data)
{
    if ($data % 2 == 0) {
        $data = "Even";
    } else {
        $data = "Odd";
    }

    return $data;
}

function shyinuaddons_get_that_link($link)
{

    $url = $link['url'] ? 'href=' . esc_url($link['url']) . '' : '';
    $ext = $link['is_external'] ? 'target= _blank' : '';
    $nofollow = $link['nofollow'] ? 'rel="nofollow"' : '';
    $link = $url . ' ' . $ext . ' ' . $nofollow;
    return $link;
}

function shyinuaddons_get_that_image($source, $class = 'image')
{
    if ($source) {
        $image = '<img class="' . $class . '" src="' . esc_url($source['url']) . '" alt="' . get_bloginfo('name') . '">';
    }
    return $image;
}

function shyinuaddons_drop_posts($post_type)
{
    $args = array(
        'numberposts' => -1,
        'post_type' => $post_type
    );

    $posts = get_posts($args);
    $list = array();
    foreach ($posts as $cpost) {
        //  print_r($cform);
        $list[$cpost->ID] = $cpost->post_title;
    }
    return $list;
}
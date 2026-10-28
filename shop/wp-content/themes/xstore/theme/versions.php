<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

$main_domain = 'http://8theme.com/demo/xstore/';

return array(
    'default' => array(
        'title' => 'Default',
        'preview_url' => $main_domain,
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'widgets' => true,
            'options' => true,
            'menu' => true,
            'home_page' => true
        ),
        'plugins' => array( 'mpc-massive' ),
        'type' => 'demo'
    ),
    'cryptocurrency' => array(
        'title' => 'Cryptocurrency',
        'preview_url' => $main_domain . '2/cryptocurrency/',
        'to_import' => array(
            'content' => true,
            'slider' => false,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp', 'cryptocurrency-price-ticker-widget', 'cryptocurrency-rocket-tools' ),
        'type' => 'demo'
    ),
    'designers' => array(
        'title' => 'Designers',
        'preview_url' => $main_domain . '2/designers/',
        'to_import' => array(
            'content' => true,
            'slider' => 2,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'cleaning' => array(
        'title' => 'Cleaning',
        'preview_url' => $main_domain . '2/cleaning/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'baby-shop' => array(
        'title' => 'Baby Shop',
        'preview_url' => $main_domain . '2/baby-shop/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'carwash' => array(
        'title' => 'Car wash',
        'preview_url' => $main_domain . '2/carwash/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'delivery' => array(
        'title' => 'Delivery',
        'preview_url' => $main_domain . '2/delivery/',
        'to_import' => array(
            'content' => true,
            'slider' => false,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'photographer' => array(
        'title' => 'Photographer',
        'preview_url' => $main_domain . '2/photographer/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'x-phone' => array(
        'title' => 'X-Phone',
        'preview_url' => $main_domain . '2/x-phone/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'caramel' => array(
        'title' => 'Caramel',
        'preview_url' => $main_domain . 'caramel/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'plumbing' => array(
        'title' => 'Plumbing',
        'preview_url' => $main_domain . '2/plumbing/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'furniture2' => array(
        'title' => 'Furniture 2',
        'preview_url' => $main_domain . 'furniture2/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'interior' => array(
        'title' => 'Interior',
        'preview_url' => $main_domain . 'interior/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'spa' => array(
        'title' => 'Typography',
        'preview_url' => $main_domain . 'spa/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'mobile' => array(
        'title' => 'Mobile Apps',
        'preview_url' => $main_domain . 'mobile/',
        'to_import' => array(
            'content' => true,
            'slider' => 2,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'burger' => array(
        'title' => 'Burger',
        'preview_url' => $main_domain . 'burger/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'wedding' => array(
        'title' => 'Wedding',
        'preview_url' => $main_domain . 'wedding/',
        'to_import' => array(
            'content' => true,
            'slider' => 2,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'type' => 'demo'
    ),
    'bicycle' => array(
        'title' => 'Bicycle',
        'preview_url' => $main_domain . 'bike/',
        'to_import' => array(
            'content' => true,
            'slider' => 3,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'type' => 'demo'
    ),
    'furniture' => array(
        'title' => 'Furniture',
        'preview_url' => $main_domain . 'furniture/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'type' => 'demo'
    ),
    'cosmetics' => array(
        'title' => 'Cosmetics',
        'preview_url' => $main_domain . 'cosmetics/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'type' => 'demo'
    ),
    'engineer' => array(
        'title' => 'Engineer',
        'preview_url' => $main_domain . 'engineer/',
        'to_import' => array(
            'content' => true,
            'slider' => 2,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'type' => 'demo'
    ),
    'glasses' => array(
        'title' => 'Glasses',
        'preview_url' => $main_domain . 'glasses/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'type' => 'demo'
    ),
    'kids' => array(
        'title' => 'Kids',
        'preview_url' => $main_domain . 'kids/',
        'to_import' => array(
            'content' => true,
            'slider' => 2,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'type' => 'demo'
    ),
    'organic' => array(
        'title' => 'Organic',
        'preview_url' => $main_domain . 'organic/',
        'to_import' => array(
            'content' => true,
            'slider' => 2,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'type' => 'demo'
    ),
    'drinks' => array(
        'title' => 'Drinks',
        'preview_url' => $main_domain . 'drink/',
        'to_import' => array(
            'content' => true,
            'slider' => 2,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'type' => 'demo'
    ),
    'bakery' => array(
        'title' => 'Bakery',
        'preview_url' => $main_domain . 'bakery/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'type' => 'demo'
    ),
    'hipster' => array(
        'title' => 'Hipster',
        'preview_url' => $main_domain . 'hipster/',
        'to_import' => array(
            'content' => true,
            'slider' => 2,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'type' => 'demo'
    ),
    'jewellery' => array(
        'title' => 'Jewellery',
        'preview_url' => $main_domain . 'jewellery/',
        'to_import' => array(
            'content' => true,
            'slider' => 2,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'type' => 'demo'
    ),
    'landing' => array(
        'title' => 'Landing',
        'preview_url' => $main_domain . 'landing-watch/',
        'to_import' => array(
            'content' => true,
            'slider' => 2,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'type' => 'demo'
    ),
    'hosting' => array(
        'title' => 'Hosting',
        'preview_url' => $main_domain . 'hosting/',
        'to_import' => array(
            'content' => true,
            'slider' => 2,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'subscriptio' ),
        'type' => 'demo'
    ),
    'electronics' => array(
        'title' => 'Electronics',
        'preview_url' => $main_domain . 'electronics/',
        'to_import' => array(
            'content' => true,
            'slider' => 2,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array(),
        'type' => 'demo'
    ),
    'christmas' => array(
        'title' => 'Christmas',
        'preview_url' => $main_domain . 'christmas/',
        'to_import' => array(
            'content' => true,
            'slider' => 2,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array(),
        'type' => 'demo'
    ),
    'sushi' => array(
        'title' => 'Sushi Restaurant',
        'preview_url' => $main_domain . 'sushi/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7' ),
        'type' => 'demo'
    ),
    'gym' => array(
        'title' => 'Gym',
        'preview_url' => $main_domain . 'gym/',
        'to_import' => array(
            'content' => true,
            'slider' => 2,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7' ),
        'type' => 'demo'
    ),
    'corporate' => array(
        'title' => 'Corporate',
        'preview_url' => $main_domain . 'corporate/',
        'to_import' => array(
            'content' => true,
            'slider' => 1,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7' ),
        'type' => 'demo'
    ),  
    'finances' => array(
        'title' => 'Finances',
        'preview_url' => $main_domain . 'finances/',
        'to_import' => array(
            'content' => true,
            'slider' => 1,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
     'marketing' => array(
        'title' => 'Marketing',
        'preview_url' => $main_domain . 'marketing/',
        'to_import' => array(
            'content' => true,
            'slider' => 1,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ), 
     'lawyer' => array(
        'title' => 'Lawyer',
        'preview_url' => $main_domain . 'lawyer/',
        'to_import' => array(
            'content' => true,
            'slider' => 1,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'flowers' => array(
        'title' => 'Flowers',
        'preview_url' => $main_domain . 'flowers/',
        'to_import' => array(
            'content' => true,
            'slider' => 1,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'handmade' => array(
        'title' => 'Handmade',
        'preview_url' => $main_domain . 'handmade/',
        'to_import' => array(
            'content' => true,
            'slider' => 2,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'medical' => array(
        'title' => 'Medical',
        'preview_url' => $main_domain . 'medical/',
        'to_import' => array(
            'content' => true,
            'slider' => 1,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'minimal' => array(
        'title' => 'Minimal',
        'preview_url' => $main_domain . 'minimal/',
        'to_import' => array(
            'content' => true,
            'slider' => 1,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'concert' => array(
        'title' => 'Concert',
        'preview_url' => $main_domain . 'concert/',
        'to_import' => array(
            'content' => true,
            'slider' => 1,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'animals' => array(
        'title' => 'animals',
        'preview_url' => $main_domain . 'animals/',
        'to_import' => array(
            'content' => true,
            'slider' => 1,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'underwear' => array(
        'title' => 'underwear',
        'preview_url' => $main_domain . 'underwear/',
        'to_import' => array(
            'content' => true,
            'slider' => 1,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'books' => array(
        'title' => 'books',
        'preview_url' => $main_domain . 'books/',
        'to_import' => array(
            'content' => true,
            'slider' => 3,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'makeup' => array(
        'title' => 'makeup',
        'preview_url' => $main_domain . 'makeup/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'tea' => array(
        'title' => 'Tea',
        'preview_url' => $main_domain . 'tea/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'freelance' => array(
        'title' => 'Freelance',
        'preview_url' => $main_domain . 'freelance/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'shoes' => array(
        'title' => 'Shoes',
        'preview_url' => $main_domain . 'shoes/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'coctails' => array(
        'title' => 'Сocktails',
        'preview_url' => $main_domain . 'cocktails/',
        'to_import' => array(
            'content' => true,
            'slider' => 2,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'barbershop' => array(
        'title' => 'Barbershop',
        'preview_url' => $main_domain . 'barbershop/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'business' => array(
        'title' => 'Business',
        'preview_url' => $main_domain . 'business/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'games' => array(
        'title' => 'Games',
        'preview_url' => $main_domain . 'games/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'typography' => array(
        'title' => 'Typography',
        'preview_url' => $main_domain . 'typography/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'pizza' => array(
        'title' => 'Pizza',
        'preview_url' => $main_domain . 'pizza/',
        'to_import' => array(
            'content' => true,
            'slider' => 3,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'plugins' => array( 'mpc-massive', 'wwp-vc-gmaps', 'contact-form-7', 'mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'dark' => array(
        'title' => 'Dark',
        'preview_url' => $main_domain . 'dark/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'options' => true,
            'widgets' => true,
            'home_page' => true,
        ),
        'type' => 'demo'
    ),
    'faq' => array(
        'title' => 'FaQ',
        'preview_url' => $main_domain . 'typography-page/faq/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'default-red' => array(
        'title' => 'Home default red',
        'preview_url' => $main_domain . 'home-default/?preset=header1/',
        'to_import' => array(
            'content' => true,
            'slider' => true,
            'widgets' => true,
            'home_page' => true,
            'options' => true,
        ),
        'type' => 'page'
    ),
    'default-new' => array(
        'title' => 'Home default yellow',
        'preview_url' => $main_domain . '',
        'to_import' => array(
            'content' => true,
            'home_page' => true,
            'options' => true,
            'slider' => true,
        ),
        'type' => 'page'
    ),
    'presentation' => array(
        'title' => 'Home parallax',
        'preview_url' => $main_domain . 'home-presentation/?preset=header6',
        'to_import' => array(
            'content' => true,
            'home_page' => true,
            'options' => true,
        ),
        'type' => 'page'
    ),
    'parallax' => array(
        'title' => 'Home slide',
        'preview_url' => $main_domain . 'home-slide/?preset=lookbook',
        'to_import' => array(
            'content' => true,
            'home_page' => true,
            'slider' => true,
            'options' => true,
        ),
        'type' => 'page'
    ),
    'banners' => array(
        'title' => 'Home banners',
        'preview_url' => $main_domain . 'home-banners/?preset=header2',
        'to_import' => array(
            'content' => true,
            'home_page' => true,
            'slider' => true,
            'options' => true,
        ),
        'type' => 'page'
    ),
    'full-width' => array(
        'title' => 'Home full width',
        'preview_url' => $main_domain . 'home-full-width/?preset=header2',
        'to_import' => array(
            'content' => true,
            'home_page' => true,
            'slider' => true,
            'options' => true,
        ),
        'type' => 'page'
    ),
    'simple' => array(
        'title' => 'Home simple',
        'preview_url' => $main_domain . 'home-simple/',
        'to_import' => array(
            'content' => true,
            'home_page' => true,
            'slider' => true,
            'options' => true,
        ),
        'type' => 'page'
    ),
    'video' => array(
        'title' => 'Home video',
        'preview_url' => $main_domain . 'home-video/',
        'to_import' => array(
            'content' => true,
            'home_page' => true,
            'slider' => true,
            'options' => true,
        ),
        'type' => 'page'
    ),
    'home-minimal' => array(
        'title' => 'Home minimal',
        'preview_url' => $main_domain . 'home-minimal/?preset=header6',
        'to_import' => array(
            'content' => true,
            'home_page' => true,
            'slider' => 2,
            'options' => true,
        ),
        'type' => 'page'
    ),
    'flat' => array(
        'title' => 'Home flat',
        'preview_url' => $main_domain . 'home-flat/?preset=header6',
        'to_import' => array(
            'content' => true,
            'home_page' => true,
            'slider' => true,
            'options' => true,
        ),
        'type' => 'page'
    ),
    'boxed' => array(
        'title' => 'Home boxed',
        'preview_url' => $main_domain . 'home-boxed/?preset=suits',
        'to_import' => array(
            'content' => true,
            'home_page' => true,
            'slider' => true,
            'options' => true,
        ),
        'type' => 'page'
    ),
    'coming-soon-yellow' => array(
        'title' => 'Coming soon yellow',
        'preview_url' => $main_domain . '2/coming-soon-yellow/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'coming-soon' => array(
        'title' => 'Coming soon',
        'preview_url' => $main_domain . 'coming-soon-page/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'coming-soon-dark' => array(
        'title' => 'Coming soon dark',
        'preview_url' => $main_domain . 'coming-soon-black/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'coming-soon-dark2' => array(
        'title' => 'Coming soon dark2',
        'preview_url' => $main_domain . 'coming-soon-black2/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'coming-soon-white' => array(
        'title' => 'Coming soon white',
        'preview_url' => $main_domain . 'coming-soon-white/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'coming-soon-flat' => array(
        'title' => 'Coming soon flat',
        'preview_url' => $main_domain . 'coming-soon-flat/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'coming-soon-xstore' => array(
        'title' => 'Coming soon xstore',
        'preview_url' => $main_domain . 'coming-soon-xstore/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'we-are-coming-soon' => array(
        'title' => 'We are coming soon',
        'preview_url' => $main_domain . '2/we-are-coming-soon/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'great-things-are-coming' => array(
        'title' => 'Great things are coming',
        'preview_url' => $main_domain . '2/great-things-are-coming/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'merry-christmas-is-coming' => array(
        'title' => 'Merry Christmas is coming',
        'preview_url' => $main_domain . '2/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'modern-x-coming' => array(
        'title' => 'Modern X coming',
        'preview_url' => $main_domain . '2/modern-x-coming/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'space-coming' => array(
        'title' => 'Space coming',
        'preview_url' => $main_domain . '2/space-coming/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'x-coming' => array(
        'title' => 'X coming',
        'preview_url' => $main_domain . '2/x-coming/',
        'to_import' => array(
            'content' => true,
            'slider' => true
        ),
        'type' => 'page'
    ),
    'about-us' => array(
        'title' => 'About Us 2',
        'preview_url' => $main_domain . 'typography-page/about-us/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'about-us-3' => array(
        'title' => 'About Us 3',
        'preview_url' => $main_domain . 'typography-page/about-us-two/?preset=about-us-2',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'about-cosmetics' => array(
        'title' => 'About Cosmetics',
        'preview_url' => $main_domain . 'cosmetics/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => true
        ),
        'type' => 'page'
    ),
    'about-engineer' => array(
        'title' => 'About Engineer',
        'preview_url' => $main_domain . 'engineer/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => true
        ),
        'type' => 'page'
    ),
    'about-glasses' => array(
        'title' => 'About Glasses',
        'preview_url' => $main_domain . 'glasses/',
        'to_import' => array(
            'content' => true,
            'slider' => true
        ),
        'type' => 'page'
    ),
    'about-kids' => array(
        'title' => 'About Kids',
        'preview_url' => $main_domain . 'kids/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'about-organic' => array(
        'title' => 'About Organic',
        'preview_url' => $main_domain . 'organic/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'about-furniture' => array(
        'title' => 'About Furniture',
        'preview_url' => $main_domain . 'furniture/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'about-bakery' => array(
        'title' => 'About Bakery',
        'preview_url' => $main_domain . 'bakery/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'about-hipster' => array(
        'title' => 'About hipster',
        'preview_url' => $main_domain . 'hipster/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'about-jewellery' => array(
        'title' => 'About jewellery',
        'preview_url' => $main_domain . 'jewellery/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'about-hosting' => array(
        'title' => 'About hosting',
        'preview_url' => $main_domain . 'hosting/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'about-electronics' => array(
        'title' => 'About electronics',
        'preview_url' => $main_domain . 'electronics/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'about-sushi' => array(
        'title' => 'About Sushi',
        'preview_url' => $main_domain . 'sushi/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => true
        ),
        'type' => 'page'
    ),
    'about-gym' => array(
        'title' => 'About Gym',
        'preview_url' => $main_domain . 'gym/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => true
        ),
        'type' => 'page'
    ),
    'contacts-organic' => array(
        'title' => 'Contacts Organic',
        'preview_url' => $main_domain . 'organic/contact/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'contacts-hosting' => array(
        'title' => 'Contacts hosting',
        'preview_url' => $main_domain . 'hosting/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'contacts-electronics' => array(
        'title' => 'Contacts electronics',
        'preview_url' => $main_domain . 'electronics/contact/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'our-history-drinks' => array(
        'title' => 'Our history drinks',
        'preview_url' => $main_domain . 'drink/our-history/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'christmas-contact' => array(
        'title' => 'Contacts Christmas',
        'preview_url' => $main_domain . 'christmas/contact/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'sushi-contacts' => array(
        'title' => 'Contacts Sushi',
        'preview_url' => $main_domain . 'sushi/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'gym-contacts' => array(
        'title' => 'Contacts Gym',
        'preview_url' => $main_domain . 'gym/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'look-book-fresh' => array(
        'title' => 'Look Book Fresh',
        'preview_url' => $main_domain . 'typography-page/look-book-fresh/?preset=lookbook',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'look-book' => array(
        'title' => 'Look Book',
        'preview_url' => $main_domain . 'typography-page/look-book/?preset=lookbook',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'team' => array(
        'title' => 'Meet the team',
        'preview_url' => $main_domain . 'typography-page/team-members/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'single-member' => array(
        'title' => 'Single Member',
        'preview_url' => $main_domain . 'typography-page/single-member-page/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'parallax-presentation' => array(
        'title' => 'Parallax Presentation',
        'preview_url' => $main_domain . 'typography-page/parallax-presentation/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'modern-process' => array(
        'title' => 'Modern Process',
        'preview_url' => $main_domain . 'typography-page/modern-process/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'informations' => array(
        'title' => 'Informations',
        'preview_url' => $main_domain . 'typography-page/informations/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'sushi-info' => array(
        'title' => 'Sushi Information',
        'preview_url' => $main_domain . 'sushi/information/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'our-office' => array(
        'title' => 'Our Office',
        'preview_url' => $main_domain . 'our-office/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'instagram' => array(
        'title' => 'Instagram Wall',
        'preview_url' => $main_domain . 'typography-page/instagram-wall/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'track-order' => array(
        'title' => 'Track order',
        'preview_url' => $main_domain . 'track-order-2/',
        'to_import' => array(
            'content' => true
        ),
        'type' => 'page'
    ),
    'christmas-santa-road' => array(
        'title' => 'Santa road',
        'preview_url' => $main_domain . 'christmas/santa-road/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'sushi-menu' => array(
        'title' => 'Sushi Menu',
        'preview_url' => $main_domain . 'sushi/our-menu/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'corporate-service' => array(
        'title' => 'Corporate service',
        'preview_url' => $main_domain . 'corporate/services/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'corporate-certificates' => array(
        'title' => 'Corporate certificates',
        'preview_url' => $main_domain . 'corporate/certificates/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'corporate-team' => array(
        'title' => 'Corporate team',
        'preview_url' => $main_domain . 'corporate/team/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'corporate-contacts' => array(
        'title' => 'Corporate contacts',
        'preview_url' => $main_domain . 'corporate/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'finances-about' => array(
        'title' => 'Finances About',
        'preview_url' => $main_domain . 'finances/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'finances-contacts' => array(
        'title' => 'Finances contacts',
        'preview_url' => $main_domain . 'finances/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'finances-services' => array(
        'title' => 'Finances services',
        'preview_url' => $main_domain . 'finances/offer/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'about-marketing' => array(
        'title' => 'Marketing About',
        'preview_url' => $main_domain . 'marketing/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'contacts-marketing' => array(
        'title' => 'Marketing contacts',
        'preview_url' => $main_domain . 'marketing/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'marketing-works' => array(
        'title' => 'Marketing works',
        'preview_url' => $main_domain . 'marketing/works/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'marketing-services' => array(
        'title' => 'Marketing services',
        'preview_url' => $main_domain . 'marketing/services/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'marketing-offers' => array(
        'title' => 'Marketing offers',
        'preview_url' => $main_domain . 'marketing/offers/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'lawyer-about' => array(
        'title' => 'Lawyer about',
        'preview_url' => $main_domain . 'lawyer/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'lawyer-team' => array(
        'title' => 'Lawyer team',
        'preview_url' => $main_domain . 'lawyer/lawyers-team/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'lawyer-contacts' => array(
        'title' => 'Lawyer contacts',
        'preview_url' => $main_domain . 'lawyer/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'lawyer-services' => array(
        'title' => 'Lawyer services',
        'preview_url' => $main_domain . 'lawyer/services/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'flowers-about' => array(
        'title' => 'Flowers about',
        'preview_url' => $main_domain . 'flowers/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'flowers-contacts' => array(
        'title' => 'Flowers contacts',
        'preview_url' => $main_domain . 'flowers/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'handmade-instruction' => array(
        'title' => 'Handmade instruction',
        'preview_url' => $main_domain . 'handmade/instruction',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'medical-doctors' => array(
        'title' => 'Medical doctors',
        'preview_url' => $main_domain . 'medical/our-doctors',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'medical-offers' => array(
        'title' => 'Medical offers',
        'preview_url' => $main_domain . 'medical/offers',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'medical-contacts' => array(
        'title' => 'Medical contacts',
        'preview_url' => $main_domain . 'medical/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'minimal-contacts' => array(
        'title' => 'Minimal contacts',
        'preview_url' => $main_domain . 'minimal/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'minimal-about' => array(
        'title' => 'Minimal about',
        'preview_url' => $main_domain . 'minimal/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'minimal-lookbook' => array(
        'title' => 'Minimal lookbook',
        'preview_url' => $main_domain . 'minimal/lookbook/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'concert-gallery' => array(
        'title' => 'Concert gallery',
        'preview_url' => $main_domain . 'concert/gallery/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'concert-contactus' => array(
        'title' => 'Concert contacts',
        'preview_url' => $main_domain . 'concert/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'concert-introduction' => array(
        'title' => 'Concert introduction',
        'preview_url' => $main_domain . 'concert/place-introduction/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'animals-about' => array(
        'title' => 'Animals about',
        'preview_url' => $main_domain . 'animals/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'animals-contactus' => array(
        'title' => 'Animals contacts',
        'preview_url' => $main_domain . 'animals/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'underwear-about' => array(
        'title' => 'Underwear about',
        'preview_url' => $main_domain . 'underwear/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'underwear-contacts' => array(
        'title' => 'Underwear contacts',
        'preview_url' => $main_domain . 'underwear/contacts/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'books-store' => array(
        'title' => 'Books store',
        'preview_url' => $main_domain . 'books/store/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'books-author' => array(
        'title' => 'Books author',
        'preview_url' => $main_domain . 'books/author/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'books-contacts' => array(
        'title' => 'Books contacts',
        'preview_url' => $main_domain . 'books/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'books-about' => array(
        'title' => 'Books about',
        'preview_url' => $main_domain . 'books/about/',
        'to_import' => array(
            'content' => true,
            'slider' => 1
        ),
        'type' => 'page'
    ),
    'about-wedding' => array(
        'title' => 'Wedding about',
        'preview_url' => $main_domain . 'wedding/about/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'contact-wedding' => array(
        'title' => 'Wedding contact',
        'preview_url' => $main_domain . 'wedding/contact/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'makeup-contacts' => array(
        'title' => 'Makeup contacts',
        'preview_url' => $main_domain . 'makeup/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'makeup-about' => array(
        'title' => 'Makeup about',
        'preview_url' => $main_domain . 'makeup/about/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'kind-of-tea' => array(
        'title' => 'Kind of tea',
        'preview_url' => $main_domain . 'tea/kind-of-tea/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'tea-ceremony' => array(
        'title' => 'Tea ceremony',
        'preview_url' => $main_domain . 'tea/tea-ceremony/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'tea-about' => array(
        'title' => 'Tea about',
        'preview_url' => $main_domain . 'tea/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'tea-contacts' => array(
        'title' => 'Tea contacts',
        'preview_url' => $main_domain . 'tea/contact/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'freelance-experience' => array(
        'title' => 'Freelance experience',
        'preview_url' => $main_domain . 'freelance/experience/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'freelance-portfolio' => array(
        'title' => 'Freelance portfolio',
        'preview_url' => $main_domain . 'freelance/portfolio/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'freelance-services' => array(
        'title' => 'Freelance services',
        'preview_url' => $main_domain . 'freelance/services/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'shoes-about' => array(
        'title' => 'Shoes About',
        'preview_url' => $main_domain . 'shoes/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'shoes-contacts' => array(
        'title' => 'Shoes Contacts',
        'preview_url' => $main_domain . 'shoes/contact/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'coctails-kind' => array(
        'title' => 'Kind of cocktails',
        'preview_url' => $main_domain . 'coctails/kind-of-cocktails/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'coctails-menu' => array(
        'title' => 'Сocktails Menu',
        'preview_url' => $main_domain . 'cocktails/menu/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'coctails-instructions' => array(
        'title' => 'Сocktails Instructions',
        'preview_url' => $main_domain . 'cocktails/instructions/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'coctails-contacts' => array(
        'title' => 'Сocktails Contacts',
        'preview_url' => $main_domain . 'cocktails/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'coctails-about' => array(
        'title' => 'Сocktails About',
        'preview_url' => $main_domain . 'cocktails/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'barbershop-contacts' => array(
        'title' => 'Barbershop Contacts',
        'preview_url' => $main_domain . 'barbershop/contact/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'barbershop-albums' => array(
        'title' => 'Barbershop Albums',
        'preview_url' => $main_domain . 'barbershop/our-albums/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'business-about' => array(
        'title' => 'Business About',
        'preview_url' => $main_domain . 'business/team/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'business-contacts' => array(
        'title' => 'Business Contacts',
        'preview_url' => $main_domain . 'business/contact/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'business-services' => array(
        'title' => 'Business Services',
        'preview_url' => $main_domain . 'business/services/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'games-about' => array(
        'title' => 'Games About',
        'preview_url' => $main_domain . 'games/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'games-contacts' => array(
        'title' => 'Games Contacts',
        'preview_url' => $main_domain . 'games/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'pizza-about' => array(
        'title' => 'Pizza About',
        'preview_url' => $main_domain . 'pizza/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'pizza-contacts' => array(
        'title' => 'Pizza Contacts',
        'preview_url' => $main_domain . 'pizza/contact/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'pizza-menu' => array(
        'title' => 'Pizza Menu',
        'preview_url' => $main_domain . 'pizza/our-menu/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'pizza-food-tracker' => array(
        'title' => 'Pizza Food Tracker',
        'preview_url' => $main_domain . 'pizza/time-delivery/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'spa-about' => array(
        'title' => 'Spa - About',
        'preview_url' => $main_domain . 'spa/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => true
        ),
        'type' => 'page'
    ),
    'spa-recipe' => array(
        'title' => 'Spa - Recipe',
        'preview_url' => $main_domain . 'spa/recipe/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'spa-services' => array(
        'title' => 'Spa - Services',
        'preview_url' => $main_domain . 'spa/our-services/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'burger-best' => array(
        'title' => 'Best burger',
        'preview_url' => $main_domain . 'burger/best-burger/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'burger-delivery' => array(
        'title' => 'Burger - Delivery time',
        'preview_url' => $main_domain . 'burger/delivery-time/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'interior-about' => array(
        'title' => 'Interior - About us',
        'preview_url' => $main_domain . 'interior/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'interior-categories' => array(
        'title' => 'Interior - Categories',
        'preview_url' => $main_domain . 'interior/categories/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'furniture2-about' => array(
        'title' => 'Furniture 2 - About us',
        'preview_url' => $main_domain . 'furniture2/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'furniture2-contact-us' => array(
        'title' => 'Furniture 2 - Contact Us',
        'preview_url' => $main_domain . 'furniture2/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'plumbing-about' => array(
        'title' => 'Plumbing - About Us',
        'preview_url' => $main_domain . '2/plumbing/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'caramel-about' => array(
        'title' => 'Caramel - About Us',
        'preview_url' => $main_domain . 'caramel/master-classes/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'caramel-shops' => array(
        'title' => 'Caramel - Shops',
        'preview_url' => $main_domain . 'caramel/our-shops/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'caramel-sweet-road' => array(
        'title' => 'Caramel - Sweet Road',
        'preview_url' => $main_domain . 'caramel/sweet-road/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'x-phone-contact' => array(
        'title' => 'X-Phone - Contact Us',
        'preview_url' => $main_domain . '2/x-phone/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'x-phone-gallery' => array(
        'title' => 'X-Phone - Gallery',
        'preview_url' => $main_domain . '2/x-phone/our-gallery/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'x-phone-stores' => array(
        'title' => 'X-Phone - Stores',
        'preview_url' => $main_domain . '2/x-phone/our-stores/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'photographer-about-us' => array(
        'title' => 'Photographer - About Me ',
        'preview_url' => $main_domain . '2/photographer/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'photographer-contact-us' => array(
        'title' => 'Photographer - Comtact Me',
        'preview_url' => $main_domain . '2/photographer/contact-me/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'photographer-offers' => array(
        'title' => 'Photographer - Our Offers',
        'preview_url' => $main_domain . '2/photographer/our-offers/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'delivery-company' => array(
        'title' => 'Devilvery - Our Company',
        'preview_url' => $main_domain . '2/delivery/our-company/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'delivery-tracking' => array(
        'title' => 'Delivery - tracking',
        'preview_url' => $main_domain . '2/delivery/tracking/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'carwash-work' => array(
        'title' => 'Car wash - How we work',
        'preview_url' => $main_domain . '2/carwash/how-we-work/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'baby-shop-about' => array(
        'title' => 'Baby shop - About us',
        'preview_url' => $main_domain . '2/baby-shop/about-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'baby-shop-contact' => array(
        'title' => 'Baby shop - Contact us',
        'preview_url' => $main_domain . '2/baby-shop/contact-us/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'cleaning-booking' => array(
        'title' => 'Cleaning - Booking',
        'preview_url' => $main_domain . '2/cleaning/booking/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'cleaning-team' => array(
        'title' => 'Cleaning - Team',
        'preview_url' => $main_domain . '2/cleaning/our-team/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'designers-shop' => array(
        'title' => 'Designers - Shop',
        'preview_url' => $main_domain . '2/designers/our-shop/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    ),
    'designers-gallery' => array(
        'title' => 'Designers - Gallery',
        'preview_url' => $main_domain . '2/designers/gallery/',
        'to_import' => array(
            'content' => true,
            'slider' => false
        ),
        'type' => 'page'
    )
);
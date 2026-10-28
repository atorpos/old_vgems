<?php  if ( ! defined('ETHEME_FW')) exit('No direct script access allowed');

// **********************************************************************//
// ! Post Meta
// **********************************************************************//

if ( ! function_exists( 'etheme_post_meta_shortcode' ) ) {
    function etheme_post_meta_shortcode($atts) {
        extract(shortcode_atts(array(
            'time' => true,
            'time_details' => true,
            'author'  => true,
            'comments' => true,
            'count' => true,
            'class' => '',
        ), $atts));

        $class = ( ! empty( $class ) ) ? $class . ' ' : '';
        $views = etheme_get_views();
        $comment_link_template = '<span>%s</span> <span>%s</span>';

        ob_start();

        ?>

            <div class="<?php echo $class; ?>meta-post et-shortcode">

                <?php if ( $time == 'true' ): ?>
                    <time class="entry-date published updated" datetime="<?php the_time('F j, Y'); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
                <?php endif ?>

                <?php if ( $time_details == 'true' ): ?>
                    <?php esc_html_e( 'at', 'xstore' );?>
                    <?php the_time( get_option( 'time_format' ) ); ?>
                <?php endif ?>

                <?php if ( $author == 'true' ): ?>
                    <?php esc_html_e( 'by', 'xstore' );?> <?php the_author_posts_link(); ?>
                <?php endif ?>
                        
                <?php if ( $count == 'true' ): ?>
                    <span class="meta-divider">/</span>
                    <span class="views-count"><?php echo $views; ?></span>
                <?php endif ?>
      
                <?php 
                    // Display Comments
                    if( $comments == 'true' && comments_open() && !post_password_required()) {
                        echo '<span class="meta-divider">/</span>';
                        comments_popup_link(
                            sprintf( $comment_link_template, '0', esc_html__( 'comments', 'xstore' ) ),
                            sprintf( $comment_link_template, '1', esc_html__( 'comment', 'xstore' ) ),
                            sprintf( $comment_link_template, '%', esc_html__( 'comments', 'xstore' ) ),
                            'post-comments-count'
                        );
                    }
                ?>
                   
            </div>
        <?php
        return ob_get_clean();
    }
}
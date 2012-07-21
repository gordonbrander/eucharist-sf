<?php
/**
 * Custom formatting for strings
 * 
 * @param string $str A string to be formatted
 * @return string Formatted string
 *  
**/

function eusf_format($str) {
    $str = wptexturize($str);
    $str = convert_smilies($str);
    $str = convert_chars($str);
    return $str;
}

function eusf_markup() {
    $str = eusf_format($str);
    return wpautop($str);
}

function eusf_to_classname($classes = array()) {
    return implode($classes, ' ');
}
function eusf_to_classes($classname) {
    return explode($classname, ' ');
}

// Near-enough way to divide up text into columns by breaking on space.
function eusf_columnize($text, $args = array()) {
    $defaults = array(
        'number_of_columns' => 3,
        'tag' => 'span',
        'classes' => array()
    );

    $args = array_merge($defaults, $args);

    $number_of_columns = $args['number_of_columns'];

    $length = strlen($text);
    $distance = round($length/$number_of_columns, 0);
    
    // Get number of splits to be 
    $splits = array();
    for ($i=1; $i < $number_of_columns - 1; $i++) {
        $splits[$i] = strpos($text, ' ', ($distance * $i));
    }

    $columns = array();
    $columns[0] = substr($text, 0, $splits[0]);
    for ($i=1; $i < count($splits); $i++) {
        $columns[$i] = substr($text, $splits[$i], $splits[$i + 1]);
    }

    echo '<pre>'.print_r($columns, true) .'</pre>';
}

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package eusf
 * @since eusf 1.0
 */

if ( ! function_exists( 'eusf_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since eusf 1.0
 */
function eusf_content_nav( $nav_id ) {
    global $wp_query;

    $nav_class = 'site-navigation paging-navigation';
    if ( is_single() )
        $nav_class = 'site-navigation post-navigation';

    ?>
    <nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
        <h1 class="assistive-text"><?php _e( 'Post navigation', 'eusf' ); ?></h1>

    <?php if ( is_single() ) : // navigation links for single posts ?>

        <?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'eusf' ) . '</span> %title' ); ?>
        <?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'eusf' ) . '</span>' ); ?>

    <?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || iseusfearch() ) ) : // navigation links for home, archive, and search pages ?>

        <?php if ( get_next_posts_link() ) : ?>
        <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'eusf' ) ); ?></div>
        <?php endif; ?>

        <?php if ( get_previous_posts_link() ) : ?>
        <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'eusf' ) ); ?></div>
        <?php endif; ?>

    <?php endif; ?>

    </nav><!-- #<?php echo $nav_id; ?> -->
    <?php
}
endif; // eusf_content_nav

if ( ! function_exists( 'eusf_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since eusf 1.0
 */
function eusf_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p><?php _e( 'Pingback:', 'eusf' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'eusf' ), ' ' ); ?></p>
    <?php
            break;
        default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <footer>
                <div class="comment-author vcard">
                    <?php echo get_avatar( $comment, 40 ); ?>
                    <?php printf( __( '%s <span class="says">says:</span>', 'eusf' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
                </div><!-- .comment-author .vcard -->
                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em><?php _e( 'Your comment is awaiting moderation.', 'eusf' ); ?></em>
                    <br />
                <?php endif; ?>

                <div class="comment-meta commentmetadata">
                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
                    <?php
                        /* translators: 1: date, 2: time */
                        printf( __( '%1$s at %2$s', 'eusf' ), get_comment_date(), get_comment_time() ); ?>
                    </time></a>
                    <?php edit_comment_link( __( '(Edit)', 'eusf' ), ' ' );
                    ?>
                </div><!-- .comment-meta .commentmetadata -->
            </footer>

            <div class="comment-content"><?php comment_text(); ?></div>

            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div><!-- .reply -->
        </article><!-- #comment-## -->

    <?php
            break;
    endswitch;
}
endif; // ends check for eusf_comment()

if ( ! function_exists( 'eusf_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since eusf 1.0
 */
function eusf_posted_on() {
    printf( __( '<span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span> on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>', 'eusf' ),
        esc_url( get_permalink() ),
        esc_attr( get_the_time() ),
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        esc_attr( sprintf( __( 'View all posts by %s', 'eusf' ), get_the_author() ) ),
        esc_html( get_the_author() )
    );
}
endif;
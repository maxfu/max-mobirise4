<?php
/**
 * Modifier: Max Fu
 * Original Author: Todd Motto | @toddmotto
 * URL: html5blank.com | @html5blank
 * Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
    Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
    'default-color' => 'FFF',
    'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
    'default-image'          => get_template_directory_uri() . '/img/headers/default.jpg',
    'header-text'            => false,
    'default-text-color'     => '000',
    'width'                  => 1000,
    'height'                 => 198,
    'random-default'         => false,
    'wp-head-callback'       => $wphead_cb,
    'admin-head-callback'    => $adminhead_cb,
    'admin-preview-callback' => $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('max-mobirise4', get_template_directory() . '/languages');
}

/*------------------------------------*\
    Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'max_mobirise4_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'max_mobirise4_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'max_mobirise4_styles'); // Add Theme Stylesheet
add_action('wp_enqueue_scripts', 'max_mobirise4_scripts'); // Add Custom Scripts to wp_footer
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'max_mobirise4_gravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('post_thumbnail_html', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
add_filter('image_send_to_editor', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
// add_filter('auth_cookie_expiration', 'ccca_expiration_filter', 99, 3);

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether
/*------------------------------------*\
    Functions
\*------------------------------------*/

// HTML5 Blank navigation
function max_mobirise4_nav()
{
    wp_nav_menu(
    array(
        'theme_location'  => 'header-menu',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'menu-{menu slug}-container',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul>%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
        )
    );
}

// Load HTML5 Blank scripts (header.php)
function max_mobirise4_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        if (HTML5_DEBUG) {
          wp_deregister_script('jquery');
          wp_deregister_script('jquery-core');
          wp_deregister_script('jquery-migrate');
          wp_register_script('jquery-core', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), '3.3.1', true); // Custom scripts
          wp_register_script('jquery-migrate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.0.1/jquery-migrate.min.js', array('jquery-core'), '3.0.1', true); // Custom scripts
          wp_register_script('conditionizr', 'https://cdnjs.cloudflare.com/ajax/libs/conditionizr.js/4.1.0/conditionizr.min.js', array(), '4.1.0', true); // Conditionizr
          wp_register_script('modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array(), '2.8.3', true); // Modernizr
          wp_register_script('max-mobirise4-scripts', get_template_directory_uri() . '/assets/mobirise/js/scripts.js', array('conditionizr', 'modernizr', 'jquery-core', 'jquery-migrate'), '1.0.0', true); // Custom scripts

          // Enqueue Scripts
          wp_enqueue_script('max-mobirise4-scripts');

        // If production
        } else {
            // Scripts minify
            wp_register_script('max-mobirise4-scripts', get_template_directory_uri() . '/assets/mobirise/js/scripts.js', array(), '1.0.0', true);
            // Enqueue Scripts
            wp_enqueue_script('max-mobirise4-scripts');
        }
    }
}

// Load HTML5 Blank conditional scripts
function max_mobirise4_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        // Conditional script(s)
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('scriptname');
    }
}

// Load HTML5 Blank styles
function max_mobirise4_styles()
{
  // normalize-css
  wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0');
  wp_register_style('max-mobirise4-style', get_template_directory_uri() . '/style.css', array('normalize'), '1.0');
  wp_enqueue_style('max-mobirise4-style');

  if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

    wp_register_style('mobirise-icons', get_template_directory_uri() . '/assets/mobirise-icons/mobirise-icons.css', array(), '1.0', 'all');
    wp_enqueue_style('mobirise-icons'); // Enqueue it!

    wp_register_style('tether', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/css/tether.min.css', array(), '1.4.4', 'all');
    wp_enqueue_style('tether'); // Enqueue it!

    wp_register_style('soundcloud-plugin', get_template_directory_uri() . '/assets/soundcloud-plugin/style.css', array(), '1.0', 'all');
    wp_enqueue_style('soundcloud-plugin'); // Enqueue it!

    wp_register_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css', array(), '1.0', 'all');
    wp_enqueue_style('bootstrap'); // Enqueue it!

    wp_register_style('bootstrap-grid', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap-grid.min.css', array(), '1.0', 'all');
    wp_enqueue_style('bootstrap-grid'); // Enqueue it!

    wp_register_style('bootstrap-reboot', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap-reboot.min.css', array(), '1.0', 'all');
    wp_enqueue_style('bootstrap-reboot'); // Enqueue it!

    wp_register_style('animatecss', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css', array(), '3.7.0', 'all');
    wp_enqueue_style('animatecss'); // Enqueue it!

    wp_register_style('dropdown', get_template_directory_uri() . '/assets/dropdown/css/style.css', array(), '1.0', 'all');
    wp_enqueue_style('dropdown'); // Enqueue it!

    wp_register_style('socicon', get_template_directory_uri() . '/assets/socicon/css/styles.css', array(), '1.0', 'all');
    wp_enqueue_style('socicon'); // Enqueue it!

    wp_register_style('theme', get_template_directory_uri() . '/assets/theme/css/style.css', array(), '1.0', 'all');
    wp_enqueue_style('theme'); // Enqueue it!

    wp_register_style('mbr-additional', get_template_directory_uri() . '/assets/mobirise/css/mbr-additional.css', array(), '1.0', 'all');
    wp_enqueue_style('mbr-additional'); // Enqueue it!

    wp_register_style('custom-style', get_template_directory_uri() . '/assets/theme/css/custom_style.css', array(), '1.0', 'all');
    wp_enqueue_style('custom-style'); // Enqueue it!
}
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'max-mobirise4'), // Main Navigation
        'header-menu-logged-in' => __('Logged In Header Menu', 'max-mobirise4'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'max-mobirise4'), // Sidebar Navigation
        'chapters-menu' => __('Chapters Menu', 'max-mobirise4') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// Remove the width and height attributes from inserted images
function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}


// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'max-mobirise4'),
        'description' => __('Description for this widget-area...', 'max-mobirise4'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'max-mobirise4'),
        'description' => __('Description for this widget-area...', 'max-mobirise4'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'max-mobirise4') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return is_user_logged_in();
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function max_mobirise4_gravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/assets/images/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function max_mobirise4_comments($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
    <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
    <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
    </div>
<?php if ($comment->comment_approved == '0') : ?>
    <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
    <br />
<?php endif; ?>

    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
        <?php
            printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
        ?>
    </div>

    <?php comment_text() ?>

    <div class="reply">
    <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
<?php }


// Shortcodes
// add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
// add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
    Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_post_type_html5()
{
    register_taxonomy_for_object_type('category', 'html5-blank'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'html5-blank');
    register_post_type('html5-blank', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Partners', 'max-mobirise4'), // Rename these to suit
            'singular_name' => __('Partner', 'max-mobirise4'),
            'add_new' => __('Add New', 'max-mobirise4'),
            'add_new_item' => __('Add New Partner', 'max-mobirise4'),
            'edit' => __('Edit', 'max-mobirise4'),
            'edit_item' => __('Edit Partner', 'max-mobirise4'),
            'new_item' => __('New Partner', 'max-mobirise4'),
            'view' => __('View Partner', 'max-mobirise4'),
            'view_item' => __('View Partner', 'max-mobirise4'),
            'search_items' => __('Search Partners', 'max-mobirise4'),
            'not_found' => __('No Partner found', 'max-mobirise4'),
            'not_found_in_trash' => __('No Partner found in Trash', 'max-mobirise4')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}

/*------------------------------------*\
    ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}

function max_mobirise4_scripts(){
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
      wp_deregister_script('jquery');
      wp_deregister_script('jquery-core');
      wp_register_script('jquery-core', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), '3.3.1', true); // Custom scripts
      wp_enqueue_script('jquery-core'); // Enqueue it!

      wp_deregister_script( 'jquery-migrate' );
      wp_register_script('jquery-migrate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.0.1/jquery-migrate.min.js', array('jquery-core'), '3.0.1', true); // Custom scripts
      wp_enqueue_script('jquery-migrate'); // Enqueue it!

      wp_register_script('popper', get_template_directory_uri() . '/assets/popper/popper.min.js', array(), '1.0.0', true); // Custom scripts
      wp_enqueue_script('popper'); // Enqueue it!

      wp_register_script('tether', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js', array(), '1.4.4', true); // Custom scripts
      wp_enqueue_script('tether'); // Enqueue it!

      wp_register_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', array('jquery-core'), '4.1.3', true); // Custom scripts
      wp_enqueue_script('bootstrap'); // Enqueue it!

      wp_register_script('dropdown', get_template_directory_uri() . '/assets/dropdown/js/script.min.js', array(), '1.0.0', true); // Custom scripts
      wp_enqueue_script('dropdown'); // Enqueue it!

      wp_register_script('touchswipe', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.19/jquery.touchSwipe.min.js', array('jquery-core'), '1.6.19', true); // Custom scripts
      wp_enqueue_script('touchswipe'); // Enqueue it!

      wp_register_script('viewportchecker', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery-viewport-checker/1.8.8/jquery.viewportchecker.min.js', array('jquery-core'), '1.8.8', true); // Custom scripts
      wp_enqueue_script('viewportchecker'); // Enqueue it!

      wp_register_script('ytplayer', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.mb.YTPlayer/3.2.9/jquery.mb.YTPlayer.min.js', array('jquery-core'), '3.2.9', true); // Custom scripts
      wp_enqueue_script('ytplayer'); // Enqueue it!

      wp_register_script('vimeo_player', get_template_directory_uri() . '/assets/vimeoplayer/jquery.mb.vimeo_player.min.js', array('jquery-core'), '1.0.0', true); // Custom scripts
      wp_enqueue_script('vimeo_player'); // Enqueue it!

      // wp_register_script('mbr-popup-btns', get_template_directory_uri() . '/assets/mbr-popup-btns/mbr-popup-btns.min.js', array(), '1.0.0', true); // Custom scripts
      // wp_enqueue_script('mbr-popup-btns'); // Enqueue it!

      wp_register_script('social-likes', 'https://cdnjs.cloudflare.com/ajax/libs/social-likes/3.1.3/social-likes.min.js', array(), '3.1.3', true); // Custom scripts
      wp_enqueue_script('social-likes'); // Enqueue it!

      wp_register_script('smooth-scroll', get_template_directory_uri() . '/assets/smoothscroll/smooth-scroll.min.js', array(), '1.0.0', true); // Custom scripts
      wp_enqueue_script('smooth-scroll'); // Enqueue it!

      wp_register_script('formoid-min', get_template_directory_uri() . '/assets/formoid/formoid.min.js', array(), '1.0.0', true); // Custom scripts
      wp_enqueue_script('formoid-min'); // Enqueue it!

      wp_register_script('jarallax', 'https://cdnjs.cloudflare.com/ajax/libs/jarallax/1.10.7/jarallax.min.js', array(), '1.10.7', true); // Custom scripts
      wp_enqueue_script('jarallax'); // Enqueue it!

      wp_register_script('moment-with-locales', 'https://momentjs.com/downloads/moment-with-locales.min.js', array(), '2.24.0', true); // Custom scripts
      wp_enqueue_script('moment-with-locales'); // Enqueue it!

      wp_register_script('moment-timezone-with-data', 'https://momentjs.com/downloads/moment-timezone-with-data.min.js', array(), '0.5.23', true); // Custom scripts
      wp_enqueue_script('moment-timezone-with-data'); // Enqueue it!

      wp_register_script('theme-script', get_template_directory_uri() . '/assets/theme/js/script.js', array(), '1.0.0', true); // Custom scripts
      wp_enqueue_script('theme-script'); // Enqueue it!
    }
}

// CCCA: Load CCCA and Mobirise styled Menu
function ccca_create_mbr_menu( $theme_location ) {
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {

        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_list = '<div class="collapse navbar-collapse" id="' . $theme_location . '">' ."\n";
        $menu_list .= '<ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">' ."\n";

        foreach( $menu_items as $menu_item ) {
            if( $menu_item->menu_item_parent == 0 ) {

                $parent = $menu_item->ID;

                $menu_array = array();
                foreach( $menu_items as $submenu ) {
                    if( $submenu->menu_item_parent == $parent ) {
                        $bool = true;
                        $menu_array[] = '<a class="text-white dropdown-item display-4" href="' . $submenu->url . '">' . $submenu->title . '</a>' ."\n";
                    }
                }
                if( $bool == true && count( $menu_array ) > 0 ) {

                    $menu_list .= '<li class="nav-item dropdown">' ."\n";
                    $menu_list .= '<a class="nav-link link text-white dropdown-toggle display-4" href="#" data-toggle="dropdown-submenu" role="button" aria-haspopup="true" aria-expanded="false">' . $menu_item->title . ' <span class="caret"></span></a>' ."\n";

                    $menu_list .= '<div class="dropdown-menu">' ."\n";
                    $menu_list .= implode( "\n", $menu_array );
                    $menu_list .= '</div>' ."\n";

                } else {

                    $menu_list .= '<li class="nav-item">' ."\n";
                    $menu_list .= '<a class="nav-link link text-white display-4" href="' . $menu_item->url . '">' . $menu_item->title . '</a>' ."\n";
                }

            }

            // end <li>
            $menu_list .= '</li>' ."\n";
        }

        $menu_list .= '</ul>' ."\n";
        $menu_list .= '</div>' ."\n";
        $menu_list .= '</nav>' ."\n";

    } else {
        $menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
    }

    echo $menu_list;
}

// CCCA: Visitor Counter
add_action( 'init', 'ccca_vcounter_init' );
function ccca_vcounter_init() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'visitor_counter';

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    $sql = "
    CREATE TABLE IF NOT EXISTS $table_name
    (
        `LogID` int(11) NOT NULL AUTO_INCREMENT,
        `IP` varchar(20) NOT NULL,
        `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`LogID`)
    );";

    dbDelta( $sql );

    if(!ccca_vcounter_get($_SERVER['REMOTE_ADDR'])){
        $sqlQuery = "INSERT INTO $table_name VALUES (NULL,'".$_SERVER['REMOTE_ADDR']."',NULL)";
        $sqlQueryResult = $wpdb -> get_results($sqlQuery);
    }
}

function ccca_vcounter_get($condition)
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'visitor_counter';

    if ( 'counter' == $condition ) {
      $sql = "SELECT COUNT(*) FROM $table_name WHERE 1";
    } else {
      $sql = "SELECT COUNT(*) FROM $table_name WHERE IP='".$condition."' AND DATE(Time)='".date('Y-m-d')."'";
    }

    $count = $wpdb -> get_var($sql);

    return $count;
}

// Create the Custom Excerpts callback
function ccca_the_excerpt($length_callback = '', $more_callback = '')
{
    global $post;

    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $output);
    $output = strip_shortcodes($output);
//    $output = apply_filters('strip_shortcode_from_excerpt', $output);
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
//    $output = '<p>' . $output . '</p>';
//    $output = strip_shortcodes($output); //Strips tags and images

    echo $output;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function ccca_excerpt($length)
{
    return 200;
}

function strip_shortcode_from_excerpt( $content ) {
  $content = strip_shortcodes( $content );
  return $content;
}
// add_filter('the_excerpt', 'strip_shortcode_from_excerpt');

function nowapi_call($a_parm){
    if(!is_array($a_parm)){
        return false;
    }
    //combinations
    $a_parm['format']=empty($a_parm['format'])?'json':$a_parm['format'];
    $apiurl=empty($a_parm['apiurl'])?'http://api.k780.com/?':$a_parm['apiurl'].'/?';
    unset($a_parm['apiurl']);
    foreach($a_parm as $k=>$v){
        $apiurl.=$k.'='.$v.'&';
    }
    $apiurl=substr($apiurl,0,-1);
    if(!$callapi=file_get_contents($apiurl)){
        return false;
    }
    //format
    if($a_parm['format']=='base64'){
        $a_cdata=unserialize(base64_decode($callapi));
    }elseif($a_parm['format']=='json'){
        if(!$a_cdata=json_decode($callapi,true)){
            return false;
        }
    }else{
        return false;
    }
    //array
    if($a_cdata['success']!='1'){
        echo $a_cdata['msgid'].' '.$a_cdata['msg'];
        return false;
    }
    return $a_cdata['result'];
}

function ccca_pagination($pages = '', $range = 4)
{
    $showitems = ($range * 2)+1;

    global $paged;
    if(empty($paged)) $paged = 1;

    if($pages == '')
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages)
        {
            $pages = 1;
        }
    }

    if(1 != $pages)
    {
        echo "<div class=\"pagination\"><span style=\"margin-right: 0.5rem;\">Page ".$paged." of ".$pages."</span>";
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."' style=\"margin-right: 0.5rem;\">&laquo; First</a>";
        if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."' style=\"margin-right: 0.5rem;\">&lsaquo; Previous</a> ";

        echo "<span style=\"margin-right: 0.5rem;\">Pages:</span>";

        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                echo ($paged == $i)? "<span class=\"current\" style=\"margin-right: 0.5rem;\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"other\"  style=\"margin-right: 0.5rem;\">".$i."</a>";
            }
        }

        if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\"  style=\"margin-right: 0.5rem;\">Next &rsaquo;</a>";
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."' style=\"margin-right: 0.5rem;\">Last &raquo;</a>";
        echo "</div>\n";
    }
}

function ccca_expiration_filter($seconds, $user_id, $remember){

    //if "remember me" is checked;
    if ( $remember ) {
        //WP defaults to 2 weeks;
        $expiration = 14*24*60*60; //UPDATE HERE;
    } else {
        //WP defaults to 5 minutes;
        $expiration = 60*60; //UPDATE HERE;
    }

    //http://en.wikipedia.org/wiki/Year_2038_problem
    if ( PHP_INT_MAX - time() < $expiration ) {
        //Fix to a little bit earlier!
        $expiration =  PHP_INT_MAX - time() - 5;
    }

    return $expiration;
}

// Scheduled Action Hook
function quarterly_fetcher( ) {
	$upload_dir = wp_upload_dir();
  // quarterly Fetcher
  $fileName = $upload_dir['basedir'] . '/forex_ratios.php';
	date_default_timezone_set('Australia/Sydney');
	$ts_date = date("d/m/Y h:i A");
	ob_start();
	$nowapi_parm['appkey']='34588';
	$nowapi_parm['sign']='c86b26eeae21cccfd471b3b9ff71edcd';
	$nowapi_parm['format']='json';

	$nowapi_parm['app']='finance.rate';
	$nowapi_parm['scur']='AUD';
	$nowapi_parm['tcur']='CNY';
	$result_aud_cny=nowapi_call($nowapi_parm);

	$nowapi_parm['app']='finance.rate';
	$nowapi_parm['scur']='AUD';
	$nowapi_parm['tcur']='USD';
	$result_aud_usd=nowapi_call($nowapi_parm);

	$nowapi_parm['app']='finance.rate';
	$nowapi_parm['scur']='AUD';
	$nowapi_parm['tcur']='EUR';
	$result_aud_eur=nowapi_call($nowapi_parm);

	$nowapi_parm['app']='finance.rate';
	$nowapi_parm['scur']='AUD';
	$nowapi_parm['tcur']='JPY';
	$result_aud_jpy=nowapi_call($nowapi_parm);

	$nowapi_parm['app']='finance.rate';
	$nowapi_parm['scur']='AUD';
	$nowapi_parm['tcur']='HKD';
	$result_aud_hkd=nowapi_call($nowapi_parm);

	$nowapi_parm['app']='finance.globalindex';
	$nowapi_parm['inxno']='AS51';
	$result_as51=nowapi_call($nowapi_parm);

	$nowapi_parm['app']='finance.globalindex';
	$nowapi_parm['inxno']='CCMP';
	$result_ccmp=nowapi_call($nowapi_parm);

	$nowapi_parm['app']='finance.globalindex';
	$nowapi_parm['inxno']='SPX';
	$result_spx=nowapi_call($nowapi_parm);

	$nowapi_parm['app']='finance.globalindex';
	$nowapi_parm['inxno']='110000';
	$result_110000=nowapi_call($nowapi_parm);

	$nowapi_parm['app']='finance.globalindex';
	$nowapi_parm['inxno']='000001';
	$result_000001=nowapi_call($nowapi_parm);

  echo '<div class="modal fade" id="finance-figure" tabindex="-1" role="dialog" aria-labelledby="financeFigureLabel" aria-hidden="true">'; echo "\r\n";
  echo '  <div class="modal-dialog" role="document">'; echo "\r\n";
  echo '    <div class="modal-content">'; echo "\r\n";
  echo '      <div class="modal-header">'; echo "\r\n";
  echo '        <h2 class="mbr-section-title align-center mbr-fonts-style display-2 modal-title" id="financeFigureLabel"><?php _e(\'Finance Figures\', \'max-mobirise4\'); ?>'; echo '</h2>'; echo "\r\n";
  echo '        <button type="button" class="close" data-dismiss="modal" aria-label="<?php _e(\'Close\', \'max-mobirise4\'); ?>'; echo '"><span aria-hidden="true">&times;</span></button>'; echo "\r\n";
  echo '      </div>'; echo "\r\n";
  echo '      <div class="modal-body">'; echo "\r\n";
  echo '        <p class="mbr-text mbr-fonts-style display-7"><?php _e(\'Timestamp: \', \'max-mobirise4\'); ?>'; echo $ts_date . '</p>'; echo "\r\n";
  echo '        <p class="mbr-text mbr-fonts-style display-7"><?php _e(\'AUD/CNY: \', \'max-mobirise4\'); ?>'; echo round(($result_aud_cny['rate']),4) . '</p>'; echo "\r\n";
  echo '        <p class="mbr-text mbr-fonts-style display-7"><?php _e(\'AUD/USD: \', \'max-mobirise4\'); ?>'; echo round(($result_aud_usd['rate']),4) . '</p>'; echo "\r\n";
  echo '        <p class="mbr-text mbr-fonts-style display-7"><?php _e(\'AUD/EUR: \', \'max-mobirise4\'); ?>'; echo round(($result_aud_eur['rate']),4) . '</p>'; echo "\r\n";
  echo '        <p class="mbr-text mbr-fonts-style display-7"><?php _e(\'AUD/JPY: \', \'max-mobirise4\'); ?>'; echo round(($result_aud_jpy['rate']),4) . '</p>'; echo "\r\n";
  echo '        <p class="mbr-text mbr-fonts-style display-7"><?php _e(\'AUD/HKD: \', \'max-mobirise4\'); ?>'; echo round(($result_aud_hkd['rate']),4) . '</p>'; echo "\r\n";
  echo '        <p class="mbr-text mbr-fonts-style display-7"><?php _e(\'S&P ASX200: \', \'max-mobirise4\'); ?>'; echo $result_as51['last_price'] . ' ' . $result_as51['change_price_per'] . '</p>'; echo "\r\n";
  echo '        <p class="mbr-text mbr-fonts-style display-7"><?php _e(\'NASDAQ: \', \'max-mobirise4\'); ?>'; echo $result_ccmp['last_price'] . ' ' . $result_ccmp['change_price_per'] . '</p>'; echo "\r\n";
  echo '        <p class="mbr-text mbr-fonts-style display-7"><?php _e(\'S&P 500: \', \'max-mobirise4\'); ?>'; echo $result_spx['last_price'] . ' ' . $result_spx['change_price_per'] . '</p>'; echo "\r\n";
  echo '        <p class="mbr-text mbr-fonts-style display-7"><?php _e(\'HANGSENG: \', \'max-mobirise4\'); ?>'; echo $result_110000['last_price'] . ' ' . $result_110000['change_price_per'] . '</p>'; echo "\r\n";
  echo '        <p class="mbr-text mbr-fonts-style display-7"><?php _e(\'SHA: \', \'max-mobirise4\'); ?>'; echo $result_000001['last_price'] . ' ' . $result_000001['change_price_per'] . '</p>'; echo "\r\n";
  echo '      </div>'; echo "\r\n";
  echo '      <div class="modal-footer">'; echo "\r\n";
  echo '        <button type="button" class="btn btn-md btn-primary display-4" data-dismiss="modal"><?php _e(\'Close\', \'max-mobirise4\'); ?>'; echo '</button>'; echo "\r\n";
  echo '      </div>'; echo "\r\n";
  echo '    </div>'; echo "\r\n";
  echo '  </div>'; echo "\r\n";
  echo '</div>'; echo "\r\n";

	$htmlStr = ob_get_contents();
	// Clean (erase) the output buffer and turn off output buffering
	ob_end_clean();
	// Write final string to file
	file_put_contents($fileName, $htmlStr);
}
add_action( 'quarterly_fetcher', 'quarterly_fetcher' );

// Custom Cron Recurrences
function quarterly_raptile_recurrence( $schedules ) {
	$schedules['every_quarter'] = array(
		'display' => __( 'Every Quarter', 'max-mobirise4' ),
		'interval' => 900,
	);
	return $schedules;
}
add_filter( 'cron_schedules', 'quarterly_raptile_recurrence' );

// Schedule Cron Job Event
function quarterly_raptile() {
	if ( ! wp_next_scheduled( 'quarterly_fetcher' ) ) {
		wp_schedule_event( current_time( 'timestamp' ), 'every_quarter', 'quarterly_fetcher' );
	}
}
add_action( 'wp', 'quarterly_raptile' );

// Scheduled Action Hook
function daily_fetcher( ) {
	$upload_dir = wp_upload_dir();
  // Partner Fetcher
  $fileName = $upload_dir['basedir'] . '/partner_block.php';
  ob_start();
  echo '<div class="carousel-inner" data-visible="8">'; echo "\r\n";
  $custom_loop = new WP_Query(array( 'post_type' => 'html5-blank', 'posts_per_page' => -1 ));
  while ( $custom_loop->have_posts() ) : $custom_loop->the_post();
  echo '  <div class="carousel-item ">'; echo "\r\n";
  echo '    <div class="media-container-row">'; echo "\r\n";
  echo '      <div class="col-md-12">'; echo "\r\n";
  echo '        <div class="wrap-img ">'; echo "\r\n";
  if ( has_post_thumbnail() ) {
  the_post_thumbnail('full', array('class' => 'img-responsive clients-img'));
  } else {
  echo '          <img src="'; echo get_template_directory_uri(); echo '/assets/images/topbg-1-66x69.png" class="img-responsive clients-img">'; echo "\r\n";
  }
  echo '        </div>'; echo "\r\n";
  echo '      </div>'; echo "\r\n";
  echo '    </div>'; echo "\r\n";
  echo '  </div>'; echo "\r\n";
  endwhile; wp_reset_postdata();
  echo '</div>'; echo "\r\n";

  $htmlStr = ob_get_contents();
	// Clean (erase) the output buffer and turn off output buffering
	ob_end_clean();
	// Write final string to file
	file_put_contents($fileName, $htmlStr);
}
add_action( 'daily_fetcher', 'daily_fetcher' );

// Custom Cron Recurrences
function daily_raptile_recurrence( $schedules ) {
	$schedules['every_day'] = array(
		'display' => __( 'Every Day', 'max-mobirise4' ),
		'interval' => 86400,
	);
	return $schedules;
}
add_filter( 'cron_schedules', 'daily_raptile_recurrence' );

// Schedule Cron Job Event
function daily_raptile() {
	if ( ! wp_next_scheduled( 'daily_fetcher' ) ) {
		wp_schedule_event( current_time( 'timestamp' ), 'every_day', 'daily_fetcher' );
	}
}
add_action( 'wp', 'daily_raptile' );

if (!function_exists('myStrtotime')) {
  function myStrtotime($date_string) {
    $date_string = str_replace('.', '', $date_string); // to remove dots in short names of months, such as in 'janv.', 'févr.', 'avr.', ...
    return strtotime(
      strtr(
        strtolower($date_string), [
          '一月' => 'Jan',
          '二月' => 'Feb',
          '三月' => 'March',
          '四月' => 'Apr',
          '五月' => 'May',
          '六月' => 'Jun',
          '七月' => 'Jul',
          '八月' => 'Aug',
          '九月' => 'Sep',
          '十月' => 'Oct',
          '十一月' => 'Nov',
          '十二月' => 'Dec',
          '星期一' => 'Monday',
          '星期二' => 'Tuesday',
          '星期三' => 'Wednesday',
          '星期四' => 'Thursday',
          '星期五' => 'Friday',
          '星期六' => 'Saturday',
          '星期日' => 'Sunday',
        ]
      )
    );
  }
}

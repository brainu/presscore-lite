<?php
/**
 * Fatesinger <header> in the theme.
 *
 *
 * @version 1.0
 * @package Bigfa
 * @copyright 2013 all rights reserved
 *
 */

function presscore_header() {
?>
<div id="wrap">
<?php if ( bools('d_notice_b') ){ ?>
    <div class="header-notice">
        <p class="notice-body">
            <?php echo bools('d_notice');?>
        </p>
    </div>
<?php } ?>
<header id="header" role="banner" class="clearfix">
    <h1><a class="logo" title="<?php bloginfo('name');?>" href="<?php bloginfo('url');?>"><?php bloginfo('name');?>
        </a></h1>
    <div class="right-banner">
        <div class="tool-menu right">
            <a class="rss" title="RSS2.0" href="<?php bloginfo( 'rss2_url' ); ?>" target="_blank"></a>
        </div>
        <nav class="link-menu right">
            <?php wp_nav_menu( array( 'theme_location' => 'top-menu','menu_id'=>'top-nav','menu_class'=> 'top-nav','container'=>'ul','fallback_cb' => 'link_to_menu_editor')); ?>
        </nav>
    </div>

</header>
<div id="navigation" role="navigation">
    <nav class="menu-container">

        <?php wp_nav_menu( array( 'theme_location' => 'header-menu','menu_id'=>'menu-nav','menu_class'=>'fancy-rollovers','container'=>'ul','fallback_cb' => 'link_to_menu_editor')); ?>

    </nav>

    <div class="nav-right right">
        <a class="show-search" href="javascript:;"></a>
        <?php if ( bools('d_show_case_b') && !wp_is_mobile()){ ?>
            <a href="javascript:;" class="show-cat-list"></a>
        <?php } ?>
        <?php if ( wp_is_mobile()){ ?>
            <div class="mobile-nav-container"><div class="show-mobile-nav"></div><div class="header-mobile-nav"><?php wp_nav_menu( array( 'theme_location' => 'header-menu','menu_id'=>'top-mobile-nav','menu_class'=>'fancy-rollovers','container'=>'ul')); ?></div></div>
        <?php } ?>
    </div>
    <div id="search-bar" class="hide clearfix">
        <form id="searchform" action="<?php bloginfo('url');?>" method="get">
            <input id="search-input" class="JS_ajax_search" type="text" placeholder="搜索…" value="" tabindex="1" name="s">
            <input id="search-submit-hidden" class="button" type="submit" value="go" tabindex="2" name="submit">
        </form>
    </div>
</div>
<?php if ( bools('d_show_case_b') && !wp_is_mobile()){ ?>
    <div id="cat-list" class="fullwidth clearfix">
        <div id="cat-list-inner" class="clearfix">
            <div class="border"></div>
            <div class="cat-list-item first live-list">
                <h3 class="yahei">最新</h3>
                <div id="top-newest-post">
                    <ul class="clearfix">
                        <?php query_posts( $query_string . 'showposts=8&ignore_sticky_posts=1' );while(have_posts()) : the_post(); ?>
                            <li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
                                    <?php the_title(); ?>
                                </a></li>
                        <?php endwhile;wp_reset_query() ?>
                    </ul>
                </div>
                <a class="all-tags" title="更多观察" href="<?php bloginfo('url');?>">更多 »</a>
            </div>
            <div class="cat-list-item recommend-subject">
                <h3 class="yahei">推荐</h3>
                <div class="recommend-subject-item first">
                    <a class="thumb" href="javascript:void(0);">
                        <img src="<?php echo bools('d_show_case_img_1')?>">
                    </a>
                    <ul class="clearfix">
                        <?php query_posts( $query_string . '&cat='.bools('d_show_case_1').'&orderby=rand&showposts=5&ignore_sticky_posts=1' );while(have_posts()) : the_post(); ?>
                            <li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
                                    <?php the_title(); ?>

                                </a></li>
                        <?php endwhile;wp_reset_query() ?>
                    </ul>
                </div>
                <div class="recommend-subject-item">
                    <a class="thumb" href="javascript:void(0);">
                        <img src="<?php echo bools('d_show_case_img_2')?>">
                    </a>
                    <ul class="clearfix">

                        <?php query_posts( $query_string . '&cat='.bools('d_show_case_2').'&orderby=rand&showposts=5&ignore_sticky_posts=1' );while(have_posts()) : the_post(); ?>
                            <li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
                                    <?php the_title(); ?>

                                </a></li>
                        <?php endwhile;wp_reset_query() ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php
}
/**
 * Presscore <Post type Data> in the theme.
 *
 *
 * @version 1.0
 * @package Bigfa
 * @copyright 2013 all rights reserved
 *
 */
add_action( 'admin_menu', 'bigfa_create_meta_box' );
add_action( 'save_post', 'bigfa_save_meta_data' );
function bigfa_create_meta_box() {
    add_meta_box( 'bigfa-data-meta-boxes','数字', 'bigfa_post_meta_boxes', 'data', 'normal', 'high' );
    add_meta_box( 'bigfa-shout-meta-boxes','大声', 'bigfa_shout_meta_boxes', 'shout', 'normal', 'high' );
}
function bigfa_post_boxes() {
    $meta_boxes = array(
        array(
            "name"             => "data-num",
            "title"            => "数字",
            "desc"             => "添加数字",
            "type"             => "text",
            "capability"       => "manage_options"
        ),
        array(
            "name"             => "data-percent",
            "title"            => "数字单位",
            "desc"             => "添加数字单位",
            "type"             =>    "text",
            "capability"       => "manage_options"
        ),
        array(
            "name"             => "data-text",
            "title"            => "数字描述",
            "desc"             => "添加数字描述",
            "type"             => "text",
            "capability"       => "manage_options"
        )
    );
    return apply_filters( 'bigfa_post_boxes', $meta_boxes );
}
function bigfa_shout_boxes() {
    $meta_boxes = array(
        array(
            "name"             => "shout-text",
            "title"            => "大声内容",
            "desc"             => "添加大声内容",
            "type"             => "text",
            "capability"       => "manage_options"
        ),
        array(
            "name"             => "shout-author",
            "title"            => "大声作者",
            "desc"             => "添加大声作者",
            "type"             =>    "text",
            "capability"       => "manage_options"
        )
    );
    return apply_filters( 'bigfa_shout_boxes', $meta_boxes );
}
function bigfa_post_meta_boxes() {
    global $post;
    $meta_boxes = bigfa_post_boxes();
    ?>
    <table class="form-table">
        <?php foreach ( $meta_boxes as $meta ) :
            $value = get_post_meta( $post->ID, $meta['name'], true );
            if ( $meta['type'] == 'text' )
                bigfa_meta_text_input( $meta, $value );
        endforeach; ?>
    </table>
<?php
}
function bigfa_shout_meta_boxes() {
    global $post;
    $meta_boxes = bigfa_shout_boxes();
    ?>
    <table class="form-table">
        <?php foreach ( $meta_boxes as $meta ) :
            $value = stripslashes( get_post_meta( $post->ID, $meta['name'], true ) );
            if ( $meta['type'] == 'text' )
                bigfa_meta_text_input( $meta, $value );
        endforeach; ?>
    </table>
<?php
}
function bigfa_meta_text_input( $args = array(), $value = false ) {
    extract( $args ); ?>
    <tr>
        <th style="width:10%;">
            <label for="<?php echo $name; ?>"><?php echo $title; ?></label>
        </th>
        <td>
            <input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo wp_specialchars( $value, 1 ); ?>" size="30" tabindex="30" style="width: 97%;" />
            <input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
            <br />
            <p class="description"><?php echo $desc; ?></p>
        </td>
    </tr>
<?php
}

function bigfa_save_meta_data( $post_id ) {
    if ( 'shout' == $_POST['post_type'] )
        $meta_boxes = array_merge( bigfa_shout_boxes() );
    else
        $meta_boxes = array_merge( bigfa_post_boxes() );
    foreach ( $meta_boxes as $meta_box ) :
        if ( !wp_verify_nonce( $_POST[$meta_box['name'] . '_noncename'], plugin_basename( __FILE__ ) ) )
            return $post_id;
        if ( 'shout' == $_POST['post_type'] && !current_user_can( 'edit_page', $post_id ) )
            return $post_id;
        elseif ( 'post' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
            return $post_id;
        $data = stripslashes( $_POST[$meta_box['name']] );
        if ( get_post_meta( $post_id, $meta_box['name'] ) == '' )
            add_post_meta( $post_id, $meta_box['name'], $data, true );
        elseif ( $data != get_post_meta( $post_id, $meta_box['name'], true ) )
            update_post_meta( $post_id, $meta_box['name'], $data );
        elseif ( $data == '' )
            delete_post_meta( $post_id, $meta_box['name'], get_post_meta( $post_id, $meta_box['name'], true ) );
    endforeach;
}
function post_type_shout() {
    register_post_type(
        'shout',
        array( 'public' => true,
            'has_archive' => true,
            'labels'=>array(
                'name' => 'shout',
                'singular_name' => 'shout',
                'add_new' => _x('添加新shout', 'shout'),
                'add_new_item' => __('添加新shout'),
                'edit_item' => __('编辑shout'),
                'new_item' => __('新的shout'),
                'view_item' => __('预览shout'),
                'search_items' => __('搜索shout'),
                'not_found' =>  __('您还没有发布shout'),
                'not_found_in_trash' => __('回收站中没有shout'),
                'parent_item_colon' => ''
            ),
            'show_ui' => true,
            'menu_position'=>6,
            'supports' => array(
                'title',
                'author',
                'excerpt',
                'thumbnail',
                'trackbacks',
                'editor',
                'comments',
                'custom-fields',
                'revisions'	) ,
            'show_in_nav_menus'	=> true ,
        )
    );
}
add_action('init', 'post_type_shout');
function post_type_data() {
    register_post_type(
        'data',
        array( 'public' => true,
            'has_archive' => true,
            'labels'=>array(
                'name' => '数字',
                'singular_name' => 'data',
                'add_new' => _x('添加新数字', '数字'),
                'add_new_item' => __('添加新数字'),
                'edit_item' => __('编辑数字'),
                'new_item' => __('新的数字'),
                'view_item' => __('预览数字'),
                'search_items' => __('搜索数字'),
                'not_found' =>  __('您还没有发布数字'),
                'not_found_in_trash' => __('回收站中没有数字'),
                'parent_item_colon' => ''
            ),
            'show_ui' => true,
            'menu_position'=>5,
            'supports' => array(
                'title',
                'author',
                'excerpt',
                'thumbnail',
                'trackbacks',
                'editor',
                'comments',
                'custom-fields',
                'revisions'	) ,
            'show_in_nav_menus'	=> true ,
        )
    );
}
add_action('init', 'post_type_data');
/**
 * Presscore <Comment Author Level> in the theme.
 *
 *
 * @version 1.0
 * @package Bigfa
 * @copyright 2013 all rights reserved
 *
 */

function get_author_level($comment_author_email,$user_id){
    global $wpdb;
    $adminEmail = get_option('admin_email');
    $author_count  =  count($wpdb->get_results(
        "SELECT comment_ID as author_count FROM  $wpdb->comments WHERE comment_author_email = '$comment_author_email' "));
    if($comment_author_email ==$adminEmail)
        echo '<a href="javascript:;" title="深不可测，惨不忍睹">貌赛无盐</a>';
    if($author_count>=0 && $author_count<10 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.1">不堪一击</a>';
    else if($author_count>=10 && $author_count<20 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.2">毫不足虑</a>';
    else if($author_count>=20 && $author_count<30 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.3">不足挂齿</a>';
    else if($author_count>=30 && $author_count<40 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.4">初学乍练</a>';
    else if($author_count>=40 &&$author_count<50 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.5">勉勉强强</a>';
    else if($author_count>=50 && $author_count<60 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.6">初窥门径</a>';
    else if($author_count>=60 && $author_count<70 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.7">略知一二</a>';
    else if($author_count>=70 && $author_count<80 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.8">普普通通</a>';
    else if($author_count>=80 && $author_count<90 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.9">平平常常</a>';
    else if($author_count>=90 && $author_count<100 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.10">平淡无奇</a>';
    else if($author_count>=100 && $author_count<110 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.11">粗懂皮毛</a>';
    else if($author_count>=110 && $author_count<120 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.12">半生不熟</a>';
    else if($author_count>=120 && $author_count<130 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.13">登堂入室</a>';
    else if($author_count>=130 && $author_count<140 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.14">略有小成</a>';
    else if($author_count>=140 && $author_count<150 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.15">已有小成</a>';
    else if($author_count>=150 && $author_count<160 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.16">鹤立鸡群</a>';
    else if($author_count>=160 && $author_count<170 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.17">驾轻就熟</a>';
    else if($author_count>=170 && $author_count<180 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.18">青出於蓝</a>';
    else if($author_count>=180 && $author_count<190 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.19">融会贯通</a>';
    else if($author_count>=190 && $author_count<200 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.20">心领神会</a>';
    else if($author_count>=200 && $author_count<210 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.21">炉火纯青</a>';
    else if($author_count>=210 && $author_count<220 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.22">了然於胸</a>';
    else if($author_count>=220 && $author_count<230 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.23">略有大成</a>';
    else if($author_count>=230 && $author_count<240 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.24">已有大成</a>';
    else if($author_count>=240 && $author_count<250 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.25">豁然贯通</a>';
    else if($author_count>=250 && $author_count<260 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.26">非比寻常</a>';
    else if($author_count>=260 && $author_count<270 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.27">出类拔萃</a>';
    else if($author_count>=270 && $author_count<280 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.28">罕有敌手</a>';
    else if($author_count>=280 && $author_count<290 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.29">技冠群雄</a>';
    else if($author_count>=290 && $author_count<300 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.30">神乎其技</a>';
    else if($author_count>=300 && $author_count<310 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.31">出神入化</a>';
    else if($author_count>=310 && $author_count<320 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.32">傲视群雄</a>';
    else if($author_count>=320 && $author_count<330 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.33">登峰造极</a>';
    else if($author_count>=330 && $author_count<340 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.34">无与伦比</a>';
    else if($author_count>=340 && $author_count<350 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.35">所向披靡</a>';
    else if($author_count>=350 && $author_count<360 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.36">一代宗师</a>';
    else if($author_count>=360 && $author_count<370 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.37">精深奥妙</a>';
    else if($author_count>=370 && $author_count<380 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.38">神功盖世</a>';
    else if($author_count>=380 && $author_count<390 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.39">举世无双</a>';
    else if($author_count>=390 && $author_count<400 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.40">惊世骇俗</a>';
    else if($author_count>=400 && $author_count<410 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.41">撼天动地</a>';
    else if($author_count>=410 && $author_count<420 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.42">震古铄今</a>';
    else if($author_count>=420 && $author_count<430 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.43">超凡入圣</a>';
    else if($author_count>=430 && $author_count<440 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.44">威镇寰宇</a>';
    else if($author_count>=440 && $author_count<450 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.45">空前绝后</a>';
    else if($author_count>=450 && $author_count<460 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.46">天人合一</a>';
    else if($author_count>=460 && $author_count<470 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.47">深藏不露</a>';
    else if($author_count>=470 && $author_count<480 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.48">深不可测</a>';
    else if($author_count>=480 && $author_count<490 && $comment_author_email !==$adminEmail)
        echo '<a href="javascript:;" title="Lv.49">返璞归真</a>';
}
/**
 * Presscore <relatedpost> in the theme.
 *
 *
 * @version 1.0
 * @package Bigfa
 * @copyright 2013 all rights reserved
 *
 */

function presscore_relatedpost() {

    echo '<div class="rlt-post"><div class="bfd_title"><h3>暧昧帖</h3></div><div class="bfd_content"><ul>';
    $post_num = 8;
    $exclude_id = $post->ID;
    $posttags = get_the_tags(); $i = 0;
    if ( $posttags ) {
        $tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->term_id . ',';
        $args = array(
            'post_status' => 'publish',
            'tag__in' => explode(',', $tags),
            'post__not_in' => explode(',', $exclude_id),
            'ignore_sticky_posts' => 1,
            'orderby' => 'comment_date',
            'posts_per_page' => $post_num
        );
        query_posts($args);
        while( have_posts() ) { the_post(); ?>
            <li>

                <a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
            </li>
            <?php
            $exclude_id .= ',' . $post->ID; $i ++;
        } wp_reset_query();
    }
    if ( $i < $post_num ) {
        $cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
        $args = array(
            'category__in' => explode(',', $cats),
            'post__not_in' => explode(',', $exclude_id),
            'ignore_sticky_posts' => 1,
            'orderby' => 'comment_date',
            'posts_per_page' => $post_num - $i
        );
        query_posts($args);
        while( have_posts() ) { the_post(); ?>
            <li>

                <a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
            </li>

            <?php $i++;
        } wp_reset_query();
    }
    if ( $i  == 0 )  echo '<li>没有相关文章!</li>';
    echo '</ul></div></div>';
}
add_filter('smilies_src','custom_smilies_src',1,10);
function custom_smilies_src ($img_src, $img, $siteurl){
    return get_bloginfo('template_directory').'/img/smilies/'.$img;
}


if(!function_exists('fatesinger_modify_dashboard_widgets')){

    add_action('wp_dashboard_setup', 'fatesinger_modify_dashboard_widgets' );
    function fatesinger_modify_dashboard_widgets() {
        global $wp_meta_boxes;

        wp_add_dashboard_widget('wpjam_dashboard_widget', 'Fatesinger', 'wpjam_dashboard_widget_function');
    }

    function wpjam_dashboard_widget_function() {?>
        <p>
            Fatesinger 专注Wordpress 30年</p>
        <hr />
        <?php
        echo '<div class="rss-widget">';
        wp_widget_rss_output('http://fatesinger.com/feed/', array( 'show_author' => 0, 'show_date' => 1, 'show_summary' => 0 ));
        echo "</div>";
    }
}

function disable_dashboard_widgets() {
    remove_meta_box('dashboard_primary', 'dashboard', 'core');
    remove_meta_box('dashboard_secondary', 'dashboard', 'core');
    remove_meta_box('dashboard_right_now', 'dashboard', 'core');
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
    remove_meta_box('dashboard_plugins', 'dashboard', 'core');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
}
//add_action('admin_menu', 'disable_dashboard_widgets');


if ( !is_admin() ) { function my_init_method() { wp_deregister_script( 'jquery' );  }
    add_action('init', 'my_init_method'); }
wp_deregister_script( 'l10n' );

if( bools('d_bigfa_showbox_b') ){
    add_filter('the_content', 'addhighslideclass_replace');
}

function addhighslideclass_replace ($content)
{ global $post;
    $pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
    $replacement = '<a$1href=$2$3.$4$5 class="fancybox" rel="fancybox" $6>$7</a>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}
if ( !is_admin() ){
    $timer = @filemtime(TEMPLATEPATH .'/style.css');
    $dir = get_bloginfo('template_directory');
    wp_enqueue_script( 'jquerylib', $dir . '/js/jquery.js', array(), '1.7', false);}


function link_to_menu_editor( $args )
{
    if ( ! current_user_can( 'manage_options' ) )
    {
        return;
    }

    extract( $args );

    $link = $link_before
        . '<a href="' .admin_url( 'nav-menus.php' ) . '">' . $before . 'Add a menu' . $after . '</a>'
        . $link_after;

    if ( FALSE !== stripos( $items_wrap, '<ul' )
        or FALSE !== stripos( $items_wrap, '<ol' )
    )
    {
        $link = "<li>$link</li>";
    }

    $output = sprintf( $items_wrap, $menu_id, $menu_class, $link );
    if ( ! empty ( $container ) )
    {
        $output  = "<$container class='$container_class' id='$container_id'>$output</$container>";
    }

    if ( $echo )
    {
        echo $output;
    }

    return $output;
}

function leon_get_firstpostdate($format = "Y-m-d")
{
    $ax_args = array
    (
        'numberposts' => -1,
        'post_status' => 'publish',
        'order' => 'ASC'
    );
    $ax_get_all = get_posts($ax_args);
    $ax_first_post = $ax_get_all[0];
    $ax_first_post_date = $ax_first_post->post_date;
    $output = date($format, strtotime($ax_first_post_date));
    return $output;
}

function bigfa_modify_user_contact_methods( $user_contact ){
    $user_contact['github'] = __('Github');
    $user_contact['linkedin'] = __('Linkedin');
    $user_contact['zhihu'] = __('知乎');
    $user_contact['sinaweibo'] = __('新浪微博');
    $user_contact['taobao'] = __('淘宝');
    $user_contact['wangyi'] = __('网易云阅读');
    $user_contact['instagram'] = __('instagram');
    unset($user_contact['aim']);
    unset($user_contact['jabber']);
    unset($user_contact['yim']);
    return $user_contact;
}
add_filter('user_contactmethods', 'bigfa_modify_user_contact_methods');

function twentytwelve_wp_title( $title, $sep ) {
    global $paged, $page;
    if ( is_feed() )
        return $title;
    $title .= get_bloginfo( 'name' );
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";
    if ( $paged >= 2 || $page >= 2 )
        $title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );
    return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );

function past_date() {
    global $post;
    $suffix = ' 前';
    $day = ' 天';
    $hour = ' 小时';
    $minute = ' 分钟';
    $second = ' 秒';
    $m = 60;
    $h = 3600;
    $d = 86400;
    $post_time = get_post_time('G', true, $post);
    $past_time = time() - $post_time;
    if ($past_time < $m) {
        $past_date = $past_time . $second;
    } else if ($past_time < $h) {
        $past_date = $past_time / $m;
        $past_date = floor($past_date);
        $past_date .= $minute;
    } else if ($past_time < $d) {
        $past_date = $past_time / $h;
        $past_date = floor($past_date);
        $past_date .= $hour;
    } else if ($past_time < $d * 30) {
        $past_date = $past_time / $d;
        $past_date = floor($past_date);
        $past_date .= $day;
    } else {
        the_time('d,m,Y');
        return;
    }
    echo $past_date . $suffix;
}
add_filter('past_date', 'past_date');
add_theme_support( 'post-formats', array( 'status','aside','audio') );

add_theme_support( 'post-thumbnails' );
function post_thumbnail( $width = 255,$height = 130 ){
    global $post;
    if( has_post_thumbnail() ){
        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
        $post_timthumb = '<img src="'.get_bloginfo("template_url").'/timthumb.php?src='.$timthumb_src[0].'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.$post->post_title.'" class="thumb" title="'.get_the_title().'"/>';
        echo $post_timthumb;
    } else {
        $content = $post->post_content;
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
        $n = count($strResult[1]);
        if($n > 0){
            echo '<img src="'.get_bloginfo("template_url").'/timthumb.php?w='.$width.'&amp;h='.$height.'&amp;src='.$strResult[1][0].'" title="'.get_the_title().'" alt="'.get_the_title().'"/>';
        } else {
            echo '<img src="'.get_bloginfo("template_url").'/timthumb.php?w='.$width.'&amp;h='.$height.'&amp;src='.get_bloginfo('template_url').'/img/random/'.rand(1,9).'.jpg" title="'.get_the_title().'" alt="'.get_the_title().'"/>';
        }
    }
}
function bools($e){
    return stripslashes(get_option($e));
}
remove_action( 'wp_head',   'feed_links_extra', 3 );
remove_action( 'wp_head',   'rsd_link' );
remove_action( 'wp_head',   'wlwmanifest_link' );
remove_action( 'wp_head',   'index_rel_link' );
remove_action( 'wp_head',   'start_post_rel_link', 10, 0 );
remove_action( 'wp_head',   'wp_generator' );
add_action('wp_head','dtheme_description');
add_filter( 'pre_option_link_manager_enabled', '__return_true' );
remove_action('pre_post_update','wp_save_post_revision' );


function bigfa_spam( $comment ) {
    $email = $comment['comment_author_email'];
    $g = 'http://www.gravatar.com/avatar/'. md5( strtolower( $email ) ). '?d=404';
    $headers = @get_headers( $g );
    if ( !preg_match("|200|", $headers[0]) ) {
        die();
    }
    return $comment;
}
if( bools('d_bigfa_spam_b') ){
    add_action('preprocess_comment', 'bigfa_spam');
}


function the_category_filter($thelist){
    return preg_replace('/rel=".*?"/','rel="tag"',$thelist);
}
add_filter('the_category','the_category_filter');



function cut_str($string, $sublen, $start = 0, $code = 'UTF-8')
{
    if($code == 'UTF-8')
    {
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $string, $t_string);
        if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";
        return join('', array_slice($t_string[0], $start, $sublen));
    }
    else
    {
        $start = $start*2;
        $sublen = $sublen*2;
        $strlen = strlen($string);
        $tmpstr = '';
        for($i=0; $i<$strlen; $i++)
        {
            if($i>=$start && $i<($start+$sublen))
            {
                if(ord(substr($string, $i, 1))>129) $tmpstr.= substr($string, $i, 2);
                else $tmpstr.= substr($string, $i, 1);
            }
            if(ord(substr($string, $i, 1))>129) $i++;
        }
        if(strlen($tmpstr)<$strlen ) $tmpstr.= "...";
        return $tmpstr;
    }
}

function twentytwelve_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'twentytwelve' ),
        'id' => 'sidebar-1',
        'description' => __( '首页边栏', 'twentytwelve' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ) );

    register_sidebar( array(
        'name' => __( 'First Front Page Widget Area', 'twentytwelve' ),
        'id' => 'sidebar-2',
        'description' => __( '文章及页面边栏', 'twentytwelve' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ) );

}
add_action( 'widgets_init', 'twentytwelve_widgets_init' );

remove_action('pre_post_update','wp_save_post_revision');
add_action('wp_print_scripts','disable_autosave');
function disable_autosave(){  wp_deregister_script('autosave'); }

function par_pagenavi($range = 6){
    global $paged, $wp_query;
    if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
    if($max_page > 1){if(!$paged){$paged = 1;}
        if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'>首页</a>";}
        if($paged>1) echo '<a href="' . get_pagenum_link($paged-1) .'" class="prev">上一页</a>';
        if($max_page > $range){
            if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<a href='" . get_pagenum_link($i) ."'";
                if($i==$paged)echo " class='current'";echo ">$i</a>";}}
            elseif($paged >= ($max_page - ceil(($range/2)))){
                for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
                    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
            elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
                for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}}
        else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
            if($i==$paged)echo " class='current'";echo ">$i</a>";}}
        if($paged<$max_page) echo '<a href="' . get_pagenum_link($paged+1) .'" class="next">下一页</a>';
        if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'>尾页</a>";}}
}

function pagenavi( $p = 2 ) {if ( is_singular() ) return; global $wp_query, $paged;$max_page = $wp_query->max_num_pages;if ( $max_page == 1 ) return; if ( empty( $paged ) ) $paged = 1;echo '<span class="pagescout">Page: ' . $paged . ' of ' . $max_page . ' </span> '; if ( $paged > $p + 1 ) p_link( 1, '第 1 页' );if ( $paged > $p + 2 ) echo '... ';for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span> " : p_link( $i );}if ( $paged < $max_page - $p - 1 ) echo '... ';if ( $paged < $max_page - $p ) p_link( $max_page, '最末页' );}
function p_link( $i, $title = '' ) { if ( $title == '' ) $title = "第 {$i} 页";echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$i}</a> ";}

function comment_mail_notify($comment_id) {
    $comment = get_comment($comment_id);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $spam_confirmed = $comment->comment_approved;
    if (($parent_id != '') && ($spam_confirmed != 'spam')) {
        $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 發出點, no-reply 可改為可用的 e-mail.
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = '你在 [' . get_option("blogname") . '] 的留言有了新回复';
        $message = '

	<div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px; border-radius:5px;">
	<p><strong>' . trim(get_comment($parent_id)->comment_author) . ', 你好!</strong></p>
	<p><strong>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言为:</strong><br />'
            . trim(get_comment($parent_id)->comment_content) . '</p>
	<p><strong>' . trim($comment->comment_author) . ' 给你的回复是:</strong><br />'
            . trim($comment->comment_content) . '<br /></p>
	<p>你可以点击此链接 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看完整内容</a></p><br />
	<p>欢迎再次来访<a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
	<p>(此邮件为系统自动发送，请勿直接回复.)</p>
	</div>';

        $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail( $to, $subject, $message, $headers );
    }
}
add_action('comment_post', 'comment_mail_notify');

function time_ago( $type = 'commennt', $day = 30 ) {
    $d = $type == 'post' ? 'get_post_time' : 'get_comment_time';
    $timediff = time() - $d('U');
    if ($timediff <= 60*60*24*$day){
        echo  human_time_diff($d('U'), strtotime(current_time('mysql', 0))), '前';
    }
    if ($timediff > 60*60*24*$day){
        echo  date('Y/m/d',get_comment_date('U')), ' ', get_comment_time('H:i');
    };
}

function remove_css_gal() {
    return "\n" . '<div class="gallery">';
}
add_filter( 'gallery_style', 'remove_css_gal', 9 );

function fb_addgravatar( $avatar_defaults ) {
    $myavatar = get_bloginfo('template_directory') . '/img/defaultavatar.png';
    $avatar_defaults[$myavatar] = '自定义头像';
    return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'fb_addgravatar' );

add_theme_support( 'menus' );
if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus(
        array(
            'header-menu' => __( '导航自定义菜单' ),
            'top-menu' => __( '顶部菜单' ),
        )
    );
}

function enable_threaded_comments(){
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
            wp_enqueue_script('comment-reply');
    }
}
add_action('get_header', 'enable_threaded_comments');

add_filter('login_errors',create_function('$a', "return null;"));

remove_filter('the_content', 'wptexturize');

add_filter('pre_get_posts','search_filter');
function search_filter($query) {
    if ($query->is_search) {$query->set('post_type', 'post');}
    return $query;}

function hu_popuplinks($text) {
    $text = preg_replace('/<a (.+?)>/i', "<a $1 target='_blank'>", $text);
    return $text;
}
add_filter('get_comment_author_link', 'hu_popuplinks', 6);


function custom_excerpt_more($more) {
    return 'Read More &raquo;';
}
add_filter('excerpt_more', 'custom_excerpt_more');

function remove_more_jump_link($link) {return preg_replace('/#more-\d+/i','',$link);}
add_filter('the_content_more_link', 'remove_more_jump_link');

/*站点描述*/
function dtheme_description() {
    global $s, $post;
    $description = '';
    $blog_name = get_bloginfo('name');
    if ( is_singular() ) {
        if( !empty( $post->post_excerpt ) ) {
            $text = $post->post_excerpt;
        } else {
            $text = $post->post_content;
        }
        $description = trim( str_replace( array( "\r\n", "\r", "\n", "　", " "), " ", str_replace( "\"", "'", strip_tags( $text ) ) ) );
        if ( !( $description ) ) $description = $blog_name . "-" . trim( wp_title('', false) );
    } elseif ( is_home () )    { $description = bools('d_description'); // 首頁要自己加
    } elseif ( is_tag() )      { $description = $blog_name . "'" . single_tag_title('', false) . "'";
    } elseif ( is_category() ) { $description = $blog_name . "'" . single_cat_title('', false) . "'";
    } elseif ( is_archive() )  { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
    } elseif ( is_search() )   { $description = $blog_name . ": '" . esc_html( $s, 1 ) . "' 的搜索結果";
    } else { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
    }
    $description = mb_substr( $description, 0, 220, 'utf-8' );
    echo "<meta name=\"description\" content=\"$description\">\n";
}

function fs_ajax_pagenavi(){
    if( isset($_GET['action'])&& $_GET['action'] == 'fs_ajax_pagenavi'  ){
        global $post,$wp_query, $wp_rewrite;
        $postid = isset($_GET['post']) ? $_GET['post'] : null;
        $pageid = isset($_GET['page']) ? $_GET['page'] : null;
        if(!$postid || !$pageid){
            fail(__('Error post id or comment page id.'));
        }
        // get comments
        $comments = get_comments('post_id='.$postid);

        $post = get_post($postid);

        if(!$comments){
            fail(__('Error! can\'t find the comments'));
        }

        if( 'desc' != get_option('comment_order') ){
            $comments = array_reverse($comments);
        }

        // set as singular (is_single || is_page || is_attachment)
        $wp_query->is_singular = true;

        // base url of page links
        $baseLink = '';
        if ($wp_rewrite->using_permalinks()) {
            $baseLink = '&base=' . user_trailingslashit(get_permalink($postid) . 'comment-page-%#%', 'commentpaged');
        }

        // response 注意修改callback为你自己的，没有就去掉callback
        echo '<ol class="comment-list" >';
        wp_list_comments('callback=devecomment&type=comment&page=' . $pageid . '&per_page=' . get_option('comments_per_page'), $comments);
        echo '</ol>';
        echo '<nav class="commentnav">';
        paginate_comments_links('current=' . $pageid . '&prev_text=«&next_text=»');
        echo '</nav>';
        die;
    }
}

add_action('wp_ajax_nopriv_ajax_comment', 'ajax_comment');
add_action('wp_ajax_ajax_comment', 'ajax_comment');
function ajax_comment(){
    global $wpdb;
    $comment_post_ID = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;
    $post = get_post($comment_post_ID);
    if ( empty($post->comment_status) ) {
        do_action('comment_id_not_found', $comment_post_ID);
        ajax_comment_err(__('Invalid comment status.'));
    }
    $status = get_post_status($post);
    $status_obj = get_post_status_object($status);
    if ( !comments_open($comment_post_ID) ) {
        do_action('comment_closed', $comment_post_ID);
        ajax_comment_err(__('Sorry, comments are closed for this item.'));
    } elseif ( 'trash' == $status ) {
        do_action('comment_on_trash', $comment_post_ID);
        ajax_comment_err(__('Invalid comment status.'));
    } elseif ( !$status_obj->public && !$status_obj->private ) {
        do_action('comment_on_draft', $comment_post_ID);
        ajax_comment_err(__('Invalid comment status.'));
    } elseif ( post_password_required($comment_post_ID) ) {
        do_action('comment_on_password_protected', $comment_post_ID);
        ajax_comment_err(__('Password Protected'));
    } else {
        do_action('pre_comment_on_post', $comment_post_ID);
    }
    $comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
    $comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
    $comment_author_url   = ( isset($_POST['url']) )     ? trim($_POST['url']) : null;
    $comment_content      = ( isset($_POST['comment']) ) ? trim($_POST['comment']) : null;
    $user = wp_get_current_user();
    if ( $user->exists() ) {
        if ( empty( $user->display_name ) )
            $user->display_name=$user->user_login;
        $comment_author       = $wpdb->escape($user->display_name);
        $comment_author_email = $wpdb->escape($user->user_email);
        $comment_author_url   = $wpdb->escape($user->user_url);
        $user_ID			  = $wpdb->escape($user->ID);
        if ( current_user_can('unfiltered_html') ) {
            if ( wp_create_nonce('unfiltered-html-comment_' . $comment_post_ID) != $_POST['_wp_unfiltered_html_comment'] ) {
                kses_remove_filters();
                kses_init_filters();
            }
        }
    } else {
        if ( get_option('comment_registration') || 'private' == $status )
            ajax_comment_err(__('Sorry, you must be logged in to post a comment.'));
    }
    $comment_type = '';
    if ( get_option('require_name_email') && !$user->exists() ) {
        if ( 6 > strlen($comment_author_email) || '' == $comment_author )
            ajax_comment_err( __('Error: please fill the required fields (name, email).') );
        elseif ( !is_email($comment_author_email))
            ajax_comment_err( __('Error: please enter a valid email address.') );
    }
    if ( '' == $comment_content )
        ajax_comment_err( __('Error: please type a comment.') );
    $dupe = "SELECT comment_ID FROM $wpdb->comments WHERE comment_post_ID = '$comment_post_ID' AND ( comment_author = '$comment_author' ";
    if ( $comment_author_email ) $dupe .= "OR comment_author_email = '$comment_author_email' ";
    $dupe .= ") AND comment_content = '$comment_content' LIMIT 1";
    if ( $wpdb->get_var($dupe) ) {
        ajax_comment_err(__('Duplicate comment detected; it looks as though you&#8217;ve already said that!'));
    }
    if ( $lasttime = $wpdb->get_var( $wpdb->prepare("SELECT comment_date_gmt FROM $wpdb->comments WHERE comment_author = %s ORDER BY comment_date DESC LIMIT 1", $comment_author) ) ) {
        $time_lastcomment = mysql2date('U', $lasttime, false);
        $time_newcomment  = mysql2date('U', current_time('mysql', 1), false);
        $flood_die = apply_filters('comment_flood_filter', false, $time_lastcomment, $time_newcomment);
        if ( $flood_die ) {
            ajax_comment_err(__('You are posting comments too quickly.  Slow down.'));
        }
    }
    $comment_parent = isset($_POST['comment_parent']) ? absint($_POST['comment_parent']) : 0;
    $commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_ID');

    $comment_id = wp_new_comment( $commentdata );

    $comment = get_comment($comment_id);
    do_action('set_comment_cookies', $comment, $user);
    $comment_depth = 1;
    $tmp_c = $comment;
    while($tmp_c->comment_parent != 0){
        $comment_depth++;
        $tmp_c = get_comment($tmp_c->comment_parent);
    }
    $GLOBALS['comment'] = $comment;	//your comments here	edit start 
    ?>
<li class="comments" id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="comment-author"> <?php echo get_avatar( $comment, $size = '40'); ?> <cite><?php printf(__('%s'), get_comment_author_link()) ?></cite> <span><?php echo time_ago(); ?></span>
        <section class="comment-con">
            <?php comment_text() ?>
        </section>
    </div>
    <?php die();

}
function ajax_comment_err($a) {
    header('HTTP/1.0 500 Internal Server Error');
    header('Content-Type: text/plain;charset=UTF-8');
    echo $a;
    exit;
}

    add_action('init', 'fs_ajax_pagenavi');
    function devecomment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    global $commentcount;
    if(!$commentcount) {
        $page = ( !empty($in_comment_loop) ) ? get_query_var('cpage')-1 : get_page_of_comment( $comment->comment_ID, $args )-1;
        $cpp=get_option('comments_per_page');
        $commentcount = $cpp * $page;
    }
    ?>
<li class="comments" <?php if( $depth > 2){ echo ' style="margin-left:-50px;"';} ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="comment-author"> <?php echo get_avatar( $comment, $size = '40'); ?> <cite id="author-<?php comment_ID() ?>"><?php printf(__('%s'), get_comment_author_link()) ?></cite><?php if ( bools('d_bigfa_comment_level_b')){ ?>
            <span class="level">[ <?php get_author_level($comment->comment_author_email,$comment->user_id)?> ]</span>
        <?php } ?><span class="ua">
    <?php get_useragent($comment->comment_agent);?>
    </span><span class="floor">
    <?php
    if(!$parent_id = $comment->comment_parent){
        switch ($commentcount){
            case 0 :echo "<font style='color:#cc0000'>沙发</font>";++$commentcount;break;
            case 1 :echo "<font style='color:#93BF20'>板凳</font>";++$commentcount;break;
            case 2 :echo "<font style='color:#000000'>地板</font>";++$commentcount;break;
            default:printf('%1$s楼', ++$commentcount);
        }
    }
    ?>
    </span>
        <?php if($comment->comment_parent){// 如果存在父级评论
            $comment_parent_href = get_comment_ID( $comment->comment_parent );
            $comment_parent = get_comment($comment->comment_parent);
            ?>
            <span class="comment-to plr">回复</span> <span class="reply-comment-author"><a href="#comment-<?php echo $comment_parent_href;?>"><?php echo $comment_parent->comment_author;?></a></span>
        <?php }?>
        <span><?php echo time_ago(); ?></span>
        <section id="commentText-<?php comment_ID() ?>" class="comment-con">
            <?php comment_text() ?>
        </section>
        <div class="comment-reply">
            <?php comment_reply_link(array_merge( $args, array('reply_text' => '回复','depth' => $depth, 'max_depth' => $args['max_depth']))) ?> |
            <a onclick="SIMPALED.quote( 'author-<?php comment_ID() ?>','commentText-<?php comment_ID() ?>')" href="#respond" class="comment-reply-link ">引用</a>
        </div>
    </div>
    <?php
    }

    function devepings($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
<li id="comment-<?php comment_ID(); ?>">
    <div class="pingdiv">
        <?php comment_author_link(); ?>
    </div>
    <?php }
    include_once('include/widget.php');
    include_once('include/themeset.php');
    include_once('include/user-agent.php');
    ?>

<?php
class bigfa_widget extends WP_Widget {
    function bigfa_widget() { // 挂件实例化
        $widget_ops = array('description' => '最热文章');
        $this->WP_Widget('bigfa_widget', 'P-热门文章', $widget_ops);
    }
    function widget($args, $instance) { // 输出挂件内容
        extract($args);
        $limit = strip_tags($instance['limit']);
        $poptime = strip_tags($instance['poptime']);
        echo $before_widget;
        ?>


        <h2>热门文章</h2>
        <ul id="ajax-pop-posts" class="articlelist">

            <?php $days=$poptime;$nums=$limit;global $wpdb;$today = date("Y-m-d H:i:s"); $daysago = date( "Y-m-d H:i:s", strtotime($today) - ($days * 24 * 60 * 60) ); $i=0;$result = $wpdb->get_results("SELECT comment_count, ID, post_title, post_date ,post_type FROM $wpdb->posts WHERE  post_type = 'post' AND post_date BETWEEN '$daysago' AND '$today' ORDER BY comment_count DESC LIMIT 0 , $nums");$output = '';if(empty($result)) {$output = '<li>None data.</li>';} else {foreach ($result as $topten) {$postid = $topten->ID;$title = $topten->post_title;$commentcount = $topten->comment_count;$i++;if ($commentcount != 0) {$output .= '<li><a href="'.get_permalink($postid).'" rel="bookmark" title="'.$title.'">
<span class="comment">'.$i.'</span><span class="title">'.$title.'['.$commentcount.']</span></a></li>';}}}echo $output; ?>

        </ul>

        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) { // 选项保存过程
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['limit'] = strip_tags($new_instance['limit']);
        $instance['poptime'] = strip_tags($new_instance['poptime']);
        return $instance;
    }
    function form($instance) { // 在管理界面输出选项表单
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title' => '', 'limit' => ''));
        $title = esc_attr($instance['title']);
        $limit = strip_tags($instance['limit']);
        $poptime = strip_tags($instance['poptime']);
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">文章数量：<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('poptime'); ?>" >热评文章时间范围:<br>（例如希望Popular栏目显示90天内评论最多的文章，则输入“90”）<input class="widefat" id="<?php echo $this->get_field_id('poptime'); ?>" name="<?php echo $this->get_field_name('poptime'); ?>" type="text" value="<?php echo $poptime; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
    <?php
    }
}
add_action('widgets_init', 'bigfa_widget_init');
function bigfa_widget_init() {
    register_widget('bigfa_widget');
}


class bigfa_widget2 extends WP_Widget {
    function bigfa_widget2() {
        $widget_ops = array('description' => '列出最近编辑的文章文章');
        $this->WP_Widget('bigfa_widget2', 'P-最近编辑的文章', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title',esc_attr($instance['title']));
        $limit = strip_tags($instance['limit']);
        $cateid = strip_tags($instance['cateid']);
        echo $before_widget.$before_title.$title.$after_title;
        ?>
        <ul class="widget-posts">
            <?php query_posts( array('showposts' => $limit,'orderby' => 'modified'));?>
            <?php while (have_posts()) : the_post(); ?>
                <li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"> <span class="title">
    <?php the_title(); ?>
    </span><br>
    <span class="modified">Last modified::
        <?php the_modified_time('F j'); ?>
        at
        <?php the_modified_time('G:i'); ?>
    </span> </a></li>
            <?php endwhile;wp_reset_query(); ?>
        </ul>

        <?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['limit'] = strip_tags($new_instance['limit']);
        $instance['cateid'] = strip_tags($new_instance['cateid']);
        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => '', 'cateid' => ''));
        $title = esc_attr($instance['title']);
        $limit = strip_tags($instance['limit']);
        $cateid = strip_tags($instance['cateid']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">显示数量：<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('cateid'); ?>">输入分类ID（请看操作说明）：<input class="widefat" id="<?php echo $this->get_field_id('cateid'); ?>" name="<?php echo $this->get_field_name('cateid'); ?>" type="text" value="<?php echo $cateid; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
    <?php
    }
}
add_action('widgets_init', 'bigfa_widget2_init');
function bigfa_widget2_init() {
    register_widget('bigfa_widget2');
}

class bigfa_widget3 extends WP_Widget {
    function bigfa_widget3() {
        $widget_ops = array('description' => '支持评论表情');
        $this->WP_Widget('bigfa_widget3', 'P-主题最新评论', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title',esc_attr($instance['title']));
        $limit = strip_tags($instance['limit']);
        $email = strip_tags($instance['email']);
        echo $before_widget.$before_title.$title.$after_title;
        ?>
        <ul class="recentcomments">
            <?php
            global $wpdb;
            $limit_num = $limit ;
            $my_email ="'" . $email . "'";
            $rc_comms = $wpdb->get_results("SELECT ID, post_title, comment_ID, comment_author,comment_author_email,comment_date,comment_content FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID  = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' AND comment_author_email != $my_email ORDER BY comment_date_gmt DESC LIMIT $limit_num ");
            $rc_comments = '';foreach ($rc_comms as $rc_comm) { $rc_comments .= "<li>" . get_avatar($rc_comm,$size='30') ."<div class='rc-info'><span class='rc-reviewer'>".$rc_comm->comment_author."</span>在<a class='rc-post' href='". get_permalink($rc_comm->ID) . "#comment-" . $rc_comm->comment_ID. "'>" . $rc_comm->post_title .  "</a></div><div class='rc_excerpt'>".$rc_comm->comment_content."</div></li>\n";}
            $rc_comments = convert_smilies($rc_comments);
            echo $rc_comments;
            ?>
        </ul>

        <?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['limit'] = strip_tags($new_instance['limit']);
        $instance['email'] = strip_tags($new_instance['email']);
        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => '', 'email' => ''));
        $title = esc_attr($instance['title']);
        $limit = strip_tags($instance['limit']);
        $email = strip_tags($instance['email']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">显示数量：(最好5个以下) <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('email'); ?>">输入你的邮箱以排除显示你的回复: <br>（留空则不排除）<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
    <?php
    }
}
add_action('widgets_init', 'bigfa_widget3_init');
function bigfa_widget3_init() {
    register_widget('bigfa_widget3');
}


class bigfa_widget4 extends WP_Widget {
    function bigfa_widget4() {
        $widget_ops = array('description' => '列出某分类下的文章');
        $this->WP_Widget('bigfa_widget4', 'P-主题分类文章', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title',esc_attr($instance['title']));
        $limit = strip_tags($instance['limit']);
        $cateid = strip_tags($instance['cateid']);
        echo $before_widget.$before_title.$title.$after_title;
        ?>
        <ul class="widget-posts">
            <?php query_posts( array('showposts' => $limit,'cat' => $cateid,));?>
            <?php while (have_posts()) : the_post(); ?>
                <li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></li>
            <?php endwhile; ?>
        </ul>

        <?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['limit'] = strip_tags($new_instance['limit']);
        $instance['cateid'] = strip_tags($new_instance['cateid']);
        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => '', 'cateid' => ''));
        $title = esc_attr($instance['title']);
        $limit = strip_tags($instance['limit']);
        $cateid = strip_tags($instance['cateid']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">显示数量：<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('cateid'); ?>">输入分类ID（请看操作说明）：<input class="widefat" id="<?php echo $this->get_field_id('cateid'); ?>" name="<?php echo $this->get_field_name('cateid'); ?>" type="text" value="<?php echo $cateid; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
    <?php
    }
}
add_action('widgets_init', 'bigfa_widget4_init');
function bigfa_widget4_init() {
    register_widget('bigfa_widget4');
}


class bigfa_widget6 extends WP_Widget {
    function bigfa_widget6() {
        $widget_ops = array('description' => '配合主题样式，字体大小统一');
        $this->WP_Widget('bigfa_widget6', 'P-标签云', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title',esc_attr($instance['title']));
        $limit = strip_tags($instance['limit']);
        echo $before_widget.$before_title.$title.$after_title;
        ?>
        <div  class="tagcloud">
            <?php
            wp_tag_cloud( array(
                    'unit' => 'px',
                    'smallest' => 12,
                    'largest' => 12,
                    'number' => $limit,
                    'format' => 'flat',
                    'orderby' => 'count',
                    'order' => 'DESC'
                )
            );
            ?>
        </div>

        <?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['limit'] = strip_tags($new_instance['limit']);
        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => ''));
        $title = esc_attr($instance['title']);
        $limit = strip_tags($instance['limit']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">显示数量：<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
    <?php
    }
}
add_action('widgets_init', 'bigfa_widget6_init');
function bigfa_widget6_init() {
    register_widget('bigfa_widget6');
}


class bigfa_widget7 extends WP_Widget {
    function bigfa_widget7() {
        $widget_ops = array('description' => '双栏的分类目录，只支持一级目录');
        $this->WP_Widget('bigfa_widget7', 'P-主题分类目录', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title',esc_attr($instance['title']));
        $limit = strip_tags($instance['limit']);
        $orderby = strip_tags($instance['orderby']);
        $top = strip_tags($instance['top']);
        echo $before_widget.$before_title.$title.$after_title;
        ?>
        <ul  class="blogroll">
            <?php wp_list_categories( array(
                    'style' => 'list',
                    'show_count' => $limit,
                    'hide_empty' => 1,
                    'hierarchical' => $top,
                    'title_li' => '',
                    'orderby' => $orderby,
                    'order' => 'ASC',
                    'echo' => 1
                )
            );
            ?>
        </ul>

        <?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['limit'] = strip_tags($new_instance['limit']);
        $instance['orderby'] = strip_tags($new_instance['orderby']);
        $instance['top'] = strip_tags($new_instance['top']);
        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => '1','top' => '1', 'orderby' => 'name'));
        $title = esc_attr($instance['title']);
        $limit = strip_tags($instance['limit']);
        $orderby = strip_tags($instance['orderby']);
        $top = strip_tags($instance['top']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">是否显示文章统计：<br>默认“1”为显示，输入“0”为不显示<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('top'); ?>">分类层次：<br>● 默认“1”为只显示父层次<br>● 输入“0”则平铺显示所有层次分类<input class="widefat" id="<?php echo $this->get_field_id('top'); ?>" name="<?php echo $this->get_field_name('top'); ?>" type="text" value="<?php echo $top; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('orderby'); ?>">排序：<br>● 使用普通排序，输入“name”<br>● 使用 My Category Order 插件排序，输入“order”<input class="widefat" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" type="text" value="<?php echo $orderby; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
    <?php
    }
}
add_action('widgets_init', 'bigfa_widget7_init');
function bigfa_widget7_init() {
    register_widget('bigfa_widget7');
}


class bigfa_widget8 extends WP_Widget {
    function bigfa_widget8() {
        $widget_ops = array('description' => '推荐特色文章图片等');
        $this->WP_Widget('bigfa_widget8', 'P-腾讯邮箱订阅', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        ?>

        <aside class="widget rssbook bor">
            <h3 id="rssbook">邮件订阅</h3>
            <details class="rssinfo" open="open" subject="rssbook">输入您的邮箱，即可订阅本站的最新信息。</details>
            <form class="mailInput" method="post" target="_blank" action="http://list.qq.com/cgi-bin/qf_compose_send">
                <input type="hidden" value="qf_booked_feedback" name="t">
                <input type="hidden" value="<?php echo bools('d_maillist'); ?>" name="id">
                <input id="to" class="rsstxt placeholder" type="email" placeholder="i@example.com" value="" required="true" name="to">
                <input class="rsstsubmit" type="submit" value="订阅">
            </form>
        </aside>

    <?php

    }
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> ''));
        $title = esc_attr($instance['title']);

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <p>保存小工具后请到主题设置页面里设置。</p>

        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
    <?php
    }
}
add_action('widgets_init', 'bigfa_widget8_init');
function bigfa_widget8_init() {
    register_widget('bigfa_widget8');
}


class bigfa_widget9 extends WP_Widget {
    function bigfa_widget9() {
        $widget_ops = array('description' => '边栏展示一片数字下的最新文章');
        $this->WP_Widget('bigfa_widget9', 'P-边栏数字', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        ?>

        <aside class="widget widget-data clearfix">
<div class="widget-data-content">
<h4>
<a href="<?php bloginfo('url');?>/data">数字</a>
</h4>
<?php global $post;query_posts( array('showposts' => 1,'post_type' => 'data'));?>
            <?php while (have_posts()) : the_post(); ?>
			<a class="widget-body" href="<?php the_permalink() ?>" rel="external" target="_blank">
                <span class="widget-data-num num font-luzsans"><?php echo get_post_meta($post->ID, "data-num", true); ?> <?php echo get_post_meta($post->ID, "data-percent", true); ?></span>
				<span class="widget-data-text"><?php echo get_post_meta($post->ID, "data-text", true); ?></span>
</a>
            <?php endwhile;wp_reset_query(); ?>

<a id="widget-data-more" title="点击了解更多" href="<?php bloginfo('url');?>/data">了解更多 »</a>
</div>
</aside>

   <?php	
   }
    function form($instance) {
        global $wpdb;
?>
    <p>该工具没有选项!</p>
<?php
    }
}
add_action('widgets_init', 'bigfa_widget9_init');
function bigfa_widget9_init() {
    register_widget('bigfa_widget9');
}

class  bigfa_widget12 extends WP_Widget {
    function bigfa_widget12() {
        $widget_ops = array('description' => '双栏的友情链接，只支持一级目录');
        $this->WP_Widget('bigfa_widget12', 'P-友情链接', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title',esc_attr($instance['title']));
        $limit = strip_tags($instance['limit']);
        $orderby = strip_tags($instance['orderby']);
        $cats = strip_tags($instance['cats']);
        echo $before_widget.$before_title.$title.$after_title;
        ?>
        <ul  class="blogroll">
            <?php wp_list_bookmarks( array(
                    'limit' => $limit,
                    'hide_empty' => 1,
                    'category'  => $cats,
                    'categorize' => 0,
                    'title_li' => '',
                    'orderby' => $orderby,
                    'order' => 'ASC',
                    'echo' => 1
                )
            );
            ?>
        </ul>

        <?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['limit'] = strip_tags($new_instance['limit']);
        $instance['orderby'] = strip_tags($new_instance['orderby']);
        $instance['cats'] = strip_tags($new_instance['cats']);
        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => '-1', 'cats' => '', 'orderby' => 'name'));
        $title = esc_attr($instance['title']);
        $limit = strip_tags($instance['limit']);
        $orderby = strip_tags($instance['orderby']);
        $cats = strip_tags($instance['cats']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">数量：默认“-1”为全部显示。<br>如果需要限时数量，输入具体数值<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('cats'); ?>">显示分类：<br>● 默认不填写即显示所有分类里的链接<br>● 填写某分类的ID，显示此分类下的链接<input class="widefat" id="<?php echo $this->get_field_id('cats'); ?>" name="<?php echo $this->get_field_name('cats'); ?>" type="text" value="<?php echo $cats; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('orderby'); ?>">排序：<br>● 默认“name”按名称排列<br>● 如果需要其他排列，输入相应的排序形式。<a target="_blank" href="http://codex.wordpress.org/Function_Reference/wp_list_bookmarks">查看orderby排序参数</a><input class="widefat" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" type="text" value="<?php echo $orderby; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
    <?php
    }
}
add_action('widgets_init', 'bigfa_widget12_init');
function bigfa_widget12_init() {
    register_widget('bigfa_widget12');
}


?>
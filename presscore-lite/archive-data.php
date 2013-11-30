<?php get_header() ;?>

                <div id="container">
<div class="content-header content-header-data">
<h1 class="yahei">
<a href="http://www.ifanr.com/data/">数字</a>
</h1>
</div>

<div class="main main-data">
<?php
            while (have_posts()) : the_post();
                ?>
<a id="post-<?php echo $post->ID;?>" class="post-<?php echo $post->ID;?> data entry-common entry-list clearfix" href="<?php the_permalink() ?>">
<div class="entry-content">
<div class="entry-data-list-items">
<div class="widget-data-item clearfix">
<span class="widget-data-num num"><?php $key="data-num"; echo get_post_meta($post->ID, $key, true); ?></span>
<span class="widget-data-percent yahei"><?php $key="data-percent"; echo get_post_meta($post->ID, $key, true); ?></span>
<span class="widget-data-text"><?php $key="data-text"; echo get_post_meta($post->ID, $key, true); ?></span>
</div>
</div></div>
</a>
<?php endwhile;?>
</div>

            <div class="content-page">
                <?php par_pagenavi(6); ?>
            </div>
</div>

<?php get_footer() ;?>
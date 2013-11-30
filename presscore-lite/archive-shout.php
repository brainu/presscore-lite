<?php get_header() ;?>

                <div id="container">
<div class="content-header content-header-shout">
<h1 class="yahei">
<a href="http://fatesinger.com/shout">呐喊</a>
</h1>
</div>

<div class="main main-shout">
<?php
            while (have_posts()) : the_post();
                ?>
<div id="post-<?php echo $post->ID;?>" class="post-<?php echo $post->ID;?> shout entry-common entry-list clearfix">
<a href="<?php the_permalink() ?>">
<div class="shout_content clearfix">
<blockquote>
<span><?php $key="shout-text"; echo get_post_meta($post->ID, $key, true); ?></span>
</blockquote>
<div class="shout_original t-r">
<span>—— <?php $key="shout-author"; echo get_post_meta($post->ID, $key, true); ?></span>
</div>
</div>
</a>
</div>				
<?php endwhile;?>
</div>

            <div class="content-page">
                <?php par_pagenavi(6); ?>
            </div>
</div>

<?php get_footer() ;?>
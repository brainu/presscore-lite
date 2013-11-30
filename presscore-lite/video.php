<?php
/*
Template Name: 视频收藏
*/

get_header() ;?>
<div id="container">
    <div id="fullcontent" role="main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <header class="entry-header">
                <h2 class="entry-name" itemprop="headline"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark">
                        <?php the_title(); ?>
                    </a></h2>
            </header>

        <?php if (function_exists('the_youku')): ?>
            <?php the_youku(); ?>
        <?php endif; ?>
            <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/video.js?ver=201"></script>


        <?php endwhile; endif;?>
    </div>

</div>
<?php get_footer() ;?>

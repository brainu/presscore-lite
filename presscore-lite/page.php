<?php get_header() ;?>

<div id="container">
    <div id="content" role="main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="<?php echo $post->ID?>" class="entry-common" itemtype="http://schema.org/Article" itemscope="itemscope" data-id="<?php echo $post->ID?>">
                <meta itemprop="inLanguage" content="zh-CN">
                <header class="entry-header">
                    <h2 class="entry-name" itemprop="headline"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark">
                            <?php the_title(); ?>
                        </a></h2>
                </header>
                <!--.postMeta-->
                <div class="entry-content">
                    <?php the_content(); ?>
                    <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
                </div>
            </article>
            <div class="donate"> <a class="cbtn-donate" target="_blank" href="https://me.alipay.com/bigfa">捐 赠</a> 如果您觉得该篇文章对您有帮助，欢迎捐助我一片Durex~ </div>
            <div class="clear"></div>
            <?php comments_template( '', true ); ?>
        <?php endwhile; endif;?>
    </div>
    <?php get_sidebar() ;?>
</div>
<?php get_footer() ;?>

<?php get_header() ;?>
    <div id="container">
        <div id="content" role="main">
            <?php if ( have_posts() ) : ?>
                <?php
                /* Queue the first post, that way we know
                 * what author we're dealing with (if that is the case).
                 *
                 * We reset this later so we can run the loop
                 * properly with a call to rewind_posts().
                 */
                the_post();
                ?>
                <div class="author-profile">
                    <div class="clear"></div>
                    <div class="autho-profi-face">
                        <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentytwelve_author_bio_avatar_size', 50 ) ); ?>
                    </div>
                    <div class="author-profile-text">
                        <h2> <a href="https://plus.google.com/100716597011672341308?rel=author" rel="author"><?php echo get_the_author(); ?></a> </h2>
                        <?php
                        /* Since we called the_post() above, we need to
                         * rewind the loop back to the beginning that way
                         * we can run the loop properly, in full.
                         */
                        rewind_posts();
                        ?>
                        <p>
                            <?php the_author_meta( 'description' ); ?>
                        </p>
                    </div>
                    <div class="author-profile-list">
                        <?php if( get_the_author_meta( 'sinaweibo' )) {?><a target="_blank" href="<?php echo the_author_meta( 'sinaweibo' ) ?>" rel="external">微博</a><?php } ?>
                        <?php if( get_the_author_meta( 'zhihu' )) {?><a target="_blank" href="<?php echo the_author_meta( 'zhihu' ) ?>" rel="external">知乎</a><?php } ?>
                        <?php if( get_the_author_meta( 'taobao' )) {?><a target="_blank" href="<?php echo the_author_meta( 'taobao' ) ?>" rel="external">淘宝</a><?php } ?>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php query_posts( $query_string );while (have_posts()) : the_post(); ?>
                    <article id="<?php echo $post->ID?>" class="entry-common clearfix" itemtype="http://schema.org/Article" itemscope="itemscope" data-id="<?php echo $post->ID?>">
                        <meta itemprop="inLanguage" content="zh-CN">
                        <header class="entry-header">
                            <div class="pre-cat">
                                <div class="pre-catinner">
                                    <?php the_category(', ') ?>
                                </div>
                                <div class="pre-catarrow"></div>
                            </div>
                            <h2 class="entry-name" itemprop="headline"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark">
                                    <?php the_title(); ?>
                                </a></h2>
                            <div class="entry-commentnumber"> <span class="number">
          <?php comments_number('0', '1', '%'); ?>
          </span> <span class="corner"></span> </div>
                        </header>
                        <div class="entry-meta">
                            <?php the_time('d,m,Y')?>
                            | <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                                <?php the_author(); ?>
                            </a> |
                            <?php if(function_exists('the_views')) {the_views();} ?>
                        </div>
                        <!--.postMeta-->
                        <div class="entry-content category-content">
                            <p class="post-thumb"> <a class="thumb" rel="external" href="<?php the_permalink() ?>">
                                    <?php post_thumbnail( 200,140 ); ?>
                                </a> <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 300,"……"); ?> </p>
                        </div>
                    </article>
                <?php endwhile; endif;?>
            <div class="content-page">
                <?php par_pagenavi(6); ?>
            </div>
        </div>
        <?php get_sidebar() ;?>
    </div>
<?php get_footer() ;?>
<?php get_header() ;?>
<?php if ( bools('d_recommend_list_b')&&!wp_is_mobile()){ ?>
    <div id="recommend-wrap" class="fullwidth clearfix">
        <div id="recommend-post" class="clearfix recommend-post">
            <ul class="slides clearfix">
                <?php query_posts( $query_string . 'orderby=rand&showposts=8' );while(have_posts()) : the_post(); ?>
                    <li class="ifanr-recommend-item"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"> <span class="ifanr-recommend-title">
    <?php the_title(); ?>
    </span><?php post_thumbnail( 220,130 ); ?></a></li>
                <?php endwhile;wp_reset_query() ?>
            </ul>
        </div>
    </div>
<?php } ?>
    <div id="container">
        <div id="content" role="main">
		  <?php if(bools('d_index_shout')) {?>
  <?php query_posts( $query_string . 'post_type=shout&showposts=1' );while (have_posts()) : the_post(); ?>
            <div id="dasheng-index" class="entry-common entry-dasheng clearfix">
<a class="yahei entry-shout-title" href="<?php bloginfo('url');?>/shout">呐喊</a>
<a class="entry-dasheng-inner clearfix" title="点击查看解读全文 » " href="<?php the_permalink() ?>" rel="external" target="_blank">
<div class="dasheng_content clearfix">
<blockquote>
<span><?php $key="shout-text"; echo get_post_meta($post->ID, $key, true); ?></span>
</blockquote>
<div class="dasheng_original t-r">
<span>—— <?php $key="shout-author"; echo get_post_meta($post->ID, $key, true); ?></span>
</div>
</div>
<div class="dasheng_comment clearfix">
<p>
<span class="bold">《<?php the_title();?>》：</span>
<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 100,"……"); ?>
</p>
</div>
</a>
</div>
            <?php endwhile;wp_reset_query(); ?>
			<?php } ?>
            <?php
            while (have_posts()) : the_post();
                ?>
                <?php if( has_post_format( 'status' )) { // 单张图片样式?>
                    <article id="<?php echo $post->ID?>" class="JS_index_live entry-common entry-live clearfix"> <a class="live-post-inner clearfix" href="<?php the_permalink() ?>" rel="external"> <span class="live-post-cat">状态</span> <span class="live-post-img"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentytwelve_author_bio_avatar_size', 80 ) ); ?></span>
                            <div class="live-post-entry">
                                <p class="live-post-excerpt"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 240,"……"); ?></p>
                            </div>
                        </a> </article>
                <?php } else if ( has_post_format( 'aside' )) { // 单张图片样式?>
                    <div id="<?php echo $post->ID?>" class="dasheng-index entry-dasheng entry-common clearfix"> <span class="entry-dasheng-title">文摘</span> <a class="entry-dasheng-inner clearfix" title="点击查看解读全文 » " href="<?php the_permalink() ?>" rel="external">
                            <div class="dasheng_content clearfix">
                                <blockquote> <span>
          <?php the_title(); ?>
          </span> </blockquote>
                                <div class="dasheng_original t-r"> <span>——
                                        <?php the_author(); ?>
                                        In
                                        <?php bloginfo('name');?>
          </span> </div>
                            </div>
                            <div class="dasheng_comment clearfix">
                                <p> <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 240,"……"); ?></p>
                            </div>
                        </a> </div>
                <?php } else{ // 普通的?>
                    <article class="entry-common clearfix" data-id="<?php echo $post->ID?>">
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
                            <?php if ( comments_open() ) : ?>
                                <div class="entry-commentnumber"> <span class="number">
          <?php comments_number('0', '1', '%'); ?>
          </span> <span class="corner"></span> </div>
                            <?php endif; // comments_open() ?>
                        </header>
                        <address class="entry-meta"><span itemprop="datePublished">
      <?php past_date() ?></span>
                            | <span itemprop="author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                                    <?php the_author(); ?>
                                </a></span> |
                            <span itemprop="interactionCount"><?php if(function_exists('the_views')) {the_views();} ?></span>
                        </address>
                        <!--.postMeta-->


                        <?php if ( bools('d_thum_post_b') && ! wp_is_mobile() ) : ?>
                            <div class="entry-content category-content">
                                <p class="post-thumb"> <a class="thumb" rel="external" href="<?php the_permalink() ?>">
                                        <?php post_thumbnail( 200,140 ); ?>
                                    </a> <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 300,"……"); ?> </p>
                            </div>
                        <?php else : ?>
                            <div class="entry-content" itemprop="description">
                                <?php
                                $pc=$post->post_content;
                                $st=strip_tags(apply_filters('the_content',$pc));
                                if(preg_match('/<!--more.*?-->/',$pc))
                                    the_content('Read more &raquo;');
                                elseif(function_exists('mb_strimwidth'))
                                    echo mb_strimwidth($st,0,380,' ...');
                                else
                                    the_content();
                                ?></div>
                        <?php endif; ?>
                    </article>
                <?php }  ?>
            <?php endwhile;wp_reset_query(); ?>
            <div class="content-page">
                <?php par_pagenavi(6); ?>
            </div>
        </div>
        <?php get_sidebar() ;?>
    </div>
<?php get_footer() ;?>
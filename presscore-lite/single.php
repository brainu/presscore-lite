<?php get_header();?>
<?php if ( 'data' == get_post_type() ) { ?>
<?php include_once('include/data-content.php')?>
<?php } elseif ( 'shout' == get_post_type() ) {?>
<?php include_once('include/shout-content.php')?>
<?php } else { ?>
    <div id="container">
        <div id="content" role="main">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article id="<?php echo $post->ID?>" class="entry-common" itemtype="http://schema.org/Article" itemscope="itemscope" data-id="<?php echo $post->ID?>">
                    <meta itemprop="inLanguage" content="zh-CN">
                    <div id="crumb" itemprop="breadcrumb"><a rel="nofollow" href="<?php bloginfo('url');?>">Home</a>&nbsp;>&nbsp;<?php the_category(', ');?>&nbsp;>&nbsp;<?php the_title(); ?></div>
                    <header class="entry-header">
                        <div class="pre-cat">
                            <div class="pre-catinner">
                                <?php the_category(', ') ?>
                            </div>
                            <div class="pre-catarrow"></div>
                        </div>
                        <h2 class="entry-name" itemprop="headline">
                            <?php the_title(); ?>
                        </h2>
                        <?php if ( comments_open() ) : ?>
                            <div class="entry-commentnumber"> <span class="number">
          <?php comments_number('0', '1', '%'); ?>
          </span> <span class="corner"></span> </div>
                        <?php endif; // comments_open() ?>
                    </header>
                    <div class="entry-meta">
      <span itemprop="datePublished">
      <?php past_date() ?>
      </span> | <span itemprop="author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                                <?php the_author(); ?>
                            </a></span> | <span itemprop="interactionCount">
      <?php if(function_exists('the_views')) {the_views();} ?>
      </span>
                    </div>
                    <!--.postMeta-->

                    <div class="entry-content" itemprop="description">


                        <?php the_content(); ?>
                        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
                    </div>
                </article>
                <?php if ( bools('d_related_post_b')){ ?>
                    <?php presscore_relatedpost();?>
                <?php } ?>
                <?php if ( get_the_tags() ) { the_tags('<div class="entry-meta-tags">标签：', '', '</div>'); } else{ echo "本文暂无标签";  } ?>
                <div class="clear"></div>
                <?php if ( bools('d_author_b') && !wp_is_mobile()){ ?>
                    <div class="author-profile">
                        <div class="clear"></div>
                        <div class="autho-profi-face">
                            <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentytwelve_author_bio_avatar_size', 50 ) ); ?>
                        </div>
                        <div class="author-profile-text">
                            <h2> <a href="<?php echo bools('d_google_plus')?>" rel="author"><?php echo get_the_author() ; ?></a> </h2>
                            <p>
                                <?php the_author_meta( 'description' ); ?>
                            </p>
                        </div>
                        <?php if ( bools('d_qrcode_b')){ ?>
                            <div class="author-profile-qrcode">
                                <img width="50" height="50" alt="qrcode" src="<?php echo bools('d_qrcode')?>">
                                <div class="dropdown-area"><span class="top-padding"></span>
                                    <dl>
                                        <dd class="t-c"> <a href="javascript:;">扫描关注<?php bloginfo('name');?></a> </dd>
                                        <dt> <a class="ab-item" href="#" tabindex="-1"> <img class="avatar avatar-64 photo" width="220" height="220px" src="<?php echo bools('d_qrcode')?>" alt=""> </a> </dt>
                                    </dl>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="author-profile-list">
                            <?php if( get_the_author_meta( 'sinaweibo' )) {?><a target="_blank" href="<?php echo the_author_meta( 'sinaweibo' ) ?>" rel="external">微博</a><?php } ?>
                            <?php if( get_the_author_meta( 'zhihu' )) {?><a target="_blank" href="<?php echo the_author_meta( 'zhihu' ) ?>" rel="external">知乎</a><?php } ?>
                            <?php if( get_the_author_meta( 'taobao' )) {?><a target="_blank" href="<?php echo the_author_meta( 'taobao' ) ?>" rel="external">淘宝</a><?php } ?>
                            <?php if( get_the_author_meta( 'wangyi' )) {?><a target="_blank" href="<?php echo the_author_meta( 'wangyi' ) ?>" rel="external">网易云阅读</a><?php } ?>
                            <?php if( get_the_author_meta( 'instagram' )) {?><a target="_blank" href="<?php echo the_author_meta( 'instagram' ) ?>" rel="external">Instagram</a><?php } ?>
                            <div id="likebtn" class="bdlikebutton"></div>
                            <div id="share" class="share "> <a id="share-weibo" title="分享到新浪微博" href="javascript:;"></a> <a id="share-tx" title="分享到腾讯微博" href="javascript:;"></a> <a id="share-qq" title="分享到QQ空间" href="javascript:;"></a> <a id="share-douban" title="分享到豆瓣" href="javascript:;"></a> <a id="share-renren" title="分享到人人网" href="javascript:;"></a> </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>

                <nav class="single-nav"> <span class="left">
      <?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'presscore' ) . '</span> %title' ); ?>
      </span> <span class="right">
      <?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'presscore' ) . '</span>' ); ?>
      </span> </nav>
                <div class="clear"></div>
                <?php comments_template( '', true ); ?>
            <?php endwhile; endif;?>
        </div>
        <?php get_sidebar() ;?>
    </div>
<?php } ?>		
<?php get_footer() ;?>
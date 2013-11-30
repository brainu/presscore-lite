<?php get_header(); ?>
<div id="container">
  <div id="content" role="main">
    <?php if ( have_posts() ) : ?>
    <div class="content-cat">
      <h1>
        <?php 
/* Search Count */ 
$allsearch = &new WP_Query("s=$s&showposts=-1"); 
$key = wp_specialchars($s, 1); 
$count = $allsearch->post_count; _e(''); 
_e('<span class="search-terms">'); 
echo $key; _e('</span>的搜索结果'); _e(' — '); 
echo $count . ' '; _e('篇文章'); 

wp_reset_query(); ?>
      </h1>
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
      <address class="entry-meta">
      <?php the_time('d,m,Y')?>
      | <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
      <?php the_author(); ?>
      </a> |
      <?php if(function_exists('the_views')) {the_views();} ?>
      </address>
      <!--.postMeta-->
      <div class="entry-content category-content">
        <p class="post-thumb"> <a class="thumb" rel="external" href="<?php the_permalink() ?>">
          <?php post_thumbnail( 200,140 ); ?>
          </a> <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 300,"……"); ?> </p>
      </div>
    </article>
    <?php endwhile;?>
    <div class="content-page">
      <?php par_pagenavi(6); ?>
    </div>
	<?php else : ?>
	<article id="post-0" class="entry-common clearfix" itemtype="http://schema.org/Article" itemscope="itemscope" data-id="<?php echo $post->ID?>">
				<header class="entry-header">
				<h2 class="entry-name" itemprop="headline">
          <?php _e( 'Nothing Found', 'twentytwelve' ); ?>
          </h2>
					
				</header>

				<div class="entry-content">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentytwelve' ); ?></p>
					<img src="<?php echo get_template_directory_uri(); ?>/img/no-result.jpg" alt="no result" class="aligncenter no-border">
				</div><!-- .entry-content -->
			</article>
	<?php endif; ?>
  </div>
  <?php get_sidebar() ;?>
</div>
<?php get_footer();?>
<?php 
/*
Template Name: 归档模板
*/
get_header(); 
?>

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
      <div class="archives">
		<?php
        $previous_year = $year = 0;
        $previous_month = $month = 0;
        $ul_open = false;
         
        $myposts = get_posts('numberposts=-1&orderby=post_date&order=DESC');
        
        foreach($myposts as $post) :
            setup_postdata($post);
         
            $year = mysql2date('Y', $post->post_date);
            $month = mysql2date('n', $post->post_date);
            $day = mysql2date('j', $post->post_date);
            
            if($year != $previous_year || $month != $previous_month) :
                if($ul_open == true) : 
                    echo '</table>';
                endif;
         
                echo '<h4>'; echo the_time('F Y'); echo '</h4>';
                echo '<table>';
                $ul_open = true;
         
            endif;
         
            $previous_year = $year; $previous_month = $month;
        ?>
            <tr>
                <td width="40" style="text-align:right;"><?php the_time('j'); ?>日</td>
                <td width=""><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
               
            </tr>
        <?php endforeach; ?>
        </table>
    </div>
    </article>
    <div class="donate"> <a class="cbtn-donate" target="_blank" href="https://me.alipay.com/bigfa">捐 赠</a> 如果您觉得该篇文章对您有帮助，欢迎捐助我一片Durex~ </div>
    <div class="clear"></div>
    <?php endwhile; endif;?>
  </div>
<?php get_sidebar();?> 
</div>
<?php get_footer() ;?>

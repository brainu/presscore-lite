<footer id="footer" class="clearfix">

    Copyright <?php bloginfo('name');?> | Theme By <a class="copyright" href="http://fatesinger.com" title="Bigfa In Fatesinger">Bigfa</a>

</footer>
</div>

<a class="link-back2top" title="Back to top" href="#"></a>

<?php wp_footer(); ?>
<div class="statistic">
    <?php if( bools('d_track_b') != '' ) echo bools('d_track'); ?>
</div>
<script>
    var is_home="<?php if(is_home()){echo 'true';}?>";
    var comments_open="<?php if(comments_open()){echo 'true';}?>";
    var home_url="<?php echo esc_url(home_url('/')); ?>";
    var is_mobile="<?php if(wp_is_mobile()){echo 'true';}?>";
    <?php if ( is_singular() ){ ?>
    var fspostid ="<?php echo $post->ID?>";
    var fsajaxurl ="<?php bloginfo('url');?>";
    <?php } ?>
</script>
<?php if ( is_singular() ){ ?>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/single.js?ver=201"></script>
<?php } ?>


<script src="<?php bloginfo('stylesheet_directory'); ?>/js/global.js?20130801"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.flexslider-min.js?20130801"></script>
</body></html>
<div id="sidebar" role="complementary">
    <?php if ( is_home() ){ ?>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Main Sidebar') ) : ?><?php endif; ?>
    <?php } else {?>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('First Front Page Widget Area') ) : ?><?php endif; ?>
    <?php } ?>
</div>
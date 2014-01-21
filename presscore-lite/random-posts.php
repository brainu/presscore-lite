<?php if ( bools('d_recommend_list_b')&&!wp_is_mobile()){ ?>
    <div id="recommend-wrap" class="fullwidth clearfix">
        <div id="recommend-post" class="clearfix recommend-post">
            <ul class="slides clearfix">
                <?php
                $args = array( 'posts_per_page' => 8 , 'orderby' => 'rand' );
                $myposts = get_posts( $args );
                foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
                    <li class="ifanr-recommend-item"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"> <span class="ifanr-recommend-title">
    <?php the_title(); ?>
    </span><?php post_thumbnail( 220,130 ); ?></a></li>
                <?php endforeach;
                wp_reset_postdata();?>

            </ul>
        </div>
    </div>
<?php } ?>
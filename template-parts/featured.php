
<?php

$philosophy_fp = new WP_Query( array(
    'meta_key' => 'featured',
    'meta_value' => '1',
    'posts_per_page' => '3'
) );

$post_data = array();
while( $philosophy_fp -> have_posts() ){
    $philosophy_fp -> the_post();
    $categoties = get_the_category();
    $post_data[] = array(
        'post_title' => get_the_title(),
        'post_thumbnail' => get_the_post_thumbnail_url( get_the_ID(), "large" ),
        'post_author' => get_the_author_meta( 'display_name' ),
        'post_author_avatar' => get_avatar_url( get_the_author_meta( "ID" ) ),
        'post_date' => get_the_date(),
        'post_cat' => $categoties[ mt_rand( 0, count($categoties) - 1 ) ] -> name,
    );
}

?>
<?php if( $philosophy_fp -> post_count > 1 ) : ?>
<div class="pageheader-content row">
    <div class="col-full">

        <div class="featured">

            <div class="featured__column featured__column--big">
                <div class="entry" style="background-image:url('<?php echo esc_attr( $post_data[0]['post_thumbnail'] ); ?>">
                    
                    <div class="entry__content">
                        <span class="entry__category"><a href="#0"><?php echo esc_html( $post_data[0]['post_cat'] ); ?></a></span>

                        <h1>
                            <a href="#0" title="">
                            <?php echo esc_html( $post_data[0]['post_title'] ); ?>
                            </a>
                        </h1>

                        <div class="entry__info">
                            <a href="#0" class="entry__profile-pic">
                                <img class="avatar" src="<?php echo esc_attr( $post_data[0]['post_author_avatar'] ); ?>" alt="">
                            </a>

                            <ul class="entry__meta">
                                <li><a href="#0"><?php echo esc_attr( $post_data[0]['post_author'] ); ?></a></li>
                                <li><?php echo esc_html( $post_data[0]['post_date'] ); ?></li>
                            </ul>
                        </div>
                    </div> <!-- end entry__content -->
                    
                </div> <!-- end entry -->
            </div> <!-- end featured__big -->

            <div class="featured__column featured__column--small">

                <?php for ($i=1; $i<3 ; $i++) { ?>

                    <div class="entry" style="background-image:url('<?php echo esc_attr( $post_data[$i]['post_thumbnail'] ); ?>">
                        
                        <div class="entry__content">
                            <span class="entry__category"><a href="#0"><?php echo esc_html( $post_data[$i]['post_cat'] ); ?></a></span>

                            <h1>
                                <a href="#0" title="">
                                <?php echo esc_html( $post_data[$i]['post_title'] ); ?>
                                </a>
                            </h1>

                            <div class="entry__info">
                                <a href="#0" class="entry__profile-pic">
                                    <img class="avatar" src="<?php echo esc_attr( $post_data[$i]['post_author_avatar'] ); ?>" alt="">
                                </a>

                                <ul class="entry__meta">
                                    <li><a href="#0"><?php echo esc_attr( $post_data[$i]['post_author'] ); ?></a></li>
                                    <li><?php echo esc_html( $post_data[$i]['post_date'] ); ?></li>
                                </ul>
                            </div>
                        </div> <!-- end entry__content -->
                        
                    </div> <!-- end entry -->
                <?php } ?>

            </div> <!-- end featured__small -->
        </div> <!-- end featured -->

    </div> <!-- end col-full -->
</div> <!-- end pageheader-content row -->

<?php endif; ?>
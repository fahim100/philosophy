<?php 
the_post();
get_header(); ?>

    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--narrow s-content--no-padding-bottom">

        <article class="row format-standard">

            <div class="s-content__header col-full">
                <h1 class="s-content__header-title">
                    <?php the_title(); ?>
                </h1>
                <ul class="s-content__header-meta">
                    <li class="date"><?php the_date(); ?></li>
                    <li class="cat">
                        <?php echo __( "In", "philosophy" ); ?>
                        <?php echo get_the_category_list(" "); ?>
                    </li>
                </ul>
            </div> <!-- end s-content__header -->
    
            <div class="s-content__media col-full">
                <div class="s-content__post-thumb">
                    <?php the_post_thumbnail( "large" ) ; ?>
                </div>
            </div> <!-- end s-content__media -->

            <div class="col-full s-content__main">

                <?php the_content(); ?>

                <p class="s-content__tags">
                    <span><?php echo __( "Post Tags", "philosophy" ); ?></span>

                    <span class="s-content__tag-list">
                        <?php echo get_the_tag_list(); ?>
                    </span>
                </p> <!-- end s-content__tags -->

                <div class="s-content__author">
                    <?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?>

                    <div class="s-content__author-about">
                        <h4 class="s-content__author-name">
                            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ); ?>"><?php the_author(); ?></a>
                        </h4>
                    
                        <p><?php echo get_the_author_meta('description'); ?></p>

                        <ul class="s-content__author-social">
                        <?php
                         $philosophy_user_facebook = get_field( "facebook", "user_".get_the_author_meta( "ID" ) ); 
                         $philosophy_user_twitter = get_field( "twitter", "user_".get_the_author_meta( "ID" ) ); 
                         $philosophy_user_instagram = get_field( "instagram", "user_".get_the_author_meta( "ID" ) ); 
                         ?>
                            <?php if( $philosophy_user_facebook ){ ?>
                                <li><a href="<?php echo esc_url( $philosophy_user_facebook ); ?>">Facebook</a></li>
                            <?php } ?>
                            <?php if( $philosophy_user_twitter ){ ?>
                                <li><a href="<?php echo esc_url( $philosophy_user_twitter ); ?>">Twitter</a></li>
                            <?php } ?>
                            <?php if( $philosophy_user_instagram ){ ?>
                                <li><a href="<?php echo esc_url( $philosophy_user_instagram ); ?>">Instagram</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="s-content__pagenav">
                    <div class="s-content__nav">
                        <div class="s-content__prev">
                            <?php $philosophy_prev_post = get_previous_post();
                            if ( $philosophy_prev_post ) { ?>
                                <a href="<?php echo esc_url( get_the_permalink( $philosophy_prev_post ) ); ?>" rel="prev">
                                    <span><?php echo __( "Previous Post", "philosophy" ); ?></span>
                                    <?php echo esc_html( get_the_title( $philosophy_prev_post ) ); ?> 
                                </a>
                            <?php }; ?>
                        </div>
                        <div class="s-content__next">
                            <?php $philosophy_next_post = get_next_post();
                            if ( $philosophy_next_post ) { ?>
                                <a href="<?php echo esc_url( get_the_permalink( $philosophy_next_post ) ); ?>" rel="prev">
                                    <span><?php echo __( "Next Post", "philosophy" ); ?></span>
                                    <?php echo esc_html( get_the_title( $philosophy_next_post ) ); ?> 
                                </a>
                            <?php }; ?>
                        </div>
                    </div>
                </div> <!-- end s-content__pagenav -->

            </div> <!-- end s-content__main -->

        </article>


        <!-- comments
        ================================================== -->
        <?php if( !post_password_required() ); {
            comments_template();
        } ?>

    </section> <!-- s-content -->

<?php get_footer(); ?>
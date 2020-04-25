<?php 
/**
 *  Template Name: Contact Page
 */
the_post();
get_header(); 
?>

    <!-- s-content
    ================================================== -->

    <section class="s-content s-content--narrow">

        <div class="row">

            <div class="s-content__header col-full">
                <h1 class="s-content__header-title">
                    <?php the_title(); ?>
                </h1>
            </div> <!-- end s-content__header -->

            <div class="s-content__media col-full">
                <div id="map-wrap">
                <?php 
                    if ( is_active_sidebar("contact_map") ) {
                        dynamic_sidebar("contact_map");
                    }
                ?>
                </div> 
            </div> <!-- end s-content__media -->

            <div class="col-full s-content__main">

                <?php the_content(); ?>

                <div class="row block-1-2 block-tab-full">
                    <?php 
                    if ( is_active_sidebar("contact_info") ) {
                        dynamic_sidebar("contact_info");
                    }
                    ?>
                </div>


            </div> <!-- end s-content__main -->

            <h3><?php echo __( "Say hello", "philosophy" ); ?></h3>

            <form name="cForm" id="cForm" method="post" action="">
                <?php 
                if ( get_field( "contact_form_sortcode" ) ) {
                    echo do_shortcode( get_field( "contact_form_sortcode" ));
                }
                ?>
            </form> <!-- end form -->

        </div> <!-- end row -->

    </section> <!-- s-content -->

<?php get_footer(); ?>
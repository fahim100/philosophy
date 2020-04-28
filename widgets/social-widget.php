<?php
 
class My_Widget extends WP_Widget {
 
    function __construct() {
 
        parent::__construct(
            'demo-social-icon',  // Base ID
            'Demo:Social Icon'   // Name
        );
 
        add_action( 'widgets_init', function() {
            register_widget( 'My_Widget' );
        });
 
    }
 
    public $args = array(
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget'  => '</div></div>'
    );
 
    public function widget( $args, $instance ) {
        extract( $args );
        $social_icons = array(
            "facebook",
            "twitter",
            "github",
            "pinterest",
            "instagram",
            "google-plus",
            "youtube",
            "vimeo",
            "tumblr",
            "dribbble",
            "flickr",
            "behance"
        );
        $title        = apply_filters( 'widget_title', $instance['title'] );

        echo $before_widget;
        ?>
        <ul class="<?php echo $instance['classname'] ?>">
            <?php
            if ( $title ) {
                echo "<div class=\"widget-title\">";
                echo $before_title . esc_html( $title ) . $after_title;
                echo "</div>";
            }
            ?>
            <div class="social-link">
                <?php
                foreach ( $social_icons as $sci ) {
                    $url = trim( $instance[ $sci ] );
                    if ( ! empty( $url ) ) {
                        if ( $sci == "vimeo" ) {
                            $sci = "vimeo-square";
                        }
                        $sci = esc_attr( $sci );
                        echo "<li><a target='_blank' href='" . esc_attr( $url ) . "'><i class='fa fa-" . esc_attr( $sci ) . "'></i></a></li>";
                    }
                }
                ?>

            </div>
        </ul>
        <?php
        echo $after_widget;

    }
 
    public function form( $instance ) {
        if ( isset( $instance['title'] ) ) {
            $title = $instance['title'];
        } else {
            $title = __( 'Social Icons', 'philosophy' );
        }

        $classname = '';
        if ( isset( $instance['classname'] ) ) {
            $classname = $instance['classname'];
        }


        $social_icons = array(
            "facebook",
            "twitter",
            "github",
            "pinterest",
            "instagram",
            "google-plus",
            "youtube",
            "vimeo",
            "tumblr",
            "dribbble",
            "flickr",
            "behance"
        );
        foreach ( $social_icons as $sc ) {
            if ( ! isset( $instance[ $sc ] ) ) {
                $instance[ $sc ] = "";
            }
        }
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'philosophy' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $title ); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'classname' ) ); ?>"><?php _e( 'CSS Class name:', 'philosophy' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'classname' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'classname' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $classname ); ?>"/>
        </p>
        <?php foreach ( $social_icons as $sci ) {
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( $sci ) ; ?>"><?php echo esc_html( ucfirst( $sci ) . " " . __( 'URL', 'philosophy' ) ); ?>
                    : </label>
                <br/>

                <input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( $sci ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( $sci ) ); ?>"
                       value="<?php echo esc_attr( $instance[ $sci ] ); ?>"/>
            </p>

            <?php
        }
        ?>


        <?php
    }
 
    public function update( $new_instance, $old_instance ) {
        $instance                = array();
        $instance['title']       = strip_tags( $new_instance['title'] );
        $instance['classname']   = strip_tags( $new_instance['classname'] );
        $instance['facebook']    = strip_tags( $new_instance['facebook'] );
        $instance['twitter']     = strip_tags( $new_instance['twitter'] );
        $instance['github']      = strip_tags( $new_instance['github'] );
        $instance['pinterest']   = strip_tags( $new_instance['pinterest'] );
        $instance['instagram']   = strip_tags( $new_instance['instagram'] );
        $instance['google-plus'] = strip_tags( $new_instance['google-plus'] );
        $instance['youtube']     = strip_tags( $new_instance['youtube'] );
        $instance['vimeo']       = strip_tags( $new_instance['vimeo'] );
        $instance['tumblr']      = strip_tags( $new_instance['tumblr'] );
        $instance['dribbble']    = strip_tags( $new_instance['dribbble'] );
        $instance['flickr']      = strip_tags( $new_instance['flickr'] );
        $instance['behance']     = strip_tags( $new_instance['behance'] );

        return $instance;
    }
 
}
$my_widget = new My_Widget();
?>
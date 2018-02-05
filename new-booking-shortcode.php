<?php
/*
Plugin Name: New Booking shortcode
Plugin URI: http://github.com/giaba90
Description: Nuovo shortcode per mostrare il booking
Version: 1.0
Author: Gianluca Barranca
Author URI: http://www.gianlucabarranca.it
License: GPL2
*/
?>
<?php

add_action('init','override_shortcode_booking');
function override_shortcode_booking() {
    remove_shortcode('reservationform');
    add_shortcode('reservationform', 'gb_reservationform');
}
//add js

add_action('wp_enqueue_scripts','gb_add_js',20);

function gb_add_js(){
    wp_enqueue_script( 'new-booking-shortcode', plugin_dir_url( __FILE__ ).'booking-init.js',array('jquery'), null, true );
}

//add css

add_action('wp_head','gb_add_css');

function gb_add_css(){
    ?>
<style type="text/css">

img#stella-marina {
    width: 15em;
    position: relative;
    float: right;
    top: 30px;
    z-index: 4;
    right: 28px;
}
.fa-calendar-o::before{
    color:#52c5cb ;
}

.btn.btn-primary.btn-block.book-now{
    background-color: #0993cc;
    border-color:  #0993cc;
}

.form-group{
    position: relative;
}

.form-group .bg-booking-append{
    display: inline-block;
    height: 42px;
    line-height: 29px;
    position: absolute;
    top: 16px;
    right: 0;
    margin: 8px;
}

@media (min-width: 320px) and  (max-width: 768px) {

img#stella-marina {
    width: 15em;
    position: relative;
    float: right;
    top: -47px;
    z-index: 1;
    right: 28px;
}

}
</style>

    <?
}

// Shortcode: Reservationform horizontal
function gb_reservationform($atts)
{
    // Code
    extract(shortcode_atts(
            array(
                'orientation' => 'horizontal',
            )
            , $atts)
    );
    ob_start();
    if (strpos($orientation, 'horizontal') !== false) {
        ?>
        <!-- Reservation form -->
        <div id="reservation-form">
            <div class="row mt50">
                <img src="http://www.residenceilborgo.it/wp-content/uploads/2018/02/stelle-marine.png" id="stella-marina">
                <div class="col-md-12">
                    <form class="form-inline reservation-horizontal clearfix" role="form" method="post"
                    <?php if (true == ($GLOBALS['sh_redux']['opt-switch-method'])) { ?>
                        action=""
                    <?php }
                        else { ?>
                        action="<?php echo esc_url(get_template_directory_uri())?>/inc/smtp/reservation.php"
                        <?php }
                    ?> name="reservationform" id="reservationform">
                        <!-- Error message -->
                        <div id="message"></div>
                        <div class="row">
                            <div class="<?php if (true == ($GLOBALS['sh_redux']['switch-phone-form'])) { ?>col-sm-2"<?php } else { ?>col-sm-2"<?php } ?>">
                                <div class="form-group">
                                    <label for="email" accesskey="E"><?php esc_html_e('E-mail', 'new-booking-shortcode'); ?></label>

                                    <input name="email" type="text" id="email" value="" class="form-control"
                                           placeholder=""/>
                                </div>
                            </div>
                            <?php if (true == ($GLOBALS['sh_redux']['switch-phone-form'])) { ?>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="phone" accesskey="P"><?php esc_html_e('Phone', 'new-booking-shortcode'); ?></label>
                                    <?php if (true == ($GLOBALS['sh_redux']['reservation-hint-phone'])) {
                                        ?>
                                        <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="<?php esc_html_e('Please add your country code' , 'new-booking-shortcode' );?>"><i class="fa fa-info-circle fa-lg"> </i></div>
                                    <?php } ?>
                                    <input name="phone" type="text" id="phone" value="" class="form-control" placeholder="<?php _e('Your phone number', 'new-booking-shortcode'); ?>"/>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="<?php if (true == ($GLOBALS['sh_redux']['switch-phone-form'])) { ?>col-sm-1"<?php } else { ?>col-sm-2"<?php } ?>">
                                <div class="form-group">
                                    <label for="room"><?php esc_html_e('Room Type', 'new-booking-shortcode'); ?></label>
                                    <select class="form-control" name="room" id="room">
                                        <option selected="selected" disabled="disabled"><?php esc_html_e('Select a room', 'new-booking-shortcode'); ?></option>
                                            <option value="1">Bilo</option>
                                            <option value="1">Trilo</option>
                                            <option value="1">Quadri</option>

                                    </select>

                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="checkin"><?php esc_html_e('Check-in', 'new-booking-shortcode'); ?></label>

                                    <input name="checkin" type="text" id="checkin" value="" class="form-control"
                                           placeholder=""/>
                                           <span class="bg-booking-append fa fa-calendar-o" style="z-index: 4"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="checkout"><?php esc_html_e('Check-out', 'new-booking-shortcode'); ?></label>
                                    <input name="checkout" type="text" id="checkout" value="" class="form-control"
                                           placeholder=""/>
                                           <span class="bg-booking-append fa fa-calendar-o" style="z-index: 4"></span>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <!--div class="guests-select"-->
                                        <!--label><?php esc_html_e('Guests', 'new-booking-shortcode'); ?></label>
                                        <i class="fa fa-user infield"></i>

                                        <div class="total form-control" id="test">1</div-->

                                            <!--div class="form-group adults"-->
                                                <label for="adults"><?php esc_html_e('Adults', 'new-booking-shortcode'); ?></label>
                                                <select name="adults" id="adults" class="form-control">
                                                    <?php
                                                    $xa = 1;
                                                    $xamax = 4;
                                                    while ($xa <= $xamax) {
                                                        echo "<option value='$xa'>" . $xa . "</option>";
                                                        $xa++;
                                                    }
                                                    ?>
                                                </select>
                                            <!--/div-->
                                            <!--div class="form-group children"-->

                                            <!--/div-->
                                            <!--button type="button" class="btn btn-ghost-color button-save btn-block"><?php esc_html_e('Save', 'new-booking-shortcode'); ?></button-->

                                    <!--/div--><!-- fine guest selector -->
                                </div>
                            </div>
                               <div class="col-sm-1">
                                <div class="form-group">
                                     <label for="children"><?php esc_html_e('Children', 'new-booking-shortcode'); ?></label>

                                                <select name="children" id="children" class="form-control">
                                                    <?php
                                                    $xc = 0;
                                                    $xcmax = 4;
                                                    while ($xc <= $xcmax) {
                                                        echo "<option value='$xc'>" . $xc . "</option>";
                                                        $xc++;
                                                    }
                                                    ?>
                                                </select>
                                </div></div>
                            <div class="col-sm-2">
                                <button class="btn btn-primary btn-block book-now" id="book-now"><?php esc_html_e('Book Now', 'new-booking-shortcode'); ?></button>
                            </div>
                        </div>
                         <div style="margin-top: 24px">
                        <input type="checkbox" id="privacy" name="privacy"  checked>
                        <label for="privacy">Autorizzo il trattamento dei miei dati personali ai sensi del Decreto Legislativo 30 giugno 2003. (Privacy policy)</label>
                    </div>
                    </form>

                </div>
            </div>
        </div>

    <?php
    }
    if (strpos($orientation, 'vertical') !== false) {
        ?>
        <!-- Reservation form -->
        <div class="mt50">
            <div id="reservation-form" class="mt50 clearfix">
                <div class="row col-sm-12">
                    <form class="reservation-vertical clearfix" role="form" method="post"
                    <?php if (true == ($GLOBALS['sh_redux']['opt-switch-method'])) { ?>
                        action="<?php echo esc_url(get_template_directory_uri())?>/inc/sendmail/reservation.php"
                    <?php }
                        else { ?>
                        action="<?php echo esc_url(get_template_directory_uri())?>/inc/smtp/reservation.php"
                        <?php }
                    ?> name="reservationform" id="reservationform">

                        <h2 class="lined-heading"><span><?php esc_html_e('Reservation', 'new-booking-shortcode'); ?></span></h2>

                        <!-- Error message -->
                        <div id="message"></div>
                        <div class="form-group">
                            <label for="email" accesskey="E"><?php esc_html_e('E-mail', 'new-booking-shortcode'); ?></label>
                            <?php if (true == ($GLOBALS['sh_redux']['reservation-hint-mail'])) {
                                ?>
                                <div class="popover-icon" data-container="body" data-toggle="popover"
                                     data-trigger="hover" data-placement="right"
                                     data-content="<?php esc_attr_e('Please fill in your email', 'new-booking-shortcode'); ?>"><i
                                        class="fa fa-info-circle fa-lg"> </i></div>
                            <?php } ?>
                            <input name="email" type="text" id="email" value="" class="form-control"
                                   placeholder="<?php esc_attr_e('Please enter your E-mail', 'new-booking-shortcode'); ?>"/>
                        </div>
                            <?php if (true == ($GLOBALS['sh_redux']['switch-phone-form'])) { ?>
                                <div class="form-group">
                                    <label for="phone" accesskey="P"><?php esc_html_e('Phone', 'new-booking-shortcode'); ?></label>
                                    <?php if (true == ($GLOBALS['sh_redux']['reservation-hint-phone'])) {
                                        ?>
                                        <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="<?php esc_html_e('Please add your country code' , 'new-booking-shortcode' );?>"><i class="fa fa-info-circle fa-lg"> </i></div>
                                    <?php } ?>
                                    <input name="phone" type="text" id="phone" value="" class="form-control" placeholder="<?php _e('Your phone number', 'new-booking-shortcode'); ?>"/>
                                </div>
                            <?php } ?>
                        <div class="form-group">
                            <label for="room"><?php esc_html_e('Room Type', 'new-booking-shortcode'); ?></label>
                            <?php if (true == ($GLOBALS['sh_redux']['reservation-hint-room'])) {
                                ?>
                                <div class="popover-icon" data-container="body" data-toggle="popover"
                                     data-trigger="hover" data-placement="right"
                                     data-content="<?php esc_attr_e('Please select a room', 'new-booking-shortcode'); ?>"><i
                                        class="fa fa-info-circle fa-lg"> </i></div>
                            <?php } ?>
                                    <select class="form-control" name="room" id="room">
                                        <option selected="selected" disabled="disabled"><?php esc_html_e('Select a room', 'new-booking-shortcode'); ?></option>
                                        <?php if (true == ($GLOBALS['sh_redux']['switch-no-preference-form'])) { ?>
                                            <option value="<?php esc_html_e('No preference', 'new-booking-shortcode'); ?>"><?php esc_html_e('No preference', 'new-booking-shortcode'); ?></option>
                                        <?php } ?>
                                        <?php if ($GLOBALS['sh_redux']['opt-select-room-format'] == rooms) {
                                                // Room names in selectbox
                                                $args = array(
                                                    'post_type' => 'room',
                                                );
                                                $rooms = new WP_Query($args);
                                                if ($rooms->have_posts()) {
                                                    while ($rooms->have_posts()) {
                                                        $rooms->the_post();
                                                        ?>
                                                        <option value="<?php echo the_title(); ?>"><?php echo the_title(); ?></option>
                                                    <?php }
                                                }; } ?>
                                        <?php if ($GLOBALS['sh_redux']['opt-select-room-format'] == roomtypes) {
                                                // Roomtypes in selectbox
                                                $termsfilter = get_terms("roomtype");
                                                if (!empty($termsfilter) && !is_wp_error($termsfilter)) {
                                                    foreach ($termsfilter as $termfilter) {
                                                        echo "<option value='" . esc_attr($termfilter->name) . "'>" . esc_html($termfilter->name) . "</option>";
                                                    }
                                                };
                                                } ?>
                                    </select>
                        </div>
                      <div class="form-group">
                            <label for="checkin"><?php esc_html_e('Check-in', 'new-booking-shortcode'); ?></label>
                            <?php if (true == ($GLOBALS['sh_redux']['reservation-hint-checkin'])) {
                                ?>
                                <div class="popover-icon" data-container="body" data-toggle="popover"
                                     data-trigger="hover" data-placement="right"
                                     data-content="<?php esc_attr_e('Check-In is from 11:00', 'new-booking-shortcode'); ?>"><i
                                        class="fa fa-info-circle fa-lg"> </i></div>
                            <?php } ?>                                <i class="fa fa-calendar infield"></i>
                            <input name="checkin" type="text" id="checkin" value="" class="form-control"
                                   placeholder="<?php esc_attr_e('Check-in', 'new-booking-shortcode'); ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="checkout"><?php esc_html_e('Check-out', 'new-booking-shortcode'); ?></label>
                            <?php if (true == ($GLOBALS['sh_redux']['reservation-hint-checkout'])) {
                                ?>
                                <div class="popover-icon" data-container="body" data-toggle="popover"
                                     data-trigger="hover" data-placement="right"
                                     data-content="<?php esc_attr_e('Check-out is from 12:00', 'new-booking-shortcode'); ?>"><i
                                        class="fa fa-info-circle fa-lg"> </i></div>
                            <?php } ?>                                <i class="fa fa-calendar infield"></i>
                            <input name="checkout" type="text" id="checkout" value="" class="form-control"
                                   placeholder="<?php esc_attr_e('Check-out', 'new-booking-shortcode'); ?>"/>
                        </div>
                        <div class="form-group">
                            <div class="guests-select">
                                <label><?php esc_html_e('Guests', 'new-booking-shortcode'); ?></label>
                                <i class="fa fa-user infield"></i>
                                <div class="total form-control" id="test">1</div>
                                <div class="guests">
                                    <div class="form-group adults">
                                        <label for="adults"><?php esc_html_e('Adults', 'new-booking-shortcode'); ?></label>
                                        <?php if (true == ($GLOBALS['sh_redux']['reservation-hint-guests-adults'])) {
                                            ?>
                                            <div class="popover-icon" data-container="body" data-toggle="popover"
                                                 data-trigger="hover" data-placement="right"
                                                 data-content="<?php esc_attr_e('+18 years', 'new-booking-shortcode'); ?>"><i
                                                    class="fa fa-info-circle fa-lg"> </i></div>
                                        <?php } ?>
                                        <select name="adults" id="adults" class="form-control">
                                            <?php
                                            $xa = 1;
                                            $xamax = ($GLOBALS['sh_redux']['opt-select-max-adults']);
                                            while ($xa <= $xamax) {
                                                echo "<option value='$xa'>" . $xa . esc_html__(' Adult(s)', 'new-booking-shortcode') . "</option>";
                                                $xa++;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group children">
                                        <label for="children"><?php esc_html_e('Children', 'new-booking-shortcode'); ?></label>
                                        <?php if (true == ($GLOBALS['sh_redux']['reservation-hint-guests-children'])) {
                                            ?>
                                            <div class="popover-icon" data-container="body" data-toggle="popover"
                                                 data-trigger="hover" data-placement="right"
                                                 data-content="<?php esc_attr_e('0 till 18 years', 'new-booking-shortcode'); ?>"><i
                                                    class="fa fa-info-circle fa-lg"> </i></div>
                                        <?php } ?>                                            <select
                                            name="children" id="children" class="form-control">
                                            <?php
                                            $xc = 0;
                                            $xcmax = ($GLOBALS['sh_redux']['opt-select-max-children']);
                                            while ($xc <= $xcmax) {
                                                echo "<option value='$xc'>" . $xc . esc_html__(' Child(ren)', 'new-booking-shortcode') . "</option>";
                                                $xc++;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-ghost-color button-save btn-block"><?php esc_html_e('Save', 'new-booking-shortcode'); ?></button>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block"><?php esc_html_e('Book Now', 'new-booking-shortcode'); ?></button>
                </div>
                </form>
        </div>
        </div>
    <?php
    }
    return ob_get_clean();
};
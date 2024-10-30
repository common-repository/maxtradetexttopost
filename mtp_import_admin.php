<?php
    if($_POST['mtp_hidden'] == 'Y') {
        $mtp_where_to_show = sanitize_text_field($_POST['mtp_where_to_show']);
        if (($mtp_where_to_show == 'In the begining') || ($mtp_where_to_show == 'In the end')){
          update_option('mtp_where_to_show', $mtp_where_to_show);
        }

        $mtp_text_to_show = sanitize_text_field($_POST['mtp_text_to_show']);
        update_option('mtp_text_to_show', $mtp_text_to_show);

        $mtp_show_categories = sanitize_text_field($_POST['mtp_show_categories']);
        if (($mtp_show_categories == 'on') || ($mtp_show_categories == '')){
          update_option('mtp_show_categories', $mtp_show_categories);
        }
        if ($mtp_show_categories == 'on'){
            $mtp_show_categories = 1;
        }else{
            $mtp_show_categories = 0;
        }

?>

<div class="updated"><p><strong><?php _e('Options saved.', 'mtptextdomain' ); ?></strong></p></div>

<?php
    } else {
        $mtp_where_to_show = get_option('mtp_where_to_show');
        $mtp_text_to_show = get_option('mtp_text_to_show');
        if (get_option('mtp_show_categories') == 'on'){
            $mtp_show_categories = 1;
        }else{
            $mtp_show_categories = 0;
        }
    }
?>

<div class="wrap">
    <?php echo "<h2>" . __( 'MaxtradeTextToPost options page', 'mtptextdomain' ) . "</h2>"; ?>

    <form name="mtp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="mtp_hidden" value="Y">
        <?php echo "<h4>" . __( 'MaxtradeTextToPost text setting', 'mtptextdomain' ) . "</h4>"; ?>
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
          <tr>
            <td width="300px">
              <?php _e( 'Where in post to show text', 'mtptextdomain' ); ?>
            </td>
            <td>
              <select class="select" id="mtp_where_to_show" name="mtp_where_to_show">
                <option value="In the begining" <?php if( $mtp_where_to_show == 'In the begining' ) echo 'selected'; ?>><?php _e('In the begining', 'mtptextdomain' ); ?></option>
                <option value="In the end" <?php if( $mtp_where_to_show == 'In the end' ) echo 'selected'; ?>><?php _e('In the end', 'mtptextdomain' ); ?></option>
              </select>
            </td>
          </tr>
          <tr>
            <td width="300px">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="300px">
              <?php _e( 'Text to show in posts.', 'mtptextdomain' ); ?>
            </td>
            <td>
              <textarea name="mtp_text_to_show" rows="10" cols="90"><?php echo $mtp_text_to_show; ?></textarea>
            </td>
          </tr>
        </table>
        <hr />
        <?php echo "<h4>" . __( 'MaxtradeTextToPost pre-finished setting', 'mtptextdomain' ) . "</h4>"; ?>
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
          <tr>
            <td width="300px">
              <?php _e( 'Show hidden post categories structure.', 'mtptextdomain' ); ?><br />
              <?php _e( '(hidden div width content like this: category1 - category2 - category3 -)', 'mtptextdomain' ); ?>
            </td>
            <td>
		            <input type="checkbox" class="checkbox" id="mtp_show_categories" name="mtp_show_categories"<?php checked( $mtp_show_categories ); ?> />
            </td>
          </tr>
        </table>
        <hr />
        <p class="submit">
        <input type="submit" name="Submit" value="<?php _e('Update Options', 'mtptextdomain' ) ?>" />
        </p>
    </form>
</div>

<?php
if (!defined('ABSPATH')) {exit;}
?>

<h1><?php echo __("Web Form Integration",'gwci_td');?></h1>

<form action="options.php" method="post">
    <?php settings_fields( 'gcwi_group'); ?>
    <?php do_settings_sections( 'gcwi_group' ); ?>
<table>
    <tbody>

    <tr  height="70">
        <td><label for="fb_api"><?php echo __("Form code",'gwci_td');?></label> </td>
        <td><textarea rows="25" cols="100" name="webform-html"> <?php echo get_option( 'webform-html' ); ?></textarea></td>
    </tr>



    <tr>
        <td> <div class="col-sm-10"><?php submit_button(); ?></td>

    </tr>

    </tbody>
    </table>

</form>

<h3>Place this short code anywhere you want to show form</h3>
<h4>[webform]</h4>

<iframe width="560" height="315" src="https://www.youtube.com/embed/P8IfwFJew6U" frameborder="0" allowfullscreen></iframe>
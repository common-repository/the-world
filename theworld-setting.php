<?php
include_once("theworld-main.php");
function theworld_setting(){
  if( is_array($_POST['country']) )
    update_option( 'theworld_select', implode("|", $_POST['country']) );
  if( $_POST['has_been'] != null )
    update_option( 'theworld_Colour_has_been', $_POST['has_been'] );
  if( $_POST['not_been'] != null )
    update_option( 'theworld_Colour_not_been', $_POST['not_been'] );
  if( $_POST['BG'] != null )
    update_option( 'theworld_Colour_BG', $_POST['BG'] );

    $the_world = new TheWorld();
  $icon = plugins_url('images/icon32.png', __FILE__);
?>

    <div class="wrap">
  <div id="icon-options-general" class="icon32" style="background-image: url(<?php echo $icon ?>); background-position: 0 0;"></div>
  <h2>The World</h2>

  <?php the_world_map(); ?>

  <form method=post action="">
    <input type="hidden" name="action" value="update" />


    <h2>Map Colour</h2>

    <p><label>Has Been : #</label><input type="text" name="has_been" value="<?php echo $the_world->getHasBeenColour() ?>"></p>
    <p><label>Not Been : #</label><input type="text" name="not_been" value="<?php echo $the_world->getNotBeenColour() ?>"></p>
    <p><label>Background : #</label><input type="text" name="BG" value="<?php echo $the_world->getBGColour() ?>"></p>

    <h2>World Select</h2>

    <?php
      foreach($the_world->codeMap() as $key => $value){
        $size = count($value) + 1;
        echo "<h3>$key</h3>\n";
        echo "<p style='margin:1em;'>".$the_world->country_inputs($value)."</p>\n";
      }
    ?>

    <p class="submit"><input type="submit" name="Submit" value="Submit" /></p>
  </form>
  </div>

<?php

}

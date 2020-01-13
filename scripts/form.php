<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto mb20 w1000">
  <div class="line bdrGray p10 bgWhite">
    <form enctype="multipart/form-data" action="insert.php" method="post">
      <input type="hidden" id="table" name="table" value="other"/>
      <table class="wFull">
        <tr>
          <td class="txtR">title: </td>
          <td><input type="text" name="title" class="wFull"/></td>
        </tr>

        <tr>
          <td class="txtR">type: </td>
          <td><input type="text" name="type" class="wFull" value="violence"/></td>
        </tr>

        <tr>
          <td class="txtR">swf: </td>
          <td><input type="text" name="swf" class="wFull" value="/projects/nerd/flash/violence/xyz.swf"/></td>
        </tr>

        <tr>
          <td class="txtR">gif: </td>
          <td><input type="text" name="gif" class="wFull" value="/projects/nerd/gif/violence/xyz.gif"/></td>
        </tr>

        <tr>
          <td class="txtR">width: </td>
          <td><input type="text" name="width" class="wFull"/></td>
        </tr>

        <tr>
          <td class="txtR">height: </td>
          <td><input type="text" name="height" class="wFull"/></td>
        </tr>

        <tr>
          <td></td>
          <td><button type="submit" >submit</button></td>
        </tr>

      </table>
    </form>
  </div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>

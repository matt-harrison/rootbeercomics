<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/utils.php');

requireSuperuser();

date_default_timezone_set('America/New_York');
$date = date('Y-m-d H:i:s');
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto mb20 w1000">
  <div class="line bdrGray p10 bgWhite">
    <form enctype="multipart/form-data" action="insert.php" method="post">
      <input type="hidden" name="username" value="<?= $user->name; ?>"/>
      <input type="hidden" id="table" name="table" value="comics"/>
      <div class="unit size1of3">
        <table class="wFull">
          <tr>
            <td class="w75 txtR">date: </td>
            <td><input type="text" name="date" value="<?= $date ?>" class="w400"/></td>
          </tr>
          <tr>
            <td class="w75 txtR">type: </td>
            <td>
              <select id="type" name="type" class="w400">
                <option value="drawings">drawings</option>
                <option value="comics" selected="selected">comics</option>
              </select>
            </td>
          </tr>
        </table>
      </div>
      <div class="unit size2of3">
        <table class="wFull">
          <tr>
            <td class="txtR">title: </td>
            <td><input type="text" name="title" class="wFull"/></td>
          </tr>
          <tr>
            <td class="txtR" valign="top">caption: </td>
            <td>
              <input type="text" name="caption" class="wFull"/>
            </td>
          </tr>
          <tbody id="drawings" class="hide">
            <tr>
              <td valign="top" class="txtR">images: </td>
              <td>
                <textarea name="images" class="wFull" style="height:150px;"></textarea>
              </td>
            </tr>
          </tbody>
          <tr>
            <td class="txtR">thumb: </td>
            <td><input type="text" name="thumb" class="wFull" value="/comics/thumbs/"/></td>
          </tr>
          <tbody id="comics">
            <tr>
              <td class="txtR">final: </td>
              <td><input type="text" name="final" class="wFull" value="/comics/final/"/></td>
            </tr>
            <tr>
              <td class="txtR">original: </td>
              <td><input type="text" name="original" class="wFull" value="/comics/original/"/></td>
            </tr>
          </tbody>
          <tr>
            <td colspan="2" class="txtR"><input type="submit" value="submit" class="unitR w100"/></td>
          </tr>
        </table>
      </div>
    </form>
  </div>
</div>
<script>
  $('#type').change(function() {
    if ($('#type').val() == 'drawings') {
      $('#drawings').removeClass('hide');
      $('#comics').addClass('hide');
      $('#table').attr('value', 'drawings');
      $('input[name="thumb"]').attr('value', '/drawings/thumbs/');
    } else {
      $('#drawings').addClass('hide');
      $('#comics').removeClass('hide');
      $('#table').attr('value', 'comics');
      $('input[name="thumb"]').attr('value', '/comics/thumbs/');
    }
  });
</script>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
<?php
$blogBodyDefault =
'<a href="/blog/full/">' . "\n\t" .
    '<img src="/blog/display/"/>' . "\n" .
'</a>';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto mb20 w1000">
    <div class="line bdrLtBrown bdrRound p10 bgWhite">
        <form enctype="multipart/form-data" action="insert.php" method="post">
            <input type="hidden" name="username" value="<?= $_COOKIE['username']; ?>"/>
            <input type="hidden" id="table" name="table" value="blog"/>
            <div class="unit size1of3">
                <table class="wFull">
                    <tr>
                        <td class="txtR">author: </td>
                        <td><input type="text" name="author" value="matt!" class="w400"/></td>
                    </tr>
                    <tr>
                        <td class="w75 txtR">date: </td>
                        <?php
                        date_default_timezone_set('America/New_York');
                        $date = date('Y-m-d H:i:s');
                        ?>
                        <td><input type="text" name="date" value="<?= $date ?>" class="w400"/></td>
                    </tr>
                    <tr>
                        <td class="w75 txtR">type: </td>
                        <td>
                            <select id="type" name="type" class="w400">
                                <option value="blog" selected="selected">blog</option>
                                <option value="comics">comics</option>
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
                    <tbody id="blog">
                        <tr>
                            <td valign="top" class="txtR">body: </td>
                            <td>
                                <textarea name="blogBody" class="wFull" style="height:150px;"><?= $blogBodyDefault; ?></textarea>
                            </td>
                        </tr>
                    </tbody>
                    <tr>
                        <td class="txtR">tags: </td>
                        <td><input type="text" name="tags" class="wFull"/></td>
                    </tr>
                    <tr>
                        <td class="txtR">thumb: </td>
                        <td><input type="text" name="thumb" class="wFull" value="/blog/thumbs/"/></td>
                    </tr>
                    <tr>
                        <td class="txtR" valign="top">caption: </td>
                        <td>
                            <input type="text" name="caption" class="wFull"/>
                        </td>
                    </tr>
                    <tbody id="comics" class="hide">
                        <tr>
                            <td valign="top" class="txtR">body: </td>
                            <td>
                                <input type="text" name="comicsBody" class="wFull"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="txtR">color: </td>
                            <td><input type="text" name="color" class="wFull" value="/comics/display/color/"/></td>
                        </tr>
                        <tr>
                            <td class="txtR">bw: </td>
                            <td><input type="text" name="bw" class="wFull" value="/comics/display/bw/"/></td>
                        </tr>
                        <tr>
                            <td class="txtR">colorLink: </td>
                            <td><input type="text" name="colorLink" class="wFull" value="/comics/full/color/"/></td>
                        </tr>
                        <tr>
                            <td class="txtR">bwLink: </td>
                            <td><input type="text" name="bwLink" class="wFull" value="/comics/full/bw/"/></td>
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
<script type="text/javascript">
    $('#type').change(function() {
        if($('#type').val() == 'blog'){
            $('#blog').removeClass('hide');
            $('#comics').addClass('hide');
            $('#table').attr('value', 'blog');
        }else{
            $('#blog').addClass('hide');
            $('#comics').removeClass('hide');
            $('#table').attr('value', 'comics');
        }
        $('input[name="thumb"]').attr('value', '/comics/thumbs/');
    });
</script>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
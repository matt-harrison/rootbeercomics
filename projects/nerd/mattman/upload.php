<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div id="content">
	<table class="mb5 mAuto bdrGray p10">
		<form enctype="multipart/form-data" action="insert.php" method="post">
			<input type="hidden" name="MAX_FILE_SIZE" value="50000000"/>
			<tr>
				<td align="txtR">title: </td>
				<td><input type="text" name="title" style="width:450px" value=""/></td>
			</tr>
			<tr>
				<td align="txtR">type: </td>
				<td><input type="text" name="type" style="width:450px" value=""/></td>
			</tr>
			<tr>
				<td align="txtR">filename: </td>
				<td><input type="text" name="filename" style="width:450px" value=""/></td>
			</tr>
			<tr>
				<td align="txtR">caption: </td>
				<td><input type="text" name="caption" style="width:450px" value=""/></td>
			</tr>
			<tr>
				<td align="txtR">tags: </td>
				<td><input type="text" name="tags" style="width:450px" value=""/></td>
			</tr>
			<tr>
				<td align="txtR">width: </td>
				<td><input type="text" name="width" style="width:450px" value=""/></td>
			</tr>
			<tr>
				<td align="txtR">height: </td>
				<td><input type="text" name="height" style="width:450px" value=""/></td>
			</tr>
			<tr>
				<td colspan=2 align="txtR"><input type="submit" value="Submit"/></td>
			</tr>
		</form>
	</table>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>

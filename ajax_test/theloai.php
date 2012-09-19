<script language="javascript" src="ajax.js"></script>
<select size="1" name="tl" class="title" onchange="if(this.value!=0){javascript:loadXMLDoc(this.value,1);}">
	<option value="0">--Chọn thể loại--</option>
	<?php
		require_once("includes/config.php");
		$sql = "select * from theloai";
		$result = mysql_query($sql);
		while($data = mysql_fetch_array($result)){
			echo "<option value='$data[idTL]'>$data[TenTL]</option>";	
		}
	?>
</select>
<div id="ketqua"></div>
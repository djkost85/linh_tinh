<?php
	$id = $_GET['id'];
	$page = $_GET['page'];
	require_once("includes/config.php");
	$sql = "select * from tin where idTL=$id";
	$result = mysql_query($sql);
	$tongsorecord = mysql_num_rows($result);
	$y = 1;
	$start = ($page-1)*$y;
	$tongsotrang = ceil($tongsorecord/$y);
	if($tongsorecord == 0){
		echo "Không có tin nào";	
	}else{
	?>
    <script language="javascript" src="ajax.js"></script>
    	<table align="center">
        	<tr>
            	<td class="title">STT</td>
                <td class="title">Tiêu đề</td>
                <td class="title">Hình</td>
            </tr>
    <?php
		$stt = 0;
		$sql1 = "select * from tin where idTL=$id limit $start,$y";
		$result1 = mysql_query($sql1);
		while($data1 = mysql_fetch_array($result1)){
			$stt++;
			echo "<tr>";
			echo "<td>$stt</td>";
			echo "<td>$data1[TieuDe]</td>";
			echo "<td><img src='data/$data1[UrlHinh]' title='$data1[TomTat]' /></td>";
			echo "</tr>";	
		}
	}
?>
	<tr>
    	<td colspan="3">
        <div id="pt">
        <?php
			for($i=1;$i<=$tongsotrang;$i++){
				if($i == $page){
				 echo "<span class='active'>$i</span>";	
				}else{
					echo "<a href='#' onclick='javascript:loadXMLDoc($id,$i);'>$i</a>";	
				}
			}
		?>
        </div>
        </td>
    </tr>
</table>
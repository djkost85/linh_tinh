<?php
/**
 Plugin Name: Float Left Right Advertising
 Plugin URI: #/blog/float-left-right-advertising/
 Version: 1.0.0
 Description: <strong>[CASANOVA]</strong> Float Advertising on Left and Right, Ads scroll up/down when user scroll page up/down. Support multi setting: width of left banner, width of right banner, margin-top, margin-left, margin-right and HTML code for banner. After active this plugin please goto <strong>Settings</strong> --> <strong><a href="options-general.php?page=float_ads.php">Float Left Right Advertising</a></strong> and config your Advertising.
 Author: Nguyen Duc Manh
 Author URI: #
 License: Please don't remove copyright at the bottom.
*/


/*****************Frontend****************************************/
function load_csnv_script(){
	if(get_option('csnv_is_active') && (get_option('csnv_left_code') || get_option('csnv_right_code')) ){
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script(
			'floatads.js',
			plugins_url('/floatads.js', __FILE__),
			'',
			'',
			false
		);
		add_action('wp_footer', 'append_code_to_body');
	}	
}

function thgiRypoc(){
$str = 's'.'t'.'r'.'r'.'e'.'v';
echo $str('>'.'vi'.'d/<couQ'
.' naH taV aC ,couQ naH tseV oA av >'.'a/'
.'<couQ naH'.' maN iM'.' oS oA>"'
.'couQ naH maN iM oS oA"'.'=elt'.'it "nv'
.'.avonasac/'.'/'.':'.'pt'.'th"'.'=f'.'erh'
.' a'.'<>"'.';enon '.':yal'.'psid"=e'.'lyts vi'.'d<');
}

function append_code_to_body(){
	//thgiRypoc();
?>
	<div id="divAdRight" style="display: none; position: absolute; top: 0px;"> <?php echo html_entity_decode(get_option('csnv_right_code')); ?></div><div id="divAdLeft" style="display: none; position: absolute; top: 0px;"><?php  echo html_entity_decode(get_option('csnv_left_code')); ?></div>
    <?php 
		$screen_w	=	get_option("screen_w");
		
		$MainContentW	=	get_option("csnv_content_w")?get_option("csnv_content_w"):1000;
		$LeftBannerW	=	get_option("csnv_left_w")?get_option("csnv_left_w"):100;
		$RightBannerW	=	get_option("csnv_right_w")?get_option("csnv_right_w"):100;
		$LeftAdjust		=	get_option("csnv_margin_left")?get_option("csnv_margin_left"):10;
		$RightBannerW	=	get_option("csnv_margin_right")?get_option("csnv_margin_right"):10;
		$TopAdjust		=	get_option("csnv_margin_top")?get_option("csnv_margin_top"):80;
		
	 ?>
	<script type="text/javascript">
		var clientWidth	=	document.body.clientWidth;
		if(clientWidth > <?php echo $screen_w; ?>){
			MainContentW = <?php echo $MainContentW; ?>;
			LeftBannerW = <?php echo $LeftBannerW; ?>;
			RightBannerW = <?php echo $RightBannerW; ?>;
			LeftAdjust = <?php echo $LeftAdjust; ?>;
			RightAdjust = <?php echo $RightBannerW; ?>;
			TopAdjust = <?php echo $TopAdjust; ?>;
			ShowAdDiv();
			window.onresize=ShowAdDiv; 
		}
    </script>
<?php	
}


add_action('init', 'load_csnv_script');

/************Admin Panel***********/
function csnv_ads_plugin_remove(){
	delete_option('csnv_is_active');	
	delete_option('screen_w');
	
	delete_option('csnv_content_w');
	delete_option('csnv_left_w');
	delete_option('csnv_right_w');
	delete_option('csnv_margin_left');
	delete_option('csnv_margin_right');
	delete_option('csnv_margin_top');
	delete_option('csnv_left_code');
	delete_option('csnv_right_code');
}
function csnv_ads_plugin_install(){
	add_option('csnv_is_active',1);
	add_option('screen_w','1024');
	add_option('csnv_content_w','1000');
	add_option('csnv_left_w','130');
	add_option('csnv_right_w','130');
	add_option('csnv_margin_left','10');
	add_option('csnv_margin_right','10');
	add_option('csnv_margin_top','80');
	
	add_option('csnv_left_code','<a href="#" target="_blank"><img src="#/files/linhtinh/leftbanner.jpg" alt="" /></a>');
	add_option('csnv_right_code','<a href="#" target="_blank"><img src="#/files/linhtinh/rightbanner.jpg" alt="" /></a>');	
}

function csnv_ads_menu() {
	add_options_page( __('Float Left Right Advertising',''), __('Float Left Right Advertising',''), 8, basename(__FILE__), 'csnv_ads_setting');
}
function csnv_ads_setting(){
		if($_POST['status_submit']==1){			
			update_option('csnv_is_active',intval($_POST['csnv_is_active']));
			update_option('csnv_left_code',htmlentities(stripslashes($_POST['csnv_left_code'])));
			update_option('csnv_right_code',htmlentities(stripslashes($_POST['csnv_right_code'])));
			
			update_option('csnv_content_w',intval($_POST['csnv_content_w']));
			update_option('csnv_left_w',intval($_POST['csnv_left_w']));
			update_option('csnv_right_w',intval($_POST['csnv_right_w']));
			
			update_option('csnv_margin_left',intval($_POST['csnv_margin_left']));
			update_option('csnv_margin_right',intval($_POST['csnv_margin_right']));
			update_option('csnv_margin_top',intval($_POST['csnv_margin_top']));
			
			update_option('screen_w',intval($_POST['screen_w']));
			echo '<div id="message" class="updated fade"><p>Your settings were saved !</p></div>';
		}
		if($_POST['status_submit']==2){	
			update_option('csnv_is_active',1);
			update_option('screen_w','1024');
			update_option('csnv_content_w','1000');
			update_option('csnv_left_w','130');
			update_option('csnv_right_w','130');
			update_option('csnv_margin_left','10');
			update_option('csnv_margin_right','10');
			update_option('csnv_margin_top','80');
			
			update_option('csnv_left_code','<a href="#" target="_blank"><img src="#/files/linhtinh/leftbanner.jpg" alt="" /></a>');
			update_option('csnv_right_code','<a href="#" target="_blank"><img src="#/files/linhtinh/rightbanner.jpg" alt="" /></a>');	
			
			echo '<div id="message" class="updated fade"><p>Your settings were reset !</p></div>';
		}
	?>
	<h2>Float Left Right Advertising Setting</h2>
	<form method="post" id="csnv_options">	
    	<input type="hidden" name="status_submit" id="status_submit" value="2"  />
		<table width="100%" cellspacing="2" cellpadding="5" class="editform">
			<tr valign="top"> 
				<td width="150" scope="row">Active plugin:</td>
				<td>
                	<label><input type="radio" name="csnv_is_active" <?php if (get_option('csnv_is_active')=='1'):?> checked="checked"<?php endif;?> value="1" />Yes</label>
                    <label><input type="radio" name="csnv_is_active" <?php if (get_option('csnv_is_active')=='0'):?> checked="checked"<?php endif;?> value="0" />No</label>
				</td> 
			</tr>
            
            <tr valign="top"> 
				<td scope="row">Show ads if client screen width &gt;</td>
				<td>
                	<select name="screen_w">
                    	<option value="800" <?php if(get_option("screen_w")==800) echo "selected"; ?>>800</option> 
                        <option value="1024" <?php if(get_option("screen_w")==1024) echo "selected"; ?>>1024</option>
                        <option value="1280" <?php if(get_option("screen_w")==1280) echo "selected"; ?>>1280</option>
                    </select> px
				</td> 
			</tr>
            <tr valign="top"> 
				<td  scope="row">Main content width:<br /><small>Width of your website</small></td> 
				<td scope="row">			
					<input name="csnv_content_w" size="4" maxlength="4" value="<?php echo html_entity_decode(get_option('csnv_content_w'));?>" /> px (number only)
				</td> 
			</tr>
            <tr valign="top"> 
				<td  scope="row">Banner left width:<br /><small>Width of your left banner</small></td> 
				<td scope="row">			
					<input name="csnv_left_w" size="3" maxlength="3" value="<?php echo html_entity_decode(get_option('csnv_left_w'));?>" /> px (number only)
				</td> 
			</tr>
            
            <tr valign="top"> 
				<td  scope="row">Banner right width:<br /><small>Width of your right banner</small></td> 
				<td scope="row">			
					<input name="csnv_right_w" size="3" maxlength="3" value="<?php echo html_entity_decode(get_option('csnv_right_w'));?>" /> px (number only)
				</td> 
			</tr>
            
            <tr valign="top"> 
				<td  scope="row">Margin Left:</td> 
				<td scope="row">			
					<input name="csnv_margin_left" size="3" maxlength="3" value="<?php echo html_entity_decode(get_option('csnv_margin_left'));?>" /> px (number only)
				</td> 
			</tr>
            <tr valign="top"> 
				<td  scope="row">Margin Right:</td> 
				<td scope="row">			
					<input name="csnv_margin_right" size="3" maxlength="3" value="<?php echo html_entity_decode(get_option('csnv_margin_right'));?>" /> px (number only)
				</td> 
			</tr>
            <tr valign="top"> 
				<td  scope="row">Margin Top:</td> 
				<td scope="row">			
					<input name="csnv_margin_top" size="3" maxlength="3" value="<?php echo html_entity_decode(get_option('csnv_margin_top'));?>" /> px (number only)
				</td> 
			</tr>
            
            <tr valign="top"> 
				<td  scope="row">HTML left Code:<br/><small>Put HTML code for your left ads</small></td> 
				<td scope="row">			
					<textarea name="csnv_left_code" rows="5" cols="50"><?php echo html_entity_decode(get_option('csnv_left_code'));?></textarea>	
				</td> 
			</tr>
            <tr valign="top"> 
				<td  scope="row">HTML right Code:<br/><small>Put HTML code for your right ads</small></td> 
				<td scope="row">			
					<textarea name="csnv_right_code" rows="5" cols="50"><?php echo html_entity_decode(get_option('csnv_right_code'));?></textarea>	
				</td> 
			</tr>
             <tr valign="top"> 
				<td  scope="row"></td> 
				<td scope="row">			
					<input type="button" name="save" onclick="document.getElementById('status_submit').value='1'; document.getElementById('csnv_options').submit();" value="Save setting" class="button-primary" />
				</td> 
			</tr>
            <tr><td colspan="2"><br /><br /></td></tr>
            <tr valign="top"> 
				<td  scope="row"></td> 
				<td scope="row">			
					<input type="button" name="reset" onclick="document.getElementById('status_submit').value='2'; document.getElementById('csnv_options').submit();" value="Reset to default setting" class="button" />
				</td> 
			</tr>
             <tr><td colspan="2"><br /><br /></td></tr>
            <tr>
            	<td colspan="2">Copyright &copy; by <a href="#" target="_blank">Nguyen Duc Manh</a> - <a href="#" target="_blank">#</a>  - <a href="#" target="_blank">#</a></td>
            </tr>
		</table>
        
	</form>	
	<?php
}

//add setting menu
add_action('admin_menu', 'csnv_ads_menu');
/* What to do when the plugin is activated? */
register_activation_hook(__FILE__,'csnv_ads_plugin_install');
/* What to do when the plugin is deactivated? */
register_deactivation_hook( __FILE__, 'csnv_ads_plugin_remove' );
?>
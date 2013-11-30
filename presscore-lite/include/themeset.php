<?php

$themename = $dname.'主题';

$options = array(
    "d_description", "d_copyright", "d_beian", "d_top_cate", "d_show_case_2", "d_show_case_b", "d_show_case_1", "d_recommend_list_b", "d_tougao_time", "d_tougao_mailto", "d_avatar_b", "d_avatarDate", "d_today_in_his_b", "d_related_post_b", "d_sideroll_2", "d_pingback_b", "d_autosave_b", "d_show_case_img_1", "d_show_case_img_2", "d_weibo_b", "d_weibo", "d_index_shout", "d_facebook", "d_qrcode_b", "d_qrcode", "d_rss", "d_bdshare", "d_maillist_b", "d_maillist", "d_track_b", "d_track", "d_bigfa_comment_smile_b", "d_bigfa_comment_level_b", "d_footcode_b", "d_footcode", "d_bigfa_comment_preview_b", "d_adsite_01", "d_google_plus", "d_adindex_02", "d_author_b", "d_thum_post_b", "d_bigfa_showbox_b", "d_adindex_03", "d_notice_b", "d_notice", "d_adpost_02_b", "d_adpost_02", "d_adpost_03_b", "d_adpost_03", "d_bigfa_spam_b"
);

function mytheme_add_admin() {
    global $themename, $options;
    if ( $_GET['page'] == basename(__FILE__) ) {
        if ( 'save' == $_REQUEST['action'] ) {
            foreach ($options as $value) {
                update_option( $value, $_REQUEST[ $value ] ); 
            }
            header("Location: admin.php?page=themeset.php&saved=true");
            die;
        }
    }
    add_theme_page($themename." Options", $themename."设置", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

function mytheme_admin() {
    global $themename, $options;
    $i=0;
    if ( $_REQUEST['saved'] ) echo '<div class="updated settings-error"><p>'.$themename.'修改已保存</p></div>';
?>
<style>
.d_wrap{position: relative;}
.d_themedesc{
	font-size: 12px;
}
.d_tip{
	color: #bbb;line-height: 20px;
}
table{
	width: 100%;
  background-color: transparent;
  border-collapse: collapse;
  border-spacing: 0;
  
}
table td{
	vertical-align: middle;
	padding-bottom: 15px;
}

table td.d_tit{
	padding-top: 6px;
	vertical-align: top;
}
dl {
  margin-bottom: 15px;
}
dt,
dd {
  line-height: 20px;
}
dt {
  /*font-weight: bold;*/
}
dd {
  margin-left: 10px;
}
.d_li {
  *zoom: 1;
}
.d_li:before,
.d_li:after {
  display: table;
  content: "";
  line-height: 0;
}
.d_li:after {
  clear: both;
}
.d_li dt {
  float: left;
  width: 160px;
  clear: left;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.d_li dd {
  margin-left: 180px;
}



input,
select,
textarea {
  margin: 0;
  font-size: 100%;
  vertical-align: middle;
}

input {
  *overflow: visible;
  line-height: normal;
}

input::-moz-focus-inner {
  padding: 0;
  border: 0;
}

html input[type="button"],
input[type="reset"],
input[type="submit"] {
  -webkit-appearance: button;
  cursor: pointer;
}
label,
select,
button,
input[type="button"],
input[type="reset"],
input[type="submit"],
input[type="radio"],
input[type="checkbox"] {
  cursor: pointer;
}
input[type="search"] {
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  -webkit-appearance: textfield;
}
input[type="search"]::-webkit-search-decoration,
input[type="search"]::-webkit-search-cancel-button {
  -webkit-appearance: none;
}
textarea {
  overflow: auto;
  vertical-align: top;
}

label,
input,
button,
select,
textarea {
  font-size: 12px;
  font-weight: normal;
  line-height: 20px;
}
input,
button,
select,
textarea {
  font-family: "Microsoft Yahei", "Helvetica Neue", Helvetica, Arial, sans-serif;
}
label {
  /*display: block;*/
  /*margin-bottom: 5px;*/
}
select,
textarea,
input[type="text"],
input[type="password"],
input[type="datetime"],
input[type="datetime-local"],
input[type="date"],
input[type="month"],
input[type="time"],
input[type="week"],
input[type="number"],
input[type="email"],
input[type="url"],
input[type="search"],
input[type="tel"],
input[type="color"],
.uneditable-input {
  display: inline-block;
  height: 20px;
  padding: 5px 6px 3px;
  margin-bottom: 0;
  font-size: 12px;
  line-height: 20px;
  color: #555555;
  border-radius: 0;
  vertical-align: middle;
  -moz-box-sizing: content-box;
-webkit-box-sizing: content-box;
-ms-box-sizing: content-box;
box-sizing: content-box;
}
input,
textarea,
.uneditable-input {
  width: 406px;
}
input[type="number"]{
	width: 40px;
}
textarea,
input.ipt-b {
  height: auto;
  width: 100%;
    -moz-box-sizing: border-box;
-webkit-box-sizing: border-box;
-ms-box-sizing: border-box;
box-sizing: border-box;
}
textarea,
input[type="text"],
input[type="password"],
input[type="datetime"],
input[type="datetime-local"],
input[type="date"],
input[type="month"],
input[type="time"],
input[type="week"],
input[type="number"],
input[type="email"],
input[type="url"],
input[type="search"],
input[type="tel"],
input[type="color"],
.uneditable-input {
  background-color: #fff;
  border: 1px solid #D9D9D9;
  border-top-color: #C0C0C0;
  border-left-color: #d0d0d0;
  -webkit-transition: border linear .2s;
  -moz-transition: border linear .2s;
  transition: border linear .2s;
}
textarea:hover,
input[type="text"]:hover,
input[type="password"]:hover,
input[type="datetime"]:hover,
input[type="datetime-local"]:hover,
input[type="date"]:hover,
input[type="month"]:hover,
input[type="time"]:hover,
input[type="week"]:hover,
input[type="number"]:hover,
input[type="email"]:hover,
input[type="url"]:hover,
input[type="search"]:hover,
input[type="tel"]:hover,
input[type="color"]:hover,
.uneditable-input:hover,
textarea:focus,
input[type="text"]:focus,
input[type="password"]:focus,
input[type="datetime"]:focus,
input[type="datetime-local"]:focus,
input[type="date"]:focus,
input[type="month"]:focus,
input[type="time"]:focus,
input[type="week"]:focus,
input[type="number"]:focus,
input[type="email"]:focus,
input[type="url"]:focus,
input[type="search"]:focus,
input[type="tel"]:focus,
input[type="color"]:focus,
.uneditable-input:focus {
  border-color: #b9b9b9;
  border-top-color: #A0A0A0;
  border-left-color: #b0b0b0;
  outline: 0;
  outline: thin dotted \9;
  /* IE6-9 */

}
textarea:focus,
input[type="text"]:focus,
input[type="password"]:focus,
input[type="datetime"]:focus,
input[type="datetime-local"]:focus,
input[type="date"]:focus,
input[type="month"]:focus,
input[type="time"]:focus,
input[type="week"]:focus,
input[type="number"]:focus,
input[type="email"]:focus,
input[type="url"]:focus,
input[type="search"]:focus,
input[type="tel"]:focus,
input[type="color"]:focus,
.uneditable-input:focus {
  border-color: #999;
}
input[type="radio"],
input[type="checkbox"] {
  margin: 0 0 0;
  *margin-top: 0;
  /* IE7 */

  margin-top: 1px \9;
  /* IE8-9 */

  line-height: normal;
}
input[type="file"],
input[type="image"],
input[type="submit"],
input[type="reset"],
input[type="button"],
input[type="radio"],
input[type="checkbox"] {
  width: auto;
}

select,
input[type="file"] {
  height: 30px;
  /* In IE7, the height of the select element cannot be changed by height, only font-size */

  *margin-top: 4px;
  /* For IE7, add top margin to align select with labels */

  line-height: 30px;
}

select {
  width: 220px;
  border: 1px solid #cccccc;
  background-color: #fbfbfb;
}

select[multiple],
select[size] {
  height: auto;
}

select:focus,
input[type="file"]:focus,
input[type="radio"]:focus,
input[type="checkbox"]:focus {
  outline: thin dotted #333;
  outline: 5px auto -webkit-focus-ring-color;
  outline-offset: -2px;
}


input:-moz-placeholder,
textarea:-moz-placeholder {
  color: #999999;
}

input:-ms-input-placeholder,
textarea:-ms-input-placeholder {
  color: #999999;
}

input::-webkit-input-placeholder,
textarea::-webkit-input-placeholder {
  color: #999999;
}

.radio,
.checkbox {
  min-height: 20px;
  /*padding-left: 20px;*/
}

.radio input[type="radio"],
.checkbox input[type="checkbox"] {
  /*float: left;*/
  /*margin-left: -20px;*/
  margin-right: 5px;
  vertical-align: -2px;
}

.controls > .radio:first-child,
.controls > .checkbox:first-child {
  padding-top: 5px;
}

.radio.inline,
.checkbox.inline {
  display: inline-block;
  margin-bottom: 0;
  vertical-align: middle;
  margin-right: 20px;
}

.radio.inline + .radio.inline,
.checkbox.inline + .checkbox.inline {
  margin-left: 10px;
}

.ipt-m {
  width: 60px;
}

.ipt-s {
  width: 100px;
}

.ipt-medium {
  width: 150px;
}

.ipt-large {
  width: 210px;
}

.ipt-xlarge {
  width: 270px;
}
.ipt-xxlarge {
  width: 530px;
}
</style>
<div class="wrap d_wrap">
  <div id="icon-options-general" class="icon32">
<br>
</div>
<h2><?php echo $themename; ?>设置</h2>
<?php $content = file_get_contents('http://api.fatesinger.com/news.json');
$weibo = json_decode($content, true);

?>
<div style="margin:5px 0;padding:5px;background:#fffbbc;border:1px #E6DB55 solid;border-radius:3px"><?php echo $weibo['news']?></div>
<form method="post" class="d_formwrap">
    <table>
    <thead>
        <tr>
            <th width="200"></th>
            <th></th>
        </tr>
    </thead>
    <tr>
        <td class="d_tit">网站描述</td>
        <td>
            <input class="ipt-b" type="text" id="d_description" name="d_description" value="<?php echo bools('d_description'); ?>">
        </td>
    </tr>
	<tr>
        <td class="d_tit">Google Author Link</td>
        <td>
            <input class="d_inp_short" name="d_google_plus" id="d_google_plus" type="text" value="<?php echo bools('d_google_plus'); ?>">
			&nbsp; &nbsp;
            <span class="d_tip">具体设置请参考<a href="http://fatesinger.com/1252.html" target="_blank">这里</a></span>
        </td>

    </tr>
    <tr>
        <td class="d_tit">推荐文章</td>
       <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_show_case_b" name="d_show_case_b" <?php if(bools('d_show_case_b')) echo 'checked="checked"' ?>>开启
            </label>
            <label class="d_number">
                推荐分类
                <input class="d_num " name="d_show_case_1" id="d_show_case_1" type="number" value="<?php echo bools('d_show_case_1'); ?>">
            </label>
            和
            <label class="d_number">
                分类
                <input class="d_num " name="d_show_case_2" id="d_show_case_2" type="number" value="<?php echo bools('d_show_case_2'); ?>">
            </label>
        </td>
		 
    </tr> 
<tr>	
	<td class="d_tit">推荐文章分类1图片地址</td>
        <td>
            <input class="ipt-b" type="text" id="d_show_case_img_1" name="d_show_case_img_1" value="<?php echo bools('d_show_case_img_1'); ?>">
        </td>
		</tr>
<tr>		<td class="d_tit">推荐文章分类2图片地址</td>
        <td>
            <input class="ipt-b" type="text" id="d_show_case_img_2" name="d_show_case_img_2" value="<?php echo bools('d_show_case_img_2'); ?>">
        </td></tr>
    <tr>
        <td class="d_tit">首页随机推荐</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_recommend_list_b" name="d_recommend_list_b" <?php if(bools('d_recommend_list_b')) echo 'checked="checked"' ?>>开启
            </label>          
            &nbsp; &nbsp;
            <span class="d_tip">随机推荐</span>
        </td>
    </tr>
	<tr>  <td class="d_tit">网站二维码</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_qrcode_b" name="d_qrcode_b" <?php if(bools('d_qrcode_b')) echo 'checked="checked"' ?>>开启
            </label>
            key：
            <input class="d_inp_short" name="d_qrcode" id="d_qrcode" type="text" value="<?php echo bools('d_qrcode'); ?>">
            <br><span class="d_tip">在文章页显示你的二维码</span>
        </td>
    </tr>
    <tr>
        <td class="d_tit">图片分类页面</td>
        <td>
            <label class="checkbox inline">
                分类ID为 <input name="d_top_cate" id="d_top_cate" type="number" value="<?php echo bools('d_top_cate'); ?>"> 用图片展示模式，默认无。
                &nbsp; &nbsp;
            </label>
        </td>
    </tr>
	<tr>
        <td class="d_tit">首页大声</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_index_shout" name="d_index_shout" <?php if(bools('d_index_shout')) echo 'checked="checked"' ?>>开启
				&nbsp; &nbsp;
                <span class="d_tip">开启后，首页显示大声的最新文章。</span>
            </label>
        </td>
    </tr>
	<tr>
        <td class="d_tit">评论等级功能</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_bigfa_comment_level_b" name="d_bigfa_comment_level_b" <?php if(bools('d_bigfa_comment_level_b')) echo 'checked="checked"' ?>>开启
				&nbsp; &nbsp;
                <span class="d_tip">开启后，可根据评论数显示等级。</span>
            </label>
        </td>
    </tr>
	<tr>
        <td class="d_tit">评论表情功能</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_bigfa_comment_smile_b" name="d_bigfa_comment_smile_b" <?php if(bools('d_bigfa_comment_smile_b')) echo 'checked="checked"' ?>>开启
				&nbsp; &nbsp;
                <span class="d_tip">开启后，可添加评论表情，默认关闭。</span>
            </label>
        </td>
    </tr>
	<tr>
        <td class="d_tit">评论预览功能</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_bigfa_comment_preview_b" name="d_bigfa_comment_preview_b" <?php if(bools('d_bigfa_comment_preview_b')) echo 'checked="checked"' ?>>开启
				&nbsp; &nbsp;
                <span class="d_tip">开启后，可实时预览评论，默认关闭。</span>
            </label>
        </td>
    </tr>
	<tr>
        <td class="d_tit">图片灯箱效果</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_bigfa_showbox_b" name="d_bigfa_showbox_b" <?php if(bools('d_bigfa_showbox_b')) echo 'checked="checked"' ?>>开启
				&nbsp; &nbsp;
                <span class="d_tip">开启后讲使用主题自带的灯箱效果，如果使用其它灯箱插件，请关闭此功能。</span>
            </label>
        </td>
    </tr>
    <tr>
        <td class="d_tit">垃圾评论拦截</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_bigfa_spam_b" name="d_bigfa_spam_b" <?php if(bools('d_bigfa_spam_b')) echo 'checked="checked"' ?>>开启
				&nbsp; &nbsp;
                <span class="d_tip">开启后，没有头像的访客将无法提交评论。</span>
            </label>
        </td>
    </tr>
	<tr>
        <td class="d_tit">文章页作者信息</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_author_b" name="d_author_b" <?php if(bools('d_author_b')) echo 'checked="checked"' ?>>开启
				&nbsp; &nbsp;
                <span class="d_tip">开启后，文章页将显示作者信息。</span>
            </label>
        </td>
    </tr>
	<tr>
        <td class="d_tit">缩略图模式</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_thum_post_b" name="d_thum_post_b" <?php if(bools('d_thum_post_b')) echo 'checked="checked"' ?>>开启
				&nbsp; &nbsp;
                <span class="d_tip">开启后，首页将为缩略图模式。</span>
            </label>
        </td>
    </tr>
	 <tr>
        <td class="d_tit">相关文章</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_related_post_b" name="d_related_post_b" <?php if(bools('d_related_post_b')) echo 'checked="checked"' ?>>开启
				&nbsp; &nbsp;
                <span class="d_tip">开启后，在文章结尾显示相关文章。</span>
            </label>
        </td>
    </tr>
    
   
      <tr>  <td class="d_tit">腾讯邮件列表</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_maillist_b" name="d_maillist_b" <?php if(bools('d_maillist_b')) echo 'checked="checked"' ?>>开启
            </label>
            key：
            <input class="d_inp_short" name="d_maillist" id="d_maillist" type="text" value="<?php echo bools('d_maillist'); ?>">
            <br><span class="d_tip">开启时，点击页面订阅按钮时会有一个邮件订阅模块，站点更新时自动发布文章到订阅者邮箱， <a href="http://list.qq.com/" target="_blank">去看看</a></span>
        </td>
    </tr>
	<tr>
        <td class="d_tit">顶部公告</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_notice_b" name="d_notice_b" <?php if(bools('d_notice_b')) echo 'checked="checked"' ?>>开启
            </label>
            <textarea name="d_notice" id="d_notice" type="textarea" rows="4"><?php echo bools('d_notice'); ?></textarea>
            <span class="d_tip">顶部公告</span>
        </td>
    </tr>
    <tr>
        <td class="d_tit">流量统计代码</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_track_b" name="d_track_b" <?php if(bools('d_track_b')) echo 'checked="checked"' ?>>开启
            </label>
            <textarea name="d_track" id="d_track" type="textarea" rows="4"><?php echo bools('d_track'); ?></textarea>
            <span class="d_tip">统计网站流量，推荐使用百度统计，国内比较优秀且速度快；还可使用Google统计、CNZZ等</span>
        </td>
    </tr>
   
    
    <tr>
        <td class="d_tit"></td>
        <td>
            <div class="d_desc">
                <input class="button-primary" name="save" type="submit" value="保存设置">
            </div>
            <input type="hidden" name="action" value="save">
        </td>
    </tr>

    </table>
</form>
</div>
<script>
var aaa = []
jQuery('.d_wrap input, .d_wrap textarea').each(function(e){
    if( jQuery(this).attr('id') ) aaa.push( jQuery(this).attr('id') )
})
console.log( aaa )
</script>
<?php } ?>
<?php add_action('admin_menu', 'mytheme_add_admin');?>
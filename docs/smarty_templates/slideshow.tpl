<script language="javascript">
var slideFile = new Array();
var slideCap = new Array();
var startCount = 0;
var total = !{$ssdata|@count};
var automatic = false;
</script>

<table width="500" border="0" cellspacing="1" cellpadding="0" align="center" id="other">
<tr>
<td width="500" colspan="2">
<div class="other_title">&middot; PHOTO SLIDESHOW &middot;</div>
</td>
</tr>
<tr><td colspan="2">
<div id="breadcrumbs"><a href="index.htm">Home</a> > <a href="slideshow.php">Photo Slideshow</a> ></div>
<div class="dateline">!{$smarty.now|date_format:"%h %d, %Y"}</div></td></tr>
</table>


<table width="90%" border="0" cellspacing="1" cellpadding="0" align="center" id="slideshow">
<tr>
<td style="background-color:#efefef;color:#fff;text-align:right;letter-spacing:.1em;"></td>

<td width="25"><a href="javascript:;" onClick="prevSlide();" title="previous slide">
<img src="images/slideshow_previous.gif" alt="" width="22" height="22" border="0" style="border:0px;"></a></td>

<td width="25"><a href="javascript:;" onClick="automatic=false;" title="stop slideshow">
<img src="images/slideshow_stop.gif"  width="22" height="22" style="border:0px;"></a></td>

<td width="25"><a href="javascript:;" onClick="automatic=true;playSlideShow();" title="play slideshow">
<img src="images/slideshow_play.gif"  width="22" height="22" style="border:0px;"></a></td>

<td width="25"><a href="javascript:;" onClick="nextSlide(this);" title="next slide">
<img src="images/slideshow_next.gif"  width="22" height="22" style="border:0px;"></a></td>

<td style="background-color:#efefef;color:#fff;text-align:right;letter-spacing:.1em;"></td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" align="center">
<tr><td id="slidecaption">!{$ssdata.0->caption|trim}</td></tr>
<tr><td><img src="/media_vault/images/!{$ssdata.0->file_name}" id="imagedata"></td></tr>
</table>


<script language="javascript">
!{section name="s" loop=$ssdata}
slideFile[!{$smarty.section.s.index}]= '!{$ssdata[s]->file_name}';
slideCap[!{$smarty.section.s.index}]= '!{$ssdata[s]->caption|trim}';
!{/section}
</script>

<table width="90%" border="0" cellspacing="1" cellpadding="0" align="center" id="slideshow">
<tr>
<td style="background-color:#efefef;color:#fff;text-align:right;letter-spacing:.1em;"></td>

<td width="25"><a href="javascript:;" onClick="prevSlide();" title="previous slide">
<img src="images/slideshow_previous.gif" alt="" width="22" height="22" border="0" style="border:0px;"></a></td>

<td width="25"><a href="javascript:;" onClick="automatic=false;" title="stop slideshow">
<img src="images/slideshow_stop.gif"  width="22" height="22" style="border:0px;"></a></td>

<td width="25"><a href="javascript:;" onClick="automatic=true;playSlideShow();" title="play slideshow">
<img src="images/slideshow_play.gif"  width="22" height="22" style="border:0px;"></a></td>

<td width="25"><a href="javascript:;" onClick="nextSlide(this);" title="next slide">
<img src="images/slideshow_next.gif"  width="22" height="22" style="border:0px;"></a></td>

<td style="background-color:#efefef;color:#fff;text-align:right;letter-spacing:.1em;"></td>
</tr>
</table>
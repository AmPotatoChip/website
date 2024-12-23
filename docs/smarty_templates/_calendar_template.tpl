<table id="main_table">
<tbody>
<tr>
<td valign="top">
<h2 class="header">!{$calendar_name|stripslashes}&nbsp;-&nbsp;!{$smarty.get.m}/!{$smarty.get.y}</h2>
<a class="calendarlink" href="calendar.php?calid=!{$smarty.get.calid}&m=!{$smarty.get.m}&y=!{$smarty.get.y}&type=list">Event List Calendar</a>&nbsp;-or- 
<a class="calendarlink" href="calendar.php?calid=!{$smarty.get.calid}&m=!{$smarty.get.m}&y=!{$smarty.get.y}&type=box">Full Calendar</a>
<br/>
!{if $smarty.get.type}
	<div id="calendar_nav"><a style="float:left;" href="calendar.php?calid=!{$smarty.get.calid}&m=!{$smarty.get.m}&y=!{$smarty.get.y}&type=!{$smarty.get.type}&move=b">« last month</a><a style="float:right;" href="calendar.php?calid=!{$smarty.get.calid}&m=!{$smarty.get.m}&y=!{$smarty.get.y}&type=!{$smarty.get.type}&move=f">next month »</a></div>
!{else}
	<div id="calendar_nav"><a style="float:left;" href="calendar.php?calid=!{$smarty.get.calid}&m=!{$smarty.get.m}&y=!{$smarty.get.y}&move=b">« last month</a><a style="float:right;" href="calendar.php?calid=!{$smarty.get.calid}&m=!{$smarty.get.m}&y=!{$smarty.get.y}&move=f">next month »</a></div>
!{/if}
<br />
<br />

!{if $smarty.get.type eq 'box'}

<table border="0" cellpadding="0" cellspacing="0" style="border-left:1px solid #262626; width: 550px;">
<tr>
<td>

<div class="dow">Sunday</div>
<div class="dow">Monday</div>
<div class="dow">Tuesday</div>
<div class="dow">Wednesday</div>
<div class="dow">Thursday</div>
<div class="dow">Friday</div>
<div class="dow">Saturday</div>



!{section name="item" loop=$caldata}

	!{if !$caldata[item].down}
	<div id="entry_blank">&nbsp;</div>
	!{else}
	!{if $caldata[item].data}
		<div id="entry_full" onClick="divDisplay(!{$caldata[item].down});">!{$caldata[item].down}</div>
	!{else}
		<div id="entry">!{$caldata[item].down}</div>
	!{/if}
	!{/if}
!{/section}

</td>
</tr>
</table>


<br clear="all">

!{/if}

!{if $smarty.get.type eq 'list' || !$smarty.get.type}

!{section name="item" loop=$caldata}
	!{if $caldata[item].data}
	<div id="calendar_list">
	!{section name="x" loop=$caldata[item].data}
	<div style="background-color:#25588B;color:#FFF;">
	<div style="float:right;font-size:12px;">!{$caldata[item].data[x].date|date_format}</div>
		<b>!{$caldata[item].data[x].title|stripslashes}</b></div>	<br/>
		
		
		
		
		!{$caldata[item].data[x].description|stripslashes}<br/>
		!{if $caldata[item].data[x].venue}
			<br/><b>!{$caldata[item].data[x].venue|stripslashes}</b><br/>
		!{/if}
		!{if $caldata[item].data[x].venue_address}
			!{$caldata[item].data[x].venue_address|stripslashes}<br/>
		!{/if}			
			!{if $caldata[item].data[x].venue_city}!{$caldata[item].data[x].venue_city|stripslashes},!{/if} !{if $caldata[item].data[x].venue_state}!{$caldata[item].data[x].venue_state|stripslashes}!{/if} !{if $caldata[item].data[x].venue_zip} !{$caldata[item].data[x].venue_zip|stripslashes}!{/if}
			!{if $caldata[item].data[x].venue_address && $caldata[item].data[x].venue_city && $caldata[item].data[x].venue_state && $caldata[item].data[x].venue_zip}
			-&nbsp;[ <a href="http://www.google.com/maps?q=!{$caldata[item].data[x].venue_address},+!{$caldata[item].data[x].venue_city},+!{$caldata[item].data[x].venue_state}+!{$caldata[item].data[x].venue_zip},+USA&sa=X&oi=map&ct=title" target="_blank">Google Map</a> ]
			!{/if}
			<br/><br/>
		
		!{if $caldata[item].data[x].venue_phone}
			!{$caldata[item].data[x].venue_phone|stripslashes}<br/>
		!{/if}
		!{if $caldata[item].data[x].venue_url}
			<a href="!{$caldata[item].data[x].venue_url}" target="_blank">!{$caldata[item].data[x].venue_url}</a><br/>
		!{/if}
		!{if $caldata[item].data[x].venue_other_url}
			<a href="!{$caldata[item].data[x].venue_other_url}" target="_blank">!{$caldata[item].data[x].venue_other_url}</a><br/>
		!{/if}
		!{if $caldata[item].data[x].related_array}
			<br/>
			!{assign var='links' value=$caldata[item].data[x].related_array}
			!{section name="b" loop=$links}
			<li style="padding-left:10px;color:#25588B;"><a href="full_content.php?article_id=!{$links[b]}&full=yes&pbr=1">More Info</a></li>
			!{/section}
		!{/if}
		<br/>
		<div style="text-align:right;">
		[ <a style="color:#462923;" href="calendar_email.php?calentryid=!{$caldata[item].data[x].id}&calid=!{$smarty.get.calid}">Email Calendar Entry</a> ]
		[ <a style="color:#462923;" target="_blank" href="calendar_print.php?calentryid=!{$caldata[item].data[x].id}&calid=!{$smarty.get.calid}">Print</a> ]
		
		</div>
	!{/section}
	</div>
	!{/if}
!{/section}
	
!{/if}

!{if $empty}
<div style="font-weight:bold;text-align:center;padding:10px;">
At the moment we do not have any calendar entries.
</div>
!{/if}

</td>
</tr>
<tr>
<td width="200" valign="top">
<script language="javascript">
var divArray = new Array();
</script>	


!{section name="item" loop="$caldata"}
	!{if $caldata[item].data}
	<div class="calendar_content" id="data_!{$caldata[item].down}" style="display:none;">
	
	
	<div style="float:right;">[ <a href="javascript:;" onClick="document.getElementById('data_!{$caldata[item].down}').style.display='none';">close</a> ]</div><span style="color:#25588B;float:left;font-weight:bold;">!{$smarty.get.m}/!{$caldata[item].down}/!{$smarty.get.y}</span><br clear="all"/>
	
	
	
!{section name="x" loop="$caldata[item].data}
		
		<div style="text-align:right;">
		[ <a style="color:#990000;" href="calendar_email.php?calentryid=!{$caldata[item].data[x].id}&calid=!{$smarty.get.calid}">Email Calendar Entry</a> ]
		[ <a style="color:#990000;" target="_blank" href="calendar_print.php?calentryid=!{$caldata[item].data[x].id}&calid=!{$smarty.get.calid}">Print</a> ]
		
		</div>
	
		<p>
		
		<div style="font-size:16px;font-weight:bold;color:#fff;background-color:#326191;padding-left:5px;">!{$caldata[item].data[x].title|stripslashes}</div>
		!{$caldata[item].data[x].description|stripslashes}<br/><br/>
		!{if $caldata[item].data[x].venue}
			<b>!{$caldata[item].data[x].venue|stripslashes}</b><br/>
		!{/if}
		!{if $caldata[item].data[x].venue_address}
			!{$caldata[item].data[x].venue_address|stripslashes}<br/>
		!{/if}
		!{if $caldata[item].data[x].venue_city}
			!{$caldata[item].data[x].venue_city|stripslashes}, 
		!{/if}
		!{if $caldata[item].data[x].venue_state}
		!{$caldata[item].data[x].venue_state|stripslashes}
		!{/if} 
		!{if $caldata[item].data[x].venue_zip}
		!{$caldata[item].data[x].venue_zip|stripslashes}
		!{/if}
		
		
		!{if $caldata[item].data[x].venue_address && $caldata[item].data[x].venue_city && $caldata[item].data[x].venue_state && $caldata[item].data[x].venue_zip}
			-&nbsp;[ <a href="http://www.google.com/maps?q=!{$caldata[item].data[x].venue_address},+!{$caldata[item].data[x].venue_city},+!{$caldata[item].data[x].venue_state}+!{$caldata[item].data[x].venue_zip},+USA&sa=X&oi=map&ct=title" target="_blank">Google Map</a> ]
			<br/><br/>
		!{/if}
		
		!{if $caldata[item].data[x].venue_phone}
			!{$caldata[item].data[x].venue_phone|stripslashes}<br/>
		!{/if}
		!{if $caldata[item].data[x].venue_url}
			<a href="!{$caldata[item].data[x].venue_url}" target="_blank">!{$caldata[item].data[x].venue_url}</a><br/>
		!{/if}
		!{if $caldata[item].data[x].venue_other_url}
			<a href="!{$caldata[item].data[x].venue_other_url}" target="_blank">!{$caldata[item].data[x].venue_other_url}</a><br/>
		!{/if}
		!{if $caldata[item].data[x].related_array}
			<br/>
			!{assign var='links' value=$caldata[item].data[x].related_array}
			!{section name="b" loop=$links}
			<li style="color:##25588B;padding-left:10px;"><a href="full_content.php?article_id=!{$links[b]}&full=yes&pbr=1">More Info</a></li>
			!{/section}
		!{/if}
		
		</p>

!{/section}



	<br clear="all">
	</div>
	!{/if}
!{/section}
</td>
</tr>
</tbody>
</table>


!{assign var='counter' value=0}
<script language="javascript">
!{section name="jsc" loop=$caldata}
!{if $caldata[jsc].data}
divArray[!{$counter}] = "data_!{$caldata[jsc].down}";
!{math equation="a+b" a=$counter b=1 assign='counter'}
!{/if}
!{/section}

function divDisplay(day){
	for (var n = 0;n<divArray.length;n++){
		document.getElementById(divArray[n]).style.display='none';
	}
	document.getElementById("data_"+day).style.display='';
}
</script>


!{if $smarty.get.m eq $smarty.now|date_format:"%m"}
<script language="javascript">
onload = document.getElementById('data_!{$smarty.now|date_format:"%d"}').style.display='';
</script>
!{/if}





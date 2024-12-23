<div id="calendar_frame">
<div id="calendar_name"><a class="link" href="calendar_detail.php?calid=!{$smarty.get.calid}&m=!{$smarty.get.m}&y=!{$smarty.get.y}&d=d!{if $smarty.get.type eq 'square'}&type=square!{/if}"><<</a>&nbsp;&nbsp;&nbsp;!{$smarty.get.m}/!{$smarty.get.y}&nbsp;&nbsp;&nbsp;<a class="link" href="calendar_detail.php?calid=!{$smarty.get.calid}&m=!{$smarty.get.m}&y=!{$smarty.get.y}&d=u!{if $smarty.get.type eq 'square'}&type=square!{/if}">>></a></div>

!{if $caldata}
!{section name="c" loop=$caldata}
!{if $caldata[c].down }
<div id="calendar_list" style="background-color:!{cycle values="#FFFFFF,#DFE5FF"}"><b>!{$caldata[c].dow|@ucfirst}</b> !{$caldata[c].down}, !{$smarty.get.y}<br/>
!{if $caldata[c].data}
	!{section name="entries" loop=$caldata[c].data}
		<p style="margin-left:10px;">
		<li>
		<b>!{$caldata[c].data[entries].title}</b><br/>
		!{$caldata[c].data[entries].description}<br/><br/>
		!{if $caldata[c].data[entries].venue neq ''}
			!{$caldata[c].data[entries].venue|stripslashes}<br/>
		!{/if}

		!{if $caldata[c].data[entries].venue_address neq ''}
			!{$caldata[c].data[entries].venue_address}<br/>
			!{$caldata[c].data[entries].venue_city}, !{$caldata[c].data[entries].venue_state} !{$caldata[c].data[entries].venue_zip}<br/><br/>
		!{/if}
		!{if $caldata[c].data[entries].venue_phone neq ''}
			Phone: !{$caldata[c].data[entries].venue_phone}<br/>
		!{/if}
		!{if $caldata[c].data[entries].venue_url neq ''}
			<a href="!{$caldata[c].data[entries].venue_url}" target="_blank">!{$caldata[c].data[entries].venue_url}</a><br/>
		!{/if}
		!{if $caldata[c].data[entries].venue_other_url neq ''}
			<a href="!{$caldata[c].data[entries].venue_other_url}" target="_blank">!{$caldata[c].data[entries].venue_other_url}</a><br/>
		!{/if}
		
		</li>
		</p>
	!{/section}
!{/if}
</div>
!{/if}
!{/section}
!{/if}

</div>
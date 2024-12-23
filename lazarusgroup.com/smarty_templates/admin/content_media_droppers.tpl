!{if $mkd}

<p id="namedropper">
<span class="namedropperh2">Media Dropper</span><br/>
!{section name="item" loop=$mkd}
!{$mkd[item]->name}<br/>
&nbsp;&nbsp;<span style="color:#CC0000;">!{$mkd[item]->media_category}<br/></span>
!{/section}
</p>
!{/if}
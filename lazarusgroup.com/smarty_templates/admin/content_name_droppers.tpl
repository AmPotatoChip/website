!{if $cnd}

<p id="namedropper">
<span class="namedropperh2">Name Dropper</span><br/>
!{section name="item" loop=$cnd}
!{$cnd[item]}<br/>
!{/section}
</p>
!{/if}
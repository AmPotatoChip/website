!{if $keycd}

<p id="namedropper">
<span class="namedropperh2">Keychain Dropper</span><br/>
!{section name="item" loop=$keycd}
!{$keycd[item]}<br/>
!{/section}
</p>
!{/if}
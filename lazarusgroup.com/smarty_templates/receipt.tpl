<h2>Donation Receipt</h2>

<p>
<strong>Transaction ID:</strong> !{$rdata.id}<br/>
<strong>Donation Amount:</strong> $!{$rdata.donation_amount} USD<br/>

<br/>

!{$rdata.name}<br/>
!{$rdata.address}<br/>
!{$rdata.city}, !{$rdata.state} !{$rdata.zip}<br/><br/>

!{if $rdata.interested_in}
<strong>Interested In:</strong>

!{section name="x" loop=$rdata.interested_in}
!{$rdata.interested_in[x]}
!{/section}
<br/><br/>
!{/if}

<strong>Name on Credit Card:</strong> !{$rdata.cc_name}<br/>
<strong>Credit Card Type:</strong> !{$rdata.cc_type}<br/>
<strong>Credit Card Number:</strong> !{$rdata.cc_num}<br/>
<strong>Credit Card Expiration Date:</strong> !{$rdata.cc_exp}<br/><br/>




</p>

<p>
Thank you for supporting Deb Hermann for Kansas City.
If you have any questions please contact the office at 816.721.6454 or send us an email at <a href="mailto:staff@debhermannforkansascity.com">staff@debhermannforkansascity.com</a>
</p>
<!--
<pre>
!{$rdata|@print_r}
</pre>-->
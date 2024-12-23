!{if $page_breaks}

<div id="pagination">
!{assign_adv var="run_stop" value="3"}


!{assign_adv var='highest_page' value=$page_breaks}




<br/>

!{assign_adv var='page_no' value="range(1,$page_breaks)"}
!{if $smarty.get.pbr}
!{math equation="a-b" a=$smarty.get.pbr b=1 assign="marker"}
!{else}
!{assign var="marker" value="1"}
!{/if}

<b>Page:</b>&nbsp;&nbsp;
!{if $smarty.get.pbr > 1}
!{math equation="a-b" a=$smarty.get.pbr b=1 assign="previous"}
<a href="full_content.php?article_id=!{$smarty.get.article_id}&full=yes&pbr=!{$previous}"><<</a> 

!{/if}

!{math equation="a-b" a=$smarty.get.pbr b=1 assign='page_run'}
!{if $page_run > 0}
<a href="?article_id=!{$smarty.get.article_id}&full=yes&pbr=!{$page_run}" !{if $smarty.get.pbr eq $page_run}style="font-weight:bold;color:#CC0000;background-color:#fff;"!{/if}>!{$page_run}</a>&nbsp;
!{/if}

!{math equation="a+b" a=$page_run b=1 assign='page_run'}
!{if $page_run<=$highest_page}
<a href="?article_id=!{$smarty.get.article_id}&full=yes&pbr=!{$page_run}" !{if $smarty.get.pbr eq $page_run}style="font-weight:bold;color:#CC0000;background-color:#fff;"!{/if}>!{$page_run}</a>&nbsp;
!{/if}

!{math equation="a+b" a=$page_run b=1 assign='page_run'}
!{if $page_run<=$highest_page}
<a href="?article_id=!{$smarty.get.article_id}&full=yes&pbr=!{$page_run}" !{if $smarty.get.pbr eq $page_run}style="font-weight:bold;color:#CC0000;background-color:#fff;"!{/if}>!{$page_run}</a>&nbsp;
!{/if}

!{math equation="a+b" a=$smarty.get.pbr b=1 assign="next"}
!{if $next<$highest_page} 
<a href="full_content.php?article_id=!{$smarty.get.article_id}&full=yes&pbr=!{$next}">>></a>
!{/if}


</div>
!{/if}
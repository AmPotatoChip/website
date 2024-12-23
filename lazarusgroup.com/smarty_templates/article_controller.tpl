!{if $content_array}

	!{if !$subnav}
		!{assign var=subnav value="other"}
	!{/if}

	!{assign var='conf' value="$content_array.config}
	!{assign var="cont" value="$content_array.content}


	!{section name="x" loop="$cont"}

		!{if $smarty.get.full}

			<div id="actionline">
				<a href="#" onclick="history.back();">Back to Contents</a>
				<a href="#" onclick="window.print();return false;">Print Article</a>
				<a href="email_article.php?article_id=!{$smarty.get.article_id}" target="_blank">Email Article</a>
			</div>

		!{/if}

		<!-- Start -->
		!{if $conf.set_subhead eq 'true'}<h3>!{$cont[x]->subhead}</h3>!{/if}
		!{if $conf.set_byline eq 'true'}<div class="byline">!{$cont[x]->byline}</div>!{/if}
		!{if $conf.set_dateline eq 'true'}<div class="dateline">Dateline:  !{$cont[x]->dateline|date_format:"%h %d, %Y"}</div>!{/if}

		!{if $conf.set_exerpt eq 'true' && !$smarty.get.full  && $cont[x]->exerpt|count_characters>10}
			!{$cont[x]->exerpt}
		!{else}
			!{include file="article_pagination.tpl"}
				!{$cont[x]->full_content|stripslashes}
			!{include file="article_pagination.tpl"}
		!{/if}

	!{if !$smarty.get.full && $conf.set_exerpt neq 'false' && $cont[x]->exerpt|count_characters>10}
			<div class="readmore"><a href="/full_content.php?article_id=!{$cont[x]->id}&full=yes&pbr=1">!{$cont[x]->headline} continued &#187; </a></div>
			<div class="hr"></div>
		!{/if}
		<br clear="all">
		<!-- End -->

	!{/section}

!{/if}
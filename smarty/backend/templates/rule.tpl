{extends $sParentTemplate}

{block 'content'} 

{if is_object($oRule)}
The rule is named {$oRule->getRulName()}
{else}
This rule doesn't exist !
{/if}


{/block}
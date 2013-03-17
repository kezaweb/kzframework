{extends $sParentTemplate}

{block 'content'} 

<ul>
 {foreach from=$aoRule key=key item=oRule}
 <li>{$oRule->getRulName()}</li>
 {/foreach}
</ul>



{/block}
{extends $sParentTemplate}

{block 'content'} 
You will to edit tree as soon as possible...
<ul>
 {foreach from=$aoNodeTree key=key item=oNodeTree}
 <li>{$oNodeTree->getNdtName()}</li>
 {/foreach}
</ul>



{/block}

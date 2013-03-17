{extends $sParentTemplate}

{block 'content'} 
You will to edit templates as soon as possible...
<ul>
 {foreach from=$aoTemplate key=key item=oTemplate}
 <li>{$oTemplate->getTplName()}</li>
 {/foreach}
</ul>



{/block}

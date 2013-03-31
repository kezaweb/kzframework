{extends $sParentTemplate}

{block 'content'} 
You will to edit templates as soon as possible...
<ul>
 {foreach from=$aoTemplate key=key item=oTemplate}
 <li>{$oTemplate->getTplName()}</li>
 {/foreach}
</ul>

<p><span class="icon-leaf"></span></p>

<p style="color:#00a8d2"><span class="icon-leaf icon-2x"></span></p>

<p style="color:#bfbfbf"><span class="icon-leaf icon-2x"></span></p>

<p><i class="icon-stethoscope icon-4x"></i> icon-camera-retro</p>

{/block}

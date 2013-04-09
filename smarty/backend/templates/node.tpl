{extends $sParentTemplate}

{block 'content'} 

<h2><ins class="icon-{$oNode->getNodTypeForBootstrap()}"></ins>{$oNode->getNodTitle()}</h2>

{if {$oNode->isDrive()}}
Website base is created. You can edit template Layout.

{elseif {$oNode->isCreating()}}

<div id="menu-creating">
	<a class="btn btn-medium" rel="tooltip" href="/backend/{$oNode->getNodTypeForUser()}" data-placement="bottom" 
	   data-id="{$oNode->getId()}" id="create-physical" data-toggle="tooltip" 
	   data-original-title="This action will to create a {$oNode->getNodTypeForUser()}" data-target="kzf-sub-content-right"
	   data-jData="{$oNode->getJsonToCreateAsSimple()}">
	   		<ins class="icon-{$oNode->getNodTypeForBootstrap()}"></ins>Create
	</a>
	<a class="btn btn-medium" rel="tooltip" href="/backend/{$oNode->getNodTypeForUser()}" data-placement="bottom" 
	   data-id="{$oNode->getId()}"  id="create-cloud" data-toggle="tooltip"  data-target="kzf-sub-content-right"
	   data-original-title="This action will to create a {$oNode->getNodTypeForUser()} as cloud. 
	   You can make this if you won't place your {$oNode->getNodTypeForUser()} at this tree level. You can after use as cloud"
	   data-jData="{$oNode->getJsonToCreateAsCloud()}">
	   		<ins class="icon-{$oNode->getNodTypeForBootstrap()}"></ins>Create as cloud
	</a>
	<a class="btn btn-medium" rel="tooltip" href="/backend/{$oNode->getNodTypeForUser()}" data-placement="bottom" 
	   data-id="{$oNode->getId()}" id="create-virtual" data-toggle="tooltip"  data-target="kzf-sub-content-right"
	   data-original-title="This action will to create a {$oNode->getNodTypeForUser()} as virtual node. 
	   You should link this node with an existing node."
	   data-jData="{$oNode->getJsonToCreateAsVirtual()}">
	   		<ins class="icon-{$oNode->getNodTypeForBootstrap()}"></ins>Create as virtual
	</a>
</div>
{/if}
<script type="text/javascript">
<!--
$(document).ready(function(){
	// Link to ajax make a unbind. You alway call him before all process
	linkToAjax();
	loadTooltip();
	loadListenerCreating();
	loadCurrentJsTreeClicked({$oNode->getId()});
});
-->
</script>
<div id="wrapper-kzf-sub-content-right" class="wrapper">
		<!-- load box -->
		<div id="load-kzf-sub-content-right">
			{html_image file='img/35load.gif'}&nbsp; &nbsp;Loading page...
		</div>
</div>
{/block}


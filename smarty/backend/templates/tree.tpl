{extends $sParentTemplate}

{block 'content'} 
  <div class="row-fluid">
    <div class="span2">
		<!-- the tree container (notice NOT an UL node) -->
		<div id="tree" class="tree"></div>
		    
    </div>
    <div class="span10">
      Choose a branch or a leaf
    </div>
  </div>
  
  
{literal}
<!-- JavaScript neccessary for the tree -->
<script type="text/javascript" class="source below">
$(function () {
service_node = "/backend/node";
root_id = {/literal}{$root_id}{literal};
kzf_css = "/backend/css/kzf.css";
buildTree(service_node, root_id, kzf_css);
});
</script>
<script type="text/javascript" class="source below">
// Code for the menu buttons
$(function () { 
	$("#mmenu input").click(function () {
		switch(this.id) {
			case "add_default":
			case "add_folder":
				$("#demo").jstree("create", null, "last", { "attr" : { "rel" : this.id.toString().replace("add_", ""), "class" : "jstree-folder" } });
				break;
			case "search":
				$("#demo").jstree("search", document.getElementById("text").value);
				break;
			case "text": break;
			default:
				$("#demo").jstree(this.id);
				break;
		}
	});
});
</script>
{/literal}
  
  
  
{/block}

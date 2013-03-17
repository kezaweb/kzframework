{extends $sParentTemplate}

{block 'content'} 
  <div class="row-fluid">
    <div class="span2">
		<!-- the tree container (notice NOT an UL node) -->
		<div id="tree" class="tree"></div>
		<div style="height:30px; text-align:center; display:none;">
			<input type="button" style='width:170px; height:24px; margin:5px auto;' value="reconstruct" onclick="$.get('./processing/server.php?reconstruct', function () { $('#demo').jstree('refresh',-1); });" />
			<input type="button" style='width:170px; height:24px; margin:5px auto;' value="refresh" onclick="$('#demo').jstree('refresh',-1);" />
		</div>
		<!-- 
		<div id='alog' style="border:1px solid gray; padding:5px; height:100px; margin-top:15px; overflow:auto; font-family:Monospace;"></div> -->
		    
    </div>
    <div class="span10">
      Choose a branch or a leaf
    </div>
  </div>
  
  
{literal}
<!-- JavaScript neccessary for the tree -->
<script type="text/javascript" class="source below">
$(function () {

$("#tree")
	.bind("before.jstree", function (e, data) {
		$("#alog").append(data.func + "<br />");
	})
	.jstree({ 
		// List of active plugins
		"plugins" : [ 
			"themes","json_data","ui","crrm","cookies","dnd","search","types","hotkeys","contextmenu" 
		],

		"themes": {
	        "theme": "kzf",
	        "dots": true,
	        "icons": true,
	        "url": "/backend/css/kzf.css"
	      },
		// I usually configure the plugin that handles the data first
		// This example uses JSON as it is most common
		"json_data" : { 
			// This tree is ajax enabled - as this is most common, and maybe a bit more complex
			// All the options are almost the same as jQuery's AJAX (read the docs)
			"ajax" : {
				// the URL to fetch the data
				"url" : "./processing/server.php",
				// the `data` function is executed in the instance's scope
				// the parameter is the node being loaded 
				// (may be -1, 0, or undefined when loading the root nodes)
				"data" : function (n) { 
					// the result is fed to the AJAX request `data` option
					return { 
						"operation" : "get_children", 
						"id" : n.attr ? n.attr("id").replace("node_","") : 1
								
					}; 
				}
			}
		},
		// Configuring the search plugin
		"search" : {
			// As this has been a common question - async search
			// Same as above - the `ajax` config option is actually jQuery's AJAX object
			"ajax" : {
				"url" : "./processing/server.php",
				// You get the search string as a parameter
				"data" : function (str) {
					return { 
						"operation" : "search", 
						"search_str" : str 
					}; 
				}
			}
		},

		"contextmenu" : {
			"items" : {
				"create" : null,
				"show": {
					"separator_before"	: false,
					"separator_after"	: false,
					"label"				: "Show",
					"action"			: function (obj) { AjaxLoad("processing/treeManager.php?node="+obj.attr('id').replace("node_",""), "action=GET", $('#tree_edit')); }
				},
				"add_branch": {
					"separator_before"	: false,
					"separator_after"	: false,
					"label"				: "Add Branch",
					"action"			: function (obj) { if($(obj).attr('rel')=='folder'){ this.create(obj, "last", {"attr" : { "rel" : "folder"}, "data": "New branch"}); } }
				},
				"add_leaf": {
					"separator_before"	: false,
					"separator_after"	: false,
					"label"				: "Add Leaf",
					"action"			: function (obj) { if($(obj).attr('rel')=='folder'){ this.create(obj, "last", {"attr" : { "rel" : "default"}, "data": "New leaf"}); } }					
				},
				"new_rename" : {
					"separator_before"	: false,
					"separator_after"	: false,
					"label"				: "Rename",
					"action"			: function (obj) { this.rename(obj); }
				},
				"new_remove" : {
					"separator_before"	: false,
					"icon"				: false,
					"separator_after"	: false,
					"label"				: "Delete",
					"action"			: function (obj) { if(this.is_selected(obj)) { this.remove(); } else { this.remove(obj); } }
				},
				"rename" : null, 
				"remove" : null, 
				"ccp" : null
				
			}
		},
		// UI & core - the nodes to initially select and open will be overwritten by the cookie plugin

		// the UI plugin - it handles selecting/deselecting/hovering nodes
		"ui" : {
			// this makes the node with ID node_4 selected onload
			"initially_select" : [ "node_4" ]
		},
		// the core plugin - not many options here
		"core" : { 
			// just open those two nodes up
			// as this is an AJAX enabled tree, both will be downloaded from the server
			"initially_open" : [ "node_2" , "node_3" ] 
		}
	})
	.bind("create.jstree", function (e, data) {
		$.post(
			"./processing/server.php", 
			{ 
				"operation" : "create_node", 
				"id" : data.rslt.parent.attr("id").replace("node_",""), 
				"position" : data.rslt.position,
				"title" : data.rslt.name,
				"type" : data.rslt.obj.attr("rel")
			}, 
			function (r) {
				if(r.status) {
					$(data.rslt.obj).attr("id", "node_" + r.id);
				}
				else {
					$.jstree.rollback(data.rlbk);
				}
			}
		);
	})
	.bind("remove.jstree", function (e, data) {
		data.rslt.obj.each(function () {
			$.ajax({
				async : false,
				type: 'POST',
				url: "./processing/server.php",
				data : { 
					"operation" : "remove_node", 
					"id" : this.id.replace("node_","")
				}, 
				success : function (r) {
					if(!r.status) {
						data.inst.refresh();
					}
				}
			});
		});
	})
	.bind("rename.jstree", function (e, data) {
		$.post(
			"./processing/server.php", 
			{ 
				"operation" : "rename_node", 
				"id" : data.rslt.obj.attr("id").replace("node_",""),
				"title" : data.rslt.new_name
			}, 
			function (r) {
				if(!r.status) {
					$.jstree.rollback(data.rlbk);
				}
			}
		);
	})
	.bind("move_node.jstree", function (e, data) {
		data.rslt.o.each(function (i) {
			$.ajax({
				async : false,
				type: 'POST',
				url: "./processing/server.php",
				data : { 
					"operation" : "move_node", 
					"id" : $(this).attr("id").replace("node_",""), 
					"ref" : data.rslt.cr === -1 ? 1 : data.rslt.np.attr("id").replace("node_",""), 
					"position" : data.rslt.cp + i,
					"title" : data.rslt.name,
					"copy" : data.rslt.cy ? 1 : 0
				},
				success : function (r) {
					if(!r.status) {
						$.jstree.rollback(data.rlbk);
					}
					else {
						$(data.rslt.oc).attr("id", "node_" + r.id);
						if(data.rslt.cy && $(data.rslt.oc).children("UL").length) {
							data.inst.refresh(data.inst._get_parent(data.rslt.oc));
						}
					}
					$("#analyze").click();
				}
			});
		});
	});

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

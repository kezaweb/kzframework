// Ajax listener
(function($){
 
  $(document).ready(function(){    
    $('a').click(function(e){
    	    e.preventDefault();
    	    var self = $(this);
    	        url = self.attr('href');
    	        target = self.data('target');
    	        group = self.data('group');
    	        aGroup = group.split('-');
    	        if (aGroup[0]=='active') {
    	        	activeLink(self);
    	        }
    	    $.ajax({
    	        url: url,
    	        cache : false,
    	        beforeSend: function() {
    	        	$('#'+target).html('');
    	        	$('#load-'+target).show();
    	        },
    	        success: function(data){ 
    	                       if (target !== 'undefined'){
    	                          $('#'+target).html( data );
    	                          $('#load-'+target).hide();
    	                       }
    	                 }
    	    });
        return false;
	});
    
  });
 
})(jQuery);

// This function allow used active class of bootstrap
activeLink = function(link)
{
	console.debug('a[data-group="'+link.data('group')+'"]');
	$('a[data-group="'+link.data('group')+'"]').each(function() {
		$(this).parent().attr('class','')
	});
	link.parent().attr('class','active');
}

// This function build the jsTree
buildTree = function(service_node, root_id, kzf_css)
{
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
	        "url": kzf_css
	      },
		// I usually configure the plugin that handles the data first
		// This example uses JSON as it is most common
		"json_data" : { 
			// This tree is ajax enabled - as this is most common, and maybe a bit more complex
			// All the options are almost the same as jQuery's AJAX (read the docs)
			"ajax" : {
				// the URL to fetch the data
				"url" : service_node,
				"method" : "POST",
				// the `data` function is executed in the instance's scope
				// the parameter is the node being loaded 
				// (may be -1, 0, or undefined when loading the root nodes)
				"data" : function (n) { 
					// the result is fed to the AJAX request `data` option
					id = n.attr ? n.attr("id").replace("node_","") : root_id;
					return {"jData": '{"action" : "read", "id" : '+id+', "crud_from" : "tree"}'};
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
					"action"			: function (obj) { return false; }
				},
				"add_branch": {
					"separator_before"	: false,
					"separator_after"	: false,
					"label"				: "Add Branch",
					"action"			: function (obj) { if($(obj).attr('rel')!='default'){ this.create(obj, "last", {"attr" : { "rel" : "folder"}, "data": "New branch"}); } }
				},
				"add_leaf": {
					"separator_before"	: false,
					"separator_after"	: false,
					"label"				: "Add Leaf",
					"action"			: function (obj) { if($(obj).attr('rel')!='default'){ this.create(obj, "last", {"attr" : { "rel" : "default"}, "data": "New leaf"}); } }					
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
		id_prev_sibling = null;
		objectPrev = data.rslt.obj.prev();
		if (objectPrev.attr('id') != undefined && objectPrev.attr('id') !== false) id_prev_sibling = (data.rslt.obj.prev().attr('id').replace("node_","")); 
		$.post(
			service_node, 
			{ "jData" : '{"action" : "create",'+
						 '"id_parent" : '+data.rslt.parent.attr("id").replace("node_","")+', '+
						 '"id_prev_sibling" : '+id_prev_sibling+','+
						 '"nod_title" : "'+data.rslt.name+'",'+
						 '"nod_type" : "'+data.rslt.obj.attr("rel")+'"}'
			}, 
			function (r) {
				if(r.data_response.status) {
					$(data.rslt.obj).attr("id", "node_" + r.data_response.id);
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
				url: service_node,
				data : { 
					"jData" : '{"action" : "delete",'+
							   '"id" : '+this.id.replace("node_","")+"}"
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
			service_node, 
			{ 
				"jData" : '{"action" : "update",'+
						   '"id" : '+data.rslt.obj.attr("id").replace("node_","")+', '+
						   '"nod_title" : "'+data.rslt.new_name+'"}'
			}, 
			function (r) {
				if(!r.data_response.status) {
					$.jstree.rollback(data.rlbk);
				}
			}
		);
	})
	.bind("move_node.jstree", function (e, data) {
		id_prev_sibling = null;
		objectPrev = data.rslt.o.prev();
		if (objectPrev != undefined && objectPrev.attr('id') != undefined && objectPrev.attr('id') !== false) id_prev_sibling = (objectPrev.attr('id').replace("node_","")); 
		if (data.rslt.np.attr('rel') == 'default') {
			$.jstree.rollback(data.rlbk);
			return false;
		}
	
		data.rslt.o.each(function (i) {
			$.ajax({
				async : false,
				type: 'POST',
				url: service_node,
				data : { 
					"jData" : '{"action" : "update",'+
							   '"id" : '+$(this).attr("id").replace("node_","")+', '+
							   '"id_parent" : '+(data.rslt.cr === -1 ? 1 : data.rslt.np.attr("id").replace("node_",""))+', '+
							   '"id_prev_sibling" : '+id_prev_sibling+'}'
				},
				success : function (r) {
					if(!r.data_response.status) {
						$.jstree.rollback(data.rlbk);
					}
					else {
						$(data.rslt.oc).attr("id", "node_" + r.data_response.id);
						if(data.rslt.cy && $(data.rslt.oc).children("UL").length) {
							data.inst.refresh(data.inst._get_parent(data.rslt.oc));
						}
					}
				}
			});
		});
	});
}
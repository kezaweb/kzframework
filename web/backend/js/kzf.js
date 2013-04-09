// Fonction simplify
(function($) {
  $.fn.down = function() {
    var el = this[0] && this[0].firstChild;
    while (el && el.nodeType != 1)
      el = el.nextSibling;
    return $(el);
  };
})(jQuery);

// Ajax listener
(function($){
 
  $(document).ready(function(){
	linkToAjax();
  });
  
  linkToAjax = function() {
	  $('a').unbind("click").click(function(e){
  	    e.preventDefault();
  	    var self = $(this);
  	        url = self.attr('href');
  	        target = self.data('target');
  	        group = self.data('group');
  	        if (self.data('jdata')!='') {
  	        	jData = self.data('jdata');
  	        }
  	        if (typeof(group)!='undefined') {
	    	        aGroup = group.split('-');
	    	        if (aGroup[0]=='active') {
	    	        	activeLink(self);
	    	        }
  	        }
  	        // We send a string json to webserver
  	        jData = JSON.stringify(jData);
  	        call(url, target, jData);
      return false;
	});
  }
  
  call = function(url, target, jData){
	    $.ajax({
	        url: url,
   //       cache : false,
	        method: (typeof(jData)!='undefined')?'POST':'GET',
	        data: (typeof(jData)!='undefined')?"jData="+jData:'',
	        beforeSend: function() {
	        	$('#wrapper-'+target).show();
	        	$('#load-'+target).show();
	        },
	        success: function(data){ 
	                       if (target !== 'undefined'){
	                          $('#'+target).html( data );
	                          $('#load-'+target).hide();
	          	        	  $('#wrapper-'+target).hide();
	                       }
	                 },
	        error: function(json){
	        	 errorJson = $.parseJSON(json.responseText);
	        	 alert(errorJson.message);
                 $('#load-'+target).hide();
 	        	 $('#wrapper-'+target).hide();
	        }
	    });
  }

 
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

// This function play tooltip 
loadTooltip = function(){
	  if ($("[rel=tooltip]").length) {
	      $("[rel=tooltip]").tooltip();
	  }
}

// Graphics functions to create cloud and virtual
createPhysical = function(id) {
	$('#node_'+id).attr('data-virtual','0');
	$('#node_'+id).attr('data-cloud','0');
}

createVirtual = function(id) {
	$('#node_'+id).attr('data-virtual','1');
	$('#node_'+id).attr('data-cloud','0');
}

createCloud = function(id) {
	$('#node_'+id).attr('data-virtual','0');
	$('#node_'+id).attr('data-cloud','1');
}

loadListenerCreating = function() {
	// Listener creating button
	$('#create-physical').click(function(){
		createPhysical($(this).data('id'));
	});

	$('#create-virtual').click(function(){
		createVirtual($(this).data('id'));
	});

	$('#create-cloud').click(function(){
		createCloud($(this).data('id'));
	});
}

loadCurrentJsTreeClicked = function(id) {
	// To start, we disable all class jstree-clicked
	$('.jstree-clicked').each(function(){
		$(this).attr('class','');
	});
	
	$('#node_'+id+'>a').attr('class', 'jstree-clicked');
}

$.bootstrap = {};
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
			"themes","json_data","ui","crrm","cookies","dnd","search","types","hotkeys","contextmenu_bootstrap" 
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
				},
				"success" : function (n) {
					return n.data_response;
				},
				"error" : function (n) {
					obj = $.parseJSON(n.responseText);
					alert(obj.message);
				}
			}
		},
	
		"contextmenu_bootstrap" : {
			"items" : {
				"create" : null,
				"go_to": {
					"separator_before"	: false,
					"separator_after"	: false,
					"label"				: "Go to",
					"icon"              : "icon-book",
					"action"			: function (obj) { call(service_node, 'kzf-sub-content-right', '{"action": "read", "id": '+$(obj).attr('id').replace("node_","")+', "crud_from": "node" }'); return false; }
				},
				"add_branch": {
					"separator_before"	: false,
					"separator_after"	: false,
					"label"				: "Add Branch",
					"icon"              : "icon-folder-open",
					"action"			: function (obj) { if($(obj).attr('rel')!='default'){ this.create(obj, "last", {"attr" : { "rel" : "folder"}, "data": "New branch"}); } }
				},
				"add_leaf": {
					"separator_before"	: false,
					"separator_after"	: false,
					"label"				: "Add Leaf",
					"icon"              : "icon-leaf",
					"action"			: function (obj) { if($(obj).attr('rel')!='default'){ this.create(obj, "last", {"attr" : { "rel" : "default"}, "data": "New leaf"}); } }					
				},
				"new_rename" : {
					"separator_before"	: false,
					"separator_after"	: false,
					"label"				: "Rename",
					"icon"              : "icon-edit",
					"action"			: function (obj) { this.rename(obj); }
				},
				"new_remove" : {
					"separator_before"	: false,
					"icon"				: false,
					"separator_after"	: false,
					"label"				: "Delete",
					"icon"              : "icon-trash",
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
	.bind("open_node.jstree close_node.jstree after_open.jstree loaded.jstree create_node.jstree", function (e, data) {
		loadCurrentIcone();
		listenerTreeLoading();
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
		loadCurrentIcone();
		listenerTreeLoading();
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

loadCurrentIcone = function(){
	$('.jstree-kzf li[rel="default"] > a > ins').attr('class', 'icon-leaf');
	$('.jstree-kzf li[rel="drive"] > a > ins').attr('class', 'icon-globe');
	$('.jstree-kzf li[rel="folder"].jstree-closed > a > ins').attr('class', 'icon-folder-close');
	$('.jstree-kzf li[rel="folder"].jstree-leaf > a > ins').attr('class', 'icon-folder-close');
	$('.jstree-kzf li[rel="folder"].jstree-open > a > ins').attr('class', 'icon-folder-open');
	$('.jstree-kzf .jstree-closed > ins').attr('class', 'icon-plus');
	$('.jstree-kzf .jstree-open > ins').attr('class', 'icon-minus');
	$('.jstree-kzf .jstree-closed > ins.icon-plus').attr('style', 'cursor:pointer');
	$('.jstree-kzf .jstree-open > ins.icon-minus').attr('style', 'cursor:pointer');		
};

listenerTreeLoading = function(){
	$('.icon-plus').click(function(){
	    $(this).next().down().addClass('icon-spinner icon-spin');
		$(this).next().down().removeClass('icon-folder-close');
		$(this).removeClass('icon-plus');
		$(this).addClass('icon-minus');
	});

	$('.icon-minus').click(function(){
	    $(this).next().down().removeClass('icon-spinner icon-spin icon-folder-open');
		$(this).next().down().addClass('icon-folder-close');
		$(this).removeClass('icon-minus');
		$(this).addClass('icon-plus');
	});
};



/* 
 * jsTree contextmenu plugin
 */
(function ($) {
	$.vakata.context = {
		hide_on_mouseleave : false,

		cnt		: $("<div id='vakata-contextmenu' />"),
		vis		: false,
		tgt		: false,
		par		: false,
		func	: false,
		data	: false,
		rtl		: false,
		show	: function (s, t, x, y, d, p, rtl) {
			$.vakata.context.rtl = !!rtl;
			var html = $.vakata.context.parse(s), h, w;
			if(!html) { return; }
			$.vakata.context.vis = true;
			$.vakata.context.tgt = t;
			$.vakata.context.par = p || t || null;
			$.vakata.context.data = d || null;
			$.vakata.context.cnt
				.html(html)
				.css({ "visibility" : "hidden", "display" : "block", "left" : 0, "top" : 0 });

			if($.vakata.context.hide_on_mouseleave) {
				$.vakata.context.cnt
					.one("mouseleave", function(e) { $.vakata.context.hide(); });
			}

			h = $.vakata.context.cnt.height();
			w = $.vakata.context.cnt.width();
			if(x + w > $(document).width()) { 
				x = $(document).width() - (w + 5); 
				$.vakata.context.cnt.find("li > ul").addClass("right"); 
			}
			if(y + h > $(document).height()) { 
				y = y - (h + t[0].offsetHeight); 
				$.vakata.context.cnt.find("li > ul").addClass("bottom"); 
			}

			$.vakata.context.cnt
				.css({ "left" : x, "top" : y })
				.find("li:has(ul)")
					.bind("mouseenter", function (e) { 
						var w = $(document).width(),
							h = $(document).height(),
							ul = $(this).children("ul").show(); 
						if(w !== $(document).width()) { ul.toggleClass("right"); }
						if(h !== $(document).height()) { ul.toggleClass("bottom"); }
					})
					.bind("mouseleave", function (e) { 
						$(this).children("ul").hide(); 
					})
					.end()
				.css({ "visibility" : "visible" })
				.show();
			$(document).triggerHandler("context_show.vakata");
		},
		hide	: function () {
			$.vakata.context.vis = false;
			$.vakata.context.cnt.attr("class","").css({ "visibility" : "hidden" });
			$(document).triggerHandler("context_hide.vakata");
		},
		parse	: function (s, is_callback) {
			if(!s) { return false; }
			var str = "",
				tmp = false,
				was_sep = true;
			if(!is_callback) { $.vakata.context.func = {}; }
			str += "<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dropdownMenu\">";
			$.each(s, function (i, val) {
				if(!val) { return true; }
				$.vakata.context.func[i] = val.action;
				if(!was_sep && val.separator_before) {
					str += "<li class='vakata-separator vakata-separator-before'></li>";
				}
				was_sep = false;
				str += "<li class='" + (val._class || "") + (val._disabled ? " jstree-contextmenu-disabled " : "") + "'>";
				str += "<a href='#' rel='" + i + "'>";
				str += "<ins ";
				if(val.icon && val.icon.indexOf("/") === -1) { str += " class='" + val.icon + "' "; }
				if(val.icon && val.icon.indexOf("/") !== -1) { str += " style='background:url(" + val.icon + ") center center no-repeat;' "; }
				str += ">&#160;</ins>";
				if(val.submenu) {
					str += "<span style='float:" + ($.vakata.context.rtl ? "left" : "right") + ";'>&raquo;</span>";
				}
				str += val.label + "</a>";
				if(val.submenu) {
					tmp = $.vakata.context.parse(val.submenu, true);
					if(tmp) { str += tmp; }
				}
				str += "</li>";
				if(val.separator_after) {
					str += "<li class='vakata-separator vakata-separator-after'></li>";
					was_sep = true;
				}
			});
			str = str.replace(/<li class\='vakata-separator vakata-separator-after'\><\/li\>$/,"");
			str += "</ul>";
			$(document).triggerHandler("context_parse.vakata");
			return str.length > 10 ? str : false;
		},
		exec	: function (i) {
			if($.isFunction($.vakata.context.func[i])) {
				// if is string - eval and call it!
				$.vakata.context.func[i].call($.vakata.context.data, $.vakata.context.par);
				return true;
			}
			else { return false; }
		}
	};
	$(function () {
		var css_string = '' + 
		'#vakata-contextmenu { display:block; visibility:hidden; left:0; top:-200px; position:absolute; margin:0; padding:0; background:#ebebeb; border:1px solid silver; z-index:10000; *width:180px; } ' + 
		'#vakata-contextmenu ul { *width:180px; } ' + 
		'#vakata-contextmenu ul, #vakata-contextmenu li { margin:0; padding:0; list-style-type:none; display:block; } ' + 
		'#vakata-contextmenu li { line-height:20px; min-height:20px; position:relative; padding:0px; } ' + 
		'#vakata-contextmenu li a { padding:1px 6px; line-height:17px; display:block; text-decoration:none; margin:1px 1px 0 1px; } ' + 
		'#vakata-contextmenu li ins { float:left; width:16px; height:16px; text-decoration:none; margin-right:2px; } ' + 
		'#vakata-contextmenu li a:hover, #vakata-contextmenu li.vakata-hover > a { background:gray; color:white; } ' + 
		'#vakata-contextmenu li ul { display:none; position:absolute; top:-2px; left:100%; background:#ebebeb; border:1px solid gray; } ' + 
		'#vakata-contextmenu .right { right:100%; left:auto; } ' + 
		'#vakata-contextmenu .bottom { bottom:-1px; top:auto; } ' + 
		'#vakata-contextmenu li.vakata-separator { min-height:0; height:1px; line-height:1px; font-size:1px; overflow:hidden; margin:0 2px; background:silver; /* border-top:1px solid #fefefe; */ padding:0; } ';
		$.vakata.css.add_sheet({ str : css_string, title : "vakata" });
		$.vakata.context.cnt
			.delegate("a","click", function (e) { e.preventDefault(); })
			.delegate("a","mouseup", function (e) {
				if(!$(this).parent().hasClass("jstree-contextmenu-disabled") && $.vakata.context.exec($(this).attr("rel"))) {
					$.vakata.context.hide();
				}
				else { $(this).blur(); }
			})
			.delegate("a","mouseover", function () {
				$.vakata.context.cnt.find(".vakata-hover").removeClass("vakata-hover");
			})
			.appendTo("body");
		$(document).bind("mousedown", function (e) { if($.vakata.context.vis && !$.contains($.vakata.context.cnt[0], e.target)) { $.vakata.context.hide(); } });
		if(typeof $.hotkeys !== "undefined") {
			$(document)
				.bind("keydown", "up", function (e) { 
					if($.vakata.context.vis) { 
						var o = $.vakata.context.cnt.find("ul:visible").last().children(".vakata-hover").removeClass("vakata-hover").prevAll("li:not(.vakata-separator)").first();
						if(!o.length) { o = $.vakata.context.cnt.find("ul:visible").last().children("li:not(.vakata-separator)").last(); }
						o.addClass("vakata-hover");
						e.stopImmediatePropagation(); 
						e.preventDefault();
					} 
				})
				.bind("keydown", "down", function (e) { 
					if($.vakata.context.vis) { 
						var o = $.vakata.context.cnt.find("ul:visible").last().children(".vakata-hover").removeClass("vakata-hover").nextAll("li:not(.vakata-separator)").first();
						if(!o.length) { o = $.vakata.context.cnt.find("ul:visible").last().children("li:not(.vakata-separator)").first(); }
						o.addClass("vakata-hover");
						e.stopImmediatePropagation(); 
						e.preventDefault();
					} 
				})
				.bind("keydown", "right", function (e) { 
					if($.vakata.context.vis) { 
						$.vakata.context.cnt.find(".vakata-hover").children("ul").show().children("li:not(.vakata-separator)").removeClass("vakata-hover").first().addClass("vakata-hover");
						e.stopImmediatePropagation(); 
						e.preventDefault();
					} 
				})
				.bind("keydown", "left", function (e) { 
					if($.vakata.context.vis) { 
						$.vakata.context.cnt.find(".vakata-hover").children("ul").hide().children(".vakata-separator").removeClass("vakata-hover");
						e.stopImmediatePropagation(); 
						e.preventDefault();
					} 
				})
				.bind("keydown", "esc", function (e) { 
					$.vakata.context.hide(); 
					e.preventDefault();
				})
				.bind("keydown", "space", function (e) { 
					$.vakata.context.cnt.find(".vakata-hover").last().children("a").click();
					e.preventDefault();
				});
		}
	});

	$.jstree.plugin("contextmenu_bootstrap", {
		__init : function () {
			this.get_container()
				.delegate("a", "contextmenu.jstree", $.proxy(function (e) {
						e.preventDefault();
						if(!$(e.currentTarget).hasClass("jstree-loading")) {
							this.show_contextmenu(e.currentTarget, e.pageX, e.pageY);
						}
					}, this))
				.delegate("a", "click.jstree", $.proxy(function (e) {
						if(this.data.contextmenu) {
							$.vakata.context.hide();
						}
					}, this))
				.bind("destroy.jstree", $.proxy(function () {
						// TODO: move this to descruct method
						if(this.data.contextmenu) {
							$.vakata.context.hide();
						}
					}, this));
			$(document).bind("context_hide.vakata", $.proxy(function () { this.data.contextmenu = false; }, this));
		},
		defaults : { 
			select_node : false, // requires UI plugin
			show_at_node : true,
			items : { // Could be a function that should return an object like this one
				"create" : {
					"separator_before"	: false,
					"separator_after"	: true,
					"label"				: "Create",
					"action"			: function (obj) { this.create(obj); }
				},
				"rename" : {
					"separator_before"	: false,
					"separator_after"	: false,
					"label"				: "Rename",
					"action"			: function (obj) { this.rename(obj); }
				},
				"remove" : {
					"separator_before"	: false,
					"icon"				: false,
					"separator_after"	: false,
					"label"				: "Delete",
					"action"			: function (obj) { if(this.is_selected(obj)) { this.remove(); } else { this.remove(obj); } }
				},
				"ccp" : {
					"separator_before"	: true,
					"icon"				: false,
					"separator_after"	: false,
					"label"				: "Edit",
					"action"			: false,
					"submenu" : { 
						"cut" : {
							"separator_before"	: false,
							"separator_after"	: false,
							"label"				: "Cut",
							"action"			: function (obj) { this.cut(obj); }
						},
						"copy" : {
							"separator_before"	: false,
							"icon"				: false,
							"separator_after"	: false,
							"label"				: "Copy",
							"action"			: function (obj) { this.copy(obj); }
						},
						"paste" : {
							"separator_before"	: false,
							"icon"				: false,
							"separator_after"	: false,
							"label"				: "Paste",
							"action"			: function (obj) { this.paste(obj); }
						}
					}
				}
			}
		},
		_fn : {
			show_contextmenu : function (obj, x, y) {
				obj = this._get_node(obj);
				var s = this.get_settings().contextmenu_bootstrap,
					a = obj.children("a:visible:eq(0)"),
					o = false,
					i = false;
				if(s.select_node && this.data.ui && !this.is_selected(obj)) {
					this.deselect_all();
					this.select_node(obj, true);
				}
				if(s.show_at_node || typeof x === "undefined" || typeof y === "undefined") {
					o = a.offset();
					x = o.left;
					y = o.top + this.data.core.li_height;
				}
				i = obj.data("jstree") && obj.data("jstree").contextmenu ? obj.data("jstree").contextmenu : s.items;
				if($.isFunction(i)) { i = i.call(this, obj); }
				this.data.contextmenu = true;
				$.vakata.context.show(i, a, x, y, this, obj, this._get_settings().core.rtl);
				if(this.data.themes) { $.vakata.context.cnt.attr("class", "jstree-" + this.data.themes.theme + "-context"); }
			}
		}
	});
})(jQuery);
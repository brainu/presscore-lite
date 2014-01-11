/**
 * WordPress jQuery-Ajax-Comments v1.0 by Bigfa.
 * URI: http://fatesinger.com/jquery-ajax-comments
 * Thanks Willin Kan
 * Require Jquery 1.7+
 */
jQuery(document).ready(function($) {
	var $commentform = $('#commentform'),		
		txt1 = '<div id="loading">正在提交, 请稍候...</div>',
		txt2 = '<div id="error">#</div>',
		txt3 = '">提交成功', 
		num = 0,
		comm_array =[],
		$comments = $('#comments-title'),
		$cancel = $('#cancel-comment-reply-link'),
		cancel_text = $cancel.text(),
		$submit = $('#commentform #submit'); $submit.attr('disabled', false),
		$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
	$('#comment').after( txt1 + txt2 ); $('#loading').hide(); $('#error').hide();
	
	/** submit */
	$(document).on("submit", "#commentform",
	function() {
		editcode();
		$('#loading').slideDown();
		$submit.attr('disabled', true).fadeTo('slow', 0.5);
		/** Ajax */
		$.ajax( {
			url: um_ajaxurl,
			data: $(this).serialize() + "&action=ajax_comment",
			type: $(this).attr('method'),

			error: function(request) {
				$('#loading').slideUp();
				$('#error').slideDown().html(request.responseText);
				setTimeout(function() {$submit.attr('disabled', false).fadeTo('slow', 1); $('#error').slideUp();}, 3000);
				},

			success: function(data) {
				
				$('#loading').hide();
				comm_array.push($('#comment').val());
				$('textarea').each(function() {this.value = ''});
				var t = addComment, cancel = t.I('cancel-comment-reply-link'), temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId), post = t.I('comment_post_ID').value, parent = t.I('comment_parent').value;

				// comments
				if ( $comments.length ) {
					n = parseInt($comments.text().match(/\d+/));
					$comments.text($comments.text().replace( n, n + 1 ));
				}

				// show comment
				new_htm = '" id="new_comm_' + num + '"></';
				new_htm = ( parent == '0' ) ? ('\n<ol style="clear:both;" class="commentlist' + new_htm + 'ol>') : ('\n<ul class="children' + new_htm + 'ul>');

				ok_htm = '\n<span id="success_' + num + txt3;
				ok_htm += '</span><span></span>\n';

				$('#respond').before(new_htm);
				$('#new_comm_' + num).hide().append(data);
				$('#new_comm_' + num + ' li').append(ok_htm);
				$('#new_comm_' + num).fadeIn(4000);

				$body.animate( { scrollTop: $('#new_comm_' + num).offset().top - 200}, 900);
				countdown(); num++ ;
				cancel.style.display = 'none';
				cancel.onclick = null;
				t.I('comment_parent').value = '0';
				if ( temp && respond ) {
					temp.parentNode.insertBefore(respond, temp);
					temp.parentNode.removeChild(temp)
				}
			}
		}); // end Ajax
		return false;
	}); // end submit

	/** comment-reply.dev.js */
	addComment = {
		moveForm : function(commId, parentId, respondId, postId, num) {
			var t = this, div, comm = t.I(commId), respond = t.I(respondId), cancel = t.I('cancel-comment-reply-link'), parent = t.I('comment_parent'), post = t.I('comment_post_ID');
			t.respondId = respondId;
			postId = postId || false;

			if ( !t.I('wp-temp-form-div') ) {
				div = document.createElement('div');
				div.id = 'wp-temp-form-div';
				div.style.display = 'none';
				respond.parentNode.insertBefore(div, respond)
			}

			!comm ? ( 
				temp = t.I('wp-temp-form-div'),
				t.I('comment_parent').value = '0',
				temp.parentNode.insertBefore(respond, temp),
				temp.parentNode.removeChild(temp)
			) : comm.parentNode.insertBefore(respond, comm.nextSibling);

			$body.animate( { scrollTop: $('#respond').offset().top - 180 }, 400);

			if ( post && postId ) post.value = postId;
			parent.value = parentId;
			cancel.style.display = '';

			cancel.onclick = function() {
				var t = addComment, temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId);

				t.I('comment_parent').value = '0';
				if ( temp && respond ) {
					temp.parentNode.insertBefore(respond, temp);
					temp.parentNode.removeChild(temp);
				}
				this.style.display = 'none';
				this.onclick = null;
				return false;
			};

			try { t.I('comment').focus(); }
			catch(e) {}

			return false;
		},

		I : function(e) {
			return document.getElementById(e);
		}
	}; // end addComment

	var wait = 15, submit_val = $submit.val();
	function countdown() {
		if ( wait > 0 ) {
			$submit.val(wait); wait--; setTimeout(countdown, 1000);
		} else {
			$submit.val(submit_val).attr('disabled', false).fadeTo('slow', 1);
			wait = 15;
	  }
	}
function editcode() {
	var a = "",
	b = $("#comment").val(),
	start = b.indexOf("<code>"),
	end = b.indexOf("</code>");
	if (start > -1 && end > -1 && start < end) {
		a = "";
		while (end != -1) {
			a += b.substring(0, start + 6) + b.substring(start + 6, end).replace(/<(?=[^>]*?>)/gi, "&lt;").replace(/>/gi, "&gt;");
			b = b.substring(end + 7, b.length);
			start = b.indexOf("<code>") == -1 ? -6: b.indexOf("<code>");
			end = b.indexOf("</code>");
			if (end == -1) {
				a += "</code>" + b;
				$("#comment").val(a)
			} else if (start == -6) {
				myFielde += "&lt;/code&gt;"
			} else {
				a += "</code>"
			}
		}
	}
	var b = a ? a: $("#comment").val(),
	a = "",
	start = b.indexOf("<pre>"),
	end = b.indexOf("</pre>");
	if (start > -1 && end > -1 && start < end) {
		a = a
	} else return;
	while (end != -1) {
		a += b.substring(0, start + 5) + b.substring(start + 5, end).replace(/<(?=[^>]*?>)/gi, "&lt;").replace(/>/gi, "&gt;");
		b = b.substring(end + 6, b.length);
		start = b.indexOf("<pre>") == -1 ? -5: b.indexOf("<pre>");
		end = b.indexOf("</pre>");
		if (end == -1) {
			a += "</pre>" + b;
			$("#comment").val(a)
		} else if (start == -5) {
			myFielde += "&lt;/pre&gt;"
		} else {
			a += "</pre>"
		}
	}
}
function grin(a) {
	var b;
	a = " " + a + " ";
	if (document.getElementById("comment") && document.getElementById("comment").type == "textarea") {
		b = document.getElementById("comment")
	} else {
		return false
	}
	if (document.selection) {
		b.focus();
		sel = document.selection.createRange();
		sel.text = a;
		b.focus()
	} else if (b.selectionStart || b.selectionStart == "0") {
		var c = b.selectionStart;
		var d = b.selectionEnd;
		var e = d;
		b.value = b.value.substring(0, c) + a + b.value.substring(d, b.value.length);
		e += a.length;
		b.focus();
		b.selectionStart = e;
		b.selectionEnd = e
	} else {
		b.value += a;
		b.focus()
	}
}

});

jQuery(document).ready(function(a) {
	var l = a(".commentshow"),
	y = fspostid,
	r = fsajaxurl,
	z = '<div id="loading-comments"></div>';
	l.on("click", ".commentnav a",
	function(b) {
		b.preventDefault();
		var b = a(this).attr("href"),
		c = 1,
		j = a("#cancel-comment-reply-link");
		/comment-page-/i.test(b) ? c = b.split(/comment-page-/i)[1].split(/(\/|#|&).*$/)[0] : /cpage=/i.test(b) && (c = b.split(/cpage=/)[1].split(/(\/|#|&).*$/)[0]);
		j.click();
		a.ajax({
			url: r + "?action=fs_ajax_pagenavi&post=" + y + "&page=" + c,
			beforeSend: function() {
				l.html(z)
			},
			error: function(a) {
				alert(a.responseText)
			},
			success: function(b) {
				l.html(b);
				a("body, html").animate({
					scrollTop: l.offset().top - 50
				},
				1e3)
			}
		})
	})
}); (function() {
	function $(id) {
		return document.getElementById(id)
	}
	function quote(authorId, commentBodyId) {
		var author = $(authorId).innerHTML.replace(/<.+?>/gim, "").replace(/\t|\n|\r\n/g, "");
		var comment = $(commentBodyId).innerHTML;
		$("comment").value += '<blockquote><strong><a href="#comment-' + authorId.replace(/author-/, "") + '">' + author + "</a> :</strong>" + comment.replace(/\t/g, "") + "</blockquote>";
		$("comment").focus()
	}
	window["SIMPALED"] = {};
	window["SIMPALED"]["quote"] = quote
})();
jQuery(document).ready(function() {
	zl_style_1 = "cursor:pointer;position:fixed;top:50%;right:50%;margin-top:-80px;margin-right:-80px;width:160px;height:160px;line-height:160px;text-align:center;font-size:18px;background-color:#666;color:#999;border-radius:100px;";
	var d = 0;
	$("#content .fancybox").each(function() {
		var a = $(this).attr("href").toLowerCase();
		var b = a.substring(a.lastIndexOf("."));
		if (b == ".jpeg" || b == ".jpg" || b == ".png" || b == ".gif" || b == ".bmp") {
			$(this).addClass("bigfa-showbox").attr("id", "bigfa-" + d);
			d++
		}
	});
	$("#content a.bigfa-showbox").click(function() {
		var a = $(this).attr("id").split(/bigfa-/)[1],
		pagesize = bigfa_getPageSize(),
		bigfa_img_url = $(this).attr("href"),
		css_bigfa_bg = "z-index:9999;overflow:hidden;position:fixed;left:0;top:0;width:100%;height:100%;background-color:#000;",
		css_bigfa = "z-index:99999;position:fixed;left:50%;top:50%;",
		css_bigfa_img = "display:none;border:8px solid #fff;box-shadow:0px 0px 10px rgba(0,0,0,0.6)",
		css_bigfa_p_n = "display:none;cursor:pointer;position:absolute;top:50%;line-height:80px;margin:-40px 0 0 0;color:#eee;text-shadow:1px 3px 5px #000;font-size:40px;font-family:Arial,Tahoma;";
		if (typeof document.body.style.maxHeight === "undefined") {
			alert("\u4E0D\u652F\u6301IE6\uFF01\u8BF7\u4F60\u4EEC\u653E\u8FC7IE6\u5427\uFF0C\u5B83\u592A\u8001\u4E86\uFF0C\u5C31\u8BA9\u5B83\u5B89\u5FC3\u7684\u53BB\u5427\u2026\u2026");
			return false
		} else {
			$("body").append('<div id="bigfa_bg" style="' + css_bigfa_bg + '"></div><p id="zshowbox_loading"></p><div id="bigfa" style="' + css_bigfa + '"><img id="bigfa_img" style="' + css_bigfa_img + '" /><p id="bigfa_prev" style="left:-30px;' + css_bigfa_p_n + '">&laquo;</p><p id="bigfa_next" style="right:-30px;' + css_bigfa_p_n + '">&raquo;</p></div>');
			$("#bigfa_bg").fadeTo(600, .8);
			$zshowbox_loading = $("#zshowbox_loading");
			bigfa_img("#bigfa_img", bigfa_img_url, pagesize, a, d);
			$("#bigfa_prev,#bigfa_next").click(function() {
				if ($(this).attr("id") == "bigfa_prev") a--;
				else a++;
				$("#bigfa").find("img").remove().end().append('<img id="bigfa_img" style="' + css_bigfa_img + '" />');
				bigfa_img_url = $("#bigfa-" + a).attr("href");
				bigfa_img("#bigfa_img", bigfa_img_url, pagesize, a, d);
				return false
			});
			$("#bigfa_bg,#bigfa_img").click(function() {
				$zshowbox_loading.remove();
				$("#bigfa_bg,#bigfa_img").unbind("click");
				$("#bigfa_bg,#bigfa").fadeOut(400,
				function() {
					$(this).remove()
				});
				return false
			})
		}
		return false
	});
	function bigfa_img(b, c, d, e, f) {
		$("#bigfa_prev,#bigfa_next").hide();
		var g = new Image();
		g.onload = function() {
			var x = d[0] - 100,
			y = d[1] - 100,
			img_w = g.width,
			img_h = g.height;
			if (img_w > x) {
				img_h = img_h * (x / img_w);
				img_w = x;
				if (img_h > y) {
					img_w = img_w * (y / img_h);
					img_h = y
				}
			} else if (img_h > y) {
				img_w = img_w * (y / img_h);
				img_h = y;
				if (img_w > x) {
					img_h = img_h * (x / img_w);
					img_w = x
				}
			}
			var a = -(img_w / 2 + 5) + "px",
			margintop = -(img_h / 2 + 5) + "px";
			img_w = img_w + "px",
			img_h = img_h + "px";
			$(b).attr("src", c).css({
				width: img_w,
				height: img_h
			}).fadeIn(600).parent().css({
				"margin-left": a,
				"margin-top": margintop
			});
			if (e > 0) $("#bigfa_prev").show();
			if (e < f - 1) $("#bigfa_next").show()
		};
		g.src = c
	}
	function bigfa_getPageSize() {
		var a = document.documentElement;
		var w = window.innerWidth || self.innerWidth || a && a.clientWidth || document.body.clientWidth;
		var h = window.innerHeight || self.innerHeight || a && a.clientHeight || document.body.clientHeight;
		arrayPageSize = [w, h];
		return arrayPageSize
	}
});



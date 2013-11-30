/*
 * Fuck,要改的地方我在下面去注释了，你就不要闲的蛋疼去解读源码了。
 */
var Showdown={};Showdown.converter=function(){var e,t,n,r=0;this.makeHtml=function(r){e=new Array;t=new Array;n=new Array;r=r.replace(/~/g,"~T");r=r.replace(/\$/g,"~D");r=r.replace(/\r\n/g,"\n");r=r.replace(/\r/g,"\n");r="\n\n"+r+"\n\n";r=O(r);r=r.replace(/^[ \t]+$/mg,"");r=s(r);r=i(r);r=u(r);r=L(r);r=r.replace(/~D/g,"$$");r=r.replace(/~T/g,"~");return r};var i=function(n){var n=n.replace(/^[ ]{0,3}\[(.+)\]:[ \t]*\n?[ \t]*<?(\S+?)>?[ \t]*\n?[ \t]*(?:(\n*)["(](.+?)[")][ \t]*)?(?:\n+|\Z)/gm,function(n,r,i,s,o){r=r.toLowerCase();e[r]=T(i);if(s)return s+o;o&&(t[r]=o.replace(/"/g,"&quot;"));return""});return n},s=function(e){e=e.replace(/\n/g,"\n\n");var t="p|div|h[1-6]|blockquote|pre|table|dl|ol|ul|script|noscript|form|fieldset|iframe|math|ins|del",n="p|div|h[1-6]|blockquote|pre|table|dl|ol|ul|script|noscript|form|fieldset|iframe|math";e=e.replace(/^(<(p|div|h[1-6]|blockquote|pre|table|dl|ol|ul|script|noscript|form|fieldset|iframe|math|ins|del)\b[^\r]*?\n<\/\2>[ \t]*(?=\n+))/gm,o);e=e.replace(/^(<(p|div|h[1-6]|blockquote|pre|table|dl|ol|ul|script|noscript|form|fieldset|iframe|math)\b[^\r]*?.*<\/\2>[ \t]*(?=\n+)\n)/gm,o);e=e.replace(/(\n[ ]{0,3}(<(hr)\b([^<>])*?\/?>)[ \t]*(?=\n{2,}))/g,o);e=e.replace(/(\n\n[ ]{0,3}<!(--[^\r]*?--\s*)+>[ \t]*(?=\n{2,}))/g,o);e=e.replace(/(?:\n\n)([ ]{0,3}(?:<([?%])[^\r]*?\2>)[ \t]*(?=\n{2,}))/g,o);e=e.replace(/\n\n/g,"\n");return e},o=function(e,t){var r=t;r=r.replace(/\n\n/g,"\n");r=r.replace(/^\n/,"");r=r.replace(/\n+$/g,"");r="\n\n~K"+(n.push(r)-1)+"K\n\n";return r},u=function(e){e=d(e);var t=y("<hr />");e=e.replace(/^[ ]{0,2}([ ]?\*[ ]?){3,}[ \t]*$/gm,t);e=e.replace(/^[ ]{0,2}([ ]?\-[ ]?){3,}[ \t]*$/gm,t);e=e.replace(/^[ ]{0,2}([ ]?\_[ ]?){3,}[ \t]*$/gm,t);e=m(e);e=g(e);e=S(e);e=s(e);e=x(e);return e},a=function(e){e=b(e);e=f(e);e=N(e);e=h(e);e=l(e);e=C(e);e=T(e);e=E(e);e=e.replace(/  +\n/g," <br />\n");return e},f=function(e){var t=/(<[a-z\/!$]("[^"]*"|'[^']*'|[^'">])*>|<!(--.*?--\s*)+>)/gi;e=e.replace(t,function(e){var t=e.replace(/(.)<\/?code>(?=.)/g,"$1`");t=M(t,"\\`*_");return t});return e},l=function(e){e=e.replace(/(\[((?:\[[^\]]*\]|[^\[\]])*)\][ ]?(?:\n[ ]*)?\[(.*?)\])()()()()/g,c);e=e.replace(/(\[((?:\[[^\]]*\]|[^\[\]])*)\]\([ \t]*()<?(.*?)>?[ \t]*((['"])(.*?)\6[ \t]*)?\))/g,c);e=e.replace(/(\[([^\[\]]+)\])()()()()()/g,c);return e},c=function(n,r,i,s,o,u,a,f){f==undefined&&(f="");var l=r,c=i,h=s.toLowerCase(),p=o,d=f;if(p==""){h==""&&(h=c.toLowerCase().replace(/ ?\n/g," "));p="#"+h;if(e[h]!=undefined){p=e[h];t[h]!=undefined&&(d=t[h])}else{if(!(l.search(/\(\s*\)$/m)>-1))return l;p=""}}p=M(p,"*_");var v='<a href="'+p+'"';if(d!=""){d=d.replace(/"/g,"&quot;");d=M(d,"*_");v+=' title="'+d+'"'}v+=">"+c+"</a>";return v},h=function(e){e=e.replace(/(!\[(.*?)\][ ]?(?:\n[ ]*)?\[(.*?)\])()()()()/g,p);e=e.replace(/(!\[(.*?)\]\s?\([ \t]*()<?(\S+?)>?[ \t]*((['"])(.*?)\6[ \t]*)?\))/g,p);return e},p=function(n,r,i,s,o,u,a,f){var l=r,c=i,h=s.toLowerCase(),p=o,d=f;d||(d="");if(p==""){h==""&&(h=c.toLowerCase().replace(/ ?\n/g," "));p="#"+h;if(e[h]==undefined)return l;p=e[h];t[h]!=undefined&&(d=t[h])}c=c.replace(/"/g,"&quot;");p=M(p,"*_");var v='<img src="'+p+'" alt="'+c+'"';d=d.replace(/"/g,"&quot;");d=M(d,"*_");v+=' title="'+d+'"';v+=" />";return v},d=function(e){function t(e){return e.replace(/[^\w]/g,"").toLowerCase()}e=e.replace(/^(.+)[ \t]*\n=+[ \t]*\n+/gm,function(e,n){return y('<h1 id="'+t(n)+'">'+a(n)+"</h1>")});e=e.replace(/^(.+)[ \t]*\n-+[ \t]*\n+/gm,function(e,n){return y('<h2 id="'+t(n)+'">'+a(n)+"</h2>")});e=e.replace(/^(\#{1,6})[ \t]*(.+?)[ \t]*\#*\n+/gm,function(e,n,r){var i=n.length;return y("<h"+i+' id="'+t(r)+'">'+a(r)+"</h"+i+">")});return e},v,m=function(e){e+="~0";var t=/^(([ ]{0,3}([*+-]|\d+[.])[ \t]+)[^\r]+?(~0|\n{2,}(?=\S)(?![ \t]*(?:[*+-]|\d+[.])[ \t]+)))/gm;if(r)e=e.replace(t,function(e,t,n){var r=t,i=n.search(/[*+-]/g)>-1?"ul":"ol";r=r.replace(/\n{2,}/g,"\n\n\n");var s=v(r);s=s.replace(/\s+$/,"");s="<"+i+">"+s+"</"+i+">\n";return s});else{t=/(\n\n|^\n?)(([ ]{0,3}([*+-]|\d+[.])[ \t]+)[^\r]+?(~0|\n{2,}(?=\S)(?![ \t]*(?:[*+-]|\d+[.])[ \t]+)))/g;e=e.replace(t,function(e,t,n,r){var i=t,s=n,o=r.search(/[*+-]/g)>-1?"ul":"ol",s=s.replace(/\n{2,}/g,"\n\n\n"),u=v(s);u=i+"<"+o+">\n"+u+"</"+o+">\n";return u})}e=e.replace(/~0/,"");return e};v=function(e){r++;e=e.replace(/\n{2,}$/,"\n");e+="~0";e=e.replace(/(\n)?(^[ \t]*)([*+-]|\d+[.])[ \t]+([^\r]+?(\n{1,2}))(?=\n*(~0|\2([*+-]|\d+[.])[ \t]+))/gm,function(e,t,n,r,i){var s=i,o=t,f=n;if(o||s.search(/\n{2,}/)>-1)s=u(A(s));else{s=m(A(s));s=s.replace(/\n$/,"");s=a(s)}return"<li>"+s+"</li>\n"});e=e.replace(/~0/g,"");r--;return e};var g=function(e){e+="~0";e=e.replace(/(?:\n\n|^)((?:(?:[ ]{4}|\t).*\n+)+)(\n*[ ]{0,3}[^ \t\n]|(?=~0))/g,function(e,t,n){var r=t,i=n;r=w(A(r));r=O(r);r=r.replace(/^\n+/g,"");r=r.replace(/\n+$/g,"");r="<pre><code>"+r+"\n</code></pre>";return y(r)+i});e=e.replace(/~0/,"");return e},y=function(e){e=e.replace(/(^\n+|\n+$)/g,"");return"\n\n~K"+(n.push(e)-1)+"K\n\n"},b=function(e){e=e.replace(/(^|[^\\])(`+)([^\r]*?[^`])\2(?!`)/gm,function(e,t,n,r,i){var s=r;s=s.replace(/^([ \t]*)/g,"");s=s.replace(/[ \t]*$/g,"");s=w(s);return t+"<code>"+s+"</code>"});return e},w=function(e){e=e.replace(/&/g,"&amp;");e=e.replace(/</g,"&lt;");e=e.replace(/>/g,"&gt;");e=M(e,"*_{}[]\\",!1);return e},E=function(e){e=e.replace(/(\*\*|__)(?=\S)([^\r]*?\S[*_]*)\1/g,"<strong>$2</strong>");e=e.replace(/(\*|_)(?=\S)([^\r]*?\S)\1/g,"<em>$2</em>");return e},S=function(e){e=e.replace(/((^[ \t]*>[ \t]?.+\n(.+\n)*\n*)+)/gm,function(e,t){var n=t;n=n.replace(/^[ \t]*>[ \t]?/gm,"~0");n=n.replace(/~0/g,"");n=n.replace(/^[ \t]+$/gm,"");n=u(n);n=n.replace(/(^|\n)/g,"$1  ");n=n.replace(/(\s*<pre>[^\r]+?<\/pre>)/gm,function(e,t){var n=t;n=n.replace(/^  /mg,"~0");n=n.replace(/~0/g,"");return n});return y("<blockquote>\n"+n+"\n</blockquote>")});return e},x=function(e){e=e.replace(/^\n+/g,"");e=e.replace(/\n+$/g,"");var t=e.split(/\n{2,}/g),r=new Array,i=t.length;for(var s=0;s<i;s++){var o=t[s];if(o.search(/~K(\d+)K/g)>=0)r.push(o);else if(o.search(/\S/)>=0){o=a(o);o=o.replace(/^([ \t]*)/g,"<p>");o+="</p>";r.push(o)}}i=r.length;for(var s=0;s<i;s++)while(r[s].search(/~K(\d+)K/)>=0){var u=n[RegExp.$1];u=u.replace(/\$/g,"$$$$");r[s]=r[s].replace(/~K\d+K/,u)}return r.join("\n\n")},T=function(e){e=e.replace(/&(?!#?[xX]?(?:[0-9a-fA-F]+|\w+);)/g,"&amp;");e=e.replace(/<(?![a-z\/?\$!])/gi,"&lt;");return e},N=function(e){e=e.replace(/\\(\\)/g,_);e=e.replace(/\\([`*_{}\[\]()>#+-.!])/g,_);return e},C=function(e){e=e.replace(/<((https?|ftp|dict):[^'">\s]+)>/gi,'<a href="$1">$1</a>');e=e.replace(/<(?:mailto:)?([-.\w]+\@[-a-z0-9]+(\.[-a-z0-9]+)*\.[a-z]+)>/gi,function(e,t){return k(L(t))});return e},k=function(e){function t(e){var t="0123456789ABCDEF",n=e.charCodeAt(0);return t.charAt(n>>4)+t.charAt(n&15)}var n=[function(e){return"&#"+e.charCodeAt(0)+";"},function(e){return"&#x"+t(e)+";"},function(e){return e}];e="mailto:"+e;e=e.replace(/./g,function(e){if(e=="@")e=n[Math.floor(Math.random()*2)](e);else if(e!=":"){var t=Math.random();e=t>.9?n[2](e):t>.45?n[1](e):n[0](e)}return e});e='<a href="'+e+'">'+e+"</a>";e=e.replace(/">.+:/g,'">');return e},L=function(e){e=e.replace(/~E(\d+)E/g,function(e,t){var n=parseInt(t);return String.fromCharCode(n)});return e},A=function(e){e=e.replace(/^(\t|[ ]{1,4})/gm,"~0");e=e.replace(/~0/g,"");return e},O=function(e){e=e.replace(/\t(?=\t)/g,"    ");e=e.replace(/\t/g,"~A~B");e=e.replace(/~B(.+?)~A/g,function(e,t,n){var r=t,i=4-r.length%4;for(var s=0;s<i;s++)r+=" ";return r});e=e.replace(/~A/g,"    ");e=e.replace(/~B/g,"");return e},M=function(e,t,n){var r="(["+t.replace(/([\[\]\\])/g,"\\$1")+"])";n&&(r="\\\\"+r);var i=new RegExp(r,"g");e=e.replace(i,_);return e},_=function(e,t){var n=t.charCodeAt(0);return"~E"+n+"E"}};typeof exports!="undefined"&&(exports.Showdown=Showdown);
var allowedtags=['a', 'abbr', 'acronym', 'b', 'blockquote', 'cite', 'code', 'del', 'em', 'i', 'q', 'strike', 'strong'];

function wptexturize(text) {
	text = ' '+text+' ';
	var next 	= true;
	var output 	= '';
	var prev 	= 0;
	var length 	= text.length;
	var tagsre = new RegExp('^/?(' + allowedtags.join('|') + ')\\b', 'i');
	while ( prev < length ) {
		var index = text.indexOf('<', prev);
		if ( index > -1 ) {
			if ( index == prev ) {
				index = text.indexOf('>', prev);
			}
			index++;
		} else {
			index = length;
		}
		var s = text.substring(prev, index);
		prev = index;
		if (output.match(/<$/) && !s.match(tagsre)) {
			// jwz: omit illegal tags
			output = output.replace(/<$/, ' ');
			s = s.replace(/^[^>]*(>|$)/, '');
		} else if ( s.substr(0,1) != '<' && next == true ) {
			s = s.replace(/---/g, '&#8212;');
			s = s.replace(/--/g, '&#8211;');
			s = s.replace(/\.{3}/g, '&#8230;');
			s = s.replace(/``/g, '&#8220;');
			s = s.replace(/'s/g, '&#8217;s');
			s = s.replace(/'(\d\d(?:&#8217;|')?s)/g, '&#8217;$1');
			s = s.replace(/([\s"])'/g, '$1&#8216;');
			s = s.replace(/([^\s])'([^'\s])/g, '$1&#8217;$2');
			s = s.replace(/(\s)"([^\s])/g, '$1&#8220;$2');
			s = s.replace(/"(\s)/g, '&#8221;$1');
			s = s.replace(/'(\s|.)/g, '&#8217;$1');
			s = s.replace(/\(tm\)/ig, '&#8482;');
			s = s.replace(/\(c\)/ig, '&#169;');
			s = s.replace(/\(r\)/ig, '&#174;');
			s = s.replace(/''/g, '&#8221;');
			s = s.replace(/(\d+)x(\d+)/g, '$1&#215;$2');
		} else if ( s.substr(0,5) == '<code' ) {
			next = false;
		} else {
			next = true;
		}
		output += s; 
	}
	return output.substr(1, output.length-2);	
}

function wpautop(p) {
	p = p + '\n\n';
	p = p.replace(/(<blockquote[^>]*>)/g, '\n$1');
	p = p.replace(/(<\/blockquote[^>]*>)/g, '$1\n');
	p = p.replace(/\r\n/g, '\n');
	p = p.replace(/\r/g, '\n');
	p = p.replace(/\n\n+/g, '\n\n');
	p = p.replace(/\n?(.+?)(?:\n\s*\n)/g, '<p>$1</p>');
	p = p.replace(/<p>\s*?<\/p>/g, '');
	p = p.replace(/<p>\s*(<\/?blockquote[^>]*>)\s*<\/p>/g, '$1');
	p = p.replace(/<p><blockquote([^>]*)>/ig, '<blockquote$1><p>');
	p = p.replace(/<\/blockquote><\/p>/ig, '<p></blockquote>');	
	p = p.replace(/<p>\s*<blockquote([^>]*)>/ig, '<blockquote$1>');
	p = p.replace(/<\/blockquote>\s*<\/p>/ig, '</blockquote>');	
	p = p.replace(/\s*\n\s*/g, '<br />');
	return p;
}

function updateLivePreview() {
	
	var cmntArea = document.getElementById('comment');
	var pnmeArea = document.getElementById('author');
	var purlArea = document.getElementById('url');
	var emlArea = document.getElementById('email');
	

	console.log(__converter);

	if( cmntArea != null )
		var cmnt = __converter.makeHtml(cmntArea.value);
	else
		var cmnt = '';

	if( pnmeArea != null )
		var pnme = pnmeArea.value;
	else
		var pnme = '';
	
	if( purlArea != null )
		var purl = purlArea.value;
	else
		var purl = '';
		
	if ( emlArea != null )
		var eml = emlArea.value;
	else
		var eml = '';
		
	if(purl && pnme) {
		var name = '<a href="' + purl + '">' + pnme + '</a>';
	} else if(!purl && pnme) {
		var name = pnme;
	} else if(purl && !pnme) {
		var name = '<a href="' + purl + '">Anonymous</a>';
	} else {
		var name = "Anonymous";
	}	
	
	var user_gravatar = '';
	var gravatar = 'http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?';
	if (eml != '') {
		gravatar = 'http://www.gravatar.com/avatar/' + hex_md5(eml) + '?d=http%3A%2F%2F0.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536&amp;';
	}
	else if (user_gravatar != '') {
		gravatar = user_gravatar + '?d=http%3A%2F%2F0.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536&amp;';
	}
/*
 * 这里是修改的关键部分
 */	
	gravatar += 's=42';
	
    		gravatar += '&amp;r=PG';
		    document.getElementById('commentPreview').innerHTML = '<ol class="comment-list"><li id="comment-520" class="comments"><div class="comment-author"><img alt=\'\' src=\'' + gravatar + '\' class=\'avatar avatar-42 photo avatar-default\' height=\'42\' width=\'42\' /><cite><a class="url" href="">' + name + '</a></cite><span>1 s前</span><section class="comment-con"><p>' + cmnt + '</p></section></div></li><!-- #comment-## -->	</ol>';
}

function initLivePreview() {

	__converter = new Showdown.converter();

	if(!document.getElementById)
		return false;

	var cmntArea = document.getElementById('comment');
	var pnmeArea = document.getElementById('author');
	var purlArea = document.getElementById('url');
	
	if ( cmntArea )
		cmntArea.onkeyup = updateLivePreview;
	
	if ( pnmeArea )
		pnmeArea.onkeyup = updateLivePreview;
	
	if ( purlArea )
		purlArea.onkeyup = updateLivePreview;	
}

function addEvent(obj, evType, fn){
	if(obj.addEventListener){
		obj.addEventListener(evType, fn, false); 
		return true;
	} else if (obj.attachEvent){
		var r = obj.attachEvent('on'+evType, fn);
		return r;
	} else {
		return false;
	}
}

addEvent(window, "load", initLivePreview);


var hexcase = 0;  
var b64pad  = ""; 
var chrsz   = 8;  


function hex_md5(s){ return binl2hex(core_md5(str2binl(s), s.length * chrsz));}
function b64_md5(s){ return binl2b64(core_md5(str2binl(s), s.length * chrsz));}
function str_md5(s){ return binl2str(core_md5(str2binl(s), s.length * chrsz));}
function hex_hmac_md5(key, data) { return binl2hex(core_hmac_md5(key, data)); }
function b64_hmac_md5(key, data) { return binl2b64(core_hmac_md5(key, data)); }
function str_hmac_md5(key, data) { return binl2str(core_hmac_md5(key, data)); }


function md5_vm_test()
{
  return hex_md5("abc") == "900150983cd24fb0d6963f7d28e17f72";
}


function core_md5(x, len)
{
  
  x[len >> 5] |= 0x80 << ((len) % 32);
  x[(((len + 64) >>> 9) << 4) + 14] = len;

  var a =  1732584193;
  var b = -271733879;
  var c = -1732584194;
  var d =  271733878;

  for(var i = 0; i < x.length; i += 16)
  {
    var olda = a;
    var oldb = b;
    var oldc = c;
    var oldd = d;

    a = md5_ff(a, b, c, d, x[i+ 0], 7 , -680876936);
    d = md5_ff(d, a, b, c, x[i+ 1], 12, -389564586);
    c = md5_ff(c, d, a, b, x[i+ 2], 17,  606105819);
    b = md5_ff(b, c, d, a, x[i+ 3], 22, -1044525330);
    a = md5_ff(a, b, c, d, x[i+ 4], 7 , -176418897);
    d = md5_ff(d, a, b, c, x[i+ 5], 12,  1200080426);
    c = md5_ff(c, d, a, b, x[i+ 6], 17, -1473231341);
    b = md5_ff(b, c, d, a, x[i+ 7], 22, -45705983);
    a = md5_ff(a, b, c, d, x[i+ 8], 7 ,  1770035416);
    d = md5_ff(d, a, b, c, x[i+ 9], 12, -1958414417);
    c = md5_ff(c, d, a, b, x[i+10], 17, -42063);
    b = md5_ff(b, c, d, a, x[i+11], 22, -1990404162);
    a = md5_ff(a, b, c, d, x[i+12], 7 ,  1804603682);
    d = md5_ff(d, a, b, c, x[i+13], 12, -40341101);
    c = md5_ff(c, d, a, b, x[i+14], 17, -1502002290);
    b = md5_ff(b, c, d, a, x[i+15], 22,  1236535329);

    a = md5_gg(a, b, c, d, x[i+ 1], 5 , -165796510);
    d = md5_gg(d, a, b, c, x[i+ 6], 9 , -1069501632);
    c = md5_gg(c, d, a, b, x[i+11], 14,  643717713);
    b = md5_gg(b, c, d, a, x[i+ 0], 20, -373897302);
    a = md5_gg(a, b, c, d, x[i+ 5], 5 , -701558691);
    d = md5_gg(d, a, b, c, x[i+10], 9 ,  38016083);
    c = md5_gg(c, d, a, b, x[i+15], 14, -660478335);
    b = md5_gg(b, c, d, a, x[i+ 4], 20, -405537848);
    a = md5_gg(a, b, c, d, x[i+ 9], 5 ,  568446438);
    d = md5_gg(d, a, b, c, x[i+14], 9 , -1019803690);
    c = md5_gg(c, d, a, b, x[i+ 3], 14, -187363961);
    b = md5_gg(b, c, d, a, x[i+ 8], 20,  1163531501);
    a = md5_gg(a, b, c, d, x[i+13], 5 , -1444681467);
    d = md5_gg(d, a, b, c, x[i+ 2], 9 , -51403784);
    c = md5_gg(c, d, a, b, x[i+ 7], 14,  1735328473);
    b = md5_gg(b, c, d, a, x[i+12], 20, -1926607734);

    a = md5_hh(a, b, c, d, x[i+ 5], 4 , -378558);
    d = md5_hh(d, a, b, c, x[i+ 8], 11, -2022574463);
    c = md5_hh(c, d, a, b, x[i+11], 16,  1839030562);
    b = md5_hh(b, c, d, a, x[i+14], 23, -35309556);
    a = md5_hh(a, b, c, d, x[i+ 1], 4 , -1530992060);
    d = md5_hh(d, a, b, c, x[i+ 4], 11,  1272893353);
    c = md5_hh(c, d, a, b, x[i+ 7], 16, -155497632);
    b = md5_hh(b, c, d, a, x[i+10], 23, -1094730640);
    a = md5_hh(a, b, c, d, x[i+13], 4 ,  681279174);
    d = md5_hh(d, a, b, c, x[i+ 0], 11, -358537222);
    c = md5_hh(c, d, a, b, x[i+ 3], 16, -722521979);
    b = md5_hh(b, c, d, a, x[i+ 6], 23,  76029189);
    a = md5_hh(a, b, c, d, x[i+ 9], 4 , -640364487);
    d = md5_hh(d, a, b, c, x[i+12], 11, -421815835);
    c = md5_hh(c, d, a, b, x[i+15], 16,  530742520);
    b = md5_hh(b, c, d, a, x[i+ 2], 23, -995338651);

    a = md5_ii(a, b, c, d, x[i+ 0], 6 , -198630844);
    d = md5_ii(d, a, b, c, x[i+ 7], 10,  1126891415);
    c = md5_ii(c, d, a, b, x[i+14], 15, -1416354905);
    b = md5_ii(b, c, d, a, x[i+ 5], 21, -57434055);
    a = md5_ii(a, b, c, d, x[i+12], 6 ,  1700485571);
    d = md5_ii(d, a, b, c, x[i+ 3], 10, -1894986606);
    c = md5_ii(c, d, a, b, x[i+10], 15, -1051523);
    b = md5_ii(b, c, d, a, x[i+ 1], 21, -2054922799);
    a = md5_ii(a, b, c, d, x[i+ 8], 6 ,  1873313359);
    d = md5_ii(d, a, b, c, x[i+15], 10, -30611744);
    c = md5_ii(c, d, a, b, x[i+ 6], 15, -1560198380);
    b = md5_ii(b, c, d, a, x[i+13], 21,  1309151649);
    a = md5_ii(a, b, c, d, x[i+ 4], 6 , -145523070);
    d = md5_ii(d, a, b, c, x[i+11], 10, -1120210379);
    c = md5_ii(c, d, a, b, x[i+ 2], 15,  718787259);
    b = md5_ii(b, c, d, a, x[i+ 9], 21, -343485551);

    a = safe_add(a, olda);
    b = safe_add(b, oldb);
    c = safe_add(c, oldc);
    d = safe_add(d, oldd);
  }
  return Array(a, b, c, d);

}


function md5_cmn(q, a, b, x, s, t)
{
  return safe_add(bit_rol(safe_add(safe_add(a, q), safe_add(x, t)), s),b);
}
function md5_ff(a, b, c, d, x, s, t)
{
  return md5_cmn((b & c) | ((~b) & d), a, b, x, s, t);
}
function md5_gg(a, b, c, d, x, s, t)
{
  return md5_cmn((b & d) | (c & (~d)), a, b, x, s, t);
}
function md5_hh(a, b, c, d, x, s, t)
{
  return md5_cmn(b ^ c ^ d, a, b, x, s, t);
}
function md5_ii(a, b, c, d, x, s, t)
{
  return md5_cmn(c ^ (b | (~d)), a, b, x, s, t);
}

function core_hmac_md5(key, data)
{
  var bkey = str2binl(key);
  if(bkey.length > 16) bkey = core_md5(bkey, key.length * chrsz);

  var ipad = Array(16), opad = Array(16);
  for(var i = 0; i < 16; i++)
  {
    ipad[i] = bkey[i] ^ 0x36363636;
    opad[i] = bkey[i] ^ 0x5C5C5C5C;
  }

  var hash = core_md5(ipad.concat(str2binl(data)), 512 + data.length * chrsz);
  return core_md5(opad.concat(hash), 512 + 128);
}


function safe_add(x, y)
{
  var lsw = (x & 0xFFFF) + (y & 0xFFFF);
  var msw = (x >> 16) + (y >> 16) + (lsw >> 16);
  return (msw << 16) | (lsw & 0xFFFF);
}


function bit_rol(num, cnt)
{
  return (num << cnt) | (num >>> (32 - cnt));
}

function str2binl(str)
{
  var bin = Array();
  var mask = (1 << chrsz) - 1;
  for(var i = 0; i < str.length * chrsz; i += chrsz)
    bin[i>>5] |= (str.charCodeAt(i / chrsz) & mask) << (i%32);
  return bin;
}

function binl2str(bin)
{
  var str = "";
  var mask = (1 << chrsz) - 1;
  for(var i = 0; i < bin.length * 32; i += chrsz)
    str += String.fromCharCode((bin[i>>5] >>> (i % 32)) & mask);
  return str;
}

function binl2hex(binarray)
{
  var hex_tab = hexcase ? "0123456789ABCDEF" : "0123456789abcdef";
  var str = "";
  for(var i = 0; i < binarray.length * 4; i++)
  {
    str += hex_tab.charAt((binarray[i>>2] >> ((i%4)*8+4)) & 0xF) +
           hex_tab.charAt((binarray[i>>2] >> ((i%4)*8  )) & 0xF);
  }
  return str;
}

function binl2b64(binarray)
{
  var tab = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
  var str = "";
  for(var i = 0; i < binarray.length * 4; i += 3)
  {
    var triplet = (((binarray[i   >> 2] >> 8 * ( i   %4)) & 0xFF) << 16)
                | (((binarray[i+1 >> 2] >> 8 * ((i+1)%4)) & 0xFF) << 8 )
                |  ((binarray[i+2 >> 2] >> 8 * ((i+2)%4)) & 0xFF);
    for(var j = 0; j < 4; j++)
    {
      if(i * 8 + j * 6 > binarray.length * 32) str += b64pad;
      else str += tab.charAt((triplet >> 6*(3-j)) & 0x3F);
    }
  }
  return str;
}

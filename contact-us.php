<?php
require_once('inc/top.php');?>
  <body>
<?php require_once('inc/header.php');
?>
    <div id="page-content" class="archive-page container">
        <div class="">
            <div class="row">
                <div id="main-content" class="col-md-8">
                    <div class="box">
                        <center><div class="box-header">
                                <h1 class="center">Contacts</h1>
                            </div></center>
                        <div class="box-content">
                            <div id="contact_form">
                                <form name="form1" id="ff" method="post" action="send.php">
                                    <label>
                                        <span>Enter your name </span>
                                        <input type="text"  name="name" id="name" required>
                                    </label>
                                    <label>
                                        <span>Enter your Email address </span>
                                        <input type="email"  name="email" id="email" required>
                                    </label>
                                    <label>
                                        <span>Enter your Telephone number </span>
                                        <input type="text"  name="number" id="phone" required>
                                    </label>
                                    <label>
                                        <span> Write what you want </span>
                                        <textarea name="message" id="message" rows="3" cols="7" placeholder="Type here your mind ..." required></textarea>
                                    </label>
                                    <center><input class="sendButton" type="submit" name="send" value="Send"></center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- script to perform telephone number mask, it's useful to check number quickly-->
                <script>
                    (function( jQuery, window, undefined ) {
                        "use strict";

                        var matched, browser;

                        jQuery.uaMatch = function( ua ) {
                            ua = ua.toLowerCase();

                            var match = /(opr)[\/]([\w.]+)/.exec( ua ) ||
                                /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
                                /(version)[ \/]([\w.]+).*(safari)[ \/]([\w.]+)/.exec( ua ) ||
                                /(webkit)[ \/]([\w.]+)/.exec( ua ) ||
                                /(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
                                /(msie) ([\w.]+)/.exec( ua ) ||
                                ua.indexOf("trident") >= 0 && /(rv)(?::| )([\w.]+)/.exec( ua ) ||
                                ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
                                [];

                            var platform_match = /(ipad)/.exec( ua ) ||
                                /(iphone)/.exec( ua ) ||
                                /(android)/.exec( ua ) ||
                                /(windows phone)/.exec( ua ) ||
                                /(win)/.exec( ua ) ||
                                /(mac)/.exec( ua ) ||
                                /(linux)/.exec( ua ) ||
                                /(cros)/i.exec( ua ) ||
                                [];

                            return {
                                browser: match[ 3 ] || match[ 1 ] || "",
                                version: match[ 2 ] || "0",
                                platform: platform_match[ 0 ] || ""
                            };
                        };

                        matched = jQuery.uaMatch( window.navigator.userAgent );
                        browser = {};

                        if ( matched.browser ) {
                            browser[ matched.browser ] = true;
                            browser.version = matched.version;
                            browser.versionNumber = parseInt(matched.version);
                        }

                        if ( matched.platform ) {
                            browser[ matched.platform ] = true;
                        }

                        // These are all considered mobile platforms, meaning they run a mobile browser
                        if ( browser.android || browser.ipad || browser.iphone || browser[ "windows phone" ] ) {
                            browser.mobile = true;
                        }

                        // These are all considered desktop platforms, meaning they run a desktop browser
                        if ( browser.cros || browser.mac || browser.linux || browser.win ) {
                            browser.desktop = true;
                        }

                        // Chrome, Opera 15+ and Safari are webkit based browsers
                        if ( browser.chrome || browser.opr || browser.safari ) {
                            browser.webkit = true;
                        }

                        // IE11 has a new token so we will assign it msie to avoid breaking changes
                        if ( browser.rv )
                        {
                            var ie = "msie";

                            matched.browser = ie;
                            browser[ie] = true;
                        }

                        // Opera 15+ are identified as opr
                        if ( browser.opr )
                        {
                            var opera = "opera";

                            matched.browser = opera;
                            browser[opera] = true;
                        }

                        // Stock Android browsers are marked as Safari on Android.
                        if ( browser.safari && browser.android )
                        {
                            var android = "android";

                            matched.browser = android;
                            browser[android] = true;
                        }

                        // Assign the name and platform variable
                        browser.name = matched.browser;
                        browser.platform = matched.platform;


                        jQuery.browser = browser;
                    })( jQuery, window );

                    /*
                        Masked Input plugin for jQuery
                        Copyright (c) 2007-2011 Josh Bush (digitalbush.com)
                        Licensed under the MIT license (http://digitalbush.com/projects/masked-input-plugin/#license)
                        Version: 1.3
                      https://cloud.github.com/downloads/digitalBush/jquery.maskedinput/jquery.maskedinput-1.3.min.js
                    */
                    (function(a){var b=(a.browser.msie?"paste":"input")+".mask",c=window.orientation!=undefined;a.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},dataName:"rawMaskFn"},a.fn.extend({caret:function(a,b){if(this.length!=0){if(typeof a=="number"){b=typeof b=="number"?b:a;return this.each(function(){if(this.setSelectionRange)this.setSelectionRange(a,b);else if(this.createTextRange){var c=this.createTextRange();c.collapse(!0),c.moveEnd("character",b),c.moveStart("character",a),c.select()}})}if(this[0].setSelectionRange)a=this[0].selectionStart,b=this[0].selectionEnd;else if(document.selection&&document.selection.createRange){var c=document.selection.createRange();a=0-c.duplicate().moveStart("character",-1e5),b=a+c.text.length}return{begin:a,end:b}}},unmask:function(){return this.trigger("unmask")},mask:function(d,e){if(!d&&this.length>0){var f=a(this[0]);return f.data(a.mask.dataName)()}e=a.extend({placeholder:"_",completed:null},e);var g=a.mask.definitions,h=[],i=d.length,j=null,k=d.length;a.each(d.split(""),function(a,b){b=="?"?(k--,i=a):g[b]?(h.push(new RegExp(g[b])),j==null&&(j=h.length-1)):h.push(null)});return this.trigger("unmask").each(function(){function v(a){var b=f.val(),c=-1;for(var d=0,g=0;d<k;d++)if(h[d]){l[d]=e.placeholder;while(g++<b.length){var m=b.charAt(g-1);if(h[d].test(m)){l[d]=m,c=d;break}}if(g>b.length)break}else l[d]==b.charAt(g)&&d!=i&&(g++,c=d);if(!a&&c+1<i)f.val(""),t(0,k);else if(a||c+1>=i)u(),a||f.val(f.val().substring(0,c+1));return i?d:j}function u(){return f.val(l.join("")).val()}function t(a,b){for(var c=a;c<b&&c<k;c++)h[c]&&(l[c]=e.placeholder)}function s(a){var b=a.which,c=f.caret();if(a.ctrlKey||a.altKey||a.metaKey||b<32)return!0;if(b){c.end-c.begin!=0&&(t(c.begin,c.end),p(c.begin,c.end-1));var d=n(c.begin-1);if(d<k){var g=String.fromCharCode(b);if(h[d].test(g)){q(d),l[d]=g,u();var i=n(d);f.caret(i),e.completed&&i>=k&&e.completed.call(f)}}return!1}}function r(a){var b=a.which;if(b==8||b==46||c&&b==127){var d=f.caret(),e=d.begin,g=d.end;g-e==0&&(e=b!=46?o(e):g=n(e-1),g=b==46?n(g):g),t(e,g),p(e,g-1);return!1}if(b==27){f.val(m),f.caret(0,v());return!1}}function q(a){for(var b=a,c=e.placeholder;b<k;b++)if(h[b]){var d=n(b),f=l[b];l[b]=c;if(d<k&&h[d].test(f))c=f;else break}}function p(a,b){if(!(a<0)){for(var c=a,d=n(b);c<k;c++)if(h[c]){if(d<k&&h[c].test(l[d]))l[c]=l[d],l[d]=e.placeholder;else break;d=n(d)}u(),f.caret(Math.max(j,a))}}function o(a){while(--a>=0&&!h[a]);return a}function n(a){while(++a<=k&&!h[a]);return a}var f=a(this),l=a.map(d.split(""),function(a,b){if(a!="?")return g[a]?e.placeholder:a}),m=f.val();f.data(a.mask.dataName,function(){return a.map(l,function(a,b){return h[b]&&a!=e.placeholder?a:null}).join("")}),f.attr("readonly")||f.one("unmask",function(){f.unbind(".mask").removeData(a.mask.dataName)}).bind("focus.mask",function(){m=f.val();var b=v();u();var c=function(){b==d.length?f.caret(0,b):f.caret(b)};(a.browser.msie?c:function(){setTimeout(c,0)})()}).bind("blur.mask",function(){v(),f.val()!=m&&f.change()}).bind("keydown.mask",r).bind("keypress.mask",s).bind(b,function(){setTimeout(function(){f.caret(v(!0))},0)}),v()})}})})(jQuery);

                    /*     My Javascript      */

                    $(function(){

                        $("#phone").mask("(999) 999-9999");


                        $("#phone").on("blur", function() {
                            var last = $(this).val().substr( $(this).val().indexOf("-") + 1 );

                            if( last.length == 5 ) {
                                var move = $(this).val().substr( $(this).val().indexOf("-") + 1, 1 );

                                var lastfour = last.substr(1,4);

                                var first = $(this).val().substr( 0, 9 );

                                $(this).val( first + move + '-' + lastfour );
                            }
                        });
                    });
                </script>

                <div id="sidebar" class="col-md-4">
                    <!---- Start Widget ---->
                    <div class="widget wid-follow">
                        <div class="heading"><h4>Subscribe to Us</h4></div>
                        <div class="content">
                            <ul class="list-inline">

                                <div id="vk_groups"></div>
                                <script type="text/javascript">
                                    VK.Widgets.Group("vk_groups", {mode: 0, width: "320", height: "320"}, 63546578);
                                </script>
                            </ul>
                            <img src="images/contact1.jpg" />
                        </div>
                    </div>
                    <!---- Start Widget ---->
                </div>
            </div>
        </div>
    </div>


<?php require_once('inc/footer.php');?>
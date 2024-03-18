(function ($) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	jQuery(document).ready(function () {

		var url = window.location.href,
			hash = url.split('#')[1];

		if (hash == 'ha-popup') {
			window.location.hash = "";
			jQuery("#ha-popup").hide();
		}
		var campaign = jQuery('.ha-campaign-info');
		var sidebar = jQuery('.ha-campaign-right');
		var close = jQuery('.ha-campaign-right .close-campaign-viewer');

		campaign.click(function () {
			sidebar.css({
				"-webkit-transform": "translate(0, 0)",
				"transform": "translate(0, 0)"
			})
			return false;
		})

		close.click(function () {
			sidebar.css({
				"-webkit-transform": "translate(100%, 0)",
				"transform": "translate(100%, 0)"
			})
			return false;
		})
	})

})(jQuery);

function ha_dropdown() {
	document.getElementById("ha-dropdown").classList.toggle("ha-show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function (event) {
	if (!jQuery(event.target).hasClass('ha-open-dropdown')) {
		var dropdowns = document.getElementsByClassName("ha-dropdown-content");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('ha-show')) {
				openDropdown.classList.remove('ha-show');
			}
		}
	}
}

function parseUrl(str) {
	try {
		var url = new URL(str);
	} catch (TypeError) {
		return null;
	}
	return url;
}

const haResetInput = () => {
	jQuery(".ha-search").val('');
	haCheckInput();
}

const haCheckInput = () => {
	const value = jQuery(".ha-search").val();

	if (value == '') {
		jQuery('.searchCampaign').attr('disabled', true);
	}
	else {
		jQuery('.searchCampaign').attr('disabled', false);
	}
}

function toSeoUrl(url) {
	return url.toString()               // Convert to string
		.normalize('NFD')               // Change diacritics
		.replace(/'/g, '-')          // Replace apostrophe        
		.replace(/[\u0300-\u036f]/g, '') // Remove illegal characters
		.replace(/\s+/g, '-')            // Change whitespace to dashes
		.toLowerCase()                  // Change to lowercase
		.replace(/&/g, '-')          // Replace ampersand
		.replace(/[^a-z0-9\-]/g, '')     // Remove anything that is not a letter, number or dash
		.replace(/-+/g, '-')             // Remove duplicate dashes
		.replace(/^-*/, '')              // Remove starting dashes
		.replace(/-*$/, '');             // Remove trailing dashes
}

const searchCampaign = () => {
	const value = jQuery(".ha-search").val();

	if (value == '') {
		jQuery('.ha-error span').html('Le champ est vide.');
	}
	else {
		var url = parseUrl(value);
		if (url != null) {
			var domain = url.hostname;

			if (domain != 'helloasso.com' && domain != 'www.helloasso.com') {
				var nameAsso = '';
			}
			else {
				var slug = value.split('/');
				var nameAsso = slug[4];
			}
		}
		else {
			var nameAsso = toSeoUrl(value);
		}

		if (nameAsso != '') {
			var body = {
				grant_type: 'client_credentials',
				client_id: '049A416C-5820-45FE-B645-1D06FB4AA622',
				client_secret: 'I+YF/JjLrcE1+iPEFul+BBJDWIil+1g5'
			};

			jQuery('.ha-error').hide();
			jQuery('.ha-sync').hide();

			jQuery.ajax({
				url: 'https://api.helloasso.com/oauth2/token',
				type: 'POST',
				dataType: 'json',
				timeout: 30000,
				contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
				data: body,
				beforeSend: function (result) {
					jQuery('.ha-loader').show();
					jQuery('.ha-message').hide();
					jQuery(".searchCampaign").html('<svg class="ldi-igf6j3" width="140px" height="50px" style="margin-top:-15px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" style="background: none;"><!--?xml version="1.0" encoding="utf-8"?--><!--Generator: Adobe Illustrator 21.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)--><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" style="transform-origin: 50px 50px 0px;" xml:space="preserve"><g style="transform-origin: 50px 50px 0px;"><g style="transform-origin: 50px 50px 0px; transform: scale(0.6);"><g style="transform-origin: 50px 50px 0px;"><g><style type="text/css" class="ld ld-fade" style="transform-origin: 50px 50px 0px; animation-duration: 1s; animation-delay: -1s; animation-direction: normal;">.st0{fill:#F4E6C8;} .st1{opacity:0.8;fill:#849B87;} .st2{fill:#D65A62;} .st3{fill:#E15C64;} .st4{fill:#F47E5F;} .st5{fill:#F7B26A;} .st6{fill:#FEE8A2;} .st7{fill:#ACBD81;} .st8{fill:#F5E169;} .st9{fill:#F0AF6B;} .st10{fill:#EA7C60;} .st11{fill:#A8B980;} .st12{fill:#829985;} .st13{fill:#798AAE;} .st14{fill:#8672A7;} .st15{fill:#CC5960;} .st16{fill:#E17A5F;} .st17{fill:#849B87;} .st18{opacity:0.8;fill:#E15C64;} .st19{opacity:0.8;fill:#F7B26A;} .st20{fill:#79A5B5;} .st21{opacity:0.8;fill:#79A5B4;} .st22{fill:#666766;}</style><g class="ld ld-fade" style="transform-origin: 50px 50px 0px; animation-duration: 1s; animation-delay: -0.923077s; animation-direction: normal;"><circle class="st2" cx="20" cy="50" r="10" fill="#ffffff" style="fill: rgb(255, 255, 255);"></circle></g><g class="ld ld-fade" style="transform-origin: 50px 50px 0px; animation-duration: 1s; animation-delay: -0.846154s; animation-direction: normal;"><circle class="st10" cx="50" cy="50" r="10" fill="#b3e9cd" style="fill: rgb(179, 233, 205);"></circle></g><g class="ld ld-fade" style="transform-origin: 50px 50px 0px; animation-duration: 1s; animation-delay: -0.769231s; animation-direction: normal;"><circle class="st9" cx="80" cy="50" r="10" fill="#86ecb6" style="fill: rgb(134, 236, 182);"></circle></g><metadata xmlns:d="https://loading.io/stock/" class="ld ld-fade" style="transform-origin: 50px 50px 0px; animation-duration: 1s; animation-delay: -0.692308s; animation-direction: normal;"><d:name class="ld ld-fade" style="transform-origin: 50px 50px 0px; animation-duration: 1s; animation-delay: -0.615385s; animation-direction: normal;">ellipse</d:name><d:tags class="ld ld-fade" style="transform-origin: 50px 50px 0px; animation-duration: 1s; animation-delay: -0.538462s; animation-direction: normal;">dot,point,circle,waiting,typing,sending,message,ellipse,spinner</d:tags><d:license class="ld ld-fade" style="transform-origin: 50px 50px 0px; animation-duration: 1s; animation-delay: -0.461538s; animation-direction: normal;">cc-by</d:license><d:slug class="ld ld-fade" style="transform-origin: 50px 50px 0px; animation-duration: 1s; animation-delay: -0.384615s; animation-direction: normal;">igf6j3</d:slug></metadata></g></g></g></g><style type="text/css" class="ld ld-fade" style="transform-origin: 50px 50px 0px; animation-duration: 1s; animation-delay: -0.307692s; animation-direction: normal;">@keyframes ld-fade {0% {opacity: 1;}100% {  opacity: 0; }}@-webkit-keyframes ld-fade { 0% { opacity: 1; }100% {opacity: 0;} }.ld.ld-fade {  -webkit-animation: ld-fade 1s infinite linear; animation: ld-fade 1s infinite linear;}</style></svg></svg>');

				},
				complete: function (result) {
				},
				success: function (result) {

					var bearerToken = result.access_token;
					jQuery.ajax({
						url: `https://api.helloasso.com/v5/organizations/${nameAsso}`,
						type: 'GET',
						timeout: 30000,
						headers: {
							'Authorization': 'Bearer ' + bearerToken
						},
						dataType: "json",
						complete: function (ha) {

						},
						success: function (result2) {

							var assoName = result2.name;
							let totalCount = 0; 
							for (let i = 1; i <= 5; i++){      
								
								setTimeout(function () {   
								   console.log(i);

				
								   jQuery.ajax({
									url: `https://api.helloasso.com/v5/organizations/${nameAsso}/forms?pageSize=20&pageIndex=${i}`,
									type: 'GET',
									timeout: 30000,
									headers: {
										'Authorization': 'Bearer ' + bearerToken
									},
									dataType: "json",
									complete: function (result) {
										jQuery('.ha-loader').hide();
									},
									success: function (result3) {
										let count = result3.data.length;
										totalCount += count;
										console.log(result3);
										console.log(count);


										jQuery.ajax({
											url: adminAjax.ajaxurl,
											method: 'POST',
											data: { action: 'ha_ajax', 'name': assoName, 'campaign': result3.data, 'slug': nameAsso, 'error': 0, 'security': adminAjax.ajax_nonce, 'increase': i },
											success: function (data) {
												
												if(totalCount == result3.pagination.totalCount) {
													location.reload();
												}
	
											},
											error: function (data) {
											}
										});
									},
									error: function (xhr, ajaxOptions, thrownError) {
	
										if (ajaxOptions == "timeout") {
											jQuery('.ha-no-sync').show();
											jQuery(".searchCampaign").html('Synchroniser');
											jQuery('.ha-error span').html('Service momentanément indisponible.<br/>Veuillez réessayer plus tard ou contacter le support HelloAsso.');
										}
										else {
											if (xhr.status == 404) {
												jQuery.ajax({
													url: adminAjax.ajaxurl,
													method: 'POST',
													data: { action: 'ha_ajax', 'campaign': '', 'slug': nameAsso, 'error': 1, 'security': adminAjax.ajax_nonce },
													success: function (data) {
	
														location.reload();
	
													},
													error: function (data) {
													}
												});
											}
											else if (xhr.status == 500) {
												jQuery('.ha-no-sync').show();
												jQuery(".searchCampaign").html('Synchroniser');
												jQuery('.ha-error span').html('Service momentanément indisponible.<br/>Veuillez réessayer plus tard ou contacter le support HelloAsso.');
											}
										}
									},
								});

								}, i*1250)
							}


						

						},
						error: function (xhr, ajaxOptions, thrownError) {

							if (ajaxOptions == "timeout") {
								jQuery('.ha-no-sync').show();
								jQuery(".searchCampaign").html('Synchroniser');
								jQuery('.ha-error span').html('Service momentanément indisponible.<br/>Veuillez réessayer plus tard ou contacter le support HelloAsso.');
							}
							else {
								if (xhr.status == 404) {
									jQuery.ajax({
										url: adminAjax.ajaxurl,
										method: 'POST',
										data: { action: 'ha_ajax', 'campaign': '', 'slug': nameAsso, 'error': 1, 'security': adminAjax.ajax_nonce },
										success: function (data) {

											location.reload();

										},
										error: function (data) {
										}
									});
								}
								else if (xhr.status == 500) {
									jQuery('.ha-no-sync').show();
									jQuery(".searchCampaign").html('Synchroniser');
									jQuery('.ha-error span').html('Service momentanément indisponible.<br/>Veuillez réessayer plus tard ou contacter le support HelloAsso.');
								}
							}

						},
					});
				},
				error: function (xhr, ajaxOptions, thrownError) {
					jQuery('.ha-error').show();
					jQuery('.ha-loader').hide();
					jQuery('.ha-error span').html('Service momentanément indisponible.<br/>Veuillez réessayer plus tard ou contacter le support HelloAsso.');
					jQuery(".searchCampaign").html('Synchroniser');
				},
			});
		}
		else {
			jQuery('.ha-no-valid').fadeIn();
			jQuery('.ha-message').hide();
		}
	}
}

const actionTinyMce = data => {
	jQuery(data).parent().clone().prependTo(".ha-campaign-viewer");
	jQuery(".ha-campaign-viewer").find('.ha-focus').removeAttr('onclick');
	jQuery(".ha-campaign-list").hide();
	jQuery(".ha-campaign-viewer").show();
	jQuery(".ha-return").show();
	jQuery(".ha-return").prependTo(".ha-campaign-viewer");
	jQuery(".ha-return:not(:eq(0))").hide();
	var haPopup = document.getElementById('ha-popup');
	haPopup.scrollTop = 0;
}

const haReturn = () => {
	jQuery(".ha-campaign-viewer").find('.ha-focus').parent().remove();
	jQuery(".ha-campaign-list").show();
	jQuery(".ha-campaign-viewer").hide();
	jQuery(".ha-return").fadeOut();
}

const loadViewCampaign = (url, type) => {
	jQuery.get({
		url,
		success: function (data) {
			if (type == 'error_1') {
				jQuery('.content-tab').html(jQuery(data).find('.ha-page-content').html());
				jQuery(".displayNoneTinyMce").css({ "display": "none" });
			}
			else if (type == 'error_2') {
				jQuery('.content-tab').html(jQuery(data).find('.ha-page-content').html());
				jQuery(".displayNoneTinyMce").css({ "display": "none" });
			}
			else {
				jQuery('.content-tab').html(jQuery(data).find('.ha-page-content').html());
				jQuery(".ha-footer").css({ "display": "none" });
				jQuery(".ha-logo-footer").css({ "display": "none" });
				jQuery('.ha-campaign-viewer').css({ "display": "none" });
				jQuery('.close-campaign-viewer').css({ "display": "none" });
			}

			var haPopup = document.getElementById('ha-popup');
			haPopup.scrollTop = 0;
		}
	});
}

function insertIframeInTinyMce(data) {
	var type = jQuery(data).attr('data-type');
	var url = jQuery('.lastUrlWidget').val();
	var shortcode = '[helloasso campaign="' + url + '" type="' + type + '"]';
	jQuery('#ha-popup').hide();
	window.location.hash = '';
	var numItems = jQuery('.ha-input-shortcode').length;

	if (numItems > 0) {

		jQuery(".ha-input-shortcode").each(function () {
			var element = jQuery(this);
			if (element.val() == "") {
				jQuery(this).val(shortcode);
				jQuery(this).focus();
			}
		});
	}
	else {
		if (tinyMCE && tinyMCE.activeEditor) {
			tinyMCE.activeEditor.selection.setContent(shortcode);
		} else {
			jQuery('.wp-editor-area').val(jQuery('.wp-editor-area').val() + ' ' + shortcode);
		}
	}


	return false;
}


function openShortcodesCampaign(data) {
	jQuery('.ha-campaign-info').removeClass('ha-focus');
	jQuery('.ha-campaign-info').find('svg').attr('stroke', '#777D9C');

	var el = data;
	jQuery(el).addClass('ha-focus');
	jQuery(el).find('svg').attr('stroke', '#49D38A');

	var url = jQuery(el).attr('data-url');
	url = url.replace(/widget/, '');
	var type = jQuery(el).attr('data-type');

	jQuery('.lastUrlWidget').val(url);
	jQuery(".ha-description-viewer").fadeOut();
	jQuery(".ha-shortcodes-viewer").fadeIn();
	jQuery("#vueBouton").attr('src', url + 'widget-bouton/');

	if (type == "Donation") {
		jQuery(".vignette").hide();
	} else {
		jQuery(".vignette").show();
		jQuery("#vueVignette").attr('src', url + 'widget-vignette/');
	}


	jQuery("#vueVignetteHorizontale").attr('src', url + '/widget-vignette-horizontale/');
	jQuery("#vueForm").attr('src', url + 'widget/');
}

const haCopy = data => {
	jQuery(data).find('.ha-tooltip').animate({ opacity: 1 }, 500, function () {
		setInterval(function () {
			jQuery(data).find('.ha-tooltip').css('opacity', '0');
		}, 3000);
	});
	jQuery('.lastShortcode').remove();
	jQuery(data).after('<input type="text" class="lastShortcode" id="lastShortcode" />');

	var toCopy = document.getElementById('lastShortcode');
	var type = jQuery(data).attr('data-type');
	var url = jQuery('.lastUrlWidget').val();

	jQuery('.lastShortcode').val('[helloasso campaign="' + url + '" type="' + type + '"]');

	toCopy.select();
	document.execCommand('copy');
	return false;
}

// TYPED.JS 

/*!
 * 
 *   typed.js - A JavaScript Typing Animation Library
 *   Author: Matt Boldt <me@mattboldt.com>
 *   Version: v2.0.9
 *   Url: https://github.com/mattboldt/typed.js
 *   License(s): MIT
 * 
 */
(function (t, e) { "object" == typeof exports && "object" == typeof module ? module.exports = e() : "function" == typeof define && define.amd ? define([], e) : "object" == typeof exports ? exports.Typed = e() : t.Typed = e() })(this, function () { return function (t) { function e(n) { if (s[n]) return s[n].exports; var i = s[n] = { exports: {}, id: n, loaded: !1 }; return t[n].call(i.exports, i, i.exports, e), i.loaded = !0, i.exports } var s = {}; return e.m = t, e.c = s, e.p = "", e(0) }([function (t, e, s) { "use strict"; function n(t, e) { if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function") } Object.defineProperty(e, "__esModule", { value: !0 }); var i = function () { function t(t, e) { for (var s = 0; s < e.length; s++) { var n = e[s]; n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(t, n.key, n) } } return function (e, s, n) { return s && t(e.prototype, s), n && t(e, n), e } }(), r = s(1), o = s(3), a = function () { function t(e, s) { n(this, t), r.initializer.load(this, s, e), this.begin() } return i(t, [{ key: "toggle", value: function () { this.pause.status ? this.start() : this.stop() } }, { key: "stop", value: function () { this.typingComplete || this.pause.status || (this.toggleBlinking(!0), this.pause.status = !0, this.options.onStop(this.arrayPos, this)) } }, { key: "start", value: function () { this.typingComplete || this.pause.status && (this.pause.status = !1, this.pause.typewrite ? this.typewrite(this.pause.curString, this.pause.curStrPos) : this.backspace(this.pause.curString, this.pause.curStrPos), this.options.onStart(this.arrayPos, this)) } }, { key: "destroy", value: function () { this.reset(!1), this.options.onDestroy(this) } }, { key: "reset", value: function () { var t = arguments.length <= 0 || void 0 === arguments[0] || arguments[0]; clearInterval(this.timeout), this.replaceText(""), this.cursor && this.cursor.parentNode && (this.cursor.parentNode.removeChild(this.cursor), this.cursor = null), this.strPos = 0, this.arrayPos = 0, this.curLoop = 0, t && (this.insertCursor(), this.options.onReset(this), this.begin()) } }, { key: "begin", value: function () { var t = this; this.typingComplete = !1, this.shuffleStringsIfNeeded(this), this.insertCursor(), this.bindInputFocusEvents && this.bindFocusEvents(), this.timeout = setTimeout(function () { t.currentElContent && 0 !== t.currentElContent.length ? t.backspace(t.currentElContent, t.currentElContent.length) : t.typewrite(t.strings[t.sequence[t.arrayPos]], t.strPos) }, this.startDelay) } }, { key: "typewrite", value: function (t, e) { var s = this; this.fadeOut && this.el.classList.contains(this.fadeOutClass) && (this.el.classList.remove(this.fadeOutClass), this.cursor && this.cursor.classList.remove(this.fadeOutClass)); var n = this.humanizer(this.typeSpeed), i = 1; return this.pause.status === !0 ? void this.setPauseStatus(t, e, !0) : void (this.timeout = setTimeout(function () { e = o.htmlParser.typeHtmlChars(t, e, s); var n = 0, r = t.substr(e); if ("^" === r.charAt(0) && /^\^\d+/.test(r)) { var a = 1; r = /\d+/.exec(r)[0], a += r.length, n = parseInt(r), s.temporaryPause = !0, s.options.onTypingPaused(s.arrayPos, s), t = t.substring(0, e) + t.substring(e + a), s.toggleBlinking(!0) } if ("`" === r.charAt(0)) { for (; "`" !== t.substr(e + i).charAt(0) && (i++, !(e + i > t.length));); var u = t.substring(0, e), l = t.substring(u.length + 1, e + i), c = t.substring(e + i + 1); t = u + l + c, i-- } s.timeout = setTimeout(function () { s.toggleBlinking(!1), e === t.length ? s.doneTyping(t, e) : s.keepTyping(t, e, i), s.temporaryPause && (s.temporaryPause = !1, s.options.onTypingResumed(s.arrayPos, s)) }, n) }, n)) } }, { key: "keepTyping", value: function (t, e, s) { 0 === e && (this.toggleBlinking(!1), this.options.preStringTyped(this.arrayPos, this)), e += s; var n = t.substr(0, e); this.replaceText(n), this.typewrite(t, e) } }, { key: "doneTyping", value: function (t, e) { var s = this; this.options.onStringTyped(this.arrayPos, this), this.toggleBlinking(!0), this.arrayPos === this.strings.length - 1 && (this.complete(), this.loop === !1 || this.curLoop === this.loopCount) || (this.timeout = setTimeout(function () { s.backspace(t, e) }, this.backDelay)) } }, { key: "backspace", value: function (t, e) { var s = this; if (this.pause.status === !0) return void this.setPauseStatus(t, e, !0); if (this.fadeOut) return this.initFadeOut(); this.toggleBlinking(!1); var n = this.humanizer(this.backSpeed); this.timeout = setTimeout(function () { e = o.htmlParser.backSpaceHtmlChars(t, e, s); var n = t.substr(0, e); if (s.replaceText(n), s.smartBackspace) { var i = s.strings[s.arrayPos + 1]; i && n === i.substr(0, e) ? s.stopNum = e : s.stopNum = 0 } e > s.stopNum ? (e--, s.backspace(t, e)) : e <= s.stopNum && (s.arrayPos++, s.arrayPos === s.strings.length ? (s.arrayPos = 0, s.options.onLastStringBackspaced(), s.shuffleStringsIfNeeded(), s.begin()) : s.typewrite(s.strings[s.sequence[s.arrayPos]], e)) }, n) } }, { key: "complete", value: function () { this.options.onComplete(this), this.loop ? this.curLoop++ : this.typingComplete = !0 } }, { key: "setPauseStatus", value: function (t, e, s) { this.pause.typewrite = s, this.pause.curString = t, this.pause.curStrPos = e } }, { key: "toggleBlinking", value: function (t) { this.cursor && (this.pause.status || this.cursorBlinking !== t && (this.cursorBlinking = t, t ? this.cursor.classList.add("typed-cursor--blink") : this.cursor.classList.remove("typed-cursor--blink"))) } }, { key: "humanizer", value: function (t) { return Math.round(Math.random() * t / 2) + t } }, { key: "shuffleStringsIfNeeded", value: function () { this.shuffle && (this.sequence = this.sequence.sort(function () { return Math.random() - .5 })) } }, { key: "initFadeOut", value: function () { var t = this; return this.el.className += " " + this.fadeOutClass, this.cursor && (this.cursor.className += " " + this.fadeOutClass), setTimeout(function () { t.arrayPos++, t.replaceText(""), t.strings.length > t.arrayPos ? t.typewrite(t.strings[t.sequence[t.arrayPos]], 0) : (t.typewrite(t.strings[0], 0), t.arrayPos = 0) }, this.fadeOutDelay) } }, { key: "replaceText", value: function (t) { this.attr ? this.el.setAttribute(this.attr, t) : this.isInput ? this.el.value = t : "html" === this.contentType ? this.el.innerHTML = t : this.el.textContent = t } }, { key: "bindFocusEvents", value: function () { var t = this; this.isInput && (this.el.addEventListener("focus", function (e) { t.stop() }), this.el.addEventListener("blur", function (e) { t.el.value && 0 !== t.el.value.length || t.start() })) } }, { key: "insertCursor", value: function () { this.showCursor && (this.cursor || (this.cursor = document.createElement("span"), this.cursor.className = "typed-cursor", this.cursor.innerHTML = this.cursorChar, this.el.parentNode && this.el.parentNode.insertBefore(this.cursor, this.el.nextSibling))) } }]), t }(); e["default"] = a, t.exports = e["default"] }, function (t, e, s) { "use strict"; function n(t) { return t && t.__esModule ? t : { "default": t } } function i(t, e) { if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function") } Object.defineProperty(e, "__esModule", { value: !0 }); var r = Object.assign || function (t) { for (var e = 1; e < arguments.length; e++) { var s = arguments[e]; for (var n in s) Object.prototype.hasOwnProperty.call(s, n) && (t[n] = s[n]) } return t }, o = function () { function t(t, e) { for (var s = 0; s < e.length; s++) { var n = e[s]; n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(t, n.key, n) } } return function (e, s, n) { return s && t(e.prototype, s), n && t(e, n), e } }(), a = s(2), u = n(a), l = function () { function t() { i(this, t) } return o(t, [{ key: "load", value: function (t, e, s) { if ("string" == typeof s ? t.el = document.querySelector(s) : t.el = s, t.options = r({}, u["default"], e), t.isInput = "input" === t.el.tagName.toLowerCase(), t.attr = t.options.attr, t.bindInputFocusEvents = t.options.bindInputFocusEvents, t.showCursor = !t.isInput && t.options.showCursor, t.cursorChar = t.options.cursorChar, t.cursorBlinking = !0, t.elContent = t.attr ? t.el.getAttribute(t.attr) : t.el.textContent, t.contentType = t.options.contentType, t.typeSpeed = t.options.typeSpeed, t.startDelay = t.options.startDelay, t.backSpeed = t.options.backSpeed, t.smartBackspace = t.options.smartBackspace, t.backDelay = t.options.backDelay, t.fadeOut = t.options.fadeOut, t.fadeOutClass = t.options.fadeOutClass, t.fadeOutDelay = t.options.fadeOutDelay, t.isPaused = !1, t.strings = t.options.strings.map(function (t) { return t.trim() }), "string" == typeof t.options.stringsElement ? t.stringsElement = document.querySelector(t.options.stringsElement) : t.stringsElement = t.options.stringsElement, t.stringsElement) { t.strings = [], t.stringsElement.style.display = "none"; var n = Array.prototype.slice.apply(t.stringsElement.children), i = n.length; if (i) for (var o = 0; o < i; o += 1) { var a = n[o]; t.strings.push(a.innerHTML.trim()) } } t.strPos = 0, t.arrayPos = 0, t.stopNum = 0, t.loop = t.options.loop, t.loopCount = t.options.loopCount, t.curLoop = 0, t.shuffle = t.options.shuffle, t.sequence = [], t.pause = { status: !1, typewrite: !0, curString: "", curStrPos: 0 }, t.typingComplete = !1; for (var o in t.strings) t.sequence[o] = o; t.currentElContent = this.getCurrentElContent(t), t.autoInsertCss = t.options.autoInsertCss, this.appendAnimationCss(t) } }, { key: "getCurrentElContent", value: function (t) { var e = ""; return e = t.attr ? t.el.getAttribute(t.attr) : t.isInput ? t.el.value : "html" === t.contentType ? t.el.innerHTML : t.el.textContent } }, { key: "appendAnimationCss", value: function (t) { var e = "data-typed-js-css"; if (t.autoInsertCss && (t.showCursor || t.fadeOut) && !document.querySelector("[" + e + "]")) { var s = document.createElement("style"); s.type = "text/css", s.setAttribute(e, !0); var n = ""; t.showCursor && (n += "\n        .typed-cursor{\n          opacity: 1;\n        }\n        .typed-cursor.typed-cursor--blink{\n          animation: typedjsBlink 0.7s infinite;\n          -webkit-animation: typedjsBlink 0.7s infinite;\n                  animation: typedjsBlink 0.7s infinite;\n        }\n        @keyframes typedjsBlink{\n          50% { opacity: 0.0; }\n        }\n        @-webkit-keyframes typedjsBlink{\n          0% { opacity: 1; }\n          50% { opacity: 0.0; }\n          100% { opacity: 1; }\n        }\n      "), t.fadeOut && (n += "\n        .typed-fade-out{\n          opacity: 0;\n          transition: opacity .25s;\n        }\n        .typed-cursor.typed-cursor--blink.typed-fade-out{\n          -webkit-animation: 0;\n          animation: 0;\n        }\n      "), 0 !== s.length && (s.innerHTML = n, document.body.appendChild(s)) } } }]), t }(); e["default"] = l; var c = new l; e.initializer = c }, function (t, e) { "use strict"; Object.defineProperty(e, "__esModule", { value: !0 }); var s = { strings: ["These are the default values...", "You know what you should do?", "Use your own!", "Have a great day!"], stringsElement: null, typeSpeed: 0, startDelay: 0, backSpeed: 0, smartBackspace: !0, shuffle: !1, backDelay: 700, fadeOut: !1, fadeOutClass: "typed-fade-out", fadeOutDelay: 500, loop: !1, loopCount: 1 / 0, showCursor: !0, cursorChar: "|", autoInsertCss: !0, attr: null, bindInputFocusEvents: !1, contentType: "html", onComplete: function (t) { }, preStringTyped: function (t, e) { }, onStringTyped: function (t, e) { }, onLastStringBackspaced: function (t) { }, onTypingPaused: function (t, e) { }, onTypingResumed: function (t, e) { }, onReset: function (t) { }, onStop: function (t, e) { }, onStart: function (t, e) { }, onDestroy: function (t) { } }; e["default"] = s, t.exports = e["default"] }, function (t, e) { "use strict"; function s(t, e) { if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function") } Object.defineProperty(e, "__esModule", { value: !0 }); var n = function () { function t(t, e) { for (var s = 0; s < e.length; s++) { var n = e[s]; n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(t, n.key, n) } } return function (e, s, n) { return s && t(e.prototype, s), n && t(e, n), e } }(), i = function () { function t() { s(this, t) } return n(t, [{ key: "typeHtmlChars", value: function (t, e, s) { if ("html" !== s.contentType) return e; var n = t.substr(e).charAt(0); if ("<" === n || "&" === n) { var i = ""; for (i = "<" === n ? ">" : ";"; t.substr(e + 1).charAt(0) !== i && (e++, !(e + 1 > t.length));); e++ } return e } }, { key: "backSpaceHtmlChars", value: function (t, e, s) { if ("html" !== s.contentType) return e; var n = t.substr(e).charAt(0); if (">" === n || ";" === n) { var i = ""; for (i = ">" === n ? "<" : "&"; t.substr(e - 1).charAt(0) !== i && (e--, !(e < 0));); e-- } return e } }]), t }(); e["default"] = i; var r = new i; e.htmlParser = r }]) });
//# sourceMappingURL=typed.min.js.map
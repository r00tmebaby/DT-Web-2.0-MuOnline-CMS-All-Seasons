/* 
 * JavaScript classes for dmnmucms
 * Author: neo6 <Salvis87@inbox.lv>
 *
 */

var App = {
	user_info: [],
	nameRegex: /^[0-9a-zA-Z_-]+$/,
	lc: null,
	item_slot: -1,
	first: true,
	page: false,
	clicks: 0,
	login: 0,
	isfirst: false,
	events_time: [],
	initialize: function () {
		App.detectIE();
		App.ajaxSetup();

		if (DmNConfig.ajax_page_load == 1) {
			App.historyPush();
		}

		$('#login_form').on('submit', function (e) {
			e.preventDefault();
			App.setUserInfo([$('#login_input').val(), $('#password_input').val()]);
			App.loginAccount();
		});

		$("#password_change_form").validationEngine('attach', {
			scroll: false,
			onValidationComplete: function (form, status) {
				if (status == true) {
					App.changePass(form);
				}
			}
		});

		$("#email_change_form").validationEngine('attach', {
			scroll: false,
			onValidationComplete: function (form, status) {
				if (status == true) {
					App.changeEmail(form);
				}
			}
		});

		$("#set_new_email_form").validationEngine('attach', {
			scroll: false,
			onValidationComplete: function (form, status) {
				if (status == true) {
					App.setNewEmail(form);
				}
			}
		});

		$(".tabrow li").on('click', function () {
			$(this).addClass("selected").siblings().removeClass("selected");
			var id = $(this).parent().parent().find("li").index(this);
			$(this).parent().parent().parent().find(".rankings").css({
				display: "none"
			}).eq(id).css({
				display: "block"
			});
		});
		$('a[id^="lang_"]').on("click", function (e) {
			e.preventDefault();
			var lang = $(this).attr("id").split('_').slice(1).join('_');
			App.switchLanguage(lang);
		});
		$('div[id^="rankings_select_"] a').each(function () {
			$(this).on("click", function (e) {
				var href = $.trim($(this).attr("href"));
				if (href.indexOf("javascript:") !== -1) {
					e.preventDefault();
					var rankings = $(this).attr("id").split("_")[0],
						server = $(this).attr("id").split("_").slice(2).join('_');
					App.populateRanking(rankings, server);
				}
			});
		});
		$('a[id^="switch_top_"]').on("click", function (e) {
			e.preventDefault();
			var count = $(this).attr('data-count'),
				rank = $(this).attr('id').split('_')[2],
				server = $(this).attr('id').split('_').slice(3).join('_');
			App.populateSidebarRanking(rank, server, count);
		});

		$('button[id^="vote-"]').on('click', function () {
			App.vote($(this));
		});
		$('a[id^="reset-char-"]').on('click', function (e) {
			e.preventDefault();
			App.resetCharacter($(this).attr("id").split("-")[2]);
		});
		$('a[id^="greset-char-"]').on('click', function (e) {
			e.preventDefault();
			App.gresetCharacter($(this).attr("id").split("-")[2]);
		});
		$('a[id^="reset-stats-char-"]').on('click', function (e) {
			e.preventDefault();
			var character = $(this).attr("id").split("-")[3];
			if (parseInt($('#new-stats-' + character).text()) == 0) {
				App.notice(App.lc.translate('Error').fetch(), 'error', App.lc.translate('Your stats are already reseted.').fetch());
			}
			else {
				if (App.confirmMessage(App.lc.translate('This Function Will Transfer All Yout Stats To Free Points. Are you sure?').fetch())) {
					App.resetStats(character);
				}
			}
		});

		$('a[id^="reset-skilltree-char-"]').on('click', function (e) {
			e.preventDefault();
			if (App.confirmMessage(App.lc.translate('This Function Will Reset Your SkillTree. Are you sure?').fetch())) {
				App.resetSkillTree($(this).attr("id").split("-")[3]);
			}
		});
		$('a[id^="pkclear-char-"]').on('click', function (e) {
			e.preventDefault();
			App.pkClear($(this).attr("id").split("-")[2]);
		});
		$("#add_stats").validationEngine({scroll: false});

		$('a[id^="shop_item_title_"],img[id^="vote_image_"], a[id^="ref-reward-"]').each(function () {
			App.initializeTooltip($(this), false);
		});

		App.initializeModalBoxes();

		$('button[id^="buy_paypal_"]').on('click', function () {
			var div_data = $(this).attr('id').split('_'),
				reward = $('#reward_' + div_data[2]).text(),
				price = $('#price_' + div_data[2]).data("price-tax"),
				currency = $('#currency_' + div_data[2]).text();
			App.submit_paypal(div_data[2], reward, price, currency, div_data[3]);
		});

		$('button[id^="buy_paycall_"]').on('click', function () {
			App.submit_paycall($(this).attr('id').split('_')[2]);
		});

		var option_buttons_selector = $('#option_buttons'),
			sell_item_selector = $('#sell_item');

		$('.wh_items div[id^="item-slot-"]').on('mousedown', function (e) {
			App.item_slot = $(this).attr('id').split('-')[2];
			switch (e.which) {
				case 1:

					if (option_buttons_selector.is(":visible") == false) {
						option_buttons_selector.slideToggle('slow');
						if (sell_item_selector.is(":visible") == true) {
							sell_item_selector.slideToggle('slow');
							$('#sell_item_form').get(0).reset();
						}
					}
					else if (option_buttons_selector.is(":visible") == true) {
						if (sell_item_selector.is(":visible") == true) {
							sell_item_selector.slideToggle('slow');
							$('#sell_item_form').get(0).reset();
						}
					}
					break;
				case 3:
					App.deleteItem();
					break;
			}
		});

		$('#sell_item_show').on('click', function () {
			if (sell_item_selector.is(":visible") == false) {
				sell_item_selector.slideToggle('slow');
			}

		});

		$('#sell_item_button').on('click', function (e) {
			e.preventDefault();
			App.sellItem($('#sell_item_form'));
		});

		$('#move_to_web_wh').on('click', function () {
			App.moveItemToWeb();
			if (sell_item_selector.is(":visible") == true) {
				sell_item_selector.slideToggle('slow');
				$('#sell_item_form').get(0).reset();
			}
		});

		$('a[id^="move_to_game_wh_"]').on('click', function (e) {
			e.preventDefault();
			App.moveItemToGame($(this).attr('data-id'));
		});

		$('#clear_inv_button').on('click', function (e) {
			e.preventDefault();
			App.clearInventory($('#clear_inventory_form'));
		});

		$('#buy_level_button').on('click', function (e) {
			e.preventDefault();
			App.buyLevel($('#buy_level_form'));
		});

		$('#buy_points_button').on('click', function (e) {
			e.preventDefault();
			App.buyPoints($('#buy_stats_form'));
		});

		$('#buy_gm_button').on('click', function (e) {
			e.preventDefault();
			App.buyGM($('#buy_gm_form'));
		});

		$('#select_char').on('change', function (e) {
			e.preventDefault();
			App.loadClassList($(this).val());
		});

		$('#buy_class_button').on('click', function (e) {
			e.preventDefault();
			App.buyClass($('#buy_class_form'));
		});

		$('#switch_server').on('change', function () {
			if ($(this).val() != '') {
				App.switchServer($(this).val());
			}
		});
		$('#hide_chars').on('click', function () {
			App.hideChars();
		});
		$('#exchange_wcoins').on('click', function (e) {
			e.preventDefault();
			App.exchangeWCoins($('#credits').val());
		});

		$('a[id^="switch_items_"]').on('click', function (e) {
            var server = $(this).attr('id').split('_').slice(2).join('_'), 
                count = $(this).attr('data-count'),
                limit = $(this).attr('data-limit')
			e.preventDefault();
			App.loadLatestItems(server, count, limit);
		});

		$('ul.wallpapers li, ul.screens li').each(function () {
			$(this).hover(function () {
				$('img', this).fadeToggle(1000);
				$(this).find('.gallery-controls').remove();
				$(this).append('<div class="well gallery-controls"><p><a href="#" class="img-download btn">Download</a></p></div>');
				$(this).find('.gallery-controls').stop().animate({'margin-top': '-1'}, 400, 'easeInQuint');
			}, function () {
				$('img', this).fadeToggle(1000);
				$(this).find('.gallery-controls').stop().animate({'margin-top': '-30'}, 200, 'easeInQuint', function () {
					$(this).remove();
				});
			});
		});

		$('.thumbnails').on('click', '.img-download', function (e) {
			e.preventDefault();
			App.downloadImage($(this));
		});

		var rotate = setInterval(function () {
			App.rotateBanner();
		}, 5000);

		$(".rollingIcon button").on('click', function () {
			$("#col1").find(".items").animate({"left": $(this).attr("data-pic") * -617 + "px"}, 500);
			$(".rollingIcon button").removeClass();
			$(this).addClass("active");
			clearInterval(rotate);
		});

		serverTime.init("ServerTime", "LocalTime");

		$('#make_bet').on('click', function (e) {
			e.preventDefault();
			App.makeBet($('#auction_form').serialize());
		});

		$('input[id^="charname-"]').on("change", function () {
			var oldN = $(this).attr("id").split("-")[1],
				newN = $(this).attr("value");
			App.changeName(oldN, newN);
		});
	},
	ajaxSetup: function () {
		$.ajaxSetup({
			type: 'POST',
			dataType: 'json',
			error: function (jqXHR, exception) {
				if (jqXHR.status == 404) {
					App.notice(App.lc.translate('Error').fetch(), 'error', App.lc.translate('Requested page not found. [404]').fetch());
				}
				else if (jqXHR.status == 500) {
					App.notice(App.lc.translate('Error').fetch(), 'error', App.lc.translate('Internal Server Error [500]').fetch());
				}
				else if (exception === 'parsererror') {
					App.trowJsException(jqXHR.responseText);
				}
				else if (exception === 'timeout') {
					App.notice(App.lc.translate('Error').fetch(), 'error', App.lc.translate('Time out error.').fetch());
				}
				else if (exception === 'abort') {
					App.notice(App.lc.translate('Error').fetch(), 'error', App.lc.translate('Ajax request aborted.').fetch());
				}
			}
		});
		$(document).ajaxSuccess(function () {
			$('#exception').fadeOut();
		});
	},
	detectIE: function () {
		if ($('html').hasClass('ie7')) {
			$('body').html('<div style="position:absolute; width:100%; height:100%"><img style="display: block; margin: 0 auto;" src="' + DmNConfig.base_url + 'assets/' + DmNConfig.tmp_dir + '/images/warn_ie.png" /><p style="text-align:center;font-size: 20px;color: red;">'+App.lc.translate('Please use IE Version 8 AND Above').fetch()+'</p></div>');
		}

	},
	trowJsException: function (text) {
		var exception = $('#exception'),
			container = $('#container');
		exception.html(text);
		if (container.find("p").length != 0) {
			exception.html(container.find("p").text()).fadeIn();
		}
		else {
			exception.find('br').remove();
			exception.fadeIn();
		}

	},
	initLocalization: function(){
		App.lc = new Jed({
			'locale_data': App.locale,
			'domain': 'messages'
		});
	},
	historyPush: function () {
		if (history.pushState) {
			$("a[href*='" + DmNConfig.base_url + "']").each(function () {
				if ($(this).attr("target") != "_blank") {
					$(this).on('click', function (e) {
						var href = $(this).attr("href");
						if (App.page != false) {
							if (App.page == href) {
								return false;
							}
						}
						if (App.loadPage(href) == true) {
							history.pushState('', 'New URL: ' + href, href);
							e.preventDefault();
						}
						else {
							window.location = href;
						}
					});
				}
			});
		}
	},
	loadPage: function (link) {
		$("body").css("cursor", "wait");
		$('#registration_form').validationEngine('hideAll');
		$('#password_change_form').validationEngine('hideAll');
		if (App.first) {
			App.first = false;
			$(window).on('popstate', function () {
				App.loadPage(location.pathname);
			});
		}
		App.page = link;
		if (/logout/.test(link)) {
			window.location = link;
		}
		else {
			var status = true;
			$.ajax({
				url: link,
				data: {ajax: '1'},
				async: false,
				success: function (json_data) {
					if (typeof json_data.error != 'undefined') {
						status = false;
					}
					else {
						if (App.page == link) {
							$("body").css("cursor", "default");
							if (json_data != null) {
								var html = new EJS({url: DmNConfig.base_url + 'assets/' + DmNConfig.tmp_dir + '/js_templates/' + json_data.template}).render(json_data);
								$("#content_center").animate({opacity: 0}, function () {
									$("#content_center").html(html);
									if (App.clicks % 5 == 0) {
										App.changeServerInfo(0);
										App.showTime('ServerTime');
									}
									App.clicks += 1;
									App.historyPush();
									if (typeof json_data.tooltip != 'undefined') {
										$(json_data.tooltip).each(function () {
											App.initializeTooltip($(this), json_data.callback);

										});
									}
								}).animate({opacity: 1});
								App.setTitle(json_data.title);
							}
							else {
								App.setTitle('Error');
								App.notice(App.lc.translate('Error').fetch(), 'error', App.lc.translate('Unable to load data.').fetch());
								status = false;
							}
						}
					}
				},
				error: function () {
					if (App.page == link) {
						$("body").css("cursor", "default");
						App.setTitle('Error');
						App.notice(App.lc.translate('Error').fetch(), 'error', App.lc.translate('The page could not be loaded with javascript.').fetch());
					}
					status = false;
				}
			});
			return status;
		}
	},
	setTitle: function (page) {
		if ($.isArray(page)) {
			var tmp = '';
			for (var i = 0; i < page.length; i++) {
				if (i == page.length - 1) {
					tmp += page[i];
				}
				else {
					tmp += page[i] + ' &raquo; ';
				}
			}
			page = tmp;
		}
		$("title").html('DmN MUCMS &raquo; ' + page);
		$(".title1 h2").html(page);
	},
	showLoader: function () {
		$('#loading').fadeIn(300);
	},
	hideLoader: function () {
		$('#loading').fadeOut(300);
	},
	setUserInfo: function (params) {
		App.user_info[0] = params[0];
		App.user_info[1] = params[1];
	},
	loginAccount: function () {
		if (App.user_info[0] == '') {
			App.notice(App.lc.translate('Error').fetch(), 'error', App.lc.translate('Please enter username.').fetch());
		}
		else {		
			if (App.user_info[0].match(App.nameRegex) == null) {
				App.notice(App.lc.translate('Error').fetch(), 'error', App.lc.translate('The username you entered is invalid.').fetch());
			}
			else {
				if (App.user_info[1] == '') {
					App.notice(App.lc.translate('Error').fetch(), 'error', App.lc.translate('Please enter password.').fetch());
				}
				else {
					if ($("#switch_server").length == 0) {
						App.loginUser();
					}
					else {
						App.login = 1;
						//var server = App.readCookie('DmN_Current_User_Server_'+App.user_info[0]);
						//if (server !== null) {
						//	App.loginUser(server);
						//}
						//else{
							$('#server_click').trigger("click");
						//}
					}
				}
			}	
		}
	},
	loginUser: function (data) {
		var dataToSend = '';
		if (typeof(data) != "undefined") {
			dataToSend = '&' + $.param({'username': App.user_info[0], 'password': App.user_info[1], 'server': data});
		}
		else {
			dataToSend = '&' + $.param({'username': App.user_info[0], 'password': App.user_info[1]});
		}
		$.ajax({
			url: DmNConfig.base_url + 'ajax/login',
			data: dataToSend,
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					var stycky = 0;
					if(typeof data.stycky != 'undefined'){
						stycky = 1
					}
					App.notice(App.lc.translate('Error').fetch(), 'error', data.error, stycky);
				}
				if (data.success) {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success, 1);
					setTimeout(function () {
						if(window.location.href.indexOf("return") > -1){
							var $return = location.search.split('return=')[1];
							location.href = DmNConfig.base_url + $return;
						}
						else{
							location.href = DmNConfig.base_url + 'account-panel';
						}
					}, 2000);
				}
			}
		});
	},
	switchServer: function (server) {
		if (App.login == 1) {
			App.loginUser(server);
		}
		else {
			$.ajax({
				url: DmNConfig.base_url + 'ajax/switch_server',
				data: {server: server},
				beforeSend: function () {
					App.showLoader();
				},
				complete: function () {
					App.hideLoader();
				},
				success: function (data) {
					if (data.error) {
						App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
					}
					else {
						App.notice(App.lc.translate('Success').fetch(), 'success', data.success, 1);
						setTimeout(function () {
							location.href = window.location.href;
						}, 1000);
					}
				}
			});
		}
	},
	registerAccount: function (form, ajax_message) {
		$.ajax({
			url: DmNConfig.base_url + 'registration/create_account',
			data: form.serialize(),
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					if ($.isArray(data.error)) {
						$.each(data.error, function (key, val) {
							App.notice(App.lc.translate('Error').fetch(), 'error', val);
						});
					}
					else {
						App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
					}
					if (typeof DmNConfig.use_recaptcha != 'undefined') {
						$("#recaptcha_reload").click();
					}
					if (typeof DmNConfig.use_recaptcha_v2 != 'undefined') {
						grecaptcha.reset();
					}
				}
				else {
					if (typeof ajax_message != "undefined") {
						App.notice(App.lc.translate('Success').fetch(), 'success', App.lc.translate('You account has been successfully created').fetch());
					}
					else {
						var link = DmNConfig.base_url + 'registration/success';
						if (DmNConfig.ajax_page_load == 1) {
							if (App.loadPage(link) == true) {
								history.pushState('', 'New URL: ' + link, link);
								return false;
							}
							else {
								window.location = link;
							}
						}
						else {
							window.location = link;
						}
					}
				}
			}
		});
	},
	checkUserStatus: function () {
		var good = false;
		$.ajax({
			url: DmNConfig.base_url + 'ajax/status',
			async: false,
			success: function (data) {
				if (data.error) {
					good = false;
					App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
				}
				else {
					good = true;
				}
			}
		});
		return good;
	},
	checkCredits: function (payment_method, credits, gcredits) {
		var good = false;
		$.ajax({
			url: DmNConfig.base_url + 'ajax/checkcredits',
			async: false,
			data: {payment_method: payment_method, credits: credits, gcredits: gcredits},
			success: function (data) {
				if (data.error) {
					good = false;
					App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
				}
				else {
					good = true;
				}
			}
		});
		return good;
	},
	changePass: function (form) {
		$.ajax({
			url: DmNConfig.base_url + 'ajax/change_password',
			data: $(form).serialize(),
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					if ($.isArray(data.error)) {
						$.each(data.error, function (key, val) {
							App.notice(App.lc.translate('Error').fetch(), 'error', val);
						});
					}
					else {
						App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
					}
				}
				else {
					if ($.isArray(data.success)) {
						$.each(data.success, function (key, val) {
							App.notice(App.lc.translate('Success').fetch(), 'success', val);
						});
					}
					else {
						App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
					}
					setTimeout(function () {
						location.href = DmNConfig.base_url;
					}, 3000);

				}
			}
		});
	},
	changeEmail: function (form) {
		$.ajax({
			url: DmNConfig.base_url + 'ajax/change_email',
			data: $(form).serialize(),
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					if ($.isArray(data.error)) {
						$.each(data.error, function (key, val) {
							App.notice(App.lc.translate('Error').fetch(), 'error', val);
						});
					}
					else {
						App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
					}
				}
				else {
					if ($.isArray(data.success)) {
						$.each(data.success, function (key, val) {
							App.notice(App.lc.translate('Success').fetch(), 'success', val);
						});
					}
					else {
						App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
					}
				}
			}
		});
	},
	setNewEmail: function (form) {
		$.ajax({
			url: DmNConfig.base_url + 'ajax/set_new_email',
			data: $(form).serialize(),
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					if ($.isArray(data.error)) {
						$.each(data.error, function (key, val) {
							App.notice(App.lc.translate('Error').fetch(), 'error', val);
						});
					}
					else {
						App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
					}
				}
				else {
					if ($.isArray(data.success)) {
						$.each(data.success, function (key, val) {
							App.notice(App.lc.translate('Success').fetch(), 'success', val);
						});
					}
					else {
						App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
					}
				}
			}
		});
	},
	addRefferalReward: function (char, id) {
		$.ajax({
			url: DmNConfig.base_url + 'ajax/add_ref_reward',
			data: {char: char, id: id},
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
				}
				else {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success);

				}
			}
		});
	},
	populateRanking: function (rank, server, c_class) {
		if (typeof(c_class) != "undefined" && c_class != 'all') {
			dataToSend = '&' + $.param({'type': rank, 'server': server, 'class': c_class});
		}
		else {
			dataToSend = '&' + $.param({'type': rank, 'server': server});
		}

		$.ajax({
			type: 'POST',
			url: DmNConfig.base_url + 'rankings/load_ranking_data',
			data: dataToSend,
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
				}
				else {
					EJS.config({cache: false});
					var html = new EJS({url: DmNConfig.base_url + 'assets/' + DmNConfig.tmp_dir + '/js_templates/' + 'rank_' + rank}).render(data);
					$("#rankings_content_" + server).html(html);

				}
			}
		});
	},
	populateSidebarRanking: function (rank, server, top) {
		dataToSend = '&' + $.param({'type': rank, 'server': server, 'top': top});
		$.ajax({
			type: 'POST',
			url: DmNConfig.base_url + 'rankings/load_ranking_data',
			data: dataToSend,
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
				}
				else {
                    EJS.config({cache: true});
					var html = new EJS({url: DmNConfig.base_url + 'assets/' + DmNConfig.tmp_dir + '/js_templates/' + 'sidebar_rank_' + rank}).render(data);
					$("#top_" + rank).html(html);

				}
			}
		});
	},
	vote: function (link) {
		var butnum = link.attr('id').split("-")[1];
		var reward_type = link.attr('id').split("-")[2]
		if (link.text() != App.lc.translate('Vote Now!').fetch()) {
			App.notice(App.lc.translate('Error').fetch(), 'error', App.lc.translate('You have already voted for this link.').fetch());
		}
		else {
			window.open(link.attr('data-link'), '_blank');
			var counter = (link.attr('data-link').search(/postback=|pingUsername=|in-(.*)-|incentive=/) > 0) ? parseInt($('#counter-'+butnum).text())+20 : parseInt($('#counter-'+butnum).text());
			var timeout = (link.attr('data-link').search(/postback=|pingUsername=|in-(.*)-|incentive=/) > 0) ? (parseInt($('#counter-'+butnum).text())+20)*1000 : parseInt($('#counter-'+butnum).text())*1000;

			link.text(App.lc.translate('Validating').fetch());
			$('#vote-options button').each(function () {
				$(this).attr("disabled", "disabled");
			});
			$('#counter-' + butnum).fadeIn('slow');
			interval = setInterval(function () {
				counter -= 1;
				if (counter == 1) {
					clearInterval(interval);
					counter = (link.attr('data-link').search(/postback=|pingUsername=|in-(.*)-|incentive=/) > 0) ? parseInt($('#counter-'+butnum).text())+20 : parseInt($('#counter-'+butnum).text());
					$('#counter-' + butnum).fadeOut('fast');
				}
				$('#counter-' + butnum).html(counter);
			}, 1000);
			setTimeout(function () {
				$.ajax({
					url: DmNConfig.base_url + "ajax/vote",
					data: {vote: butnum},
					success: function (data) {
						if (data.error) {
							App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
							$('#vote-options button').each(function () {
								if ($(this).attr("data-info") != 'voted') {
									$(this).removeAttr("disabled");
								}
							});
							$('#vote-' + butnum + '-' + reward_type).html(App.lc.translate('Vote Now!').fetch());
						}
						else {
							if (data.success_mmotop) {
								App.notice(App.lc.translate('Success').fetch(), 'success', data.success_mmotop);
								$('#vote-options button').each(function () {
									if ($(this).attr("data-info") != 'voted') {
										$(this).removeAttr("disabled");
									}
								});
								$('#vote-' + butnum + '-' + reward_type).html(App.lc.translate('Vote Now!').fetch());
							}
							else {
								App.notice(App.lc.translate('Success').fetch(), 'success', data.success);

								var credits = (reward_type == 1) ? $('#my_credits').text().replace(/,/g, '') : $('#my_gold_credits').text().replace(/,/g, ''),
									new_credits = App.formatMoney(parseInt(credits) + parseInt(data.reward), 0, ',', ',');
								if (reward_type == 1) {
									$('#my_credits').fadeOut('slow').html(new_credits).fadeIn('slow');
								}
								else {
									$('#my_gold_credits').fadeOut('slow').html(new_credits).fadeIn('slow');
								}
								$('#vote-options button').each(function () {
									if ($(this).attr("id").split("-")[1] != butnum && $(this).attr("data-info") != 'voted') {
										$(this).removeAttr("disabled");
									}
								});
								$('#vote-' + butnum + '-' + reward_type).html(data.next_vote);
								$('#vote-' + butnum + '-' + reward_type).attr('data-info', 'voted');
							}
						}
					}
				});
			}, timeout);

		}
	},
	resetCharacter: function (character) {
		$.ajax({
			url: DmNConfig.base_url + 'ajax/reset_character',
			data: {character: character},
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
				}
				else {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
					$('#resets-' + character).fadeOut('slow').html(parseInt($('#resets-' + character).text()) + 1).fadeIn('slow');
					$('#lvl-' + character).fadeOut('slow').html('<span style="color: red;">1</span>').fadeIn('slow');
				}
			}
		});
	},
	gresetCharacter: function (character) {
		$.ajax({
			url: DmNConfig.base_url + 'ajax/greset_character',
			data: {character: character},
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
				}
				else {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
					$('#resets-' + character).fadeOut('slow').html('<span style="color: red;">0</span>').fadeIn('slow');
					$('#lvl-' + character).fadeOut('slow').html('<span style="color: red;">1</span>').fadeIn('slow');
				}
			}
		});
	},
	resetStats: function (character) {
		$.ajax({
			url: DmNConfig.base_url + 'ajax/reset_stats',
			data: {character: character},
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
				}
				else {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
					$('#new-stats-' + character).fadeOut('slow').html('0').fadeIn('slow');
				}
			}
		});
	},
	resetSkillTree: function (character) {
		$.ajax({
			url: DmNConfig.base_url + 'ajax/reset_skilltree',
			data: {character: character},
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
				}
				else {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
				}
			}
		});
	},
	pkClear: function (character) {
		$.ajax({
			url: DmNConfig.base_url + 'ajax/pk_clear',
			data: {character: character},
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
				}
				else {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
				}
			}
		});
	},
	calculateStats: function () {
		var points = $("#lvlup").val(),
			new_points = $(".stats_calc"),
			now_points = $(".stats_now"),
			s = [];

		for (i = 0; i < now_points.length; i++) {
			s[now_points.eq(i).attr('id')] = parseInt(now_points.eq(i).text());
		}

		new_points.bind('keyup keypress', function (e) {
			total = 0;

			for (i = 0; i < new_points.length; i++) {
				st = parseInt(new_points.eq(i).val());
				if (!isNaN(st)) {
					total += st;
				}
			}

			var stat = $(this).attr('name').split('_')[0],
				num = parseInt($(this).val());

			if (num < 0)
				$(this).val('');
			if (isNaN(num))
				num = 0;

			var output = points - total;

			if (output >= 0) {
				$("#lvlup").val(output);
				$("#" + stat).text(s[stat] + num);
			}
			else {
				$("#lvlup").val('0');
				$("#" + stat).text((s[stat] + num) + output);
				$(this).val(num + output);
			}
			if (parseInt($("#" + stat).text()) >= DmNConfig.max_stats) {
				$("#" + stat).css("color", "red");
			}
			else {
				$("#" + stat).css("color", "");
			}
		});

	},
	sellItem: function (form) {
		$.ajax({
			url: DmNConfig.base_url + 'warehouse/sell_item',
			data: '&' + $.param({'slot': App.item_slot, 'ajax': 1}) + '&' + $(form).serialize(),
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					if ($.isArray(data.error)) {
						$.each(data.error, function (key, val) {
							App.notice(App.lc.translate('Error').fetch(), 'error', val);
						});
					}
					else {
						App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
					}
				}
				else {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
					$('#option_buttons').slideToggle('fast');
					$('#sell_item').slideToggle('fast');
					$('#sell_item_form').get(0).reset();
					$('#item-slot-' + App.item_slot).hide();
				}
			}
		});
	},
	moveItemToWeb: function () {
		$.ajax({
			url: DmNConfig.base_url + 'warehouse/transfer-item/web',
			data: {'ajax': 1, 'slot': App.item_slot},
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					if ($.isArray(data.error)) {
						$.each(data.error, function (key, val) {
							App.notice(App.lc.translate('Error').fetch(), 'error', val);
						});
					}
					else {
						App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
					}
				}
				else {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
					$('#option_buttons').slideToggle('fast');
					$('#item-slot-' + App.item_slot).hide();
				}
			}
		});
	},
	moveItemToGame: function (id) {
		$.ajax({
			url: DmNConfig.base_url + 'warehouse/transfer-item/game',
			data: {'ajax': 1, 'slot': id},
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					if ($.isArray(data.error)) {
						$.each(data.error, function (key, val) {
							App.notice(App.lc.translate('Error').fetch(), 'error', val);
						});
					}
					else {
						App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
					}
				}
				else {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
					$('#wh_items_' + id).hide();
				}
			}
		});
	},
	deleteItem: function () {
		if (App.confirmMessage(App.lc.translate('Are you sure you want to delete this item?').fetch())) {
			$.ajax({
				url: DmNConfig.base_url + 'warehouse/del_item',
				data: {'ajax': 1, 'slot': App.item_slot},
				beforeSend: function () {
					App.showLoader();
				},
				complete: function () {
					App.hideLoader();
				},
				success: function (data) {
					if (data.error) {
						if ($.isArray(data.error)) {
							$.each(data.error, function (key, val) {
								App.notice(App.lc.translate('Error').fetch(), 'error', val);
							});
						}
						else {
							App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
						}
					}
					else {
						App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
						$('#item-slot-' + App.item_slot).hide();
					}
				}
			});
		}
	},
	clearInventory: function (form) {
		$.ajax({
			url: DmNConfig.base_url + 'ajax/clear_inventory',
			data: '&' + $.param({'ajax': 1}) + '&' + $(form).serialize(),
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					if ($.isArray(data.error)) {
						$.each(data.error, function (key, val) {
							App.notice(App.lc.translate('Error').fetch(), 'error', val);
						});
					}
					else {
						App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
					}
				}
				else {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
				}
			}
		});
	},
	buyLevel: function (form) {
		$.ajax({
			url: DmNConfig.base_url + 'ajax/buy_level',
			data: '&' + $.param({'ajax': 1}) + '&' + $(form).serialize(),
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					if ($.isArray(data.error)) {
						$.each(data.error, function (key, val) {
							App.notice(App.lc.translate('Error').fetch(), 'error', val);
						});
					}
					else {
						App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
					}
				}
				else {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
				}
			}
		});
	},
	buyPoints: function (form) {
		$.ajax({
			url: DmNConfig.base_url + 'ajax/buy_points',
			data: '&' + $.param({'ajax': 1}) + '&' + $(form).serialize(),
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					if ($.isArray(data.error)) {
						$.each(data.error, function (key, val) {
							App.notice(App.lc.translate('Error').fetch(), 'error', val);
						});
					}
					else {
						App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
					}
				}
				else {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
				}
			}
		});
	},
	buyGM: function (form) {
		$.ajax({
			url: DmNConfig.base_url + 'ajax/buy_gm',
			data: '&' + $.param({'ajax': 1}) + '&' + $(form).serialize(),
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					if ($.isArray(data.error)) {
						$.each(data.error, function (key, val) {
							App.notice(App.lc.translate('Error').fetch(), 'error', val);
						});
					}
					else {
						App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
					}
				}
				else {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
				}
			}
		});
	},
	loadClassList: function (name) {
		if (name != '') {
			$.ajax({
				url: DmNConfig.base_url + 'ajax/load_class_list',
				data: '&' + $.param({'ajax': 1, 'character': name}),
				beforeSend: function () {
					App.showLoader();
				},
				complete: function () {
					App.hideLoader();
				},
				success: function (data) {
					if (data.error) {
						if ($.isArray(data.error)) {
							$.each(data.error, function (key, val) {
								App.notice(App.lc.translate('Error').fetch(), 'error', val);
							});
						}
						else {
							App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
						}
						$('#class_select').html('<option value="" disabled="disabled" selected="selected">'+App.lc.translate('--SELECT--').fetch()+'</option>');
					}
					else {
						if (typeof data.data != 'Undefined') {
							$('#class_select').html(data.data);
						}
					}
				}
			});
		}
		else {
			$('#class_select').html('<option value="" disabled="disabled" selected="selected">'+App.lc.translate('--SELECT--').fetch()+'</option>');
			App.notice(App.lc.translate('Error').fetch(), 'error', App.lc.translate('Please select character').fetch());
		}
	},
	buyClass: function (form) {
		$.ajax({
			url: DmNConfig.base_url + 'ajax/buy_class',
			data: '&' + $.param({'ajax': 1}) + '&' + $(form).serialize(),
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					if ($.isArray(data.error)) {
						$.each(data.error, function (key, val) {
							App.notice(App.lc.translate('Error').fetch(), 'error', val);
						});
					}
					else {
						App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
					}
				}
				else {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
				}
			}
		});
	},
	exchangeWCoins: function (credits) {
		$.ajax({
			url: DmNConfig.base_url + 'ajax/exchange_wcoins',
			data: {
				ajax: 1,
				credits: credits,
				exchange_type: (typeof $('#exchange_type') != 'undefined') ? $('#exchange_type').val() : 0
			},
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					if ($.isArray(data.error)) {
						$.each(data.error, function (key, val) {
							App.notice(App.lc.translate('Error').fetch(), 'error', val);
						});
					}
					else {
						App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
					}
				}
				else {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
				}
			}
		});
	},
	changeName: function (oldN, newN) {
		$.ajax({
			url: DmNConfig.base_url + 'ajax/change_name',
			data: {ajax: 1, old_name: oldN, new_name: newN},
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					if ($.isArray(data.error)) {
						$.each(data.error, function (key, val) {
							App.notice(App.lc.translate('Error').fetch(), 'error', val);
						});
					}
					else {
						App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
					}
				}
				if (data.success) {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
					$('#charname-' + oldN).attr('id', 'charname-' + data.new_name);
				}
			}
		});
	},
	loadLatestItems: function (server, item_count, text_limit) {
		$.ajax({
            type: 'POST',
			url: DmNConfig.base_url + 'market/latest-items',
			data: {ajax: 1, server: server, item_count: item_count, text_limit: text_limit},
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					if ($.isArray(data.error)) {
						$.each(data.error, function (key, val) {
							App.notice(App.lc.translate('Error').fetch(), 'error', val);
						});
					}
					else {
						App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
					}
				}
				else {
                    EJS.config({cache: true});
					var html = new EJS({url: DmNConfig.base_url + 'assets/' + DmNConfig.tmp_dir + '/js_templates/' + 'sidebar_items'}).render(data);
					$('#lattest_items').html(html);
				}
			}
		});
	},
	checkSupportTickets: function () {
		$.ajax({
			url: DmNConfig.base_url + 'support/check-unreplied-tickets',
			data: {},
			success: function (data) {
				if (data.error) {
					App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
				}
				if (data.success) {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success, 1);
				}
			}
		});
	},
	makeBet: function (form) {
		$.ajax({
			url: DmNConfig.base_url + 'auction/make_bet',
			data: form,
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					if ($.isArray(data.error)) {
						$.each(data.error, function (key, val) {
							App.notice(App.lc.translate('Error').fetch(), 'error', val);
						});
					}
					else {
						App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
					}
				}
				else {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
					App.closeBuyWindows(3);

				}
			}
		});

	},
	changeServerInfo: function (key) {
		$('#sButton-' + key).animate({
			"opacity": "1",
			"filter": "alpha(opacity=100)"
		}, 500).siblings().animate({"opacity": "0.3", "filter": "alpha(opacity=30)"}, 200);
		$('#sStatus').text($('#status-' + key).text()).css("color", "#837E7E");
		$('#sOnline').text($('#online-' + key).text()).css("color", "#837E7E");
		$('#sVersion').text($('#version-' + key).text()).css("color", "#837E7E");


		App.topPlayer($('#online-' + key).attr('data-server'));
		App.topGuild($('#online-' + key).attr('data-server'));
	},
	topPlayer: function (server) {
		$.ajax({
			type: 'POST',
			url: DmNConfig.base_url + 'rankings/top_player',
			data: {ajax: 1, server: server},
			success: function (data) {
				if (typeof data !== 'undefined') {
					if (data.error) {
						if ($.isArray(data.error)) {
							$.each(data.error, function (key, val) {
								App.notice(App.lc.translate('Error').fetch(), 'error', val);
							});
						}
						else {
							App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
						}

					}
					else {
						if (data != false) {
							var e = new EJS.Helpers();
							$('#sPlayerLink').attr('href', DmNConfig.base_url + 'info/character/' + e.bin2hex(data[0].name) + '/' + server);
							$('#sPlayer').html(data[0].name);
						}
						else{
							$('#sPlayer').html('&nbsp;');
						}
					}
				}
			}
		});
	},
	topGuild: function (server) {
		$.ajax({
			type: 'POST',
			url: DmNConfig.base_url + 'rankings/top_guild',
			data: {ajax: 1, server: server},
			success: function (data) {
				if (typeof data !== 'undefined') {
					if (data.error) {
						if ($.isArray(data.error)) {
							$.each(data.error, function (key, val) {
								App.notice(App.lc.translate('Error').fetch(), 'error', val);
							});
						}
						else {
							App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
						}

					}
					else {
						if (data != false) {
							var e = new EJS.Helpers();
							$('#sGuildLink').attr('href', DmNConfig.base_url + 'info/guild/' + e.bin2hex(data[0].name) + '/' + server);
							$('#sGuild').html(data[0].name);
						}
						else{
							$('#sGuild').html('&nbsp;');
						}
					}
				}
			}
		});
	},
	hideChars: function () {
		$.ajax({
			url: DmNConfig.base_url + 'ajax/hide_chars',
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
				}
				else {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
				}
			}
		});
	},
	switchLanguage: function (lang) {
		$.ajax({
			url: DmNConfig.base_url + 'ajax/switch_language',
			data: {lang: lang},
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				setInterval(function () {
					App.hideLoader();
				}, 2000);
			},
			success: function (data) {
				setTimeout(function () {
					location.reload();
				}, 2000);
			}
		});
	},
	removeItemFromCart: function (id, tr, div) {
		$.ajax({
			url: DmNConfig.base_url + 'shop/remove_item_from_cart',
			data: {id: id},
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
				}
				else {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
					$('#item_' + id).remove();
					if (tr.length < 3) {
						$('#' + div).html('<div class="i_note">'+App.lc.translate('All items from card were removed.').fetch()+'</div>');
					}
				}
			}
		});
	},
	buyItems: function (form, div) {
		$.ajax({
			url: DmNConfig.base_url + 'shop/senditems',
			data: form.serialize() + '&' + $.param({'ajax': 1}),
			beforeSend: function () {
				App.showLoader();
			},
			complete: function () {
				App.hideLoader();
			},
			success: function (data) {
				if (data.error) {
					App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
				}
				else {
					App.notice(App.lc.translate('Success').fetch(), 'success', data.success);
					var credits = $('#my_credits').text().replace(/,/g, ''),
						gcredits = $('#my_gold_credits').text().replace(/,/g, '');
					if (data.payment_method == 1) {
						$('#my_credits').fadeOut('slow').html(App.formatMoney(parseInt(credits) - parseInt(data.price), 0, ',', ',')).fadeIn('slow');
					}
					else {
						$('#my_gold_credits').fadeOut('slow').html(App.formatMoney(parseInt(gcredits) - parseInt(data.price), 0, ',', ',')).fadeIn('slow');
					}

					if (data.left_items != "undefined") {
						var ids_checked = new Array();
						if (div == 'credits_items') {
							$('input[id^="add_to_warehouse_1_"]:checked').map(function () {
								ids_checked.push(parseInt($(this).attr('name').match(/\d+/)[0]));
							});
						}
						else {

							$('input[id^="add_to_warehouse_2_"]:checked').map(function () {
								ids_checked.push(parseInt($(this).attr('name').match(/\d+/)[0]));
							});
						}

						if (data.left_items.length > 0) {
							$.each(ids_checked, function (key, val) {
								if ($.inArray(val, data.left_items) === -1) {
									$('#item_' + val).remove();
									if (div == 'credits_items') {
										if ($('#credits_table tr').length <= 1) {
											$('#' + div).html('<div class="i_note">'+App.lc.translate('All items from card were removed.').fetch()+'</div>');
										}
									}
									else {
										if ($('#gcredits_table tr').length <= 1) {
											$('#' + div).html('<div class="i_note">'+App.lc.translate('All items from card were removed.').fetch()+'</div>');
										}
									}
								}
								else {
									$('input[id^="add_to_warehouse_"]').prop("checked", false);
									$('#total_price_c').html(0);
									$('#total_price_gc').html(0);
								}
							});
						}
						else {
							$.each(ids_checked, function (key, val) {
								$('#item_' + val).remove();
								if (div == 'credits_items') {
									if ($('#credits_table tr').length <= 1) {
										$('#' + div).html('<div class="i_note">'+App.lc.translate('All items from card were removed.').fetch()+'</div>');
									}
								}
								else {
									if ($('#gcredits_table tr').length <= 1) {
										$('#' + div).html('<div class="i_note">'+App.lc.translate('All items from card were removed.').fetch()+'</div>');
									}
								}
								$('input[id^="add_to_warehouse_"]').prop("checked", false);
								$('#total_price_c').html(0);
								$('#total_price_gc').html(0);
							});
						}
					}
				}
			}
		});
	},
	confirmMessage: function (message) {
		var conf = confirm(message);
		return (conf == true);
	},
	notice: function (title, title_type, text, sticky) {
		var container, messageBox, messageBody, messageTextBox, closeButton;

		container = $('#notifier-box');
		if (!container.length) {
			container = $('<div>', {id: 'notifier-box'}).prependTo(document.body);
		}

		messageBox = $('<div>', {'class': 'message-box', css: {display: 'none'}});
		messageHeader = $('<div>', {'class': title_type, html: title});
		messageBody = $('<div>', {'class': 'message-body'});
		messageTextBox = $('<span>', {html: text});

		closeButton = $('<a>', {
			'class': 'message-close',
			href: '#',
			title: App.lc.translate('Click for close this message').fetch(),
			click: function () {
				$(this).parent().fadeOut(500, function () {
					$(this).remove();
				});
			}
		});

		messageBox.appendTo(container).fadeIn(500);
		closeButton.appendTo(messageBox);
		messageHeader.appendTo(messageBox);
		messageBody.appendTo(messageBox);
		messageTextBox.appendTo(messageBody);
		if (typeof(sticky) == "undefined") {
			setTimeout(function () {
				$(messageBox).fadeOut(500, function () {
					$(this).remove();
				});
			}, 3000);
		}
		return this;
	},
	buildCaptcha: function (div, options) {
		var defaults = {
			txtLock: App.lc.translate('Move arrow to unlock form').fetch(),
			txtUnlock: App.lc.translate('Form can be submitted!').fetch(),
			disabledSubmit: true,
		};

		if (div.length > 0) {
			return $(div).each(function (i) {
				var opts = $.extend({}, defaults, options),
					form = $('form').has($(div)),
					clr = $('<div>', {'class': 'clr'}),
					bgSlider = $('<div>', {'class': 'bgSlider'}),
					slider = $('<div>', {'class': 'slider'}),
					txtStatus = $('<div>', {'class': ' txtStatus dropError', text: opts.txtLock}),
					input = $('<input>', {name: 'qaptcha_key', value: App.generateCaptchaKey(32), type: 'hidden'});

				if (opts.disabledSubmit) {
					form.find('button[type=\'submit\']').attr('disabled', 'disabled');
				}

				bgSlider.appendTo($(div));
				clr.insertAfter(bgSlider);
				txtStatus.insertAfter(clr);
				input.appendTo($(div));
				slider.appendTo(bgSlider);
				$(div).show();

				slider.draggable({
					containment: bgSlider,
					axis: 'x',
					stop: function (event, ui) {
						if (ui.position.left > 150) {
							$.ajax({
								url: DmNConfig.base_url + 'ajax/checkcaptcha',
								data: {act: 'qaptcha', qaptcha_key: input.attr('value')},
								success: function (data) {
									if (!data.error) {
										slider.draggable('disable').css('cursor', 'default');
										txtStatus.text(opts.txtUnlock).addClass('dropSuccess').removeClass('dropError');
										form.find('button[type=\'submit\']').removeAttr('disabled');
									}
								}
							});
						}
					}
				});
			});
		}
	},
	generateCaptchaKey: function (len) {
		var chars = 'azertyupqsdfghjkmwxcvbn23456789AZERTYUPQSDFGHJKMWXCVBN_-#@';
		var pass = '';
		for (i = 0; i < len; i++) {
			var wpos = Math.round(Math.random() * chars.length);
			pass += chars.substring(wpos, wpos + 1);
		}
		return pass;
	},
	formatMoney: function (b, c, d, t) {
		var c = isNaN(c = Math.abs(c)) ? 2 : c,
			d = d == undefined ? "." : d,
			t = t == undefined ? "," : t,
			s = b < 0 ? "-" : "",
			i = parseInt(b = Math.abs(+b || 0).toFixed(c)) + "",
			j = (j = i.length) > 3 ? j % 3 : 0;
		return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(b - i).toFixed(c).slice(2) : "");
	},
	initializeRulesDialog: function (title) {
		var rules = $('<div id="rules_content"><p></p></div>');
		$.ajax({
			type: 'GET',
			dataType: 'html',
			url: DmNConfig.base_url + 'assets/rules.html',
			success: function (data) {
				rules.html(data);
			}
		});
		rules.dialog({
			modal: true,
			width: 700,
			height: 400,
			title: title,
			show: 'clip',
			hide: 'clip',
			close: function () {
				$(this).dialog('destroy');
			}
		});
	},
	castleSiegeCountDown: function (id, end, start) {
		this.container = $('#' + id);
		this.endDate = new Date(end * 1000);
		this.startDate = new Date(start * 1000);
		if(new Date().getTime() > this.endDate){
			this.container.html(App.lc.translate('Battle Ended').fetch());
		}
		else{
			var context = this,
				update = function () {
					context.startDate.setSeconds(context.startDate.getSeconds() + 1);
					var timediff = (context.endDate - context.startDate) / 1000;
					if (timediff < 0) {
						context.container.html(App.lc.translate('Battle Now').fetch());
					}
					else {
						context.container.html(App.formatedTime(timediff));
						setTimeout(update, 1000);
					}
				};
			update();
		}
	},
	initializeTooltip: function (elements, load_info, ajax_call) {
		if (load_info == false) {
			elements.tooltip({
				bodyHandler: function () {
					return elements.attr('data-info');
				},
				showURL: false,
				fade: 10
			});
		}
		else {
			elements.tooltip({
				track: true,
				bodyHandler: function () {
					var id = elements,
						tip = $("<div></div>"),
						hex = id.attr('data-info'),
						info = id.attr('data-info2');
					if (typeof(info) != 'undefined') {
						if (info.length) {
							tip.html(info);
							return tip;
						}
					}
					else {
						tip.html('<img src="' + DmNConfig.base_url + 'assets/' + DmNConfig.tmp_dir + '/images/loading.gif" />');
						setTimeout(function () {
							$.ajax({
								url: DmNConfig.base_url + ajax_call,
								data: {item_hex: hex, ajax: 1},
								success: function (data) {
									if (data.error) {
										id.attr('data-info2', App.lc.translate('Invalid Item').fetch());
										tip.html(App.lc.translate('Invalid Item').fetch());
									}
									else {
										id.attr('data-info2', data.info);
										tip.html(data.info);
									}
								}
							});
						}, 150);
						return tip;
					}
				},
				showURL: false,
				fade: 10
			});
		}
	},
	initializeModalBoxes: function () {
		$('button[data-modal-div*=buy_windows],button[data-modal-div*=add_to_card_windows], a[data-modal-div*=select_server], img[data-modal-div*=select_server], button[data-modal-div*=auction_bet]').leanModal({
			top: 200,
			closeButton: ".close"
		});
	},
	closeBuyWindows: function (type) {
		$('#lean_overlay').fadeOut(200);
		if (type == 1) {
			$('#buy_windows').css({"display": "none"});
		}
		else if (type == 2) {
			$('#add_to_card_windows').css({"display": "none"});
		}
		else {
			$('#auction_bet').css({"display": "none"});
		}
	},
	submit_paypal: function (id, reward, price, currency, sandbox) {
		$.ajax({
			url: DmNConfig.base_url + "ajax/paypal",
			data: {proccess_paypal: id, reward: reward, price: price, currency: currency},
			success: function (data) {
				if (data.error) {
					App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
				}
				else {
					var pp_url = (sandbox == 1) ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';
					var form = '<form action="' + pp_url + '" method="post">';
					form += '<input type="hidden" name="cmd" value="_xclick" />';
					form += '<input type="hidden" name="business" value="' + data.email + '" />';
					form += '<input type="hidden" name="item_name" value="Buy Virtual Currency" />';
					form += '<input type="hidden" name="item_number" value="' + data.item + '" />';
					form += '<input type="hidden" name="currency_code" value="' + currency + '" />';
					form += '<input type="hidden" name="amount" value="' + price + '" />';
					form += '<input type="hidden" name="no_shipping" value="1" />';
					form += '<input type="hidden" name="return" value="' + DmNConfig.base_url + '" />';
					form += '<input type="hidden" name="cancel_return" value="' + DmNConfig.base_url + '" />';
					form += '<input type="hidden" name="notify_url" value="' + DmNConfig.base_url + 'payment/paypal" />';
					form += '<input type="hidden" name="custom" value="' + data.user + '-' + data.server + '" />';
					form += '<input type="hidden" name="no_note" value="1" />';
					form += '<input type="hidden" name="tax" value="0.00" />';
					form += '<input class="button" type="submit" value="Donate">';
					form += '</form>';
					$(form).appendTo('body').submit();
				}
			}
		});
	},
	submit_paycall: function (id) {
		$.ajax({
			url: DmNConfig.base_url + "ajax/paycall",
			data: {proccess_paycall: id},
			success: function (data) {
				if (data.error) {
					App.notice(App.lc.translate('Error').fetch(), 'error', data.error);
				}
				else {
					var form = '<form name="purchase_form" action="http://cart.paycall.co.il/" method="post">';
					form += '<input type="hidden" name="charset" value="utf-8" />';
					form += '<input type="hidden" name="action" value="setPayCallDirect" />';
					form += '<input type="hidden" name="business_code" value="' + data.business_code + '" />';
					form += '<input type="hidden" name="business_name" value="' + data.business_name + '" />';
					form += '<input type="hidden" name="logo" value="http://paycall.co.il/images/logo.png" />';
					form += '<input type="hidden" name="custom_data" value="' + data.item + '" />';
					form += '<input type="hidden" name="shipping_form" value="0" />';
					form += '<input type="hidden" name="back_url" value="' + DmNConfig.base_url + '" />';
					form += '<input type="hidden" name="ipn_url" value="' + DmNConfig.base_url + 'payment/paycall" />';
					form += '<input type="hidden" name="item[1][number]" value="Package-' + id + '" />';
					form += '<input type="hidden" name="item[1][price]" value="' + data.price + '" />';
					form += '<input type="hidden" name="item[1][name]" value="' + data.reward + ' Virtual Currency" />';
					form += '<input type="hidden" name="item[1][quantity]" value="1" />';
					form += '<input type="hidden" name="item[1][digital]" value="1" />';
					form += '<input class="button" type="submit" value="Donate">';
					form += '</form>';
					//console.log(form);
					$(form).appendTo('body').submit();
				}
			}
		});
	},
	downloadImage: function (id) {
		$('<form action="' + DmNConfig.base_url + 'ajax/download" method="POST"><input type="hidden" name="image" value="' + id.parent().parent().parent().attr('id').split("-")[1] + '" /></form>').appendTo('body').submit().remove();
	},
	showTime: function (div) {
		var currentTime = new Date();
		var hours = currentTime.getHours();
		var minutes = currentTime.getMinutes();
		var seconds = currentTime.getSeconds();
		if (minutes < 10) {
			minutes = '0' + minutes;
		}
		if (seconds < 10) {
			seconds = '0' + seconds;
		}
		var v = hours + ':' + minutes + ':' + seconds;
		setTimeout(function () {
			App.showTime(div);
		}, 1000);
		$('#' + div).html(v);
	},
	tooltipImageShow: function (source) {
		var img = new Image();
		img.onload = function () {
			if (this.height > $(window).height()) {
				$(".tooltip-div-image").css("padding-top", 20 + "px");
				$(".tooltip-image").css("height", $(window).height() - 40 + "px");
			}
			else {
				$(".tooltip-div-image").css("padding-top", ($(window).height() - this.height) / 2 + "px");
				$(".tooltip-image").css("height", this.height + "px")
			}

			$(".tooltip-image").attr("src", this.src);
			$(".tooltip-div").css("height", $(document).height() + "px").fadeIn(400);
		}
		img.src = source;
	},
	rotateBanner: function () {
		var pic = parseInt($(".rollingIcon .active").attr("data-pic")) + 1;
		if (pic >= $(".rollingIcon button").length) pic = 0;
		$("#col1 .items").animate({"left": pic * -617 + "px"}, 500);
		$(".rollingIcon button").removeClass();
		$(".rollingIcon").find("button").eq(pic).addClass("active");
	},
	getEventTimes: function () {
		$.ajax({
			url: DmNConfig.base_url + "ajax/event-timers",
			success: function (data) {
				App.events_time = data;
				if (App.isfirst == false) {
					App.events();
					App.isfirst = true;
				}
			}
		});
	},
	events: function () {
		i = 0;
		for (i in App.events_time) {
			newDiv = $("<div/>");
			newDiv.append($("<span />").text(App.events_time[i].name));
			newDiv.append($("<small />").attr({id: 'event' + App.events_time[i].id}).text(App.formatedTime(App.events_time[i].left)));
			$("#events").append(newDiv);
			i++;
		}
		setInterval(function () {
			App.updateEventTimes()
		}, 1000);
	},
	updateEventTimes: function () {
		for (i in App.events_time) {
			App.events_time[i].left--;
			if (App.events_time[i].left < 0) {
				App.events_time[i].left++;
				App.getEventTimes();
			}
			$("#event" + App.events_time[i].id).text(App.formatedTime(App.events_time[i].left));
		}
	},
	sprintf: function (format) {
		for (var i = 1; i < arguments.length; i++) {
			format = format.replace(/%s|%d/, arguments[i]);
		}
		return format;
	},
	setCookie: function (key, value, days) {
		var expires = new Date();
		expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
		document.cookie = key + '=' + encodeURIComponent(String(value)) + ';expires=' + expires.toUTCString();
	},
	readCookie: function (key) {
		var result;
		return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? (result[1]) : null;
	},
	count_down: function (target) {
		var serverDate = App.serverDate();
		var targetDate = new Date(target);
		setInterval(function () {
			serverDate.setSeconds(serverDate.getSeconds() + 1);
			App.updateTime(serverDate, targetDate)
		}, 1000);
	},
	checkTime: function (i) {
		if (i < 10) {
			i = "0" + i;
		}
		return i;
	},
	timeDifference: function (begin, end) {
		if (end < begin) {
			return false;
		}
		var diff = {
			seconds: [end.getSeconds() - begin.getSeconds(), 60],
			minutes: [end.getMinutes() - begin.getMinutes(), 60],
			hours: [end.getHours() - begin.getHours(), 24],
			days: [end.getDate() - begin.getDate(), new Date(begin.getYear(), begin.getMonth() + 1, 0).getDate()],
		};
		var result = new Array();
		var flag = false;
		for (i in diff) {
			if (flag) {
				diff[i][0]--;
				flag = false;
			}
			if (diff[i][0] < 0) {
				flag = true;
				diff[i][0] += diff[i][1];
			}
			if (i == 'days' && !diff[i][0]) continue;
			result.push(App.checkTime(diff[i][0]));
		}
		return result.reverse().join(':');
	},
	updateTime: function (serverDate, targetDate) {
		var s = App.timeDifference(serverDate, targetDate);
		if (s.length) {
			var days, hours, minutes, seconds;
			var seconds_left = (targetDate.getTime() - serverDate.getTime()) / 1000;
			days = parseInt(seconds_left / 86400);
			seconds_left = seconds_left % 86400;
			hours = parseInt(seconds_left / 3600);
			seconds_left = seconds_left % 3600;
			minutes = parseInt(seconds_left / 60);
			seconds = parseInt(seconds_left % 60);
			$('#days').html(days);
			$('#hours').html(hours);
			$('#minutes').html(minutes);
			$('#seconds').html(seconds);
		}
		else {
			$('#timer_div_title').hide();
			$('#timer_div_time').hide();
			clearInterval(App.updateTime(serverDate, targetDate));
		}
	},
	serverDate: function () {
		var time;
		$.ajax({
			type: "GET",
			url: DmNConfig.base_url + "ajax/get-time",
			dataType: 'jsonp',
			async: false,
			success: function (data) {
				time = new Date(data.ServerTime);
			}
		});
		return time;
	},
	formatedTime: function (seconds) {
		second = seconds % 60;
		minutes = parseInt((seconds / 60) % 60);
		hour = parseInt((seconds / 3600) % 24);
		days = parseInt(seconds / (24 * 3600));
		html = '';
		if (days > 0)
			html += days + 'd ';
		if (hour > 0)
			html += hour + 'h ';
		if (days > 0 && hour <= 0)
			html += '0h ';
		if (minutes > 0)
			html += minutes + 'm ';
		if (minutes < 0)
			html += '0m ';
		if (second < 10)
			second = '0' + second;
		html += second + 's';
		return html;
	}
};

var serverTime = {
    serverDate: null,
    localDate: null,
    dateOffset: null,
    nowDate: null,
    eleServer: null,
    eleLocal: null,
    init: function(e, c){
        var f = this;
        f.eleServer = e;
        f.eleLocal = c;
        $.getJSON(DmNConfig.base_url+"ajax/get-time?callback=?", function(a){
            f.serverDate = new Date(a.ServerTime);
            f.localDate = new Date();
            f.dateOffset = f.serverDate - f.localDate;
			$('#'+f.eleServer).html(f.dateTimeFormat(f.serverDate));
			$('#'+f.eleLocal).html(f.dateTimeFormat(f.localDate));
            setInterval(function(){
                f.update()
            }, 1000)
        })
    },
    update: function(){
        var b = this;
        b.nowDate = new Date();
		$('#'+b.eleLocal).html(b.dateTimeFormat(b.nowDate));
        b.nowDate.setTime(b.nowDate.getTime() + b.dateOffset);
		$('#'+b.eleServer).html(b.dateTimeFormat(b.nowDate));
    },
    dateTimeFormat: function(e){
        var c = this;
        var f = [];
        f.push(c.digit(e.getHours()));
        f.push(":");
        f.push(c.digit(e.getMinutes()));
        f.push(":");
        f.push(c.digit(e.getSeconds()));
        f.push(" ");
        f.push(" ");
        f.push(e.toLocaleString(App.readCookie('dmn_language').replace("_", "-"), { month: "short" }));
        f.push(" ");
        f.push(e.getDate());
        return f.join("")
    },
    digit: function(b){
        b = String(b);
        b = b.length == 1 ? "0" + b : b;
        return b
    }
};


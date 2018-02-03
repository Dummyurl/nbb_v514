function _pageload(url,data,id){
    $.ajax({
		url: url,
		type: "GET",
		data: data,
		cache: false,
        beforeSend: function() {
            $('#loading').show();
            $('#notice').hide();
            $('#'+ id).hide();
       },
		success: function (html) {
			$('#loading').hide();			
			$('#'+ id).html(html);
			$('#'+ id).fadeIn('medium');
		}		
	});
}

$(document).ready(function() {
    
    var url = window.location.hash;

 	if(url.indexOf('#')!=-1)
     {
        var c_url = url.split('#');
     	var c_url_last = c_url.length - 1;
        var module = c_url ? c_url[c_url_last] : 'home';
     	_pageload('index2.php?mod='+ module,'','hienthi');
         
         var mod_split = module.split('&');
         var mod_pri = mod_split ? mod_split[0] : module;
         
         $('#mainmenu a[rel=menuajax]').removeClass('menuactive');
         $('#mainmenu a[href=#' + mod_pri + ']').addClass('menuactive'); 
     }
    
	$('.item_dg_tooltip').tooltip();
	
	$('a[rel=menuajax]').live('click', function () {
		var url = $(this).attr('href');
 		
        if(url.indexOf('#')!=-1)
        {
            var c_url = url.split('#');
        	var module = c_url ? c_url[1] : '#';
        	_pageload('index2.php?mod='+ module,'','hienthi');
        }
        
 		$('#mainmenu a[rel=menuajax]').removeClass('menuactive');
 		$(this).addClass('menuactive');
	});
    
    $('a[rel=ajax]').live('click', function () {
	   var url = $(this).attr('href');
 		
        if(url.indexOf('#')!=-1)
        {
            var c_url = url.split('#');
        	var module = c_url ? c_url[1]:'#';
        	_pageload('index2.php?mod='+ module,'','hienthi');
            
            var mod_split = module.split('&');
            var mod_pri = mod_split ? mod_split[0] : module;
            
            $('#mainmenu a[rel=menuajax]').removeClass('menuactive');
            $('#mainmenu a[href=#' + mod_pri + ']').addClass('menuactive');
        }

	});	
    
    $("#btn_rs").live('click', function(){
        var dataString = "action=reset";
        
         $.ajax({
           type: "GET",
           url: "ajax_action.php?ajax=char_rs",
           data: dataString,
           cache: false,
           beforeSend: function() {
                $("#rs_loading").html("<img src='images/loading1.gif' border='0' />");
                $("#rs_err").html("");
                $("#btn_rs").attr('disabled','disabled');
           },
           complete: function() {
                $("#rs_loading").html("");
            
           },
           success: function(html) {
                 var html_split = html.split("<nbb>");
                 if(html_split[1] == "OK") {
                     $("#rs_content").html("<div class='success'>" + html_split[2] + "</div>");
                 } else {
                     $("#rs_err").html("<div class='error'>" + html + "</div>");
                 }
                 $("#btn_rs").removeAttr('disabled');
           }
        });
        
        return false;
    });
    
    $("#btn_rs_over").live('click', function(){
        var dataString = "action=reset_over";
        
         $.ajax({
           type: "GET",
           url: "ajax_action.php?ajax=char_rs",
           data: dataString,
           cache: false,
           beforeSend: function() {
                $("#rs_loading").html("<img src='images/loading1.gif' border='0' />");
                $("#rs_err").html("");
                $("#btn_rs_over").attr('disabled','disabled');
           },
           complete: function() {
                $("#rs_loading").html("");
            
           },
           success: function(html) {
                 var html_split = html.split("<nbb>");
                 if(html_split[1] == "OK") {
                     $("#rs_content").html("<div class='success'>" + html_split[2] + "</div>");
                 } else {
                     $("#rs_err").html("<div class='error'>" + html + "</div>");
                 }
                 $("#btn_rs_over").removeAttr('disabled');
           }
        });
        
        return false;
    });
    
    $("#btn_rsvip").live('click', function(){
        var tiente = $('input[name=tiente]:checked').val();
        
        var dataString = "action=reset_vip&tiente=" + tiente;
        
         $.ajax({
           type: "GET",
           url: "ajax_action.php?ajax=char_rs",
           data: dataString,
           cache: false,
           beforeSend: function() {
                $("#rs_loading").html("<img src='images/loading1.gif' border='0' />");
                $("#rs_err").html("");
                $("#btn_rsvip").attr('disabled','disabled');
           },
           complete: function() {
                $("#rs_loading").html("");
            
           },
           success: function(html) {
                 var html_split = html.split("<nbb>");
                 if(html_split[1] == "OK") {
                     $("#rs_content").html("<div class='success'>" + html_split[2] + "</div>");
                 } else {
                     $("#rs_err").html("<div class='error'>" + html + "</div>");
                 }
                 $("#btn_rsvip").removeAttr('disabled');
           }
        });
        
        return false;
    });
    
    $("#btn_rs_over_vip").live('click', function(){
        var tiente = $('input[name=tiente]:checked').val();
        
        var dataString = "action=reset_over_vip&tiente=" + tiente;
        
         $.ajax({
           type: "GET",
           url: "ajax_action.php?ajax=char_rs",
           data: dataString,
           cache: false,
           beforeSend: function() {
                $("#rs_loading").html("<img src='images/loading1.gif' border='0' />");
                $("#rs_err").html("");
                $("#btn_rs_over_vip").attr('disabled','disabled');
           },
           complete: function() {
                $("#rs_loading").html("");
            
           },
           success: function(html) {
                 var html_split = html.split("<nbb>");
                 if(html_split[1] == "OK") {
                     $("#rs_content").html("<div class='success'>" + html_split[2] + "</div>");
                 } else {
                     $("#rs_err").html("<div class='error'>" + html + "</div>");
                 }
                 $("#btn_rs_over_vip").removeAttr('disabled');
           }
        });
        
        return false;
    });
    
    $("input[name='item']").live('change', function(){
        var x = $("input[name='item']:checked").attr('x');
        var y = $("input[name='item']:checked").attr('y');
        
        // So Item tren 1 hang
        var itemperrow = Math.floor(8/x);
        // So Item tren 1 cot
        var itempercolumn = Math.floor(8/y);
        // So luong Item toi da
        var slgmax = itemperrow*itempercolumn;
        
        var slgitem_choise = "";
        for (i=1; i<=slgmax; i++) {
	       slgitem_choise += "<option value='" + i +"'>" + i +"</option>";
        }
        $('#slg').html(slgitem_choise);
    });
    
    $("#chao").live('change', function(){
        var chao = $("#chao").val();
        var cre = $("#cre").val();
        var blue = $("#blue").val();
        var lvitem = $("#lvitem").html();
        
        $.get("ajax_action.php", { ajax: "itemuplv", ichao: chao, icre: cre, iblue: blue, ilvitem: lvitem },
            function(data){
                $("#percent").html(data);
        });
    });
    
    $("#cre").live('change', function(){
        var chao = $("#chao").val();
        var cre = $("#cre").val();
        var blue = $("#blue").val();
        var lvitem = $("#lvitem").html();
        $.get("ajax_action.php", { ajax: "itemuplv", ichao: chao, icre: cre, iblue: blue, ilvitem: lvitem },
            function(data){
                $("#percent").html(data);
        });
    });
    
    $("#blue").live('change', function(){
        var chao = $("#chao").val();
        var cre = $("#cre").val();
        var blue = $("#blue").val();
        var lvitem = $("#lvitem").html();
        
        $.get("ajax_action.php", { ajax: "itemuplv", ichao: chao, icre: cre, iblue: blue, ilvitem: lvitem },
            function(data){
                $("#percent").html(data);
        });
    });
    
    $(".epitem_reg").live('click', function(){
        var serial = $(this).attr("serial");
        var dataString = "action=reg&iserial="+  serial;
        
         $.ajax({
           type: "GET",
           url: "ajax_action.php?ajax=event_epitem",
           data: dataString,
           cache: false,
           beforeSend: function() {
                $("#loading_"+ serial).html("<img src='images/loading1.gif' border='0' />");
                $("#err_"+ serial).html("");
           },
           complete: function() {
                $("#loading_"+ serial).html("");
            
           },
           success: function(html) {
                if(html == 'OK') {
                     $("#td_"+ serial).html('Ðăng ký thành công');
                 } else {
                     $("#err_"+ serial).html(html);
                 }
           }
        });
        
        return false;
    });
    
    $(".epitem_update").live('click', function(){
        var serial = $(this).attr("serial");
        var dataString = "action=update&iserial="+  serial;
        
         $.ajax({
           type: "GET",
           url: "ajax_action.php?ajax=event_epitem",
           data: dataString,
           cache: false,
           beforeSend: function() {
                $("#loading_"+ serial).html("<img src='images/loading1.gif' border='0' />");
                $("#err_"+ serial).html("");
           },
           complete: function() {
                $("#loading_"+ serial).html("");
            
           },
           success: function(html) {
                 var html_split = html.split("<nbb>");
                 if(html_split[1] == "OK") {
                     if(html_split[2] == "OK") {
                         $("#td_"+ serial).html('<strong><font color="#00FFFF">Ðã hoàn thành</font></strong><br />'+ html_split[3]).css("background-color","#121212");
                     } else {
                         $("#err_"+ serial).html(html_split[2]);
                     }
                 } else {
                     $("#err_"+ serial).html(html);
                 }
           }
        });
        
        return false;
    });
    
    $(".lockitem_lock").live('click', function(){
        var serial = $(this).attr("serial");
        var vitri = $(this).attr("vitri");
        var opd = $("#opd_"+ vitri).val();

         if(serial.length == 0) {
             alert('Serial Item không hợp lệ');
         } else if(opd.length == 0) {
             alert('Chưa nhập mật khẩu OPD');
         } else {
             var dataString = "action=lock&iserial="+  serial +"&vitri="+ vitri +"&opd="+ opd;
             
              $.ajax({
                type: "GET",
                url: "ajax_action.php?ajax=nv_lockitem",
                data: dataString,
                cache: false,
                beforeSend: function() {
                     $("#loading_"+ vitri).html("<img src='images/loading1.gif' border='0' />");
                     $("#err_"+ vitri).html("");
                },
                complete: function() {
                     $("#loading_"+ vitri).html("");
                 
                },
                success: function(html) {
                     if(html == "OK") {
                         $("#lockinfo_"+ vitri).html("<font color='blue'>Item đã bảo vệ</font>");
                          $("#button_"+ vitri).html("<input type='button' vitri='"+ vitri +"' class='lockitem_unlock' value='Hủy Bảo vệ Item' /> <font color='blue'>Miễn Phí</font>");
                     } else {
                         $("#err_"+ vitri).html(html);
                     }
                }
             });
         }
        
        return false;
    });
    
    $(".lockitem_unlock").live('click', function(){
        var vitri = $(this).attr("vitri");
        var opd = $("#opd_"+ vitri).val();
        var price_lock = $("#price_lock").html();

         if(vitri.length == 0) {
             alert('Vị Trí Item không hợp lệ');
         } else if(opd.length == 0) {
             alert('Chưa nhập mật khẩu OPD');
         } else {
             var dataString = "action=unlock&vitri="+  vitri +"&opd="+ opd;
             
              $.ajax({
                type: "GET",
                url: "ajax_action.php?ajax=nv_lockitem",
                data: dataString,
                cache: false,
                beforeSend: function() {
                     $("#loading_"+ vitri).html("<img src='images/loading1.gif' border='0' />");
                     $("#err_"+ vitri).html("");
                },
                complete: function() {
                     $("#loading_"+ vitri).html("");
                 
                },
                success: function(html) {
                     var html_split = html.split("<nbb>");
                     if(html_split[1] == "OK") {
                         $("#lockinfo_"+ vitri).html("<font color='red'><strong>Item chưa được bảo vệ</strong></font>");
                          $("#button_"+ vitri).html("<input type='button' vitri='"+ vitri +"' serial='"+ html_split[2] +"' class='lockitem_lock' value='Bảo vệ Item' /> "+price_lock);
                     } else {
                         $("#err_"+ vitri).html(html);
                     }
                }
             });
         }
        
        return false;
    });
    
    $(".bid_dgn").live('click', function(){
        var bidid = $(this).attr("bidid");
        var price_min = $(this).attr("price_min");
        var bid_mod = $(this).attr("bid_mod");
        
        var bid = $("#bid_"+ bidid).val();
        bid = parseInt(bid);
         
         if(bid < price_min) {
             alert('Giá Đấu '+ bid +' phải lớn hơn hoặc bằng Giá đấu nhỏ nhất');
         } else if(bid % bid_mod != 0) {
             alert('Giá đấu '+ bid +' phải chia hết cho '+ bid_mod);
         } else {
             var dataString = "action=bid&bidid="+  bidid +"&bid="+ bid;
             
              $.ajax({
                type: "GET",
                url: "ajax_action.php?ajax=com_daugianguoc",
                data: dataString,
                cache: false,
                beforeSend: function() {
                     $("#loading_"+ bidid).html("<img src='images/loading1.gif' border='0' />");
                     $("#notice_"+ bidid).html("");
                },
                complete: function() {
                     $("#loading_"+ bidid).html("");
                },
                success: function(html) {
                     if(html == "OK") {
                         $("#notice_"+ bidid).html("<font color='blue'><strong>Đã đấu : "+ bid +" Vpoint</strong><br />Tài khoản của bạn bị <strong>đóng băng "+ bid +" Vpoint</strong>. Kết thúc Đấu giá sẽ được hoàn trả.</font>");
                     } else {
                         $("#notice_"+ bidid).html("<font color='red'><strong>"+ html +"</strong></font>");
                     }
                }
             });
         }
        
        return false;
    });
    
    $(".reward_dgn").live('click', function(){
        var bidid = $(this).attr("bidid");

         var dataString = "action=reward&bidid="+  bidid;
         
          $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=com_daugianguoc",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#loading_reward_"+ bidid).html("<img src='images/loading1.gif' border='0' />");
                 $("#reward_err_"+ bidid).html("")
            },
            complete: function() {
                 $("#loading_reward_"+ bidid).html("");
            },
            success: function(html) {
                 if(html == "OK") {
                     $("#reward_"+ bidid).html("<font color='blue'><strong>Đã nhận</strong></font>");
                 } else {
                     $("#reward_err_"+ bidid).html("<font color='red'><strong>"+ html +"</strong></font>");
                 }
            }
         });
        
        return false;
    })
    
    $('.listbid').live('click', function() {
        $(this).fancybox({
            'titlePosition'		: 'inside',
			'transitionIn'		: 'none',
			'transitionOut'		: 'none',
            
        }).click();
        return false;
    });
    
    $(".dgn_bidding_view").live('click', function() {
        var bidid = $(this).attr('bidid');
        var dataString = "action=bidding_view&bidid="+  bidid;
             
          $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=com_daugianguoc",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#loading_bidding_view_"+ bidid).html("<img src='images/loading1.gif' border='0' />");
                 $("#notice_bidding_view_"+ bidid).html("");
            },
            complete: function() {
                 $("#loading_bidding_view_"+ bidid).html("");
            },
            success: function(html) {
                $("#notice_bidding_view_"+ bidid).html(html);
            }
         });
        
        return false;
    });
    
    $(".close_bidding_view").live('click', function() {
        var bidid = $(this).attr('bidid');
        $('#notice_bidding_view_'+ bidid).html("");
        
        return false;
    });
    
    
    $(".itembid_up").live('click', function() {
        var vitri = $(this).attr('vitri');
        
        $("#itembid_unactive_"+ vitri).slideUp();
        $("#itembid_active_"+ vitri).slideDown();
        
        return false;
    });
    
    $(".itembid_down").live('click', function() {
        var vitri = $(this).attr('vitri');
        
        $("#itembid_unactive_"+ vitri).slideDown();
        $("#itembid_active_"+ vitri).slideUp();
        
        return false;
    });
    
    $(".itembid_send").live('click', function() {
        var vitri = $(this).attr('vitri');
        var item_code = $(this).attr('item_code');
        
        var price_min = $("#price_min_"+ vitri).val();
            price_min = parseInt(price_min);
        var price_max = $("#price_max_"+ vitri).val();
            price_max = parseInt(price_max);
        var bidday = $("#bidday_"+ vitri).val();
            bidday = parseInt(bidday);
        var itempass = $("#itempass_"+ vitri).val();
        var passopd = $("#passopd_"+ vitri).val();
        
        if(vitri < 0 || vitri > 120) {
            alert('Vị trí Item sai');
        } else if(item_code.length != 32) {
            alert('Item Code sai');
        } else if(price_min <= 0) {
            alert('Giá khởi điểm '+ price_min +' phải lớn hơn 0 Vpoint');
        } else if(price_min % 100 != 0) {
            alert('Giá khởi điểm '+ price_min +' phải chia hết cho 100');
        } else if(price_max <= price_min) {
            alert('Giá mua đứt '+ price_max +' phải lớn hơn giá khởi điểm '+ price_min);
        } else if(price_max % 100 != 0) {
            alert('Giá mua đứt '+ price_max +' phải chia hết cho 100');
        } else {
            var dataString = "action=itembid_send&vitri="+  vitri +"&item_code="+ item_code +"&price_min="+ price_min +"&price_max="+ price_max +"&bidday="+ bidday +"&itempass="+ itempass +"&passopd="+ passopd;
             
            $.ajax({
                type: "GET",
                url: "ajax_action.php?ajax=com_daugia",
                data: dataString,
                cache: false,
                beforeSend: function() {
                     $("#itembid_send_loading_"+ vitri).html("<img src='images/loading1.gif' border='0' />");
                     $("#itembid_send_view_"+ vitri).html("");
                },
                complete: function() {
                     $("#itembid_send_loading_"+ vitri).html("");
                },
                success: function(html) {
                    if(html == 'OK') {
                        var notice = "<font color='blue'>Item đã được đưa lên sàn đấu giá<br />";
                        if(itempass.length > 0) notice = notice + "Mật khẩu bảo vệ : <strong>"+ itempass +"</strong>";
                        notice = notice + "</font><br /><br />";
                        $("#item_"+ vitri).html(notice);
                    } else {
                        $("#itembid_send_view_"+ vitri).html(html);
                    }
                    
                }
            });
        }
        
        return false;
    });
    
    $(".bid_dg").live('click', function(){
        var bidid = $(this).attr("bidid");
        var bid_vpoint = $(this).attr("bid_vpoint");
        var price_max = $(this).attr("price_max");
        var bid = $("#bid_"+ bidid).val();
        var itempass = $("#itempass_"+ bidid).val();
        
        bidid = parseInt(bidid);
        bid_vpoint = parseInt(bid_vpoint);
        price_max = parseInt(price_max);
        bid = parseInt(bid);
         
         if(bid <= bid_vpoint) {
             alert('Giá Đấu '+ bid +' Vpoint phải lớn hơn Giá đấu hiện tại '+ bid_vpoint);
         } else if(bid % 100 != 0) {
             alert('Giá đấu '+ bid +' Vpoint phải chia hết cho 100');
         } else if(bid > price_max) {
             alert('Giá đấu '+ bid +' Vpoint chỉ được bằng '+ price_max +' Vpoint để mua đứt Item.');
         } else {
             var dataString = "action=bid&bidid="+  bidid +"&bid="+ bid +"&itempass="+ itempass +"&bid_vpoint="+ bid_vpoint +"&price_max="+ price_max;
             
              $.ajax({
                type: "GET",
                url: "ajax_action.php?ajax=com_daugia",
                data: dataString,
                cache: false,
                beforeSend: function() {
                     $("#loading_"+ bidid).html("<img src='images/loading1.gif' border='0' />");
                     $("#notice_"+ bidid).html("");
                },
                complete: function() {
                     $("#loading_"+ bidid).html("");
                },
                success: function(html) {
                     if(html == "OK") {
                         $("#notice_"+ bidid).html("<font color='blue'><strong>Đã đấu : "+ bid +" Vpoint</strong><br />Tài khoản của bạn bị <strong>đóng băng "+ bid +" Vpoint</strong>. <br />Khi có người trả giá cao hơn, sẽ được hoàn trả.</font><br /><br />");
                     } else if(html == "OK2") {
                         $("#notice_"+ bidid).html("<font color='blue'><strong>Bạn đã mua đứt Item. <br />Vui lòng vào <a href='#com&act=daugia&page=daugia_end' rel='ajax' >Đấu Giá đã tham gia</a> để lấy Item.</font><br /><br />");
                     } else {
                         $("#notice_"+ bidid).html("<font color='red'><strong>"+ html +"</strong></font>");
                     }
                }
             });
         }
        
        return false;
    });
    
    $(".reward_dg").live('click', function(){
        var bidid = $(this).attr("bidid");

         var dataString = "action=reward&bidid="+  bidid;
         
          $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=com_daugia",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#loading_reward_"+ bidid).html("<img src='images/loading1.gif' border='0' />");
                 $("#reward_err_"+ bidid).html("")
            },
            complete: function() {
                 $("#loading_reward_"+ bidid).html("");
            },
            success: function(html) {
                 if(html == "OK") {
                     $("#reward_"+ bidid).html("<font color='blue'><strong>Đã nhận</strong></font>");
                 } else {
                     $("#reward_err_"+ bidid).html("<font color='red'><strong>"+ html +"</strong></font>");
                 }
            }
         });
        
        return false;
    })
    
    $(".dg_giahan").live('click', function(){
        var bidid = $(this).attr("bidid");
        var bidday = $("#bidday_"+ bidid).val();

         var dataString = "action=dg_giahan&bidid="+  bidid +"&bidday="+  bidday;
         
          $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=com_daugia",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#loading_giahan_"+ bidid).html("<img src='images/loading1.gif' border='0' />");
                 $("#notice_view_"+ bidid).html("")
            },
            complete: function() {
                 $("#loading_giahan_"+ bidid).html("");
            },
            success: function(html) {
                 if(html == "OK") {
                     $("#item_"+ bidid).html("<font color='blue'><strong>Đã gia hạn thành công</strong></font>");
                 } else {
                     $("#notice_view_"+ bidid).html("<font color='red'><strong>"+ html +"</strong></font>");
                 }
            }
         });
        
        return false;
    });
    
    $(".dg_rutitem").live('click', function(){
        var bidid = $(this).attr("bidid");

         var dataString = "action=dg_rutitem&bidid="+  bidid;
         
          $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=com_daugia",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#loading_rutitem_"+ bidid).html("<img src='images/loading1.gif' border='0' />");
                 $("#notice_view_"+ bidid).html("")
            },
            complete: function() {
                 $("#loading_rutitem_"+ bidid).html("");
            },
            success: function(html) {
                 if(html == "OK") {
                     $("#item_"+ bidid).html("<font color='blue'><strong>Đã rút Item thành công</strong></font>");
                 } else {
                     $("#notice_view_"+ bidid).html("<font color='red'><strong>"+ html +"</strong></font>");
                 }
            }
         });
        
        return false;
    })
    
    
    $(".award_receive").live('click', function(){
        var award_id = $(this).attr("award_id");

         var dataString = "action=award_receive&award_id="+  award_id;
         
          $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=event_award",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#loading_"+ award_id).html("<img src='images/loading1.gif' border='0' />");
                 $("#err_"+ award_id).html("")
            },
            complete: function() {
                 $("#loading_"+ award_id).html("");
            },
            success: function(html) {
                 if(html == "OK") {
                     $("#award_receive_"+ award_id).html("<font color='blue'><strong>Đã nhận Item thành công</strong></font>");
                 } else {
                     $("#err_"+ award_id).html("<font color='red'><strong>"+ html +"</strong></font>");
                 }
            }
         });
        
        return false;
    })
    
    $(".tuluyen").live('click', function(){
        var tltype = $(this).attr("tltype");

         var dataString = "action=update&tltype="+  tltype;
         
          $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=tuluyen",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#loading_tl"+ tltype).html("<img src='images/loading1.gif' border='0' />");
                 $("#tlsuccess").html("");
                 $("#tlerror").html("");
                 $("#btn_tl_"+ tltype).attr('disabled','disabled');
            },
            complete: function() {
                 $("#loading_tl"+ tltype).html("");
                 $("#btn_tl_"+ tltype).removeAttr('disabled');
            },
            success: function(html) {
                 var html_split = html.split("|");
                 if(html_split[1] == "OK") {
                    
                    var tuluyen_arr = $.parseJSON(html_split[2]);
                    
                    $("#tl_point").html(tuluyen_arr['tlpoint']);
                    
                    if(tuluyen_arr['tangcap'] == 1) {
                        $("#tlexp_" + tltype).html('<font color="blue">' + tuluyen_arr['exp'] + '</font>');
                        $("#btn_tl" + tltype).html('<input type="button" value="Thăng Cấp" class="tl_thangcap" tltype="'+ tltype +'" /><br /><strong><font color="red">Chúc Phúc : <span id="tlcp_'+ tltype +'">0</span> %</font></strong>');
                    } else {
                        $("#tlexp_" + tltype).html(tuluyen_arr['exp']).slideDown('slow');
                    }
                    
                    $("#tlsuccess").html("<div class='success'>Tu luyện thành công<br />Điểm Tu Luyện tăng lên <strong>"+ tuluyen_arr['exp'] +" Điểm</strong></div>");
                 } else {
                    $("#tlerror").html("<div class='error'>"+ html +"</div>");
                 }
            }
         });
        
        return false;
    })
    
    $(".tl_thangcap").live('click', function(){
        var tltype = $(this).attr("tltype");

         var dataString = "action=thangcap&tltype="+  tltype;
         
          $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=tuluyen",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#loading_tl"+ tltype).html("<img src='images/loading1.gif' border='0' />");
                 $("#tlsuccess").html("");
                 $("#tlerror").html("");
                 $("#btn_tc_"+ tltype).attr('disabled','disabled');
            },
            complete: function() {
                 $("#loading_tl"+ tltype).html("");
                  $("#btn_tc_"+ tltype).removeAttr('disabled');
            },
            success: function(html) {
                 var html_split = html.split("|");
                 if(html_split[1] == "OK") {
                    
                    var tuluyen_arr = $.parseJSON(html_split[2]);
                    
                    $("#tl_point").html(tuluyen_arr['tlpoint']);
                    
                    if(tuluyen_arr['tangcap'] == 1) {
                        $("#tlcap_" + tltype).html(tuluyen_arr['tl_cap']);
                        $("#tlpoint_" + tltype).html(tuluyen_arr['tl_point']);
                        $("#tlexp_" + tltype).html(tuluyen_arr['tl_exp']);
                        $("#tlexpnext_" + tltype).html(tuluyen_arr['tl_exp_next']);
                        $("#tlpointnext_" + tltype).html(tuluyen_arr['tl_point_next']);
                        $("#btn_tl" + tltype).html('<input type="button" value="Tu luyện" class="tuluyen" tltype="'+ tltype +'" />');
                    
                        $("#tlsuccess").html("<div class='success'>"+ tuluyen_arr['msg'] +"</div>");
                    } else {
                        $("#tlcp_" + tltype).html(tuluyen_arr['tlcp']);
                        $("#tlerror").html("<div class='error'>"+ tuluyen_arr['msg'] +"</div>");
                    }
                    
                 } else {
                    $("#tlerror").html("<div class='error'>"+ html +"</div>");
                 }
            }
         });
        
        return false;
    })
    
    $(".btn_phucloi").live('click', function(){
        var qindex = $(this).attr("qindex");
        
         var dataString = "action=nhanthuong&qindex="+  qindex;
         
          $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=questdaily",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#loading_quest_"+ qindex).html("<img src='images/loading1.gif' border='0' />");
                 $("#qsuccess").html("");
                 $("#qerror").html("");
                 $("#btn_quest_" + qindex).attr('disabled','disabled');
            },
            complete: function() {
                 $("#loading_quest_"+ qindex).html("");
            },
            success: function(html) {
                 var html_split = html.split("|");
                 if(html_split[1] == "OK") {
                    
                    if(html_split[2] == 0) {
                        $("#qdl_un").html(html_split[2]);
                    } else {
                        $("#qdl_un").html("<font color='red'>" + html_split[2] + "</font>");
                    }
                    
                    $("#pl_point").html(html_split[3]);
                    $("#btn_spanquest_" + qindex).html("Đã nhận");
                    
                    $("#qsuccess").html("<div class='success'>"+ html_split[4] +"</div>");
                    var alertcontent = html_split[4].replace("<br />","\n");
                    alertcontent = alertcontent.replace("<br>","\n");
                    alert(alertcontent);
                 } else {
                    $("#btn_quest_" + qindex).removeAttr('disabled');
                    $("#qerror").html("<div class='error'>"+ html +"</div>");
                    var alertcontent = html.replace("<br />","\n");
                    alertcontent = alertcontent.replace("<br>","\n");
                    alert(alertcontent);
                 }
            }
         });
        
        return false;
    })
    
    $("#btn_pl_change").live('click', function(){
        var pl_point_change = $('#pl_point_change').val();
        if(!pl_point_change) pl_point_change = 0;
        pl_point_change = parseInt(pl_point_change)
        
        var pl_point_to = $('#pl_point_to').val();
        
        if(pl_point_change == 0) {
            $("#plchange_error").html("<div class='error'>Điểm Phúc Lợi muốn đổi phải lớn hơn 0.</div>");
        } else {
            var dataString = "action=plchange&pl_point_to="+  pl_point_to + "&pl_point_change=" + pl_point_change;
         
          $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=questdaily",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#loading_pl_change").html("<img src='images/loading1.gif' border='0' />");
                 $("#plchange_success").html("");
                 $("#plchange_error").html("");
                 $("#btn_pl_change").attr('disabled','disabled');
            },
            complete: function() {
                 $("#loading_pl_change").html("");
            },
            success: function(html) {
                 var html_split = html.split("|");
                 if(html_split[1] == "OK") {
                    
                    $("#pl_point").html(html_split[2]);
                    
                    $("#plchange_success").html("<div class='success'>"+ html_split[3] +"</div>");
                 } else {
                    $("#plchange_error").html("<div class='error'>"+ html +"</div>");
                 }
                 $("#btn_pl_change").removeAttr('disabled');
            }
         });
        }
            

        return false;
    })
    
    $("#btn_st_up").live('click', function(){

         var dataString = "action=update";
         
          $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=songtu",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#loading_st").html("<img src='images/loading1.gif' border='0' />");
                 $("#stsuccess").html("");
                 $("#sterror").html("");
                 $("#btn_st_up").attr('disabled','disabled');
            },
            complete: function() {
                 $("#loading_st").html("");
                 $("#btn_st_up").removeAttr('disabled');
            },
            success: function(html) {
                 var html_split = html.split("|");
                 if(html_split[1] == "OK") {
                    
                    var songtu_arr = $.parseJSON(html_split[2]);
                    
                    $("#st_point").html(songtu_arr['stpoint']);
                    
                    if(songtu_arr['tangcap'] == 1) {
                        $("#stexp").html('<font color="blue">' + songtu_arr['exp'] + '</font>');
                        $("#btn_st").html('<input type="button" value="Thăng Cấp Song Tu" class="st_thangcap" id="btn_st_tc" /><br /><strong><font color="red">Chúc Phúc : <span id="stcp">0</span> %</font></strong>');
                    } else {
                        $("#stexp").html(songtu_arr['exp']).slideDown('slow');
                    }
                    
                    $("#stsuccess").html("<div class='success'>Song Tu thành công<br />Độ Thân Mật tăng lên <strong>"+ songtu_arr['exp'] +"</strong></div>");
                 } else {
                    $("#sterror").html("<div class='error'>"+ html +"</div>");
                 }
            }
         });
        
        return false;
    })
    
    $("#btn_st_tc").live('click', function(){

         var dataString = "action=thangcap";
         
          $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=songtu",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#loading_st").html("<img src='images/loading1.gif' border='0' />");
                 $("#stsuccess").html("");
                 $("#sterror").html("");
                 $("#btn_st_tc").attr('disabled','disabled');
            },
            complete: function() {
                 $("#loading_st").html("");
                  $("#btn_st_tc").removeAttr('disabled');
            },
            success: function(html) {
                 var html_split = html.split("|");
                 if(html_split[1] == "OK") {
                    
                    var tuluyen_arr = $.parseJSON(html_split[2]);
                    
                    $("#tl_point").html(tuluyen_arr['tlpoint']);
                    
                    if(tuluyen_arr['tangcap'] == 1) {
                        $("#stlv").html(tuluyen_arr['songtu_lv']);
                        $("#stexpup").html(tuluyen_arr['songtu_exp_next']);
                        $("#st_percent_point").html(tuluyen_arr['songtu_point_percent']);
                        $("#btn_st").html('<input type="button" value="Song Tu" class="songtu" id="btn_st_up" />');
                    
                        $("#stsuccess").html("<div class='success'>"+ tuluyen_arr['msg'] +"</div>");
                    } else {
                        $("#stcp").html(tuluyen_arr['cp_percent']);
                        $("#sterror").html("<div class='error'>"+ tuluyen_arr['msg'] +"</div>");
                    }
                    
                 } else {
                    $("#sterror").html("<div class='error'>"+ html +"</div>");
                 }
            }
         });
        
        return false;
    })
    
    $("#btn_gift_st_point").live('click', function(){
        var gift_stpoint = $('#gift_st_point').val();
        if(!gift_stpoint) gift_stpoint = 0;
        gift_stpoint = parseInt(gift_stpoint)
        
        
        if(gift_stpoint <= 0) {
            $("#gift_st_notice").html("<div class='error'>Điểm Song Tu muốn tặng phải lớn hơn 0.</div>");
        } else {
         var dataString = "action=gift_stpoint&gift_stpoint=" + gift_stpoint;
         
          $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=songtu",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#gift_stpoint_loading").html("<img src='images/loading1.gif' border='0' />");
                 $("#gift_st_notice").html("");
                 $("#btn_gift_st_point").attr('disabled','disabled');
            },
            complete: function() {
                 $("#gift_stpoint_loading").html("");
                  $("#btn_gift_st_point").removeAttr('disabled');
            },
            success: function(html) {
                 var html_split = html.split("|");
                 if(html_split[1] == "OK") {
                    var gift_arr = $.parseJSON(html_split[2]);
                    
                    $("#st_point").html(gift_arr['songtu_point']);
                    $("#gift_st_notice").html("<div class='success'>Đã tặng bạn đời "+ gift_stpoint +" Điểm Tu Luyện.<br />Chi phí : 1 Trái Tim.<br />Bạn còn : "+ gift_arr['heart'] +" Trái Tim.</div>");
                    $('#gift_st_point').val(0);
                 } else {
                    $("#gift_st_notice").html("<div class='error'>"+ html +"</div>");
                 }
            }
         });
        }
        return false;
    })
    
    $(".item_ch_open").live('click', function() {
        var vitri = $(this).attr('vitri');
        
        $("#itemch_unactive_"+ vitri).slideUp();
        $("#itemch_active_"+ vitri).slideDown();
        
        return false;
    });
    
    $(".item_ch_close").live('click', function() {
        var vitri = $(this).attr('vitri');
        
        $("#itemch_unactive_"+ vitri).slideDown();
        $("#itemch_active_"+ vitri).slideUp();
        $('#item_ch_open_'+ vitri).show();
        
        return false;
    });
    
    $(".chitem").live('click', function(){
        var vitri = $(this).attr("vitri");
        var serial = $(this).attr("serial");
        var item_lvl = $(this).attr("item_lvl");
        
         var dataString = "vitri=" + vitri + "&serial=" + serial + "&item_lvl=" + item_lvl;
         
          $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=cuonghoa",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#itemch_loading_" + vitri).html("<img src='images/loading1.gif' border='0' />");
                 $("#itemch_view_" + vitri).html("");
                 $("#chitem_" + vitri).attr('disabled','disabled');
            },
            complete: function() {
                 $("#itemch_loading_" + vitri).html("");
                  $("#chitem_" + vitri).removeAttr('disabled');
            },
            success: function(html) {
                 var html_split = html.split("|");
                 if(html_split[1] == "OK") {
                    var chup_arr = $.parseJSON(html_split[2]);
                    
                    $("#itemch_cp_" + vitri).html(chup_arr['cp_percent']);
                    $("#chpoint").html(chup_arr['cuonghoa_point_new']);
                    if(chup_arr['uplv'] == 0) {
                        $("#itemch_view_" + vitri).html("<div class='error'>"+ chup_arr['msg'] +"</div>");
                    } else {
                        $("#itemch_view_" + vitri).html("<div class='success'>"+ chup_arr['msg'] +"</div>");
                        $("#itemlv_now_" + vitri).html(chup_arr['itemlvl_new']);
                        $("#itemlv_up_" + vitri).html(chup_arr['itemlvl_new'] + 1);
                    }
                        
                 } else {
                    $("#itemch_view_" + vitri).html("<div class='error'>"+ html +"</div>");
                 }
            }
         });
        return false;
    })
    
    $(".item_hh_open").live('click', function() {
        var vitri = $(this).attr('vitri');
        
        $("#itemhh_unactive_"+ vitri).slideUp();
        $("#itemhh_active_"+ vitri).slideDown();
        
        return false;
    });
    
    $(".item_hh_close").live('click', function() {
        var vitri = $(this).attr('vitri');
        
        $("#itemhh_unactive_"+ vitri).slideDown();
        $("#itemhh_active_"+ vitri).slideUp();
        $('#item_hh_open_'+ vitri).show();
        
        return false;
    });
    
    $(".hhitem").live('click', function(){
        var vitri = $(this).attr("vitri");
        var serial = $(this).attr("serial");
        
         var dataString = "vitri=" + vitri + "&serial=" + serial;
         
          $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=hoanhaohoa",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#itemhh_loading_" + vitri).html("<img src='images/loading1.gif' border='0' />");
                 $("#itemhh_view_" + vitri).html("");
                 $("#hhitem_" + vitri).attr('disabled','disabled');
            },
            complete: function() {
                 $("#itemhh_loading_" + vitri).html("");
                  $("#hhitem_" + vitri).removeAttr('disabled');
            },
            success: function(html) {
                 var html_split = html.split("|");
                 if(html_split[1] == "OK") {
                    var hhup_arr = $.parseJSON(html_split[2]);
                    
                    $("#itemhh_cp_" + vitri).html(hhup_arr['cp_percent']);
                    $("#hhpoint").html(hhup_arr['hh_point_new']);
                    if(hhup_arr['up'] == 0) {
                        $("#itemhh_view_" + vitri).html("<div class='error'>"+ hhup_arr['msg'] +"</div>");
                    } else {
                        $("#itemhh_view_" + vitri).html("<div class='success'>"+ hhup_arr['msg'] +"</div>");
                        $("#itemhh_now_" + vitri).html(hhup_arr['exc_total_new']);
                        $("#itemhh_up_" + vitri).html(hhup_arr['exc_total_new'] + 1);
                    }
                        
                 } else {
                    $("#itemhh_view_" + vitri).html("<div class='error'>"+ html +"</div>");
                 }
            }
         });
        return false;
    });
    
    $("#btn_pl_ban").live('click', function(){
        var plpoint_ban = $("#plpoint_ban").val();
        var plpoint_vpoint = $("#plpoint_vpoint").val();
        
         var dataString = "action=banpl&plpoint_ban=" + plpoint_ban + "&plpoint_vpoint=" + plpoint_vpoint;
         
          $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=chopl",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#banpl_loading").html("<img src='images/loading1.gif' border='0' />");
                 $("#banpl_view").html("");
                 $("#btn_pl_ban").attr('disabled','disabled');
            },
            complete: function() {
                 $("#banpl_loading").html("");
                  $("#btn_pl_ban").removeAttr('disabled');
            },
            success: function(html) {
                 var html_split = html.split("|");
                 if(html_split[1] == "OK") {
                    
                    $("#plpoint").html(html_split[2]);
                    $("#banpl_view").html("<div class='success'>"+ html_split[3] +"</div>");
                    $("#plpoint_ban").val(0);
                    $("#plpoint_vpoint").val(0);
                        
                 } else {
                    $("#banpl_view").html("<div class='error'>"+ html +"</div>");
                 }
            }
         });
        return false;
    });
    
    $(".btn_plmua").live('click', function(){
        var store_id = $(this).attr("store_id");
        
         var dataString = "action=muapl&store_id=" + store_id;
         
          $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=chopl",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#muapl_view_" + store_id).html("<img src='images/loading1.gif' border='0' />");
                 $("#btn_plmua_" + store_id).attr('disabled','disabled');
            },
            complete: function() {
                  
            },
            success: function(html) {
                 var html_split = html.split("|");
                 if(html_split[1] == "OK") {
                    
                    $("#muapl_view_" + store_id).html("<div class='success'>"+ html_split[2] +"</div>");
                    $("#btn_plmua_" + store_id).val("Đã mua");
                        
                 } else {
                    $("#muapl_view_" + store_id).html("<div class='error'>"+ html +"</div>");
                    $("#btn_plmua_" + store_id).removeAttr('disabled');
                 }
            }
         });
        return false;
    });
    
    $(".btn_huyban").live('click', function(){
        var store_id = $(this).attr("store_id");
        
         var dataString = "action=huyban&store_id=" + store_id;
         
          $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=chopl",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#huypl_view_" + store_id).html("<img src='images/loading1.gif' border='0' />");
                 $("#btn_huyban_" + store_id).attr('disabled','disabled');
            },
            complete: function() {
                  
            },
            success: function(html) {
                 var html_split = html.split("|");
                 if(html_split[1] == "OK") {
                    
                    $("#huypl_view_" + store_id).html("<div class='success'>"+ html_split[2] +"</div>");
                    $("#plpoint").html(html_split[3]);
                    $("#td_huyban_" + store_id).html("Đã hủy");
                        
                 } else {
                    $("#huypl_view_" + store_id).html("<div class='error'>"+ html +"</div>");
                    $("#btn_huyban_" + store_id).removeAttr('disabled');
                 }
            }
         });
        return false;
    });
    
    $(".itemreward_up").live('click', function() {
        var vitri = $(this).attr('vitri');
        
        $("#itemreward_unactive_"+ vitri).slideUp();
        $("#itemreward_active_"+ vitri).slideDown();
        
        return false;
    });
    
    $(".itemreward_down").live('click', function() {
        var vitri = $(this).attr('vitri');
        
        $("#itemreward_unactive_"+ vitri).slideDown();
        $("#itemreward_active_"+ vitri).slideUp();
        
        return false;
    });
    
    function func_rewarditem(vitri) {
        
        var reward_type = $('#reward_type').val();
        var lvl = $('#level_'+ vitri).val();
        var opt = $('#option_'+ vitri).val();
        var rewardday = $('#rewardday_'+ vitri).val();
        
        var luck = 0;
        if ($('#luck_'+ vitri).is(":checked"))
        {
          var luck = 1;
        }
        
        var exl1 = 0;
        if ($('#exl_'+ vitri +'_1').is(":checked"))
        {
          var exl1 = 1;
        }
        var exl2 = 0;
        if ($('#exl_'+ vitri +'_2').is(":checked"))
        {
          var exl2 = 1;
        }
        var exl3 = 0;
        if ($('#exl_'+ vitri +'_3').is(":checked"))
        {
          var exl3 = 1;
        }
        var exl4 = 0;
        if ($('#exl_'+ vitri +'_4').is(":checked"))
        {
          var exl4 = 1;
        }
        var exl5 = 0;
        if ($('#exl_'+ vitri +'_5').is(":checked"))
        {
          var exl5 = 1;
        }
        var exl6 = 0;
        if ($('#exl_'+ vitri +'_6').is(":checked"))
        {
          var exl6 = 1;
        }
        
        var dataString = "action=rewardprice&reward_type="+ reward_type +"&vitri="+ vitri +"&luck="+ luck +"&exl1="+ exl1 +"&exl2="+ exl2 +"&exl3="+ exl3 +"&exl4="+ exl4 +"&exl5="+ exl5 +"&exl6="+ exl6 +"&lvl="+ lvl +"&opt="+ opt +"&rewardday="+ rewardday;
        
        $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=rewarditem",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#btn_reward_waiting_" + vitri).html("<img src='images/loading1.gif' border='0' />");
            },
            complete: function() {
                $("#btn_reward_waiting_" + vitri).html("");
            },
            success: function(html) {
                 var html_split = html.split("|");
                 if(html_split[1] == "OK") {
                    
                    $("#notice_reward_info_" + vitri).html("<div class='success_noimg'>"+ html_split[2] +"</div>");
                        
                 } else {
                    $("#notice_reward_info_" + vitri).html("<div class='error'>"+ html +"</div>");
                 }
            }
         });
        
        return false;
    };
    
    $('.reward_luck, .reward_exl').live('click', function(){
        var vitri = $(this).attr('vitri');
        func_rewarditem(vitri);
    });
    
    $('.reward_lvl, .reward_op, .reward_day').live('change', function(){
        var vitri = $(this).attr('vitri');
        func_rewarditem(vitri);
    });
    
    $('.btn_reward').live('click', function(){
        var vitri = $(this).attr('vitri');
        var reward_type = $('#reward_type').val();
        var lvl = $('#level_'+ vitri).val();
        var opt = $('#option_'+ vitri).val();
        var rewardday = $('#rewardday_'+ vitri).val();
        
        var luck = 0;
        if ($('#luck_'+ vitri).is(":checked"))
        {
          var luck = 1;
        }
        
        var exl1 = 0;
        if ($('#exl_'+ vitri +'_1').is(":checked"))
        {
          var exl1 = 1;
        }
        var exl2 = 0;
        if ($('#exl_'+ vitri +'_2').is(":checked"))
        {
          var exl2 = 1;
        }
        var exl3 = 0;
        if ($('#exl_'+ vitri +'_3').is(":checked"))
        {
          var exl3 = 1;
        }
        var exl4 = 0;
        if ($('#exl_'+ vitri +'_4').is(":checked"))
        {
          var exl4 = 1;
        }
        var exl5 = 0;
        if ($('#exl_'+ vitri +'_5').is(":checked"))
        {
          var exl5 = 1;
        }
        var exl6 = 0;
        if ($('#exl_'+ vitri +'_6').is(":checked"))
        {
          var exl6 = 1;
        }
        
        var dataString = "action=rewardsend&reward_type="+ reward_type +"&vitri="+ vitri +"&luck="+ luck +"&exl1="+ exl1 +"&exl2="+ exl2 +"&exl3="+ exl3 +"&exl4="+ exl4 +"&exl5="+ exl5 +"&exl6="+ exl6 +"&lvl="+ lvl +"&opt="+ opt +"&rewardday="+ rewardday;
        
        $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=rewarditem",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#btn_reward_waiting_" + vitri).html("<img src='images/loading1.gif' border='0' />");
            },
            complete: function() {
                $("#btn_reward_waiting_" + vitri).html("");
            },
            success: function(html) {
                 var html_split = html.split("|");
                 if(html_split[1] == "OK") {
                    
                    $("#reward_success_" + vitri).html("<div class='success'>"+ html_split[2] +"</div>");
                        
                 } else {
                    $("#reward_success_" + vitri).html("<div class='error'>"+ html +"</div>");
                 }
            }
         });
        
        return false;
    });
    
    
    $('#xoay_longcondor').live('click', function(){
        
        var dataString = "action=xoay_longcondor";
        
        $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=maychao",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#xoay_longcondor_msg").html("<img src='images/loading1.gif' border='0' />");
            },
            complete: function() {
                
            },
            success: function(html) {
                 var html_split = html.split("|");
                 if(html_split[1] == "OK") {
                    if(html_split[2] == 1) {
                        $("#xoay_longcondor_info").html("<div class='success_noimg'>"+ html_split[3] +"</div>");
                        $("#xoay_longcondor_msg").html("");
                    } else if(html_split[2] == 2) {
                        $("#xoay_longcondor_info").html("<div class='error_noimg'>"+ html_split[3] +"</div>");
                        $("#xoay_longcondor_msg").html("");
                    } else {
                        $("#xoay_longcondor_msg").html("<div class='info_noimg'>"+ html_split[3] +"</div>");
                    }
                 } else {
                    $("#xoay_longcondor_msg").html("<div class='error'>"+ html +"</div>");
                 }
            }
         });
        
        return false;
    });
    
    $('#kickket').live('click', function(){
        var opd = $('#opd').val();
        
        var dataString = "opd=" + opd;
        
        $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=kickket",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#kickket_msg").html("<img src='images/loading1.gif' border='0' />");
            },
            complete: function() {
                
            },
            success: function(html) {
                if(html == 'OK') {
                    $("#kickket_msg").html("<div class='success'>Đã gửi thông tin Kích Kẹt. Bạn vui lòng đợi trong 5 giây rồi vào Game.</div>");
                } else {
                    $("#kickket_msg").html("<div class='error'>"+ html +"</div>");
                }
                
            }
         });
        
        return false;
    });
    
    $("#lo_diem").live('change', function(){
        var lo_diem = $("#lo_diem").val();
        
        $.get("ajax_action.php", { ajax: "relax_lo", ilo_diem: lo_diem },
            function(data){
                $("#diemlo_gcoin").html(data);
        });
    });
    
    $('#relax_lo_danh').live('click', function(){
        var lo_so = $('#lo_so').val();
        var lo_diem = $('#lo_diem').val();
        
        var dataString = "action=danhlo&lo_so=" + lo_so + "&lo_diem=" + lo_diem;
        
        $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=relax_lo",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#lo_msg").html("<img src='images/loading1.gif' border='0' />");
            },
            complete: function() {
                
            },
            success: function(html) {
                var html_split = html.split("|");
                if(html_split[1] == 'OK') {
                    $("#lo_msg").html("<div class='success'>Đã đánh "+ lo_diem +" điểm lô con "+ lo_so +".<br />Chúc bạn may mắn.</div>");
                    
                    $("#lo_gcoin").html(html_split[2]);
                    $("#lo_so").val(0);
                    $("#lo_diem").val(0);
                    $("#diemlo_gcoin").html("0");
                } else {
                    $("#lo_msg").html("<div class='error'>"+ html +"</div>");
                }
                
            }
         });
        
        return false;
    });
    
    $('#btn_lo_hítory').live('click', function(){
        
        var dataString = "action=lo_history";
        
        $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=relax_lo",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#lo_history").html("<img src='images/loading1.gif' border='0' />");
            },
            complete: function() {
                
            },
            success: function(html) {
                $("#lo_history").html("<div class='info_noimg'>"+ html +"</div>");
            }
         });
        
        return false;
    });
    
    $('#relax_de_danh').live('click', function(){
        var de_so = $('#de_so').val();
        var de_diem = $('#de_diem').val();
        
        var dataString = "action=danhde&de_so=" + de_so + "&de_diem=" + de_diem;
        
        $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=relax_de",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#de_msg").html("<img src='images/loading1.gif' border='0' />");
            },
            complete: function() {
                
            },
            success: function(html) {
                var html_split = html.split("|");
                if(html_split[1] == 'OK') {
                    $("#de_msg").html("<div class='success'>Đã đánh "+ de_diem +".000 Gcoin đề con "+ de_so +".<br />Chúc bạn may mắn.</div>");
                    
                    $("#de_gcoin").html(html_split[2]);
                    $("#de_so").val(0);
                    $("#de_diem").val(0);
                } else {
                    $("#de_msg").html("<div class='error'>"+ html +"</div>");
                }
                
            }
         });
        
        return false;
    });
    
    $('#btn_de_hítory').live('click', function(){
        
        var dataString = "action=de_history";
        
        $.ajax({
            type: "GET",
            url: "ajax_action.php?ajax=relax_de",
            data: dataString,
            cache: false,
            beforeSend: function() {
                 $("#de_history").html("<img src='images/loading1.gif' border='0' />");
            },
            complete: function() {
                
            },
            success: function(html) {
                $("#de_history").html("<div class='info_noimg'>"+ html +"</div>");
            }
         });
        
        return false;
    });
    
});



$(document).ready(function(){
            var activeMenu = '1';
            if(activeMenu.trim() == '') activeMenu = 0;
            $('.mainMenuItems ul li:nth-child('+activeMenu+') a').addClass('active');
            $('.mobileMenu ul li:nth-child('+activeMenu+') a').addClass('active');
            $('.mobileSecondMenu ul li:nth-child('+activeMenu+')').addClass('active');
            $('.mobileMenu ul li:nth-child('+activeMenu+') ul').show();
            $('.notification_icon').click(function(e){
                //$('.notification_detail_area').toggle();
                e.preventDefault();
                e.stopPropagation();
                //$('html,body').click(function(){ $('.notification_detail_area').hide()});

                /**/
            });
        });
        $.ajax({
            type: "GET",
            url: "/loggedInCheck",
            success: function (response) {
                var appendingHtml = '';
                var imgPath = '';
                if (response != "false") {
                    var userData = response.split('|');
                    if(userData[0] == null || userData[0] == 'null' || userData[0].trim()==''){
                        if(userData[3].toLowerCase()=='female')
                            userData[0]='female.jpeg';
                        else
                            userData[0]='male.png';
                        imgPath = '/static/new/img/account/';
                    } else {
                        imgPath = 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/user/';
                    }
                    appendingHtml = '<div class="accountInfo">' +
                            '<img src="' + imgPath + userData[0] + '" alt="" class="img-circle pull-left" width="90px"/>' +
                            '<p class="userName">' + userData[1] + '</p>' +
                            '<p class="userMail">' + userData[2] + '</p>' +
                            '</div>' +
                            '<div class="cartButton">' +
                            '<a href="#"  onclick="removeCartIdfromCookies()" class="chechoutBtn pull-left">Sign Out</a>' +
                            '<a href="/my/profile" class="viewCartBtn pull-right">My Account</a>' +
                            '</div>';
                    $('#userImage').attr('src', imgPath + userData[0]);
                    $('div.mobileMenu > ul > li:nth-last-child(1)').html('<a href="#" onclick="removeCartIdfromCookies()" class="chechoutBtn pull-left">Sign Out</a>');
                    $('div.mobileMenu > ul > li:nth-last-child(2)').html('<a href="/my/profile" class="viewCartBtn pull-right">My Account</a>');
                    isLoggedIn=true;
                }
                else {
                    appendingHtml = '<div class="accountInfo notLogin">' +
                            '<p class="loginText">Hello! Do I know you!!! </p>' +
                            '</div>' +
                            '<div class="cartButton">' +
                            '<a href="/login/?u" class="chechoutBtn pull-left">Sign Up</a>' +
                            '<a href="/login/?" class="viewCartBtn pull-right">Sign In</a>' +
                            '</div>';
                    $('#cartDetailArea').hide();
                    $('div.mobileMenu > ul > li:nth-last-child(1)').html('<a href="/login/?u" class="chechoutBtn pull-left">Sign Up</a>');
                    $('div.mobileMenu > ul > li:nth-last-child(2)').html('<a href="/login/?" class="viewCartBtn pull-right">Sign In</a><p>or</p>');
                }
                $('.accountDetail').html(appendingHtml);
            },
            error: function (error) {
//                alert("Error:" + error);
            },
            complete: function () {
                fetchNotifications();
            }
        });

        var cartId = getCartCookie("cartId");


        $.ajax({
            type: "GET",
            async: false,
            url: "/header/?cartId="+getCartCookie("cartId"),
            
            success: function (response) {
                if (response.length < 16) {
                   var cartInfo = response.split('|');
//                    setCartCookie(cartInfo[2]);
                    cartInfo[0] = (cartInfo[0] == null || cartInfo[0].trim()=='') ? '0' : cartInfo[0];
                    $('.cart').html('<img src="/static/new/img/cart.png" alt="" id="cartImage"/>Cart (' + cartInfo[0] + ')<i class="fa fa-angle-down"></i>');
                    if(cartInfo[0] > 0)
                        $('li.base.onlyInMobileLi').html('<a href="/cart/"><img src="/static/new/img/mainHome/mobileCart.png" alt="" class="verAlinTextBottom"><span class="badge">'+cartInfo[0]+'</span></a>');
                    if(Number(cartInfo[0])>0)
                        $('#cartDetailArea').removeAttr('style');
                    else
                        $('#cartDetailArea').hide();

                }
            },
            error: function (error) {
//        alert("Error:"+ error);
            },
            complete: function () {
            }
        });


        $(".cart").mouseover(function () {
            $.ajax({
                type: "GET",
                url: "/header/?cartId="+getCartCookie("cartId"),
                
                success: function (response) {
                    if (response.length < 16) {
                        var cartInfo = response.split('|');
                        cartInfo[0] = (cartInfo[0] == null || cartInfo[0].trim()=='') ? '0' : cartInfo[0];
                        cartInfo[1] = (cartInfo[1] == null || cartInfo[1].trim()=='') ? '0' : cartInfo[1];

                        $('.cart').html('<img src="/static/new/img/cart.png" alt="" id="cartImage"/>Cart (' + cartInfo[0] + ')<i class="fa fa-angle-down"></i>');
                        $('.cartTop').html('You have ' + cartInfo[0] + ' items in your cart <span class="cartTotalPrice">Total Tk. ' + cartInfo[1] + '</span>');
                        if(Number(cartInfo[0])>0)
                            $('#cartDetailArea').removeAttr('style');
                        else
                            $('#cartDetailArea').hide();
                    }
                },
                error: function (error) {
//        alert("Error:"+ error);
                },
                complete: function () {
                }
            });

            $.ajax({
                type: "GET",
                url: "/cartProducts?cartId="+getCartCookie("cartId"),
                success: function (response) {
                    if(response!=null && response.length>0){
                        var appendingHtml = '';
                        for (var i = 0; i < response.length ; i++) {
                            appendingHtml = appendingHtml +
                                    '<div class="cartProduct" id="cartProduct' + response[i].id + '">' +
                                    '<a href="/' + response[i].productTypeName + '/' + response[i].id + '">' +
                                    '<div class="cartProductItem">' +
                                    '<img src="https://s3-ap-southeast-1.amazonaws.com/rokomari110/product/' + response[i].av + '" width="65px"  alt=""/>' +
                                    '<div>' +
                                    '<p class="productName">' + response[i].nm + '</p>' +
                                    '<ul class="list-inline list-unstyled">';
                            if (response[i].brandName != '')
                                appendingHtml = appendingHtml + '<li class="productBrandName">' + response[i].brandName + '</li>';

                            appendingHtml = appendingHtml + '</ul>' +
                                    '<p class="productPrice' + response[i].id + '">Tk. ' + response[i].prc + '</p>' +
                                    '</div>' +
                                    '</div>' +
                                    '</a>' +
                                    '<div class="cartProductAmount"><ul class="list-unstyled">' +

                                    '<li class="qtyplus" proId="' + response[i].id + '" onclick="changeuantity(this)"><i class="fa fa-angle-up"></i></li>' +
                                    '<li class="qty' + response[i].id + '">' + response[i].qty + '</li>' +
                                    '<li class="qtyminus" proId="' + response[i].id + '" onclick="changeuantity(this)"><i class="fa fa-angle-down"></i></li>' +

                                    '</ul>' +
                                    '</div>' +
                                    '<div class="cartProductTotalPrice"><ul class="list-inline list-unstyled">' +
                                    '<li id="subtotal' + response[i].id + '">Tk. ' + (Number(response[i].qty) * Number(response[i].prc)) + '</li> <li onclick="removeFromCart(' + response[i].id + ')"><i class="fa fa-trash-o"></i></li>' +
                                    '</ul></div></div>'
                        }
                        $('.cartProductList').html(appendingHtml);
                    }
                },
                error: function (error) {
                },
                complete: function () {
                }
            });

        });


        function changeuantity(elem) {
            var productId, qty;
            productId = $(elem).attr('proId');
            var totalPrice, subtotal, totalQty;
            if ($(elem).attr('class').indexOf("plus") > -1) {
                qty = Number($('.qty' + productId).html()) + 1;
                if (qty < 101) {
                    totalPrice = Number($('.cartTotalPrice').html().substr(9)) + Number($('.productPrice' + productId).html().substr(4));
                    subtotal = Number($('#subtotal' + productId).html().substr(3)) + Number($('.productPrice' + productId).html().substr(4));
                    totalQty = Number($('.cart').text().substr(6).replace(')', '')) + 1;
                } else{
                    qty--;
                    totalPrice = Number($('.cartTotalPrice').html().substr(9));
                    subtotal = Number($('#subtotal' + productId).html().substr(3));
                    totalQty = Number($('.cart').text().substr(6).replace(')', ''));
                }
            }
            else {
                qty = Number($('.qty' + productId).html()) - 1;
                if (qty < 1) {
                    qty = 1;
                    return false;
                }
                totalPrice = Number($('.cartTotalPrice').html().substr(9)) - Number($('.productPrice' + productId).html().substr(4));
                subtotal = Number($('#subtotal' + productId).html().substr(3)) - Number($('.productPrice' + productId).html().substr(4));
                totalQty = Number($('.cart').text().substr(6).replace(')', '')) - 1;
            }

            $('.qty' + productId).html(qty);
            $('#subtotal' + productId).html('Tk. ' + subtotal);
            $('.cart').html('<img src="/static/new/img/cart.png" alt="" id="cartImage"/>Cart (' + totalQty + ')<i class="fa fa-angle-down"></i>');
            $('.cartTop').html('You have ' + totalQty + ' items in your cart <span class="cartTotalPrice">Total Tk. ' + totalPrice + '</span>');

            $.ajax({
                type: "POST",
                url: "/cart/update",
                data: "id=" + productId + "&qty=" + qty + "&_tk=" + $('#_tk').val()+"&cartId="+getCartCookie("cartId"),
                success: function (response) {
                },
                error: function (error) {
                },
                complete: function () {
                }
            });
        }

        function removeFromCart(productId) {
            $.ajax({
                type: "GET",
                url: "/removeProduct/" + productId+"?cartId="+getCartCookie("cartId"),
                success: function (response) {
                    if (response == "Removed Successfully!") {
                        var totalPrice = Number($('.cartTotalPrice').html().substr(9)) - Number($('#subtotal' + productId).html().substr(3));
                        var totalQty = Number($('.cart').text().substr(6).replace(')', '')) - Number($('.qty' + productId).html());
                        $('.cart').html('<img src="/static/new/img/cart.png" alt="" id="cartImage"/>Cart (' + totalQty + ')<i class="fa fa-angle-down"></i>');
                        $('.cartTop').html('You have ' + totalQty + ' items in your cart <span class="cartTotalPrice">Total Tk. ' + totalPrice + '</span>');
                        $('#cartProduct' + productId).hide();
                    }
                    else {
                        alert(response);
                    }
                },
                error: function (error) {
                },
                complete: function () {
                }
            });
        }

        function gotoCart() {
            location.href = '/cart/?cartId='+getCartCookie("cartId");
        }
        function checkOut() {
            location.href = '/cart/shipping?cartId='+getCartCookie("cartId");
        }

        function loginByPopUp(){
            $.ajax({
                url: '/logincheck',
                type: "POST",
                data: $("#popupform").serialize()+ "&_tk=" + $('#_tk').val(),
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("X-Ajax-call", "true");
                },
                success: function(result) {
                    $.ajax({
                        type: "GET",
                        url: "/loggedInCheck",
                        success: function (response) {
                            addaccounttocart();
                            var appendingHtml = '';
                            var imgPath = '';
                            if (response != "false") {
                                var userData = response.split('|');
                                if(userData[0] == null || userData[0] == 'null' || userData[0].trim()==''){
                                    if(userData[3].toLowerCase()=='female')
                                        userData[0]='female.jpeg';
                                    else
                                        userData[0]='male.png';
                                    imgPath = '/static/new/img/account/';
                                } else {
                                    imgPath = 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/user/';
                                }
                                appendingHtml = '<div class="accountInfo">' +
                                        '<img src="' + imgPath + userData[0] + '" alt="" class="img-circle pull-left" width="90px"/>' +
                                        '<p class="userName">' + userData[1] + '</p>' +
                                        '<p class="userMail">' + userData[2] + '</p>' +
                                        '</div>' +
                                        '<div class="cartButton">' +
                                        '<a href="/logout" class="chechoutBtn pull-left">Sign Out</a>' +
                                        '<a href="/my/profile" class="viewCartBtn pull-right">My Account</a>' +
                                        '</div>';
                                $('#userImage').attr('src', imgPath + userData[0]);
                                $('div.overlay').hide();
                                $('div.loginPopup').hide();
                                var pid = $('div.loginPopup').attr('proId');
                                if(pid != undefined && pid != 'undefined' && pid != 'null' && pid != null && pid != '') addToCartHover(pid);
                                $('#cartDetailArea').removeAttr('style');
                                isLoggedIn=true;

                                $.get("/csrftoken", function (data) {
                                    $('#logoSearchArea').append('<input type="hidden" id="_tk" value="'+data+'"/>');
                                });
                            }
                            else {
                                $('#popuperror').show();
                                $('div.overlay').show();
                                $('div.loginPopup').show();
                            }
                            $('.accountDetail').html(appendingHtml);
                        },
                        error: function (error) {
                            alert("Error:" + error);
                        },
                        complete: function () {
                            fetchNotifications()
                        }
                    });
                },
                error: function(error){
                }
            });
            return false;
        }

        var cartIdnull = '';
        function setCartCookieNull(cartIdnull) {
            var expires = 'expires=Wed, 30 Dec 2099 12:00:00 UTC;';
            document.cookie = 'cartId=' + cartIdnull + ';' + expires + ';path=/';
        }

        function addaccounttocart(){
            $.get("/addaccounttocart?cartId="+getCartCookie("cartId"), function (data) {
                setCartCookieNull(cartIdnull);

            });
            return isLoggedIn;
        }

        var isLoggedIn = false;

        function logInCheck(){
            $.get("/loggedInCheck", function (data) {
                isLoggedIn = data != "false";
                addaccounttocart();
            });
            return isLoggedIn;
        }
        //logInCheck();
        window.setTimeout(function(){setInterval(function(){logInCheck()}, 1800000)}, 1800000);
        function showLoginPopUp(id) {
            $('div.overlay').fadeIn(500);
            $('div.loginPopup').fadeIn(500).attr('proId', id);
            $(document).on('click', 'div.overlay', function () {
                $('div.overlay').hide();
                $('div.loginPopup').hide();
            });
        }


        function fetchNotifications() {
        /**/
        }

        function removeCartIdfromCookies(){
            setCartCookieNull(cartIdnull);
            location.href='/logout';
        }

/*for search option*/
$(function() {
                                    $("#searchtext").autocomplete({
                                        source: "/data/acsproduct",
                                        select: function(event, ui) {
                                            document.location.href = "/book/" + ui.item.id;
                                        }
                                    });
                                });
                                $('#searchtext').keydown( function(e) {
                                    var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
                                    if(key == 13) {
                                        search();
                                    }
                                });
                                function search(){
                                    if($("#searchtext").val().trim()==''){
                                        $("#searchtext").val('');
                                        $("#searchtext").focus();
                                        return false;
                                    } else
                                        window.location.href = "/search/" + $("#searchtext").val().trim();
                                }
    
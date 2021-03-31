function calcost(deliv) {
    var net_total = $('#cart_tt').html() - 0;

    var within_cost = net_total + (deliv - 0);
    $('.totalcost').html("Total Amount: " + within_cost);
    $('#totcost').val(within_cost);


}

function count_item() {
    var del = $('#delprice').val() - 0;
    $.ajax({
        url: "includes/cartitems.php",
        method: "POST",
        data: { count_item: 1 },
        success: function(data) {
            var qtyamt = data.split("_");
            var n = qtyamt[0];
            var amount = qtyamt[1] - 0;
            var cost = amount + del;
            $(".badge").html(n);
            $(".count_items").val(n);
            $('#cart_tt').html(amount);
            $('#totcost').val(cost);
            $('#amountorder').val(cost);
            $('#torals').html(cost);
        }
    });
}

function getCartItem() {
    $.ajax({
        url: "includes/cartitems.php",
        method: "POST",
        data: { Common: 1, getCartItem: 1 },
        success: function(data) {
            $("#cart_product").html(data);
            $("#carts").html(data);
        }
    });
}
$(document).ready(function() {
    $('#totcost').keyup(function() {
        var cost = $("#totcost").val();
        var number = /^\d*$/.test(cost);
        if (!number) {
            $('#costerror').html("Values entered not Numbers");
        }

    });

    $('#phone_num').keyup(function() {
        var cost = $("#phone_num").val();
        var number = /^\d*$/.test(cost);
        if (!number) {
            $('#phone_error').html("Values entered not Numbers");
        }

    });
    $(document).on("click", ".ap", function() {
        var value = $(".ap").html();
        value = $.trim(value);
        if (value === 'Apply' || value === 'Not Applied' || value === 'Incorrect' || value === 'Limit Exceeded' || value === 'Less Items') {
            var discount = $('#discount_code').val();
            if ($.trim(discount) !== '') {
                checkDiscount();
            }
        }
    });
    var cp = 0;
    $(document).on("click", "#cod_pay", function() {
        cp++;
        if (cp === 1) {
            codPay();
        }
    });

    function codPay() {
        var payments = $("#nambari").val();
        var number = /^\d*$/.test(payments);
        var length = payments.length;
        var typecost = $('#totcost').val();
        var name = $('#name').val();
        if (name === '' || payments === '') {
            if (name === '') {
                $("#name").css('border', '2px solid rgba(192,29,129,1)').css('color', 'rgba(192,29,129,1)').attr('placeholder', 'name required');
            }
            if (payments === '') {
                $("#nambari").css('border', '2px solid rgba(192,29,129,1)').css('color', 'rgba(192,29,129,1)').attr('placeholder', 'phone required');
            }
        } else if (number && length === 10) {


            $.ajax({
                url: "payments/stk_initiate.php",
                method: "POST",
                data: {
                    payments: payments,
                    amount: typecost,
                    hidden_cost: typecost,
                    name: name
                },
                beforeSend: function() {
                    $("#cod_pay").val("SENDING STK PUSH");
                },
                success: function(data) {
                    console.log(data);
                    var res = data.substring(0, 2);
                    if (res === 'ws') {
                        checkMpesa(data, payments);
                    } else if (data === 'Logged Out') {
                        $("#cod_pay").val(data);
                        location.reload(true);
                    } else {
                        $("#cod_pay").val("TRY AGAIN..");
                    }


                },
                error: function() {
                    alert("Error");
                }
            });


        } else {
            $("#cod_pay").val("Invalid Amount");
            console.log(length);
            console.log(number);
        }

    }

    function checkMpesa(mpesa, payments) {

        var timesRun = 0;
        var interval = setInterval(function() {
            timesRun += 1;

            var mpesaData = mpesa.replace(/\s/g, '');

            $.ajax({
                url: "includes/checkMpesa.php",
                method: "POST",
                data: { mpesa: mpesaData, timesrun: timesRun, phone: payments },
                beforeSend: function() {
                    $("#cod_pay").val("Checking Payment...");
                },
                success: function(data) {
                    var dataarray = data.split("_");
                    var check = dataarray[0];
                    var checkid = dataarray[1];
                    var number = /^\d*$/.test(checkid);


                    $('#cod_pay').val(check);
                    if (check === 'Payment Successful' && number) {
                        clearInterval(interval);
                        placeOrder(checkid);
                    } else if (data === 'Not Received') {
                        clearInterval(interval);
                        location.reload(true);
                    }


                }
            });

        }, 3000);
    }

    $('#vmsr').hide();
    $('#appmpesa').click(function() {
        if ($(this).is(":checked")) {
            $('#vmsr').show();
            $('#lmpsr').hide();
            $('#oooy').html('Uncheck to pay via LIPA NA MPESA EXPRESS').css('color', 'green');
        } else {
            $('#oooy').html('Use M-PESA code to place order').css('color', 'black');
            $('#vmsr').hide();
            $('#lmpsr').show();
        }
    });

    $('#vefcode').click(function() {
        sendCode();
    });

    function sendCode() {
        var name = $('#conem').val(),
            nem = $.trim(name);
        var mpesa = $('#mpsacode').val(),
            code = $.trim(mpesa),
            lens = code.length;
        var phne = $('#contacts').val(),
            phn = $.trim(phne),
            contacts = phn.length;
        var typecost = $('#torals').html(),
            trimmed = $.trim(typecost),
            cost = /^\d*$/.test(trimmed);
        console.log(trimmed);

        if (nem === '') {
            $('#conem').attr('placeholder', 'Name Required').css('color', 'red').css('border', '2px solid red');
        }
        if (phn === '') {
            $('#contacts').attr('placeholder', 'phone number required').css('color', 'red').css('border', '2px solid red');
        }
        if (code === '') {
            $('#mpsacode').attr('placeholder', 'Mpesa Code Required').css('color', 'red').css('border', '2px solid red');
        }
        if (lens === 10 && contacts === 10) {
            $.ajax({
                url: "includes/checkode.php",
                method: "POST",
                data: {
                    phone: phn,
                    code: code,
                    name: nem,
                    ocost: trimmed
                },
                beforeSend: function() {
                    $("#vefcode").val("VERIFYING..");
                },
                success: function(data) {
                    var dataarray = data.split("_");
                    var check = dataarray[0];
                    var checkid = dataarray[1];
                    var number = /^\d*$/.test(checkid);
                    console.log(check);
                    if (check === 'Payment Successful') {
                        paymentOrder(checkid);
                    } else {
                        $("#vefcode").val('PLACE ORDER');
                        $("#mpesamsg").html(data).css('color', 'red');
                    }
                },
                error: function() {
                    alert("Error");
                }
            });
        } else {
            $("#mpesamsg").html("Check code or phone number");
        }
    }



    function checkDiscount() {
        var discount = $('#discount_code').val();
        var amount = $('#totcost').val(),
            trimmed = $.trim(amount) - 0;
        var items = $('.badge').html();
        var delfee = $('#delprice').val(),
            trimdel = $.trim(delfee) - 0;

        var net_amount = trimmed - trimdel;

        if (amount === '' || items === '') {
            alert("Incorrect Amount");
        } else if ($.trim(discount) !== '') {
            $.ajax({
                url: "includes/disCheck.php",
                method: "POST",
                data: { discount: discount, amount: amount, items: items },
                beforeSend: function() {
                    $(".ap").val("Verifying...");
                },
                success: function(data) {
                    if (data === 'free') {
                        $('#totcost').val(net_amount);
                        $('.ap').html('Applied');
                        $('#torals').html(net_amount);
                    } else if (data === 'Success') {
                        count_item();
                        getCartItem();
                        $('.ap').html('Applied');
                    } else {
                        $('.ap').html(data);
                    }

                }
            });

        }

    }

    function paymentOrder(checkid) {
        var typecost = $('#torals').html(),
            trimmed = $.trim(typecost),
            cost = /^\d*$/.test(trimmed);
        var delfee = $('#delprice').val(),
            trimdel = $.trim(delfee),
            delcost = /^\d*$/.test(trimdel);

        if (cost && delcost) {
            $.ajax({
                url: "includes/place24.php",
                method: "POST",
                data: { amount: trimmed, checkid: checkid, delfee: trimdel },
                beforeSend: function() {
                    $("#vefcode").val("PLACING ORDER..");
                },
                success: function(data) {


                    if (data === 'Order Placed') {
                        window.location.href = "ohist";
                        $("#vefcode").val("Order Placed");
                    } else {
                        location.reload(true);
                    }

                }
            });
        } else {
            $("#cod_pay").val('Invalid');
        }

    }

    function placeOrder(checkid) {
        var typecost = $('#torals').html(),
            trimmed = $.trim(typecost),
            cost = /^\d*$/.test(trimmed);
        var delfee = $('#delprice').val(),
            trimdel = $.trim(delfee),
            delcost = /^\d*$/.test(trimdel);

        if (cost && delcost) {
            $.ajax({
                url: "includes/place24.php",
                method: "POST",
                data: { amount: trimmed, checkid: checkid, delfee: trimdel },
                beforeSend: function() {
                    $("#cod_pay").val("PLACING ORDER..");
                },
                success: function(data) {


                    if (data === 'Order Placed') {
                        window.location.href = "ohist";
                        $("#cod_pay").val(data);
                    } else if (data === 'empty') {
                        window.location.href = "index";
                    } else {
                        $("#cod_pay").val("Place order");
                        location.reload(true);
                    }

                }
            });
        } else {
            $("#cod_pay").val('Invalid');
        }

    }

    $('#suggest').click(function() {
        var phone = $('#phonumber').val();
        var suggestion = $('#suggestions').val();
        var suggest = $.trim(suggestion);
        console.log(suggest);
        var number = /^\d*$/.test(phone);
        var length = phone.length;

        if (number && length === 10 && suggest !== '') {
            $.ajax({
                url: "postFiles/cust.suggestions.php",
                method: "POST",
                data: {
                    phone: phone,
                    suggestion: suggest
                },
                beforeSend: function() {
                    $("#suggest").val("SENDING SUGGESTION");
                },
                success: function(data) {
                    $("#suggest").val("SENT");
                    console.log(data);


                },
                error: function() {
                    console.log("Error");
                }
            });
        } else {

        }


    });

    function placeCod(an) {
        var typecost = $('#torals').html(),
            trimmed = $.trim(typecost),
            cost = /^\d*$/.test(trimmed);
        var delfee = $('#delprice').val(),
            trimdel = $.trim(delfee),
            delcost = /^\d*$/.test(trimdel);

        if (cost && delcost) {
            $.ajax({
                url: "includes/placecod.php",
                method: "POST",
                data: { an: an, amount: trimmed, delfee: trimdel },
                beforeSend: function() {
                    $("#placeorder").val("PLACING ORDER..");
                },
                success: function(data) {


                    if (data === 'Order Placed') {
                        window.location.href = "ohist";
                        $("#placeorder").val(data);
                    } else if (data === 'empty') {
                        window.location.href = "index";
                    } else {
                        $("#placeorder").val(data);
                    }

                }
            });
        } else {
            $("#placeorder").val('Invalid');
        }

    }
    $(document).on('click', '#placeorder', function() {
        var codename = $('#codnem');
        var name = codename.val();
        if ($.trim(name) !== '') {
            var an = $.trim(name);
            placeCod(an);
        } else {
            codename.css('border', '2px solid red');
            codename.attr('placeholder', 'Name Required');
        }


    });
});
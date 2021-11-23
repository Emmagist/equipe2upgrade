function getURL(){
    var firstFolder = location.pathname.match(/\w+/)[0];
    urlPath = window.location.protocol + "//" + window.location.host+"/"+firstFolder+"/myschool";
    return urlPath;
}

function getLoanInfo() {
    var loan_id =$('#loan_id').val()
    mypath='mode=getLoanBalance&loandid='+loan_id;
    $.ajax({
        type:'POST',
        url:'../loaddata.php',
        data:mypath,
        dataType: "JSON",
        success:function(resps){
            if (resps.status == "1") {
                $('#loan_bal').val(resps.bal.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                $('#pre_paid').val(resps.paid);
            }
            else {
                swal('Norakle Respond!', 'Something went Wrong! Refresh the page and try again'+resps.loand_id );
            }
            return false;
        }
    });
}


function callConvertMoney(indexval) {
    $('#indexval').val(indexval)
    $('#convertMoney').modal('show');
    return false;
}

function convertM() {
    var famt = eval($('#famt').val());
    var rate = eval($('#rate').val());
    var i = eval($('#indexval').val());
    if (famt < 1) {
        swal('Norakle Respond!', 'Enter Amount');
    } else if (rate < 1) {
        swal('Norakle Respond!', 'Enter conversion Rate');
    } else {
        $('#realamt').val(famt * rate)
        document.getElementById('amount' + i).value = famt * rate
    }
    return false;
}

function moneyConertion() {
    var famt = eval($('#famt').val());
    var rate = eval($('#rate').val());
    var i = eval($('#indexval').val());
    $('#convertMoney').modal('hide');
    if (famt < 1) {
        swal('Norakle Respond!', 'Enter Amount');
    } else if (rate < 1) {
        swal('Norakle Respond!', 'Enter conversion Rate');
    } else {
        document.getElementById('amount' + i).value = famt * rate
        $('#famt').val("")
        $('#rate').val("")
    }
    return false;

}

function addCategory() {
    var event_cat = $('#event_cat').val();
    $.blockUI({ overlayCSS: { backgroundColor: '#00f' } });
    mypath = 'mode=addCategory&cat_name=' + event_cat;
    $('#addEventCat').modal('hide');
    $('#CalenderModalNew').modal('show');
    $.ajax({
        type: 'POST',
        url: '../loaddata.php',
        data: mypath,
        dataType: "JSON",
        success: function(resps) {
            //alert(resps.status)
            if (resps.status == "1") {
                $('#catid').append(resps.addoption);
                $("#catid").val(resps.catid).change();
                swal("Category created saved successfully!", "Weldone", "success");
            } else if (resps.status == "2") {
                swal('Norakle Respond!', 'Client with same name Exist! You can\'t create same name again');
            } else {
                swal('Norakle Respond!', 'Something went Wrong! Try again');
            }
            $.unblockUI();
            return false;
        }
    });
    return false;
}

function addGroup() {
    var group_name = $('#group_name').val();
    var members = $('#members').val();
    $.blockUI({ overlayCSS: { backgroundColor: '#00f' } });
    mypath = 'mode=addGroup&group_name=' + group_name + '&members=' + members;
    $('#addGroup').modal('hide');
    $.ajax({
        type: 'POST',
        url: '../loaddata.php',
        data: mypath,
        dataType: "JSON",
        success: function(resps) {
            //alert(resps.status)
            if (resps.status == "1") {
                $('#groupuser').append(resps.addoption);
                $("#groupuser").val(resps.groupid).change();
                swal("Group created successfully!", "Weldone", "success");
            } else if (resps.status == "2") {
                swal('Norakle Respond!', 'Client with same name Exist! You can\'t create same name again');
            } else {
                swal('Norakle Respond!', 'Something went Wrong! Try again');
            }
            $.unblockUI();
            return false;
        }
    });
    return false;
}

function addClient() {
    var ctype = $('#ctype').val();
    var phone = $('#phone').val();
    var name = $('#name').val();
    var industryid = $('#industryid').val();
    var country = $('#country').val();
    var address = $('#address').val();
    var folderbs = $('#folderbs').val();
    var urlbase = '../loaddata.php';
    if (folderbs == "1" || folderbs == 1) {
        urlbase = 'loaddata.php';
    }
    $.blockUI({ overlayCSS: { backgroundColor: '#00f' } });
    mypath = 'mode=addClient&ctype=' + ctype + '&phone=' + phone + '&industryid=' + industryid + '&sn=' + name + '&country=' + country + '&address=' + address;
    $('#addClient').modal('hide');
    $.ajax({
        type: 'POST',
        url: urlbase,
        data: mypath,
        dataType: "JSON",
        success: function(resps) {
            //alert(resps.status)
            if (resps.status == "1") {
                $('#client').append(resps.addoption);
                $("#client").val(resps.custid).change();
                swal("Client information saved successfully!", "Weldone", "success");
            } else if (resps.status == "2") {
                swal('Norakle Respond!', 'Client with same name Exist! You can\'t create same name again');
            } else {
                swal('Norakle Respond!', 'Something went Wrong! Try again');
            }
            $.unblockUI();
            return false;
        }
    });
    return false;
}

function addContact() {
    var clientid = $('#clientid3').val();
    var directline = $('#directline').val();
    var sn = $('#sn').val();
    var lead_source = $('#lead_source').val();
    var designationid = $('#designationid').val();
    var phone2 = $('#phone2').val();
    var email = $('#email').val();
    var folderbs = $('#folderbs').val();
    var urlbase = '../loaddata.php';
    if (folderbs == "1" || folderbs == 1) {
        urlbase = 'loaddata.php';
    }
    $.blockUI({ overlayCSS: { backgroundColor: '#00f' } });
    mypath = 'mode=addContact&clientid=' + clientid + '&directline=' + directline + '&email=' + email + '&designationid=' + designationid + '&sn=' + sn + '&lead_source=' + lead_source + '&phone2=' + phone2;
    $('#addContact').modal('hide');
    $.ajax({
        type: 'POST',
        url: urlbase,
        data: mypath,
        dataType: "JSON",
        success: function(resps) {
            alert(resps)
            if (resps.status == "1") {
                $('#contactid').append(resps.addoption);
                $("#contactid").val(resps.custid).change();
                swal("Contact information saved successfully!", "Weldone", "success");
            } else if (resps.status == "2") {
                swal('Norakle Respond!', 'Contact with same name and phone No Exist! You can\'t create same name again');
            } else {
                swal('Norakle Respond!', 'Something went Wrong! Try again');
            }
            $.unblockUI();
            return false;
        }
    });
    return false;
}

function addMatter() {
    var client = $('#clientid').val();
    var matterdecript = $('#matterdecript').val();
    var wstatus = $('#wstatus').val();
    $.blockUI({ overlayCSS: { backgroundColor: '#00f' } });
    mypath = 'mode=addMatter&client=' + client + '&matterdecript=' + matterdecript + '&wstatus=' + wstatus;
    $('#addMatter').modal('hide');
    $.ajax({
        type: 'POST',
        url: '../loaddata.php',
        data: mypath,
        dataType: "JSON",
        success: function(resps) {
            //alert(resps.status)
            if (resps.status == "1") {
                $('#matterno').append(resps.addoption);
                $("#matterno").val(resps.matterid).change();
                swal("Matter added successfully!", "Weldone", "success");
            } else if (resps.status == "2") {
                swal('Norakle Respond!', 'Client with same name Exist! You can\'t create same name again');
            } else {
                swal('Norakle Respond!', 'Something went Wrong! Try again');
            }
            $.unblockUI();
            return false;
        }
    });
    return false;
}

function selectClient() {
    var cid = $('#client').val();
    $("#clientid").val(cid).change();
}

function disableSelect() {
    var cid = $('#customer_id').val();
    if (cid > 0) {
        $("#clientid2").val(cid).change();
        $("#clientid3").val(cid);
        $('#clientid2').attr("disabled", true);
        $('#addContact').modal('show');
    } else {
        swal("Select the Customer information first", "", "error");
        $('#addContact').modal('hide');
        return false
    }

}

function calcDebitCredit() {
    var total = 0,
        total2 = 0;
    var inps = document.getElementsByName('amount[]');
    for (var i = 0; i < inps.length; i++) {
        var credit = inps[i].value;
        while (credit.search(",") >= 0) {
            credit = (credit + "").replace(',', '');
        }
        if (eval(credit) > 0) {
            total = total + eval(credit);
        }

        var debit = inps[i].value;
        while (debit.search(",") >= 0) {
            debit = (debit + "").replace(',', '');
        }
        if (eval(debit) > 0) {
            total2 = total2 + eval(debit);
        }
    }
    $("#creditTotal").val(total.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
    $("#debitTotal").val(total2.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
}

function creditUp(i) {
    var inps = document.getElementsByName('amount[]');
    $("#debitb" + i).val(inps[i].value);
    calcDebitCredit()
}

function debitUp(i) {
    var inps = document.getElementsByName('debitb[]');
    $("#amount" + i).val(inps[i].value);
    calcDebitCredit()
}

function sumUp(i) {
    if (document.getElementById('items' + i).value != "") {
        var tsum = document.getElementById(i).value;
        var qauntity = document.getElementById('qauntity' + i).value
        var discount = eval(document.getElementById('discount' + i).value)
        var discount_type = document.getElementById('discount_type' + i).value
        var tax = eval($('#taxvalue').val());
        var taxamt = 0,
            dis_amt = 0;
        while (tsum.search(",") >= 0) {
            tsum = (tsum + "").replace(',', '');
        }
        if (qauntity == "" || qauntity == 0 || qauntity < 0) {
            alert("Enter Quantity")
            return false
        }
        if (tsum == "" || tsum == 0 || tsum < 0) {
            //alert("Enter Amount")
            return false
        } else {

            tsum = eval(tsum);
            var price = tsum;
            document.getElementById(i).value = tsum.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            tsum = eval(qauntity) * tsum; ////////////// Total Amount

            /////////////////// Calc Discout
            if (discount > 0) {
                if (discount_type != "11111121") {
                    if (discount > tsum) {
                        alert("The Discount amount cannot be more supplying order");
                        document.getElementById('discount' + i).value = 0;
                        document.getElementById('discount' + i).focus();
                        return false
                    } else {
                        dis_amt = discount;
                    }
                } else {
                    if (discount > 100) {
                        alert("The Discount % cannot be more than 100");
                        document.getElementById('discount' + i).value = 0;
                        document.getElementById('discount' + i).focus();
                        return false
                    } else {
                        dis_amt = tsum * (discount / 100);
                    }
                }
            }
            /////////////////// End Calc Discout

            tsum = tsum - dis_amt; ////////////////// Balance After discount

            /////////////////// Calc Vat
            taxamt = tsum * (tax / 100);
            /////////////////// End Calc Vat

            var str = $('#totalamount').val();
            while (str.search(",") >= 0) {
                str = (str + "").replace(',', '');
            }

            var totalvat = $('#totalvat').val();
            while (totalvat.search(",") >= 0) {
                totalvat = (totalvat + "").replace(',', '');
            }

            var totaldiscount = $('#totaldiscount').val();
            while (totaldiscount.search(",") >= 0) {
                totaldiscount = (totaldiscount + "").replace(',', '');
            }

            var totalexcl = $('#totalexcl').val();
            while (totalexcl.search(",") >= 0) {
                totalexcl = (totalexcl + "").replace(',', '');
            }

            ////////Get and Minus presvious Value
            var subamount = document.getElementById('subamount' + i).value;
            if (subamount == "" || subamount == 0 || subamount < 0) {
                /// No value
            } else {
                while (subamount.search(",") >= 0) {
                    subamount = (subamount + "").replace(',', '');
                }
                str = eval(str) - eval(subamount);
            }

            var vat = document.getElementById('vat' + i).value;
            if (vat == "" || vat == 0 || vat < 0) {
                /// No value
            } else {
                while (vat.search(",") >= 0) {
                    vat = (vat + "").replace(',', '');
                }
                totalvat = eval(totalvat) - eval(vat);
            }

            var disAmt = document.getElementById('disAmt' + i).value;
            if (disAmt == "" || disAmt == 0 || disAmt < 0) {
                /// No value
            } else {
                while (disAmt.search(",") >= 0) {
                    disAmt = (disAmt + "").replace(',', '');
                }
                totaldiscount = eval(totaldiscount) - eval(disAmt);
            }

            var excl = document.getElementById('excl' + i).value;
            if (excl == "" || excl == 0 || excl < 0) {
                /// No value
            } else {
                while (excl.search(",") >= 0) {
                    excl = (excl + "").replace(',', '');
                }
                totalexcl = eval(totalexcl) - eval(excl);
            }
            /////////////////////////////////////// End of minus Previouse Value

            totalvat = eval(totalvat) + eval(taxamt);
            totaldiscount = eval(totaldiscount) + eval(dis_amt);
            totalexcl = eval(totalexcl) + eval(tsum);

            document.getElementById('vat' + i).value = taxamt.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
            document.getElementById('disAmt' + i).value = dis_amt.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
            document.getElementById('excl' + i).value = tsum.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
            tsum = tsum + taxamt;
            var totalamt = eval(tsum) + eval(str);
            document.getElementById('subamount' + i).value = tsum.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")


            //var num = totalamt.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            $('#totalamount').val(totalamt)
            $('#totalvat').val(totalvat)
            $('#totaldiscount').val(totaldiscount)
            $('#totalexcl').val(totalexcl)
            $('#tvat').val(totalvat.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
            $('#tdisc').val(totaldiscount.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
            $('#texcl').val(totalexcl.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
            $('#tamt').val(totalamt.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));

            var retrive = eval($('#retrive').val());
            if(retrive == 1){
                var item = document.getElementById('items' + i).value ;
                var cid = document.getElementById('customer_id').value ;
                var contactid = document.getElementById('contactid').value ;
                $.ajax({
                    type:'POST',
                    url:'../loaddata.php',
                    data:{mode:'registerItem', qnty:qauntity, item:item, price:price, contactid:contactid, cid:cid},
                    success: function(data){
                    //alert(data)
                    }
                })
            }
        }
    }
}

function loadOrder() {
    var count = eval($('#mycounter').val())
    var pid = document.getElementById('pol_id').value;
    $("#returncounter").remove(); // remove recounter to get the new one 
    if (pid != "") {
        $.blockUI({ overlayCSS: { backgroundColor: '#2A3F54' } });
        mypath = 'mode=loadOrder&count=' + count + '&pid=' + pid;
        $.ajax({
            type: 'POST',
            url: 'loaddata.php',
            data: mypath,
            //dataType: "json",
            //cache:false,
            success: function(respons) {
                //alert(respons) 
                $("#expensesListing").append(respons)
                var returncounter = eval($('#returncounter').val())
                count++
                for (i = count; i <= returncounter; i++) {
                    //alert(count + " "+ i)
                    var str = $('#totalamount').val();
                    while (str.search(",") >= 0) {
                        str = (str + "").replace(',', '');
                    }

                    var totalvat = $('#totalvat').val();
                    while (totalvat.search(",") >= 0) {
                        totalvat = (totalvat + "").replace(',', '');
                    }

                    var totaldiscount = $('#totaldiscount').val();
                    while (totaldiscount.search(",") >= 0) {
                        totaldiscount = (totaldiscount + "").replace(',', '');
                    }

                    var totalexcl = $('#totalexcl').val();
                    while (totalexcl.search(",") >= 0) {
                        totalexcl = (totalexcl + "").replace(',', '');
                    }

                    var subamount = document.getElementById('subamount' + i).value;
                    while (subamount.search(",") >= 0) {
                        subamount = (subamount + "").replace(',', '');
                    }

                    var vat = document.getElementById('vat' + i).value;
                    while (vat.search(",") >= 0) {
                        vat = (vat + "").replace(',', '');
                    }

                    var disAmt = document.getElementById('disAmt' + i).value;
                    while (disAmt.search(",") >= 0) {
                        disAmt = (disAmt + "").replace(',', '');
                    }

                    var excl = document.getElementById('excl' + i).value;
                    while (excl.search(",") >= 0) {
                        excl = (excl + "").replace(',', '');
                    }
                    /////////////////////////////////////// End of minus Previouse Value

                    totalvat = eval(totalvat) + eval(vat);
                    totaldiscount = eval(totaldiscount) + eval(disAmt);
                    totalexcl = eval(totalexcl) + eval(excl);
                    totalamt = eval(str) + eval(subamount);


                    //var num = totalamt.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                    $('#totalamount').val(totalamt)
                    $('#totalvat').val(totalvat)
                    $('#totaldiscount').val(totaldiscount)
                    $('#totalexcl').val(totalexcl)
                    $('#tvat').val(totalvat.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
                    $('#tdisc').val(totaldiscount.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
                    $('#texcl').val(totalexcl.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
                    $('#tamt').val(totalamt.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                    $('#mycounter').val(count)
                        ///////////////////////////////////////
                    count++
                }
                $.unblockUI();
                return false;
            }
        });
        return false;
    }
}

function loadCusQuotation() {
    var count = eval($('#mycounter').val())
    $("#returncounter").remove(); // remove recounter to get the new one 
    var quoteid = document.getElementById('quoteid').value;
    if (quoteid != "") {
        $.blockUI({ overlayCSS: { backgroundColor: '#2A3F54' } });
        mypath = 'mode=loadCusQuotation&count=' + count + '&pid=' + quoteid;
        $.ajax({
            type: 'POST',
            url: 'loaddata.php',
            data: mypath,
            //dataType: "json",
            //cache:false,
            success: function(respons) {
                $("#expensesListing").append(respons)
                var returncounter = eval($('#returncounter').val())
                count++
                for (i = count; i <= returncounter; i++) {
                    //alert(count + " "+ i)
                    var str = $('#totalamount').val();
                    while (str.search(",") >= 0) {
                        str = (str + "").replace(',', '');
                    }

                    var totalvat = $('#totalvat').val();
                    while (totalvat.search(",") >= 0) {
                        totalvat = (totalvat + "").replace(',', '');
                    }

                    var totaldiscount = $('#totaldiscount').val();
                    while (totaldiscount.search(",") >= 0) {
                        totaldiscount = (totaldiscount + "").replace(',', '');
                    }

                    var totalexcl = $('#totalexcl').val();
                    while (totalexcl.search(",") >= 0) {
                        totalexcl = (totalexcl + "").replace(',', '');
                    }

                    var subamount = document.getElementById('subamount' + i).value;
                    while (subamount.search(",") >= 0) {
                        subamount = (subamount + "").replace(',', '');
                    }

                    var vat = document.getElementById('vat' + i).value;
                    while (vat.search(",") >= 0) {
                        vat = (vat + "").replace(',', '');
                    }

                    var disAmt = document.getElementById('disAmt' + i).value;
                    while (disAmt.search(",") >= 0) {
                        disAmt = (disAmt + "").replace(',', '');
                    }

                    var excl = document.getElementById('excl' + i).value;
                    while (excl.search(",") >= 0) {
                        excl = (excl + "").replace(',', '');
                    }
                    /////////////////////////////////////// End of minus Previouse Value

                    totalvat = eval(totalvat) + eval(vat);
                    totaldiscount = eval(totaldiscount) + eval(disAmt);
                    totalexcl = eval(totalexcl) + eval(excl);
                    totalamt = eval(str) + eval(subamount);


                    //var num = totalamt.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                    $('#totalamount').val(totalamt)
                    $('#totalvat').val(totalvat)
                    $('#totaldiscount').val(totaldiscount)
                    $('#totalexcl').val(totalexcl)
                    $('#tvat').val(totalvat.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
                    $('#tdisc').val(totaldiscount.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
                    $('#texcl').val(totalexcl.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
                    $('#tamt').val(totalamt.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                    $('#mycounter').val(count)
                        ///////////////////////////////////////
                    count++
                }
                $.unblockUI();
                return false;
            }
        });
        return false;
    }
}

function loadInvoiceOrder() {
    var count = eval($('#mycounter').val())
    var pid = document.getElementById('siv_id').value;
    if (pid != "") {
        mypath = 'mode=loadOrder&count=' + count + '&pid=' + pid;
        $.blockUI({ overlayCSS: { backgroundColor: '#2A3F54' } });
        $.ajax({
            type: 'POST',
            url: 'loaddata.php',
            data: mypath,
            //dataType: "json",
            //cache:false,
            success: function(respons) {
                //alert(respons) 
                $("#expensesListing").append(respons)
                var returncounter = eval($('#returncounter').val())
                count++
                for (i = count; i <= returncounter; i++) {
                    //alert(count + " "+ i)
                    var str = $('#totalamount').val();
                    while (str.search(",") >= 0) {
                        str = (str + "").replace(',', '');
                    }

                    var totalvat = $('#totalvat').val();
                    while (totalvat.search(",") >= 0) {
                        totalvat = (totalvat + "").replace(',', '');
                    }

                    var totaldiscount = $('#totaldiscount').val();
                    while (totaldiscount.search(",") >= 0) {
                        totaldiscount = (totaldiscount + "").replace(',', '');
                    }

                    var totalexcl = $('#totalexcl').val();
                    while (totalexcl.search(",") >= 0) {
                        totalexcl = (totalexcl + "").replace(',', '');
                    }

                    var subamount = document.getElementById('subamount' + i).value;
                    while (subamount.search(",") >= 0) {
                        subamount = (subamount + "").replace(',', '');
                    }

                    var vat = document.getElementById('vat' + i).value;
                    while (vat.search(",") >= 0) {
                        vat = (vat + "").replace(',', '');
                    }

                    var disAmt = document.getElementById('disAmt' + i).value;
                    while (disAmt.search(",") >= 0) {
                        disAmt = (disAmt + "").replace(',', '');
                    }

                    var excl = document.getElementById('excl' + i).value;
                    while (excl.search(",") >= 0) {
                        excl = (excl + "").replace(',', '');
                    }
                    /////////////////////////////////////// End of minus Previouse Value

                    totalvat = eval(totalvat) + eval(vat);
                    totaldiscount = eval(totaldiscount) + eval(disAmt);
                    totalexcl = eval(totalexcl) + eval(excl);
                    totalamt = eval(str) + eval(subamount);


                    //var num = totalamt.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                    $('#totalamount').val(totalamt)
                    $('#totalvat').val(totalvat)
                    $('#totaldiscount').val(totaldiscount)
                    $('#totalexcl').val(totalexcl)
                    $('#tvat').val(totalvat.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
                    $('#tdisc').val(totaldiscount.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
                    $('#texcl').val(totalexcl.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
                    $('#tamt').val(totalamt.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                    $('#mycounter').val(count)
                        ///////////////////////////////////////
                    count++
                }
                $.unblockUI();
                return false;
            }
        });
        return false;
    }
}

function loadCustInvoiceOrder() {
    var count = eval($('#mycounter').val())
    var pid = document.getElementById('civ_id').value;
    if (pid != "") {
        $.blockUI({ overlayCSS: { backgroundColor: '#2A3F54' } });
        $('#totalamount').val(0)
        $('#totalvat').val(0)
        $('#totaldiscount').val(0)
        $('#totalexcl').val(0)
        mypath = 'mode=loadCustInvoice&count=' + count + '&pid=' + pid;
        $.ajax({
            type: 'POST',
            url: 'loaddata.php',
            data: mypath,
            //dataType: "json",
            //cache:false,
            success: function(respons) {
                //alert(respons) 
                $("#expensesListing").html(respons)
                var returncounter = eval($('#returncounter').val())
                count++
                for (i = count; i <= returncounter; i++) {
                    //alert(count + " "+ i)
                    var str = $('#totalamount').val();
                    while (str.search(",") >= 0) {
                        str = (str + "").replace(',', '');
                    }

                    var totalvat = $('#totalvat').val();
                    while (totalvat.search(",") >= 0) {
                        totalvat = (totalvat + "").replace(',', '');
                    }

                    var totaldiscount = $('#totaldiscount').val();
                    while (totaldiscount.search(",") >= 0) {
                        totaldiscount = (totaldiscount + "").replace(',', '');
                    }

                    var totalexcl = $('#totalexcl').val();
                    while (totalexcl.search(",") >= 0) {
                        totalexcl = (totalexcl + "").replace(',', '');
                    }

                    var subamount = document.getElementById('subamount' + i).value;
                    while (subamount.search(",") >= 0) {
                        subamount = (subamount + "").replace(',', '');
                    }

                    var vat = document.getElementById('vat' + i).value;
                    while (vat.search(",") >= 0) {
                        vat = (vat + "").replace(',', '');
                    }

                    var disAmt = document.getElementById('disAmt' + i).value;
                    while (disAmt.search(",") >= 0) {
                        disAmt = (disAmt + "").replace(',', '');
                    }

                    var excl = document.getElementById('excl' + i).value;
                    while (excl.search(",") >= 0) {
                        excl = (excl + "").replace(',', '');
                    }
                    /////////////////////////////////////// End of minus Previouse Value

                    totalvat = eval(totalvat) + eval(vat);
                    totaldiscount = eval(totaldiscount) + eval(disAmt);
                    totalexcl = eval(totalexcl) + eval(excl);
                    totalamt = eval(str) + eval(subamount);


                    //var num = totalamt.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                    $('#totalamount').val(totalamt)
                    $('#totalvat').val(totalvat)
                    $('#totaldiscount').val(totaldiscount)
                    $('#totalexcl').val(totalexcl)
                    $('#tvat').val(totalvat.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
                    $('#tdisc').val(totaldiscount.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
                    $('#texcl').val(totalexcl.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
                    $('#tamt').val(totalamt.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                    $('#mycounter').val(count)
                        ///////////////////////////////////////
                    count++
                }
                $.unblockUI();
                return false;
            }
        });
        return false;
    }
}

function deleteAction2(i) {
    $(".del" + i).remove(); // .fadeOut('slow'); 
}

function deleteAndUpdateItem(i,item_ref,qnty,branchid, l_id, amt, civ_id,whereto) {
    $.ajax({
        type:'POST',
        url:'../loaddata.php',
        data:{del_id:item_ref, mode:'deleteItem', qnty:qnty, branchid:branchid, l_id:l_id, amt:amt, civ_id:civ_id, whereto:whereto},
        success: function(data){
           // alert(data)
        }
    })
    
    var str = $('#totalamount').val();
    while (str.search(",") >= 0) {
        str = (str + "").replace(',', '');
    }

    var totalvat = $('#totalvat').val();
    while (totalvat.search(",") >= 0) {
        totalvat = (totalvat + "").replace(',', '');
    }

    var totaldiscount = $('#totaldiscount').val();
    while (totaldiscount.search(",") >= 0) {
        totaldiscount = (totaldiscount + "").replace(',', '');
    }

    var totalexcl = $('#totalexcl').val();
    while (totalexcl.search(",") >= 0) {
        totalexcl = (totalexcl + "").replace(',', '');
    }

    var subamount = document.getElementById('subamount' + i).value;
    while (subamount.search(",") >= 0) {
        subamount = (subamount + "").replace(',', '');
    }

    var vat = document.getElementById('vat' + i).value;
    while (vat.search(",") >= 0) {
        vat = (vat + "").replace(',', '');
    }

    var disAmt = document.getElementById('disAmt' + i).value;
    while (disAmt.search(",") >= 0) {
        disAmt = (disAmt + "").replace(',', '');
    }

    var excl = document.getElementById('excl' + i).value;
    while (excl.search(",") >= 0) {
        excl = (excl + "").replace(',', '');
    }
    /////////////////////////////////////// End of minus Previouse Value

    totalvat = eval(totalvat) - eval(vat);
    totaldiscount = eval(totaldiscount) - eval(disAmt);
    totalexcl = eval(totalexcl) - eval(excl);
    totalamt = eval(str) - eval(subamount);


    //var num = totalamt.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    $('#totalamount').val(totalamt)
    $('#totalvat').val(totalvat)
    $('#totaldiscount').val(totaldiscount)
    $('#totalexcl').val(totalexcl)
    $('#tvat').val(totalvat.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
    $('#tdisc').val(totaldiscount.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
    $('#texcl').val(totalexcl.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
    $('#tamt').val(totalamt.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
    ///////////////////////////////////////

    $(".del" + i).remove(); // .fadeOut('slow'); 
}

function deleteAction(i) {
    var str = $('#totalamount').val();
    while (str.search(",") >= 0) {
        str = (str + "").replace(',', '');
    }

    var totalvat = $('#totalvat').val();
    while (totalvat.search(",") >= 0) {
        totalvat = (totalvat + "").replace(',', '');
    }

    var totaldiscount = $('#totaldiscount').val();
    while (totaldiscount.search(",") >= 0) {
        totaldiscount = (totaldiscount + "").replace(',', '');
    }

    var totalexcl = $('#totalexcl').val();
    while (totalexcl.search(",") >= 0) {
        totalexcl = (totalexcl + "").replace(',', '');
    }

    var subamount = document.getElementById('subamount' + i).value;
    while (subamount.search(",") >= 0) {
        subamount = (subamount + "").replace(',', '');
    }

    var vat = document.getElementById('vat' + i).value;
    while (vat.search(",") >= 0) {
        vat = (vat + "").replace(',', '');
    }

    var disAmt = document.getElementById('disAmt' + i).value;
    while (disAmt.search(",") >= 0) {
        disAmt = (disAmt + "").replace(',', '');
    }

    var excl = document.getElementById('excl' + i).value;
    while (excl.search(",") >= 0) {
        excl = (excl + "").replace(',', '');
    }
    /////////////////////////////////////// End of minus Previouse Value

    totalvat = eval(totalvat) - eval(vat);
    totaldiscount = eval(totaldiscount) - eval(disAmt);
    totalexcl = eval(totalexcl) - eval(excl);
    totalamt = eval(str) - eval(subamount);


    //var num = totalamt.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    $('#totalamount').val(totalamt)
    $('#totalvat').val(totalvat)
    $('#totaldiscount').val(totaldiscount)
    $('#totalexcl').val(totalexcl)
    $('#tvat').val(totalvat.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
    $('#tdisc').val(totaldiscount.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
    $('#texcl').val(totalexcl.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
    $('#tamt').val(totalamt.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
    ///////////////////////////////////////

    $(".del" + i).remove(); // .fadeOut('slow'); 
}

function deleteAndUpdateSup(i, item_ref , qnty, l_id, amt, sivid) {
    $.ajax({
        type:'POST',
        url:'../loaddata.php',
        data:{del_id:item_ref, mode:'deleteItemSupplied', qnty:qnty,  l_id:l_id, amt:amt, suiv_id:sivid},
        success: function(data){
           // alert(data)
        }
    })
    var str = $('#totalamount').val();
    while (str.search(",") >= 0) {
        str = (str + "").replace(',', '');
    }

    var totalvat = $('#totalvat').val();
    while (totalvat.search(",") >= 0) {
        totalvat = (totalvat + "").replace(',', '');
    }

    var totaldiscount = $('#totaldiscount').val();
    while (totaldiscount.search(",") >= 0) {
        totaldiscount = (totaldiscount + "").replace(',', '');
    }

    var totalexcl = $('#totalexcl').val();
    while (totalexcl.search(",") >= 0) {
        totalexcl = (totalexcl + "").replace(',', '');
    }

    var subamount = document.getElementById('subamount' + i).value;
    while (subamount.search(",") >= 0) {
        subamount = (subamount + "").replace(',', '');
    }

    var vat = document.getElementById('vat' + i).value;
    while (vat.search(",") >= 0) {
        vat = (vat + "").replace(',', '');
    }

    var disAmt = document.getElementById('disAmt' + i).value;
    while (disAmt.search(",") >= 0) {
        disAmt = (disAmt + "").replace(',', '');
    }

    var excl = document.getElementById('excl' + i).value;
    while (excl.search(",") >= 0) {
        excl = (excl + "").replace(',', '');
    }
    /////////////////////////////////////// End of minus Previouse Value

    totalvat = eval(totalvat) - eval(vat);
    totaldiscount = eval(totaldiscount) - eval(disAmt);
    totalexcl = eval(totalexcl) - eval(excl);
    totalamt = eval(str) - eval(subamount);


    //var num = totalamt.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    $('#totalamount').val(totalamt)
    $('#totalvat').val(totalvat)
    $('#totaldiscount').val(totaldiscount)
    $('#totalexcl').val(totalexcl)
    $('#tvat').val(totalvat.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
    $('#tdisc').val(totaldiscount.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
    $('#texcl').val(totalexcl.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
    $('#tamt').val(totalamt.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
    ///////////////////////////////////////

    $(".del" + i).remove(); // .fadeOut('slow'); 
}

function loadItem(i) {
    var item_id = document.getElementById('items' + i).value;
    //document.getElementById('itemnames' + i).value = document.getElementById('items' + i).options[document.getElementById('items' + i).selectedIndex].text;
    mypath = 'mode=getItemDetail&item_id=' + item_id;
    $.ajax({
        type: 'POST',
        url: 'loaddata.php',
        data: mypath,
        dataType: "json",
        //cache:false,
        success: function(respons) {
            document.getElementById(i).value = respons.price;
            document.getElementById('qauntity' + i).value = 1
            document.getElementById('stockcode_' + i).value = respons.stockcode;
            $('#taxvalue').val($('#taxvalue2').val())
            sumUp(i)
            return false;
        }
    });
    return false;
}

function loadItem2(i) {
    var item_id = document.getElementById('items' + i).value;
    //document.getElementById('itemnames' + i).value = document.getElementById('items' + i).options[document.getElementById('items' + i).selectedIndex].text;
    mypath = 'mode=getItemDetail&item_id=' + item_id;
    $.ajax({
        type: 'POST',
        url: 'loaddata.php',
        data: mypath,
        dataType: "json",
        //cache:false,
        success: function(respons) {
            //if (respons.branchQty == 0) {
             //   swal('Norakle Respond!', 'Item Out of Stock! You cannot raise seles invoce for this item');
           // } else {
               if(eval(respons.saleprice > 0)){
                   document.getElementById(i).value = respons.saleprice;
               }
               document.getElementById('qauntity' + i).value = 1
               document.getElementById('stockcode_' + i).value = respons.stockcode;
               $('#taxvalue').val($('#taxvalue2').val())
                sumUp(i)
           // }
            return false;
        }
    });
    return false;
}

function loadItem3(i) {
    var item_id = document.getElementById('items' + i).value;
    //document.getElementById('itemnames' + i).value = document.getElementById('items' + i).options[document.getElementById('items' + i).selectedIndex].text;
    mypath = 'mode=getItemDetail&item_id=' + item_id;
    $.ajax({
        type: 'POST',
        url: 'loaddata.php',
        data: mypath,
        dataType: "json",
        //cache:false,
        success: function(respons) {
            document.getElementById('qauntity' + i).value = 1
                //document.getElementById('descript' + i).value = respons.descript;
            document.getElementById('stockcode_' + i).value = respons.stockcode;
            return false;
        }
    });
    return false;
}



function loadItem4(i) {
    var item_id = document.getElementById('items' + i).value;
    var branch = document.getElementById('branch').value;
    //document.getElementById('itemnames' + i).value = document.getElementById('items' + i).options[document.getElementById('items' + i).selectedIndex].text;
    mypath = 'mode=getItemDetail&item_id=' + item_id + "&branch=" + branch;
    $.ajax({
        type: 'POST',
        url: 'loaddata.php',
        data: mypath,
        dataType: "json",
        //cache:false,
        success: function(respons) {
            //alert(respons.specno)
            document.getElementById('qauntity' + i).value = 1
            document.getElementById('spec' + i).value = respons.specno;
            document.getElementById('stockcode_' + i).value = respons.stockcode;
            //document.getElementById('ct' + i).value = eval(respons.price).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            document.getElementById('sale' + i).value = eval(respons.price).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            document.getElementById('bqua' + i).value = respons.branchQty;
            return false;
        }
    });
    return false;
}

function loadItem5(i) {

    var item_id = document.getElementById('items' + i).value;
    mypath = 'mode=getItemDetail&item_id=' + item_id;
    $.ajax({
        type: 'POST',
        url: 'loaddata.php',
        data: mypath,
        dataType: "json",
        //cache:false,
        success: function(respons) {
            document.getElementById('qauntity' + i).value = 1
            document.getElementById('spec' + i).value = respons.specno;
            document.getElementById('stockcode_' + i).value = respons.stockcode;
            document.getElementById('price' + i).value = eval(respons.saleprice).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            // document.getElementById('sale' + i).value = eval(respons.saleprice).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            return false;
        }
    });
    return false;
}

function getCustSupp(i, ttype) {
    var acc_id = 0;
    if (ttype == 1) { acc_id = document.getElementById('bank' + i).value; }
    if (ttype == 2) { acc_id = document.getElementById('bankb' + i).value; }
    mypath = 'mode=loadCustSupp&acc_id=' + acc_id+"&indes="+i+"&ttype="+ttype;
    $.ajax({
        type: 'POST',
        url: 'loaddata.php',
        data: mypath,
        //dataType: "json",
        //cache:false,
        success: function(respons) {
            if (ttype == 1) { $('#cus_sup' + i).html(respons); }
            if (ttype == 2) { $('#cus_supb' + i).html(respons); }
            return false;
        }
    });
    return false;
}

function loadInvoice() {
    var sup_id = $('#supplier').val();
    mypath = 'mode=loadInvoice&sup_id=' + sup_id;
    $.ajax({
        type: 'POST',
        url: 'loaddata.php',
        data: mypath,
        //dataType: "json",
        //cache:false,
        success: function(respons) {
            //alert(respons)
            $('#invoicelist').html(respons);
            $.unblockUI();
            return false;
        }
    });
    return false;
}

function loadCustInvoice2() {
    var cus_id = $('#customer_id').val();
    mypath = 'mode=loadcustInvoice2&cus_id=' + cus_id;
    $.ajax({
        type: 'POST',
        url: 'loaddata.php',
        data: mypath,
        //dataType: "json",
        //cache:false,
        success: function(respons) {
            //alert(respons)
            $('#invoicelist').html(respons);
            $.unblockUI();
            return false;
        }
    });
    return false;
}

function loadEngineeringInvioce() {
    var cus_id = $('#customer_id').val();
    mypath = 'mode=loadEngineeringInvoice&cus_id=' + cus_id;
    $.ajax({
        type: 'POST',
        url: 'loaddata.php',
        data: mypath,
        //dataType: "json",
        //cache:false,
        success: function(respons) {
            //alert(respons)
            $('#invoicelist').html(respons);
            $.unblockUI();
            return false;
        }
    });
    return false;
}


function loadpurchaseOrder() {
    var sup_id = $('#supplier').val();
    mypath = 'mode=loadPurOrder&sup_id=' + sup_id;
    $.ajax({
        type: 'POST',
        url: 'loaddata.php',
        data: mypath,
        //dataType: "json",
        //cache:false,
        success: function(respons) {
            $('#pol_id').empty()
            $('#pol_id').html(respons);
            $.unblockUI();
            return false;
        }
    });
    return false;
}

function loadpurchaseInvioce() {
    var sup_id = $('#supplier').val();
    mypath = 'mode=loadPuInvoice&sup_id=' + sup_id;
    $.ajax({
        type: 'POST',
        url: 'loaddata.php',
        data: mypath,
        //dataType: "json",
        //cache:false,
        success: function(respons) {
            $('#siv_id').empty()
            $('#siv_id').html(respons);
            $.unblockUI();
            return false;
        }
    });
    return false;
}

function getSupplierInfo(frm) {
    var sup_id = $('#supplier').val();
    mypath = 'mode=getSupplierInfo&sup_id=' + sup_id;
    $.blockUI({ overlayCSS: { backgroundColor: '#2A3F54' } });
    $.ajax({
        type: 'POST',
        url: '../loaddata.php',
        data: mypath,
        dataType: "json",
        //cache:false,
        success: function(respons) {
            $('#bal').val(respons.bal);
            $('#credit').val(respons.credit);
            $('#vatno').val(respons.vat);
            $('#saddress').val(respons.address);
            $('#phoneno').val(respons.phone);
            if (frm == 1) {
                loadInvoice()
            }
            if (frm == 2) {
                loadpurchaseOrder()
            }
            if (frm == 3) {
                loadpurchaseInvioce()
            } else {
                $.unblockUI();
            }
            return false;
        }
    });
    return false;
}

function loadQuotation() {
    var cus_id = $('#customer_id').val();
    mypath = 'mode=loadQuotation&cus_id=' + cus_id;
    $.ajax({
        type: 'POST',
        url: '../loaddata.php',
        data: mypath,
        //dataType: "json",
        //cache:false,
        success: function(respons) {
            $('#quoteid').empty()
            $('#quoteid').html(respons);
            $.unblockUI();
            return false;
        }
    });
    return false;
}

function loadCustomerInvioce() {
    var client = $('#customer_id').val();
    mypath = 'mode=loadCustomerInvioce&cus_id=' + client;
    $.ajax({
        type: 'POST',
        url: 'loaddata.php',
        data: mypath,
        //dataType: "json",
        //cache:false,
        success: function(respons) {
            alert(respons)
            $('#civ_id').empty()
            $('#civ_id').html(respons);
            $.unblockUI();
            return false;
        }
    });
    return false;
}

function getCustomerInfo(frm) {
    var cus_id = $('#customer_id').val();
    mypath = 'mode=getCustomerInfo&cus_id=' + cus_id;
    $.blockUI({ overlayCSS: { backgroundColor: '#fff' } });
    $.ajax({
        type: 'POST',
        url: '../loaddata.php',
        data: mypath,
        dataType: "json",
        //cache:false,
        success: function(respons) {
            // alert(respons)
            $('#bal').val(respons.bal);
            $('#credit').val(respons.credit);
            $('#vatno').val(respons.vat);
            $('#saddress').val(respons.address);
            $('#phoneno').val(respons.phone);
            $('#contactid').html(respons.rep);
            if (frm == 1) {
                loadCustInvoice2()
            }
            if (frm == 2) {
                loadQuotation()
            }
            if (frm == 3) {
                loadCustomerInvioce()
            } 
            if (frm == 4) {
                loadEngineeringInvioce()
            }
            else {
                $.unblockUI();
            }

            return false;
        }
    });
    return false;
}

function getVat(i) {
    var myString = document.getElementById('vatype' + i).options[document.getElementById('vatype' + i).selectedIndex].text;
    var result = myString.match(/\((.*)\)/);

    $('#taxvalue').val(result[1])
    sumUp(i)
}

function checkInput() {
    if ($('#supplier').val() == "") {
        alert("Please select supplier")
        return false
    }

    var itemno = 0;
    var inps = document.getElementsByName('items[]');
    for (var i = 0; i < inps.length; i++) {
        var itemval = inps[i].value;
        if (itemval > 0) {
            itemno = 1;
        }
    }
    if (itemno == 0) {
        alert("Please select at least one item")
        return false
    } else {
        return true
    }
}

function checkInput2() {
    if ($('#supplier').val() == "") {
        alert("Please select supplier")
        return false
    }

    if ($('#pol_id').val() == "") {
        alert("Please select Purchase Order")
        return false
    }

    var itemno = 0;
    var inps = document.getElementsByName('items[]');
    for (var i = 0; i < inps.length; i++) {
        var itemval = inps[i].value;
        if (itemval > 0) {
            itemno = 1;
        }
    }
    if (itemno == 0) {
        alert("Please select at least one item")
        return false
    } else {
        return true
    }
}

function delete_purchase_order(page, link, link2) {
    mypath = 'link=' + link + '&page=' + page;
    swal({
        title: "Deleting Record!",
        text: "Are you sure you want to delete this record?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Delete!",
        closeOnConfirm: false
    }, function() {
        $.blockUI({ overlayCSS: { backgroundColor: '#00f' } });
        $.ajax({
            type: 'POST',
            url: '../delete_files.php',
            data: mypath,
            //dataType: "json",
            success: function(respons) {
                if (respons == 1) {
                    swal("Record Deleted successfully!", "Weldone", "success");
                    location.href = link2;
                    return false;
                    $.unblockUI();
                } else {
                    swal("Something went wrong! Try again.", "", "error");
                }
                $.unblockUI();
            }
        });
    });
    return false;
}

function loadHistory(page, link) {
    $.blockUI({ overlayCSS: { backgroundColor: '#fff' } });
    mypath = 'mode=viewHistory' + '&page=' + page + '&code=' + link;
    $.ajax({
        type: 'POST',
        url: 'loaddata.php',
        data: mypath,
        cache: false,
        success: function(resps) {
            $('#getHistory').empty();
            $('#getHistory').html(resps);
            $.unblockUI();
            $('#historyModal').modal('show');
            return false;
        }
    });

    return false;
}

function createInvoice(page) {
    swal({
        title: "",
        text: "You are creating a Goods Received Note from this Stock Order Form. The Stock Order Form Status will be changed to Received.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Create!",
        closeOnConfirm: false
    }, function() {
        location.href = 'supplierInvoiceProcess?pg=1&page=' + page;
    });
    return false;
}

function createCustomerInvoice(page) {
    swal({
        title: "",
        text: "You are creating a Customer Invoice from this Proforma Invoice. The Proforma Invoice Status will be changed to Invoiced.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Create!",
        closeOnConfirm: false
    }, function() {
        location.href = 'customerInvoiceProcess?pg=1&page=' + page;
    });
    return false;
}

function addPayment(j) {
    var returncounter = $('input[name="paid[]"]').length;
    var toatamount = 0;
    var totaldiscount = 0;

    for (i = 1; i <= returncounter; i++) {
        var paid = document.getElementById('paid' + i).value;
        var discount = document.getElementById('discount' + i).value;

        while (paid.search(",") >= 0) {
            paid = (paid + "").replace(',', '');
        }
        if (paid == "") { paid = 0 }

        while (discount.search(",") >= 0) {
            discount = (discount + "").replace(',', '');
        }
        if (discount == "") { discount = 0 }

        toatamount = toatamount + eval(paid)
        totaldiscount = totaldiscount + eval(discount)
    }
    var totalvat = totaldiscount + toatamount
    $('#amountid').val(totalvat.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
    return false
}

function SelectFirst(SelVal) {
    var arrSelVal = SelVal.split(",")
    if (arrSelVal.length > 1) {
        Valuetoselect = arrSelVal[0];
        document.getElementById("select1").value = Valuetoselect;
    }
}

function getStaffInfo() {
    var staff_id = $('#staff_id').val();
    if (staff_id > 0) {
        mypath = 'mode=getStaffInfo&staff_id=' + staff_id;
        $.blockUI({ overlayCSS: { backgroundColor: '#fff' } });
        $.ajax({
            type: 'POST',
            url: '../loaddata.php',
            data: mypath,
            dataType: "json",
            //cache:false,
            success: function(respons) {
                $('#oname').val(respons.oname);
                $('#sname').val(respons.sname);
                $('#phone').val(respons.phone);
                $('#email').val(respons.email);
                $('#username').val(respons.username);
                $.unblockUI();
                return false;
            }
        });
    }
    return false;
}

function loadRequest() {
    if ($('#branch').val() == $('#branchfrm').val()) {
        swal("Something went wrong! You can't transfer to the same branch.", "", "error");
        return false
    } else {
        location.href = 'goods-transfer?pg=6&page='+$('#pageid').val() + '&bid=' + $('#branch').val() + '&bid2=' + $('#branchfrm').val()
    }
}

function checkbalance() {
    var credit = $('#creditTotal').val()
    var debit = $('#debitTotal').val()
    while (credit.search(",") >= 0) {
        credit = (credit + "").replace(',', '');
    }
    while (debit.search(",") >= 0) {
        debit = (debit + "").replace(',', '');
    }
    credit = eval(credit)
    debit = eval(debit)
    if (credit > 0) {
        if (credit != debit) {
            swal("Wrong entry! the credit and debit must be equal on each related entry.", "", "error");
            return false
        } else {
            return true
        }
    } else {
        swal("Something went wrong! You have not make any entry.", "", "error");
        return false
    }

}

function topUp() {
    var returncounter = $('input[name="amount[]"]').length;
    var percent = eval($('#topup').val());
    var toatamount = 0;
    var totaldiscount = 0;
    var i = 0;
    for (i = 1; i <= returncounter; i++) {
        var price = document.getElementById(i).value;
        while (price.search(",") >= 0) {
            price = (price + "").replace(',', '');
        }
        var per = eval(price) * (percent / 100);
        var newPrice = eval(price) + eval(per);
        document.getElementById(i).value = newPrice;
        sumUp(i)
    }

    return false
}

function deleteRecon(page) {
    $(".del" + page).remove(); // .fadeOut('slow'); 
    $.ajax({
        type:'POST',
        url:'loaddata.php',
        data:{mode:'bank_recon', page:page},
        success: function(data){
            //alert(data)
        }
    })
}

function confirmSPR(i, page){
    swal({
        title: "Confirm Response!",
        text: "Are you sure this request have been 100% attended to?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Confirm!",
        closeOnConfirm: false
    }, function() {
        $.ajax({
            type: 'POST',
            url: '../loaddata.php',
            data:{mode:'confirmSPR', page:page},
            //dataType: "json",
            success: function(respons) {
                alert(respons)
                if (respons == 1) {
                    $(".del" + i).remove(); // .fadeOut('slow'); 
                    swal("Record Updated successfully!", "Weldone", "success");
                    return false;
                } else {
                    swal("Something went wrong! Try again.", "", "error");
                }
            }
        });
    })
}

/*function add_toDo(){
    var todolist =  $("#todolist").val()
    $(".to_do").append("<li><p><input type='checkbox' class='flat'>"+todolist+"</p></li>")
    event.preventDefault()
}*/

$("#addme").on("click",function(){
    var todolist =  $("#todolist").val()
    $(".to_do").append("<li><p><input type='checkbox' class='flat'>"+todolist+"</p></li>")
});

function login_school() {
    var schoolid = $('#school_id').val();
    $.blockUI({ overlayCSS: { backgroundColor: '#00f' } });
    mypath = 'action=log_in&schoolid=' + schoolid;
    if($id("school_id").value ==""){
        swal("Please Enter your School ID to continue")
        $.unblockUI();
        return false;
    }
    else{
        $.ajax({
            type: 'POST',
            url: 'myschool/logger.php',
            data: mypath,
            dataType: "JSON",
            success: function(resps) {
                if (resps == "1") {
                    swal({
                        title: "School ID Found!",
                        text: "Wait, We are now directing you to login page",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    location.href = "myschool/backend/website_builder";
                } else if (resps == "2") {
                    swal('V-School Manager!', 'Invalid School ID, Register your school or contact your School Administor if you have registered',"error");
                } else {
                    swal('V-School Manager!', 'Something went Wrong! Try again',"error");
                }
                $.unblockUI();
                return false;
            }
        });
    }
}


function laodstudents(){
    if(document.frmReg.class.value == "") {
        alert ("Please select Class")
        document.frmReg.class.focus();
        return false
    }
    else if(document.frmReg.cgroup.value == "") {
        alert ("Please select Group")
        document.frmReg.cgroup.focus();
        return false
    }
    else if(document.frmReg.subject.value == "") {
        alert ("Please Select subject")
        document.frmReg.subject.focus();
        return false
    }
    else if(document.frmReg.term.value == "") {
        alert ("Please Select Term")
        document.frmReg.term.focus();
        return false
    }
    else{
        var formval = $("#frmReg").serialize()
        $.ajax({
            url: getURL()+"/package.result/students_for_score.php",
            type: "POST",
            data:  formval,
            cache:false,
            beforeSend: function(){$("#overlay").show();},
            success: function(data){
               

                $("#contentd").html(data);
                $("#overlay").hide();
            },
            error: function() 
            {} 	        
        });
    }
}

$('#frmReg').submit(function(e){
    e.preventDefault()
    var pageUrl;
    var formAction = $('input[name=formaction]').val();
    if(formAction == "create-new"){
        pageUrl = pageDetails.addnew;
    }else if(formAction == "edit-record"){
        pageUrl = pageDetails.editrecord;
    }else if(formAction == "activate"){
        pageUrl = pageDetails.activate;
    }else{ 
        return false;
    }
    //   var fm = document.getElementById('form');
        var formdata = new FormData(this);
        $.ajax({
        url: pageUrl,
        type : "post",
        dataType: "json",
        data:formdata,
        cache:false,
        contentType: false,
        processData: false,
        success : function(data){
            if(data.valid == 0){
                swal({
                    title: "Error!",
                    text: data.message,
                    icon: "error", 
                });
            }else if(data.valid == 1){
                swal({
                    title: "Successful",
                    text: data.message,
                    icon: "success", 
                });
                // windows.load
                if(data.link){
                    setTimeout(function(){
                    location.href = data.link;
                    },1500);
                }else{
                    document.getElementById('frmReg').reset()
                }
            }
        }
    })
})

function finalScores2(){
    $("#rstatus").val(1);
    $('#frmReg').submit();
}

function getresult(url) {
    var formval = $("#searchform").serialize()
    $.ajax({
        url: url,
        type: "POST",
        data:  formval,
        cache:false,
        beforeSend: function(){$("#overlay").show();},
        success: function(data){
            $("#contentd").html(data);
            $("#overlay").hide();
            //loadDate();
        },
        error: function() 
        {} 	        
   });
}
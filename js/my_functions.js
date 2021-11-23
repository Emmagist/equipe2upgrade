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
        }
    }
}

function addExpenses() {
    var count = eval($('#mycounter').val())
    count += 1;
    $('#mycounter').val(count)
    $("#expensesListing").append('<tr class="del' + count + '"> <td style="margin:0px; padding:0px"> <select name="items[]" id="items' + count + '" class="select2_group form-control input-sm" tabindex="-1" onchange="return loadItem(' + count + ')"><option value="">--Select Item</option><?php $select_content2=("select * from items");$content_result2= mysqli_query($db, $select_content2) or die (mysqli_error($db)); $content2 = mysqli_fetch_assoc($content_result2); do { 	?><option value="<?php echo  $content2['
        iid ']?>"> <?php echo $content2['
        item '] ?></option><?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?></select> <input type="hidden" name="itemnames[]" id="itemnames' + count + '" /> </td> <td style="margin:0px; padding:0px">  <input type="text" class="form-control  input-sm" name="expnote[]" id="expnote' + count + '" /> </td> <td style="margin:0px; padding:0px">   <input type="text" class="form-control number  input-sm"  name="qauntity[]" value="1"  id="qauntity' + count + '" onchange="return sumUp(' + count + ')" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" /> </td> <td style="margin:0px; padding:0px">   <input type="text" class="form-control  input-sm" name="amount[]" id="' + count + '" onchange="return sumUp(' + count + ')" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" /> </td> <td style="margin:0px; padding:0px"><select name="vatype[]" id="vatype' + count + '" class="form-control  input-sm" onchange="return sumUp(' + count + ')"> <?php $select_content2=("select * from taxtype"); $content_result2= mysqli_query($db, $select_content2) or die (mysqli_error($db)); $content2 = mysqli_fetch_assoc($content_result2); do { 	?><option value="<?php echo  $content2['
        tyid ']?>"> <?php echo $content2['
        tax '] ?></option><?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?></select> </td> <td style="margin:0px; padding:0px"> <div class="form-group row"> <div class="col-sm-12"><div class="input-group input-group-sm"><input type="text" class="form-control  input-sm" onchange="return sumUp(' + count + ')" name="discount[]" id="discount' + count + '"><span class="input-group-addon"><select name="discount_type[]" onchange="return sumUp(' + count + ')" id="discount_type' + count + '"><option value="11111121">%</option> <option value="<?php echo $currencyid ?>" ><?php echo $currency ?></option> </select></span></div></div></div></td>  <td style="margin:0px; padding:0px"> <input type="text" class="form-control  input-sm" style="margin:0px; padding:0px" name="excl[]" value="0.00"  id="excl' + count + '" readonly /></td> <td style="margin:0px; padding:0px">  <input type="text" class="form-control input-sm"  name="disAmt[]" value="0.00"  id="disAmt' + count + '" readonly /> </td> <td style="margin:0px; padding:0px">  <input type="text" class="form-control input-sm"  name="vat[]" value="0.00"  id="vat' + count + '" readonly /> </td> <td style="margin:0px; padding:0px"><input type="text" class="form-control input-sm" name="subtotal[]" value="0.00" id="subamount' + count + '" readonly/> </td> <td style="margin:0px; padding:0px"><a class="btn btn-danger" onClick="return deleteAction(' + count + ')"><i class="fa fa-trash"></i></a> </td> </tr>')
}

function loadOrder() {
    var count = eval($('#mycounter').val())
    var pid = document.getElementById('pol_id').value;
    if (pid != "") {
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
                    alert(count + " " + i)
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
                    ///////////////////////////////////////
                    count++
                }
                return false;
            }
        });
        return false;
    }
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

function loadItem(i) {
    var item_id = document.getElementById('items' + i).value;
    document.getElementById('itemnames' + i).value = document.getElementById('items' + i).options[document.getElementById('items' + i).selectedIndex].text;
    mypath = 'mode=getItemDetail&item_id=' + item_id;
    $.ajax({
        type: 'POST',
        url: 'loaddata.php',
        data: mypath,
        dataType: "json",
        //cache:false,
        success: function(respons) {
            document.getElementById(i).value = respons.saleprice;
            document.getElementById('qauntity' + i).value = 1
            document.getElementById('expnote' + i).value = respons.descript;
            $('#taxvalue').val($('#taxvalue2').val())
            sumUp(i)
            return false;
        }
    });
    return false;
}

function getSupplierInfo() {
    var sup_id = $('#supplier').val();
    mypath = 'mode=getSupplierInfo&sup_id=' + sup_id;
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
            sumUp(i)
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
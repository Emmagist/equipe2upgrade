function payWithMonnify(amt,type) {
    $("#amount").val(amt)
    MonnifySDK.initialize({
        amount: amt,
        currency: "NGN",
        reference: '' + Math.floor((Math.random() * 1000000000) + 1),
        customerFullName: $("#name").val(),
        customerEmail: $("#email").val(),
        customerMobileNumber: $("#phone").val(),
        apiKey: "MK_PROD_X7EWG28HQL",
        contractCode: "929117286836",
        paymentDescription: $("#description").val(),
        isTestMode: true,
        onComplete: function(response){
            //Implement what happens when transaction is completed.
            //console.log(response);
            $("#wait").css("display", "block"); // Show loader
            var txref = response.transactionReference;
            var mypath = $("#payment-form").serialize()+"&ref="+txref+"&type="+type;
            $.ajax({
                type:'POST',
                url:'../../admin90/client_payment.php',
                data:mypath,
                dataType: "json",
                cache:false,
                success:function(resps){
                    $("#wait").css("display", "none"); // Hide loader
                    if(resps == 1){
                        alert("Payment processed Sucessful!\nPayment Ref Number: "+txref);
                        location.href='dashboard';
                    }
                    else{
                        alert(resps)
                    }
                }
            })
        },
        onClose: function(data){
            //Implement what should happen when the modal is closed here
            console.log(data);
            $("#wait").css("display", "none"); // Hide loader
        }
    });
}

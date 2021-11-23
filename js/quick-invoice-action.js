function checkItemSeletecdPos(stage) {
    var itemno = 0;
    var inps = document.getElementsByName('items[]');
    for (var i = 0; i < inps.length; i++) {
        var itemval = inps[i].value;
        if (itemval != "") {
            itemno = 1;
        }
    }
    if (itemno == 0) {
        swal("Please select at least one item", "", "error");
        $("#btn-submit").attr("disabled",false);
        return false
    } else {
        $('input[name=formaction]').val(stage);
        return true
    }
}

$('form').submit(function(event) {
    event.preventDefault();
    $.blockUI({ overlayCSS: { backgroundColor: '#fff' } });
    var form_data=JSON.stringify($('#page-form').serializeObject());
    var formAction = $('input[name=formaction]').val();
    var redirect ="";
    if(formAction == "create-new"){
        pageUrl = pageDetails.submitUrl;
    }else if(formAction == "update"){
        pageUrl = pageDetails.updateUrl;
        redirect = pageDetails.InvoicepageUrl
    }else if(formAction == "updateQuote"){
        pageUrl = pageDetails.updateQuoteUrl;
        redirect = pageDetails.pageUrl
    }
    else if(formAction == "saveonly"){
        pageUrl = pageDetails.saveOnlyUrl;
        redirect = pageDetails.pageUrl
    }
    else if(formAction == "putonhold"){
        pageUrl = pageDetails.putOnHoldUrl;
        redirect = pageDetails.InvoicepageUrl
    }
    else if(formAction == "new-request"){
        pageUrl = pageDetails.saveRequestUrl;
    }
    else if(formAction == "update-request"){
        pageUrl = pageDetails.updateRequestUrl;
    }
    else if(formAction == "new-activity"){
        pageUrl = pageDetails.saveActivityUrl;
    }
    else if(formAction == "edit-activity"){
        pageUrl = pageDetails.updateActivityUrl;
    }
    else{ 
        return false;
    }
    //////////////////////// Process Database information
    alert(pageDetails.siteUrl +redirect)
    $.ajax({
        url: pageDetails.siteUrl + pageUrl,
        type : "POST",
        contentType : 'application/json',
        data : form_data,
        processData:false,  
        success : function(result) {
            //var result = JSON.parse(result);
            if(result.valid == 0){
                swal(result.message, "", "error");
            }
            else if(result.valid ==1){
                swal(result.message, "", "success");
                loadPageRequest(redirect);
            }
            else if(result.valid ==2){
                swal(result.message, result.detail, "error");
            }
            else{
                $("#contentd").html(result); 
                setInterval(function() {$("#overlay").hide(); },500);  
                initiateBootstrapPlugins(); // Initiate Bootstrap plugin    
            }
            $("#btn-submit").attr("disabled",false);
            $.unblockUI();
        },
        error: function(xhr, resp, text) {
            // show error to console
            console.log(xhr, resp, text);
            $.unblockUI();
        }
    });
    //////////////////////// End of Process Database information
    return false;
});

function updateRecStatus(url){
    $.ajax({
        url: pageDetails.siteUrl + url,
        type : "POST",
        contentType : 'application/json',
        processData:false,  
        success : function(result) {
            var result = JSON.parse(result);
            if(result.valid == 0){
                swal(result.message, "", "error");
            }
            else if(result.valid ==1){
                swal(result.message, "", "success");
                loadPageRequest(pageDetails.pageUrl);
            }
            $.unblockUI();
        },
        error: function(xhr, resp, text) {
            // show error to console
            console.log(xhr, resp, text);
            $.unblockUI();
        }
    });
}

function getQuickResult(url) {
    var formval = $("#page-form").serialize()
	$.ajax({
		url: url,
		type: "POST",
        data:  formval,
        cache:false,
		beforeSend: function(){$("#overlay").show();},
		success: function(data){
			$("#contentd").html(data);
            $("#overlay").hide();
            loadDate();
		},
		error: function() 
		{} 	        
   });
}
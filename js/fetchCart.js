$("#catform").submit(function (e) {
    e.preventDefault()
    // var th = $(this).val();
    // alert(th);
    // var formAction = $('input[name=Category]').val(); //alert(formAction);
    
    pageUrl = pageDetails.addcat;

    // alert(pageUrl)
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
            if(data){
                $('#categoryAdd').modal('hide');
                swal({
                    title: "Successful...",
                    text: data.message,
                    icon: "success", 
                });
                location.reload();
            }else{
                swal({
                    title: "Error...",
                    text: data.message,
                    icon: "error", 
                });
            }
        }
    })
})


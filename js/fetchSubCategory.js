// Sub Cat
$("#subCatForm").submit(function (e) {
    // alert("Yes");
    e.preventDefault()
    pageUrl = pageDetails.addSubCat;

    // alert(pageUrl)
        var formdata = new FormData(this);
        $.ajax({
        url: pageUrl,
        type : "post",
        dataType: "json",
        data:formdata,
        // cache:false,
        contentType: false,
        processData: false,
        success : function(data){
            // alert(data);
            // location.reload();
            if(data){
                $('#subCatModal').modal('hide');
                swal({
                    title: "Successful...",
                    text: data.message,
                    icon: "success", 
            
                })
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


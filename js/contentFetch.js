$('#subform').submit(function(e){
    // alert("YES");
    e.preventDefault()
    // var formAction = $('input[name=formaction]').val();
    pageUrl = pageDetails.addnew;
    // if(formAction == "create-new"){
        
    //     $(".bs-example-modal-sm").modal("hide")
    // }
    // else if(formAction == "edit-record"){
    //     pageUrl = pageDetails.editrecord;
    // }else{ 
    //     return false;
    // }
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
                document.getElementById('subform').reset()
            }
            
            }
        }
    })
});

// saveChangesForm
// $('#saveChangesForm').submit(function (e) {
//     alert("YES");
//     e.preventDefault();
//     pageUrl = pageDetails.addnew;
// })
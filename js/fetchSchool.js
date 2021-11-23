$('#secondDisplay').hide();

$('#selectCategory').change(function () {
    var selectCategory = $('#selectCategory').val();
    // alert(selectCategory);
    $.ajax({
        type: "POST",
        url: "proccess.php",
        data: "dataInput=" + selectCategory,
        success: function (data) {
            $('#optionValue').html(data);
            $('#secondDisplay').show();
            $('#selectCategory').addClass('disabled ');
        }
    });
});

// School
$("#scholForm").submit(function (e) {
    e.preventDefault()
    // alert("yes");
    pageUrl = pageDetails.addSchool;

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
        success : function(resp){
            if(resp){
                $('#modalHide').modal('toggle');
                swal({
                    title: "Successful...",
                    text: resp.message,
                    icon: "success", 
                });
                location.reload();
            }else{
                swal({
                    title: "Error!",
                    text: resp.message,
                    icon: "error", 
                });
            }
        }
    })
})


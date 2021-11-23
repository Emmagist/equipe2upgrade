// $('#select_subcategory').hide();
// $('#select_school').hide();
// $('#courseInput').hide();
// $('#priceInput').hide();
// $('#uploadFile').hide();

// $('#selectCourseCategoryId').click(function () {
//     alert("yes working");
//     var category = $('#selectCourseCategoryId').val();
//     // alert(category);
//     $.ajax({
//         type: "POST",
//         url: "proccess.php",
//         data: "dataInputCat=" + category,
//         success: function (data) {
//             $('#subCatOption').html(data);
//             $('#select_subcategory').show();
//             $('#selectCategoryId').addClass('disabled ');
//         }
//     });
// });

// $('#subCatOption').change(function () {
//     // alert("Yes");
//     var subCat = $('#subCatOption').val();
//     // alert("subCat");
//     $.ajax({
//         type: "POST",
//         url: "proccess.php",
//         data: "dataInputSubCat=" + subCat,
//         success: function (data) {
//             $('#schoolOption').html(data);
//             $('#select_school').show();
//             $('#courseInput').show();
//             $('#priceInput').show();
//             $('#uploadFile').show();
//             $('#subCatOption').addClass('disabled ');
//             $('#courseButtonDisabled').removeAttr('disabled');
//         }
//     });
// });


// Course ajax
$("#submitFormCourse").submit(function (e) {
    e.preventDefault()
    // alert("yes");
    pageUrl = pageDetails.addCourse;

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
        success : function(){
            $('#modalHide').modal('toggle');
            // location.reload();
            // if(data.valid == 0){
            // swal({
            //     title: "Error!",
            //     text: data.message,
            //     icon: "error", 
            // });
            
            // }else if(data.valid == 1){
            //     swal({
            //         title: "Successful",
            //         text: data.message,
            //         icon: "success", 
            //     });
            //     location.reload();
            //     windows.load;
            //     if(data.link){
            //         setTimeout(function(){
            //          location.href = data.link;
            //         },1500);
            //     }else{
            //         document.getElementById('catform').reset()
            //     }
            
            // }
            return false
        }
    })
})

// // Course ajax
// $("#submitFormCourse").submit(function (e) {
//     e.preventDefault()
//     // alert("yes");
//     pageUrl = pageDetails.addCourse;

//     // alert(pageUrl)
//         var formdata = new FormData(this);
//         $.ajax({
//         url: pageUrl,
//         type : "post",
//         dataType: "json",
//         data:formdata,
//         cache:false,
//         contentType: false,
//         processData: false,
//         success : function(){
//             $('#modalHide').modal('toggle');
//             // location.reload();
//             // if(data.valid == 0){
//             // swal({
//             //     title: "Error!",
//             //     text: data.message,
//             //     icon: "error", 
//             // });
            
//             // }else if(data.valid == 1){
//             //     swal({
//             //         title: "Successful",
//             //         text: data.message,
//             //         icon: "success", 
//             //     });
//             //     location.reload();
//             //     windows.load;
//             //     if(data.link){
//             //         setTimeout(function(){
//             //          location.href = data.link;
//             //         },1500);
//             //     }else{
//             //         document.getElementById('catform').reset()
//             //     }
            
//             // }
//             return false
//         }
//     })
// })


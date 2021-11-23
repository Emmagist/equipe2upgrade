$('#select_subcategory').hide();
$('#select_school').hide();
$('#courseInput').hide();

$('#selectCategoryId').change(function () {
    var category = $('#selectCategoryId').val();
    alert(category);
    $.ajax({
        type: "POST",
        url: "proccess.php",
        data: "dataInputCat=" + category,
        success: function (data) {
            $('#subCatOption').html(data);
            $('#select_subcategory').show();
            $('#selectCategoryId').addClass('disabled ');
        }
    });
});

$('#select_subCategory').change(function () {
    alert("Yes");
    var subCat = $('#select_subcategory').val();
    $.ajax({
        type: "POST",
        url: "proccess.php",
        data: "dataInputSubCat=" + subCat,
        success: function (data) {
            $('#schoolOption').html(data);
            $('#select_school').show();
            $('#courseInput').show();
            $('#select_subcategory').addClass('disabled ');
        }
    });
});

// School
// $("#courseForm").submit(function (e) {
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
//         success : function(data){
//             if (data) {
//                 $('#modalHide').modal('toggle');
//                 swal({
//                     title: "Successful",
//                     text: data.message,
//                     icon: "success", 
//                 });
//             }else{
//                 swal({
//                     title: "Error...",
//                     text: data.message,
//                     icon: "error", 
//                 });
//             }
            
//         }
//     })
// })


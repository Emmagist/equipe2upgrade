///////////////////////////// For one customer select, NOT Array

function emp(){
    //alert('jnff');
    //var id=$(m).attr('id');
     $('.employee').autocomplete({
         source: function(request, response) {
             $.ajax({
                 url: "../../getDetails.php",
                 type: 'post',
                 dataType: "json",
                 data: {
                     search: request.term,
                     request: 12
                 },
                 success: function(data) {
                     response(data);
                     //console.log(data)
                 }
             });
         },
         appendTo : $('#addnew'),
         select: function(event, ui) {
             $('#addClaim')[0].reset();
             $('.lbasis').hide();
             $('.claimid').hide();
             $(this).val(ui.item.label); // display the selected text
             $('.emp_id').val(ui.item.value);

             return false;
         }
     });

  }

  function docedit(){
    //alert('jnff');
    //var id=$(m).attr('id');
     $('.doctor').autocomplete({
         source: function(request, response) {
             $.ajax({
                 url: "../getDetails.php",
                 type: 'post',
                 dataType: "json",
                 data: {
                     search: request.term,
                     request: 12
                 },
                 success: function(data) {
                     response(data);
                     //console.log(data)
                 }
             });
         },
         appendTo : $('#edit-c'),
         select: function(event, ui) {
             $(this).val(ui.item.label); // display the selected text
             $('.doctor_id').val(ui.item.value);

             return false;
         }
     });

  }


  function med(){
    //alert('jnff');
    //var id=$(m).attr('id');
     $('.medicine').autocomplete({
         source: function(request, response) {
             $.ajax({
                 url: "../getDetails.php",
                 type: 'post',
                 dataType: "json",
                 data: {
                     search: request.term,
                     request: 13
                 },
                 success: function(data) {
                     response(data);
                     //console.log(data)
                 }
             });
         },
         appendTo :$('#addnew'),
         select: function(event, ui) {
             $(this).val(ui.item.value); // display the selected text
             $('.med_id').val(ui.item.iid);

             return false;
         }
     });

  }


    function mededit(){
    //alert('jnff');
    //var id=$(m).attr('id');
     $('.medicine').autocomplete({
         source: function(request, response) {
             $.ajax({
                 url: "../getDetails.php",
                 type: 'post',
                 dataType: "json",
                 data: {
                     search: request.term,
                     request: 13
                 },
                 success: function(data) {
                     response(data);
                     //console.log(data)
                 }
             });
         },
         appendTo :$('#edit-med'),
         select: function(event, ui) {
             $(this).val(ui.item.value); // display the selected text
             $('.med_id').val(ui.item.iid);

             return false;
         }
     });

  }


  function ser(){
    //alert('jnff');
    //var id=$(m).attr('id');
     $('.service').autocomplete({
         source: function(request, response) {
             $.ajax({
                 url: "../getDetails.php",
                 type: 'post',
                 dataType: "json",
                 data: {
                     search: request.term,
                     request: 14
                 },
                 success: function(data) {
                     response(data);
                     //console.log(data)
                 }
             });
         },
         appendTo :$('#addnew'),
         select: function(event, ui) {
             $(this).val(ui.item.value); // display the selected text
             $('.ser_id').val(ui.item.iid);

             return false;
         }
     });

  }


    function seredit(){
    //alert('jnff');
    //var id=$(m).attr('id');
     $('.service').autocomplete({
         source: function(request, response) {
             $.ajax({
                 url: "../getDetails.php",
                 type: 'post',
                 dataType: "json",
                 data: {
                     search: request.term,
                     request: 14
                 },
                 success: function(data) {
                     response(data);
                     //console.log(data)
                 }
             });
         },
         appendTo :$('#edit-ser'),
         select: function(event, ui) {
             $(this).val(ui.item.value); // display the selected text
             $('.ser_id').val(ui.item.iid);

             return false;
         }
     });

  }



  function item(){
    //alert('jnff');
    //var id=$(m).attr('id');
     $('.item').autocomplete({
         source: function(request, response) {
             $.ajax({
                 url: "../getDetails.php",
                 type: 'post',
                 dataType: "json",
                 data: {
                     search: request.term,
                     request: 15
                 },
                 success: function(data) {
                     response(data);
                     //console.log(data)
                 }
             });
         },
         appendTo :$('#addnew'),
         select: function(event, ui) {
             $(this).val(ui.item.value); // display the selected text
             $('.item_id').val(ui.item.iid);

             return false;
         }
     });

  }


    function itemedit(){
    //alert('jnff');
    //var id=$(m).attr('id');
     $('.item').autocomplete({
         source: function(request, response) {
             $.ajax({
                 url: "../getDetails.php",
                 type: 'post',
                 dataType: "json",
                 data: {
                     search: request.term,
                     request: 15
                 },
                 success: function(data) {
                     response(data);
                     //console.log(data)
                 }
             });
         },
         appendTo :$('#edit-i'),
         select: function(event, ui) {
             $(this).val(ui.item.value); // display the selected text
             $('.item_id').val(ui.item.iid);

             return false;
         }
     });

  }


  function sur(){
    //alert('jnff');
    //var id=$(m).attr('id');
     $('.surgery').autocomplete({
         source: function(request, response) {
             $.ajax({
                 url: "../getDetails.php",
                 type: 'post',
                 dataType: "json",
                 data: {
                     search: request.term,
                     request: 16
                 },
                 success: function(data) {
                     response(data);
                     //console.log(data)
                 }
             });
         },
         appendTo :$('#addnew'),
         select: function(event, ui) {
             $(this).val(ui.item.value); // display the selected text
             $('.sur_id').val(ui.item.iid);

             return false;
         }
     });

  }


    function suredit(){
    //alert('jnff');
    //var id=$(m).attr('id');
     $('.surgery').autocomplete({
         source: function(request, response) {
             $.ajax({
                 url: "../getDetails.php",
                 type: 'post',
                 dataType: "json",
                 data: {
                     search: request.term,
                     request: 16
                 },
                 success: function(data) {
                     response(data);
                     //console.log(data)
                 }
             });
         },
         appendTo :$('#edit-sur'),
         select: function(event, ui) {
             $(this).val(ui.item.value); // display the selected text
             $('.sur_id').val(ui.item.iid);

             return false;
         }
     });

  }


  function test(){
    //alert('jnff');
    //var id=$(m).attr('id');
     $('.test').autocomplete({
         source: function(request, response) {
             $.ajax({
                 url: "../getDetails.php",
                 type: 'post',
                 dataType: "json",
                 data: {
                     search: request.term,
                     request: 17
                 },
                 success: function(data) {
                     response(data);
                     //console.log(data)
                 }
             });
         },
         appendTo :$('#addnew'),
         select: function(event, ui) {
             $(this).val(ui.item.value); // display the selected text
             $('.test_id').val(ui.item.iid);

             return false;
         }
     });

  }


    function testedit(){
    //alert('jnff');
    //var id=$(m).attr('id');
     $('.test').autocomplete({
         source: function(request, response) {
             $.ajax({
                 url: "../getDetails.php",
                 type: 'post',
                 dataType: "json",
                 data: {
                     search: request.term,
                     request: 17
                 },
                 success: function(data) {
                     response(data);
                     //console.log(data)
                 }
             });
         },
         appendTo :$('#edit-t'),
         select: function(event, ui) {
             $(this).val(ui.item.value); // display the selected text
             $('.test_id').val(ui.item.iid);

             return false;
         }
     });

  }

$(document).on('keydown', '.item', function() {
    var id = this.id;
    var pageld = eval($("#loadpage").val())
    if(pageld == 6 || pageld == 66){
        if($("#branch").val() == ""){
         swal("Please select branch", "", "error");
         return false
        }
     }

    $('#' + id).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "../getDetails.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    request: 1
                },
                success: function(data) {
                    response(data);
                }
            });
        },

        select: function(event, ui) {
            $(this).val(ui.item.stock); // display the selected text
            if (index == "1a") {
                document.getElementById('items').value = ui.item.iid;
                document.getElementById('itemnames').value = ui.item.value;
            } else {
                //alert($("#loadpage").val())// == 5
                 if (ui.item.itemtype == "2") {
                     document.getElementById('items' + index).value = ui.item.iid;
                     document.getElementById('itemnames' + index).value = ui.item.value;
                     loadItem(index)
                 }
                 else if(ui.item.sellPrice <= 0 && pageld == 2){
                     swal("Item without Selling Price cannot be sold!", "Contact the Inventory Dept", "error");
                     return false;
                 }
                 else if(ui.item.costPrice > 0 || (pageld == 5 || pageld == 6 || pageld == 66)){
                    addPosItem()
                    var index = eval($('#mycounter').val())
                    $('#itemname').val("");
                    document.getElementById('items' + index).value = ui.item.iid;
                    document.getElementById('itemnames' + index).value = ui.item.value;
                    document.getElementById('size' + index).value = ui.item.specificatn;
                     //var userid = ui.item.value; // selected id to input 
                     if (pageld == 1) {
                         loadItem(index)
                     } else if (pageld == 11) {
                         loadItemAllowOut(index)
                     } else if (pageld == 2 || pageld == 22) {
                         loadItem2(index)
                     } else if (pageld == 3) {
                         loadItem3(index)
                     } else if (pageld == 4) {
                         loadItem4(index)
                     } else if (pageld == 5) {
                         loadItem5(index)
                     } else if (pageld == 6 || pageld == 66) {
                         loadItem6(index)
                     }
                 }
                 else{
                     swal("Item without Cost Price cannot be sold!", "Contact the Inventory Dept", "error");
                     return false;
                 }
            }
            return false;
        }
    });
});

$(document).on('keydown', '.item-quick', function() {
    var id = this.id;
    var pageld = eval($("#loadpage").val())
    $('#' + id).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "../getDetails.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    request: 1
                },
                success: function(data) {
                    response(data);
                }
            });
        },

        select: function(event, ui) {
            $(this).val(ui.item.stock); // display the selected text
            addPosItem()
            hideSearchItem()
            var index = eval($('#mycounter').val())
            $('#itemname').val("");
            document.getElementById('items' + index).value = ui.item.iid;
            document.getElementById('itemnames' + index).value = ui.item.value;
            document.getElementById('stockcode_' + index).value = ui.item.stock;
            document.getElementById('size' + index).value = ui.item.specificatn;
            document.getElementById(index).value = ui.item.sellPrice;
            $('#taxvalue').val($('#taxvalue2').val())
            sumUp(index)
            //loadItem2(index)
            return false;
        }
    });
});

$(document).on('keydown', '.items', function() {
       var id = this.id;
       var splitid = id.split('_');
       var index = splitid[1];
       var pageld = eval($("#loadpage").val())
       if(pageld == 6 || pageld == 66){
           if($("#branch").val() == ""){
            swal("Please select branch", "", "error");
            return false
           }
        }

       $('#' + id).autocomplete({
           source: function(request, response) {
               $.ajax({
                   url: "../getDetails.php",
                   type: 'post',
                   dataType: "json",
                   data: {
                       search: request.term,
                       request: 1
                   },
                   success: function(data) {
                       response(data);
                   }
               });
           },

           select: function(event, ui) {
               $(this).val(ui.item.stock); // display the selected text
               if (index == "1a") {
                   document.getElementById('items' + index).value = ui.item.iid;
                   document.getElementById('itemnames_' + index).value = ui.item.value;
               } else {
                   //alert($("#loadpage").val())// == 5
                    if (ui.item.itemtype == "2") {
                        document.getElementById('items' + index).value = ui.item.iid;
                        document.getElementById('itemnames' + index).value = ui.item.value;
                        loadItem(index)
                    }
                    else if(ui.item.costPrice <= 0 && pageld == 4){
                        swal("Item without Cost Price cannot be transfer!", "Contact the Inventory Dept", "error");
                        return false;
                    }
                    else if(ui.item.costPrice > 0 || (pageld == 5 || pageld == 6 || pageld == 66)){
                        document.getElementById('items' + index).value = ui.item.iid;
                        document.getElementById('itemnames' + index).value = ui.item.value;
                        //var userid = ui.item.value; // selected id to input 
                        if (pageld == 1) {
                            loadItem(index)
                        } else if (pageld == 11) {
                            loadItemAllowOut(index)
                        } else if (pageld == 2 || pageld == 22) {
                            loadItem2(index)
                        } else if (pageld == 3) {
                            loadItem3(index)
                        } else if (pageld == 4) {
                            loadItem4(index)
                        } else if (pageld == 5) {
                            loadItem5(index)
                        } else if (pageld == 6 || pageld == 66) {
                            loadItem6(index)
                        }
                    }
                    else{
                        swal("Item without Cost Price cannot be sold!", "Contact the Inventory Dept", "error");
                        return false;
                    }
               }
               return false;
           }
       });
});



///////////////////////////// For one customer select, NOT Array
$(document).on('keydown', '.customer', function() {
       var id = this.id;

       $('#' + id).autocomplete({
           source: function(request, response) {
               $.ajax({
                   url: "../getDetails.php",
                   type: 'post',
                   dataType: "json",
                   data: {
                       search: request.term,
                       request: 2
                   },
                   success: function(data) {
                       response(data);
                   }
               });
           },

           select: function(event, ui) {
               $(this).val(ui.item.label); // display the selected text
               document.getElementById('customer_id').value = ui.item.value;
               //var userid = ui.item.value; // selected id to input
               var loadpage = eval($('#loadpage').val())
               if (loadpage == 1 || loadpage == 5) {
                   getCustomerInfo(0)
               } else if (loadpage == 2  || loadpage == 11) {
                   getCustomerInfo(2)
               } else if (loadpage == 3) {
                   getCustomerInfo(1)
               } else if (loadpage == 4) {
                    getCustomerInfo(4)
                }
                else if (loadpage == 5) {
                    getCustomerInfo(5)
                } 
                /*else if (loadpage == 5) {
                    loadItem5(index)
                }*/

               // AJAX


               return false;
           }
       });
   });

   ///////////////////////////// For one customer select, NOT Array
$(document).on('keydown', '.customerQuick', function() {
    var id = this.id;

    $('#' + id).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "../getDetails.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    request: 2
                },
                success: function(data) {
                    response(data);
                }
            });
        },

        select: function(event, ui) {
            $(this).val(ui.item.label); // display the selected text
            document.getElementById('customer_id').value = ui.item.value;
            document.getElementById('email').value = ui.item.email;
            //document.getElementById('saddress').value = ui.item.address;
            //document.getElementById('phoneno').value = ui.item.phone;
            return false;
        }
    });
});

/////// Array Customer
$(document).on('keydown', '.customers', function() {
       var id = this.id;
       var splitid = id.split('_');
       var index = splitid[2];

       $('#' + id).autocomplete({
           source: function(request, response) {
               $.ajax({
                   url: "../getDetails.php",
                   type: 'post',
                   dataType: "json",
                   data: {
                       search: request.term,
                       request: 2
                   },
                   success: function(data) {
                       response(data);
                   }
               });
           },

           select: function(event, ui) {
               $(this).val(ui.item.label); // display the selected text
               document.getElementById('customer_id' + index).value = ui.item.value;
               //var userid = ui.item.value; // selected id to input
               /*var loadpage = eval($('#loadpage').val())
               if (loadpage == 1) {
                   loadItem(index)
               } else if (loadpage == 2) {
                   loadItem2(index)
               } else if (loadpage == 3) {
                   loadItem3(index)
               } else if (loadpage == 4) {
                   loadItem4(index)
               } else if (loadpage == 5) {
                   loadItem5(index)
               }*/

               // AJAX


               return false;
           }
       });
});

/////// Array Customerb
$(document).on('keydown', '.customersb', function() {
    var id = this.id;
    var splitid = id.split('_');
    var index = splitid[2];

    $('#' + id).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "../getDetails.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    request: 2
                },
                success: function(data) {
                    response(data);
                }
            });
        },

        select: function(event, ui) {
            $(this).val(ui.item.label); // display the selected text
            document.getElementById('customer_idb' + index).value = ui.item.value;
            //var userid = ui.item.value; // selected id to input
            /*var loadpage = eval($('#loadpage').val())
            if (loadpage == 1) {
                loadItem(index)
            } else if (loadpage == 2) {
                loadItem2(index)
            } else if (loadpage == 3) {
                loadItem3(index)
            } else if (loadpage == 4) {
                loadItem4(index)
            } else if (loadpage == 5) {
                loadItem5(index)
            }*/

            // AJAX


            return false;
        }
    });
});

///////////////////////////// For one Supplier select, NOT Array
$(document).on('keydown', '.supplier', function() {
    var id = this.id;
    $('#' + id).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "../getDetails.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    request: 3
                },
                success: function(data) {
                    response(data);
                }
            });
        },

        select: function(event, ui) {
            $(this).val(ui.item.label); // display the selected text
            document.getElementById('supplier').value = ui.item.value;
            //var userid = ui.item.value; // selected id to input
            var loadpage = eval($('#loadpage').val())
            if (loadpage == 1 || loadpage == 5) {
                getSupplierInfo(10)
            } else if (loadpage == 2 || loadpage == 22) {
                getSupplierInfo(2)
            } else if (loadpage == 3) {
                getSupplierInfo(3)
            } else if (loadpage == 4) {
                getSupplierInfo(1)
            } 
             /*else if (loadpage == 5) {
                 loadItem5(index)
             }*/

            // AJAX


            return false;
        }
    });
});

/////// Array Supplier
$(document).on('keydown', '.suppliers', function() {
    var id = this.id;
    var splitid = id.split('_');
    var index = splitid[1];

    $('#' + id).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "../getDetails.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    request: 3
                },
                success: function(data) {
                    response(data);
                }
            });
        },

        select: function(event, ui) {
            $(this).val(ui.item.label); // display the selected text
            document.getElementById('supplier_id' + index).value = ui.item.value;
            return false;
        }
    });
});
/////// Array Supplierb
$(document).on('keydown', '.suppliersb', function() {
    var id = this.id;
    var splitid = id.split('_');
    var index = splitid[1];

    $('#' + id).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "../getDetails.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    request: 3
                },
                success: function(data) {
                    response(data);
                }
            });
        },

        select: function(event, ui) {
            $(this).val(ui.item.label); // display the selected text
            document.getElementById('supplier_idb' + index).value = ui.item.value;
            return false;
        }
    });
});


///////////////////////////// For one Supplier select, NOT Array
$(document).on('keydown', '.banks', function() {
    var id = this.id;
    $('#' + id).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "../getDetails.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    request: 4
                },
                success: function(data) {
                    response(data);
                }
            });
        },

        select: function(event, ui) {
            $(this).val(ui.item.label); // display the selected text
            document.getElementById('bank_id').value = ui.item.value;
            return false;
        }
    });
});

/////// Array Bank
$(document).on('keydown', '.banks', function() {
    var id = this.id;
    var splitid = id.split('_');
    var index = splitid[1];

    $('#' + id).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "../getDetails.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    request: 4
                },
                success: function(data) {
                    response(data);
                }
            });
        },

        select: function(event, ui) {
            $(this).val(ui.item.label); // display the selected text
            document.getElementById('bank_id' + index).value = ui.item.value;
            return false;
        }
    });
});


/////// Array Bankb
$(document).on('keydown', '.banksb', function() {
    var id = this.id;
    var splitid = id.split('_');
    var index = splitid[1];

    $('#' + id).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "../getDetails.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    request: 4
                },
                success: function(data) {
                    response(data);
                }
            });
        },

        select: function(event, ui) {
            $(this).val(ui.item.label); // display the selected text
            document.getElementById('bank_idb' + index).value = ui.item.value;
            return false;
        }
    });
});


/////// Array Staff
$(document).on('keydown', '.staffs', function() {
    var id = this.id;
    var splitid = id.split('_');
    var index = splitid[1];

    $('#' + id).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "../getDetails.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    request: 5
                },
                success: function(data) {
                    response(data);
                }
            });
        },

        select: function(event, ui) {
            $(this).val(ui.item.label); // display the selected text
            document.getElementById('staff_id' + index).value = ui.item.value;
            return false;
        }
    });
});

/////// Array Bank
$(document).on('keydown', '.accounts', function() {
    var id = this.id;
    var splitid = id.split('_');
    var index = splitid[1];

    $('#' + id).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "../getDetails.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    request: 6
                },
                success: function(data) {
                    response(data);
                }
            });
        },

        select: function(event, ui) {
            $(this).val(ui.item.label); // display the selected text
            document.getElementById('acc_id' + index).value = ui.item.value;
            return false;
        }
    });
});

/////// Array Customer, Supplier, Employee
$(document).on('keydown', '.customerSup', function() {
    var id = this.id;
    var splitid = id.split('_');
    var index = splitid[2];
    var accid = document.getElementById('bank' + index).value ; 
    $('#' + id).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "../getDetails.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    request: 7,
                    accid: accid
                },
                success: function(data) {
                    response(data);
                }
            });
        },

        select: function(event, ui) {
            $(this).val(ui.item.label); // display the selected text
            document.getElementById('customer_id' + index).value = ui.item.value; 
            document.getElementById('source' + index).value = ui.item.source;
            return false;
        }
    });
});

/////// Array Customer, Supplier, Employee
$(document).on('keydown', '.customerSupb', function() {
    var id = this.id;
    var splitid = id.split('_');
    var index = splitid[2];
    var accid = document.getElementById('bankb' + index).value ; 
    $('#' + id).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "../getDetails.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    request: 7,
                    accid: accid
                },
                success: function(data) {
                    response(data);
                }
            });
        },

        select: function(event, ui) {
            $(this).val(ui.item.label); // display the selected text
            document.getElementById('customer_idb' + index).value = ui.item.value; 
            document.getElementById('sourceb' + index).value = ui.item.source;
            return false;
        }
    });
});


///////////////////////////// For one Staff select, NOT Array
$(document).on('keydown', '.staff', function() {
    var id = this.id;
    $('#' + id).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "../getDetails.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    request: 8
                },
                success: function(data) {
                    response(data);
                }
            });
        },

        select: function(event, ui) {
            $(this).val(ui.item.label); // display the selected text
            document.getElementById('pic').value = ui.item.value;
            return false;
        }
    });
});

function searchEmployee(){
     $('.employee').autocomplete({
         source: function(request, response) {
           $.ajax({
               url: "../getDetails.php",
               type: 'post',
               dataType: "json",
               data: {
                   search: request.term,
                   request: 12
               },
               success: function(data) {
                   response(data);
                   //console.log(data)
               }
           });
		 },
         appendTo : $('#addmodal'),
         select: function(event, ui) {
             $(this).val(ui.item.label); // display the selected text
             $('.emp_id').val(ui.item.value);

             return false;
         }
     });
  }

  function searchEmployee2(){
    $('.employee').autocomplete({
        source: function(request, response) {
          $.ajax({
              url: "../getDetails.php",
              type: 'post',
              dataType: "json",
              data: {
                  search: request.term,
                  request: 12
              },
              success: function(data) {
                  response(data);
                  //console.log(data)
              }
          });
        },
        appendTo : $('#editmodal'),
        select: function(event, ui) {
            $(this).val(ui.item.label); // display the selected text
            $('.emp_id').val(ui.item.value);

            return false;
        }
    });
 }

 function searchCostCenter(){
    $('.costcenter').autocomplete({
        source: function(request, response) {
          $.ajax({
              url: "../getDetails.php",
              type: 'post',
              dataType: "json",
              data: {
                  search: request.term,
                  request: 18
              },
              success: function(data) {
                  response(data);
                  //console.log(data)
              }
          });
        },
        appendTo : $('#addmodal'),
        select: function(event, ui) {
            $(this).val(ui.item.value); // display the selected text
            $('.cost_id').val(ui.item.lable);
            return false;
        }
    });
 }

 function searchCostCenter2(){
    $('.costcenter').autocomplete({
        source: function(request, response) {
          $.ajax({
              url: "../getDetails.php",
              type: 'post',
              dataType: "json",
              data: {
                  search: request.term,
                  request: 18
              },
              success: function(data) {
                  response(data);
                  //console.log(data)
              }
          });
        },
        appendTo : $('#editmodal'),
        select: function(event, ui) {
            $(this).val(ui.item.value); // display the selected text
            $('.cost_id').val(ui.item.lable);
            return false;
        }
    });
 }
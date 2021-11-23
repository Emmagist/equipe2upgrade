<style>
	#footer {
		position:fixed;
		bottom:0;
		width:100%;
		right:15px;
		background: #064780;;
	}
</style>
<footer id="footer"> 
    <div class="">
        
    </div>
    <div class="clearfix"></div>
</footer>

           <!-- /footer content -->
        </div>
        <!-- /page content -->

    </div>

</div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>


	
    
    <script src="<?php echo SITEURL; ?>/js/bootstrap.min.js"></script>
    
    <!-- bootstrap progress js -->
    <script src="<?php echo SITEURL; ?>/js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo SITEURL; ?>/js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="<?php echo SITEURL; ?>/js/icheck/icheck.min.js"></script>

    <script src="<?php echo SITEURL; ?>/js/custom.js"></script>
    <script src="<?php echo SITEURL; ?>/js/jquery.blockUI.js"></script>
      <!-- Datatables -->
    <script src="<?php echo SITEURL; ?>/js/datatables/js/jquery.dataTables.js"></script>
    <script src="<?php echo SITEURL; ?>/js/datatables/tools/js/dataTables.tableTools.js"></script>
		
    
    
    
    <script src="<?php echo SITEURL; ?>/js/bootstrap-datetimepicker.js"></script>
    <!-- SB Admin Scripts - Include with every page -->
    
    <script type="text/javascript" src="<?php echo SITEURL; ?>/js/bootstrapValidator.min.js"></script>
    <!-- SweetAlert Plugin Js -->
    <script src="<?php echo SITEURL ?>/sweetalert/sweetalert.min.js"></script>

    <!-- Webcamp -->
    <script src="<?php echo SITEURL; ?>/assets/fancybox/jquery.easing-1.3.pack.js"></script>
    <script src="<?php echo SITEURL; ?>/assets/webcam/webcam.js"></script>
    <script src="<?php echo SITEURL; ?>/assets/js/script.js"></script>
    <script src="<?php echo SITEURL; ?>/js/fetchCart.js"></script>
    <script src="<?php echo SITEURL; ?>/js/fetchSubCategory.js"></script>
    <script src="<?php echo SITEURL; ?>/js/fetchSchool.js"></script>
    <script src="<?php echo SITEURL; ?>/js/courseFetch.js"></script>
    <script src="<?php echo SITEURL; ?>/js/courseFetch.js"></script>
    <script src="<?php echo SITEURL; ?>/js/editFetchPage.js"></script>
    <script src="<?php echo SITEURL; ?>/js/contentFetch.js"></script>
    <!-- select2 -->
    <script src="<?php echo SITEURL; ?>/js/select/select2.full.js"></script>
    
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>
    
    <script>
        $(document).ready(function () {
            $(".select2_single").select2({
                placeholder: "Select",
                allowClear: true
            });
            $(".select2_group").select2({});
            $(".select2_multiple").select2({
                maximumSelectionLength: 4,
                placeholder: "With Max Selection limit 4",
                allowClear: true
            });
        });

    </script>

    <script>
        $(document).ready(function () {
            $('input.tableflat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#birthday').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
        });
    </script>
    
        <!-- Datatables -->
    <script>
        $(document).ready(function () {
            $('input.tableflat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });

        var asInitVals = new Array();
        $(document).ready(function () {
            var oTable = $('#example').dataTable({
                "oLanguage": {
                    "sSearch": "Search all columns:"
                },
                "aoColumnDefs": [
                    {
                        'bSortable': false,
                        'aTargets': [0]
                    } //disables sorting for column one
        ],
                'iDisplayLength': 12,
                "sPaginationType": "full_numbers",
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "<?php echo SITEURL; ?>/js/datatables/tools/swf/copy_csv_xls_pdf.swf"
                }
            });
            $("tfoot input").keyup(function () {
                /* Filter on the column based on the index of this element's parent <th> */
                oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
            });
            $("tfoot input").each(function (i) {
                asInitVals[i] = this.value;
            });
            $("tfoot input").focus(function () {
                if (this.className == "search_init") {
                    this.className = "";
                    this.value = "";
                }
            });
            $("tfoot input").blur(function (i) {
                if (this.value == "") {
                    this.className = "search_init";
                    this.value = asInitVals[$("tfoot input").index(this)];
                }
            });
        });
    </script>
    
    <!-- Date Picker -->
    <script type="text/javascript" src="<?php echo SITEURL; ?>/jsDatePick.min.1.3.js"></script>
    <script type="text/javascript">
        window.onload = function(){
            new JsDatePick({
                useMode:2,
                target:"tdate",
                dateFormat:"%d-%m-%Y"
            });
            
            new JsDatePick({
                useMode:2,
                target:"tdate2",
                dateFormat:"%d-%m-%Y"
            });
        };

        $('#json').on('click',function(){
            $("#ttexample").tableHTMLExport({type:'json',filename:'<?php echo $pdffilename."-".date("d-m-Y-g-i-A"); ?>.json'});
        })
        $('#csv').on('click',function(){
            $("#ttexample").tableHTMLExport({type:'csv',filename:'<?php echo $pdffilename."-".date("d-m-Y-g-i-A"); ?>.csv'});
        })
        $('#pdf').on('click',function(){
            $("#ttexample").tableHTMLExport({type:'pdf',filename:'<?php echo $pdffilename."-".date("d-m-Y-g-i-A"); ?>.pdf'});
        })

        $('#create_excel').click(function(){  
           var excel_data = $('#record_table').html();  
           document.getElementById("tableContent").value = excel_data;
           //$('#tableContent').val(excel_data);
           //alert(document.getElementById("tableContent").value )
           document.getElementById("print_excel").submit();
        });

        $("#print-btn").click(function () {
            //Hide all other elements other than printarea.
            $("#printArea").show();
            window.print();
        });
        
    </script>
    <!-- Configure a few settings -->
    
</body>

</html>
<?php mysqli_close($db); ?>
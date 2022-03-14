 <!--Global script(used by all pages)-->
 <script data-cfasync="false" src="{{ url('backEnd/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script>
 @if (Request::is('gnattchart') || Request::is('gnattchart/store'))
 @else
 <script src="{{ url('backEnd/plugins/jQuery/jquery-3.4.1.min.js')}}"></script>
  <!--Page Active Scripts(used by this page)-->
 <script src="{{ url('backEnd/dist/js/pages/dashboard.js')}}"></script>
 @endif
 <script src="{{ url('backEnd/dist/js/popper.min.js')}}"></script>
 <script src="{{ url('backEnd/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
 <script src="{{ url('backEnd/plugins/metisMenu/metisMenu.min.js')}}"></script>
 <script src="{{ url('backEnd/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
 <!-- Third Party Scripts(used by this page)-->
 <script src="{{ url('backEnd/plugins/chartJs/Chart.min.js')}}"></script>
 <script src="{{ url('backEnd/plugins/sparkline/sparkline.min.js')}}"></script>
 <script src="{{ url('backEnd/plugins/datatables/dataTables.min.js')}}"></script>
 <script src="{{ url('backEnd/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

 <!--Page Scripts(used by all page)-->
 <script src="{{ url('backEnd/dist/js/sidebar.js')}}"></script>

 <!--colorpicker(used by all page)-->
 <script src="{{ url('backEnd/dist/js/jscolor.js') }}"></script>

 <!--Page Active Scripts(used by this page)-->
 <script src="{{ url('backEnd/plugins/datatables/data-basic.active.js')}}"></script>


 <!--summernote-->
<!-- Third Party Scripts(used by this page)-->
<script src="{{ url('backEnd/plugins/summernote/summernote.min.js')}}"></script>
<script src="{{ url('backEnd/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!--Page Active Scripts(used by this page)-->
<script src="{{ url('backEnd/plugins/summernote/summernote.active.js')}}"></script>

<!--wysihtml5-->
    <!-- Third Party Scripts(used by this page)-->
    <script src="{{ url('backEnd/plugins/bootstrap-wysihtml5/wysihtml5.js')}}"></script>
    <script src="{{ url('backEnd/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}"></script>
    <!--Page Active Scripts(used by this page)-->
    <script src="{{ url('backEnd/plugins/bootstrap-wysihtml5/wysihtml5.active.js')}}"></script>
    <script>
    $(document).ready(function(){
    $('#currency').on('change', function() {
      if ( this.value == '1')
      {
        $("#currencychange").show();
     
      }
      else
      {
        $("#currencychange").hide();
      }
    });
});
</script>
     <script>
      $(document).ready(function(){
      $('#exampleFormControlSelect2').on('change', function() {
        if ( this.value == '2')
        {
          $("#designation").show();
        }
        else
        {
          $("#designation").hide();
        }
      });
  });
  </script>
    <script>
      $(document).ready(function(){
      $('#exampleFormControlSelect33').on('change', function() {
        if ( this.value == '2')
        {
          $("#designationn").show();
       
        }
        else
        {
          $("#designationn").hide();
        }
      });
  });
  </script>
 <script>
      $(document).ready(function(){
      $('#invoicereject').on('change', function() {
        if ( this.value == '1')
        {
          $("#designationn").show();
          $("#deb").hide();
        }
        else if ( this.value == '5')
        {
          $("#deb").show();
          $("#designationn").hide();
        }
        else
        {
          $("#designationn").hide();
          $("#deb").hide();
        }
      });
  });
  </script>
 <script>
      $(document).ready(function(){
      $('#Tickets_Booked_By').on('change', function() {
        if ( this.value == 'Self')
        {
          $("#designationn").show();
       
        }
        else
        {
          $("#designationn").hide();
        }
      });
  });
  </script>
   <script>
      $(document).ready(function(){
          $("#template").change(function(){
              $(this).find("option:selected").each(function(){
                  var optionValue = $(this).attr("value");
                 // alert(optionValue);
           
                  if(optionValue==1){
                      $("#div2").hide();
                      $("#div1").show();
                      
                  }
                  else if(optionValue==2){
                      $("#div1").hide();
                      $("#div2").show();
                  }
                  else{
                      $("#div2").hide();
                      $("#div1").hide();
                     
                      
                  }
              });
          }).change();
      });
      </script>
 <script>
    $(document).ready(function(){
    $('#travel').on('change', function() {
      if ( this.value == '0')
      {
        $("#travels").show();
		   $("#ticket").val('0');
                    $("#food").val('0');
                    $("#conveyance").val('0');
                    $("#other").val('0');
                    $("#total").val('0');
      }
      else
      {
        $("#travels").hide();
      }
    });
});
</script>
        <script>
      $(document).ready(function(){
      $('#exampleFormControlSelect3').on('change', function() {
        if ( this.value == '2')
        {
          $("#designationn").show();
       
        }
        else
        {
          $("#designationn").hide();
        }
      });
  });
  </script>
         <script>
      $(document).ready(function(){
      $('#exampleFormControlSelect4').on('change', function() {
        if ( this.value == '1')
        {
          $("#designationnn").show();
       
        }
        else
        {
          $("#designationnn").hide();
        }
      });
  });
  </script>
    <script>
        $(document).ready(function(){
        $('#exampleFormControlSelect1').on('change', function() {
          if ( this.value == '1')
          {
            $("#designation").show();
          }
          else
          {
            $("#designation").hide();
          }
        });
    });
    </script>
    <!-- Third Party Scripts(used by this page)-->
<script src="{{ url('backEnd/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{ url('backEnd/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ url('backEnd/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{ url('backEnd/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ url('backEnd/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{ url('backEnd/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{ url('backEnd/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{ url('backEnd/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{ url('backEnd/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{ url('backEnd/plugins/datatables/buttons.colVis.min.js')}}"></script>
<!--Page Active Scripts(used by this page)-->
<script src="{{ url('backEnd/plugins/datatables/data-bootstrap4.active.js')}}"></script>


   <!-- Third Party Scripts(used by this page)-->
                         <script src="{{ url('backEnd/plugins/select2/dist/js/select2.min.js')}}"></script>
                         <script src="{{ url('backEnd/plugins/jquery.sumoselect/jquery.sumoselect.min.js')}}"></script>
                         <!--Page Active Scripts(used by this page)-->
                         <script src="{{ url('backEnd/dist/js/pages/demo.select2.js')}}"></script>
                         <script src="{{ url('backEnd/dist/js/pages/demo.jquery.sumoselect.js')}}"></script>
                         
                         
                                <!-- Third Party Scripts(used by this page)-->
 <script src="{{ url('backEnd/plugins/icheck/icheck.min.js')}}"></script>
 <script src="{{ url('backEnd/plugins/bootstrap4-toggle/js/bootstrap4-toggle.min.js')}}"></script>
 <!--Page Active Scripts(used by this page)-->
 <script src="{{ url('backEnd/dist/js/pages/icheck.active.js')}}"></script>
@if(Request::is('invoice/create') || Request::is('invoice/*/edit'))
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script>
  $(function () {
        $('#datepicker').datepicker({ dateFormat: 'dd-mm-yy' });
    });
 </script>
 @endif

 <!--Third party Styles(used by this page)--> 
  <link href="{{ url('backEnd/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet">
  <link href="{{ url('backEnd/plugins/select2-bootstrap4/dist/select2-bootstrap4.min.css')}}" rel="stylesheet">
  <link href="{{ url('backEnd/plugins/jquery.sumoselect/sumoselect.min.css')}}" rel="stylesheet">


@extends('backEnd.layouts.layout') @section('backEnd_content')

<div class="body-content">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0">Add Client</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('client.store')}}" enctype="multipart/form-data">
                        @csrf
                  @component('backEnd.components.alert')

                  @endcomponent
                        @include('backEnd.client.form')
                    </form>
                   
                    <hr class="my-4">

                </div>
            </div>
        </div>
    </div>
</div>
<!--/.body content-->

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div class="row row-sm "><div class="col-4"><div class="form-group"><label class="font-weight-600">Document Name </label><input type="text" class="form-control key" name="document_name[]" id="key" value=""  placeholder="Enter Document Name"></div></div><div class="col-3"> <div class="form-group"> <label class="font-weight-600">File * </label>  <input type="file" class="form-control key" name="filess[]" id="key" value=""  placeholder="Enter Document Name"> </div> </div><div class="col-4"> <div class="form-group"> <label class="font-weight-600"> Document Type </label>   <select class="form-control key" name="type[]" id="key" value="" id="exampleFormControlSelect1" >   <option value="0">Permanent</option> <option value="1">Temporary</option> </select> </div> </div><a style="margin-top: 36px;" href="javascript:void(0);" class="remove_button"><img src="{{ url('backEnd/image/remove-icon.png')}}"/></a></div></div>'; //New input field html 
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
    </script>
       <script>
        $(function(){
           $('#category').on('change',function(){
               var category_id =$(this).val();
    
            $.ajax({
                type: "GET",
                url: "{{ url('client/create') }}",
                data: "category_id="+category_id,
                success : function(res){
                
                    $('#subcategory_id').html(res);
    
                    
                },
                error : function(){
    
                },
            });
           });
         }); 
     </script>
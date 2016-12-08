@extends('backend.layouts.app')

@section('content')

<script type="text/javascript">
    function selecttosearch(e1)
    {
        var inid=document.getElementById(e1);
        var val=inid.options[inid.selectedIndex].value;
        window.location=val;
    }
    </script>



    
        
        <div class="panel panel-primary">
            <div class="panel-heading">Please Select Customer You Want to Update</div>
            <div class="panel-body">
                
                
                
                <div class="col-md-12">
                <div class="form-group">

                        {!! Form::label ('invoiceno_lbl','Select Customer:',['class' =>'control-label col-md-3']) !!}

                        <div class="col-md-6">
                            <select class="form-control"  id="cusid" >
                                @foreach($customers as $customer)
                                <option>{{$url = action('Frontend\Customers\CustomerController@search_customer',['customercode' => $customer->Cus_Code]) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            
                            <button onclick="selecttosearch('cusid')" class="btn btn-lg btn-success">Select Invoice</button>
                            
                 </div>
                    </div>
            </div>
                                
                    
               
            </div>
            <div class="panel-footer">

            </div>
        </div>

@stop
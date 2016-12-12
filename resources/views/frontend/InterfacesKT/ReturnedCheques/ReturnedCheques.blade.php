@extends('backend.layouts.app')

@section('content')

    <script>
        function addindexes(p1)
        {
            var index_table=[p1];
            return p1;
        }
    </script>


    <div class="row-fluid">
        <h2>Report Returned Cheque Details</h2>
    </div>


    <!-- New Invoice Starts Here-->

    <div class="box box-primary">
        <div class="box-header with-border">

            <div class="col-md-3">
                <h3 class="box-title">Returned Cheques</h3>
                <h4>{{\Carbon\Carbon::now('Asia/Colombo')}}</h4>
            </div>


            <div class="col-md-8">

                {!! Form::open(['class'=>'form','url'=>'reportchequesave'])!!}


                <ul class="list-inline">

                    
                    
                    <li>{!! Form::button('<span class="glyphicon glyphicon-floppy-disk"> Save</span>',array('class'=>'btn btn-success btn-lg','type'=>'submit','name'=>'save')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-edit"> Modify</span>',array('class'=>'btn btn-lg btn-info','type'=>'submit','name'=>'modify')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-refresh"> Reset</span>',array('class'=>'btn btn-lg btn-warning','type'=>'reset','name'=>'reset')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-print"> Print</span>',array('class'=>'btn btn-lg btn-primary','type'=>'submit','name'=>'print')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-trash"> Delete</span>',array('class'=>'btn btn-lg btn-danger ','type'=>'submit','name'=>'delete')) !!}</li>


                </ul>
            </div>


            <div class="col-md-1">
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div><!-- /.box tools -->
            </div>





        </div><!-- /.box-header -->
        <div class="box-body">
            
            <div class="row">
                <div class="col-md-5">
                    <div class="form-inline"   style="border-radius:5px; border-style: ridge">
                <div class="form-group">
                {!! Form::label ('invoiceno_lbl','Receipt: ',['class' =>'control-label col-md-6']) !!}
                <div class="col-md-6">
                    {!!Form::radio('Type', 'RC', false,['class'=>'radio','onclick'=>'disablefunction()'])!!}
                </div>
            </div>
                
                <div class="form-group">
                 {!! Form::label ('invoiceno_lbl','Invoice: ',['class' =>'control-label col-md-6']) !!}
                <div class="col-md-6">
                    {!!Form::radio('Type', 'IN', false,['class'=>'radio','onclick'=>'enablefunction()'])!!}
                </div>
            </div>
                        
                        <div class="form-group">
                 {!! Form::label ('invoiceno_lbl','Advance: ',['class' =>'control-label col-md-6']) !!}
                <div class="col-md-6">
                    {!!Form::radio('Type', 'AD', false,['class'=>'radio','onclick'=>'enablefunction()'])!!}
                </div>
            </div>

            </div>
                </div>
                
                
            </div>
            <hr>
            <div class="form-horizontal">
                <div class="form-group">
                        {!! Form::label ('product_lbl','Return No.:',['class' =>'control-label col-md-2']) !!}
                        <div class="col-md-4">
                        {!! Form::text ('ReportNo','',['class'=>'form-control', 'placeholder'=>'Return No.' , 'id'=>'bank']) !!}
                        </div>
                        
                        {!! Form::label ('product_lbl','Bank:',['class' =>'control-label col-md-2']) !!}
                        
                        <div class="col-md-3">
                        {!! Form::label ('Bank','',['class' =>'control-label','id'=>'txtHint1']) !!}
                        </div>
                        
                    </div>
                
                 <div class="form-group">
                        {!! Form::label ('product_lbl','Cheque No.:',['class' =>'control-label col-md-2']) !!}
                        <div class="col-md-4">
                        {!! Form::text ('Cheque_No','',['class'=>'form-control', 'placeholder'=>'Cheque No.' , 'onkeyup'=>'showHint(this.value)']) !!}
                        </div>
                        
                        {!! Form::label ('product_lbl','Customer:',['class' =>'control-label col-md-2']) !!}
                        
                        <div class="col-md-3">
                        {!! Form::label ('Customer','',['class' =>'control-label','id'=>'txtHint2']) !!}
                        </div>
                        
                    </div>
                
                <div class="form-group">
                        {!! Form::label ('product_lbl','Amount:',['class' =>'control-label col-md-2']) !!}
                        <div class="col-md-4">
                        {!! Form::label ('Amount','Amount Here',['class' =>'control-label','id'=>'txtHint3']) !!}
                        </div>
                </div>
                
                {!! Form::close() !!}   
                 
                <h3>Settlement Details</h3>
                
            </div>
            
            <div class="row-fluid">
                <table class="table-striped col-md-6">
                <thead>
                <th>Invoice No.</th>
                <th>Date</th>
                <th>Paid Amount</th>
                <th>Type</th>
                </thead>
                <tr></tr>
            </table>
            </div>
            
                
        </div><!-- /.box-body -->
    </div>
    <!--box box-success-->

    <!-- New Invoice Ends Here-->

    <script>
function showHint(str) {
    if (str.length == 0) 
    
         { 
            document.getElementById("txtHint1").innerHTML = "Please Enter Cheque Number";
            document.getElementById("txtHint2").innerHTML = "Please Enter Cheque Number";
            document.getElementById("txtHint3").innerHTML = "Please Enter Cheque Number";
            return;
         } 
    
        else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
               
               var arr=this.responseText.split(",");
               
            document.getElementById("txtHint1").innerHTML =arr[0];
            document.getElementById("txtHint2").innerHTML = arr[1];
            document.getElementById("txtHint3").innerHTML = arr[2];
        }
        };
        
            xmlhttp.open("GET", "returnedchequedetails/"+str, true);
            xmlhttp.send();
    }
}
</script>

    
    @stop
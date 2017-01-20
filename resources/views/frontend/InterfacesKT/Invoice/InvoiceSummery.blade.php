@extends('backend.layouts.app')

@section('content')

<script>
    function addindexes(p1)
    {
        var index_table = [p1];
        return p1;
    }
</script>



<!-- New Invoice Starts Here-->

<div class="box box-primary">
    <div class="box-header with-border">

        <div class="col-md-2">
            <h3 class="box-title">Invoice Summery </h3>
            <h5>{{\Carbon\Carbon::now('Asia/Colombo')}}</h5>
        </div>


        <div class="col-md-9">

            {!! Form::open(['class'=>'form', 'url'=>'getinvoicedata' , 'method'=>'post']) !!}


            <ul class="list-inline">

                <li>{!! Form::button('<span class="glyphicon glyphicon-floppy-disk"> Save</span>',array('class'=>'btn btn-lg btn-success','type'=>'submit','name'=>'Add')) !!}</li> 
                <li>{!! Form::button('<span class="glyphicon glyphicon-edit"> Modify</span>',array('class'=>'btn btn-lg btn-info','type'=>'button','name'=>'modify')) !!}</li>
                <li>{!! Form::button('<span class="glyphicon glyphicon-refresh"> Reset</span>',array('class'=>'btn btn-lg btn-warning','type'=>'reset','name'=>'reset')) !!}</li>
                <li><a class="btn btn-primary btn-lg" data-toggle="modal" data-target=".bs-example-modal-sm"><span class="glyphicon glyphicon-print"> Print</span></a></li>
                <li>{!! Form::button('<span class="glyphicon glyphicon-trash"> Delete</span>',array('class'=>'btn btn-lg btn-danger ','type'=>'submit','name'=>'delete')) !!}</li>


            </ul>
        </div>


        <div class="col-md-1">
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div>





    </div><!-- /.box-header -->
    <div class="box-body bg-gray-active">
        <!-- Bill Dislplay here -->

        <div class="row-fluid">
             
             <div class="form-group">
            {!! Form::label ('qty_lbl','Inv_Mode:',['class' =>'control-label col-md-1']) !!}
            <div class="col-md-2">
                <select name="Mode" class="form-control">
                <option value="C">Cash Invoice</option>
                <option value="D">Credit Invoice</option>
            </select>
            </div>
             </div>
            
            <div class="form-group">
            {!! Form::label ('qty_lbl','Inv_No:',['class' =>'control-label col-md-1']) !!}
            <div class="col-md-2">
                {!! Form::text ('Inv_No','',['class'=>'form-control input-sm', 'placeholder'=>'Invoice_No','autofocus']) !!}
            </div>
             </div>
            
           
            
            
            
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>Invoice_No</th>
                        <th>Gross Amount</th>
                        <th>Bill Discount</th>
                        <th>Customer</th>
                        <th>Net Amount</th>
                    </tr>
                </thead>
                
                @foreach($results as $result)
                
                <tr>
                    <td>{{$result->Inv_No}}</td>
                    <td>{{$result->Inv_GrossAmount}}</td>
                    <td>{{$result->Inv_ItemDiscount}}</td>
                    <td>{{$result->Inv_CusCode}}</td>
                    <td>{{$result->Inv_NetAmount}}</td>
                </tr>
                @endforeach
            </table>
            
            {{$results->links()}}
        </div>

        <!-- End Of Bill Display -->
        

        {!! Form::close() !!}   


    </div><!-- /.box-body -->
</div>
<!--box box-success-->



@stop
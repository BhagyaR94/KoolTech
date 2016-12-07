@extends('backend.layouts.app')

@section('content')
{!! Form::open(['class'=>'form-horizontal','url'=>'searchcustomer'])!!}
    
        
        <div class="panel panel-primary">
            <div class="panel-heading">Please Select an Invoice Number to Save</div>
            <div class="panel-body">
                
                
                
                <div class="col-md-12">
                <div class="form-group">

                        {!! Form::label ('invoiceno_lbl','Select Customer:',['class' =>'control-label col-md-3']) !!}

                        <div class="col-md-6">
                            <select  name="cid" class="form-control">
                                @foreach($customers as $customer)
                                    <option value={{$customer->Cus_Code}}>{{$customer->Cus_Code}} - {{$customer->Cus_Name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3"><button class="btn btn-primary btn-block" type="submit"><span class="glyphicon glyphicon-search"> </span> Search</button>
                 </div>
                    </div>
            </div>
                                
                    
               
            </div>
            <div class="panel-footer">

            </div>
        </div>

    {!! Form::close() !!}
    
@stop
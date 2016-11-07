@extends('backend.layouts.app')

@section('content')

    <div class="row-fluid">
        <h2>Invoices</h2>
    </div>

    <!-- New Invoice Starts Here-->

    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="col-md-3"><h3 class="box-title"> New Invoice </h3>
                <h4>{{\Carbon\Carbon::now('Asia/Colombo')}}</h4></div>
            <div class="col-md-8">

                {!! Form::open(['action' => 'Frontend\Invoices\InvoicesController@AddNewInvoice','class'=>'form'])!!}

                <ul class="list-inline">

                    <li>{!! Form::button('<span class="glyphicon glyphicon-floppy-disk"> Save</span>',array('class'=>'btn btn-lg btn-success','type'=>'submit')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-edit"> Modify</span>',array('class'=>'btn btn-lg btn-info','type'=>'submit')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-refresh"> Reset</span>',array('class'=>'btn btn-lg btn-warning','type'=>'reset')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-print"> Print</span>',array('class'=>'btn btn-lg btn-primary','type'=>'reset')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-trash"> Delete</span>',array('class'=>'btn btn-lg btn-danger ','type'=>'reset')) !!}</li>


                </ul>
            </div>
            <div class="col-md-1">
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div><!-- /.box tools -->
            </div>


        </div><!-- /.box-header -->
        <div class="box-body">

            <div class="row-fluid">

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label ('invoiceno','Gross Amount.:',['class' =>'control-label text-primary']) !!}

                        {!! Form::label ('invoiceno','$$$$$:',['class' =>'control-label']) !!}

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label ('invoiceno','Item Discount.:',['class' =>'control-label text-primary']) !!}

                        {!! Form::label ('invoiceno','$$$$$.:',['class' =>'control-label']) !!}

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label ('invoiceno','Dis. Percentage.:',['class' =>'control-label text-primary']) !!}

                        {!! Form::label ('invoiceno','%%%%:',['class' =>'control-label']) !!}

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label ('invoiceno','Net Amount.:',['class' =>'control-label text-primary']) !!}

                        {!! Form::label ('invoiceno','$$$$$.:',['class' =>'control-label']) !!}

                    </div>
                </div>


            </div>

            <hr>


            <div class="form-inline">

                <div class="form-group">

                    {!! Form::label ('invoiceno','Invoice No.:',['class' =>'control-label col-md-3']) !!}

                    {!! Form::text ('invoiceid','',['class'=>'form-control col-md-7', 'placeholder'=>'Invoice Number']) !!}

                </div>

                <div class="form-group">

                    {!! Form::label ('invoiceid','Salesman ID:',['class' =>'control-label col-md-6']) !!}

                    {!! Form::text ('invoiceid','',['class'=>'form-control col-md-4', 'placeholder'=>'SID','size'=>'1']) !!}

                </div>

                <div class="form-group">
                    {!! Form::label ('salesman_name','Salesman Name',['class' =>'control-label col-md-10 text-success']) !!}
                </div>

                <div class="form-group">

                    {!! Form::label ('invoiceid','Customer ID:',['class' =>'control-label col-md-6']) !!}

                    {!! Form::text ('invoiceid','',['class'=>'form-control col-md-4', 'placeholder'=>'CID','size'=>'3']) !!}

                </div>

                <div class="form-group">
                    {!! Form::label ('customer_name','Customer Name',['class' =>'control-label text-success']) !!}
                </div>

            </div>
            <hr>
            <div class="form-inline">
                <div class="form-group">
                    {!! Form::label ('invoiceno','Last Invoice No.:',['class' =>'control-label col-md-6']) !!}

                    {!! Form::label ('invoiceno','Last Invoice No.:',['class' =>'control-label text-warning col-md-6']) !!}

                </div>

                <div class="form-group">
                    {!! Form::label ('invoiceno','Last Bal.:',['class' =>'control-label col-md-6']) !!}

                    {!! Form::label ('invoiceno','Last Bal.:',['class' =>'control-label text-warning col-md-6']) !!}

                </div>
            </div>
            <hr>

            <div class="form-inline">

                <div class="row-fluid">
                    <div class="form-group col-md-2">
                        {!! Form::label ('invoiceno','Product:',['class' =>'control-label ']) !!}

                        {!! Form::text ('invoiceid','',['class'=>'form-control ', 'placeholder'=>'Invoice Number']) !!}

                    </div>

                    <div class="form-group col-md-2">
                        {!! Form::label ('invoiceno','Price:',['class' =>'control-label']) !!}

                        {!! Form::text ('invoiceid','',['class'=>'form-control ', 'placeholder'=>'Invoice Number']) !!}

                    </div>

                    <div class="form-group col-md-2">
                        {!! Form::label ('invoiceno','Dis%:',['class' =>'control-label']) !!}

                        {!! Form::text ('invoiceid','',['class'=>'form-control', 'placeholder'=>'Invoice Number']) !!}

                    </div>
                </div>

                <div class="row-fluid">
                    <div class="form-group col-md-2">
                        {!! Form::label ('invoiceno','Dis Val:',['class' =>'control-label']) !!}

                        {!! Form::text ('invoiceid','',['class'=>'form-control', 'placeholder'=>'Invoice Number']) !!}

                    </div>

                    <div class="form-group col-md-2">
                        {!! Form::label ('invoiceno','Qty:',['class' =>'control-label']) !!}

                        {!! Form::text ('invoiceid','',['class'=>'form-control', 'placeholder'=>'Invoice Number']) !!}

                    </div>

                    <div class="form-group col-md-2">
                        {!! Form::label ('invoiceno','Bil Dis:',['class' =>'control-label']) !!}

                        {!! Form::text ('invoiceid','',['class'=>'form-control ', 'placeholder'=>'Invoice Number']) !!}

                    </div>
                </div>

            </div>



            {!! Form::close() !!}

            <div class="row-fluid">
            <table class="table table-striped">
                <th>
                <td>Product</td>
                <td>Description</td>
                <td>Qty</td>
                <td>Price</td>
                <td>Dis</td>
                <td>DisVal</td>
                <td>Amount</td>
                </th>
            </table>
            </div>
        </div><!-- /.box-body -->
    </div>
    <!--box box-success-->

    <!-- New Invoice Ends Here-->




    <!-- Cancel Invoice Starts Here-->

    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="col-md-3"><h3 class="box-title"> Cancel Invoice </h3>
                <h4>{{\Carbon\Carbon::now('Asia/Colombo')}}</h4></div>
            <div class="col-md-8">
                {!! Form::open(['class'=>'form'])!!}
                <ul class="list-inline">

                    <li>{!! Form::button('<span class="glyphicon glyphicon-floppy-disk"> Save</span>',array('class'=>'btn btn-lg btn-success','type'=>'submit')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-edit"> Modify</span>',array('class'=>'btn btn-lg btn-info','type'=>'submit')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-refresh"> Reset</span>',array('class'=>'btn btn-lg btn-warning','type'=>'reset')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-print"> Print</span>',array('class'=>'btn btn-lg btn-primary','type'=>'reset')) !!}</li>
                    <li>{!! Form::button('<span class="glyphicon glyphicon-trash"> Delete</span>',array('class'=>'btn btn-lg btn-danger ','type'=>'reset')) !!}</li>




                </ul>
            </div>
            <div class="col-md-1">
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div><!-- /.box tools -->
            </div>


        </div><!-- /.box-header -->
        <div class="box-body">

            <div class="row-fluid">

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label ('invoiceno','Gross Amount.:',['class' =>'control-label text-primary']) !!}

                        {!! Form::label ('invoiceno','$$$$$:',['class' =>'control-label']) !!}

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label ('invoiceno','Item Discount.:',['class' =>'control-label text-primary']) !!}

                        {!! Form::label ('invoiceno','$$$$$.:',['class' =>'control-label']) !!}

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label ('invoiceno','Dis. Percentage.:',['class' =>'control-label text-primary']) !!}

                        {!! Form::label ('invoiceno','%%%%:',['class' =>'control-label']) !!}

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label ('invoiceno','Net Amount.:',['class' =>'control-label text-primary']) !!}

                        {!! Form::label ('invoiceno','$$$$$.:',['class' =>'control-label']) !!}

                    </div>
                </div>


            </div>

            <hr>


            <div class="form-inline">

                <div class="form-group">

                    {!! Form::label ('invoiceno','Invoice No.:',['class' =>'control-label col-md-3']) !!}

                    {!! Form::text ('invoiceid','',['class'=>'form-control col-md-7', 'placeholder'=>'Invoice Number']) !!}

                </div>

                <div class="form-group">

                    {!! Form::label ('invoiceid','Salesman ID:',['class' =>'control-label col-md-6']) !!}

                    {!! Form::text ('invoiceid','',['class'=>'form-control col-md-4', 'placeholder'=>'SID','size'=>'1']) !!}

                </div>

                <div class="form-group">
                    {!! Form::label ('salesman_name','Salesman Name',['class' =>'control-label col-md-10 text-success']) !!}
                </div>

                <div class="form-group">

                    {!! Form::label ('invoiceid','Customer ID:',['class' =>'control-label col-md-6']) !!}

                    {!! Form::text ('invoiceid','',['class'=>'form-control col-md-4', 'placeholder'=>'CID','size'=>'3']) !!}

                </div>

                <div class="form-group">
                    {!! Form::label ('customer_name','Customer Name',['class' =>'control-label text-success']) !!}
                </div>

            </div>
            <hr>



            <div class="form-inline">

                <div class="form-group">
                    {!! Form::label ('invoiceno','Last Cancellation:',['class' =>'control-label col-md-6']) !!}

                    {!! Form::label ('invoiceno','Last Cancellation:',['class' =>'control-label col-md-6 text-warning']) !!}

                </div>

                <div class="form-group">
                    {!! Form::label ('invoiceno','Last Invoice No.:',['class' =>'control-label col-md-6']) !!}

                    {!! Form::label ('invoiceno','Last Invoice No.:',['class' =>'control-label text-warning col-md-6']) !!}

                </div>

                <div class="form-group">
                    {!! Form::label ('invoiceno','Last Bal.:',['class' =>'control-label col-md-6']) !!}

                    {!! Form::label ('invoiceno','Last Bal.:',['class' =>'control-label text-warning col-md-6']) !!}

                </div>
            </div>
            <hr>

            <div class="form-group">


                {!! Form::text ('invoiceid','',['class'=>'form-control', 'placeholder'=>'Reason for the Cancellation']) !!}

            </div>



            {!! Form::close() !!}

            <table class="table table-striped">
                <th>
                <td>Product</td>
                <td>Description</td>
                <td>Qty</td>
                <td>Price</td>
                <td>Dis</td>
                <td>DisVal</td>
                <td>Amount</td>
                </th>
            </table>

        </div><!-- /.box-body -->
    </div>
    <!--box box-success-->

    <!-- Cancel Invoice Ends Here-->

    @stop
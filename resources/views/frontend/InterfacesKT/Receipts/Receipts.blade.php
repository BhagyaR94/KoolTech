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
        <h2>Receipts</h2>
    </div>


    <!-- New Invoice Starts Here-->

    <div class="box box-primary">
        <div class="box-header with-border">

            <div class="col-md-2">
                <h3 class="box-title"> New Receipt </h3>
                <h4>{{\Carbon\Carbon::now('Asia/Colombo')}}</h4>
            </div>


            <div class="col-md-9">

                {!! Form::open(['class'=>'form','url'=>'savereceipt'])!!}


                <ul class="list-inline">
                    
                    <li>{!! Form::button('<span class="glyphicon glyphicon-floppy-disk"> Save</span>',array('class'=>'btn btn-lg btn-success','type'=>'submit','name'=>'save')) !!}</li></li>
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
            
            

            <div class="row-fluid">
                <div class="form-inline">

                    <div class="form-group">

                        {!! Form::label ('invoiceno_lbl','Receipt No.:',['class' =>'control-label col-md-3']) !!}

                        {!! Form::number ('ReceiptNo','',['class'=>'form-control col-md-7', 'placeholder'=>'Receipt Number']) !!}

                    </div>

                    <div class="form-group">

                        {!! Form::label ('invoiceno_lbl','Select Customer:',['class' =>'control-label col-md-4']) !!}

                        <div class="col-md-6">
                            <select  name="CustomerID" class="form-control">
                                @foreach($customers as $customer)
                                    <option value={{$customer->Cus_Code}}>{{$customer->Cus_Code}} - {{$customer->Cus_Name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                </div>
            </div>

            <hr>
            <script>
                function disablefunction()
                {
                    document.getElementById("bank").disabled=true;
                    document.getElementById("accno").disabled=true;
                    document.getElementById("chqno").disabled=true;
                }
                
                function enablefunction()
                {
                    document.getElementById("bank").disabled=false;
                    document.getElementById("accno").disabled=false;
                    document.getElementById("chqno").disabled=false;
                }
                </script>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-inline"   style="border-radius:5px; border-style: groove">
                <h4>Payment Type</h4>
                <div class="form-group">
                {!! Form::label ('invoiceno_lbl','Cash:',['class' =>'control-label col-md-5']) !!}
                <div class="col-md-7">
                    {!!Form::radio('PayType', 'CS', false,['class'=>'radio','onclick'=>'disablefunction()'])!!}
                </div>
            </div>
                
                <div class="form-group">
                 {!! Form::label ('invoiceno_lbl','Cheque:',['class' =>'control-label col-md-6']) !!}
                <div class="col-md-6">
                    {!!Form::radio('PayType', 'CH', false,['class'=>'radio','onclick'=>'enablefunction()'])!!}
                </div>
            </div>

            </div>
                </div>
                <div class="col-md-8" >
                    <div class="form-inline" style="border-radius:5px; border-style: groove">
                <h4>Receipt Type</h4>
                <div class="form-group">
                {!! Form::label ('invoiceno_lbl','Advance Payment:',['class' =>'control-label col-md-7']) !!}
                <div class="col-md-1">
                    {!!Form::radio('RecType', 'ADV', true,['class'=>'radio'])!!}
                </div>
            </div>
                
                <div class="form-group">
                 {!! Form::label ('invoiceno_lbl','Credit Settlement:',['class' =>'control-label col-md-6']) !!}
                <div class="col-md-1">
                    {!!Form::radio('RecType', 'SET', false,['class'=>'radio'])!!}
                </div>
            </div>
                
                <div class="form-group">
                 {!! Form::label ('invoiceno_lbl','Other:',['class' =>'control-label col-md-6']) !!}
                <div class="col-md-1">
                    {!!Form::radio('RecType', 'OTH', false,['class'=>'radio'])!!}
                </div>
            </div>

            </div>
                     
                </div>
                
            </div>
            <hr>
            
            
            
           

            <div class="form-horizontal">

                    <div class="form-group">
                        {!! Form::label ('product_lbl','Bank:',['class' =>'control-label col-md-2']) !!}
                        <div class="col-md-4">
                        {!! Form::text ('Bank','',['class'=>'form-control', 'placeholder'=>'BNK' , 'id'=>'bank']) !!}
                        </div>
                    </div>


                    <div class="form-group">
                        {!! Form::label ('AccNO','Account Number',['class' =>'control-label col-md-2']) !!}
                         <div class="col-md-4">
                        {!! Form::text ('AccountNo','',['class'=>'form-control', 'placeholder'=>'Account Number','id'=>'accno']) !!}
                         </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label ('chk','Cheque No.',['class' =>'control-label col-md-2']) !!}
                         <div class="col-md-4">
                        {!! Form::text ('ChequeNo','',['class'=>'form-control','placeholder'=>'Cheque Number','id'=>'chqno']) !!}
                         </div>
                        
                    </div>
                
                    <div class="form-group">
                        {!! Form::label ('chk','Realize Date',['class' =>'control-label col-md-2']) !!}
                         <div class="col-md-4">
                        {!! Form::date ('RealizeDate','',['class'=>'form-control','placeholder'=>'Realize Date']) !!}
                         </div>
                    </div>
                
                <div class="form-group">
                        {!! Form::label ('amnt','Amount',['class' =>'control-label col-md-2']) !!}
                         <div class="col-md-4">
                        {!! Form::text ('Amount','',['class'=>'form-control','placeholder'=>'Amount']) !!}
                         </div>
                    </div>


            </div>

            <hr>
            <div class="row-fluid">
                <div class="form-group">
                {!! Form::label ('invoiceno_lbl','Remarks:',['class' =>'control-label col-md-1']) !!}
                <div class="col-md-8">
                    {!!Form::text('Remarks','',['class'=>'form-control','placeholder'=>'Remarks'])!!}
                </div>
            </div>
            </div>

            {!! Form::close() !!}       

            

            </div>

        </div><!-- /.box-body -->
    </div>
    <!--box box-success-->

    <!-- New Invoice Ends Here-->




    
    
    <script type="text/javascript">
    function selecttosave(e1)
    {
        var inid=document.getElementById(e1);
        var val=inid.options[inid.selectedIndex].value;
        window.location=val;
    }
    </script>
    
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        
        <div class="panel panel-primary">
            <div class="panel-heading">Please Select an Invoice Number to Save</div>
            <div class="panel-body">
 
            </div>
            <div class="panel-footer">
                 <button onclick="selecttosave('saves')" class="btn btn-lg btn-success">Select Invoice</button>
                 
            </div>
        </div>

    </div>
  </div>
</div>

    <!-- Cancel Invoice Ends Here-->

    @stop
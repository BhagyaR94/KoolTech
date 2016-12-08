@extends('backend.layouts.app')

@section('content')

    {!! Form::open(['class'=>'form-horizontal','url'=>'upcustomer'])!!}
    <div class="box box-primary">
        <div class="box-header with-border">

            <div class="col-md-3">
                <h3 class="box-title"> Update Info of a Customer </h3>
                <h4>{{\Carbon\Carbon::now('Asia/Colombo')}}</h4>
            </div>


            <div class="col-md-8">


                <ul class="list-inline">

                    <li>{!! Form::button('<span class="glyphicon glyphicon-floppy-disk"> Save</span>',array('class'=>'btn btn-lg btn-success','type'=>'submit','name'=>'save')) !!}</li>
                    <li><a class="btn btn-info btn-lg" href="updatecustomer"><span class="glyphicon glyphicon-edit"> Modify</span></a></li>
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

       

        </div>
        <div class="box box-body">
            
            <div class="col-md-6">
            <div class="form-group">
                {!! Form::label ('cno','Customer Code:',['class' =>'control-label col-md-5']) !!}
                <div class="col-md-7">
                    {!! Form::text ('CustomerCode',$record->Cus_Code,['class'=>'form-control', 'placeholder'=>'Customer Code', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label ('cnm','Customer Name:',['class' =>'control-label col-md-5']) !!}
                <div class="col-md-7">
                    {!! Form::text ('CustomerName',$record->Cus_Name,['class'=>'form-control', 'placeholder'=>'Customer Name']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label ('cnic','Customer NIC.:',['class' =>'control-label col-md-5']) !!}
                <div class="col-md-7">
                    {!! Form::text ('CustomerNIC',$record->Cus_Nic,['class'=>'form-control', 'placeholder'=>'941211119v']) !!}
                </div>
            </div>
            </div>
            
            <div class="col-md-6">
            <div class="form-group">
                {!! Form::label ('ctel','Telephone:',['class' =>'control-label col-md-5']) !!}
                <div class="col-md-7">
                    {!! Form::text ('Telephone',$record->Cus_Telephone,['class'=>'form-control', 'placeholder'=>'0771234567']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label ('mail','Email:',['class' =>'control-label col-md-5']) !!}
                <div class="col-md-7">
                    {!! Form::email ('Email',$record->Cus_Email,['class'=>'form-control', 'placeholder'=>'Email']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label ('cl','Credit Limit:',['class' =>'control-label col-md-5']) !!}
                <div class="col-md-7">
                    {!! Form::number ('CreditLimit',$record->Cus_CreditLimit,['class'=>'form-control', 'placeholder'=>'Credit Limit']) !!}
                </div>
            </div>
            </div>
            
<hr>
            <div class="form-group">
                {!! Form::label ('ad1','Customer Address1:',['class' =>'control-label col-md-2']) !!}
                <div class="col-md-8">
                    {!! Form::text ('Address1',$record->Cus_Address1,['class'=>'form-control', 'placeholder'=>'Address1']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label ('ad2','Customer Address2:',['class' =>'control-label col-md-2']) !!}
                <div class="col-md-8">
                    {!! Form::text ('Address2',$record->Cus_Address2,['class'=>'form-control', 'placeholder'=>'Address2']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label ('ad3','Customer Address3:',['class' =>'control-label col-md-2']) !!}
                <div class="col-md-8">
                    {!! Form::text ('Address3',$record->Cus_Address3,['class'=>'form-control', 'placeholder'=>'Address3']) !!}
                </div>
            </div>

            

            <div class="form-group">
                {!! Form::label ('rems','Remarks:',['class' =>'control-label col-md-2']) !!}
                <div class="col-md-10">
                    {!! Form::text ('Remarks',$record->Cus_Remark,['class'=>'form-control', 'placeholder'=>'Remarks']) !!}
                </div>
            </div>
<hr>

<div class="row-fluid">
    <div class="col-md-4">
        
        @if($record->Cus_Credit==1)
        {!! Form::label ('invoiceno','Credit:',['class' =>'control-label col-md-3']) !!}
        {!!Form::checkbox('Credit','1',1,['class' =>'form-group col-md-6'])!!}
        @else
        {!! Form::label ('invoiceno','Credit:',['class' =>'control-label col-md-3']) !!}
        {!!Form::checkbox('Credit','1',null,['class' =>'form-group col-md-6'])!!}
        @endif
        
        
    </div>
    <div class="col-md-4">
        @if($record->Cus_Active==1)
        {!! Form::label ('invoiceno','Active:',['class' =>'control-label col-md-3']) !!}
        {!!Form::checkbox('Active','1',1,['class' =>'form-group col-md-6'])!!}
        @else
        {!! Form::label ('invoiceno','Credit:',['class' =>'control-label col-md-3']) !!}
        {!!Form::checkbox('Active','1',null,['class' =>'form-group col-md-6'])!!}
        @endif
    </div>
    <div class="col-md-4">
        @if($record->Cus_OverSales==1)
        {!! Form::label ('invoiceno','Credit:',['class' =>'control-label col-md-3']) !!}
        {!!Form::checkbox('OverSales','1',1,['class' =>'form-group col-md-6'])!!}
        @else
        {!! Form::label ('invoiceno','OverSales:',['class' =>'control-label col-md-3']) !!}
        {!!Form::checkbox('OverSales','1',null,['class' =>'form-group col-md-6'])!!}
        @endif
    </div>
</div>

<div class="row-fluid">
    <div class="col-md-4">
        {!! Form::label ('invoiceno','Sales Amount:',['class' =>'control-label col-md-6']) !!}
        {!! Form::number ('SalesAmount','',['class' =>'form-control col-md-3']) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label ('invoiceno','Outstanding Amount:',['class' =>'control-label col-md-9']) !!}
        {!! Form::number ('OutstandingAmount','',['class' =>'form-control col-md-3']) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label ('invoiceno','Balance Amount:',['class' =>'control-label col-md-6']) !!}
        {!! Form::number ('BalanceAmount','',['class' =>'form-control col-md-3']) !!}
    </div>
</div>


        </div>
        <div class="box-footer"></div>
    </div>
    {!! Form::close() !!}
    
    @stop

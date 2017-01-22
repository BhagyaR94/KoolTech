<?php

namespace App\Http\Controllers\Frontend\Customers;

use \App\Http\Requests\Frontend\Customers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Session;

class CustomerController extends Controller
{
 
    public function customer()
    {
        $customers = DB::table('tblm_customer')->select('Cus_Code','Cus_Name')->get();
        
        return view('Frontend/InterfacesKT/RegCustomer',['customers'=>$customers]);
    }
    
    public function addnewcustomer(Customers\AddCustomer $request)
    {
        $request->only(['CustomerCode','CustomerName','CustomerNIC','Telephone','Email','CreditLimit','Address1','Address2','Address3','Remarks','Credit','Active','Oversales','SalesAmount','OutstandingAmount','BalanceAmount']);
        try
        {
            $credit=$request->Credit;
            $active=$request->Active;
            $oversales=$request->OverSales;
            
            if($request->Credit==null || $request->Credit==""){
                 $credit=0;
            }
            
            else if($request->Active==null || $request->Active="" )
            {
                $active=0;
            
            }
            
            else if($request->OverSales==null || $request->OverSales="")
            {
                $oversales=0;
            }
            
            
            $new_customer=DB::insert('insert into tblm_customer (Cus_Code,Cus_Nic,Cus_Name,Cus_Address1,Cus_Address2,Cus_Address3,Cus_Telephone,Cus_Email,Cus_Credit,Cus_CreditLimit,Cus_Remark,Cus_Active,Cus_OverSales) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',[$request->CustomerCode,$request->CustomerNIC,$request->CustomerName,$request->Address1,$request->Address2,$request->Address3,$request->Telephone,$request->Email,$credit,$request->CreditLimit,$request->Remarks,$active,$oversales]);
            \Session::flash('flash_message','New Customer Has been Successfully Added');
            return redirect('newcustomer');
        } 
        catch (Exception $ex) {
           \Session::flash('flash_message',$ex);
            return redirect('newcustomer');
        }
    }
    
    public function pickcustomer()
    {
        $customers = DB::table('tblm_customer')->select('Cus_Code','Cus_Name')->get();
        return view('Frontend/InterfacesKT/SearchResult',['customers'=>$customers]);
    }
    
    public function search_customer($customercode)
   {   
       $customers = DB::table('tblm_customer')->select('Cus_Code','Cus_Name')->get();
       $record=DB::table('tblm_customer')->where('Cus_Code',$customercode)->first();
       return view('Frontend/InterfacesKT/UpdateCustomer',['customers'=>$customers,'record'=>$record]); 
   }
    
    
    public function updatecustomer(Customers\UpdateCustomer $request)
    {
        
        try
            {
            $credit=$request->Credit;
            $active=$request->Active;
            $oversales=$request->OverSales;
            
            if($request->Credit==null || $request->Credit==""){
                 $credit=0;
            }
            
            else if($request->Active==null || $request->Active="" )
            {
                $active=0;
            }
            
            else if($request->OverSales==null || $request->OverSales="")
            {
                $oversales=0;
            }
        $request->only(['CustomerCode','CustomerName','CustomerNIC','Telephone','Email','CreditLimit','Address1','Address2','Address3','Remarks','Credit','Active','Oversales','SalesAmount','OutstandingAmount','BalanceAmount']);
        $updatestatus=DB::table('tblm_customer')->where('Cus_Code',$request->CustomerCode)->update(['Cus_Nic'=>$request->CustomerNIC,'Cus_Name'=>$request->CustomerName,'Cus_Address1'=>$request->Address1,'Cus_Address2'=>$request->Address2,'Cus_Address3'=>$request->Address3,'Cus_Telephone'=>$request->Telephone,'Cus_Email'=>$request->Email,'Cus_Credit'=>$credit,'Cus_CreditLimit'=>$request->CreditLimit,'Cus_Remark'=>$request->Remarks,'Cus_Active'=>$active,'Cus_OverSales'=>$oversales]);
         return $updatestatus;
            } 
            
            catch (Exception $ex) 
            {
                    return $ex;
            }
    }
    
    public function getcustomer($code)
    {
        
        $cus=DB::table('tblm_customer')->where('Cus_Code',$code)->get();
        
        foreach ($cus as $customer)
        {
            $formatted_record=''.$customer->Cus_Nic.'-'.$customer->Cus_Name.'-'.$customer->Cus_Address1.'-'.$customer->Cus_Address2.'-'.$customer->Cus_Address3.'-'.$customer->Cus_Telephone.'-'.$customer->Cus_Email.'-'.$customer->Cus_Credit.'-'.$customer->Cus_CreditLimit.'-'.$customer->Cus_Discount.'-'.$customer->Cus_Remark.'-'.$customer->Cus_Active.'-'.$customer->Cus_OverSales.'-'.$customer->Cus_Code;
            return $formatted_record;
        }
       
    }
    
}

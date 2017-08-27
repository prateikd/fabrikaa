<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use Session;
use Mail;
use App\User;
use Auth;
use App\Mystate;
use App\Http\Requests\BusinessInfoRequest;
class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   


                     $state =[''=>'Select a State'] + Mystate::orderBy('state','ASC')->lists('state', 'id')->all();
                     $email=Session::get('Email');
                     $contact=Session::get('Contact');
                   
                      $usersinfo=User::where('email',$email)->get();
                      $usersinfocnt=User::where('email',$email)->count();
                      if($usersinfocnt==0)
                      {
                      $usersinfo=User::where('contact',$email)->get();
                      }
                  // return $usersinfo;
                     foreach ($usersinfo as $userData) {
                        $user_id=$userData->id;
                        $confirmation_code =  $userData->confirmation_code;
                    }

                         $users=User::findOrFail($user_id);
                     
                        return view('auth.business_info',compact('state','users'));
                 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $savecontinue= $request->input('savecontinue');
        $savelater= $request->input('savelater');         
       
        if($savecontinue=="savecontinue")
        {
             $this->validate($request, [
                'name'     => 'required',
                'company_name' => 'required',
                'business_nature' => 'required',
                'business_type'     => 'required',
                'address' => 'required',
                'city' => 'required',
                'state'     => 'required'
                // 'pincode' => 'required|integer'
                // 'business_phone' => 'required|integer',   
            ]);
        }
        
        
        $email=Session::get('Email');
        // $users=User::where('email',$email)->findOrFail($id);
        // $users=User::where('email',$email)->get();
        // foreach ($users as $userData) {
        //     $user_id=$userData->id;
        // }
        $users=User::findOrFail($id);

        // return $users;

        $users->name = $request->input('name');
        $users->company_name = $request->input('company_name');
        $users->business_nature = $request->input('business_nature');
        $business_type=$request->input('business_type');
        if($business_type=="Other Business(Specify)")
        {
            $users->business_type = $request->input('other_business');
        }
        else
        {
            $users->business_type = $business_type;
        }

        $users->address = $request->input('address');
        $users->address1 = $request->input('address1');
        $users->address2 = $request->input('address2');
        $users->city = $request->input('city');
        $users->state = $request->input('state');
        $users->pincode = $request->input('pincode');
        $users->business_phone = $request->input('business_phone');
        $users->website = $request->input('website');
        $users->pan_number = $request->input('pan_number');
        // $users->vat_number = $request->input('vat_number');
        // $users->cst_number = $request->input('cst_number');
        $users->gst_number = $request->input('gst_number');
        $users->status = "pending";
        //$users->dob = $request->input('dob');
       // $users->gender = $request->input('gender');
        // return $users->gst_number;


        if($savecontinue=="savecontinue")
        {
            // return $users;
            $users->business_info_status="completed";
        }
        elseif ($savelater=="savelater") {
            // return $users->gst_number;
            if($request->input('name')!="" && $request->input('company_name')!="" &&
                $request->input('business_nature')!="" && $request->input('business_type')!="" &&
                $request->input('address')!="" && $request->input('city')!="" && $request->input('state')!="" && 
                $request->input('pincode')!="" && $request->input('business_phone')!="" &&
                // $request->input('pan_number')!="" && $request->input('vat_number')!="" && $request->input('cst_number')!="")
                $request->input('pan_number')!="" && $request->input('gst_number')!="" && $request->input('cst_number')!="")
                    {
                        $users->business_info_status="completed";
                    }
                    
        }
        

        $users->save();
        if($savecontinue=="savecontinue")
        {
            return redirect('business-document-upload');
        }
        elseif ($savelater=="savelater") {
            Auth::logout();
            return  redirect('/save-and-continue');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // public function upload_document(BusinessuploadRequest $request,$id)
    // {
    //     $random = rand();
    //     $busidproof = $request->file('business_id_proof');
    //     $comidproof = $request->file('owner_id_proof');

    //     $userEdit=User::findOrFail($id);
    //      if($request->hasFile('business_id_proof')) {
    //         $busiidproofname = $busidproof->getClientOriginalName();
    //         $busiidproofname=$random."_busiidproof_".$busiidproofname;
    //         $userEdit->business_id_proof = $busiidproofname;
    //         $busidproof->move(public_path().'/productimg/', $busiidproofname);
    //     }

    //      if($request->hasFile('owner_id_proof')) {
    //         $comidproofname = $comidproof->getClientOriginalName();
    //         $comidproofname=$random."_comidproof_".$comidproofname;
    //         $userEdit->owner_id_proof = $comidproofname;
    //         $comidproof->move(public_path().'/productimg/', $comidproofname);
    //     }
    //     $userEdit->save();
    //     return view('thankYou');
    // }
}

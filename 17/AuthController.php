<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Mail;
use Illuminate\Http\Request;
use Auth;
use Session;
use Redirect;
use Socialite;
use URL;
use Flash;
//use Session;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    protected $loginPath = '/AR78Tqr6f/1gd34gf/h5dm6x/login';
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/AR78Tqr6f/1gd34gf/h5dm6x/category';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         //$this->redirectTo = URL::previous();
        
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
               'email' => 'unique:users',
               'contact' => 'unique:users',
            // 'email' => 'required|email|max:255|unique:users',
            // 'password' => 'required|min:6',
            // 'contact' => 'required|regex:/[0-9]{9}/',
        ]);

      
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        Session::put('regiEmail', $data['email']);
        Session::put('Email', $data['email']);
        Session::put('regiContact', $data['contact']);
        Session::put('Contact', $data['contact']);
        Session::put('Countrycode', $data['country_code']);
        Session::put('Usertype', $data['user_type']);

        Session::put('Password', bcrypt($data['password']));
    

        if($data['user_type']=="superadmin")
        {
            $user=User::create([
          //  'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'user_type' => $data['user_type'],
            ]);
            return $user;
        }
        else if($data['user_type']=="client")
        {
            $otp = mt_rand(100000, 999999);
            $confirmation_code = str_random(30);
            Session::put('Otp', $otp);
            Session::put('Confirmationcode', $confirmation_code);

             // For Mail
            $datacode = array('confirmation_code' => $confirmation_code, 'email' => $data['email']);

            // Mail::send('auth.verify', $datacode, function ($msg) use ($data) {
            //     $msg->to($data['email'], 'Customer')->subject('Verification link for your Fabrikaa registration');
            //     $msg->from('info@fabrikaa.com', 'Fabrikaa');
            // });

                // $usercode = User::orderBy('created_at', 'desc')->first();
                // if($usercode=="")
                // {
                //     $clientcode= "FB00011"."_".'1';
                   
                // }
                // else
                // {
                //     $insertedId =substr($usercode->client_code,8,11);
                //     $i=$insertedId + 01;
                   
                //     $clientcode="FB00011"."_".$i;
                    
                // }

           //  $user= User::create([
           // // 'name' => $data['name'],
           //  'email' => $data['email'],
           //  'contact' => $data['contact'],
           //  'password' => bcrypt($data['password']),
           //  'country_code' =>$data['country_code'],
           //  'user_type' => $data['user_type'],
           //  'confirmation_code' => $confirmation_code,
           //  'client_code' => $clientcode,
           //  'otp' => $otp,
           //  'status' => "pending",
           //  ]);

           // Account details
          
            $username = "jaskaran@krishnile.com";
            $hash = "339092e19234aa88dd0cf6a348533e06cf6042fa073c6402ae0c5c07616fad92";

            $test = "0";
            // Message details
            
            $sender = 'FBRIKA';
         
            $numbers = "91".$data['contact'];
            $message ="Dear Customer, Your OTP for Fabrikaa is $otp. OTP is Confidential. Please do not share this with anyone. Thank you Fabrikaa.";
                       
            
         
           
            $message = urlencode($message);
            // Prepare data for POST request
            $data1 = array('username' => $username, 'hash' => $hash, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
    
            // Send the POST request with cURL
            $ch = curl_init('http://api.textlocal.in/send/?');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            
            // Process your response here
            echo $response;

          
          // return $user;

        }
    }

    public function confirm($confirmation_code)
    {
        
        if(!$confirmation_code)
        {
            throw new InvalidConfirmationCodeException;

            //call here somethig went wrong contact to the info@fabrikaa.com
        }

        $user = User::whereConfirmationCode($confirmation_code)->first();
        // return $user;

        if (!$user)
        {
            throw new InvalidConfirmationCodeException;
            //call here somethig went wrong contact to the info@fabrikaa.com
        }

        // $user->confirmed = 1;
        $user->confirmation_code = $confirmation_code;
        $user->save();


        Session::put('step_1', $confirmation_code);
        $step_1=Session::get('step_1');
        // return $step_1;

        

        $dataUser = array('user' => $user);

        Mail::send('sendmail.confirmedmail', $dataUser, function ($msg) use ($user) {
            $msg->to($user->email, $user->email, 'info@fabrikaa.com')->subject('Welcome to Fabrikaa.com!');

            $msg->from('info@fabrikaa.com', 'fabrikaa.com');

        });

        // Flash::message('You have successfully verified your email.');
       
       return view('auth.signin');
        // return redirect('business-information');
    }

    public function postRegister(Request $request)
    {
        return $this->register($request);
    }

  
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator

           );
        }

        //Auth::guard($this->getGuard())->login($this->create($request->all()));
        $this->create($request->all());
        Auth::logout();
        //session_destroy(Auth::user());    
        return redirect('/thank-you-for-verification');
    }

    public function redirectToProvider()
    {
        
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
            //retrieve user's information from facebook
            $user  = Socialite::driver('facebook')->user();

            //check user already exists in db
            $users = User::where('email', $user->getEmail())->first();
            if($users) {
                // if exist, log user into your application
                //  and redirect to any path you want
                Auth::login($users);
                return redirect()->to('/');
            }

            //if not exist, create new user, 
            // log user into your application 
            // and resirect to any path you want
            $users = new User ;
            $users->email = $user->getEmail();
            $users->name = $user->getName();
            $users->confirmed = 1;
            // $user->email = $user->getEmail();
            $users->save();
            Auth::login($users); // login user
            return redirect()->to('/'); // redirect
    }

    public function authenticateUser(Request $request)
    {
        // echo("<pre>");
        // print_r($_POST);
        // die;
        $domain = "@fabrikaa.com";
         $email = $request->input('email');
         // $domain = $request->input('domain');
         $password = $request->input('password');
         $remember = $request->has('remember') ? true : false; 

         $user_type = $request->input('user_type');
         //$remember=(integer)$remember;

         //'confirmed' => 1;
  
         Session::put('Email', $email);
         if($user_type=="superadmin")
         {
            $email1= $email."".$domain;
            // echo("<pre>");
            // print_r($email1);
            // die;

            if(Auth::attempt(['email' => $email1, 'password' => $password, 'user_type' => 'superadmin']))
            {
                // return redirect('/category');
                // return "here";
                return redirect('/AR78Tqr6f/1gd34gf/h5dm6x/category');
            }
            else
            {
               Session::flash('message', 'Email id and Password does not match.');
                return view('auth.login');
            }
         }
    
         //if client start
        if($user_type=="client")
        {
            if(Auth::attempt(['email' => $email, 'password' => $password, 'user_type' => 'client','confirmed'=>'1'],$remember))
            {

                if(Auth::attempt(['email' => $email, 'password' => $password, 'business_info_status' => 'completed','user_type' => 'client','confirmed'=>'1'],$remember))
                {   
                    if(Auth::attempt(['email' => $email, 'password' => $password, 'business_doc_status' => 'completed','user_type' => 'client','confirmed'=>'1'],$remember))
                    {   
                        if(Auth::attempt(['email' => $email, 'password' => $password, 'status' => 'approved', 'user_type' => 'client','confirmed'=>'1'],$remember))
                        {
                                //return "approved";

                            //     if (Session::get('redirecturl') == 'http://fabrikaa.com/' || Session::get('redirecturl') == 'http://fabrikaa.com/undefined' || Session::get('redirecturl') == 'http://fabrikaa.com' || Session::get('redirecturl')!='http://fabrikaa.com/register') {
                            //        // return "false";
                            if(Session::get('redirecturl') =='http://fabrikaa.com/register/' || Session::get('redirecturl') =='http://fabrikaa.com/Login/') 
                            {
                                return redirect('/');        
                            }else{
                                    //return "true";
                                    return redirect(Session::get('redirecturl'));
                                      //return Redirect::to('http://fabrikaa.com/Single-Product/Polos/ABCD/POABCD');
                                }
                        }
                        else
                        {
                            //return " not approved";
                             Auth::logout();
                             Session::flash('message', 'Your account is pending for approval.');
                             return view('auth.signin');
                        }

                    }
                    else
                    {
                       // return "pls upload business doc";
                       // Auth::logout();
                        // return  $email;
                       return redirect('/business-document-upload');
                    }

            }
            else
            {
                
                if(Auth::attempt(['email' => $email, 'password' => $password, 'status' => 'Rejected', 'user_type' => 'client','confirmed'=>'1'],$remember))
                {
                     Auth::logout();
                     Session::flash('reject_message', 'your request has been rejected because of lack of information or document click here to apply again.');
                     return view('auth.signin');
                }
                else
                {
                    // return "pls fill business info";
                    //Auth::logout();
                    // return  $request->input('email');
                    return redirect('/business-information');
                }
               
            }

        }
      //for mobile number login
        elseif(Auth::attempt(['contact' => $email, 'password' => $password, 'user_type' => 'client','confirmed'=>'1'],$remember))
        {
        if(Auth::attempt(['contact' => $email, 'password' => $password, 'business_info_status' => 'completed','user_type' => 'client','confirmed'=>'1'],$remember))
            {   
                    if(Auth::attempt(['contact' => $email, 'password' => $password, 'business_doc_status' => 'completed','user_type' => 'client','confirmed'=>'1'],$remember))
                    {   
                         if(Auth::attempt(['contact' => $email, 'password' => $password, 'status' => 'approved', 'user_type' => 'client','confirmed'=>'1'],$remember))
                            {
                                //return "approved";

                                if (URL::previous() == 'http://fabrikaa.com/' || URL::previous() == 'http://fabrikaa.com/undefined' ||URL::previous() == 'http://fabrikaa.com' ) {

                                return redirect('/');
                                
                            }else{

                                return redirect(Session::get('redirecturl'));
                              //return Redirect::to('http://fabrikaa.com/Single-Product/Polos/ABCD/POABCD');
                            }
                        }
                        else
                        {
                            //return " not approved";
                             Auth::logout();
                             Session::flash('message', 'Your account is pending for approval.');
                             return view('auth.signin');
                        }

                    }
                    else
                    {
                       // return "pls upload business doc";
                       // Auth::logout();
                        // return  $email;
                       return redirect('/business-document-upload');
                    }

            }
            else
            {
                if(Auth::attempt(['contact' => $email, 'password' => $password, 'status' => 'Rejected', 'user_type' => 'client','confirmed'=>'1'],$remember))
                {
                     Auth::logout();
                     Session::flash('reject_message', 'your request has been rejected because of lack of information or document click here to apply again.');
                     return view('auth.signin');
                }
                else
                {
                    // return "pls fill business info";
                   // Auth::logout();
                    // return  $request->input('email');
                    return redirect('/business-information');
                }
               
            }

         }

        else
        {
             Auth::logout();
            Session::flash('message', 'Email id and Password does not match.');
            return view('auth.signin');
        }
    }//if client end
}

}

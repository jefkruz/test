<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use ZEGO\ZegoServerAssistant;
use ZEGO\ZegoErrorCodes;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    //


    public function index()
    {
        $data['page_title']= 'TV';

        return view('home',$data);
    }
    public function test($room)
    {
    //dd(session('tv'));

       $data['room'] = $room;
       $data['name']= Auth::user()->username;
       $data['id']= Auth::user()->id;

        return view('welcome', $data);
    }

    public function tv()
    {

        $data['page_title']= 'TV';

        return view('tv.index',$data);
    }


    public function room(Request $request)
    {

      $request->validate([

            'name' => 'required',

        ]);

      //  dd($request->name);
         $newrout = "test/$request->name";
        return redirect()->to($newrout);;
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',

        ]);
        $user_exist = User::where('username',$request->username) ->first();


        if ($user_exist) {
          if(\Auth::attempt(array('username' => $request->username, 'password' => '12345678'))){
            $request = Auth::user();
            return   redirect()->intended($this->redirectPath());


        }
        }
        else{


              $userData = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make('12345678'),
        ];

        $user = User::create($userData);
        $token = $user->createToken('forumapp')->plainTextToken;
            session()->put('tv', $user);
             return   redirect()->intended($this->redirectPath());
        }

    }


    public function authTv()
    {
        $authenticated = session('tv') ? true : false;
        return response(['auth'=>$authenticated]);

    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('tv');
    }


    public function authorizekc(Request $request)
    {
        $accessToken = $request->accessToken;

        //FETCH USER PROFILE FROM KC
        $profile = $this->fetchKcProfile($accessToken)->profile;
//      dd($profile);
        //SAVE NAME & EMAIL FROM PROFILE
        $name = $profile->user->name;
        $email = $profile->email->address;
        $username= $profile->user->username;

        $verified = User::where('email', $email)->first();

        if($verified){
            $verified->token = md5(time(). uniqid());
            $verified->save();
            return redirect()->route('admin.login',$verified->token);

        } else {
            $participant= new User();
            $participant->name = $name;
            $participant->email = $email;
            $participant->username = $username;
            $participant->password = Hash::make('123456');
            $participant->token = md5(time(). uniqid());
            $participant->save();
            return redirect()->route('admin.login',$participant->token);

        }

    }

    private function fetchKcProfile($accessToken)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://connect.kingsch.at/api/profile',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $accessToken
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);

    }
}


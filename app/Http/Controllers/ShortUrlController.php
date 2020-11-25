<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrlModel;

class ShortUrlController extends Controller
{
    public function CodeRedirect(Request $request){
        $code = $request->code;
        $check = ShortUrlModel::where("short_link" , $code)->first();
        if(!empty($check)){
            $check->count_open = ($check->count_open + 1) ;

            if($check->save()){
                if (preg_match('/http/', $check->full_link) == 1) {
                    return redirect($check->full_link);
                } else {
                    return redirect("//".$check->full_link);
                }
            }

        }else{
            return redirect("/");
        }
    }

    public function Add_ShortUrl(Request $request){
        $link = $request->link;
        $explode_link = explode(".",$link);
        if(count($explode_link) >= 2){
            $short_url = CreateNewUrl($link);
            return json_encode( ['status' => 'success', 'message' => $short_url] );
        }else{
            return json_encode( ['status' => 'error', 'message' => 'ขออภัยลิงค์ของคุณไม่ถูกต้อง'] );
        }
    }

    public function getAll_URL(){
        $data = ShortUrlModel::get();
        return view('allurl' , ['data' => $data]);
    }

    public function getDetail(Request $request){
        $code = $request->code;
        $data = ShortUrlModel::where("short_link" , $code)->first();
        return $data;
    }

}

function RandomString($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function CreateNewUrl($link)
{
    $code = RandomString(7);
    //id, short_link, full_link, created_at, updated_at
    while(true){
        $check = ShortUrlModel::where("short_link",$code)->first();
        if(!empty($check)){
            $code = RandomString(7);
        }else{
            break;
        }
    }
    $short_model = new ShortUrlModel();
    $short_model->short_link = $code;
    $short_model->full_link = $link;
    $short_model->save();
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"."/".$code;
    return $actual_link;
}

<?php

namespace App\Http\Controllers\User;

use App\Model\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
    public function login(Request $request){
        if($request->isMethod('get')){
            $url = $request->input('url');
            $data = [
                'url' => $url
            ];
            return view('user.login',$data);
        }else {
            $username = $request->input('username');
            $password = $request->input('password');

            $u1 = UserModel::where(['name' => $username])->first();
            if (!$u1) {
                $reponse = [
                    'error' => '40003',
                    'msg' => '用户名不存在'
                ];
                return $reponse;
            }
            $where = [
                'name' => $username,
                'pwd' => $password
            ];
            $u = UserModel::where($where)->first();
            if($u){
                $token = substr(md5(time() . mt_rand(1, 19990)), 6, 10);
                setcookie('uid' , $u['uid'] , time()+86400 , '/' , 'cms.com' , false , true);
                setcookie('token' , $token , time()+86400 , '/' , 'cms.com' , false , true);
                Redis::del('token:'.$u['uid']);
                Redis::hSet('token:'.$u['uid'] , 'web' , $token);
                //Redis::hdel('');
                //Redis::set('str:u:token:web:'.$u['uid'] , $token);
                $request->session()->put('uid' , $u['uid']);
                $request->session()->put('u_token' , $token);
                $reponse = [
                    'error' => '0',
                    'msg' => '登陆成功'
                ];
            }else{
                $reponse = [
                    'error' => '40004',
                    'msg' => '用户名或密码错误'
                ];
            }
            return $reponse;
        }
    }

    public function home(){
        return view('user.home');
    }

    public function phonLogin(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');

        $u1 = UserModel::where(['name' => $username])->first();
        if (!$u1) {
            $reponse = [
                'error' => '40003',
                'msg' => '用户名不存在'
            ];
            return $reponse;
        }
        $where = [
            'name' => $username,
            'pwd' => $password
        ];
        $u = UserModel::where($where)->first();
        if($u){
            $token = substr(md5(time() . mt_rand(1, 19990)), 6, 10);
            Redis::del('token:'.$u['uid']);
            Redis::hSet('token:'.$u['uid'] , 'app' , $token);
            $reponse = [
                'error' => '0',
                'msg' => '登陆成功',
                'token' => $token
            ];
        }else{
            $reponse = [
                'error' => '40004',
                'msg' => '用户名或密码错误'
            ];
        }
        return $reponse;
    }
}

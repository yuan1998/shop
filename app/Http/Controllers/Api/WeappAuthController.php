<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\WeappAuthorizationRequest;
use App\Models\User;
use Auth;


class WeappAuthController extends Controller
{

    public function weappStore (WeappAuthorizationRequest $request)
    {
        $data = $this->checkCode($request->code);

        // 找到 openid 对应的用户
        $user = User::where('openid', $data['openid'])->first();

        $attributes['access_token'] = $data['session_key'];

        // 未找到对应用户则需要提交用户名密码进行用户绑定
        if (!$user) {

            if(empty($request->userInfo))
                return $this->response->errorForbidden('用户不存在');

            $uf = $request->userInfo;
            $att = [
                'wx_name' =>$uf['nickName'],
                'avatar' => $uf['avatarUrl'],
                'gender' => $uf['gender'],
                'openid' => $data['openid']
            ];
            $user = User::create($att);
        }

        // 更新用户数据
        $user->update($attributes);

        // 为对应用户创建 JWT
        $token = Auth::guard('api')->fromUser($user);

        return $this->respondWithToken($token)->setStatusCode(201);
    }


    public function checkCode ($code)
    {

        // 根据 code 获取微信 openid 和 session_key
        $miniProgram = \EasyWeChat::miniProgram();
        $data = $miniProgram->auth->session($code);

        // 如果结果错误，说明 code 已过期或不正确，返回 401 错误
        if (isset($data['errcode'])) {
            return $this->response->errorUnauthorized('code 不正确');
        }

        return $data;
    }


    public function check (WeappAuthorizationRequest $request)
    {
        $data = $this->checkCode($request->code);

        $user = User::where('openid',$data['openid'])->first();

        if(!$user) {
            $att = [
                'openid' => $data['openid'],
            ];

            $user = User::create($att);
        }

        // 为对应用户创建 JWT
        $token = \Auth::guard('api')->fromUser($user);

        return $this->respondWithToken($token)->setStatusCode(201);
    }


    public function respondWithToken($token) {
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }

}

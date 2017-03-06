<?php
/**
 * OA办公系统-后台登录功能模块
 * ====================================================
 * 众达网络科技有限公司 
 * ====================================================
 * $ Id: Login.php 2017/3/2 11:00 zdwl_cp $
 */

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\Request;

class Login extends Controller {

	/**
	 * [后台首页]
	 * @return [type] [description]
	 */
    public function index() {
        
        // 登录成功跳转后台首页
        if (Session::has('userinfo')) {
            $this->redirect('index/index');
        }

        return $this->fetch();
    }

    /**
     * [用户登录操作]
     * @return [json] []
     */
    public function login() {
    	
        // 数据验证
        if (request() -> isPost()) {
            
            $user_name = input ('post.user_name');
            $password  = input ('post.password');
            $captcha   = input ('post.captcha');

            if (!$user_name || !$password) {
                exit(json_encode(array('status' => 0, 'msg' => '用户名和密码不能为空')));
            }

            if (!captcha_check($captcha)) {
                exit(json_encode(array('status' => 0, 'msg' => '请输入正确的验证码')));
            }

            // 查找用户信息
            $userinfo = Db::name('user') -> where('user_name', $user_name) -> find();

            if (!$userinfo || $password != $userinfo['password']) {
                exit(json_encode(array('status' => 0, 'msg' => '用户名或密码错误，请重新输入')));
            }

            // TODO 写入日志
            
            // 登录成功，存入Session
            Session::set('userinfo', ['user_name' => $user_name, 'id' => $userinfo['id'], 'login_time' => time()]);
            exit(json_encode(array('status' => 1, 'msg' => '登录成功', 'url' => url('index/index'))));
        }

    }

    /**
     * [用户退出操作]
     * @return [type] [description]
     */
    public function logout() {
        Session::clear();
        $this->redirect('login/index');
        // exit(json_encode(array('status' => 1, 'msg' => '退出成功')));
    }


}
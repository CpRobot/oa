<?php
/**
 * OA办公系统-公共文件
 * ====================================================
 * 众达网络科技有限公司 
 * ====================================================
 * $ Id: Common.php 2017/3/2 11:00 zdwl_cp $
 */

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Session;

class Common extends Controller
{
	/**
	 * [构造函数]
	 */
    function __construct() {
    	parent::__construct();
    	// 验证是否登录
    	$this->checkLogin();
    }

    /**
     * [验证是否登录]
     * @return [null]
     */
    protected function checkLogin() {

    	// 验证是否登录成功
    	if (!Session::has('userinfo') || $uname = Session::get('userinfo.user_name')) {
    		$this->redirect('login/index');
    	}
    	// 登录是否过期，无操作1h即过期
    	$login_time = Session::get('userinfo.login_time');
    	if (time() - $login_time > 3600) {
    		Session::clear();
    		$this->redirect('login/index');
    	}
    	// 用户操作，更新用户登录时间
    	Session::set('userinfo.login_time', time());
    }

}
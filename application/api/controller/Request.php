<?php
/**
 * OA办公系统-API接口模块
 * ====================================================
 * 众达网络科技有限公司 
 * ====================================================
 * $ Id: Request.php 2017/3/3 17:00 zdwl_cp $
 */

namespace app\api\controller;

use think\Controller;

class Request extends Controller {

	/**
	 * index
	 */
    public function index() {

    	echo 'This is Request Index!';
       
    }

    /**
     * 登录接口
     * @return [type] [description]
     */
    public function login() {

    }

    public function logout() {

    }

    /**
     * 获得用户信息
     * @return [type] [description]
     */
    public function getUserInfo() {
    	echo 'userinfo';
    }

    /**
     * 获得公告信息
     * @return [type] [description]
     */
    public function getNotice() {

    }

}
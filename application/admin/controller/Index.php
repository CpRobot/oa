<?php
/**
 * OA办公系统-后台首页管理模块
 * ====================================================
 * 众达网络科技有限公司 
 * ====================================================
 * $ Id: Index.php 2017/3/2 11:00 zdwl_cp $
 */

namespace app\admin\controller;

use think\Db;
use think\Session;

class Index extends Common {

	/**
	 * [后台首页]
	 * @return [] [首页]
	 */
    public function index() {

        return $this->fetch();
    }

    /**
     * 签到操作
     */
    public function signIn() {
    	$uid = Session::get('userinfo.id');

    	// 判断今天是否已签到
    	if (!$this->checkSignIn($uid)) {
    		exit(json_encode(array('status' => 0, 'msg' => '今天已经签到过了！')));
    	} else {
    		$sucess_msg = '签到成功';
    		$data = [
    			'uid' => $uid,
    			'action' => 'sign_in',
    			'note' => $sucess_msg,
    			'login_ip' => get_client_ip(),
    			'addtime' => date('Y-m-d H:i:s', time())
    		];
    		$flag = Db::name('log') -> insert($data);
    		if ($flag) {
    			exit(json_encode(array('status' => 1, 'msg' => $sucess_msg)));
    		} else {
    			exit(json_encode(array('status' => 0, 'msg' => "签到失败，请稍候再试！")));
    		}
    	}
    }



    protected function checkSignIn($uid) {
    	return Db::name('log') -> where('id', $uid) -> whereTime('addtime', 'today') -> count();
    }
}
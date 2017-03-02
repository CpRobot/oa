<?php
/**
 * OA办公系统-后台首页管理模块
 * ====================================================
 * 众达网络科技有限公司 
 * ====================================================
 * $ Id: Index.php 2017/3/2 11:00 zdwl_cp $
 */

namespace app\admin\controller;

class Index extends Common {

	/**
	 * [后台首页]
	 * @return [] [首页]
	 */
    public function index() {

        return $this->fetch();
    }




}
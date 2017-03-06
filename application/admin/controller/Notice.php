<?php
/**
 * OA办公系统-后台公告管理功能模块
 * ====================================================
 * 众达网络科技有限公司 
 * ====================================================
 * $ Id: Notice.php 2017/3/3 15:00 zdwl_cp $
 */

namespace app\admin\controller;

use think\Request;
use think\Db;

class Notice extends Common {

	/**
	 * [初始化函数]
	 * @return [type] [description]
	 */
	protected function _initialize() {
		// 定义分页页数
		$this->pagesize = 2;
	}

	/**
	 * [公告列表信息]
	 * @return [type] [description]
	 */
	public function index() {
		// 分页处理
		// 每页显示10条数据
		$list = Db::name('info') -> where('1 = 1') -> paginate($this->pagesize);
		$page = $list -> render();
		// 模版变量赋值
		$this->assign('list', $list);
		$this->assign('page', $page);
		// 渲染模版输出
		return $this->fetch();
	}

	public function add() {
		// 数据验证
		if (request()->isPost()) {
			
			$title   = input ('post.title');
			$content = input ('post.content');

		}
	}

	public function eidt() {

	}

	/**
	 * [信息删除操作]
	 * @return [type] [description]
	 */
	public function del() {
		$del_id = input('post.id');
		$flag = Db::name('info') -> where('id', $del_id) -> delete();
		if ($flag) {
			exit(json_encode(array('status' => 1, 'msg' => '信息删除成功！')));
		}
	}

}
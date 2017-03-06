<?php
/**
 * OA办公系统-后台用户管理功能模块
 * ====================================================
 * 众达网络科技有限公司 
 * ====================================================
 * $ Id: User.php 2017/3/3 16:00 zdwl_cp $
 */

namespace app\admin\controller;

use think\Request;
use think\Db;

class User extends Common {

	/**
	 * [初始化函数]
	 * @return [type] [description]
	 */
	protected function _initialize() {
		$this->pagesize = 10;
	}

	/**
	 * [用户列表显示]
	 * @return [type] [description]
	 */
	public function index() {
		// 分页处理
		// 每页显示10条数据
		$list = Db::name('user') -> where('1 = 1') -> order('sort ASC') -> paginate($this->pagesize);
		$page = $list -> render();
		// 模版变量赋值
		$this->assign('list', $list);
		$this->assign('page', $page);
		// 渲染模版输出
		return $this->fetch();
	}

	/**
	 * 添加用户操作
	 */
	public function add() {
		// TODO 权限判定
		// 数据验证
		if (request()->isPost()) {
			
			$params = input ('post.');
			// 数据处理
			$data = [

			];
			// 验证规则
			$validate = Loader::validate('User');
			if (!$validate -> check($data)) {
				$error = $validate -> getError();
				exit(json_encode(array('status' => '0', 'msg' => $error)));
			}
			// 添加数据
			$flag = $flag = Db::name('user') -> insert($data);
			if ($flag) {
				// TODO Log日志
				exit(json_encode(array('status' => '1', '添加成功')));
			} else {
				exit(json_encode(array('status' => '0', '添加失败，请稍后再试')));
			}
		}
	}

	/**
	 * 编辑用户操作
	 * @return [type] [description]
	 */
	public function edit() {
		// TODO 权限判定
		// 数据验证
		if (request()->isPost()) {
			
			$params = input ('post.');
			// 数据处理
			$data = [

			];
			// 验证规则
			$validate = Loader::validate('User');
			if (!$validate -> check($data)) {
				$error = $validate -> getError();
				exit(json_encode(array('status' => '0', 'msg' => $error)));
			}
			// 编辑数据
			$flag = Db::name('user') -> where('id', $params['id']) -> update($data);
			if ($flag) {
				// TODO Log日志
				exit(json_encode(array('status' => '1', '编辑成功')));
			} else {
				exit(json_encode(array('status' => '0', '编辑失败，请稍后再试')));
			}
		}

	}

	/**
	 * 删除用户
	 * @return [type] [description]
	 */
	public function del() {
		$id = input ('post.id');
		// TODO 权限判定
		$flag = Db::name('user') -> where('id', $id) -> delete();
		if ($flag) {
			// TODO Log日志
			exit(json_encode(array('status' => '1', 'msg' => '数据删除成功')));
		} else {
			exit(json_encode(array('status' => '0', 'msg' => '数据删除失败，请稍候再试')));
		}
	}


}
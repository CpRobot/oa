<?php

$root = request() -> root();
define('__ROOT__', str_replace('/index.php', '', $root));
return [
	'view_replace_str' => [
		'__PUBLIC__' => __ROOT__.'/public/static'
	],
];
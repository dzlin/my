<?php
use module\common\model\PermissionModel;

/**
 * 必须的文件
 */
require '../../init.php';
/**
 * 权限操作模型
 *
 * @var unknown
 */
$permissionModel = new PermissionModel();
// 列出所有的从操作
$permissions = $permissionModel->getAllPermission();

$pageTitle = '权限操作列表';

?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<title><?php echo $pageTitle;?>></title>
<style type="text/css">
td {
	padding: 10px 20px;
	border-top:1px solid #dedede;
	text-align: center;
}
</style>
</head>

<body>
	<h1>操作列表</h1>
	<hr />
	<table cellspacing="0" cellpadding="0">
		<tr>
			<th>OID</th>
			<th>名称</th>
			<th>编码</th>
			<th>PID</th>
			<th>操作</th>
		</tr>
<?php

if (! empty($permissions)) {
    foreach ($permissions as $v) {
        ?>
		<tr>
			<td><?php echo $v['oid']?></td>
			<td><?php echo $v['operation']?></td>
			<td><?php echo $v['code']?></td>
			<td><?php echo $v['pid']?></td>
			<td><a href="editPermission.php?oid=<?php echo $v['oid']?>">编辑</a> <a
				href="deletePermission.php?oid=<?php echo $v['oid']?>">删除</a></td>
		</tr>
<?php } }?>
	</table>
</body>

</html>
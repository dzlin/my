<?php
use system\utils\Web;
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

// 提交添加
if (isset($_POST['submit']) && Web::isPost()) {
    /**
     * TODO 做数据检查
     */
    $pid = isset($_POST['pid']) ? $_POST['pid'] : 0;
    $result = $permissionModel->addPermission($_POST['operation'], $_POST['code'], $pid);
    // var_dump($result);
    header('location:addPermission.php');
} else {
    // 列出所有的从操作
    $permissions = $permissionModel->getAllPermission();
}
?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<title>添加权限操作</title>
</head>

<body>

	<h1>添加操作</h1>

	<hr />

	<form action="addPermission.php" method="post">
		<p>
			<span id=""> 名称： </span> <input type="text" name="operation" id=""
				value="" />
		</p>
		<p>
			<span id=""> 编码： </span> <input type="text" name="code" id=""
				value="" />
		</p>
		<p>
			<span id=""> 父级操作： </span> <select name="pid">
				<option value="0">顶级操作</option>
<?php
if (! empty($permissions))
    foreach ($permissions as $k => $v)
        echo '<option value="' . $v['oid'] . '">' . $v['operation'] . '</option>';
?>
			</select>
		</p>
		<input type="submit" name="submit" value="OK" />
	</form>

</body>

</html>
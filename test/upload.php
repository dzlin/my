<?php
require '../init.php';
/**
 * 上传处理
 */
if (isset($_POST['submit'])) {
	$config = array(
		'maxSize' => 3145728,
		'rootPath' => UPLOADS . '/',
		'savePath' => '',
		'saveName' => array('uniqid', ''),
		'exts' => array('jpg', 'gif', 'png', 'jpeg'),
		'autoSub' => true,
		'subName' => array('date', 'Ymd'),
	);

	$upload = new \system\core\Upload($config);

	$info = $upload->upload();

	if (!$info) {// 上传错误提示错误信息
		$this->error($upload->getError());
	} else {// 上传成功 获取上传文件信息
		foreach ($info as $file) {
			echo $file['savepath'] . $file['savename'];
		}
	}
}
$pageTitle = '测试文件上传';
?>
<!DOCTYPE html>
<html lang="zh_CN">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pageTitle; ?></title>
    </head>
    <body>
        <form action="" enctype="multipart/form-data" method="post" >
			<input type="text" name="name" />
			<input type="file" name="photo" />
			<input type="submit" name="submit" value="提交" id="upload">
		</form>
    </body>
	<script src="../static/js/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript">
        $(function () {
			$('#upload').click(function(){
				
			});
        });
	</script>
</html>



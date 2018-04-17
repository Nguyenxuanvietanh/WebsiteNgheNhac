<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $this->_title; ?></title>
<meta charset="utf-8" />
<?php echo $this->_metaHTTP;?>
<?php echo $this->_metaName;?>
<?php echo $this->_cssFiles; ?>
<?php echo $this->_jsFiles; ?>
<?php
	echo '<script type="text/javascript" src="/WebsiteNgheNhac/public/template/admin/main/ckeditor/ckeditor.js"></script>';
?>

</head>
<body class="app">

		<?php include_once 'html/header.php'; ?>

		<main class="main-content bgc-grey-100">
		<?php
			require_once MODULE_PATH. $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
		?>
		</main>

		<?php include_once 'html/footer.php'; ?>
	</div>
</div>
</body>

</html>



<!DOCTYPE html>
<head>
  	<?php echo $this->_metaHTTP;?>
    <?php echo $this->_metaName;?>
    <?php echo $this->_title;?>
    <?php echo $this->_cssFiles;?>
    <?php echo $this->_jsFiles;?>
</head>
<body>
<div id="main">
    <?php include_once 'html/header.php'; ?>

    <?php 
        require_once  MODULE_PATH. $this->_moduleName . DS . 'views' . DS . 'menu/menu.php';
    ?>

    <?php 
        require_once MODULE_PATH. $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';     
    ?>

    <?php include_once 'html/footer.php'; ?>    

</div>
<!-- <script>
  $(document).ready(function(){
    var url = window.location.href;
    if(url == 'http://localhost:8008/WebsiteNgheNhac/admin'){
      console.log("abc");
      // window.location.href = 'http://localhost:8008/WebsiteNgheNhac/index.php?module=admin&controller=user&action=login';
    }
  })
</script> -->
</body>
</html>

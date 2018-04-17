<?php
	
	// ====================== PATHS ===========================
	define ('DS'				, '/');
	define ('ROOT_PATH'			, dirname(__FILE__));							// Định nghĩa đường dẫn đến thư mục gốc
	define ('LIBRARY_PATH'		, ROOT_PATH . DS . 'libs' . DS);				// Định nghĩa đường dẫn đến thư mục thư viện
	define ('PUBLIC_PATH'		, ROOT_PATH . DS . 'public' . DS);				// Định nghĩa đường dẫn đến thư mục public							
	define ('APPLICATION_PATH'	, ROOT_PATH . DS . 'application' . DS);			// Định nghĩa đường dẫn đến thư mục application		
	define ('MODULE_PATH'		, APPLICATION_PATH . 'module' . DS);		// Định nghĩa đường dẫn đến thư mục module					
	define ('TEMPLATE_PATH'		, PUBLIC_PATH . 'template' . DS);				// Định nghĩa đường dẫn đến thư mục template							
	

	//Đường dẫn tương đối
	define	('ROOT_URL'			, DS . 'WebsiteNgheNhac' . DS);
	define	('APPLICATION_URL'	, ROOT_URL . 'application' . DS);
	define	('MODULE_URL'		, APPLICATION_URL . 'module' . DS);
	define	('PUBLIC_URL'		, ROOT_URL . 'public' . DS);
	define	('TEMPLATE_URL'		, PUBLIC_URL . 'template' . DS);
	
	define	('DEFAULT_MODULE'		, 'default');
	define	('DEFAULT_CONTROLLER'	, 'index');
	define	('DEFAULT_ACTION'		, 'index');

	// ====================== DATABASE ===========================
	define ('DB_HOST'			, 'localhost');
	define ('DB_USER'			, 'root');						
	define ('DB_PASS'			, '');						
	define ('DB_NAME'			, 'websitenghenhac');	
	define ('DB_TABLE'			, '');
	
	// ====================== TABLE ===========================
					
	define ('TB_SONG'				, 'baihat');	
	define ('TB_SONGINFO'			, 'chitietbaihat');
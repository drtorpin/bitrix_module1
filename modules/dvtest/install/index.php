<?
use \Bitrix\Main\Localization\Loc as Loc;
use \Bitrix\Main\ModuleManager as Mmg;
use Bitrix\Main\Application as Application; 
use Bitrix\Main\Web\Uri as Uri; 

Class dvtest extends CModule
{
var $MODULE_ID = "dvtest";
var $MODULE_VERSION;
var $MODULE_VERSION_DATE;
var $MODULE_NAME;
var $MODULE_DESCRIPTION;
var $MODULE_CSS;

	function dvtest(){
			$arModuleVersion = array();
			include(dirname(__FILE__)."/version.php");
			$this->MODULE_VERSION = $arModuleVersion["VERSION"];
			$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
			$this->MODULE_NAME = "dvtest – модуль с компонентом";
			$this->MODULE_DESCRIPTION = "После установкт можно поулчить нечто";
			// $this->PARTNER_NAME = "Имя разработчика"; 
			// $this->PARTNER_URI = "http://www.site.ru";
	}

	// добавление компонента в систему
	function InstallFiles($arParams = array()) { 
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/dvtest/install/components", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true); 
		return true; 
		} 
	
	// удаление компонента из системы
    function UnInstallFiles() {
        $res = DeleteDirFilesEx("/bitrix/components/dv/addressbook.list");
		if(!$res) CAdminMessage::ShowMessage("Компонент addressbook.list не удалён");		
        return true;
    }	
	
	// точка входа при установке
	function DoInstall(){
		global $APPLICATION;        
		// RegisterModuleDependences("iblock","OnAfterIBlockElementUpdate","dvtest","cMainDull","onBeforeElementUpdateHandler");
		// RegisterModuleDependences("dvtest");
		require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/dvtest/install/tasks/install.php");
		$this->InstallFiles();
		
        RegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile("Установка модуля dvtest", $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/dvtest/install/step.php");
		return true;
	}
	
	// точка входа при удалении
	function DoUninstall(){
        global $DOCUMENT_ROOT, $APPLICATION;
		$request = Application::getInstance()->getContext()->getRequest(); 
		// print_r($request);
		if($request["step"]<2) {
			$APPLICATION->IncludeAdminFile("Деинсталляция модуля dvtest", $DOCUMENT_ROOT."/bitrix/modules/dvtest/install/unstep1.php");
			} elseif($request["step"]==2) {
			$this->UnInstallFiles();
			UnRegisterModule($this->MODULE_ID);
			if($request["savedata"] != 'Y')
				require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/dvtest/install/tasks/uninstall.php");
				
			$APPLICATION->IncludeAdminFile("Деинсталляция модуля dvtest", $DOCUMENT_ROOT."/bitrix/modules/dvtest/install/unstep2.php");				
			}
		
        // UnRegisterModuleDependences("iblock","OnAfterIBlockElementUpdate","dvtest","cMainDull","onBeforeElementUpdateHandler");
        // UnRegisterModuleDependences("dvtest");
        return true;
		
	}
}
?>
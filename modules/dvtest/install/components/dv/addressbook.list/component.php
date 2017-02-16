<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arResult = Array();
$arResult['DATE'] = date('Y-m-d');

use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
use Bitrix\Main\Config\Option;
	   
// use Bitrix\Main\Entity;

CModule::IncludeModule('highloadblock');

$hlname = "AddressBook";
 // определяем ID хайлодблока
$filter = array(
  'select' => array('ID'),
  'filter' => array('=NAME' => $hlname)
);
$hlblock = HLBT::getList($filter)->fetch();
$hlblock_id = (is_array($hlblock) && !empty($hlblock)) ? $hlblock['ID'] : 0;

// определяем таблицу где лежат данные
$hlblock = HLBT::getById($hlblock_id)->fetch();
$entity = HLBT::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();
$entity_table_name = $hlblock['TABLE_NAME'];

// получаем данные из хайлодблока
$rsData = $entity_data_class::getList(array(
	"select" => array('UF_FIO','UF_ADDRESS','UF_PHONE'),
	"filter" => array(),
	"order" => array("ID"=>"ASC") 
	));
$rsData = new CDBResult($rsData, $entity_table_name);
while($arRes = $rsData->Fetch()){
	$arResult["USER_ADDRESS_BOOK"][] = $arRes;
	}
// получаем название сайта
$arResult['SITE_NAME'] = COption::GetOptionInt("main", "site_name");

// выводим в шаблон
$this->IncludeComponentTemplate();
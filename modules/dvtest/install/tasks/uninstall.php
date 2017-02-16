<?
// use Bitrix\Highloadblock as HL;
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;

CModule::IncludeModule('highloadblock');

$filter = array(
  'select' => array('ID'),
  'filter' => array('=NAME' => "AddressBook")
);
$hlblock = HLBT::getList($filter)->fetch();
if(is_array($hlblock) && !empty($hlblock)) {
  HLBT::delete($hlblock['ID']);
}

?>
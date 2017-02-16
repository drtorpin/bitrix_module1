<?
// *******************************************************************************************************
// Install new right system: operation and tasks
// *******************************************************************************************************
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;

CModule::IncludeModule('highloadblock');

$hlname = "AddressBook";
$hlprefix = "UF_";
 
// проеряем создан ли уже хайлоадблок 
$filter = array(
  'select' => array('ID'),
  'filter' => array('=NAME' => $hlname)
);
$hlblock = HLBT::getList($filter)->fetch();
if(!is_array($hlblock)) {

		// создаём хайлодблок
		$highloadBlockData = array(
			"NAME" => $hlname,
			"TABLE_NAME" => "user_addressbook"
		);
		$result = HLBT::add($highloadBlockData);

		if (!$result->isSuccess()) {
		   $errors = $result->getErrorMessages();
		} else {
			$highLoadBlockId = $result->getId();
		}

		// создаём поля
		$userTypeEntity = new CUserTypeEntity();
		$typeArrs = array("FIO",
									"ADDRESS",
									"PHONE");
		// демо данные
		$addData = Array(array(
									'Иванов Иван',
									'Москва, ул.Тверская,12',
									'89260000001'
								),
							array(
									'Петров Пётр',
									'Москва, ул.Таганская,1',
									'89260000002'
								),
							array(
									'Сидоров Илья',
									'Москва, ул.Новокузнецкая,2',
									'89260000003'
								)
							);

		foreach ($typeArrs as $typeArr) {
			// echo $typeArr;
			$userTypeData = array(
				"ENTITY_ID" => "HLBLOCK_" . $highLoadBlockId,
				"FIELD_NAME" =>$hlprefix . $typeArr,
				"USER_TYPE_ID" => "string",
				"XML_ID" => "XML_ID_" . $typeArr,
				"SORT" => 100,
				"MULTIPLE" => "N",
				"MANDATORY" => "N",
				"SHOW_FILTER" => "N",
				"SHOW_IN_LIST" => "",
				"EDIT_IN_LIST" => "",
				"IS_SEARCHABLE" => "N",
				"SETTINGS" => array(
					"DEFAULT_VALUE" => "",
					"SIZE" => "20",
					"ROWS" => "1",
					"MIN_LENGTH" => "0",
					"MAX_LENGTH" => "0",
					"REGEXP" => "",
				),
				"EDIT_FORM_LABEL" => array(
					"ru" => "",
					"en" => "",
				),
				"LIST_COLUMN_LABEL" => array(
					"ru" => "",
					"en" => "",
				),
				"LIST_FILTER_LABEL" => array(
					"ru" => "",
					"en" => "",
				),
				"ERROR_MESSAGE" => array(
					"ru" => "",
					"en" => "",
				),
				"HELP_MESSAGE" => array(
					"ru" => "",
					"en" => "",
				),
			);
			$userTypeId = $userTypeEntity->Add($userTypeData);
		}
		
		// заполняем демо данными
		$hlblock = HLBT::getById($highLoadBlockId)->fetch();   
		$entity = HLBT::compileEntity($hlblock);
		$entity_data_class = $entity->getDataClass();		
		foreach($addData as $arVals) {
			$arAdd = Array();
			// формируем массив для добавления
			foreach($arVals as $k => $v) {
				if(isSet($typeArrs[$k])) $arAdd[$hlprefix . $typeArrs[$k]] = $v;
				}
			
			$result = $entity_data_class::add($arAdd);	
				/*
				if ($result->isSuccess()){
					echo 'Запись '.$inx.'добавлена успешно! ID записи: '. $result->getId();
				} else {
					echo 'Не удалось добавить запись '.$inx;
				}
				*/
		}		

}





 ?>
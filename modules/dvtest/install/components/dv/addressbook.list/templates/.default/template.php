<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// включаем композитный режим
$this->setFrameMode(true);

if (!empty($arResult['ERROR']))
{
	echo $arResult['ERROR'];
	return false;
}
?>

<div class="ab_component">
	<div class="ab_title ab_center">
		<div class="ab_title_name"><?=$arResult['SITE_NAME']?></div>
		<div class="ab_title_txt">Телефонный справочник</div>
		<div class="ab_clr"></div>
	</div>
	<div class="ab_center">
		<table cellspacing="0" class="ab_table ab_border">
			<tr class="ab_tr_title">
				<th class="ab_border ab_left">ФИО</th>
				<th class="ab_border ab_left">Адрес</th>
				<th class="ab_border ab_center">Телефон</th>
			</tr>
			<?
			foreach($arResult["USER_ADDRESS_BOOK"] as $arRow)
			{
				?>
				<tr class="adbook_tr_data ab_border">
					<td class="ab_border ab_left"><?=$arRow["UF_FIO"]?></td>
					<td class="ab_border ab_left"><?=$arRow["UF_ADDRESS"]?></td>
					<td class="ab_border ab_center"><?=$arRow["UF_PHONE"]?></td>
				</tr>
				<?
			}
			?>
		</table>
	</div>
</div>


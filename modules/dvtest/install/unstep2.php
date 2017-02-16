<?if(!check_bitrix_sessid()) return;?>
<?
use \Bitrix\Main\Localization\Loc as Loc;


	echo CAdminMessage::ShowNote(GetMessage("MOD_UNINST_OK"));
?>
<form action="<?echo $APPLICATION->GetCurPage(); ?>">
	<INPUT type="hidden" name="lang" value="<?echo LANGUAGE_ID; ?>">
	<INPUT type="submit" name="" value="<?echo Loc::getMessage("MOD_BACK"); ?>">
</form>
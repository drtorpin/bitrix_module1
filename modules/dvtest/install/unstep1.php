<?if(!check_bitrix_sessid()) return;?>
<?
use \Bitrix\Main\Localization\Loc as Loc;

Loc::LoadMessages(__FILE__);
// echo CAdminMessage::ShowNote("Модуль dvtest успешно удален из системы");
?>
<form action="<?echo $APPLICATION->GetCurPage(); ?>">
<?=bitrix_sessid_post()?>
	<INPUT type="hidden" name="lang" value="<?echo LANGUAGE_ID; ?>">
	<INPUT type="hidden" name="id" value="dvtest">
	<INPUT type="hidden" name="uninstall" value="Y">
	<INPUT type="hidden" name="step" value="2">
	<?echo CAdminMessage::ShowMessage(Loc::getMessage("MOD_UNINST_WARN")); ?>
	<p><?echo Loc::getMessage("MOD_UNINST_SAVE"); ?></p>
	<INPUT type="checkbox" name="savedata" id="savedata" value="Y" checked>
		<label for="savedata">
		<?echo Loc::getMessage("MOD_UNINST_SAVE_TABLES"); ?>
		</label></p>
	<INPUT type="submit" name="" value="<?echo Loc::getMessage("MOD_UNINST_DEL"); ?>">
</form>
<?php
/**
 * The default English language topics
 *
 * @package forcedpasswdchange
 * @subpackage lexicon
 * @language en
 * @author Bert Oost at OostDesign.nl (bertoost85@gmail.com)
 */

$_lang['fpc.oldpasswd'] = "Old password";
$_lang['fpc.newpasswd'] = "New password";
$_lang['fpc.newpasswd.desc'] = "You will need to change your password before you can continue.";
$_lang['fpc.confirmpasswd'] = "Confirm password";
$_lang['fpc.change'] = "Change password";
$_lang['fpc.passwordchanged'] = "Password changed";
$_lang['fpc.passwordchanged.success'] = "Your password is succussfully changed!";

$_lang['fpc.forcepasswordchange'] = "Forced Password Change";
$_lang['fpc.forcepasswordchange.yes'] = "Yes! Force user to change password at login, the first time!";
$_lang['fpc.forcepasswordchange.desc'] = "This will popup a window at first time login and the user has no ability to close the window.<br />The user is forced to change his password first.";

$_lang['fpc.error.user_nf'] = "The user to change the password for not found!";
$_lang['fpc.error.oldpwd_iv'] = "The old password is empty or doesn't match!";
$_lang['fpc.error.nwpwd_nf'] = "No new password specified!";
$_lang['fpc.error.nwpwdc_nf'] = "No new password confirmation specified!";
$_lang['fpc.error.nwpwd_nm'] = "The new password and the confirmation doesn't match!";
$_lang['fpc.error.pwd_nc'] = "The password isn't different, so not changed!";
$_lang['fpc.error.pwdchange_err'] = "The password isn't changed for some reason!";

?>
<?php

$version = $modx->getVersionData();

// get user
$user =& $modx->user;
if(empty($user) || !is_object($user)) {
	return $modx->error->failure($modx->lexicon('fpc.error.user_nf'));
}

// check to compare old password
$passwdOld = $modx->getOption('oldpwd', $scriptProperties, false);
if(version_compare($version['full_version'], '2.1.0', '>=')) {
	if(empty($passwdOld) || !$user->passwordMatches($passwdOld)) {
		return $modx->error->failure($modx->lexicon('fpc.error.oldpwd_iv'));
	}
}
else {
	if(empty($passwdOld) || md5($passwdOld) != $user->get('password')) {
		return $modx->error->failure($modx->lexicon('fpc.error.oldpwd_iv'));
	}
}

// new password check
$passwdNew = $modx->getOption('nwpwd', $scriptProperties, false);
if(empty($passwdNew)) {
	return $modx->error->failure($modx->lexicon('fpc.error.nwpwd_nf'));
}

$passwdNewConfirm = $modx->getOption('nwpwdc', $scriptProperties, false);
if(empty($passwdNew)) {
	return $modx->error->failure($modx->lexicon('fpc.error.nwpwdc_nf'));
}

// match the new passwords
if($passwdNew != $passwdNewConfirm) {
	return $modx->error->failure($modx->lexicon('fpc.error.nwpwd_nm'));
}

// match the new and the old password for changes
if($passwdOld == $passwdNew) {
	return $modx->error->failure($modx->lexicon('fpc.error.pwd_nc'));
}

// when here; just change the password
$success = $user->changePassword($passwdNew, $passwdOld);
if(!$success) {
	return $modx->error->failure($modx->lexicon('fpc.error.pwdchange_err'));
}

$pwdch = $modx->getObject('forcedPasswdChange', array('user' => $user->get('id')));
$pwdch->set('changed', true);
$pwdch->save();

// invoke event also
$modx->invokeEvent('OnUserChangePassword', array(
	'user' => $user,
	'newpassword' => $passwdNew,
	'oldpassword' => $passwdOld
));

return $modx->error->success('', true);

?>
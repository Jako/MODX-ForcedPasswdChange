<?php

class FPCPasswordChangeProcessor extends modProcessor {

    public function process() {
        // get user
        $user =& $this->modx->user;
        if(empty($user) || !is_object($user)) { return $this->failure($this->modx->lexicon('fpc.error.user_nf')); }

        // check to compare old password
        $passwdOld = $this->getProperty('oldpwd', false);
        if(empty($passwdOld) || !$user->passwordMatches($passwdOld)) { return $this->failure($this->modx->lexicon('fpc.error.oldpwd_iv')); }

        // new password check
        $passwdNew = $this->getProperty('nwpwd', false);
        if(empty($passwdNew)) { return $this->failure($this->modx->lexicon('fpc.error.nwpwd_nf')); }

        $passwdNewConfirm = $this->getProperty('nwpwdc', false);
        if(empty($passwdNew)) { return $this->failure($this->modx->lexicon('fpc.error.nwpwdc_nf')); }

        // match the new passwords
        if($passwdNew != $passwdNewConfirm) { return $this->failure($this->modx->lexicon('fpc.error.nwpwd_nm')); }

        // match the new and the old password for changes
        if($passwdOld == $passwdNew) { return $this->failure($this->modx->lexicon('fpc.error.pwd_nc')); }

        // when here; just change the password
        $success = $user->changePassword($passwdNew, $passwdOld);
        if(!$success) { return $this->failure($this->modx->lexicon('fpc.error.pwdchange_err')); }

        $pwdch = $this->modx->getObject('forcedPasswdChange', array('user' => $user->get('id')));
        $pwdch->set('changed', true);
        $pwdch->save();

        // invoke event also
        $this->modx->invokeEvent('OnUserChangePassword', array(
            'user' => $user,
            'newpassword' => $passwdNew,
            'oldpassword' => $passwdOld
        ));

        return $this->success();
    }
}

return 'FPCPasswordChangeProcessor';

?>
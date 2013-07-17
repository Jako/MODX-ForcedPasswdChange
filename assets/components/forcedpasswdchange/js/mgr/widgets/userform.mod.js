var originalSetupMethod = MODx.panel.User.prototype.setup;
Ext.override(MODx.panel.User, {
    setup: function() {

        // check if custom field already is in the form or not.. when not; add it!
        // when it is; this method is called every time when saving, so check it
        if(!Ext.getCmp('forcepwdchange_chkbox_field') && this.config.user != ForcedPasswdChange.curruser) {

            var cbox = {
                xtype: 'xcheckbox',
                name: 'forcepwdchange',
                id: 'forcepwdchange_chkbox_field',
                fieldLabel: _('fpc.forcepasswordchange'),
                boxLabel: _('fpc.forcepasswordchange.yes')+'<br />'+_('fpc.forcepasswordchange.desc'),
                listeners: {
                    'check': this.markDirty,
                    scope: this
                }
            };
            Ext.getCmp('modx-user-fs-newpassword').add(cbox);
        }

        originalSetupMethod.apply(this);
    }
});
Ext.onReady(function() {
	
	var ForcedPasswdChangeWindow = new MODx.Window({
		title: _('fpc.newpasswd'),
		id: 'forcedpasswdchange_window',
		labelWidth: 150,
		closable: false,
		collapsible: false,
		maximizable: false,
		modal: true,
        width: 350,
		fields: [{
			html: '<p>' + _('fpc.newpasswd.desc') + '</p><br />'
		},{
			xtype: 'textfield',
			inputType: 'password',
			fieldLabel: _('fpc.oldpasswd'),
			id: 'fpc_password_old',
			name: 'password_old',
            anchor: '100%',
            allowBlank: false
		},{
			xtype: 'textfield',
			inputType: 'password',
			fieldLabel: _('fpc.newpasswd'),
			id: 'fpc_password_new',
			name: 'password_new',
            anchor: '100%',
            allowBlank: false
		},{
			xtype: 'textfield',
			inputType: 'password',
			fieldLabel: _('fpc.confirmpasswd'),
			id: 'fpc_password_new_confirm',
			name: 'password_new_confirm',
            anchor: '100%',
            allowBlank: false
		}],
		buttons: [{
			text: _('fpc.change'),
			handler: function() {
				
				var passwdOld = Ext.getCmp('fpc_password_old').getValue();
				var passwdNew = Ext.getCmp('fpc_password_new').getValue();
				var passwdNewConf = Ext.getCmp('fpc_password_new_confirm').getValue();
				
				if(passwdOld.length == 0 || passwdNew.length == 0 || passwdNewConf.length == 0) {
					return false;
				}
				
				MODx.Ajax.request({
					url: ForcedPasswdChange.config.connector_url,
					params: { action: 'mgr/passwdchange', oldpwd: passwdOld, nwpwd: passwdNew, nwpwdc: passwdNewConf },
					listeners: {
						'success': {
							fn: function(r) {
								Ext.Msg.show({
									title: _('fpc.passwordchanged'),
									msg: _('fpc.passwordchanged.success'),
									buttons: Ext.Msg.OK,
									fn: function(btn) {
										ForcedPasswdChangeWindow.hide();
										return false;
									}
								});
							},
							scope: this
						}
					}
				});
			},
			scope: this
		}]
	});
	
	ForcedPasswdChangeWindow.show(Ext.getBody());
});
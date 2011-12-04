Ext.onReady(function() {
	
	var ForcedPasswdChangeWindow = new MODx.Window({
		title: ForcedPasswdChange.lang['fpc.newpasswd'],
		id: 'forcedpasswdchange_window',
		labelWidth: 150,
		closable: false,
		collapsible: false,
		maximizable: false,
		modal: true,
		fields: [{
			html: '<p>' + ForcedPasswdChange.lang['fpc.newpasswd.desc'] + '</p><br />'
		},{
			xtype: 'textfield',
			inputType: 'password',
			fieldLabel: ForcedPasswdChange.lang['fpc.oldpasswd'],
			id: 'fpc_password_old',
			name: 'password_old',
			width: 200,
			allowBlank: false
		},{
			xtype: 'textfield',
			inputType: 'password',
			fieldLabel: ForcedPasswdChange.lang['fpc.newpasswd'],
			id: 'fpc_password_new',
			name: 'password_new',
			width: 200,
			allowBlank: false
		},{
			xtype: 'textfield',
			inputType: 'password',
			fieldLabel: ForcedPasswdChange.lang['fpc.confirmpasswd'],
			id: 'fpc_password_new_confirm',
			name: 'password_new_confirm',
			width: 200,
			allowBlank: false
		}],
		buttons: [{
			text: ForcedPasswdChange.lang['fpc.change'],
			handler: function() {
				
				var passwdOld = Ext.getCmp('fpc_password_old').getValue();
				var passwdNew = Ext.getCmp('fpc_password_new').getValue();
				var passwdNewConf = Ext.getCmp('fpc_password_new_confirm').getValue();
				
				if(passwdOld.length == 0 || passwdNew.length == 0 || passwdNewConf.length == 0) {
					return false;
				}
				
				MODx.Ajax.request({
					url: ForcedPasswdChange.config.connector_url,
					params: {
						action: 'mgr/passwdchange',
						oldpwd: passwdOld,
						nwpwd: passwdNew,
						nwpwdc: passwdNewConf
					},
					listeners: {
						'success': {
							fn: function(r) {
								
								Ext.Msg.show({
									title: ForcedPasswdChange.lang['fpc.passwordchanged'],
									msg: ForcedPasswdChange.lang['fpc.passwordchanged.success'],
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

/*
ForcedPasswdChange.window.ChangeWindow = function(config) {
	config = config || {};
	Ext.applyIf(config,{
		title: ForcedPasswdChange.lang['fpc.newpasswd'],
		labelWidth: 150,
		closable: false,
		collapsible: false,
		draggable: false,
		maximizable: false,
		modal: true,
		fields: [{
			html: '<p>' + ForcedPasswdChange.lang['fpc.newpasswd.desc'] + '</p><br />'
		},{
			xtype: 'textfield',
			inputType: 'password',
			fieldLabel: ForcedPasswdChange.lang['fpc.newpasswd'],
			name: 'password_new',
			width: 200,
			allowBlank: false
		},{
			xtype: 'textfield',
			inputType: 'password',
			fieldLabel: ForcedPasswdChange.lang['fpc.confirmpasswd'],
			name: 'password_new_confirm',
			width: 200,
			allowBlank: false
		}]
	});
	
	ForcedPasswdChange.window.ChangeWindow.superclass.constructor.call(this,config);
};
Ext.extend(ForcedPasswdChange.window.ChangeWindow, MODx.Window);
Ext.reg('forcedpasswdchange-window-changewindow', ForcedPasswdChange.window.ChangeWindow);
*/
var theVersion = MODx.config.version; // eq. 2.1.3-pl or 2.2.0-pl
	theVersion = theVersion.split('-')[0].split('.');
	theVersion = theVersion[0]+'.'+theVersion[1]; // makes something eq. 2.1 or 2.2

// 2.1.x compatible
if(theVersion == '2.1') {

	Ext.onReady(function() {
		
		var savedOriginalMethod = MODx.panel.User.prototype.setup;
		
		Ext.override(MODx.panel.User, {
			setup: function() {
				
				// check if custom field already is in the form or not.. when not; add it!
				// when it is; this method is called every time when saving, so check it
				if(!Ext.getCmp('forcepwdchange_chkbox_field') && this.config.user != ForcedPasswdChange.curruser) {
					
					var obj = Ext.getCmp('modx-user-fs-newpassword').getEl();
					var txtfld = new Ext.form.Checkbox({
						renderTo: obj,
						name: 'forcepwdchange',
						id: 'forcepwdchange_chkbox_field',
						boxLabel: ForcedPasswdChange.lang['fpc.forcepasswordchange'],
						value: 'do',
						listeners: {
							'check': this.markDirty,
							scope: this
						}
					});
				}
				
				savedOriginalMethod.apply(this);
			}
		});
	});
}
// 2.2.x compatible
else if(theVersion == '2.2') {

	var savedOriginalMethod = MODx.panel.User.prototype.setup;
	
	Ext.override(MODx.panel.User, {
		setup: function() {
			
			// check if custom field already is in the form or not.. when not; add it!
			// when it is; this method is called every time when saving, so check it
			if(!Ext.getCmp('forcepwdchange_chkbox_field') && this.config.user != ForcedPasswdChange.curruser) {
				
				var obj = Ext.getCmp('modx-user-fs-newpassword').getEl().dom.parentNode;
				var txtfld = new Ext.form.Checkbox({
					renderTo: obj,
					name: 'forcepwdchange',
					id: 'forcepwdchange_chkbox_field',
					boxLabel: ForcedPasswdChange.lang['fpc.forcepasswordchange'],
					value: 'do',
					listeners: {
						'check': this.markDirty,
						scope: this
					}
				});
			}
			
			savedOriginalMethod.apply(this);
		}
	});
}
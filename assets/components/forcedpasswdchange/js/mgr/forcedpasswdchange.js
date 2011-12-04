var ForcedPasswdChange = function(config) {
    config = config || {};
    ForcedPasswdChange.superclass.constructor.call(this, config);
};

Ext.extend(ForcedPasswdChange, Ext.Component,{
    page:{}, window:{}, grid:{}, tree:{}, panel:{}, combo:{}, config:{}
});

Ext.reg('forcedpasswdchange', ForcedPasswdChange);

ForcedPasswdChange = new ForcedPasswdChange();
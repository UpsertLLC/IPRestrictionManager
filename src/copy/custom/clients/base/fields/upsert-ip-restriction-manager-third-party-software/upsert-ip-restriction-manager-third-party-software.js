/*
 * IP Restriction Manager is an open source module developed by SugarCRM, Inc
 * Copyright (C) SugarCRM, Inc.
 *
 * "Upsert® IP Restriction Manager" is an extension to "IP Restriction Manager" developed by Upsert, LLC.
 * Copyright (C) Upsert, LLC.
 * 
 * Project: https://github.com/upsertllc/IPRestrictionManager
 * Support: https://github.com/UpsertLLC/IPRestrictionManager/issues
 * 
 * Licensed by SugarCRM, Inc under the Apache 2.0 license.
 */
({
    /**
     * @inheritdoc
     */
    initialize: function (options) {
        this._super('initialize', [options]);
        this.model.on("change:third_party_software", this.setThirdPartySoftwareFieldVisibility, this);
    },

    /**
     * Sets the visibility of the third party software field
     */
    setThirdPartySoftwareFieldVisibility: function () {
        if (_.isEmpty(this.model.get('third_party_software'))) {
            $('div[data-name="third_party_software"]').hide();
        }
    },
})
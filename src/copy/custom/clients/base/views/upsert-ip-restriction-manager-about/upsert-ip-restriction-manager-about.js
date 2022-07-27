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
    extendsFrom: 'RecordView',

    events: {
        'click a[name=close_info_button]': '_closeClicked'
    },

    /**
     * @inheritdoc
     */
    initialize: function (options) {
        this._super('initialize', [options]);
    },

    /**
     * Returns the administration link
     * @returns 
     */
    getAdminLink: function () {
        var route = "#bwc/index.php?module=Administration&action=index";
        var parts = app.metadata.getServerInfo().version.split('.');
        if (parts[0] >= 12 || (parts[0] == 11 && parts[1] >= 3)) {
            route = '#Administration';
        }

        return route;
    },

    /**
     * Cancel event clicked
     */
    _closeClicked: function () {
        if (app.drawer.count()) {
            app.drawer.close();
        } else {
            app.router.navigate(this.getAdminLink(), { trigger: true, replace: true });
        }
    },

    /**
     * Handles displaying errors to the user
     * @param object error 
     */
    _handleError(error) {
        var message = '';
        if (error && error.error_message) {
            message = error.error_message;
        } else if (error && error.payload && error.payload.error_message) {
            message = error.payload.error_message;
        }

        if (_.isEmpty(message)) {
            message = app.lang.get('ERR_HTTP_DEFAULT_TITLE');
        }

        app.alert.show('upsert-ip-restriction-manager-error', {
            level: 'error',
            messages: message
        });
    },

    /**
     * @inheritdoc
     */
    _render: function () {
        this._super('_render');
        var layout = this.closestComponent('sidebar');
        if (layout && !layout.isSidePaneVisible()) {
            layout.trigger('sidebar:toggle');
        }
    },

    /**
     * @inheritdoc
     */
    _loadTemplate: function (options) {
        this.tplName = 'record';
        this.template = app.template.getView(this.tplName);
    },

    /**
     * @inheritdoc
     */
    loadData: function (options) {
        var self = this;
        app.api.call('read', app.api.buildURL('upsert_IPRestrictionManager/about'), this.model.attributes, {
            success: function (data) {
                _.each(data, function (value, key) {
                    self.model.set(key, value);
                });

                self.model.set("header", app.lang.get('LBL_UPSERT_IPRESTRICTIONMANAGER_INFORMATION_LINK', 'Administration'));

                //populate any missing fields
                if (
                    _.has(self, 'meta')
                    && _.has(self.meta, 'panels')
                ) {
                    var fields = _.flatten(_.pluck(self.meta.panels, 'fields'));
                    _.each(fields, function (field) {
                        if (!_.has(self.model.attributes, field.name)) {
                            self.model.set(field.name, field.default);
                        }
                    });
                }
            },
            error: function (error) {
                self._handleError(error);
            }
        });
    },
})
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
        'click a[name=save_setting_button]': '_saveClicked',
        'click a[name=cancel_setting_button]': '_cancelClicked',
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
    _cancelClicked: function () {
        if (app.drawer.count()) {
            app.drawer.close();
        } else {
            app.router.navigate(this.getAdminLink(), { trigger: true, replace: true });
        }
    },

    /**
     * @inheritdoc
     */
    handleCancel: function () { },

    /**
     * Saves the record
     * @param {*} isValid 
     * @param {*} callback 
     */
    save: function (isValid, callback) {
        if (!isValid) {
            return;
        }

        var fields = [];
        _.each(_.flatten(_.pluck(App.metadata.getView('upsert_IPRestrictions', 'upsert-config').panels[1].fields, "name")), function (field) {
            fields.push(field);
        });

        var self = this;
        var fieldObject = {};
        _.each(fields, function (field, key) {
            var fieldValue = self.model.get(field);
            fieldObject[field] = fieldValue;
        });

        app.alert.show('upsert-iprestrictions-config-saving', {
            level: 'process',
            title: 'LBL_SAVING'
        });

        app.api.call('create', app.api.buildURL('upsert_IPRestrictionManager/settings'), fieldObject, {
            success: function (data) {
                app.alert.dismiss('upsert-iprestrictions-config-saving');

                if (callback) {
                    callback();
                }

                //fetch changes
                app.sync({
                    forceRefresh: true
                });
            },
            error: function (error) {
                app.alert.dismiss('upsert-iprestrictions-config-saving');
                self._handleError(error);
            }
        });
    },

    /**
     * Saves the record and closes the drawer
     * @param {*} isValid 
     */
    saveAndClose: function (isValid) {
        this.save(isValid, _.bind(function () {
            if (app.drawer.count()) {
                app.drawer.close();
            } else {
                app.router.navigate(this.getAdminLink(), { trigger: true, replace: true });
            }
        }, this));
    },

    /**
     * Save event clicked
     */
    _saveClicked: function () {
        var fieldsToValidate = {};
        var allFields = this.getFields(this.module, this.model);
        for (var fieldKey in allFields) {
            if (this.model.has(fieldKey)) {
                _.extend(fieldsToValidate, _.pick(allFields, fieldKey));
            }
        }

        this.model.doValidate(fieldsToValidate, _.bind(this.saveAndClose, this));
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

        app.alert.show('upsert-iprestrictions-config-error', {
            level: 'error',
            messages: message
        });
    },

    /**
     * @inheritdoc
     */
    _render: function () {
        this._super('_render', []);
        this.setButtonStates(this.STATE.EDIT);
        this.action = 'edit';
        this.toggleEdit(true);
        this.setRoute('edit');
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

        app.api.call('read', app.api.buildURL('upsert_IPRestrictionManager/settings'), this.model.attributes, {
            success: function (data) {
                _.each(data, function (value, key) {
                    self.model.set(key, value);
                });

                self.model.set("header", app.lang.get('LBL_UPSERT_IPRESTRICTIONMANAGER_CONFIGURATION_LINK', 'Administration'));

                var fields = app.metadata.getModule(self.module).fields;

                //populate any missing fields
                if (fields) {
                    _.each(fields, function (field) {
                        if (field.default && !_.has(self.model.attributes, field.name)) {
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

    /**
     * @inheritdoc
     */
    setRoute: function (action) {
        //make sure our route stays
        app.router.navigate('upsert_IPRestrictions/layout/upsert-config', { trigger: false, replace: true });
    },
})
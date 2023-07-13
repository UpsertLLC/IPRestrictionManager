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
    events: {
        'click .btn[data-action=add-field]': 'addItem',
        'click .btn[data-action=remove-field]': 'removeItem',
    },

    /**
     * @inheritdoc
     */
    initialize: function (options) {
        this._super('initialize', [options]);

        this._currentIndex = 0;
    },

    /**
     * @inheritdoc
     */
    format: function (value) {
        
        if (_.isNull(value)) {
            value = [];
        }

        if (_.isString(value)) {
            value = [value];
        }

        if (_.isEmpty(value)) {
            value.push('');
        }

        return value;
    },

    /**
     * @inheritdoc
     */
    unformat: function (value) {
        if (_.isString(value)) {
            value = [value];
        }
        return value;
    },

    /**
     * @inheritdoc
     */
    bindDomChange: function () {
        var self = this,
            el = null;
        if (this.model) {
            el = this.$el.find('div[data-name=upsert_list_collection_' + this.name + '] input[type=text]');
            el.on('change', function () {
                var value = self.unformatValue();
                self.model.set(self.name, value, { silent: true });
                self.value = self.format(value);
            });
        }
    },

    /**
     * @inheritdoc
     */
    bindDataChange: function() {
        if (this.model) {
            this.model.on('change:' + this.name, function() {
                var list = this.model.get(this.name);

                if (!_.isUndefined(list) && (this._currentIndex !== list.length - 1)) {
                    this._currentIndex = list.length - 1;
                }

                this.render();
            }, this);
        }
    },

    /**
     * Get value from view data.
     * @return array
     */
    unformatValue: function () {
        var container = $(this.$('div[data-name=upsert_list_collection_' + this.name + ']'));
        var input = container.find('input[type=text]');
        var values = [];
        var value = '';

        for (var i = 0; i < input.length; i = i + 1) {
            value = container.find('input[data-index=' + i + '][name=value_' + this.name + ']').val();
            values.push(value);
        }

        return values;
    },

    /**
     * Add item to list.
     * @param {Event} evt DOM event.
     */
    addItem: function (evt) {
        var value = this.unformat(this.value);
        value.push("");
        this._currentIndex++;
        this.model.set(this.name, value);
        this.render();
    },

    /**
     * Remove item from list.
     * @param {Event} evt DOM event.
     */
    removeItem: function (evt) {
        this._currentTarget = evt.currentTarget;
        this.warnDelete();
    },

    /**
     * Popup dialog message to confirm delete action.
     */
    warnDelete: function () {
        app.alert.show('delete_confirmation', {
            level: 'confirmation',
            messages: app.lang.get('LBL_DELETE_CONFIRMATION_LANGUAGE', this.module),
            onConfirm: _.bind(this.confirmDelete, this),
            onCancel: _.bind(this.cancelDelete, this)
        });
    },

    /**
     * Predefined function for confirm delete.
     */
    confirmDelete: function () {
        var index = $(this._currentTarget).data('index');

        if (_.isNumber(index)) {
            if (this._currentIndex === this.value.length - 1 && this._currentIndex !== 0) {
                this._currentIndex -= 1;
            }

            this.value.splice(index, 1);

            if (_.isEmpty(this.value)) {
                this.value.push("");
            }

            this.model.set(this.name, this.value);
            this.render();
        }
    },

    /**
     * Predefined function for cancel delete.
     * @param {Event} evt DOM event.
     */
    cancelDelete: function (evt) { },

    /**
     * @inheritdoc
     */
    _dispose: function () {
        this.$el.off();
        this.model.off('change');
        this._super('_dispose');
    },

    /**
     * Need own decoration for field error.
     * @override
     */
    handleValidationError: function (errors) {
        this.clearErrorDecoration();
        var err = errors.errors || errors;
        var self = this;

        _.defer(function (field) {
            if (field.action === 'edit' || field.view.inlineEditMode) {
                if (field.parent) {
                    field.parent.setMode('edit');
                } else {
                    field.setMode('edit');
                }
            }
            // As we're now "post form submission", if `no_required_placeholder`, we need to
            // manually decorateRequired (as we only omit required on form's initial render)
            if (!field._shouldRenderRequiredPlaceholder()) {
                field.decorateRequired();
            }

            // handle view specific validation error considerations
            if (field.view && field.view.trigger) {
                field.view.trigger('field:error', field, true);
            }

            _.each(err, function (value) {
                var inpName = 'value_' + self.name,
                    $inp = self.$('input[data-index=' + value.ind + '][name=' + inpName + ']');
                $inp.wrap('<div class="input-append input error ' + self.name + '">');
                $inp.val(value.value);
                errorMessages = [value.message];
                $tooltip = $(self.exclamationMarkTemplate(errorMessages));
                $inp.after($tooltip);
            }, this);
        }, this);

        this.$el.off("keydown.record");
        $(document).off("mousedown.record" + this.name);
    },

    /**
     * Need own method to clear error decoration.
     * @override
     */
    clearErrorDecoration: function () {
        var ftag = this.fieldTag || '';
        this.$('.add-on.error-tooltip').remove();
        _.each(this.$('input[type=text]'), function (inp) {
            var $inp = this.$(inp);
            if ($inp.parent().hasClass('input-append') && $inp.parent().hasClass('error')) {
                $inp.unwrap();
            }
        });

        this.$el.removeClass(ftag);
        this.$el.removeClass("error");
        this.$el.closest('.record-cell').removeClass("error");

        if (this.view && this.view.trigger) {
            this.view.trigger('field:error', this, false);
        }
    },
})
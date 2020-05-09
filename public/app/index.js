Ext.ns('App.Window');


App.Window = Ext.extend(Ext.Window, {
    layout: 'fit',
    width: 400,
    height: 400,
    constructor: function (cfg) {
        cfg = Ext.applyIf(cfg, {
            title: 'ApplyIf'
        });
        this.createFormPanel();
        cfg.items = [this.formPanel];

        App.Window.superclass.constructor.call(this, cfg);

    },
    /**
     * @type Ext.form.FormPanel
     */
    formPanel: undefined,

    createFormPanel: function () {
        var formPanel = Ext.create({
            xtype: 'form',
            items: [
                {
                    xtype: 'textfield',
                    name: 'id'
                },
                {
                    xtype: 'textfield',
                    name: 'fullname'
                },

                {
                    xtype: 'grid',
                    itemId: 'gridUsers',
                    height: 150,
                    store: new Ext.data.JsonStore({
                        url: 'users/list',
                        autoLoad: true,
                        root: 'rows',
                        fields: ['id', 'fullname', 'email'],
                        listeners: {
                            beforeload: function (store) {
                                console.log('beforeload');
                                store.setBaseParam('params', 'value');
                                let filter = formPanel.getForm().getValues();
                                for (let key in filter) {
                                    store.setBaseParam(key, filter[key]);
                                }

                            }
                        }
                    }),
                    columns: [
                        {
                            id: 'id',
                            header: 'ID',
                            width: 20,
                            sortable: true,
                        },
                        {
                            id: 'fullname',
                            header: 'fullname',
                            width: 200,
                            sortable: true,
                        },
                        {
                            id: 'email',
                            header: 'email',
                            width: 200,
                            sortable: true,
                        }
                    ]
                }
            ],
            buttons: [
                {
                    xtype: 'button',
                    text: 'Submit',
                    scope: this,
                    handler: function () {
                        formPanel.getComponent('gridUsers').getStore().reload();
                        console.log('Store reloaded');
                    }
                },
                {
                    xtype: 'button',
                    text: 'Close',
                    scope: this,
                    handler: function () {
                        this.close();
                    }
                }
            ]
        });
        this.formPanel = formPanel;
    }

});

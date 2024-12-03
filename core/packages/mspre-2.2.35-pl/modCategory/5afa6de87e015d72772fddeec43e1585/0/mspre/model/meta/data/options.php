<?php
return array(
    'checkbox' => array(
        'id' => '{name}',
        'sortable' => false,
        'dataIndex' => '{name}',
        'editor' => array(
            'name' => '{name}',
            'xtype' => 'loadCombo',
        ),
        'actions' => array(
            'new' => 'mspre-combo-boolean-option',
            'old' => 'mspre-combo-boolean-option',
            'replace' => 'mspre-combo-boolean-option',
            'remove' => 'mspre-combo-boolean-option',
        ),
    ),
    'combo-boolean' => array(
        'id' => '{name}',
        'sortable' => false,
        'dataIndex' => '{name}',
        'editor' => array(
            'name' => '{name}',
            'xtype' => 'loadCombo',
        ),
        'actions' => array(
            'new' => 'mspre-combo-boolean',
            'old' => 'mspre-combo-boolean',
            'replace' => 'mspre-combo-boolean',
            'remove' => 'mspre-combo-boolean',
        ),
    ),
    'combobox' => array(
        'id' => '{name}',
        'sortable' => false,
        'dataIndex' => '{name}',
        'editor' => array(
            'name' => '{name}',
            'xtype' => 'loadCombo',
        ),
        'actions' => array(
            'new' => 'mspre-combo',
            'old' => 'mspre-combo-autocomplete-options',
            'replace' => 'mspre-combo',
            'remove' => 'mspre-combo-autocomplete-options',
        ),
    ),
    'combo-multiple' => array(
        'id' => '{name}',
        'sortable' => false,
        'dataIndex' => '{name}',
        'editor' => array(
            'name' => '{name}',
            'xtype' => 'loadCombo',
        ),
        'actions' => array(
            'new' => 'mspre-combo-options',
            'old' => 'mspre-combo-autocomplete-options',
            'replace' => 'mspre-combo-options',
            'remove' => 'mspre-combo-autocomplete-options',
        ),
    ),
    'combo-options' => array(
        'id' => '{name}',
        'dataIndex' => '{name}',
        'sortable' => false,
        'editor' => array(
            'name' => '{name}',
            'xtype' => 'loadCombo',
        ),
        'actions' => array(
            'new' => 'mspre-combo-options',
            'old' => 'mspre-combo-autocomplete-options',
            'replace' => 'mspre-combo-options',
            'remove' => 'mspre-combo-autocomplete-options',
        ),
    ),
    'datefield' => array(
        'id' => '{name}',
        'dataIndex' => '{name}',
        'sortable' => false,
        'editor' => array(
            'name' => '{name}',
            'xtype' => 'loadCombo',
        ),
        'actions' => array(
            'new' => 'xdatetime',
            'old' => 'mspre-combo-autocomplete-options',
            'replace' => 'xdatetime',
            'remove' => 'mspre-combo-autocomplete-options',
        ),
    ),
    'textarea' => array(
        'id' => '{name}',
        'dataIndex' => '{name}',
        'sortable' => false,
        'editor' => array(
            'name' => '{name}',
            'xtype' => 'loadCombo',
        ),
        'actions' => array(
            'new' => 'mspre-combo-options',
            'old' => 'mspre-combo-autocomplete-options',
            'replace' => 'mspre-combo-options',
            'remove' => 'mspre-combo-autocomplete-options',
        ),
    ),
    'textfield' => array(
        'id' => '{name}',
        'dataIndex' => '{name}',
        'sortable' => false,
        'editor' => array(
            'name' => '{name}',
            'xtype' => 'loadCombo',
        ),
        'actions' => array(
            'new' => 'textfield',
            'old' => 'mspre-combo-autocomplete-options',
            'replace' => 'textfield',
            'remove' => 'mspre-combo-autocomplete-options',
        ),
    ),
    'numberfield' => array(
        'id' => '{name}',
        'dataIndex' => '{name}',
        'sortable' => false,
        'editor' => array(
            'name' => '{name}',
            'xtype' => 'loadCombo',
        ),
        'actions' => array(
            'new' => 'numberfield',
            'old' => 'mspre-combo-autocomplete-options',
            'replace' => 'numberfield',
            'remove' => 'mspre-combo-autocomplete-options',
        ),
    ),
);
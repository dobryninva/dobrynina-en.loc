<?php
return array(
    'id' => array(
        'id' => 'id',
        'sortable' => true,
        'dataIndex' => 'id',
        'editor' => false,
        'actions' => false
    ),
    'type' => array(
        'id' => 'type',
        'sortable' => true,
        'dataIndex' => 'type',
        'editor' => false,
        'actions' => false
    ),
    'contentType' => array(
        'id' => 'contentType',
        'sortable' => true,
        'dataIndex' => 'contentType',
        'editor' => false,
        'actions' => false
    ),
    'parent' => array(
        'id' => 'parent',
        'sortable' => true,
        'dataIndex' => 'parent',
        'editor' => false,
        'actions' => false
    ),
    'pagetitle' => array(
        'id' => 'product-title',
        'dataIndex' => 'pagetitle',
        'sortable' => true,
        'renderer' => 'mspre.utils.renderPagetitle',
        'editor' => array(
            'name' => 'pagetitle',
            'xtype' => 'textfield'
        ),
        'actions' => false
    ),
    'link_attributes' => array(
        'id' => 'link_attributes',
        'dataIndex' => 'link_attributes',
        'sortable' => true,
        'editor' => array(
            'name' => 'link_attributes',
            'xtype' => 'textfield'
        ),
        'actions' => false
    ),
    'longtitle' => array(
        'id' => 'longtitle',
        'dataIndex' => 'longtitle',
        'sortable' => true,
        'editor' => array(
            'name' => 'longtitle',
            'xtype' => 'textfield'
        ),
        'actions' => false
    ),
    'description' => array(
        'id' => 'description',
        'dataIndex' => 'description',
        'sortable' => false,
        'editor' => array(
            'name' => 'description',
            'xtype' => 'textarea'
        ),
        'actions' => false
    ),
    'alias' => array(
        'id' => 'alias',
        'dataIndex' => 'alias',
        'sortable' => true,
        'editor' => array(
            'name' => 'alias',
            'xtype' => 'textfield',
        ),
        'actions' => false
    ),
    'introtext' => array(
        'id' => 'introtext',
        'dataIndex' => 'introtext',
        'sortable' => true,
        'editor' => array(
            'name' => 'introtext',
            'xtype' => 'textarea',
        ),
        'actions' => false
    ),
    'content' => array(
        'id' => 'content',
        'dataIndex' => 'content',
        'sortable' => true,
        'editor' => array(
            'name' => 'content',
            'xtype' => 'loadResourcePage',
        ),
        'actions' => false
    ),
    'template' => array(
        'id' => 'template',
        'dataIndex' => 'template',
        'sortable' => true,
        'editor' => array(
            'name' => 'template',
            'xtype' => 'mspre-combo-template',
            'renderer' => true,
        ),
        'actions' => false
    ),

    'createdby' => array(
        'id' => 'createdby',
        'dataIndex' => 'createdby',
        'sortable' => true,
        'editor' => array(
            'name' => 'createdby',
            'xtype' => 'mspre-combo-user',
            'renderer' => true,
        ),
        'actions' => false
    ),
    'createdon' => array(
        'id' => 'createdon',
        'dataIndex' => 'createdon',
        'sortable' => true,
        'editor' => false,/*
        'editor' => array(
            'name' => 'createdon',
            'xtype' => 'mspre-xdatetime',
            'timePosition' => 'below',
            'renderer' => 'mspre.utils.formatDate',
        ),*/
        'actions' => false
    ),
    'editedby' => array(
        'id' => 'editedby',
        'dataIndex' => 'editedby',
        'sortable' => true,
        'editor' => array(
            'xtype' => 'mspre-combo-user',
            'name' => 'editedby',
        ),
        'actions' => false
    ),
    'editedon' => array(
        'id' => 'editedon',
        'dataIndex' => 'editedon',
        'sortable' => true,
        'editor' => false,/*
        'editor' => array(
            'name' => 'createdon',
            'xtype' => 'mspre-xdatetime',
            'timePosition' => 'below',
            'renderer' => 'mspre.utils.formatDate',
        ),*/
        'actions' => false
    ),
    'deleted' => array(
        'id' => 'deleted',
        'dataIndex' => 'deleted',
        'sortable' => true,
        'editor' => array(
            'name' => 'deleted',
            'xtype' => 'combo-boolean',
            'renderer' => 'boolean'
        ),
        'actions' => false
    ),
    'deletedon' => array(
        'id' => 'deletedon',
        'dataIndex' => 'deletedon',
        'sortable' => true,
        'editor' => false,/*
        'editor' => array(
            'name' => 'createdon',
            'xtype' => 'mspre-xdatetime',
            'timePosition' => 'below',
            'renderer' => 'mspre.utils.formatDate',
        ),*/
        'actions' => false
    ),


    'deletedby' => array(
        'id' => 'deletedby',
        'dataIndex' => 'deletedby',
        'sortable' => true,
        'editor' => array(
            'name' => 'deletedby',
            'xtype' => 'mspre-combo-user',
        ),
        'actions' => false
    ),


    'published' => array(
        'id' => 'published',
        'dataIndex' => 'published',
        'sortable' => true,
        'editor' => array(
            'name' => 'published',
            'xtype' => 'combo-boolean',
            'renderer' => 'boolean'
        ),
        'actions' => false
    ),


    'publishedon' => array(
        'id' => 'publishedon',
        'dataIndex' => 'publishedon',
        'sortable' => true,
        'editor' => false,/*
        'editor' => array(
            'name' => 'createdon',
            'xtype' => 'mspre-xdatetime',
            'timePosition' => 'below',
            'renderer' => 'mspre.utils.formatDate',
        ),*/
        'actions' => false
    ),
    'pub_date' => array(
        'id' => 'pub_date',
        'dataIndex' => 'pub_date',
        'sortable' => true,
        'editor' => false,/*
        'editor' => array(
            'name' => 'createdon',
            'xtype' => 'mspre-xdatetime',
            'timePosition' => 'below',
            'renderer' => 'mspre.utils.formatDate',
        ),*/
        'actions' => false
    ),
    'unpub_date' => array(
        'id' => 'unpub_date',
        'dataIndex' => 'unpub_date',
        'sortable' => true,
        'editor' => false,/*
        'editor' => array(
            'name' => 'createdon',
            'xtype' => 'mspre-xdatetime',
            'timePosition' => 'below',
            'renderer' => 'mspre.utils.formatDate',
        ),*/
        'actions' => false
    ),

    'class_key' => array(
        'id' => 'class_key',
        'dataIndex' => 'class_key',
        'sortable' => true,
        'editor' => false,
        'actions' => false
    ),

    'publishedby' => array(
        'id' => 'publishedby',
        'dataIndex' => 'publishedby',
        'sortable' => true,
        'editor' => array(
            'name' => 'publishedby',
            'xtype' => 'mspre-combo-user',
            'renderer' => true,
        ),
        'actions' => false
    ),
    'menutitle' => array(
        'id' => 'menutitle',
        'dataIndex' => 'menutitle',
        'sortable' => true,
        'editor' => array(
            'name' => 'menutitle',
            'xtype' => 'textfield',
        ),
        'actions' => false
    ),

    'menuindex' => array(
        'id' => 'menuindex',
        'dataIndex' => 'menuindex',
        'header' => 'idx',
        'sortable' => true,
        'editor' => array(
            'name' => 'menuindex',
            'xtype' => 'numberfield',
        ),
        'actions' => false
    ),

    'uri' => array(
        'id' => 'uri',
        'dataIndex' => 'uri',
        'width' => 30,
        'sortable' => true,
        'editor' => array(
            'name' => 'uri',
            'xtype' => 'textfield',
        ),
        'actions' => false
    ),
    'uri_override' => array(
        'id' => 'uri_override',
        'dataIndex' => 'uri_override',
        'sortable' => true,
        'editor' => array(
            'name' => 'uri_override',
            'xtype' => 'combo-boolean',
            'renderer' => 'boolean'
        ),
        'actions' => false
    ),
    'show_in_tree' => array(
        'id' => 'show_in_tree',
        'dataIndex' => 'show_in_tree',
        'sortable' => true,
        'editor' => array(
            'name' => 'show_in_tree',
            'xtype' => 'combo-boolean',
            'renderer' => 'boolean'
        ),
        'actions' => false
    ),
    'hidemenu' => array(
        'id' => 'hidemenu',
        'dataIndex' => 'hidemenu',
        'sortable' => true,
        'editor' => array(
            'name' => 'hidemenu',
            'xtype' => 'combo-boolean',
            'renderer' => 'boolean'
        ),
        'actions' => false
    ),

    'richtext' => array(
        'id' => 'richtext',
        'dataIndex' => 'richtext',
        'sortable' => true,
        'editor' => array(
            'name' => 'richtext',
            'xtype' => 'combo-boolean',
            'renderer' => 'boolean'
        ),
        'actions' => false
    ),
    'searchable' => array(
        'id' => 'searchable',
        'dataIndex' => 'searchable',
        'sortable' => true,
        'editor' => array(
            'name' => 'searchable',
            'xtype' => 'combo-boolean',
            'renderer' => 'boolean'
        ),
        'actions' => false
    ),
    'cacheable' => array(
        'id' => 'cacheable',
        'dataIndex' => 'cacheable',
        'sortable' => true,
        'editor' => array(
            'name' => 'cacheable',
            'xtype' => 'combo-boolean',
            'renderer' => 'boolean'
        ),
        'actions' => false
    ),
    'isfolder' => array(
        'id' => 'isfolder',
        'dataIndex' => 'isfolder',
        'sortable' => true,
        'editor' => array(
            'name' => 'isfolder',
            'xtype' => 'combo-boolean',
            'renderer' => 'boolean'
        ),
        'actions' => false
    ),
    'donthit' => array(
        'id' => 'donthit',
        'dataIndex' => 'donthit',
        'sortable' => true,
        'editor' => array(
            'name' => 'donthit',
            'xtype' => 'combo-boolean',
            'renderer' => 'boolean'
        ),
        'actions' => false
    ),
    'privateweb' => array(
        'id' => 'privateweb',
        'dataIndex' => 'privateweb',
        'sortable' => true,
        'editor' => array(
            'name' => 'privateweb',
            'xtype' => 'combo-boolean',
            'renderer' => 'boolean'
        ),
        'actions' => false
    ),
    'content_dispo' => array(
        'id' => 'content_dispo',
        'dataIndex' => 'content_dispo',
        'sortable' => true,
        'editor' => array(
            'name' => 'content_dispo',
            'xtype' => 'combo-boolean',
            'renderer' => 'boolean'
        ),
        'actions' => false
    ),
    'privatemgr' => array(
        'id' => 'privatemgr',
        'dataIndex' => 'privatemgr',
        'sortable' => true,
        'editor' => array(
            'name' => 'privatemgr',
            'xtype' => 'combo-boolean',
            'renderer' => 'boolean'
        ),
        'actions' => false
    ),
    'hide_children_in_tree' => array(
        'id' => 'hide_children_in_tree',
        'dataIndex' => 'hide_children_in_tree',
        'sortable' => true,
        'editor' => array(
            'name' => 'hide_children_in_tree',
            'xtype' => 'combo-boolean',
            'renderer' => 'boolean'
        ),
        'actions' => false
    ),
    'context_key' => array(
        'id' => 'context_key',
        'dataIndex' => 'context_key',
        'sortable' => true,
        'editor' => false,
        'actions' => false
    ),
    'content_type' => array(
        'id' => 'content_type',
        'dataIndex' => 'content_type',
        'sortable' => true,
        'editor' => false,
        'actions' => false
    ),
    'properties' => array(
        'id' => 'properties',
        'dataIndex' => 'properties',
        'sortable' => false,
        'editor' => false,
        'actions' => false
    ),
    'new' => array(
        'id' => 'new',
        'dataIndex' => 'new',
        'sortable' => true,
        'editor' => array(
            'name' => 'new',
            'xtype' => 'combo-boolean',
            'renderer' => 'boolean'
        ),
        'actions' => false
    ),
    'favorite' => array(
        'id' => 'favorite',
        'dataIndex' => 'favorite',
        'sortable' => true,
        'editor' => array(
            'name' => 'favorite',
            'xtype' => 'combo-boolean',
            'renderer' => 'boolean'
        ),
        'actions' => false
    ),
    'popular' => array(
        'id' => 'popular',
        'dataIndex' => 'popular',
        'sortable' => true,
        'editor' => array(
            'name' => 'popular',
            'xtype' => 'combo-boolean',
            'renderer' => 'boolean'
        ),
        'actions' => false
    ),

    'vendor' => array(
        'id' => 'vendor',
        'dataIndex' => 'vendor',
        'sortable' => true,
        'renderer' => 'mspre.utils.renderVendor',
        'editor' => array(
            'name' => 'vendor',
            'xtype' => 'mspre-combo-vendor',
            'renderer' => true,
        ),
        'actions' => false
    ),

    /*'vendor_name' => array(
        'id' => 'vendor_name',
        'dataIndex' => 'vendor_name',
        'sortable' => true,
        'editor' => false,
        'actions' => false
    ),*/
    'article' => array(
        'id' => 'article',
        'dataIndex' => 'article',
        'sortable' => true,
        'editor' => array(
            'name' => 'made_in',
            'xtype' => 'textfield',
        ),
        'actions' => false
    ),
    'made_in' => array(
        'id' => 'made_in',
        'dataIndex' => 'made_in',
        'sortable' => true,
        'editor' => array(
            'name' => 'made_in',
            'xtype' => 'textfield',
        ),
        'actions' => false
    ),
    'price' => array(
        'id' => 'price',
        'dataIndex' => 'price',
        'sortable' => true,
        'editor' => array(
            'name' => 'price',
            'xtype' => 'numberfield',
            'decimalPrecision' => 2,
        ),
        'actions' => false
    ),
    'old_price' => array(
        'id' => 'old_price',
        'dataIndex' => 'old_price',
        'sortable' => true,
        'editor' => array(
            'name' => 'made_in',
            'xtype' => 'numberfield',
            'decimalPrecision' => 2,
        ),
        'actions' => false
    ),
    'weight' => array(
        'id' => 'weight',
        'dataIndex' => 'weight',
        'sortable' => true,
        'editor' => array(
            'name' => 'weight',
            'xtype' => 'numberfield',
            'decimalPrecision' => 3,
        ),
        'actions' => false
    ),
    'image' => array(
        'id' => 'product-image',
        'dataIndex' => 'image',
        'sortable' => false,
        'renderer' => 'mspre.utils.renderImage',
        'editor' => array(
            'name' => 'image',
            'xtype' => 'loadResourcePage',
        ),
        'actions' => false
    ),
    'thumb' => array(
        'id' => 'product-thumb',
        'dataIndex' => 'thumb',
        'sortable' => false,
        'renderer' => 'mspre.utils.renderImage',
        'editor' => array(
            'name' => 'thumb',
            'xtype' => 'loadResourcePage',
        ),
        'actions' => false
    ),

    'source' => array(
        'id' => 'source',
        'dataIndex' => 'source',
        'sortable' => true,
        'editor' => false,
        'actions' => false
    ),

    'color' => array(
        'id' => 'color',
        'dataIndex' => 'color',
        'sortable' => false,
        'editor' => array(
            'name' => 'color',
            'xtype' => 'loadComboFields',
        ),
        'actions' => array(
            'new' => 'mspre-combo-options',
            'old' => 'mspre-combo-autocomplete-options',
            'replace' => 'mspre-combo-options',
            'remove' => 'mspre-combo-autocomplete-options',
        ),
    ),
    'tags' => array(
        'id' => 'tags',
        'dataIndex' => 'tags',
        'sortable' => false,
        'editor' => array(
            'name' => 'tags',
            'xtype' => 'loadComboFields',
        ),
        'actions' => array(
            'new' => 'mspre-combo-options',
            'old' => 'mspre-combo-autocomplete-options',
            'replace' => 'mspre-combo-options',
            'remove' => 'mspre-combo-autocomplete-options',
        ),
    ),
    'size' => array(
        'id' => 'size',
        'dataIndex' => 'size',
        'sortable' => false,
        'editor' => array(
            'name' => 'size',
            'xtype' => 'loadComboFields',
        ),
        'actions' => array(
            'new' => 'mspre-combo-options',
            'old' => 'mspre-combo-autocomplete-options',
            'replace' => 'mspre-combo-options',
            'remove' => 'mspre-combo-autocomplete-options',
        ),
    ),

    // System
    'category_name' => array(
        'id' => 'category_name',
        'dataIndex' => 'category_name',
        'sortable' => false,
        'renderer' => 'mspre.utils.renderParentPagetitle',
        'editor' => false,
        'actions' => false
    ),

    'category_pagetitle' => array(
        'id' => 'category_pagetitle',
        'dataIndex' => 'category_pagetitle',
        'sortable' => false,
        'editor' => false,
        'actions' => false
    ),
    'preview_url' => array(
        'id' => 'preview_url',
        'dataIndex' => 'preview_url',
        'sortable' => false,
        'editor' => false,
        'actions' => false
    ),
    'product_link' => array(
        'id' => 'product_link',
        'dataIndex' => 'product_link',
        'sortable' => false,
        'editor' => false,
        'actions' => false
    ),
    'additional_categories' => array(
        'id' => 'additional_categories',
        'dataIndex' => 'additional_categories',
        'sortable' => false,
        'editor' => false,
        'actions' => false
    ),
    'actions' => array(
        'id' => 'actions',
        'dataIndex' => 'actions',
        'sortable' => false,
        'renderer' => 'mspre.utils.renderActions',
        'actions' => false,
        'editor' => false,
    ),
);
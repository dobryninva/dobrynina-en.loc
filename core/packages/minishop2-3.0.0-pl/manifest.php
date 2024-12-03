<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'changelog' => '# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [3.0.0-pl] - 2022-04-27

### Added
- New catalog handlers to store the main controllers: msCartHandler, msOrderHandler, msDeliveryHandler, msPaymentHandler
- System settings: ms2_tmp_storage, ms2_register_frontend
- Database fields ms2_orders.session_id, ms2_order_addresses.email ms2_order_products.properties
- New controllers for db storage, session storage
- New order status Processed
- Method RegisterFrontend

### Changed

- Composite msOrder.Address change owner from foreign to local
- Clear controllers msCartHandler, msOrderHandler, msDeliveryHandler, msPaymentHandler.  Content replaced by stub
- Resolver table.  New mechanism for managing database tables and fields
- Field\'s type  ms2_order_statuses.rank  changed from tinyint to int
- Plugin minishop2.  Added Method RegisterFrontend to section OnLoadWebDocument

### Removed
- Resolver Upgrade

## [2.9.3-pl] - 2021-10-16

### Added

- Added a class for the form of cleaning the trash [#630]

### Changed

- Fixed bug with adding text_address field [#628]

## [2.9.2-pl] - 2021-09-28

### Added

- Added the ability to set / remove product previews [#617]

### Changed

- Removed duplicate code [#619]
- Removed a broken check for resource changes [#618]
- Fixed correct http code 403 in case of unauthorized access to the file [#622]
- Default msProduct class when added to cart [#613]
- Improved overall code readability [#620]
-- Optimized dirname method when connecting files
-- Optimized definition of constants
-- Added PHPDOC
-- Removed commented code and some empty blocks
-- Added access specifier to methods

## [2.9.1-pl] - 2021-09-12

### Added

- Added msVendor fields in the list of order items [#612]
- Added frequently used fields to the address table [#581]

### Changed

- Bug fixed This image is already in the product gallery

## [2.9.0-pl] - 2021-08-25

### Added

- Added wiretapping of initiated context for work from API [#578]
- Added counting of the number of items in the cart [#579]
- Replace ssl certificate for PayPal [#573]
- Added delivery_cost parameter for msOnGetOrderCost event [#585]
- Added the ability to set week start in orders [#570]
- Added support for zero cost

### Changed

- Fixed the logic of registration of the order status label in the order history [#576], [#580]
- Bringing the code to the PSR12 standard [#574]
- Refactoring PSR-12 errors [#577]
- Added a name field for micro-markup [#588]
- Fixed error Cannot read property \'Search\' of undefined [#591]
- getCost method optimized [#602]
- Fixed error create ms2_options table

## [2.8.3-pl] - 2021-04-01

### Changed

- Regular expression update to validate phone number [#563]
- Legacy php backward support [#564]

### Removed

- Removed object references as legacy code. [#566]

## [2.8.2-pl] - 2021-03-15

### Added

- Added support for OR, AND operators in the optionFilters parameter in the msProducts snippet [#539]
- The concept of refactoring the connection of notification scripts [#542]
- Added "Save and close" button on links window [#533]
- Added support for the return parameter in msProducts [#553]

### Changed

- Fix Recoverable error: Object of class msProductData_mysql could not be converted to string [#555]
- Change variables in fenom chunk [#557]
- New keep a changelog format
- Fixed display of product option value on product category page [#547]
- Remove unnecessary type="text/javascript"

### Removed

- Removed unused library `jquery.form` [#544]
- Removed unused old.css file [#552]
- Removed deprecated backward compatibility method with ms1 [#537]
- Remove duplicate css [#558]

## [2.8.1-pl] - 2021-02-14

### Changed

- Fixed Recoverable error: Object of class msProductData_mysql could not be converted to string [PR #532]

## [2.8.0-pl] - 2021-01-27

### Added

- Improvement. Dividing the order amount by the purchase and delivery [PR #507]

### Changed

- Checking if the field free_delivery_amount is present [PR #520]
- Set checkbox value [PR #513]
- Minor English vernacular improvements [PR #512] [PR #511]
- Fixed. Correction of displaying a product category if it is not a container [PR #509]
- Fixed PHP warning: count() error [PR #508]
- Fixing the Notice: Undefined offset error when importing a picture with a Russian name through the \'gallery/upload\' processor [PR #504]
- Converting code to cross-browser ECMAScript 5.1 standard [PR #503]
- Fixed display of settings tabs and resource groups when editing a Category [PR #501]
- Fixed logic for free delivery calculation [PR #498]

### Removed

- Removing the console script for converting from ms1 to ms2 [PR #506]

## [2.7.0-pl - 2020-12-09

### Added

- Improvement. Discount calculation added to the status method in the cart class [PR #497]
- Improvement. Added order product\'s options interface [PR #491]
- Improvement. Added amount for free shipping [PR #490]
- Improvement. Changing any product fields by event msOnGetProductFields [PR #417]
- Improvement. Added an example of displaying product content on Fenom [PR #478]
- Improvement. `ignoreGroups` and `sortGroups` to `msProductOptions` snippet [PR #483]
- Improvement. Added `return` property to `msProductOptions` snippet [PR #484]
- Improvement. Added transparency to disabled grid lines [PR #485]

### Changed

- Fixed problem with "Cannot read property items of undefined" and corrected the order of tabs when creating an item [PR #486]
- Fixed PHP warning: count() [PR #482]
- Fixed baseUrl in media source [PR #489]
- Fixed visual bug [PR #480]

## [2.6.0-pl] - 2020-11-12

### Added

- Added micro-markup [PR #471]
- Added ms2_frontend_country lexicon [PR #470]
- Added displaying of the alt attribute and title in the gallery chunk [PR #469, #472]
- Added display of the gallery tab when creating a product [PR #455]
- Added sortOptions property for snippet msProductOptions [PR #447]
- Added multicontext cart settings [PR #436]
- Added buttons on orders and settings pages [PR #435]
- Added sorting sortOptions in msOptions, msProductOptions [PR #407, #433]
- Added renderBadge to statuses [PR #432]
- Added settings link in miniShop2 menu [PR #430]
- Added msorder_remove permission [PR #421]
- Added icon for image in vendor modal creation [PR #420]
- Added usable choice of chunk in the windows for creating/editing statuses [PR #419]
- Added clone msCategory options on subcategory creation [PR #412]
- Added ids to product tabs [PR #408]
- Added filter on modCategory for options [PR #405]
- Added settings for order numeration [PR #393]
- Added example for webp in media source [PR #385]
- Added reloading order object after changes in changeOrderStatus method [PR #384]
- Added icons for tree from system settings [PR #365]
- Added product cost in cart [PR #358]

### Changed

- Fixed sorting by customer field in the order list [PR #468]
- Updated snippets: msCart, msOrder, msGetOrder and msGallery [PR #461]
- Changed the display encoding of collector messages [PR# 460]
- Changed order of tabs for category [PR #459]
- Expanded functionality of windows for quick creation/updating of product/category [PR #439]
- Fixed clone media source on update if is renamed [PR #438]
- Fixed ui bug header in modal window [PR #434]
- Update lexicons [PR #414]
- Ext.Loader remove asynchronous loading of strftime-min-1.3.js [PR #411]
- Display field key if caption and lexicon entry is empty [PR #401]
- Fix miniShop2.combo.Options paging on local mode [PR #400]
- Fixed deleting link from one-to-one deleting all links [PR #389]
- Switch context if the order context does not match [PR #388]
- Fixed paypal error [PR #387]
- Fixed error 500 if pdoTools not installed [PR #386]
- Change class name to variable in sort processor  [PR #381]
- Moved product gallery tabs if enabled ticket comments [PR #377]
- Moved product tabs [PR #376]
- Fix options bug [PR #374]
- Fix if impossible to remove the "Vendor" field [PR #372]
- Output context name if it is [PR #364]
- Notify user on move product in grid [PR #359]
- Fixed miniShop2.combo.Options [PR #355]

## [2.5.0 pl]

### Added

- Added translation into Belarusian (thanks @dmse4050)
- Improvement. Adding Delete / Update buttons preview in the product gallery [PR #346]
- Improvement. Add drag\'n\'drop sortable for miniShop2.combo.Options [PR #345]
- Improvement. Getting parameters for multi-domain [PR #340]
- Added class small in chunk.ms_cart.tpl [PR #319]
- Added support for *webp images [PR #318]

### Changed

- Fix resetting user id value on expand combobox [PR #351]
- Fix hiding content field via FC [PR #343]
- Fix bug when uploading pictures to the gallery, files remain in the root [PR #349]
- Fix bug when saving order and changing status [PR #348]
- Fix Preventing the removal of goods with the wrong (empty) count [PR #344]
- Fix TV update bug if there are more than 10 during CSV import [PR #341]
- Fixed error "Incorrect decimal value" [PR #338]
- Change update product from grid [PR #337]
- Fix "formatPrice", "formatWeight" [PR #336]
- Optimization of the withdrawal of orders and fix for recounting an order [PR #335]
- Fix cutting Czech characters from username in order [PR #334]
- Fix defaultSortField [PR #333]
- Refactoring Relationship Methods [PR #331, #332]
- Fix set default media source on change resource class_key [PR #330]
- Fix some bugs on manager pages [PR #327]
- Fix romanian lexicon [PR #324]

## [2.4.18 pl]

### Added

- [#315] Added romanian lexicon.
- [#316] Added webp extension for mediaSource.

### Changed

- Update chunks for Bootstrap 4.
- Fixed display of manager tree in MODX 2.7.1
- [#314] Fixed missing categories for options in settings.

## [2.4.17 pl2]

### Changed

- Fixed load of lexicons in contexts.

## [2.4.16 pl]

### Changed

- Fixed possible SQL injections by Agel_Nash
- Change miniShop2::changeOrderStatus
- Change "msProductGetListProcessor"

## [2.4.15 pl]

### Added

- Added new events: "msOnBeforeGetOrderCustomer", "msOnGetOrderCustomer"

### Changed

- Change miniShop2::getCustomerId
- Change submit::msOrderHandler
- Change getDeliveryRequiresFields::msOrderHandler

## [2.4.14 pl]

### Added

- Added new events: "msOnBeforeSaveOrder" and "msOnSaveOrder"

### Changed

- Change miniShop2.combo.Options
- Fixed msCategoryOption permission
- Change receiver validate
- Fixed size gallery [js]
- Fixed height options tree [js]
- Change msProductData::saveProductOptions()
- Change key index prefix length to 191 from 255
- Change new installs to create tables with "InnoDB" engine

## [2.4.13 pl]

### Added

- Added "payment_link" in the snippet msGetOrder.
- Added new event: "msOnGetStatusCart".
- Added ukrainian lexicon.

### Changed

- Fixed "cultureKey" option
- Change Order submit js.
- Fixed msProductData::loadOptions().

## [2.4.12 pl]

### Added

- Added dutch lexicons by Sterc
- Added greek frontend lexicon

### Changed

- When you change the price of a product with msOnGetProductPrice, the old_price will be changed only if the new price is lower.
- Fixed method msProductData:rankProductImages()

## [2.4.11 pl]

### Added

- [mgr] Add contexts list into filters at the orders page.
- [mgr] Add "expand,collapse,check,uncheck" actions to the categories and options trees.

### Changed

- Fixed default path to loading services in the loadCustomClasses() method.
- Update the cost of an orders after product addition.
- Improved processing of products options.
- [mgr] Fixed possible error on get orders statuses list.
- [mgr] Fix "xcheckbox" in a Product options.

### Removed

- Removed call of ms2Gallery::syncFiles() from msProductData::updateProductImage().

## [2.4.10 pl]

### Added

- Added events in the processors of msOrderProduct.

### Changed

- Fixed possible E_WARNING in the snippet msOrder.

## [2.4.9 pl]

### Changed

- Improved loading of pdoTools in snippets

## [12.4.8 pl]

### Added

- Added support of ms2Gallery 2.0.

### Changed

- Media source option "thumbnails" now uses key of array with parameters as alias for thumbnail.
- Fixed bug of gallery with drag-over in Firefox.

### Removed

- Removed system setting "ms2_product_thumbnail_size".

## [2.4.7 pl]

### Changed

- Fixed the loading of product plugins when they can be loaded multiple times.
- Fixed fatal error on get classes in settings with some 3rd party payment methods.
- Fixed bug with incorrect rank of thumbnails after a sorting.

## [2.4.6 pl]

### Added

- Added the checking of users email when getting a customer id for new order.

### Changed

- Improved compatibility with MODX 2.5.2.

## [2.4.5 pl]

### Changed

- Fixed possible error in log on create a new product from cli mode.
- Updated jGrowl to version 1.4.5.

## [2.4.4 pl]

### Changed

- [#242] Ability to specify only needed options in the snippet msProductOptions.
- [#212, #241] Fixed handling of a product options with a dot in the name.
- [#240] Fixed the reset of date fields when product has been edited via category grid.
- [#239] Fixed duplicate and empty options in msProductData.
- [#229, #238] Categories tree now respects the "resource_tree_node_name_fallback" system setting.

## [2.4.3 pl]

### Changed

- [#237] Fixed msProductData::get(\'options\') method.
- [#236] Ability to display category columns of an ordered product.
- [#231] Snippet msOptions now transfers id of a product into a chunk.
- [#230] Fixed the inability to change vendor of a product more than 1 times.
- [#228] Possible fix for "empty file" in product gallery on some server configurations.
- [#227] Improved performance of the grid with options in settings.

## [2.4.2 pl]

### Changed

- Fixed error when system setting "ms2_product_tab_gallery" is disabled.

## [2.4.1 pl2]

### Changed

- Fixed error with overwrite product options when update from category grid.

## [2.4.0 pl]

### Changed

- [#222] Optimized some code in chunks.

## [2.4.0 rc11]

### Changed

- [msGallery] Improved fetching of thumbnails in the snippet.
- [#220] [mgr] Improved the total numbers in the form of orders.

## [2.4.0 rc10]

### Changed

- msPaymentHandler::getOrderHash() now includes order num.

## [2.4.0 rc9]

### Changed

- [#215] Ability to specify working context for cart.

## [1.4.0 rc8]

### Changed

- [#218] The product options are active immediately after assigning them to categories.

## [2.4.0 rc7]

### Changed

- Reverted back #216 due to issues.
- [#216] [msGetOrder] Need to update pdoTools to version 2.5.6-pl to fix this.
- [msGetOrder] Orders are show to all if parameter &id is set.
- [mgr] Fixed number of rows in orders panel.

## [2.4.0 rc6]

### Changed

- [#216] [msGetOrder] Fixed ability to &includeTVs.

## [2.4.0 rc5]

### Removed

- Removed wrong "requires" field in msPayment settings.

## [2.4.0 rc4]

### Changed

- Improved migration of system settings when upgrade from older versions.

## [2.4.0 rc3]

### Changed

- [msGallery] Improved snippet in case when product has no media source set.
- Fixed work with autocomplete product options.

## [2.4.0 rc2]

### Changed

- Fixed duplicate of order number in msOrderHandler.

## [2.4.0 rc1]

### Changed

- Fixed loop error on change class key from modResource to msProduct.

## [2.4.0 rc]

### Added

- [msOrder] New parameter &userFields.
- [msGetOrder] Added chunk tpl.msGetOrder.
- [msOptions] Added chunk tpl.msOptions.
- [msProductOptions] Added chunk tpl.msProductOptions.
- [msGallery] Added chunk tpl.msGallery.
- [msGallery] Added Fotorama script out from the box.

### Changed

- All snippets are completely rewritten.
- All chunks uses Fenom syntax.
- Improved compatibility with MySQL 5.7.
- Improved orders form panel.
- [msOrder] Chunk tpl.msOrder.outer renamed to tpl.msOrder.
- [msCart] Chunk tpl.msCart.outer renamed to tpl.msCart.
- [msGetOrder] Now acts as usual snippet and do not set placeholders to the page by default.
- Improved email chunks. Added common email template.

### Removed

- [msOrder] Removed chunks tpl.msOrder.delivery, tpl.msOrder.payment and tpl.msOrder.success.
- [msCart] Removed chunks tpl.msCart.row and tpl.msCart.empty.
- [msGetOrder] Removed chunk tpl.msGetOrder.row.
- [msOptions] Removed chunks tpl.msOptions.outer and tpl.msOptions.row.
- [msProductOptions] Removed chunks tpl.msProductOptions.outer and tpl.msProductOptions.row.
- [msGallery] Removed chunks tpl.msGallery.outer, tpl.msGallery.row and tpl.msGallery.empty.

## [2.4.0 beta3]

### Changed

- Small improvements of product gallery.
- Improved ExtJS settings panel.

## [2.4.0 beta2]

### Added

- Added system setting "ms2_template_category_default".
- New system to register 3rd party classes of extensions.
- New system to register 3rd party plugins for objects model.
- New logo.

### Changed

- Improved referrals registration.
- Improved ExtJS product panel.
- Emails chunks are now processed by pdoTools.
- Replaced modX::toJSON and modX::fromJSON calls to native functions.
- Improved duplicate of products and categories.
- The data fields of the product are added to the tags of the resource: [[*price]], [[*article]] etc.
- Improved registration of JS and CSS on frontend.
- Javascript callbacks now are arrays with functions. New functions to register and remove callbacks.
- Updated model for MySQL 5.7.
- Improved product gallery.

## [2.4.0 beta1]

### Changed

- Improved categories with products.
- Improved menu of categories in resources tree.
- Ability to change class_key of category.
- Many improvements of ExtJS category panel and products grid.
- Setting ms2_category_content_default is now empty by default.

## [2.4.0 beta0]

### Added

- Added icons for CRCs in managers tree.

### Changed

- Fixed php type of "article" in msProductData xPDO object.
- Improved orders panel.
- Updated builder.
- Minimum version is MODX 2.3.

## [2.2.0 pl2]

### Changed

- ID for Category\'s options tab
- Fix installation for MODX 2.4.0
- msProductOptions product property

## [2.2.0 beta4]

### Changed

- Category pagination fix.
- Fixed bug removal options when modifying and generating images of products
- Don\'t display tplOuter when all options are empty with hideEmpty=1

## [2.2.0 beta3]

### Changed

- Measure units for options.
- Restrictions for option names.
- Superboxselect and checkbox option types.
- Fixed bug with empty options after modResource save.

## [2.2.0 beta2]

### Changed

- Groups of options support.
- hideEmpty parameter in msProductOptions snippet.
- Fixed some bugs.

## [2.2.0 beta]

### Changed

- Custom product options support. More info at modx.pro.
- Fixed TV showing under content.
- Some code refactoring.

## [2.1.12 pl]

### Changed

- Improved installation script for MODX 2.4.

## [2.1.11 pl]

### Added

- Added new events: "msOnBeforeGetOrderCost" and "msOnGetOrderCost".

### Changed

- [mgr] Direct links to orders in manager.

## [2.1.10 pl1]

### Added

- Added support of Tickets 1.6.

### Changed

- Updated pdoTools version in the installer.

## [2.1.9 beta]

### Changed

- Fixed modification of order price by delivery and payment in default order handler.
- Fixed processing of decimal prices in PayPal payment class.
- Improved chunk tpl.msOrder.payment.

## [2.1.8 pl3]

### Changed

- Fixed controllers for MODX 2.3.
- Fixed routes to processors for MODX 2.3.
- Fixed product getlist processor for MODX 2.3.
- Fixed sorting products in category grid by clicking on column header.
- Disabled Bootstrap icons for MODX 2.3.
- Fixed product gallery for MODX 2.3.
- Fixed issue with deleting product files children in MODX 2.3.
- Fixed "autocomplete_err_noquery" error in MODX 2.3.
- [#148] Fixed duplicate connector.
- Fixed work of "minishop2-combo-user" in MODX 2.3.

## [2.1.8 beta]

### Added

- Added field "name" in object msOrderProduct for storing pagetitle of the product.
- Added integer field "type" to msOrder.

### Changed

- Fixed log level in PayPal method.
- Fixed CustomerProfile connection in schema.
- Improved price and weight formatting in orders table.
- Some UI improvements and fixes.

## [2.1.7 pl5]

### Changed

- [#131] Fixed update of product thumb when you update thumbnails.
- [#129] [msGetOrder] Fixed setting of placeholders.
- Fixed work with comments on product panel.
- [msOrder] Now snippet loads "building", "room" and "comment" from extended field of users profile.
- [mgr] Fixed parameter "maxUploadSize" in gallery.

## [2.1.7 pl1]

### Added

- [#113] Added Lithuanian lexicons.
- New system setting "ms2_category_remember_grid".

### Changed

- [#119] Improved compatibility with AjaxManager.
- [#118] Fixed negative cost in payment and delivery methods.
- [#112] Restrict cart items to specific contexts.
- [#111] Fixed remove of products links.
- [#107] Fixed empty customer field if fullname is not specified.
- [#106] Additional check of friendly filename in gallery.

## [2.1.6 pl4]

### Changed

- [#110] Fix generate thumbs on upload for Amazon S3.
- Fixed counting money spent in new customers.
- [#104] Fixed placeholder [[+cart_weight]] in emails.
- [#102] Improved checking of thumbnails url.
- [#98] Refactored permissions in processors.
- [#94] Formatted placeholder [[+cost]] in snippet msCart
- [#78] Fixed setting flag isfolder to false for old category of the product.
- Fixed handling of non-ajax requests.

### Removed

- Removed unnecessary ajax request on add to cart. Fixed possibly E_NOTICE.

## [2.1.5 pl]

### Added

- Added default media source in product "create" processor.
- Added default template in product "create" processor.
- Added buttons in orders management page.

### Changed

- Improved rename of files in gallery.

## [2.1.4 pl5]

### Added

- Added script for import products in core/components/minishop2/import/csv.php.

### Changed

- Fixed icons in chunks.
- [#95] Fixed price and weight format.
- Improved installator. Now you can update chunks on install.
- Fixed possible errors on thumbnail generation.
- Progressive thumbnails in gallery.

## [2.1.3 pl2]

### Added

- Support Bootstrap3.

### Changed

- Fixed E_WARNING in snippet msOptions.
- Fixed bug with php-apc on create order.

## [2.1.2 pl2]

### Changed

- Fixed possibly E_NOTICE in snippets.

## [2.1.2 pl]

### Added

- Added support of non-image files in gallery.
- Added ability to hide tabs of product page in manager. See new system settings.

### Changed

- [#77] Fixed change type of existing resource to "msProduct".
- Improved style of horizontal product tabs.
- Improved proportions in settings tab of category.
- Improved rename of product images.
- Improved retrieving of first thumbnail of image in gallery.
- If you specified wrong "ms2_product_thumbnail_size" parameter, gallery will still work.
- Improved snippet "msGallery" for display non-image files.
- [#84] Fixed displaying of  email of vendor in manager.

## [2.1.1 pl2]

### Changed

- Fixed parameter "&parents" in msProducts.

## [2.1.1 pl]

### Changed

- Snippet msProducts supports pdoTools 1.8.0. Parameter "&showHidden" enabled by default.
- Fixed fatal error with "clearCache" when msProduct created trough processor and it`s parent is not msCategory.
- Improved generation of thumbnails.

## [2.1.1 pl]

### Added

- Added support of component "msDiscount".
- Added counting of total spent sum by every customer in msCustomerProfile.

### Changed

- Fixed access permissions tab on product update.
- Fixed getPrice and getWeight calls in snippet msProducts.
- Improved xtype "minishop2-combo-user".

## [2.1.0 pl2]

### Changed

- Fixed placeholders on msProduct page due to issues with @INLINE chunks.

## [2.1.0 pl1]

### Added

- Added new events: "msOnGetProductPrice" and "msOnGetProductWeight".

### Changed

- Fixed wrong events in database from previous release.
- Changed "vendor_" to "vendor." in msProduct::toArray() for sameness with the snippet msProducts.
- Moved all logic from old action.php to new plugin. File leaved for compatibility with users modified javascript.

## [2.1.0 pl]

### Added

- Added method msPayment::getCost().
- New object "msCustomerProfile". It can be extended by plugins like "msProductData".
- Added new fields in "msProductFile": "hash" for sha1 of file and json field "properties".
- Added check for duplicate images in product gallery by checking hash of the content of file.
- Added new parameters for media source: "maxUploadWidth" and "maxUploadHeight" for frontend image resize.
- Added renaming files of product gallery together with thumbnails.
- [#73] Added virtual vendor fields. You can get it by $res->get(\'vendor_name\');
- [#65] Added new system events: "msOnBeforeValidateOrderValue" and "msOnValidateOrderValue".
- [#64] Added ability to stop switching order status from system plugin.
- [#63] Added new parameters for media source: "imageNameType". Switching to "friendly" will generate names for uploaded files by FURLs algorithm.
- [#61] Added ability to sort products in category by drag and drop.
- [#56] Added JSON field "properties" to "msProductFile".
- [#52] Added ability to customize orders in manager by 3 system setting: "ms2_order_grid_fields", "ms2_order_address_fields" and "ms2_order_product_fields".
- Added method PayPal::getPaymentLink() for continuing interrupted payment process. You will see [[+payment_link]] in emails.
- Added parameters "&tplSingle" and "&toSeparatePlaceholders" to snippet msGallery.

### Changed

- Changed default sort in goods grid on "menuindex, ASC".
- Improved method `msDelivery::getCost()`.
- Improved method msOrderHandler::getCost(). Now you can specify additional percent for delivery and payment in manager.
- Plugin "miniShop2" can automatic save referrers.
- In snippet "msProducts" you can override "where", "select", "leftJoin", "innerJoin" and "rightJoin" properties. Added pdoFetch 1.4.1 support.
- Improved other snippets.
- Changed uploader in product gallery to "Plupload" (Thanks to Alex Rahimov).
- Gallery upload processor now can receive parameters "id" and "file" for external images upload.
- [#77] Fixed changing type of existing resource to "msCategory".
- [#76] Fixed parameter "offset" in msGallery.
- [#75] Remove multi-category links when category removed.
- [#74] Refresh data in order from users profile if he is authenticated.
- [#66] Fixed saving payments methods when create a new delivery.
- [#62] Fixed work with "*.gif" files in products gallery.
- [#59] Improved regular expression for email verification.
- [#59] Improved validation of customer name and email when create order.
- [#59] msOrderHandler::add() now can return an error.
- [#59] Improved registration of javascript on frontend.
- [#59] Improved show\\hide of msMiniCart with css.
- [#59] Refactored default frontend javascript.
- [#59] Works with no javascript. (Thanks to Alexey Kartashov)
- [#58] Fixed PayPal non-USD currency.
- [#50] Fixed checking of the existence of the Tickets component.
- [#5] Possible fixed "Cannot execute queries while other unbuffered queries are active" on php < 5.3.
- Some fixes for MySql STRICT_TRANS_TABLES mode.
- Updated jQuery to version 1.10.2
- Gallery UI improvements for MODX 2.2.9
- Returned action.php for backward compatibility with the old javascript

## [2.0.1 pl3]

### Added

- Added german lexicon.

### Changed

- Now you can specify version of file in "ms2_frontend_js".
- [#60] Fixed type of field "index" in "msOrder".
- Improved listing of products in the categories of manager.

## [2.0.1 pl2]

### Changed

- Improved submit of order form.
- msProducts saves order of ids received through &resources=``. It need for smooth work with mSearch2.
- [mgr] Fixed search in vendors combo

## [2.0.1 pl1]

### Added

- Added loading of lexicons for 3rd party payment methods. They must be named in "msp.%name%.inc.php" format.
- Added placeholder [[+payment_link]] in the new user email. It will work only if payment method has function getPaymentLink(msOrder $order);
- [#45] Added system setting for specify default content of category.

### Changed

- [#53] Completely refactored call and processing plugin events.

### Removed

- Removed placeholder [[+id]] from product page because of issues.

## [2.0.1 pl]

### Added

- Added 2 new events on order remove: "msOnBeforeRemoveOrder" and "msOnRemoveOrder".

### Changed

- Improved classes: "msProduct" and "msCategory". Now `$modx->getCollection(\'msProduct\');` returns only products.

## [2.0.1 beta3]

### Changed

- Fixed msGallery

## [2.0.1 beta2]

### Added

- [#42] Added parameter "returnIds" to snippet msProducts.
- Added setting placeholder [[+idx]] to snippets msGallery and msProducts.
- Added parameter "where" in snippet msGallery, for specify JSON encoded string with additional query data.
- Added parameters "limit" and "offset" for pagination. msGallery can be used with getPage now.

### Changed

- [#44] Enabled duplicate of category.
- [#41] Fixed panel with tvs on product create.
- Parameter "resources" not suppressing "parents" in msProducts anymore. Now they working together: resources that are not in parents will not be returned.
- Snippet msGallery now can to display placeholders like [[+600x]] or [[+x600]].
- Fixed display an original image in msGallery. If upgrade, replace placeholders [[+image]] to [[+url]] in chunk "tpl.msGallery.row" manually.

## [2.0.1 beta1]

### Changed

- Maybe fixed bug with php-apc and sessions
- Fixed plugin params on events "msOnBeforeCreateOrder" and "msOnCreateOrder". Now you can change $msOrder by link.
- Fixed error with no changing status of order in manager.

## [2.0.1 beta]

### Added

- [#38] Added "menuindex" in product fields.
- [#35] Added 2 system setting to enable or disable the remembering of panel tabs.
- [#29] Added verification of object instance, when loading neighborhood resources in manager.
- New permissions for work with order: "save" and "view". New events for update order.
- Added ability to add\\update\\remove products in order.

### Changed

- [#37] Ability to override method miniShop2::changeOrderStatus() in custom order class.
- [#32] Enabled displaying of errors when uploading files in product gallery.
- [#30] "miniShopManagerPolicy" is automatically assigned to a group "Administrators".
- [#28] Returned the lost fields in images of msGallery.
- [#27] Improved ajax requests in default javascript.
- [#26] Improvements of categories tree.
- Fixed quick fields in snippet msOrder. Update your chunks for delivery and payment methods.
- Improved "totalVar" placeholder in snippet msGallery.
- Fixed model. Added proper primary keys for xPDOObjects.
- Ability to load only "miniShop2Config" object on frontend, without default javascript and jQuery.
- Fixed parameter "depth" in snippet "msProducts".

### Removed

- [#36] Removed filter_var(), because of issues on stupid hostings.
- [#25] Removed replacing of empty alias to id. Added 2 system setting for switching using resource id as alias for categories and products.

## [2.0.0 pl3]

### Changed

- Compatibility with pdoTools 1.2.0

## [2.0.0 pl2]

### Added

- Added ability to create system setting "ms2_cart_max_count" to override maximum number of products for one operation.
- Added system setting "ms2_price_snippet" for modification of product price.
- Added system setting "ms2_weight_snippet" for modification of product weight.

### Changed

- [mgr] Fixed formatting of dates in category grid.
- [mgr] Fixed decimals in product category grid.
- Fixed placeholders in emails subjects.
- Fixed generation of thumbnails in gallery for working with ImageMagick.
- Fixed link type "Many to many".
- Fixed requirement of non-existing permission "update_document" in processors.
- Product key in msCartHandler now generates with using "$price" and "$weight", because they can be modified when adding to cart.

## [2.0.0 pl1]

### Added

- Added selection of product links in snippet msProducts. See the new snippet properties.
- Added ability to use msProducts with any modResource class.
- Added property "tvPrefix" to msProducts for compatibility with getResources.
- Added property "outputSeparator" to snippets msOptions and msProducts.
- Added system parameter "ms2_price_format" for specifying how to format price of product.
- Added system parameter "ms2_price_format_no_zeros" for optional removing extra zeros at the end of price.
- Added system parameter "ms2_weight_format" for specifying how to format weight of product.
- Added system parameter "ms2_weight_format_no_zeros" for optional removing extra zeros at the end of weight.
- [mgr] New icons in tree

### Changed

- [mgr] Changing of product image now cleans its cache.
- Small improvements of the snippets at initialization.

## [2.0.0 rc6]

### Changed

- Fixed cleaning pdoTools in msGallery
- Improved saving payment method in order when quickly switch delivery.

## [2.0.0 rc5]

### Changed

- Integration of PayPal express-checkout payment method.

## [2.0.0 rc4]

### Changed

- Fixed bugs in snippets
- Fixed joining images by rank when includeThumbs.

## [2.0.0 rc]

### Added

- [mgr] Added displaying of nested products in categories. System setting "ms2_category_show_nested_products" can disable it.
- [mgr] Added the ability to link products together.
- [mgr] Added link to resource from ordered products.
- [mgr] Added ability to specify web document for Vendor by property "resource".
- [#10] Added checking for negative value of adding products in cart.
- [#12] Added regeneration site maps after new product create.
- [#14] Added check of "register_globals" on cart/add.
- Added system setting "ms2_product_thumbnail_size" for setting default size of product thumbnail.
- Added vendor placeholders on product page. Now you can use [[+vendor.name]], [[+vendor.logo]] etc.
- Added beta scripts for console converting miniShop1 to miniShop2.
- Added partial french translation.
- Added method miniShop2::getTagged() from MS1.
- Added ability to load plugins, that can add new or overload existing product fields in model and manager.
- Added parameters for joining thumbnails and tvs in snippets msProducts, msCart and msGetOrder.
- Improved save of product options.

### Changed

- [#6] Fixed error when order makes authenticated user without email.
- [#8] Fixed remove of order.
- [#9] Fixed date formatting in manager for working in Firefox.
- Fixed automatic install of pdoTools.
- Fixed fetching images in snippet msGallery
- Other fixes and improvements.

## [2.0.0 beta-1]

### Added

- Added manager pages
- Added create and manage orders

## [2.0.0 beta-0]

- Initial release.
',
    'license' => 'GNU GENERAL PUBLIC LICENSE
    Version 2, June 1991
--------------------------

Copyright (C) 1989, 1991 Free Software Foundation, Inc.
59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

Everyone is permitted to copy and distribute verbatim copies
of this license document, but changing it is not allowed.

Preamble
--------

The licenses for most software are designed to take away your
freedom to share and change it.  By contrast, the GNU General Public
License is intended to guarantee your freedom to share and change free
software--to make sure the software is free for all its users.  This
General Public License applies to most of the Free Software
Foundation\'s software and to any other program whose authors commit to
using it.  (Some other Free Software Foundation software is covered by
the GNU Library General Public License instead.)  You can apply it to
your programs, too.

When we speak of free software, we are referring to freedom, not
price.  Our General Public Licenses are designed to make sure that you
have the freedom to distribute copies of free software (and charge for
this service if you wish), that you receive source code or can get it
if you want it, that you can change the software or use pieces of it
in new free programs; and that you know you can do these things.

To protect your rights, we need to make restrictions that forbid
anyone to deny you these rights or to ask you to surrender the rights.
These restrictions translate to certain responsibilities for you if you
distribute copies of the software, or if you modify it.

For example, if you distribute copies of such a program, whether
gratis or for a fee, you must give the recipients all the rights that
you have.  You must make sure that they, too, receive or can get the
source code.  And you must show them these terms so they know their
rights.

We protect your rights with two steps: (1) copyright the software, and
(2) offer you this license which gives you legal permission to copy,
distribute and/or modify the software.

Also, for each author\'s protection and ours, we want to make certain
that everyone understands that there is no warranty for this free
software.  If the software is modified by someone else and passed on, we
want its recipients to know that what they have is not the original, so
that any problems introduced by others will not reflect on the original
authors\' reputations.

Finally, any free program is threatened constantly by software
patents.  We wish to avoid the danger that redistributors of a free
program will individually obtain patent licenses, in effect making the
program proprietary.  To prevent this, we have made it clear that any
patent must be licensed for everyone\'s free use or not licensed at all.

The precise terms and conditions for copying, distribution and
modification follow.


GNU GENERAL PUBLIC LICENSE
TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION
---------------------------------------------------------------

0. This License applies to any program or other work which contains
a notice placed by the copyright holder saying it may be distributed
under the terms of this General Public License.  The "Program", below,
refers to any such program or work, and a "work based on the Program"
means either the Program or any derivative work under copyright law:
that is to say, a work containing the Program or a portion of it,
either verbatim or with modifications and/or translated into another
language.  (Hereinafter, translation is included without limitation in
the term "modification".)  Each licensee is addressed as "you".

Activities other than copying, distribution and modification are not
covered by this License; they are outside its scope.  The act of
running the Program is not restricted, and the output from the Program
is covered only if its contents constitute a work based on the
Program (independent of having been made by running the Program).
Whether that is true depends on what the Program does.

1. You may copy and distribute verbatim copies of the Program\'s
source code as you receive it, in any medium, provided that you
conspicuously and appropriately publish on each copy an appropriate
copyright notice and disclaimer of warranty; keep intact all the
notices that refer to this License and to the absence of any warranty;
and give any other recipients of the Program a copy of this License
along with the Program.

You may charge a fee for the physical act of transferring a copy, and
you may at your option offer warranty protection in exchange for a fee.

2. You may modify your copy or copies of the Program or any portion
of it, thus forming a work based on the Program, and copy and
distribute such modifications or work under the terms of Section 1
above, provided that you also meet all of these conditions:

    a) You must cause the modified files to carry prominent notices
    stating that you changed the files and the date of any change.

    b) You must cause any work that you distribute or publish, that in
    whole or in part contains or is derived from the Program or any
    part thereof, to be licensed as a whole at no charge to all third
    parties under the terms of this License.

    c) If the modified program normally reads commands interactively
    when run, you must cause it, when started running for such
    interactive use in the most ordinary way, to print or display an
    announcement including an appropriate copyright notice and a
    notice that there is no warranty (or else, saying that you provide
    a warranty) and that users may redistribute the program under
    these conditions, and telling the user how to view a copy of this
    License.  (Exception: if the Program itself is interactive but
    does not normally print such an announcement, your work based on
    the Program is not required to print an announcement.)

These requirements apply to the modified work as a whole.  If
identifiable sections of that work are not derived from the Program,
and can be reasonably considered independent and separate works in
themselves, then this License, and its terms, do not apply to those
sections when you distribute them as separate works.  But when you
distribute the same sections as part of a whole which is a work based
on the Program, the distribution of the whole must be on the terms of
this License, whose permissions for other licensees extend to the
entire whole, and thus to each and every part regardless of who wrote it.

Thus, it is not the intent of this section to claim rights or contest
your rights to work written entirely by you; rather, the intent is to
exercise the right to control the distribution of derivative or
collective works based on the Program.

In addition, mere aggregation of another work not based on the Program
with the Program (or with a work based on the Program) on a volume of
a storage or distribution medium does not bring the other work under
the scope of this License.

3. You may copy and distribute the Program (or a work based on it,
under Section 2) in object code or executable form under the terms of
Sections 1 and 2 above provided that you also do one of the following:

    a) Accompany it with the complete corresponding machine-readable
    source code, which must be distributed under the terms of Sections
    1 and 2 above on a medium customarily used for software interchange; or,

    b) Accompany it with a written offer, valid for at least three
    years, to give any third party, for a charge no more than your
    cost of physically performing source distribution, a complete
    machine-readable copy of the corresponding source code, to be
    distributed under the terms of Sections 1 and 2 above on a medium
    customarily used for software interchange; or,

    c) Accompany it with the information you received as to the offer
    to distribute corresponding source code.  (This alternative is
    allowed only for noncommercial distribution and only if you
    received the program in object code or executable form with such
    an offer, in accord with Subsection b above.)

The source code for a work means the preferred form of the work for
making modifications to it.  For an executable work, complete source
code means all the source code for all modules it contains, plus any
associated interface definition files, plus the scripts used to
control compilation and installation of the executable.  However, as a
special exception, the source code distributed need not include
anything that is normally distributed (in either source or binary
form) with the major components (compiler, kernel, and so on) of the
operating system on which the executable runs, unless that component
itself accompanies the executable.

If distribution of executable or object code is made by offering
access to copy from a designated place, then offering equivalent
access to copy the source code from the same place counts as
distribution of the source code, even though third parties are not
compelled to copy the source along with the object code.

4. You may not copy, modify, sublicense, or distribute the Program
except as expressly provided under this License.  Any attempt
otherwise to copy, modify, sublicense or distribute the Program is
void, and will automatically terminate your rights under this License.
However, parties who have received copies, or rights, from you under
this License will not have their licenses terminated so long as such
parties remain in full compliance.

5. You are not required to accept this License, since you have not
signed it.  However, nothing else grants you permission to modify or
distribute the Program or its derivative works.  These actions are
prohibited by law if you do not accept this License.  Therefore, by
modifying or distributing the Program (or any work based on the
Program), you indicate your acceptance of this License to do so, and
all its terms and conditions for copying, distributing or modifying
the Program or works based on it.

6. Each time you redistribute the Program (or any work based on the
Program), the recipient automatically receives a license from the
original licensor to copy, distribute or modify the Program subject to
these terms and conditions.  You may not impose any further
restrictions on the recipients\' exercise of the rights granted herein.
You are not responsible for enforcing compliance by third parties to
this License.

7. If, as a consequence of a court judgment or allegation of patent
infringement or for any other reason (not limited to patent issues),
conditions are imposed on you (whether by court order, agreement or
otherwise) that contradict the conditions of this License, they do not
excuse you from the conditions of this License.  If you cannot
distribute so as to satisfy simultaneously your obligations under this
License and any other pertinent obligations, then as a consequence you
may not distribute the Program at all.  For example, if a patent
license would not permit royalty-free redistribution of the Program by
all those who receive copies directly or indirectly through you, then
the only way you could satisfy both it and this License would be to
refrain entirely from distribution of the Program.

If any portion of this section is held invalid or unenforceable under
any particular circumstance, the balance of the section is intended to
apply and the section as a whole is intended to apply in other
circumstances.

It is not the purpose of this section to induce you to infringe any
patents or other property right claims or to contest validity of any
such claims; this section has the sole purpose of protecting the
integrity of the free software distribution system, which is
implemented by public license practices.  Many people have made
generous contributions to the wide range of software distributed
through that system in reliance on consistent application of that
system; it is up to the author/donor to decide if he or she is willing
to distribute software through any other system and a licensee cannot
impose that choice.

This section is intended to make thoroughly clear what is believed to
be a consequence of the rest of this License.

8. If the distribution and/or use of the Program is restricted in
certain countries either by patents or by copyrighted interfaces, the
original copyright holder who places the Program under this License
may add an explicit geographical distribution limitation excluding
those countries, so that distribution is permitted only in or among
countries not thus excluded.  In such case, this License incorporates
the limitation as if written in the body of this License.

9. The Free Software Foundation may publish revised and/or new versions
of the General Public License from time to time.  Such new versions will
be similar in spirit to the present version, but may differ in detail to
address new problems or concerns.

Each version is given a distinguishing version number.  If the Program
specifies a version number of this License which applies to it and "any
later version", you have the option of following the terms and conditions
either of that version or of any later version published by the Free
Software Foundation.  If the Program does not specify a version number of
this License, you may choose any version ever published by the Free Software
Foundation.

10. If you wish to incorporate parts of the Program into other free
programs whose distribution conditions are different, write to the author
to ask for permission.  For software which is copyrighted by the Free
Software Foundation, write to the Free Software Foundation; we sometimes
make exceptions for this.  Our decision will be guided by the two goals
of preserving the free status of all derivatives of our free software and
of promoting the sharing and reuse of software generally.

NO WARRANTY
-----------

11. BECAUSE THE PROGRAM IS LICENSED FREE OF CHARGE, THERE IS NO WARRANTY
FOR THE PROGRAM, TO THE EXTENT PERMITTED BY APPLICABLE LAW.  EXCEPT WHEN
OTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES
PROVIDE THE PROGRAM "AS IS" WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED
OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE.  THE ENTIRE RISK AS
TO THE QUALITY AND PERFORMANCE OF THE PROGRAM IS WITH YOU.  SHOULD THE
PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF ALL NECESSARY SERVICING,
REPAIR OR CORRECTION.

12. IN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED TO IN WRITING
WILL ANY COPYRIGHT HOLDER, OR ANY OTHER PARTY WHO MAY MODIFY AND/OR
REDISTRIBUTE THE PROGRAM AS PERMITTED ABOVE, BE LIABLE TO YOU FOR DAMAGES,
INCLUDING ANY GENERAL, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING
OUT OF THE USE OR INABILITY TO USE THE PROGRAM (INCLUDING BUT NOT LIMITED
TO LOSS OF DATA OR DATA BEING RENDERED INACCURATE OR LOSSES SUSTAINED BY
YOU OR THIRD PARTIES OR A FAILURE OF THE PROGRAM TO OPERATE WITH ANY OTHER
PROGRAMS), EVEN IF SUCH HOLDER OR OTHER PARTY HAS BEEN ADVISED OF THE
POSSIBILITY OF SUCH DAMAGES.

---------------------------
END OF TERMS AND CONDITIONS
',
    'readme' => '--------------------
miniShop2
--------------------
Author: Vasiliy Naumkin <bezumkin@yandex.ru>
--------------------

Feel free to suggest ideas/improvements/bugs on GitHub:
http://github.com/bezumkin/miniShop2/issues
',
    'chunks' => 
    array (
      0 => 'msProduct.content',
      1 => 'msProduct.content.fenom',
      2 => 'tpl.msProducts.row',
      3 => 'tpl.msCart',
      4 => 'tpl.msMiniCart',
      5 => 'tpl.msOrder',
      6 => 'tpl.msGetOrder',
      7 => 'tpl.msOptions',
      8 => 'tpl.msProductOptions',
      9 => 'tpl.msGallery',
      10 => 'tpl.msEmail',
      11 => 'tpl.msEmail.new.user',
      12 => 'tpl.msEmail.new.manager',
      13 => 'tpl.msEmail.paid.user',
      14 => 'tpl.msEmail.paid.manager',
      15 => 'tpl.msEmail.sent.user',
      16 => 'tpl.msEmail.cancelled.user',
    ),
    'setup-options' => 'minishop2-3.0.0-pl/setup-options.php',
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => 'd49f7ac4a938af972ac6330c8d59d7f0',
      'native_key' => 'minishop2',
      'filename' => 'modNamespace/6ea917643c6e00bc3d6857744d53ec4d.vehicle',
      'namespace' => 'minishop2',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '74cacc360fd0992a9bcbe26b46714a1b',
      'native_key' => 'mgr_tree_icon_mscategory',
      'filename' => 'modSystemSetting/6001d9494b891db03c25c978eb78a36b.vehicle',
      'namespace' => 'minishop2',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd56f8d66201c9abc5d93c209aa1a9a34',
      'native_key' => 'mgr_tree_icon_msproduct',
      'filename' => 'modSystemSetting/19373c9fba1f42f9121886299b0d7286.vehicle',
      'namespace' => 'minishop2',
    ),
    3 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ca6af18970262c2e21d77b1341ffaa91',
      'native_key' => 'ms2_add_icon_category',
      'filename' => 'modSystemSetting/99fe9cffa0c1cf3f82c12bea2ff6dc55.vehicle',
      'namespace' => 'minishop2',
    ),
    4 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c21651c47c2f922ac05739cfa7e037f2',
      'native_key' => 'ms2_add_icon_product',
      'filename' => 'modSystemSetting/adf8e6cf21fb0a70ce8a543c8935fd09.vehicle',
      'namespace' => 'minishop2',
    ),
    5 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '77bbe874d89f878199fcef1a2be368d8',
      'native_key' => 'ms2_services',
      'filename' => 'modSystemSetting/ca5f8c6a6d5211609cbbb518f6155a52.vehicle',
      'namespace' => 'minishop2',
    ),
    6 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'aeb61a51c556a133a0cc918c087a5204',
      'native_key' => 'ms2_plugins',
      'filename' => 'modSystemSetting/c08c88d8170b409417e4cb246a7ffa34.vehicle',
      'namespace' => 'minishop2',
    ),
    7 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f5d41210a513fe7bcfe69423d2ef0769',
      'native_key' => 'ms2_chunks_categories',
      'filename' => 'modSystemSetting/29c4ec4ac14ea657b0738a01102e2a8e.vehicle',
      'namespace' => 'minishop2',
    ),
    8 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '13882ce010b8755ae046df193a2dc1a5',
      'native_key' => 'ms2_tmp_storage',
      'filename' => 'modSystemSetting/b1c2fbb9d037c7d2a37b690b0e39fc4c.vehicle',
      'namespace' => 'minishop2',
    ),
    9 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '63ff301e2322fe4e8386aaa520ad8b8c',
      'native_key' => 'ms2_category_grid_fields',
      'filename' => 'modSystemSetting/cac9a0532c2e48369a75c1fda1f6e135.vehicle',
      'namespace' => 'minishop2',
    ),
    10 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0dd24a00b0329cdc5f6e3175a0bddffa',
      'native_key' => 'ms2_category_show_nested_products',
      'filename' => 'modSystemSetting/fbbb3b769bcf7d2640b8358f8065a062.vehicle',
      'namespace' => 'minishop2',
    ),
    11 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e0195dca6d988ae447222d92d4138c43',
      'native_key' => 'ms2_category_show_comments',
      'filename' => 'modSystemSetting/cf1f0c3104aabfc388ca081e88ef5fbb.vehicle',
      'namespace' => 'minishop2',
    ),
    12 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '098f39f039bcf607188e07e8ec040a1e',
      'native_key' => 'ms2_category_show_options',
      'filename' => 'modSystemSetting/61eb056d279712b6f9304af919b158b9.vehicle',
      'namespace' => 'minishop2',
    ),
    13 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd56ef0293fcd8899ba6e91fe204a52c6',
      'native_key' => 'ms2_category_remember_tabs',
      'filename' => 'modSystemSetting/051c50cca006c02c1fc57ed7232c4133.vehicle',
      'namespace' => 'minishop2',
    ),
    14 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f83cae96e15fd36ea1f6e852bd0029dc',
      'native_key' => 'ms2_category_id_as_alias',
      'filename' => 'modSystemSetting/b3b7fc216b848927eb871e05d422a8fa.vehicle',
      'namespace' => 'minishop2',
    ),
    15 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '145afee66f247b89b15c12b5622be39a',
      'native_key' => 'ms2_category_content_default',
      'filename' => 'modSystemSetting/4acfad53821098916ab68de65d3b6639.vehicle',
      'namespace' => 'minishop2',
    ),
    16 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e92edc9c528af9eeab89d2504ed234c8',
      'native_key' => 'ms2_template_category_default',
      'filename' => 'modSystemSetting/8c23c4afedbc4e63c0d6cdaaa5df045c.vehicle',
      'namespace' => 'minishop2',
    ),
    17 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd2c49eb13a6dae1363f967b2d1fa551e',
      'native_key' => 'ms2_product_extra_fields',
      'filename' => 'modSystemSetting/f9c417b006c6d9aeb4eb3fc6bf1ffab1.vehicle',
      'namespace' => 'minishop2',
    ),
    18 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f646d4c490e1e56e6415108b668a2c11',
      'native_key' => 'ms2_product_show_comments',
      'filename' => 'modSystemSetting/806a5b8b80322dee0e2af285ee788c7b.vehicle',
      'namespace' => 'minishop2',
    ),
    19 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3b75576289cb1dd22d089a28fc875f31',
      'native_key' => 'ms2_template_product_default',
      'filename' => 'modSystemSetting/3e3d2faa1384ee78c91aab1ff452b7b2.vehicle',
      'namespace' => 'minishop2',
    ),
    20 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '13f65f8dd7ddb99ef67a018bbc3e45f2',
      'native_key' => 'ms2_product_show_in_tree_default',
      'filename' => 'modSystemSetting/faf58a373c3b4243fcb5c231acc27686.vehicle',
      'namespace' => 'minishop2',
    ),
    21 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '322037245bda42c47e4d932be46413b5',
      'native_key' => 'ms2_product_source_default',
      'filename' => 'modSystemSetting/4aab4f32c9bcee910f24766f327121d0.vehicle',
      'namespace' => 'minishop2',
    ),
    22 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd329ce8f3111e1e5947b60e119013f11',
      'native_key' => 'ms2_product_thumbnail_default',
      'filename' => 'modSystemSetting/4b5b4408a3a059fa0e72b5ae7d2f1ee9.vehicle',
      'namespace' => 'minishop2',
    ),
    23 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f470b8ed6b4749e95716e45c9fb787bf',
      'native_key' => 'ms2_product_thumbnail_size',
      'filename' => 'modSystemSetting/5e9aa5a18979d6bfdd488adc3598a755.vehicle',
      'namespace' => 'minishop2',
    ),
    24 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '59d46b7118eec15b732f6f1fc9490968',
      'native_key' => 'ms2_product_remember_tabs',
      'filename' => 'modSystemSetting/6c53cc81b3c0a039f23e6f6df055d6b0.vehicle',
      'namespace' => 'minishop2',
    ),
    25 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '8f5ed3300a4f0b688cd7b54ad57cb86d',
      'native_key' => 'ms2_product_id_as_alias',
      'filename' => 'modSystemSetting/f41c7d547a55ac7143ef706ec6d08bc2.vehicle',
      'namespace' => 'minishop2',
    ),
    26 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '47fe8fac0d9b09bec434d46053be91a3',
      'native_key' => 'ms2_price_format',
      'filename' => 'modSystemSetting/1d334b6c3e6507cd91b5a6ebe4ae73c3.vehicle',
      'namespace' => 'minishop2',
    ),
    27 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '045d8448228298234632819a5a763b33',
      'native_key' => 'ms2_weight_format',
      'filename' => 'modSystemSetting/b0b0b995d74b8bf402e729be06e385bc.vehicle',
      'namespace' => 'minishop2',
    ),
    28 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1ebaafb6437b3a772243d22cd7b30311',
      'native_key' => 'ms2_price_format_no_zeros',
      'filename' => 'modSystemSetting/aafeb033a234d00dda52db2509e8f942.vehicle',
      'namespace' => 'minishop2',
    ),
    29 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '5d0a9cc58c492f1b34366ec188ced22f',
      'native_key' => 'ms2_weight_format_no_zeros',
      'filename' => 'modSystemSetting/c47b1fbeec32ad2433083ddd4d11d022.vehicle',
      'namespace' => 'minishop2',
    ),
    30 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '78e2d33a029b1f8ae2ef595606a19a02',
      'native_key' => 'ms2_product_tab_extra',
      'filename' => 'modSystemSetting/7278ffba459f5e0191442ce83ce863a4.vehicle',
      'namespace' => 'minishop2',
    ),
    31 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '9635886388b5ea756dfc21745b99af1d',
      'native_key' => 'ms2_product_tab_gallery',
      'filename' => 'modSystemSetting/6207acc0ff24bb9b5b479da52296d73d.vehicle',
      'namespace' => 'minishop2',
    ),
    32 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1b40a41a49d41154afbb936974aceba4',
      'native_key' => 'ms2_product_tab_links',
      'filename' => 'modSystemSetting/a848dafbdc28c34d23c77275283ca19c.vehicle',
      'namespace' => 'minishop2',
    ),
    33 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0586c7fcd1d7d239b5549c4396675282',
      'native_key' => 'ms2_product_tab_options',
      'filename' => 'modSystemSetting/a4649b08bf62f7d235a9db69e49c61a0.vehicle',
      'namespace' => 'minishop2',
    ),
    34 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '8945be1622326a5bdc67fd5cc875535b',
      'native_key' => 'ms2_product_tab_categories',
      'filename' => 'modSystemSetting/a64b386aaba4a47432bd776272c9f925.vehicle',
      'namespace' => 'minishop2',
    ),
    35 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c8a55fc75ee52aad1b9a881e1e867696',
      'native_key' => 'ms2_cart_handler_class',
      'filename' => 'modSystemSetting/af797d202a0fc3dcaa751b9dcf83a784.vehicle',
      'namespace' => 'minishop2',
    ),
    36 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '69079399434a4e4578b08aae1c770087',
      'native_key' => 'ms2_cart_context',
      'filename' => 'modSystemSetting/473824073053ef1ce34d57f5c4e7ec43.vehicle',
      'namespace' => 'minishop2',
    ),
    37 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd40f0e39ab56ab172a74757a56510eb5',
      'native_key' => 'ms2_order_format_num',
      'filename' => 'modSystemSetting/27acc3d56f02cc1f7e0fb6e7d75fca2b.vehicle',
      'namespace' => 'minishop2',
    ),
    38 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c3e70433c7645a3d3a187ba8241d0f24',
      'native_key' => 'ms2_order_format_num_separator',
      'filename' => 'modSystemSetting/35622eca66694d7ee6791248ae58f0ef.vehicle',
      'namespace' => 'minishop2',
    ),
    39 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '7d302c6edfe2fdf4416b3915d6d05284',
      'native_key' => 'ms2_order_grid_fields',
      'filename' => 'modSystemSetting/bdd175655a217c4152f6852fe4720ad3.vehicle',
      'namespace' => 'minishop2',
    ),
    40 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3bab23a67ef5fa79d37ceb6253d457c7',
      'native_key' => 'ms2_order_address_fields',
      'filename' => 'modSystemSetting/d17cdaa3bb51d6b8dacf2e3fe91f8624.vehicle',
      'namespace' => 'minishop2',
    ),
    41 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '84d66a17cea6056f2550cc944d0b654b',
      'native_key' => 'ms2_order_product_fields',
      'filename' => 'modSystemSetting/9c8b1450ee6ac083755fca7743e92eb3.vehicle',
      'namespace' => 'minishop2',
    ),
    42 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e2e07c1e18f963a0aa1f559590d9c0ba',
      'native_key' => 'ms2_order_product_options',
      'filename' => 'modSystemSetting/6a1981f1653d3ffbd4ae6535279aa907.vehicle',
      'namespace' => 'minishop2',
    ),
    43 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b056e865b8159efa16f0644fdd507745',
      'native_key' => 'ms2_order_handler_class',
      'filename' => 'modSystemSetting/808d4783c48878816cabdd7afbefb90f.vehicle',
      'namespace' => 'minishop2',
    ),
    44 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '8ea9323f6f20655771105fac15d3f1ed',
      'native_key' => 'ms2_order_user_groups',
      'filename' => 'modSystemSetting/d0c1b48511e5c496cbd39402d2c495cd.vehicle',
      'namespace' => 'minishop2',
    ),
    45 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '84ee9df598c88fa33d4bcff82c5527a4',
      'native_key' => 'ms2_date_format',
      'filename' => 'modSystemSetting/26ee4bdee02e3a99f04b7838a77617bd.vehicle',
      'namespace' => 'minishop2',
    ),
    46 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b24a476402b4935c9556476c7974830e',
      'native_key' => 'ms2_email_manager',
      'filename' => 'modSystemSetting/f3c508c4d211bc35a3fc1a02460e5991.vehicle',
      'namespace' => 'minishop2',
    ),
    47 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '2d4e4705264e10c5267bc5ee1b289f21',
      'native_key' => 'ms2_frontend_css',
      'filename' => 'modSystemSetting/44c7f112efeb7dbdddcc790bb2e41f18.vehicle',
      'namespace' => 'minishop2',
    ),
    48 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd521355ecbbae276bcd315f71c0d2745',
      'native_key' => 'ms2_frontend_message_css',
      'filename' => 'modSystemSetting/af075cf3e1bcf3257578afcfdc54d5d9.vehicle',
      'namespace' => 'minishop2',
    ),
    49 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '751d18c9048d7b62cc48d6be8aab2d62',
      'native_key' => 'ms2_frontend_js',
      'filename' => 'modSystemSetting/8ea37387eb1a83c3b1454ba0d5e1c8d0.vehicle',
      'namespace' => 'minishop2',
    ),
    50 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f7f1e3ed72771db6bd91a45fe00ad1db',
      'native_key' => 'ms2_frontend_message_js',
      'filename' => 'modSystemSetting/efa836ad0cad5db383b6061b07097ed4.vehicle',
      'namespace' => 'minishop2',
    ),
    51 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1773e3ebaf4a82b94728d330ccf4fd58',
      'native_key' => 'ms2_frontend_message_js_settings',
      'filename' => 'modSystemSetting/a50ebafaa94be8bca0a7370ca640e53a.vehicle',
      'namespace' => 'minishop2',
    ),
    52 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b569fef9e1683058f806abba7a2bf148',
      'native_key' => 'ms2_register_frontend',
      'filename' => 'modSystemSetting/b4c40eec0d4c18d8334d4c54467cf4b3.vehicle',
      'namespace' => 'minishop2',
    ),
    53 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'dcd3f199521e73e29488645212055cd7',
      'native_key' => 'ms2_payment_paypal_api_url',
      'filename' => 'modSystemSetting/4bbfb519b0b459202617ecc214139656.vehicle',
      'namespace' => 'minishop2',
    ),
    54 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '291282b619d4afb7f8137eba92c891fe',
      'native_key' => 'ms2_payment_paypal_checkout_url',
      'filename' => 'modSystemSetting/537cc4230e2a97e8198b83b9c5af369a.vehicle',
      'namespace' => 'minishop2',
    ),
    55 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '570386519172ae4f4f23e1326ccbcc4d',
      'native_key' => 'ms2_payment_paypal_currency',
      'filename' => 'modSystemSetting/423908323f97c6ec31ad34b16cdbae82.vehicle',
      'namespace' => 'minishop2',
    ),
    56 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '55863cbae1508c096db3ec6e7868aaa8',
      'native_key' => 'ms2_payment_paypal_user',
      'filename' => 'modSystemSetting/4f76dfd1ea2eefb1e316e0c3f7a804e0.vehicle',
      'namespace' => 'minishop2',
    ),
    57 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '19f399315307a5d542e774e652fbff65',
      'native_key' => 'ms2_payment_paypal_pwd',
      'filename' => 'modSystemSetting/05614681bda7905d1758186b1524460f.vehicle',
      'namespace' => 'minishop2',
    ),
    58 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c4a4790aaa29bd1385a15cef76af3f03',
      'native_key' => 'ms2_payment_paypal_signature',
      'filename' => 'modSystemSetting/8e50f3702437d2c951cce0c131c2e436.vehicle',
      'namespace' => 'minishop2',
    ),
    59 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '5618f285aeffd6a33b2878de5c67aa50',
      'native_key' => 'ms2_payment_paypal_success_id',
      'filename' => 'modSystemSetting/79cf0d5dfcae75d0804ecd4cb73609d6.vehicle',
      'namespace' => 'minishop2',
    ),
    60 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'eea6a86161b72dca7e500da40dc36977',
      'native_key' => 'ms2_payment_paypal_cancel_id',
      'filename' => 'modSystemSetting/4deb2b087214289ada53d39a94b69108.vehicle',
      'namespace' => 'minishop2',
    ),
    61 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c20180a27594e02eddd1347ebfd0b113',
      'native_key' => 'ms2_payment_paypal_cancel_order',
      'filename' => 'modSystemSetting/f9b0a773ce3e676636a4501a79e53586.vehicle',
      'namespace' => 'minishop2',
    ),
    62 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'ae86ee37fa5e6c63afc4fc7953e7d7be',
      'native_key' => 'msOnBeforeAddToCart',
      'filename' => 'modEvent/50efa6c114b2e1afb3a17cc7341681dd.vehicle',
      'namespace' => 'minishop2',
    ),
    63 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '16d7f6108f44e129bd3241ed1ed0f25b',
      'native_key' => 'msOnAddToCart',
      'filename' => 'modEvent/e352d8a0d797cdf8acb17ca737e0c0ae.vehicle',
      'namespace' => 'minishop2',
    ),
    64 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '231b6eadd57d11ece3f43d6cc4834ec0',
      'native_key' => 'msOnBeforeChangeInCart',
      'filename' => 'modEvent/ed6f48ead608d9794323cb6ac8125438.vehicle',
      'namespace' => 'minishop2',
    ),
    65 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '1162634a1373653e3e1b09616d621386',
      'native_key' => 'msOnChangeInCart',
      'filename' => 'modEvent/f6f218a8d3d0649a6394eadd1dd755cb.vehicle',
      'namespace' => 'minishop2',
    ),
    66 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '97b4487e0a24f4a33ad3cf8ea48bd8ab',
      'native_key' => 'msOnBeforeRemoveFromCart',
      'filename' => 'modEvent/496c987539549059913fbe68b31ff4b0.vehicle',
      'namespace' => 'minishop2',
    ),
    67 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '1860dd6c711534cf24f4d92509684799',
      'native_key' => 'msOnRemoveFromCart',
      'filename' => 'modEvent/2e009c4670d60edeada2b6f059afec5f.vehicle',
      'namespace' => 'minishop2',
    ),
    68 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '45ac1511a87ec5758821a9125480a447',
      'native_key' => 'msOnBeforeEmptyCart',
      'filename' => 'modEvent/8e7a9aca34e96a543dcbdad8ceb0e4a1.vehicle',
      'namespace' => 'minishop2',
    ),
    69 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '1c545e66362a3e4efe6252da444927b5',
      'native_key' => 'msOnEmptyCart',
      'filename' => 'modEvent/474ef0bec99e59ef20d1233f04068971.vehicle',
      'namespace' => 'minishop2',
    ),
    70 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '61ceb56810061ff03b46ab7079641e37',
      'native_key' => 'msOnGetStatusCart',
      'filename' => 'modEvent/308d6d55d04b65533bb09339fad808d0.vehicle',
      'namespace' => 'minishop2',
    ),
    71 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '49839f3c3b095e22bcf03e87dffd50b8',
      'native_key' => 'msOnBeforeAddToOrder',
      'filename' => 'modEvent/a3fe32016e195237ef26b74837cdf84c.vehicle',
      'namespace' => 'minishop2',
    ),
    72 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'b97ec097940160935a6b613070b9e084',
      'native_key' => 'msOnAddToOrder',
      'filename' => 'modEvent/5f1b16404e1bbcd52db0652323e60b04.vehicle',
      'namespace' => 'minishop2',
    ),
    73 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '34057db333dd6414be4f5e9e6514f418',
      'native_key' => 'msOnBeforeValidateOrderValue',
      'filename' => 'modEvent/2d08e60aa1494f034461d5bf32c900f7.vehicle',
      'namespace' => 'minishop2',
    ),
    74 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'bdc0bf89343ec359f94e410d60b2f720',
      'native_key' => 'msOnValidateOrderValue',
      'filename' => 'modEvent/c77c25596e9dbf31c94aedd59f8f88b9.vehicle',
      'namespace' => 'minishop2',
    ),
    75 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '443e54a24fd5e7df789e0a5e9ad6e6d6',
      'native_key' => 'msOnBeforeRemoveFromOrder',
      'filename' => 'modEvent/b8551526155756523218a62aa47159e1.vehicle',
      'namespace' => 'minishop2',
    ),
    76 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'e00cdcfc71dda767982c568ff873c99a',
      'native_key' => 'msOnRemoveFromOrder',
      'filename' => 'modEvent/1741f6f7e824fdd6ad06aec48e2e2544.vehicle',
      'namespace' => 'minishop2',
    ),
    77 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '9e7c09a22eee80eaa70f8b0507527b76',
      'native_key' => 'msOnBeforeEmptyOrder',
      'filename' => 'modEvent/b373f6ab7534ec8f65a1df8166acca46.vehicle',
      'namespace' => 'minishop2',
    ),
    78 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'e331f4691fa65f4532ed6ec745cc48bc',
      'native_key' => 'msOnEmptyOrder',
      'filename' => 'modEvent/422853a20d3260f70fc2cebcd7bb865c.vehicle',
      'namespace' => 'minishop2',
    ),
    79 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '1e012009ddbf07da548a981b4066044f',
      'native_key' => 'msOnBeforeGetOrderCost',
      'filename' => 'modEvent/d160ece7447756804d30bee21f84c8b8.vehicle',
      'namespace' => 'minishop2',
    ),
    80 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '5b8817a4df51e8e62c7b7c048cdd90a3',
      'native_key' => 'msOnGetOrderCost',
      'filename' => 'modEvent/0076be948f35f0a46d6f5fb56a2f53d1.vehicle',
      'namespace' => 'minishop2',
    ),
    81 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '9a3771756f2094cb7289134f8e7ad550',
      'native_key' => 'msOnSubmitOrder',
      'filename' => 'modEvent/30cb88a5ddd34762fc6e4492cfb08d4e.vehicle',
      'namespace' => 'minishop2',
    ),
    82 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '96722310a65eec2bd031183ff3e25989',
      'native_key' => 'msOnBeforeChangeOrderStatus',
      'filename' => 'modEvent/a7049aec8ffab3978c1ecdaa9d8b2015.vehicle',
      'namespace' => 'minishop2',
    ),
    83 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '5115062aaa20bf99ea0514c7b54e6cbf',
      'native_key' => 'msOnChangeOrderStatus',
      'filename' => 'modEvent/cda8f9f50b7e8858081cd7233ce66e0c.vehicle',
      'namespace' => 'minishop2',
    ),
    84 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '80b1866d63c7dcef15c5ca538c84ed1d',
      'native_key' => 'msOnBeforeGetOrderCustomer',
      'filename' => 'modEvent/a7b253eba3908f8868d64ce328e9578a.vehicle',
      'namespace' => 'minishop2',
    ),
    85 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '551fc6d99d707d611e11ef43d246ef65',
      'native_key' => 'msOnGetOrderCustomer',
      'filename' => 'modEvent/287ef8796d8c5f43bfb8266025764c10.vehicle',
      'namespace' => 'minishop2',
    ),
    86 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'cbe9e48c26d1bd5560f1bb4467a2b82c',
      'native_key' => 'msOnBeforeCreateOrder',
      'filename' => 'modEvent/7e82dbd779eaf8b70f91f3d2f033c345.vehicle',
      'namespace' => 'minishop2',
    ),
    87 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '1a64e1a9436ac5322290095a026e88bb',
      'native_key' => 'msOnCreateOrder',
      'filename' => 'modEvent/f464cfdfd83a742305421714cb5d8d84.vehicle',
      'namespace' => 'minishop2',
    ),
    88 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'e78b6a836ca21dada872028aea179727',
      'native_key' => 'msOnBeforeUpdateOrder',
      'filename' => 'modEvent/9de3bd9e23c067487070b589c64716f0.vehicle',
      'namespace' => 'minishop2',
    ),
    89 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'ef2105296d85180af068e81b20b454be',
      'native_key' => 'msOnUpdateOrder',
      'filename' => 'modEvent/63467c3725436e145506a1ae4aa86ccc.vehicle',
      'namespace' => 'minishop2',
    ),
    90 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'a0387a62b77db806b264852a6476dafd',
      'native_key' => 'msOnBeforeSaveOrder',
      'filename' => 'modEvent/883de47b8f03da9ae5164522c273a76a.vehicle',
      'namespace' => 'minishop2',
    ),
    91 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '851ba18647b29f875b77b9b32a126b9a',
      'native_key' => 'msOnSaveOrder',
      'filename' => 'modEvent/ed0096d705693267883d0356ef2427f4.vehicle',
      'namespace' => 'minishop2',
    ),
    92 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'caeaa3b3cf9fcad54ed48e0411a43d57',
      'native_key' => 'msOnBeforeRemoveOrder',
      'filename' => 'modEvent/92d098e70c76b803d80d92c00f1e4d48.vehicle',
      'namespace' => 'minishop2',
    ),
    93 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '3e54b718e09069f0501a3e2c16cfb616',
      'native_key' => 'msOnRemoveOrder',
      'filename' => 'modEvent/8687dc5b26128a7aa7f5e5eec90cb640.vehicle',
      'namespace' => 'minishop2',
    ),
    94 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '7b90bad31ba8591c3e27a394952fd42e',
      'native_key' => 'msOnBeforeCreateOrderProduct',
      'filename' => 'modEvent/f0bb47a99a329656b74d7cb258902411.vehicle',
      'namespace' => 'minishop2',
    ),
    95 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '1673df1f20b16c0e464fe9bdd2311c1b',
      'native_key' => 'msOnCreateOrderProduct',
      'filename' => 'modEvent/91f78f00e52bc7ae5d1d93fd9dbafcfd.vehicle',
      'namespace' => 'minishop2',
    ),
    96 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '54e360054ab4d4132631f4e455598f6c',
      'native_key' => 'msOnBeforeUpdateOrderProduct',
      'filename' => 'modEvent/7bc6eefdc59d6c54d90213db5b904cb8.vehicle',
      'namespace' => 'minishop2',
    ),
    97 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '49341e44cabf6d775d21838217babae7',
      'native_key' => 'msOnUpdateOrderProduct',
      'filename' => 'modEvent/dd93950746a583b2d43b91a8f538e7e0.vehicle',
      'namespace' => 'minishop2',
    ),
    98 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'c15c715329a321b0da430a8dccdc7c3d',
      'native_key' => 'msOnBeforeRemoveOrderProduct',
      'filename' => 'modEvent/2c04be8a611c557a160891512b7fca74.vehicle',
      'namespace' => 'minishop2',
    ),
    99 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'c36a05f4ebae870616a75418782269a5',
      'native_key' => 'msOnRemoveOrderProduct',
      'filename' => 'modEvent/3fa9c0a97851f2c62f312b61c9b1865f.vehicle',
      'namespace' => 'minishop2',
    ),
    100 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'fa9d91387d91e1bafa250fbfa20f27ff',
      'native_key' => 'msOnGetProductPrice',
      'filename' => 'modEvent/061c58501a560a3d36195a96ff99c83f.vehicle',
      'namespace' => 'minishop2',
    ),
    101 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'd1757cc29987114501dce49afee4871b',
      'native_key' => 'msOnGetProductWeight',
      'filename' => 'modEvent/1415c72b431f065c12bb2acd6f097c1b.vehicle',
      'namespace' => 'minishop2',
    ),
    102 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '17580513b91149e8be74c556d6de1899',
      'native_key' => 'msOnGetProductFields',
      'filename' => 'modEvent/4a07c974c7a67daea6e37f182b020549.vehicle',
      'namespace' => 'minishop2',
    ),
    103 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '73e2a02863e39b4ddbb2a9357602230c',
      'native_key' => 'msOnManagerCustomCssJs',
      'filename' => 'modEvent/0c005623e48bf72ff30d06cee39b5db6.vehicle',
      'namespace' => 'minishop2',
    ),
    104 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modAccessPolicy',
      'guid' => 'a66fd620f2e1d3f5802bd54ed367c8d7',
      'native_key' => NULL,
      'filename' => 'modAccessPolicy/3c630b65e7c7a78aa2a29a71a1f3a75a.vehicle',
      'namespace' => 'minishop2',
    ),
    105 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modAccessPolicyTemplate',
      'guid' => 'f7de96d3214c231ca8187647f2cb0999',
      'native_key' => NULL,
      'filename' => 'modAccessPolicyTemplate/0ce4d0705ec903dbc40dc6112dfa2487.vehicle',
      'namespace' => 'minishop2',
    ),
    106 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => 'd32168c3e8f1f68f7215fe8cda8b2182',
      'native_key' => 'minishop2',
      'filename' => 'modMenu/e8fbe23c0a071193e146f14520a2074d.vehicle',
      'namespace' => 'minishop2',
    ),
    107 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => '2d0237e293fd553d91f0a788bd4935e2',
      'native_key' => 'ms2_orders',
      'filename' => 'modMenu/3f4798b5a0b251690d88a4c312d934bf.vehicle',
      'namespace' => 'minishop2',
    ),
    108 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => '40eb91cf6c3ae58848cea346b2fbb2c9',
      'native_key' => 'ms2_settings',
      'filename' => 'modMenu/dd21dea8efe7224f922743e9bb472c32.vehicle',
      'namespace' => 'minishop2',
    ),
    109 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => 'c246411493edbef623b1231820cb5c1c',
      'native_key' => 'ms2_system_settings',
      'filename' => 'modMenu/1aaeaaa835d96faf51e4926094a1581b.vehicle',
      'namespace' => 'minishop2',
    ),
    110 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modCategory',
      'guid' => '7ef5ee0c23b6d6047813211d1acbb150',
      'native_key' => 1,
      'filename' => 'modCategory/de9b903b83a75c9f9ea7198ddbb9e56c.vehicle',
      'namespace' => 'minishop2',
    ),
  ),
);
<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'changelog' => '# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [4.3.0-pl] - 2022-07-01

### Added
- New mgr section  Utilites
- Utilites\\Tab "Update previews" #868
- Utilites\\Tab "Import from CSV" #883
- Hash in URl for settings tabs #887

 ### Changed
 - ReadMe  (added link in post about testing PR) #888


## [4.2.2-pl] - 2022-06-01

### Added
 - New Crowdin updates

 ### Changed
 - Update plupload plugin

### Fixed
-  change visibility of method msCartHandler::getProductKey


## [4.2.1-pl] - 2022-05-07

### Fixed
-  A bug with lost field for msVendor.rank

 ### Changed
 - The regular expression for validating a phone number in an order has been moved to the system setting
 - All JS code in the new set of scripts is formatted according to eslint rules
 - Minishop2 Config renamed to config in main class of new JS bundle


## [4.2.0-pl] - 2022-05-01

### Added
- Additional Events for Vendors
- New section with information and useful links
- New field rank for msVendor
- Information about the customer in emails to the manager

### Fixed
- The problem of additional shipping costs if it is indicated as a percentage
- Sorting in payment options
- Improved use of return = json mode in msProducts

## [4.1.5-pl] - 2022-04-09

### Fixed
- Fixed a bug with creating cart key with options
- fix CustomInputNumber error in cart

## [4.1.4-pl] - 2022-03-31

### Added
 - New lexicons
 - Ability to attach TV fields to products inside an order letter
 - Ability to regenerate images from the product grid
 - Eslint JS Code Validator

 ### Changed
 - The regular expression for validating a phone number in an order has been moved to the system setting
 - All JS code in the new set of scripts is formatted according to eslint rules
 - Minishop2 Config renamed to config in main class of new JS bundle

 ### Fixed
 -  A bug with missing default value for msOrderAddress.order_id
 -  A bug with dragging goods in the grid

## [4.1.3-pl] - 2022-03-14

### Changed
- Fixed error with return data in snippet msGallery


## [4.1.2-pl] - 2022-02-03

### Changed
- Fixed incorrect preventDefault in vanilla js script

## [4.1.1-pl] - 2022-02-02

### Changed
- Update JS classes names in system settings
- Rename new JS method sendResponse to sendRequest

## [4.1.0-pl] - 2022-31-01

### Added
- New type of options - color selection
- Queue manager support
- Working with lexicons through the crowdln service, similar to MODX
- Additional data returned by the cart when it is changed
- New modes for returning data from msGallery
- System setting ms2_status_canceled


### Changed
- Fixed a bug with simultaneous operation of the basket with different contexts
- Added saving the description field to the gallery/upload processor
- Improved sorting and selection of uploaded files to save the first image to the msProductData table
- Updated the text and values of the setting_ms2_order_product_options system setting
- Fixed a bug with redirection after placing an order in new js
- Many minor syntax and code readability improvements

### Removed
- Setting for button icons in mgr category
- Phone length limitation during validation in the order

## [4.0.0-pl] - 2022-12-18

### Added
- Displaying custom parameters in msProducts.tpl #742
- Patch for error when installing and creating the ms2_options table  #747
- Patch for error with non-existent fields in the tables #749
- Creating a vendor when creating a product #748

## [4.0.0-beta] - 2022-09-16

### Added
- A new set of JS scripts
- Creating an order from the manager
- Ability to assign order statuses for various events (new order, payment, creating draft)

### Changed
- Relationship between msOrder and msOrderAddress
- Interfaces for controllers are moved to a separate file

### Removed
- Plugin fotorama
- Depricated controllers

## [3.0.7-pl] - 2022-09-06

### Added
- MODX and PHP version check before installation
- Snippet options are now available in wrapper chunks
- The ability to search for an order in the admin panel by phone number
- Email field to order address window

### Changed

- Css styles reserved for global layout classes (header, footer, title, count, weight, price, image) in msCart and msGetOrder chunks.

## [3.0.6-pl] - 2022-06-29

### Changed
Improved readability of the code without changing the logic
Fixed potential unknown variable error in  Order.submit method

### Removed
- PayPal payment module

## [3.0.5-pl] - 2022-06-16

### Changed
Fixed bug of linking order and address models
Fixed conflict of identical fields #696

## [3.0.4-pl] - 2022-06-09

### Added
Removal of empty directories of images #685

### Changed
Fix escaping rank field for msProductFile #690
Fix first thumbnail generator #691
load minishop2:default lexicon in registerFrontend #688

## [3.0.3-pl] - 2022-05-30

### Changed
- Fixed error with escaping of the rank on object msOrderStatus
- Added escaping of the rank in upload processor
- Returned the ability to add any fields to the order object

## [3.0.2-pl] - 2022-05-20

### Added
- The ability to update image previews in the product grid
- The ability to specify the role number when registering a user
- Lost system setting ms2_cart_max_count

### Changed
- msCartHandler, msOrderHandler, msDeliveryHandler, msPaymentHandler deprecated file notifications now listen to the log_deprecated system setting
- Escaping of the rank field to support mysql 8

## [3.0.1-pl] - 2022-05-04

### Changed
- Old controllers msCartHandler, msOrderHandler, msDeliveryHandler, msPaymentHandler are marked as deprecated with usage error logged
- The configuration required for JS controllers no longer depends on the included js files and is always available
- DB storage controllers got additional checks
- Update Copyrights

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
Owner: MODX RSC – Russian Speaking Community  https://github.com/modx-pro
Support and development  Nikolay Savin https://t.me/biz87
With questions and problems - contact the https://modx.pro  AND  https://t.me/ru_modx
--------------------

Feel free to suggest ideas/improvements/bugs on GitHub:
https://github.com/modx-pro/miniShop2


',
    'chunks' => 
    array (
      0 => 'msProduct.content',
      1 => 'msProduct.content.fenom',
      2 => 'tpl.msProducts.row',
      3 => 'tpl.msCart',
      4 => 'tpl.msCartNew',
      5 => 'tpl.msMiniCart',
      6 => 'tpl.msOrder',
      7 => 'tpl.msGetOrder',
      8 => 'tpl.msOptions',
      9 => 'tpl.msProductOptions',
      10 => 'tpl.msGallery',
      11 => 'tpl.msGalleryNew',
      12 => 'tpl.msEmail',
      13 => 'tpl.msEmail.new.user',
      14 => 'tpl.msEmail.new.manager',
      15 => 'tpl.msEmail.paid.user',
      16 => 'tpl.msEmail.paid.manager',
      17 => 'tpl.msEmail.sent.user',
      18 => 'tpl.msEmail.cancelled.user',
    ),
    'setup-options' => 'minishop2-4.3.0-pl/setup-options.php',
    'requires' => 
    array (
      'php' => '>=7.0.0',
      'modx' => '<3.0.0',
    ),
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => 'eff9deca9ca5ae13d14058285190a352',
      'native_key' => 'minishop2',
      'filename' => 'modNamespace/df9d17f03f13c0202857201197edd25a.vehicle',
      'namespace' => 'minishop2',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '579124ee4e0d5fa6be7d511f68306044',
      'native_key' => 'mgr_tree_icon_mscategory',
      'filename' => 'modSystemSetting/f6a00e268a3ab066eef651d62c4ee854.vehicle',
      'namespace' => 'minishop2',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '270a38733540611fc0b2f82423bca65e',
      'native_key' => 'mgr_tree_icon_msproduct',
      'filename' => 'modSystemSetting/55c4ae9fb9966f2eca727292cdf7c95c.vehicle',
      'namespace' => 'minishop2',
    ),
    3 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '2a922b2a92a87f702feb811770f258ec',
      'native_key' => 'ms2_services',
      'filename' => 'modSystemSetting/264515d96189d3f6ca0a608918ce7152.vehicle',
      'namespace' => 'minishop2',
    ),
    4 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0ea3830302a4a0779a059a9840846b76',
      'native_key' => 'ms2_plugins',
      'filename' => 'modSystemSetting/42af1865d19a7cfb6d2d37776839b5e2.vehicle',
      'namespace' => 'minishop2',
    ),
    5 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '7ada93c7eb403b99895d7b96ecd83038',
      'native_key' => 'ms2_chunks_categories',
      'filename' => 'modSystemSetting/c284a809754a630d8d46cf89dc683a31.vehicle',
      'namespace' => 'minishop2',
    ),
    6 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'bae56b370cfa5742f9504e546107a594',
      'native_key' => 'ms2_tmp_storage',
      'filename' => 'modSystemSetting/7a68c399404278f88c740686cc529b98.vehicle',
      'namespace' => 'minishop2',
    ),
    7 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1ec0bda1c7c04832216881779bf465bd',
      'native_key' => 'ms2_use_scheduler',
      'filename' => 'modSystemSetting/1b173128d4504f3ae0984d79cf1a155d.vehicle',
      'namespace' => 'minishop2',
    ),
    8 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '038a106d3c6d4cc951d1c46cf4c70168',
      'native_key' => 'ms2_category_grid_fields',
      'filename' => 'modSystemSetting/b5c4bac9787d56ac9c277100382cf3c9.vehicle',
      'namespace' => 'minishop2',
    ),
    9 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '98572065ecf9b57b4fe2766f1b51801d',
      'native_key' => 'ms2_category_show_nested_products',
      'filename' => 'modSystemSetting/e743c1864fddb8d21d8c308c9230365d.vehicle',
      'namespace' => 'minishop2',
    ),
    10 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '5081ebfd812a9ff4f78ceef7c7c83067',
      'native_key' => 'ms2_category_show_comments',
      'filename' => 'modSystemSetting/31d366c57f42b6f036732abfbfc4ab5c.vehicle',
      'namespace' => 'minishop2',
    ),
    11 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'af4ac32624a754b8916f603e3213114b',
      'native_key' => 'ms2_category_show_options',
      'filename' => 'modSystemSetting/6cad4dd62e8bfc1e4aafe274cfa9101c.vehicle',
      'namespace' => 'minishop2',
    ),
    12 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '58392ba2e62f05adf1e325c99bb922e3',
      'native_key' => 'ms2_category_remember_tabs',
      'filename' => 'modSystemSetting/8af84bdce03a341e8506bd31b78f9dac.vehicle',
      'namespace' => 'minishop2',
    ),
    13 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '31b1769d210f7d91f26f3cfa4accc044',
      'native_key' => 'ms2_category_id_as_alias',
      'filename' => 'modSystemSetting/ce9bb4e6ab6af20b16ba65d72f2e45f3.vehicle',
      'namespace' => 'minishop2',
    ),
    14 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c187f9d3f6d08b9f42928c69646d3b65',
      'native_key' => 'ms2_category_content_default',
      'filename' => 'modSystemSetting/c73d20a64e2c04e114a8e042cf53ef7a.vehicle',
      'namespace' => 'minishop2',
    ),
    15 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '99cff285bd33852eb1834451d1bf87ed',
      'native_key' => 'ms2_template_category_default',
      'filename' => 'modSystemSetting/fcf36cebdb9fa3f67e922a6c95dcb3de.vehicle',
      'namespace' => 'minishop2',
    ),
    16 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4107094d220c602f160d9fe6e55dabe3',
      'native_key' => 'ms2_product_extra_fields',
      'filename' => 'modSystemSetting/272789b208ba5bced9584f7c80f0881c.vehicle',
      'namespace' => 'minishop2',
    ),
    17 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4a741eb9568fff799747c1980272db34',
      'native_key' => 'ms2_product_show_comments',
      'filename' => 'modSystemSetting/fc977c2384cf106941ce426e829a8ede.vehicle',
      'namespace' => 'minishop2',
    ),
    18 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '884cc8af47312f2bd5ea3668d7ef9b90',
      'native_key' => 'ms2_template_product_default',
      'filename' => 'modSystemSetting/5b85a2cd9f74e8c34199b55a033b81d7.vehicle',
      'namespace' => 'minishop2',
    ),
    19 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '650a1b050f87d75ffdc12cbd642a38fe',
      'native_key' => 'ms2_product_show_in_tree_default',
      'filename' => 'modSystemSetting/b75f2496ecd31d2c3de3251e7289081e.vehicle',
      'namespace' => 'minishop2',
    ),
    20 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '56ccf21232465c924e2ccebdeca8d01e',
      'native_key' => 'ms2_product_source_default',
      'filename' => 'modSystemSetting/ad279705703f608896401b93f7c0e35e.vehicle',
      'namespace' => 'minishop2',
    ),
    21 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '00c0c84d21f1be3075619716a2f19570',
      'native_key' => 'ms2_product_thumbnail_default',
      'filename' => 'modSystemSetting/3d41df885daf934edc83a8f2901be425.vehicle',
      'namespace' => 'minishop2',
    ),
    22 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '80ca027d1962c4b1159e4a52939c5f23',
      'native_key' => 'ms2_product_thumbnail_size',
      'filename' => 'modSystemSetting/aaa1168401c0c249870dbf6b24592349.vehicle',
      'namespace' => 'minishop2',
    ),
    23 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '5c94b76f9c924c434d57f518ce5c0910',
      'native_key' => 'ms2_product_remember_tabs',
      'filename' => 'modSystemSetting/73a2ca335874eb1237376bea0a09f7bf.vehicle',
      'namespace' => 'minishop2',
    ),
    24 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4aeea98aa6792d04f495767e016c34a5',
      'native_key' => 'ms2_product_id_as_alias',
      'filename' => 'modSystemSetting/a86cf93c983b4471dda763bbff630bbe.vehicle',
      'namespace' => 'minishop2',
    ),
    25 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'cd208952deb305c6cc82b5585ea84b03',
      'native_key' => 'ms2_price_format',
      'filename' => 'modSystemSetting/a944ecc7f14d135c6f40d79e9ac0a18f.vehicle',
      'namespace' => 'minishop2',
    ),
    26 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '73230e67a895c9ae984845112c060684',
      'native_key' => 'ms2_weight_format',
      'filename' => 'modSystemSetting/e4d83bd8bf6329d0a269a5b64ea3cd2f.vehicle',
      'namespace' => 'minishop2',
    ),
    27 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b5d481ea829a9a8c8a378c9221f53025',
      'native_key' => 'ms2_price_format_no_zeros',
      'filename' => 'modSystemSetting/31bf119435b76bf5d93bc803b86d37df.vehicle',
      'namespace' => 'minishop2',
    ),
    28 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '882ec8b61c5560817aa320fbaa95475d',
      'native_key' => 'ms2_weight_format_no_zeros',
      'filename' => 'modSystemSetting/bc44951c9f9b220d66bb8937bc84f255.vehicle',
      'namespace' => 'minishop2',
    ),
    29 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '76ffd1243f5f3cffdab52a5f57b606f0',
      'native_key' => 'ms2_product_tab_extra',
      'filename' => 'modSystemSetting/6094f32765fded98bb1b0b6db0077cee.vehicle',
      'namespace' => 'minishop2',
    ),
    30 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '70e6ad96c7a04f667d0071739baa17e6',
      'native_key' => 'ms2_product_tab_gallery',
      'filename' => 'modSystemSetting/d35cf3dbd702c2f89165e3c90a982d51.vehicle',
      'namespace' => 'minishop2',
    ),
    31 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a5c71ff95052c05f106ed719de0da085',
      'native_key' => 'ms2_product_tab_links',
      'filename' => 'modSystemSetting/1379df3c29b93655e2047c302e02ae88.vehicle',
      'namespace' => 'minishop2',
    ),
    32 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '5221c6b1faf9f304f603db4a30d6b446',
      'native_key' => 'ms2_product_tab_options',
      'filename' => 'modSystemSetting/68b07ebcb4a2fa92810d26838ca47a6b.vehicle',
      'namespace' => 'minishop2',
    ),
    33 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0f5d706168c1c29017375e76c55e1fc1',
      'native_key' => 'ms2_product_tab_categories',
      'filename' => 'modSystemSetting/a2d2510a699a1fb3a94669e0a6113996.vehicle',
      'namespace' => 'minishop2',
    ),
    34 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0b864feb98da749ce254dfd805300e0a',
      'native_key' => 'ms2_cart_handler_class',
      'filename' => 'modSystemSetting/81259903dd4c1178a9e0b91f4f64b3c4.vehicle',
      'namespace' => 'minishop2',
    ),
    35 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3648b8bce1087c3ab0133ad3ccf3fb62',
      'native_key' => 'ms2_cart_context',
      'filename' => 'modSystemSetting/bb39e16bf028172689f52edd0d55e86c.vehicle',
      'namespace' => 'minishop2',
    ),
    36 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'cf349caa7f32010da578c0e8b7ee201a',
      'native_key' => 'ms2_cart_max_count',
      'filename' => 'modSystemSetting/290e107bc3766f796354a75792e1707e.vehicle',
      'namespace' => 'minishop2',
    ),
    37 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'aac9466c73b9e1ec438569fd74a56b7c',
      'native_key' => 'ms2_cart_product_key_fields',
      'filename' => 'modSystemSetting/57999f08123b28cad7c2d9636549cd23.vehicle',
      'namespace' => 'minishop2',
    ),
    38 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '47d37821ee2f91cc23a0e77c2a115135',
      'native_key' => 'ms2_order_format_phone',
      'filename' => 'modSystemSetting/fa8b978d25e570c72aa0965668163cce.vehicle',
      'namespace' => 'minishop2',
    ),
    39 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e037f0b0626cb6e70a502173b9ded823',
      'native_key' => 'ms2_order_format_num',
      'filename' => 'modSystemSetting/9f441d97014efcc47a8bfb9df60314f2.vehicle',
      'namespace' => 'minishop2',
    ),
    40 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '749ba376d8ce5d2eb773074a03eabc74',
      'native_key' => 'ms2_order_format_num_separator',
      'filename' => 'modSystemSetting/60851c1e78f37f55e53d70718043d132.vehicle',
      'namespace' => 'minishop2',
    ),
    41 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b3fcb252d586bac327eff9984d0f5340',
      'native_key' => 'ms2_order_grid_fields',
      'filename' => 'modSystemSetting/8e5205d1b7be97b4b837b2859435ddfc.vehicle',
      'namespace' => 'minishop2',
    ),
    42 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '17ba55fc7e3c3dd57f5a2d5df74bd9e5',
      'native_key' => 'ms2_order_address_fields',
      'filename' => 'modSystemSetting/41e2d0940678b67165fca6bf376da4ae.vehicle',
      'namespace' => 'minishop2',
    ),
    43 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd1edb787077f475abd432bf5c7e4a1a8',
      'native_key' => 'ms2_order_product_fields',
      'filename' => 'modSystemSetting/f07849ed7cc3416f447f83daac7766ca.vehicle',
      'namespace' => 'minishop2',
    ),
    44 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '2c0bf8c64543016f1d69403069d5f41b',
      'native_key' => 'ms2_order_product_options',
      'filename' => 'modSystemSetting/9a96ce5d58d90c3b0189848ea3318f23.vehicle',
      'namespace' => 'minishop2',
    ),
    45 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '79e0cd28868f824305c2dc9e8af92f60',
      'native_key' => 'ms2_order_tv_list',
      'filename' => 'modSystemSetting/9cc7a499e61dff954cbcfd55535cf9ee.vehicle',
      'namespace' => 'minishop2',
    ),
    46 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'dc884cbfd663b85891535781dcdb0096',
      'native_key' => 'ms2_order_handler_class',
      'filename' => 'modSystemSetting/5662c121e97035adc8d3e1d5b78c469e.vehicle',
      'namespace' => 'minishop2',
    ),
    47 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'dda79190a992ed1fb75b6dd8a74c3c2f',
      'native_key' => 'ms2_order_user_groups',
      'filename' => 'modSystemSetting/63a3a4374cbd86680882ef2d13ce2308.vehicle',
      'namespace' => 'minishop2',
    ),
    48 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'affacf9e5eedc8471cee5352bd13390e',
      'native_key' => 'ms2_date_format',
      'filename' => 'modSystemSetting/ce25dad798e86bcff0fa0bebfc467ce4.vehicle',
      'namespace' => 'minishop2',
    ),
    49 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ca559f870c7f757914f2668f9af318d8',
      'native_key' => 'ms2_email_manager',
      'filename' => 'modSystemSetting/1704f31cb0695db552158f9ccd79cea5.vehicle',
      'namespace' => 'minishop2',
    ),
    50 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1a5ef0b496cd0dce4f3dae116f14278d',
      'native_key' => 'ms2_frontend_css',
      'filename' => 'modSystemSetting/0b7e710fb7691e46263173596c4a8bd9.vehicle',
      'namespace' => 'minishop2',
    ),
    51 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '509ee14f4cbd220caf439b9ac86e6351',
      'native_key' => 'ms2_frontend_message_css',
      'filename' => 'modSystemSetting/1537954a5f63e21fc7a693fe44eae318.vehicle',
      'namespace' => 'minishop2',
    ),
    52 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'bd12f8727da31d7cf53a302b4cc43366',
      'native_key' => 'ms2_frontend_js',
      'filename' => 'modSystemSetting/ead992af566ca378023d1b8195301108.vehicle',
      'namespace' => 'minishop2',
    ),
    53 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4a247a02b1d25c27402c35ce38662187',
      'native_key' => 'ms2_frontend_message_js',
      'filename' => 'modSystemSetting/6f792a8a70f8b1512a0254a327dedab0.vehicle',
      'namespace' => 'minishop2',
    ),
    54 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '2e7a93a954b9a8e3da0e2af6c2c737b3',
      'native_key' => 'ms2_frontend_message_js_settings',
      'filename' => 'modSystemSetting/e03d32511b15e5986c01fe76015cd62c.vehicle',
      'namespace' => 'minishop2',
    ),
    55 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '9dee13d07bdb85b76bc5bdbaff30d25a',
      'native_key' => 'ms2_register_frontend',
      'filename' => 'modSystemSetting/5da07c42dee8c4cc4155910f95099466.vehicle',
      'namespace' => 'minishop2',
    ),
    56 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'fcfd6b2615da3cac319e615b4d11e403',
      'native_key' => 'ms2_toggle_js_type',
      'filename' => 'modSystemSetting/1fc9990ec9880e53dee2d76f9d745daa.vehicle',
      'namespace' => 'minishop2',
    ),
    57 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'de5e32d1af4374af305a4ec08137937c',
      'native_key' => 'ms2_vanila_js',
      'filename' => 'modSystemSetting/b0dcd386ba0a5e5a7f3da5605496e5ce.vehicle',
      'namespace' => 'minishop2',
    ),
    58 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '5508089bf201bf8640ed6ac0dd33c9ef',
      'native_key' => 'ms2_frontend_notify_js_settings',
      'filename' => 'modSystemSetting/3f2286307ab9985f48822b82325a2189.vehicle',
      'namespace' => 'minishop2',
    ),
    59 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b8a2f78a08b63c6b721dae0f51042a36',
      'native_key' => 'ms2_cart_js_class_path',
      'filename' => 'modSystemSetting/0386f149b25e103fef9f4e781f99da05.vehicle',
      'namespace' => 'minishop2',
    ),
    60 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '72851129e95bcf150598ef892f84d938',
      'native_key' => 'ms2_cart_js_class_name',
      'filename' => 'modSystemSetting/6684ddeaa5bdc8705f1ca900dc04bd7a.vehicle',
      'namespace' => 'minishop2',
    ),
    61 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '2bebfbfd14998b790d5f5e296a4cbf60',
      'native_key' => 'ms2_order_js_class_path',
      'filename' => 'modSystemSetting/fec4f2bac96085e81b818ad6c9e488af.vehicle',
      'namespace' => 'minishop2',
    ),
    62 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '012459f87949548e503d399f9171b7cf',
      'native_key' => 'ms2_order_js_class_name',
      'filename' => 'modSystemSetting/7b48dfaf77f5ce87e2b3dfe3674df3bb.vehicle',
      'namespace' => 'minishop2',
    ),
    63 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0d09b22c914a7bcda7f624412dc7b4e2',
      'native_key' => 'ms2_notify_js_class_path',
      'filename' => 'modSystemSetting/8ff2dccc464454105877c03de19025d4.vehicle',
      'namespace' => 'minishop2',
    ),
    64 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f8060827e148d4ebaf3a76c17178b634',
      'native_key' => 'ms2_notify_js_class_name',
      'filename' => 'modSystemSetting/a0010a0635556f9e27fb0c0fea8de194.vehicle',
      'namespace' => 'minishop2',
    ),
    65 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'db811217cf61ee5c504b49299116528a',
      'native_key' => 'ms2_status_draft',
      'filename' => 'modSystemSetting/e0c36fb4ee61d2e0c521c608e22f91ce.vehicle',
      'namespace' => 'minishop2',
    ),
    66 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '2ca00e8816c302a388abc2bd4adddb38',
      'native_key' => 'ms2_status_new',
      'filename' => 'modSystemSetting/8cc69a03c9279dd4d96494f1549de63a.vehicle',
      'namespace' => 'minishop2',
    ),
    67 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '106e42fd8f1d07a23fb439ac71c8c54a',
      'native_key' => 'ms2_status_paid',
      'filename' => 'modSystemSetting/cf5bd5859b0e90fc4a884db304f26146.vehicle',
      'namespace' => 'minishop2',
    ),
    68 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd611f96ff636c6f420e5bce10ed9c95b',
      'native_key' => 'ms2_status_canceled',
      'filename' => 'modSystemSetting/5c3fc0845507fb5326e07e6d71c6fc75.vehicle',
      'namespace' => 'minishop2',
    ),
    69 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '2b9f3e8759e5e79d00b6740d3043b35f',
      'native_key' => 'ms2_status_for_stat',
      'filename' => 'modSystemSetting/d8442ed8f2ca889c3bf60dc738fc0b97.vehicle',
      'namespace' => 'minishop2',
    ),
    70 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '7f328d719a126cd3a5bb0bdd8314c158',
      'native_key' => 'ms2_utility_import_fields',
      'filename' => 'modSystemSetting/943a13c03c57d28cb38b8a3e1eddbb29.vehicle',
      'namespace' => 'minishop2',
    ),
    71 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '95ab1ba521ea5b4aca353572b1ec3c68',
      'native_key' => 'ms2_utility_import_fields_delimiter',
      'filename' => 'modSystemSetting/f91220bee5fde74627cfd3fb1329d680.vehicle',
      'namespace' => 'minishop2',
    ),
    72 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '2bd208bd2a4abe1063e1d25bbc255d4b',
      'native_key' => 'msOnBeforeAddToCart',
      'filename' => 'modEvent/6ab24e77a54dd23e7a42e9915e1c12cf.vehicle',
      'namespace' => 'minishop2',
    ),
    73 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'ccd1c0e2c59793095e458043c7eb11c7',
      'native_key' => 'msOnAddToCart',
      'filename' => 'modEvent/9b31dda6fd68f5d8810e5786c2e4c51a.vehicle',
      'namespace' => 'minishop2',
    ),
    74 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '4130b47952cd9b3a3c2e5fb9dfb3df94',
      'native_key' => 'msOnBeforeChangeInCart',
      'filename' => 'modEvent/f74ca827a9086fe0ebc5a8cb9bdcb842.vehicle',
      'namespace' => 'minishop2',
    ),
    75 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '2ba218b80c8d3678a0d05b366d965c77',
      'native_key' => 'msOnChangeInCart',
      'filename' => 'modEvent/cc25f39dc956315d05dc8bf15f3cd601.vehicle',
      'namespace' => 'minishop2',
    ),
    76 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'b5a68a94ddfdbc2b83221daf2a2bdfcc',
      'native_key' => 'msOnBeforeRemoveFromCart',
      'filename' => 'modEvent/ecfbe6c2b3c50d73eaa8980f9bcca794.vehicle',
      'namespace' => 'minishop2',
    ),
    77 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '11b6aa0ac2b5dd120749895a8ae7cd69',
      'native_key' => 'msOnRemoveFromCart',
      'filename' => 'modEvent/ee3f2191b6b194605c4f9d668598c53c.vehicle',
      'namespace' => 'minishop2',
    ),
    78 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'ab9fc36cf9e3bf4a470cb71fa149a126',
      'native_key' => 'msOnBeforeEmptyCart',
      'filename' => 'modEvent/932eeeba2755294ea1d740876e8acd6c.vehicle',
      'namespace' => 'minishop2',
    ),
    79 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'e149a68f572d959b731a8106ec1e7d83',
      'native_key' => 'msOnEmptyCart',
      'filename' => 'modEvent/884aab7e97ef0f9f7cab1b17dd7704ca.vehicle',
      'namespace' => 'minishop2',
    ),
    80 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'bd113af4655e444693080e6a571dc6f7',
      'native_key' => 'msOnGetStatusCart',
      'filename' => 'modEvent/be4f9924d37114c350c734a5dd464461.vehicle',
      'namespace' => 'minishop2',
    ),
    81 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'e5e9546ece5a2bf7b8aa0babc8e3c09b',
      'native_key' => 'msOnBeforeAddToOrder',
      'filename' => 'modEvent/4e564d7b4f95ac9dc1b2bc9087d0d662.vehicle',
      'namespace' => 'minishop2',
    ),
    82 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '3ec6ed5839e3146601aed005afdb9618',
      'native_key' => 'msOnAddToOrder',
      'filename' => 'modEvent/f077eae1a5c735df125ddbda6cfe1543.vehicle',
      'namespace' => 'minishop2',
    ),
    83 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'c93c4000a84123485aa668887df9a406',
      'native_key' => 'msOnBeforeValidateOrderValue',
      'filename' => 'modEvent/8553628d1bf4307326e17cc3e0581271.vehicle',
      'namespace' => 'minishop2',
    ),
    84 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'a59efd10a83fa87cac9bd858e75f2ff3',
      'native_key' => 'msOnValidateOrderValue',
      'filename' => 'modEvent/e26a86aa10013107edf1cee93cb12809.vehicle',
      'namespace' => 'minishop2',
    ),
    85 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '82332faa06f0a585a33b1c58713b8cd1',
      'native_key' => 'msOnBeforeRemoveFromOrder',
      'filename' => 'modEvent/d4dba5034798f3cf1d1ab60272e37bba.vehicle',
      'namespace' => 'minishop2',
    ),
    86 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'f9431e15e3b8e7e323918064f4ac07e8',
      'native_key' => 'msOnRemoveFromOrder',
      'filename' => 'modEvent/4c6cb001c8ba18c7776fbeadc313cd84.vehicle',
      'namespace' => 'minishop2',
    ),
    87 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '0c466f7afab86cbc46040fa7a72d2505',
      'native_key' => 'msOnBeforeEmptyOrder',
      'filename' => 'modEvent/96aeefe0298e8ff05b3021603e06f3f8.vehicle',
      'namespace' => 'minishop2',
    ),
    88 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '7d3eb55f6d8d3de833ccb6467646a54d',
      'native_key' => 'msOnEmptyOrder',
      'filename' => 'modEvent/7e66d58b7a2a047c931d29a1a05035ec.vehicle',
      'namespace' => 'minishop2',
    ),
    89 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '46af27db82a0d09a3d7e11188f362405',
      'native_key' => 'msOnBeforeGetOrderCost',
      'filename' => 'modEvent/d3eb75afcbaa25a887e7f4bf9df5041f.vehicle',
      'namespace' => 'minishop2',
    ),
    90 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'e7142b1f4f1649858d3ffda9a322fcd4',
      'native_key' => 'msOnGetOrderCost',
      'filename' => 'modEvent/f49c526e4b17283aef2b3007fb605203.vehicle',
      'namespace' => 'minishop2',
    ),
    91 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'c74d9b3fc99144d01ada7f4327bf18d3',
      'native_key' => 'msOnSubmitOrder',
      'filename' => 'modEvent/a476212e13762b8cfc9966d5fba25b96.vehicle',
      'namespace' => 'minishop2',
    ),
    92 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'a43960290781d703240620bba6a023a8',
      'native_key' => 'msOnBeforeChangeOrderStatus',
      'filename' => 'modEvent/b5b5bb428dd83bccb64c99c0dcf58dd4.vehicle',
      'namespace' => 'minishop2',
    ),
    93 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '1a3527f05e2c7fcaaa5a72ded51ef033',
      'native_key' => 'msOnChangeOrderStatus',
      'filename' => 'modEvent/8406f0d4c99478703e44f86766500596.vehicle',
      'namespace' => 'minishop2',
    ),
    94 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '06b06ed7cea41913e7b58cb3fa9b6794',
      'native_key' => 'msOnBeforeGetOrderCustomer',
      'filename' => 'modEvent/afd91418a3665c5ee1a79839a7ed8189.vehicle',
      'namespace' => 'minishop2',
    ),
    95 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'a89e5e62ab49b6e442d9620fa9bc3c20',
      'native_key' => 'msOnGetOrderCustomer',
      'filename' => 'modEvent/0f75cd4d351ed27e2b192c948b8436be.vehicle',
      'namespace' => 'minishop2',
    ),
    96 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '9be2b627a495ef8b8db03f486b679ce8',
      'native_key' => 'msOnBeforeCreateOrder',
      'filename' => 'modEvent/2b5d8da13f05d5b507733450a0f1bc9d.vehicle',
      'namespace' => 'minishop2',
    ),
    97 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'e3834480a979f72ee13a0fe14a7ce42f',
      'native_key' => 'msOnBeforeMgrCreateOrder',
      'filename' => 'modEvent/be71a8c72c54a8da703be6385887229e.vehicle',
      'namespace' => 'minishop2',
    ),
    98 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'cb8ea6d18e340b3e536ec3a2f58d50d5',
      'native_key' => 'msOnCreateOrder',
      'filename' => 'modEvent/30b5493f0847c22b182ea39041d156df.vehicle',
      'namespace' => 'minishop2',
    ),
    99 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'e2d5db95e6e991781be4a4b75a6bdf13',
      'native_key' => 'msOnMgrCreateOrder',
      'filename' => 'modEvent/94079c7b17697cf6bde38d86d4fec1eb.vehicle',
      'namespace' => 'minishop2',
    ),
    100 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'ae9c509be53a652583c476e9f22961a4',
      'native_key' => 'msOnBeforeUpdateOrder',
      'filename' => 'modEvent/66e2c35cbadfaacaf02e982b80d630f1.vehicle',
      'namespace' => 'minishop2',
    ),
    101 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '198408786ea4c89e64b381e46d329b79',
      'native_key' => 'msOnUpdateOrder',
      'filename' => 'modEvent/f71daf955aa8def6c45c5b643b3c49d0.vehicle',
      'namespace' => 'minishop2',
    ),
    102 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'e316302ad26f0bb0e463b98615a918e3',
      'native_key' => 'msOnBeforeSaveOrder',
      'filename' => 'modEvent/aed178465ae6c5c44da3223d1411708a.vehicle',
      'namespace' => 'minishop2',
    ),
    103 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '35785f6d53dca1567638179a737eed9d',
      'native_key' => 'msOnSaveOrder',
      'filename' => 'modEvent/6fe2d726a01633c15312916ecf9f4584.vehicle',
      'namespace' => 'minishop2',
    ),
    104 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'f28f44ad81ed1cb6bdb47a1fd84beb4c',
      'native_key' => 'msOnBeforeRemoveOrder',
      'filename' => 'modEvent/73e327459d1af781bac9bfc97818e76b.vehicle',
      'namespace' => 'minishop2',
    ),
    105 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '30ec4274ae3b358c34696fc206be83b0',
      'native_key' => 'msOnRemoveOrder',
      'filename' => 'modEvent/01ede5d407f2af7faf62c7fc36e5e61f.vehicle',
      'namespace' => 'minishop2',
    ),
    106 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '2e127b34c1ea4c14c7e2f9953e2d801b',
      'native_key' => 'msOnBeforeCreateOrderProduct',
      'filename' => 'modEvent/9623d1470881ac2f78110c9ec899c155.vehicle',
      'namespace' => 'minishop2',
    ),
    107 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '9a5861b1ea1bc4cf360aa1b4b302aeda',
      'native_key' => 'msOnCreateOrderProduct',
      'filename' => 'modEvent/afcccae77887845ea2b560a35a7fdf3c.vehicle',
      'namespace' => 'minishop2',
    ),
    108 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'b2c1aceceba2e3502b96b00f8e734b1e',
      'native_key' => 'msOnBeforeUpdateOrderProduct',
      'filename' => 'modEvent/5ca3d6b4bc33f3a6adeee83414d177aa.vehicle',
      'namespace' => 'minishop2',
    ),
    109 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '667d07c30b3a29c95008a22cb9512c97',
      'native_key' => 'msOnUpdateOrderProduct',
      'filename' => 'modEvent/6918d9e792c6b00834c0d07ebc8a59c2.vehicle',
      'namespace' => 'minishop2',
    ),
    110 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'c7c07e80aeeb8875830d006dd88508e0',
      'native_key' => 'msOnBeforeRemoveOrderProduct',
      'filename' => 'modEvent/43d05192dc1d85243dc2f600d7a4fec1.vehicle',
      'namespace' => 'minishop2',
    ),
    111 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '6d2aede040daf83c4af167d3fb022059',
      'native_key' => 'msOnRemoveOrderProduct',
      'filename' => 'modEvent/a798bc33eaf37dd451a15cd753602123.vehicle',
      'namespace' => 'minishop2',
    ),
    112 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'a6c6873d3088252f9e7a9c283b7a1b94',
      'native_key' => 'msOnGetProductPrice',
      'filename' => 'modEvent/795766991e9305ced08d55c9fb6daf32.vehicle',
      'namespace' => 'minishop2',
    ),
    113 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '2675373880a8e93d0a2a5b9667f14ae5',
      'native_key' => 'msOnGetProductWeight',
      'filename' => 'modEvent/18d632063ff0cb5fcda0cdf8cfe930b0.vehicle',
      'namespace' => 'minishop2',
    ),
    114 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '02bcc372f3832274db09cd3372a797b8',
      'native_key' => 'msOnGetProductFields',
      'filename' => 'modEvent/48d14070a1beebdadf5af7aaf9533e91.vehicle',
      'namespace' => 'minishop2',
    ),
    115 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'c3b952860d18974704ba306b13c17d5e',
      'native_key' => 'msOnManagerCustomCssJs',
      'filename' => 'modEvent/dda6bcda380590fa1204940c0c810004.vehicle',
      'namespace' => 'minishop2',
    ),
    116 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '1ac0721b3f4259e03c6293e102a69866',
      'native_key' => 'msOnBeforeVendorCreate',
      'filename' => 'modEvent/b544d0f1b992a5b7ab4055e7df243de1.vehicle',
      'namespace' => 'minishop2',
    ),
    117 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '372124ae12b32775b291505901a23eca',
      'native_key' => 'msOnAfterVendorCreate',
      'filename' => 'modEvent/121686c04c8d8d4efe721ef6da93ba35.vehicle',
      'namespace' => 'minishop2',
    ),
    118 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '64c27baa51569ea3836a695259a219a6',
      'native_key' => 'msOnBeforeVendorUpdate',
      'filename' => 'modEvent/7e92a62c7808cec083566ddf676d100f.vehicle',
      'namespace' => 'minishop2',
    ),
    119 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'c775e7d1e279b456cf317fb3918c4c04',
      'native_key' => 'msOnAfterVendorUpdate',
      'filename' => 'modEvent/74615176de8b935f2816f535cfa6e788.vehicle',
      'namespace' => 'minishop2',
    ),
    120 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'be5d09761f4542a0a1cf7807f4bf3332',
      'native_key' => 'msOnBeforeVendorDelete',
      'filename' => 'modEvent/096179df32081d11828e4f3cc8da8f71.vehicle',
      'namespace' => 'minishop2',
    ),
    121 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '48ad00b0c93af469f129a660516ef0c1',
      'native_key' => 'msOnAfterVendorDelete',
      'filename' => 'modEvent/86bcdb720a16b0ee7ac145c18ac1014f.vehicle',
      'namespace' => 'minishop2',
    ),
    122 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modAccessPolicy',
      'guid' => '9dbcf69535baf26dcc1c8a77be594fca',
      'native_key' => NULL,
      'filename' => 'modAccessPolicy/c27b06bc6f2cfcee432d9e79aef1f5a9.vehicle',
      'namespace' => 'minishop2',
    ),
    123 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modAccessPolicyTemplate',
      'guid' => '84d767a31d4bb27231351282b705cde8',
      'native_key' => NULL,
      'filename' => 'modAccessPolicyTemplate/353d24e89370612f0ceffd1a38a2572f.vehicle',
      'namespace' => 'minishop2',
    ),
    124 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => '2b72898cb3e2f593037512641e8ca337',
      'native_key' => 'minishop2',
      'filename' => 'modMenu/fe0bb027b272204395b588f317a27555.vehicle',
      'namespace' => 'minishop2',
    ),
    125 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => '99da3e328f1ff419f6b78543589fa4e9',
      'native_key' => 'ms2_orders',
      'filename' => 'modMenu/01dc88127662003b1340dc5919fd57e7.vehicle',
      'namespace' => 'minishop2',
    ),
    126 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => '3853263153e93e220e0a8a94437483fc',
      'native_key' => 'ms2_settings',
      'filename' => 'modMenu/543c911979478371b4d4671b37c4e279.vehicle',
      'namespace' => 'minishop2',
    ),
    127 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => 'c858993b117047d34860e27f05d3782b',
      'native_key' => 'ms2_system_settings',
      'filename' => 'modMenu/a60f9f9e98b9609c93e894ef31cb5ae0.vehicle',
      'namespace' => 'minishop2',
    ),
    128 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => '8cb86e1a1bfcd9fb4d6c769456060108',
      'native_key' => 'ms2_help',
      'filename' => 'modMenu/b56533d0893b508b4ef7b758c98d38b1.vehicle',
      'namespace' => 'minishop2',
    ),
    129 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => '84a4d502acae6d75ad01b37b6e95cf36',
      'native_key' => 'ms2_utilities',
      'filename' => 'modMenu/4ac1aa58cb66457a0c6e0b399e4924e8.vehicle',
      'namespace' => 'minishop2',
    ),
    130 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modCategory',
      'guid' => '3c0622cc6ea5d914871244af90253ea9',
      'native_key' => 1,
      'filename' => 'modCategory/219b72ca2da95a5e1a2b850b1ebacc0c.vehicle',
      'namespace' => 'minishop2',
    ),
  ),
);
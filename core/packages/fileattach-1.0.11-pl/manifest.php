<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'changelog' => 'Changelog for FileAttach.

1.0.11pl
==============
- Fix/update media source
- Add tag support
- Add extension filter

1.0.10pl4
==============
- Add internal file translit support
- Configuration keys put to file category

1.0.10pl3
==============
- Make menu router-based, enhances compatibility with 2.3+

1.0.10pl2
==============
- Add file download in manager

1.0.10pl1
==============
- Add support for pagination with new options: totalVar, offset

1.0.10
==============
- Add system event \'faOnRemove\'
- Reformat table view
- Remove unneeded JS objects
- Fix typos, update doc URLs

1.0.9
==============
- Compatibility with MODx >=2.5.2
- Fix MediaSource error with MySQL 5.7 ONLY_FULL_GROUP_BY SQL Mode
- Add download range support, download continuation

1.0.8 pl1
==============
- Remember column sort state in session
- Remember column visibility in session
- Make rank column sortable in resource editor
- Fix button captions / localization
- Reformat code

1.0.8
==============
- Fix margins in panels
- Optimize plugin
- Code cleanup and reformat

1.0.7 pl1
==============
- Add file cleanup on resource removal
- Optimize download processor performance

1.0.7
==============
- Now files are available by unique string file ID
- Add ability to restrict link list access with groups
- Automatically open picker after upload button is clicked

1.0.6
==============
- Add frontend processors
- Add new policy for frontend uploader
- Following system upload file type list
- Don\'t double save on update

1.0.5 pl1
==============
- Add ability to use extension placeholder

1.0.5
==============
- Add ability to allow anonymous download
- Fix snippet arguments typo

1.0.4
==============
- DB scheme enhance
- Add SQLSrv support

1.0.3
==============
- Add compatibility with MODx v2.2
- Snippet fix config loading
- Enhance media source:
    - Extension distinction
    - Display thumbnails

1.0.2
==============
- Add download option
- Add rank field in model
- Add ability to manually rearrange order

1.0.1
==============
- Add ability to hash file if it didn\'t at upload
- Add showSize option to snippet
- Rewritten download processor
- Updated FileItem model
- Add filter for templates in document lister
- UI editor rearrange

1.0.0
==============
- Initial release
',
    'license' => 'GNU GENERAL PUBLIC LICENSE
   Version 3, June 2007

Read full version at:
http://www.gnu.org/licenses/gpl-3.0.en.html
',
    'readme' => '--------------------
FileAttach
--------------------
Author: Vitaly Chekryzhev <13hakta@gmail.com>
--------------------

File attach/upload tool for MODx Revolution.

Feel free to suggest ideas/improvements/bugs on GitHub:
http://github.com/13hakta/FileAttach/issues

Official docs:
http://13hakta.ru/blog/fileattach-en.html (English)
http://13hakta.ru/blog/fileattach.html (Russian)
',
    'setup-options' => 'fileattach-1.0.11-pl/setup-options.php',
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => 'dac611b196d1e457f50e3281cab97876',
      'native_key' => 'fileattach',
      'filename' => 'modNamespace/90d3cb1a2b20d835e8612fac958d1763.vehicle',
      'namespace' => 'fileattach',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd6d00356c493a49ba0d76c99993fd4bc',
      'native_key' => 'fileattach.mediasource',
      'filename' => 'modSystemSetting/f009f0666c56ae124cd5621aec53ff2c.vehicle',
      'namespace' => 'fileattach',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '52aa07697b3f7e4765c7c87ecc63abf6',
      'native_key' => 'fileattach.files_path',
      'filename' => 'modSystemSetting/58ac3914454a13a1a1207e5d87827e51.vehicle',
      'namespace' => 'fileattach',
    ),
    3 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f4af23a2a385426a748a66a3131a9301',
      'native_key' => 'fileattach.templates',
      'filename' => 'modSystemSetting/240503b687cd322b3545b3e6cd195831.vehicle',
      'namespace' => 'fileattach',
    ),
    4 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '04086ec79c8cc41a6683220381c4905c',
      'native_key' => 'fileattach.user_folders',
      'filename' => 'modSystemSetting/8f6d95a22edb76536db9c2e942654dec.vehicle',
      'namespace' => 'fileattach',
    ),
    5 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '205c8747367739a9ed00b09d799dea3a',
      'native_key' => 'fileattach.calchash',
      'filename' => 'modSystemSetting/3460225df4e1e46118365aa34191dbba.vehicle',
      'namespace' => 'fileattach',
    ),
    6 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b8dae63ff0ebbb47bf46596acef90d2a',
      'native_key' => 'fileattach.put_docid',
      'filename' => 'modSystemSetting/ff9556d199e486cbab9ecc3c374a0ec6.vehicle',
      'namespace' => 'fileattach',
    ),
    7 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '8a41bd24e5acf4fab3a10f4a57f0f379',
      'native_key' => 'fileattach.private',
      'filename' => 'modSystemSetting/3e1f78c1d80690960168e16c2aada73b.vehicle',
      'namespace' => 'fileattach',
    ),
    8 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '76642345b284e8380b7ea9402f309e20',
      'native_key' => 'fileattach.download',
      'filename' => 'modSystemSetting/5163a627ab577cb2d6e760cb90585a3b.vehicle',
      'namespace' => 'fileattach',
    ),
    9 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '413c8b5492b90e49eeb8abdee2d18e48',
      'native_key' => 'fileattach.translit',
      'filename' => 'modSystemSetting/530f8ead0a5e28066d8cb761c54001ad.vehicle',
      'namespace' => 'fileattach',
    ),
    10 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '6e91a82990b570425bac8f33c30e96fe',
      'native_key' => 'faOnRemove',
      'filename' => 'modEvent/8466c9d968b93fb7a5fb1051143ce227.vehicle',
      'namespace' => 'fileattach',
    ),
    11 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modAccessPolicy',
      'guid' => '912e4f62122137df4284472319aa39ca',
      'native_key' => NULL,
      'filename' => 'modAccessPolicy/1a15a7de75a1c0ebcfda92a4399d2bd9.vehicle',
      'namespace' => 'fileattach',
    ),
    12 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modAccessPolicy',
      'guid' => '072361c5d1962ed21651bacc0da090ae',
      'native_key' => NULL,
      'filename' => 'modAccessPolicy/71a24968efb5aef2af6d01d23bd8a02c.vehicle',
      'namespace' => 'fileattach',
    ),
    13 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modAccessPolicy',
      'guid' => '9c890e0e0ae11f301c3728aa67797916',
      'native_key' => NULL,
      'filename' => 'modAccessPolicy/d835afbb06e643040407f3e7d14183d6.vehicle',
      'namespace' => 'fileattach',
    ),
    14 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modAccessPolicyTemplate',
      'guid' => '9f8b849e336d6efe0f00e3d6544c4a93',
      'native_key' => NULL,
      'filename' => 'modAccessPolicyTemplate/136bbd721810cced72bf7a5890a01ec6.vehicle',
      'namespace' => 'fileattach',
    ),
    15 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => '93dbaa4866b9f0ee2badf742e398d092',
      'native_key' => 'fileattach',
      'filename' => 'modMenu/21aefd1af35f4e160c63f0a38bf005d3.vehicle',
      'namespace' => 'fileattach',
    ),
    16 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modCategory',
      'guid' => '5677fe5edffa50e709f9001d6d55ceec',
      'native_key' => NULL,
      'filename' => 'modCategory/c099b25f7a0bbae76dd00ad5901756f5.vehicle',
      'namespace' => 'fileattach',
    ),
  ),
);
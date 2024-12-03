<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'changelog' => 'Changelog for eshoplogistic3.


0.2.3-pl
==============
08-07-2024
- исправлена передача артикула вместо идентификатора товара при выгрузке в кабинеты ТК


0.2.2-pl
==============
05-07-2024
- улучшена работа с индексом получателя при выгрузке заказа (для Почты России)


0.2.1-pl
==============
03-07-2024
- исправлено при выгрузке в кабинет ТК: количество товаров в заказе при выгрузке
- исправлено: сумма заказа при выгрузке
- исправлено: номер заказа вместо id при выгрузке


0.2.0-pl
==============
11-06-2024
- исправлена ситуация с зависанием, когда НП не может быть определён автоматически
- добавлено сообщение о необходимости указания адреса для курьера и пункта самовывоза для варианта доставки до ПВЗ
- исправлено определение типа оплаты в eshoplogistic3.js


0.1.9-pl
==============
20-05-2024
- дополнительные настройки для автовыгрузки (контроль выгрузки в СДЭК + уточнения)


0.1.8-pl
==============
14-05-2024
- исправлены ошибки для автовыгрузки


0.1.7-pl
==============
14-05-2024
- добавлен учёт дефолтных ВГХ для ручной выгрузки заказа


0.1.6-pl
==============
24-04-2024
- исправлены ошибки


0.1.5-pl
==============
23-04-2024
- + добавлена автоматическая выгрузка заказов


0.1.4-pl
==============
17-04-2024
- + исправлена ошибка в чанке tpl.eshoplogistic3.orderInfo
- + исправлена ошибка в js (получение offers)


0.1.3-pl
==============
01-03-2024
- + исправлена ошибка загрузкой данных заказов, сделанных до версии 0.1.2


0.1.2-pl
==============
29-02-2024
- + исправлена ошибка с обновлением чанков


0.1.1-pl
==============
28-02-2024
- + исправлена ошибка с установкой веса и габаритов по умолчанию из настроек в кабинете my.eshoplogistic.ru


0.1.0-pl
==============
21-02-2024
- + добавлен учёт веса и габаритов по умолчанию из настроек в кабинете my.eshoplogistic.ru
- + исправлена ошибка с указанием количества товара при создании места

0.0.9-pl
==============
15-02-2024
- + добавлена обработка индекса отправителя и получателя



0.0.8-pl
==============
13-01-2024
- + доработана логика js, добавлен параметр eshoplogistic3_default_delivery_id
- + дополнительная обработка ошибки запросов к API



0.0.7-pl
==============
19-12-2023 исправлена установки города доставки при запуске сниппета eshoplogistic3Order + добавлен параметр region


0.0.6-pl
==============
01-12-2023 исправлена ошибка ключа esl в properties msOrder


0.0.5-pl
==============
15-11-2023 адаптация под изменения в последних версиях minishop2


0.0.4-beta
==============
06-07-2023 добавлен partner_key


0.0.3-beta
==============
23-06-2023 добавлена проверка на доступность msDeliveryInterface


0.0.2-beta
==============
13-06-2023 добавлена выгрузка заказов в кабинете "Деловые Линии"


0.0.1-beta
==============',
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
END OF TERMS AND CONDITIONS',
    'readme' => '--------------------
eshoplogistic3
--------------------
Author: John Doe <john@doe.com>
--------------------

A basic Extra for MODx Revolution.',
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => '0732934ce76111847b7e856e2ba845b3',
      'native_key' => 'eshoplogistic3',
      'filename' => 'modNamespace/fce48b2c75ac55f5f3ca5359cb2cef2b.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => '67d6d6463fe0e396eecc453a50face2a',
      'native_key' => 'eshoplogistic3',
      'filename' => 'modMenu/737ef0575f61874e4773fbc59eff2fa8.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '302146bf9b2197f159757f0f891d2ab2',
      'native_key' => 'eshoplogistic3_widgets_source',
      'filename' => 'modSystemSetting/4f241a8f41ed852e209e12784cc3c043.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    3 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'cdce61677441908f9e16f6f493ffef9c',
      'native_key' => 'eshoplogistic3_api_url',
      'filename' => 'modSystemSetting/3f3e12c32dd14108ad5cd286e800f5f7.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    4 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '9512515cb66b349a818dc979bcabd844',
      'native_key' => 'eshoplogistic3_api_key',
      'filename' => 'modSystemSetting/03b1266c3a49c416f83a8d0d5348880f.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    5 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3b0c94c420d27f20c3d0ad4a6c4dc205',
      'native_key' => 'eshoplogistic3_frontend_css',
      'filename' => 'modSystemSetting/f1240fba95c768fae335ba772de4c4c4.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    6 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '04865785b19be40a24a87f85d79bbe3c',
      'native_key' => 'eshoplogistic3_frontend_js',
      'filename' => 'modSystemSetting/f2ea7487d1dc76c379adc27bcc6ca5f7.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    7 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3e0f35261643026cd8307fec396d1410',
      'native_key' => 'eshoplogistic3_manager_widget_key',
      'filename' => 'modSystemSetting/c789e1bb457902b27bb8d80d1873a401.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    8 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a216d8583840ded08013169098297192',
      'native_key' => 'eshoplogistic3_query_log',
      'filename' => 'modSystemSetting/7eb8788ef7e4643e30d6ae5305b4cd66.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    9 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '245f910123918a91d6d900fbefce5e31',
      'native_key' => 'eshoplogistic3_log_mode',
      'filename' => 'modSystemSetting/9d9c0018f13905531e515f4f9607f95b.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    10 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '89a666090e9828afd6e0653461e9a1d8',
      'native_key' => 'eshoplogistic3_chunk_info',
      'filename' => 'modSystemSetting/71e0fabddc2091529a49c5d45970587d.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    11 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'dd35776af1d5e509da8ce252e665e2cc',
      'native_key' => 'eshoplogistic3_min_weight',
      'filename' => 'modSystemSetting/8ecc1173068ab21348d8061f83ac5184.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    12 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a7c064fe21e5e86bd17af25df66b69af',
      'native_key' => 'eshoplogistic3_weight_unit',
      'filename' => 'modSystemSetting/296a1f06466c59aebe48ecc28397ee5c.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    13 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '6045ec210c13c0e91cfada3a3571efdc',
      'native_key' => 'eshoplogistic3_default_delivery_id',
      'filename' => 'modSystemSetting/19046cac4aee2dff572accdc047e22dc.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    14 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '895b35fe6d0dc7df58dfbdc985cf1d6e',
      'native_key' => 'eshoplogistic3_controller',
      'filename' => 'modSystemSetting/2510c8306f6e32861dfb4e23412fd058.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    15 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3f829c59652afabd544a4d9c89627a93',
      'native_key' => 'eshoplogistic3_widget_key',
      'filename' => 'modSystemSetting/06e875687f8bc211e84bb01dd198aeef.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    16 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '537b6a6d24aa50b6c1ec66f1983092f4',
      'native_key' => 'eshoplogistic3_cache_time',
      'filename' => 'modSystemSetting/4610d860548d414cee8d6f3b9354c163.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    17 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3404eccc1e637040ee7371727fcb2058',
      'native_key' => 'eshoplogistic3_payment_on',
      'filename' => 'modSystemSetting/6515c174a97c3f307ed348970ff95aaf.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    18 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c378036b39f5fa00b644c63ea42f8857',
      'native_key' => 'eshoplogistic3_payment_card',
      'filename' => 'modSystemSetting/89888188ec84a0fcf61c476d272dc116.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    19 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0c151b7998ff348c010c17105d36e2e3',
      'native_key' => 'eshoplogistic3_payment_cash',
      'filename' => 'modSystemSetting/9461c157a2f3e4d3cb13339adb7e199b.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    20 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '30ec6b226a919aec05e6521eef83f08e',
      'native_key' => 'eshoplogistic3_payment_cashless',
      'filename' => 'modSystemSetting/7c4b99b6ff8d9838908bc626e965fb49.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    21 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '782dc15252bd31de4c0aae9406ac07ec',
      'native_key' => 'eshoplogistic3_payment_prepay',
      'filename' => 'modSystemSetting/a38fea9126c11da0f49053ac5f1c4659.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    22 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b317405a255c0b1bfe41abb2a96fc620',
      'native_key' => 'eshoplogistic3_payment_upon_receipt',
      'filename' => 'modSystemSetting/7576e0cc09f6c1316100bc2daf981515.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    23 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'bf473a85b392e26157ad2c608fed0ea7',
      'native_key' => 'eshoplogistic3_widget_secrets',
      'filename' => 'modSystemSetting/0595862f5ece4a7e35ab97f69f575019.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    24 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd25502e28ac45e76d17f5cbbc0f1b4ce',
      'native_key' => 'eshoplogistic3_order_prefix',
      'filename' => 'modSystemSetting/9390f2a4730603f3630456c250e02566.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    25 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1e4db8cbb2755254ae58a7f3d5cef9c6',
      'native_key' => 'eshoplogistic3_message_order_success',
      'filename' => 'modSystemSetting/26e42813f45bd1504f8f0f8e498d69bc.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    26 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '7f7e7163e9b6f6bea32972d2b06e21e2',
      'native_key' => 'eshoplogistic3_message_order_fail',
      'filename' => 'modSystemSetting/9ab67fa4eb7bb0553321c8040892bfbd.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    27 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '18e9a7d3f11b434f4510143c1dbdcc1e',
      'native_key' => 'eshoplogistic3_allow_unloading_orders',
      'filename' => 'modSystemSetting/5da3e94fa69029503a1fb68f26e7350d.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    28 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '50eef66e3ed03cb928ce05392709685c',
      'native_key' => 'eshoplogistic3_allow_automatic_unloading_orders',
      'filename' => 'modSystemSetting/8dc77dc5e58d8c98a3b42128562763ed.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    29 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '51fa2df82e2c411342898e7faa537434',
      'native_key' => 'eshoplogistic3_unloading_order_start_status',
      'filename' => 'modSystemSetting/07f72a905f15dc51709227d09f2a97ed.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    30 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f13fb21cadaef890923b03561b3f9342',
      'native_key' => 'eshoplogistic3_unloading_order_end_status',
      'filename' => 'modSystemSetting/55d2ca870e77eaf265fd7c9f0f4daa3c.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    31 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '7806dc128e97af6cc28cec3b55593e92',
      'native_key' => 'eshoplogistic3_order_default_weight',
      'filename' => 'modSystemSetting/56f24b0eec1da24daa83e8fe47440aa4.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    32 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4c8326ee1f64929b5a6ae383e07c2833',
      'native_key' => 'eshoplogistic3_order_default_dimensions',
      'filename' => 'modSystemSetting/698bb818078b97335d2577d66d69920f.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    33 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f0dd77674bce20e897c1d3c37f206373',
      'native_key' => 'eshoplogistic3_order_apply_everyone',
      'filename' => 'modSystemSetting/455379af592ad1401f42897a1c6c2597.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    34 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'eadaca995f58f5ecfc0cd6173e50d046',
      'native_key' => 'eshoplogistic3_order_product_common_name',
      'filename' => 'modSystemSetting/79300d229da081937ed4913b126bc962.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    35 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '013b1290300a83239dca03d254c1a507',
      'native_key' => 'eshoplogistic3_delivery_pick_up',
      'filename' => 'modSystemSetting/4bb5b43b921c12542260cda7f2c03bec.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    36 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4937dee95c9010c218db827b5abe1e67',
      'native_key' => 'eshoplogistic3_order_payment_already_paid',
      'filename' => 'modSystemSetting/ad972bdbdab65f2698c07ed4ef062567.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    37 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '2251b4be2f75250edc98a2d4cddf61e8',
      'native_key' => 'eshoplogistic3_order_payment_cash_on_receipt',
      'filename' => 'modSystemSetting/63a19508fa6f5f27b3ba44347777142c.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    38 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'f3f29ba7246ad20dff768d023ac90238',
      'native_key' => 'eshoplogistic3_order_payment_card_on_receipt',
      'filename' => 'modSystemSetting/77c283e35dea46903955c40689d2cbed.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    39 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3c657f5ecfb712e6e5965a793d7ad181',
      'native_key' => 'eshoplogistic3_take_places_from_order',
      'filename' => 'modSystemSetting/5024118e46c8eba4d203ef2df54d1ca6.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    40 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '31d5a2490f2ca69af7a3357a106063b8',
      'native_key' => 'eshoplogistic3_place_vat_rate',
      'filename' => 'modSystemSetting/452e1a4128a42b4b878230b6a7c73c1c.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    41 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ff39f68bfcf682c8371d2ec0b7dac0aa',
      'native_key' => 'eshoplogistic3_sender_company',
      'filename' => 'modSystemSetting/b90829523d18a32601498fb7e354327e.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    42 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '67d951f952305956e307a9631756a659',
      'native_key' => 'eshoplogistic3_sender_name',
      'filename' => 'modSystemSetting/199e46917586133604bb3e49943c862b.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    43 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'de50ceebda74ca036b4a829f6fd8d019',
      'native_key' => 'eshoplogistic3_sender_email',
      'filename' => 'modSystemSetting/2aab31f19dfe7be90dc28afa7d5842f1.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    44 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e94f4d98bd5ccb1d899180a6446e16bf',
      'native_key' => 'eshoplogistic3_sender_phone',
      'filename' => 'modSystemSetting/79a84019b87ee353a99e7a0b10e2890f.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    45 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '2e9bc521d843d85e9ffc08bc6d6e5fee',
      'native_key' => 'eshoplogistic3_sender_index',
      'filename' => 'modSystemSetting/1210e95f85cd9a4d62446eb1c51d5559.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    46 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '038c8fc4f708cf4b6d9b1caae9ff40f3',
      'native_key' => 'eshoplogistic3_sender_region',
      'filename' => 'modSystemSetting/698bcbc80346a2a6db5f4706852d003e.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    47 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '99fe17579416ea9db506c0b2b63d36c8',
      'native_key' => 'eshoplogistic3_sender_city',
      'filename' => 'modSystemSetting/407540492faa4c738f632bc3e50517bd.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    48 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd3dc1746bc28620937f69126dd0e69df',
      'native_key' => 'eshoplogistic3_sender_street',
      'filename' => 'modSystemSetting/6d9b149d9d803dc491b553a3126f3a06.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    49 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '59a1da6a06dcebac885906b0b0db0ab1',
      'native_key' => 'eshoplogistic3_sender_house',
      'filename' => 'modSystemSetting/dd36ecb46848081766fcdc5e14af1e68.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    50 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '296dc344199deed9d564c20cff9ecda3',
      'native_key' => 'eshoplogistic3_sender_room',
      'filename' => 'modSystemSetting/7532696404d1bd6fb6bd9bc22b23141f.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    51 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0b86d9eeead93adf771e9d086f0b0957',
      'native_key' => 'eshoplogistic3_yandex_pick_up',
      'filename' => 'modSystemSetting/c64eebc098e46731ff90d4c0a958bc4d.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    52 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '7f17cfb756a798b771343e6eae244038',
      'native_key' => 'eshoplogistic3_yandex_pick_up_terminal',
      'filename' => 'modSystemSetting/2006e369c93bf4f2bef86f6ad9c131d2.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    53 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3bb9b8667933d9eec4b8d9262df9874e',
      'native_key' => 'eshoplogistic3_boxberry_pick_up',
      'filename' => 'modSystemSetting/421f5932206bb6c207a79e10f8dce3f6.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    54 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e98de33d98321b9fb36e4940ec9fe8a0',
      'native_key' => 'eshoplogistic3_boxberry_pick_up_terminal',
      'filename' => 'modSystemSetting/d88698365319d006b49884778f3cefe3.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    55 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '389d54dd1fef02ddd4b852c120adf193',
      'native_key' => 'eshoplogistic3_boxberry_order_type',
      'filename' => 'modSystemSetting/4a54598837d18863497cc921d7bea825.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    56 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '66fb9a2a7204118d32c33bddebd69356',
      'native_key' => 'eshoplogistic3_boxberry_order_packing_type',
      'filename' => 'modSystemSetting/64cd707935aa8601da069efe321eab08.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    57 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a8938567a04c889e5b3274025cd71240',
      'native_key' => 'eshoplogistic3_sdek_pick_up',
      'filename' => 'modSystemSetting/2fbc48b366692a44cdea4dbe3a1fa06e.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    58 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'bfb9d75569e059a1409e1aec04be3dc9',
      'native_key' => 'eshoplogistic3_sdek_order_type',
      'filename' => 'modSystemSetting/2189d3e281e851847b7dfd9ec2aecba5.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    59 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '67f26d6619c2b0c5e71e85f3f85d9077',
      'native_key' => 'eshoplogistic3_sdek_pick_up_terminal',
      'filename' => 'modSystemSetting/b0e84f15b984d22c52bb3be7a7bc3eda.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    60 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ccb7b88fc14233b1351539f28e7c917c',
      'native_key' => 'eshoplogistic3_sdek_order_print_format',
      'filename' => 'modSystemSetting/14ff36d3a3ba7df3cfefe36ab2a13839.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    61 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '9f3f45fe45e5283b74a21b459118e14d',
      'native_key' => 'eshoplogistic3_order_update_data',
      'filename' => 'modSystemSetting/cd99330cede6508fb76dbfd512e5d9f9.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    62 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'acdbacc5942bd37ed897bcbf7d340b16',
      'native_key' => 'eshoplogistic3_order_update_data_statuses',
      'filename' => 'modSystemSetting/27eb3c24aadd9bbad9e51e17bbf6cda3.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    63 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a9ff0d2882948389e61a602d2d7ba1cd',
      'native_key' => 'eshoplogistic3_delline_sender_requester',
      'filename' => 'modSystemSetting/9899bc5fd398db4ea7dca600b66086e4.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    64 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '996846d18a70199ca5d5997a39885a74',
      'native_key' => 'eshoplogistic3_delline_sender_counterparty',
      'filename' => 'modSystemSetting/5e5c396d97d83b587f0fe09900abd78d.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    65 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c2514e9288ef38c8c8404c62e3840d60',
      'native_key' => 'eshoplogistic3_delline_pick_up_terminal',
      'filename' => 'modSystemSetting/185344faa779a890bff88c73758b5966.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    66 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '985a293cc4538e119718e04eb9a3c985',
      'native_key' => 'eshoplogistic3_pecom_sender_identity_type',
      'filename' => 'modSystemSetting/b4d4c41bc39a66c9eddd4e238db2a2ed.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    67 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '318c583c48266f5a1b0ffa69000f6915',
      'native_key' => 'eshoplogistic3_pecom_sender_identity_series',
      'filename' => 'modSystemSetting/2d8133abbc0c74a20ffbc1c9308cb87d.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    68 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '26b67af5d46d570344d2fa033d60d0f4',
      'native_key' => 'eshoplogistic3_pecom_sender_identity_number',
      'filename' => 'modSystemSetting/3e26f06475fdc70bbbdb52450dabde5c.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    69 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'bde5fbca71b3f29bf0aca963cb413b10',
      'native_key' => 'eshoplogistic3_pecom_sender_identity_date',
      'filename' => 'modSystemSetting/ed6d0567a2c979b97e82b7de3f11653d.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    70 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '5213beddeb9e2dbb7fcd8030e69847c6',
      'native_key' => 'eshoplogistic3_pecom_pick_up_terminal',
      'filename' => 'modSystemSetting/b079953f0c440861bcd1e7388160414e.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    71 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1be004438283d2111bbf3571a5c8d4f7',
      'native_key' => 'eshoplogistic3_baikal_sender_legal',
      'filename' => 'modSystemSetting/2ea2d37d07a22352cda05d9eee677d49.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    72 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd5c90d761bdce063fb029b9b7041f98b',
      'native_key' => 'eshoplogistic3_baikal_sender_identity_type',
      'filename' => 'modSystemSetting/83f04d05075606491e1e2dbb992ecd89.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    73 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4b20badb2e9183b2dbdc9b95cc305d29',
      'native_key' => 'eshoplogistic3_baikal_sender_identity_series',
      'filename' => 'modSystemSetting/36137d2e99804dca0d207984618fc7cc.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    74 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '3b25bbc6d70cb9e0eef9fa438add8e32',
      'native_key' => 'eshoplogistic3_baikal_sender_identity_number',
      'filename' => 'modSystemSetting/1af34a08dfecc9327a4a503efc57dd18.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    75 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b901b71b2da36abe9df039ed6fca2dbd',
      'native_key' => 'eshoplogistic3_baikal_sender_requisites_inn',
      'filename' => 'modSystemSetting/8ea9767478a13dfe63382c33e87b30fd.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    76 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0096d61d5b18a263858f9ffcaaf1c78d',
      'native_key' => 'eshoplogistic3_baikal_sender_requisites_kpp',
      'filename' => 'modSystemSetting/cb23206d993194b2b86d1f902031d58a.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    77 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ebaa6339545ec7a315b0bd4fa154e374',
      'native_key' => 'eshoplogistic3_baikal_pick_up_terminal',
      'filename' => 'modSystemSetting/0410940b915623ae4845e74655406fc9.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    78 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4b94e25c2af3bd574433851e9f46c964',
      'native_key' => 'eshoplogistic3_kit_sender_requester',
      'filename' => 'modSystemSetting/675901fa316d8c5a68d3d0a536b21427.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
    79 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modCategory',
      'guid' => 'd6b5e1256fe89d981ca8d4e7b7e734c3',
      'native_key' => NULL,
      'filename' => 'modCategory/81ef601376ae6273b6e20718775eefaf.vehicle',
      'namespace' => 'eshoplogistic3',
    ),
  ),
);
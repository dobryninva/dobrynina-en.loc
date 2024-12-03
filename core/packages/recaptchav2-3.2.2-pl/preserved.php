<?php return array (
  '89852980d8e29bc24f5b7d2babc859c7' => 
  array (
    'criteria' => 
    array (
      'name' => 'recaptchav2',
    ),
    'object' => 
    array (
      'name' => 'recaptchav2',
      'path' => '{core_path}components/recaptchav2/',
      'assets_path' => '{assets_path}components/recaptchav2/',
    ),
  ),
  '2321f3bcd2dae7237470a54987057550' => 
  array (
    'criteria' => 
    array (
      'key' => 'recaptchav2.secret_key',
    ),
    'object' => 
    array (
      'key' => 'recaptchav2.secret_key',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'recaptchav2',
      'area' => 'default',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '69b1342ff90473c000f8c33e34a0a271' => 
  array (
    'criteria' => 
    array (
      'key' => 'recaptchav2.site_key',
    ),
    'object' => 
    array (
      'key' => 'recaptchav2.site_key',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'recaptchav2',
      'area' => 'default',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'a467e3a12557fee66d168e4296409646' => 
  array (
    'criteria' => 
    array (
      'key' => 'recaptchav3.secret_key',
    ),
    'object' => 
    array (
      'key' => 'recaptchav3.secret_key',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'recaptchav2',
      'area' => 'default',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '54e3794d110e8982733ce74ba45b1ff9' => 
  array (
    'criteria' => 
    array (
      'key' => 'recaptchav3.site_key',
    ),
    'object' => 
    array (
      'key' => 'recaptchav3.site_key',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'recaptchav2',
      'area' => 'default',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '831adf7524493b56ed2867db8bb3ba75' => 
  array (
    'criteria' => 
    array (
      'key' => 'recaptchav3.action_key',
    ),
    'object' => 
    array (
      'key' => 'recaptchav3.action_key',
      'value' => 'recaptcha-action',
      'xtype' => 'textfield',
      'namespace' => 'recaptchav2',
      'area' => 'default',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'ca2c2e5874c061a6761669fae5e900a3' => 
  array (
    'criteria' => 
    array (
      'key' => 'recaptchav3.token_key',
    ),
    'object' => 
    array (
      'key' => 'recaptchav3.token_key',
      'value' => 'recaptcha-token',
      'xtype' => 'textfield',
      'namespace' => 'recaptchav2',
      'area' => 'default',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'c675308fc84218ab93bcba10722e8e7f' => 
  array (
    'criteria' => 
    array (
      'category' => 'ReCaptchaV2',
    ),
    'object' => 
    array (
      'id' => 25,
      'parent' => 0,
      'category' => 'ReCaptchaV2',
      'rank' => 0,
    ),
  ),
  'ec0106c6a27d16db27082120ac989f41' => 
  array (
    'criteria' => 
    array (
      'name' => 'recaptchav2_html',
    ),
    'object' => 
    array (
      'id' => 31,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'recaptchav2_html',
      'description' => '',
      'editor_type' => 0,
      'category' => 25,
      'cache_type' => 0,
      'snippet' => '<div class="g-recaptcha" data-sitekey="[[+site_key]]"></div>
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=[[++cultureKey]]"></script>',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'static' => 0,
      'static_file' => '',
      'content' => '<div class="g-recaptcha" data-sitekey="[[+site_key]]"></div>
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=[[++cultureKey]]"></script>',
    ),
  ),
  '43d7c33e7bff0ed6da9b49977da8ce37' => 
  array (
    'criteria' => 
    array (
      'name' => 'recaptchav2_invisible_html',
    ),
    'object' => 
    array (
      'id' => 167,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'recaptchav2_invisible_html',
      'description' => '',
      'editor_type' => 0,
      'category' => 25,
      'cache_type' => 0,
      'snippet' => '<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=[[++cultureKey]]"></script>
<script>function recaptchaV2SubmitForm(response){return new Promise(function(){document.getElementById(\'[[+form_id]]\').submit();})}</script>
<button type="submit" class="g-recaptcha" name="login" data-sitekey="[[+site_key]]" data-callback="recaptchaV2SubmitForm">Login</button>',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'static' => 0,
      'static_file' => '',
      'content' => '<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=[[++cultureKey]]"></script>
<script>function recaptchaV2SubmitForm(response){return new Promise(function(){document.getElementById(\'[[+form_id]]\').submit();})}</script>
<button type="submit" class="g-recaptcha" name="login" data-sitekey="[[+site_key]]" data-callback="recaptchaV2SubmitForm">Login</button>',
    ),
  ),
  '795c667579fede9855e6597777268902' => 
  array (
    'criteria' => 
    array (
      'name' => 'sample_formit_contact_form',
    ),
    'object' => 
    array (
      'id' => 32,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'sample_formit_contact_form',
      'description' => '',
      'editor_type' => 0,
      'category' => 25,
      'cache_type' => 0,
      'snippet' => '[[!FormIt?
   &hooks=`recaptchav2,email`
   &emailTpl=`sample_formit_contact_eml`
   &emailTo=`[[++emailsender]]`
   &emailSubject=`Contact from website`
   &validate=`name:required,
      email:email:required,
      text:stripTags`
   &successMessage=`<p class="button success">Success! Your enquiry has been sent.</p>`
]]
    <div class="sample_formit_contact_form">
        <h3>Contact Us</h3>
        [[!+fi.validation_error_message:notempty=`<div class="label alert">[[!+fi.validation_error_message]]</div>`]]
        [[!+fi.successMessage]]
        <form action="[[~[[*id]]]]" method="post" class="contact-form">
            <div class="form-item">
                <label for="name">
                    Name: *
                    [[!+fi.error.name:notempty=`<span class="error">[[!+fi.error.name]]</span>`]]
                </label>
                <input type="text" name="name" id="name" value="[[!+fi.name]]" />
            </div>
            <div class="form-item">
                <label for="email">
                    Email: *
                    [[!+fi.error.email:notempty=`<span class="error">[[!+fi.error.email]]</span>`]]
                </label>
                <input type="text" name="email" id="email" value="[[!+fi.email]]" />
            </div>
            <div class="form-item">
                <label for="text">
                    Message:
                    [[!+fi.error.text:notempty=`<span class="error">[[!+fi.error.text]]</span>`]]
                </label>
                <textarea name="text" id="text" value="[[!+fi.text]]">[[!+fi.text]]</textarea>
            </div>
            <div class="form-item">
                [[!recaptchav2_render]]
                [[!+fi.error.recaptchav2_error]]
            </div>
            <div class="form-button">
                <input type="submit" value="Send" class="button" />
            </div>
        </form>
    </div>',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'static' => 0,
      'static_file' => '',
      'content' => '[[!FormIt?
   &hooks=`recaptchav2,email`
   &emailTpl=`sample_formit_contact_eml`
   &emailTo=`[[++emailsender]]`
   &emailSubject=`Contact from website`
   &validate=`name:required,
      email:email:required,
      text:stripTags`
   &successMessage=`<p class="button success">Success! Your enquiry has been sent.</p>`
]]
    <div class="sample_formit_contact_form">
        <h3>Contact Us</h3>
        [[!+fi.validation_error_message:notempty=`<div class="label alert">[[!+fi.validation_error_message]]</div>`]]
        [[!+fi.successMessage]]
        <form action="[[~[[*id]]]]" method="post" class="contact-form">
            <div class="form-item">
                <label for="name">
                    Name: *
                    [[!+fi.error.name:notempty=`<span class="error">[[!+fi.error.name]]</span>`]]
                </label>
                <input type="text" name="name" id="name" value="[[!+fi.name]]" />
            </div>
            <div class="form-item">
                <label for="email">
                    Email: *
                    [[!+fi.error.email:notempty=`<span class="error">[[!+fi.error.email]]</span>`]]
                </label>
                <input type="text" name="email" id="email" value="[[!+fi.email]]" />
            </div>
            <div class="form-item">
                <label for="text">
                    Message:
                    [[!+fi.error.text:notempty=`<span class="error">[[!+fi.error.text]]</span>`]]
                </label>
                <textarea name="text" id="text" value="[[!+fi.text]]">[[!+fi.text]]</textarea>
            </div>
            <div class="form-item">
                [[!recaptchav2_render]]
                [[!+fi.error.recaptchav2_error]]
            </div>
            <div class="form-button">
                <input type="submit" value="Send" class="button" />
            </div>
        </form>
    </div>',
    ),
  ),
  'bf38d01abced89faf8885953f6fe1096' => 
  array (
    'criteria' => 
    array (
      'name' => 'sample_formit_contact_eml',
    ),
    'object' => 
    array (
      'id' => 33,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'sample_formit_contact_eml',
      'description' => '',
      'editor_type' => 0,
      'category' => 25,
      'cache_type' => 0,
      'snippet' => 'Contact from the website:<br />
[[+name]] ([[+email]]) wrote: <br />
 
[[+text]]',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'static' => 0,
      'static_file' => '',
      'content' => 'Contact from the website:<br />
[[+name]] ([[+email]]) wrote: <br />
 
[[+text]]',
    ),
  ),
  '768528ea177f9e3a78d7bca8316d0808' => 
  array (
    'criteria' => 
    array (
      'name' => 'recaptchav3_html',
    ),
    'object' => 
    array (
      'id' => 221,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'recaptchav3_html',
      'description' => '',
      'editor_type' => 0,
      'category' => 25,
      'cache_type' => 0,
      'snippet' => '<script src="https://www.google.com/recaptcha/api.js?render=[[+site_key]]&hl=[[++cultureKey]]"></script>
<input type="hidden" name="[[+token_key]]">
<input type="hidden" name="[[+action_key]]" value="[[+form_id]]">
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute(\'[[+site_key]]\', {action: \'[[+form_id]]\'}).then(function(token) {
            document.querySelector(\'[name="[[+token_key]]"]\').value = token;
        });
    });
</script>
',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'static' => 0,
      'static_file' => '',
      'content' => '<script src="https://www.google.com/recaptcha/api.js?render=[[+site_key]]&hl=[[++cultureKey]]"></script>
<input type="hidden" name="[[+token_key]]">
<input type="hidden" name="[[+action_key]]" value="[[+form_id]]">
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute(\'[[+site_key]]\', {action: \'[[+form_id]]\'}).then(function(token) {
            document.querySelector(\'[name="[[+token_key]]"]\').value = token;
        });
    });
</script>
',
    ),
  ),
  '07593c9e69d9630e1f9fdc9fd426c904' => 
  array (
    'criteria' => 
    array (
      'name' => 'recaptchav2',
    ),
    'object' => 
    array (
      'id' => 44,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'recaptchav2',
      'description' => '',
      'editor_type' => 0,
      'category' => 25,
      'cache_type' => 0,
      'snippet' => '/**
 * Based on https://github.com/google/recaptcha
 *
 * @copyright Copyright (c) 2014, Google Inc.
 * @link      http://www.google.com/recaptcha
 *
 * Ported to MODX by YJ Tso @sepiariver
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

// Register API keys at https://www.google.com/recaptcha/admin
$site_key = $modx->getOption(\'recaptchav2.site_key\', null, \'\');
$secret = $modx->getOption(\'recaptchav2.secret_key\', null, \'\');
// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
$lang = $modx->getOption(\'cultureKey\', null, \'en\');

// Options
if ($hook->formit) {
    $properties = array_merge(array(), $hook->formit->config);
}

// make sure the modLexicon class is loaded by instantiating 
$modx->getService(\'lexicon\',\'modLexicon\');
// load lexicon
$modx->lexicon->load(\'recaptchav2:default\');
// get the message from default.inc.php from the correct lang
$tech_err_msg = $modx->lexicon(\'recaptchav2.technical_error_message\');
$recaptcha_err_msg = $modx->lexicon(\'recaptchav2.recaptcha_error_message\');

// Get the class
$recaptchav2Path = $modx->getOption(\'recaptchav2.core_path\', null, $modx->getOption(\'core_path\') . \'components/recaptchav2/\');
$recaptchav2Path .= \'model/recaptchav2/\';
if (!file_exists($recaptchav2Path . \'autoload.php\')) {
    $modx->log(modX::LOG_LEVEL_WARN, \'Cannot find required RecaptchaV2 autoload.php file.\'); 
    return false;
}
require_once($recaptchav2Path . \'autoload.php\');
$recaptchav2 = new \\ReCaptcha\\ReCaptcha($secret, new \\ReCaptcha\\RequestMethod\\CurlPost());
if (!($recaptchav2 instanceof \\ReCaptcha\\ReCaptcha)) {
    $hook->addError(\'recaptchav2_error\', $tech_err_msg);
    $modx->log(modX::LOG_LEVEL_WARN, \'Failed to load recaptchav2 class.\'); 
    return false;
}

// The response from reCAPTCHA
$resp = null;
// The error code from reCAPTCHA, if any
$error = null;
// Check if being used as hook
if (isset($hook)){
// Was there a reCAPTCHA response?
    if ($hook->getValue(\'g-recaptcha-response\')) {
        $resp = $recaptchav2->verify($hook->getValue(\'g-recaptcha-response\'), $_SERVER["REMOTE_ADDR"]);
    }

// Hook pass/fail
    if ($resp != null && $resp->isSuccess()) {
        return true;
    } else {
        $hook->addError(\'recaptchav2_error\', $recaptcha_err_msg);
        $modx->log(modX::LOG_LEVEL_DEBUG, print_r($resp, true));
        return false;
    }
}
// Check if being used as validator
if (isset($validator)) {
// Was there a reCAPTCHA response?
    if (isset($value)) {
        $resp = $recaptchav2->verify($value, $_SERVER["REMOTE_ADDR"]);
    }

// Validator pass/fail
    if ($resp != null && $resp->isSuccess()) {
        return true;
    } else {
        $validator->addError($key, $recaptcha_err_msg);
        $modx->log(modX::LOG_LEVEL_DEBUG, print_r($resp, true));
        return $success;
    }


}

// Checks failed
return false;',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * Based on https://github.com/google/recaptcha
 *
 * @copyright Copyright (c) 2014, Google Inc.
 * @link      http://www.google.com/recaptcha
 *
 * Ported to MODX by YJ Tso @sepiariver
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

// Register API keys at https://www.google.com/recaptcha/admin
$site_key = $modx->getOption(\'recaptchav2.site_key\', null, \'\');
$secret = $modx->getOption(\'recaptchav2.secret_key\', null, \'\');
// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
$lang = $modx->getOption(\'cultureKey\', null, \'en\');

// Options
if ($hook->formit) {
    $properties = array_merge(array(), $hook->formit->config);
}

// make sure the modLexicon class is loaded by instantiating 
$modx->getService(\'lexicon\',\'modLexicon\');
// load lexicon
$modx->lexicon->load(\'recaptchav2:default\');
// get the message from default.inc.php from the correct lang
$tech_err_msg = $modx->lexicon(\'recaptchav2.technical_error_message\');
$recaptcha_err_msg = $modx->lexicon(\'recaptchav2.recaptcha_error_message\');

// Get the class
$recaptchav2Path = $modx->getOption(\'recaptchav2.core_path\', null, $modx->getOption(\'core_path\') . \'components/recaptchav2/\');
$recaptchav2Path .= \'model/recaptchav2/\';
if (!file_exists($recaptchav2Path . \'autoload.php\')) {
    $modx->log(modX::LOG_LEVEL_WARN, \'Cannot find required RecaptchaV2 autoload.php file.\'); 
    return false;
}
require_once($recaptchav2Path . \'autoload.php\');
$recaptchav2 = new \\ReCaptcha\\ReCaptcha($secret, new \\ReCaptcha\\RequestMethod\\CurlPost());
if (!($recaptchav2 instanceof \\ReCaptcha\\ReCaptcha)) {
    $hook->addError(\'recaptchav2_error\', $tech_err_msg);
    $modx->log(modX::LOG_LEVEL_WARN, \'Failed to load recaptchav2 class.\'); 
    return false;
}

// The response from reCAPTCHA
$resp = null;
// The error code from reCAPTCHA, if any
$error = null;
// Check if being used as hook
if (isset($hook)){
// Was there a reCAPTCHA response?
    if ($hook->getValue(\'g-recaptcha-response\')) {
        $resp = $recaptchav2->verify($hook->getValue(\'g-recaptcha-response\'), $_SERVER["REMOTE_ADDR"]);
    }

// Hook pass/fail
    if ($resp != null && $resp->isSuccess()) {
        return true;
    } else {
        $hook->addError(\'recaptchav2_error\', $recaptcha_err_msg);
        $modx->log(modX::LOG_LEVEL_DEBUG, print_r($resp, true));
        return false;
    }
}
// Check if being used as validator
if (isset($validator)) {
// Was there a reCAPTCHA response?
    if (isset($value)) {
        $resp = $recaptchav2->verify($value, $_SERVER["REMOTE_ADDR"]);
    }

// Validator pass/fail
    if ($resp != null && $resp->isSuccess()) {
        return true;
    } else {
        $validator->addError($key, $recaptcha_err_msg);
        $modx->log(modX::LOG_LEVEL_DEBUG, print_r($resp, true));
        return $success;
    }


}

// Checks failed
return false;',
    ),
  ),
  'f836a3c97cdf9a34ac0484f6482df8e5' => 
  array (
    'criteria' => 
    array (
      'name' => 'recaptchav2_render',
    ),
    'object' => 
    array (
      'id' => 45,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'recaptchav2_render',
      'description' => '',
      'editor_type' => 0,
      'category' => 25,
      'cache_type' => 0,
      'snippet' => '/**
 * Renders ReCaptcha V2 form
 *
 * Based on https://github.com/google/ReCAPTCHA/tree/master/php
 *
 * @copyright Copyright (c) 2014, Google Inc.
 * @link      http://www.google.com/recaptcha
 *
 * Ported to MODX by YJ Tso @sepiariver
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

// Register API keys at https://www.google.com/recaptcha/admin
$site_key = $modx->getOption(\'recaptchav2.site_key\', null, \'\');
// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
$lang = $modx->getOption(\'cultureKey\', null, \'en\', true);
// use \'recaptchav2_invisible_html\' inside form element for invisible recaptcha
$tpl = $modx->getOption(\'tpl\', $scriptProperties, \'recaptchav2_html\', true);
$form_id = $modx->getOption(\'form_id\', $scriptProperties, \'\');

// Merge scriptProperties to support arbitrary placeholders in template
// The ID regex is like that for a reason, see Google
$props = array_merge($scriptProperties, [
    \'site_key\' => $site_key,
    \'lang\' => $lang,
    \'form_id\' => $form_id,
]);
$recaptcha_html = $modx->getChunk($tpl, $props);

if ($hook) { 
    $hook->setValue(\'recaptchav2_html\', $recaptcha_html); // This won\'t re-render on page reload there\'s validation errors
    return true;
} else { // This works at least
    return $recaptcha_html;
}',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * Renders ReCaptcha V2 form
 *
 * Based on https://github.com/google/ReCAPTCHA/tree/master/php
 *
 * @copyright Copyright (c) 2014, Google Inc.
 * @link      http://www.google.com/recaptcha
 *
 * Ported to MODX by YJ Tso @sepiariver
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

// Register API keys at https://www.google.com/recaptcha/admin
$site_key = $modx->getOption(\'recaptchav2.site_key\', null, \'\');
// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
$lang = $modx->getOption(\'cultureKey\', null, \'en\', true);
// use \'recaptchav2_invisible_html\' inside form element for invisible recaptcha
$tpl = $modx->getOption(\'tpl\', $scriptProperties, \'recaptchav2_html\', true);
$form_id = $modx->getOption(\'form_id\', $scriptProperties, \'\');

// Merge scriptProperties to support arbitrary placeholders in template
// The ID regex is like that for a reason, see Google
$props = array_merge($scriptProperties, [
    \'site_key\' => $site_key,
    \'lang\' => $lang,
    \'form_id\' => $form_id,
]);
$recaptcha_html = $modx->getChunk($tpl, $props);

if ($hook) { 
    $hook->setValue(\'recaptchav2_html\', $recaptcha_html); // This won\'t re-render on page reload there\'s validation errors
    return true;
} else { // This works at least
    return $recaptcha_html;
}',
    ),
  ),
  '3d37f693d446929e3b4d2d07f12c5af4' => 
  array (
    'criteria' => 
    array (
      'name' => 'recaptchav3',
    ),
    'object' => 
    array (
      'id' => 111,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'recaptchav3',
      'description' => '',
      'editor_type' => 0,
      'category' => 25,
      'cache_type' => 0,
      'snippet' => '/**
 * recaptchav3 hook for use with MODX form processors
 *
 * Based on https://github.com/google/recaptcha
 *
 * @copyright Copyright (c) 2014, Google Inc.
 * @link      http://www.google.com/recaptcha
 *
 * Ported to MODX by YJ Tso @sepiariver
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

// Require hook object
if (!$hook) {
    $modx->log(modX::LOG_LEVEL_ERROR, \'RecaptchaV3 requires hook object.\');
    return;
}

// Register API keys at https://www.google.com/recaptcha/admin
$props[\'site_key\'] = $modx->getOption(\'recaptchav3.site_key\', null, \'\');
$props[\'secret_key\'] = $modx->getOption(\'recaptchav3.secret_key\', null, \'\');
// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
$props[\'lang\'] = $modx->getOption(\'cultureKey\', null, \'en\');
// https://developers.google.com/recaptcha/docs/v3 "Actions"
$props[\'action_key\'] = $modx->getOption(\'recaptchav3.action_key\', null, \'recaptcha-action\', true);
$props[\'token_key\'] = $modx->getOption(\'recaptchav3.token_key\', null, \'recaptcha-token\', true);

// Options
$hookConfig = [];
if ($hook->formit) {
    $hookConfig = $hook->formit->config;
} elseif ($hook->login) {
    $hookConfig = $hook->login->controller->config;
}
foreach ($hookConfig as $k => $v) {
    if (strpos($k, \'recaptchav3.\') === 0) {
        $k = substr($k, 12);
        $props[$k] = $v;
    }
}

// Defaults
$props[\'threshold\'] = floatval($modx->getOption(\'threshold\', $props, 0.5, true));
$props[\'display_resp_errors\'] = $modx->getOption(\'display_resp_errors\', $props, true);
$props[\'ip\'] = $modx->getOption(\'HTTP_CF_CONNECTING_IP\', $_SERVER, $_SERVER[\'REMOTE_ADDR\'], true);

// make sure the modLexicon class is loaded by instantiating
$modx->getService(\'lexicon\',\'modLexicon\');
// load lexicon
$modx->lexicon->load(\'recaptchav2:default\');
// get the message from default.inc.php from the correct lang
$tech_err_msg = $modx->lexicon(\'recaptchav2.technical_error_message\');
$recaptcha_err_msg = $modx->lexicon(\'recaptchav2.recaptchav3_error_message\');

// Get the class
$recaptchaPath = $modx->getOption(\'recaptchav2.core_path\', null, $modx->getOption(\'core_path\') . \'components/recaptchav2/\');
$recaptchaPath .= \'model/recaptchav2/\';
if (!file_exists($recaptchaPath . \'autoload.php\')) {
    $modx->log(modX::LOG_LEVEL_ERROR, \'Cannot find required Recaptcha autoload.php file.\');
    return false;
}
require_once($recaptchaPath . \'autoload.php\');
try {
    $recaptcha = new \\ReCaptcha\\ReCaptcha($props[\'secret_key\'], new \\ReCaptcha\\RequestMethod\\CurlPost());
} catch (Exception $e) {
    $modx->log(modX::LOG_LEVEL_ERROR, \'Failed to load Recaptcha class.\');
    return false;
}

if (!($recaptcha instanceof \\ReCaptcha\\ReCaptcha)) {
    $hook->addError(\'recaptchav3_error\', $tech_err_msg);
    $modx->log(modX::LOG_LEVEL_ERROR, \'Failed to load Recaptcha class.\');
    return false;
}

// The response from reCAPTCHA
$resp = null;
// The error code from reCAPTCHA, if any
$error = null;

// Was there a reCAPTCHA response?
if ($hook->getValue($props[\'token_key\'])) {
    $resp = $recaptcha->setExpectedHostname(parse_url($modx->getOption(\'site_url\'), PHP_URL_HOST))
              ->setExpectedAction($hook->getValue($props[\'action_key\']))
              ->setScoreThreshold($props[\'threshold\'])
              ->verify($hook->getValue($props[\'token_key\']), $props[\'ip\']);

}

// Hook pass/fail
if ($resp != null && $resp->isSuccess()) {
    return true;
} else {
    $msg = \'\';
    if ($resp != null && $props[\'display_resp_errors\']) {
        foreach ($resp->getErrorCodes() as $error) {
            $msg .= $error . "\\n";
        }
    }
    if (empty($msg)) $msg = $recaptcha_err_msg;
    $hook->addError(\'recaptchav3_error\', $msg);
    $modx->log(modX::LOG_LEVEL_DEBUG, print_r($resp, true));
    return false;
}


// Checks failed
return false;',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * recaptchav3 hook for use with MODX form processors
 *
 * Based on https://github.com/google/recaptcha
 *
 * @copyright Copyright (c) 2014, Google Inc.
 * @link      http://www.google.com/recaptcha
 *
 * Ported to MODX by YJ Tso @sepiariver
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

// Require hook object
if (!$hook) {
    $modx->log(modX::LOG_LEVEL_ERROR, \'RecaptchaV3 requires hook object.\');
    return;
}

// Register API keys at https://www.google.com/recaptcha/admin
$props[\'site_key\'] = $modx->getOption(\'recaptchav3.site_key\', null, \'\');
$props[\'secret_key\'] = $modx->getOption(\'recaptchav3.secret_key\', null, \'\');
// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
$props[\'lang\'] = $modx->getOption(\'cultureKey\', null, \'en\');
// https://developers.google.com/recaptcha/docs/v3 "Actions"
$props[\'action_key\'] = $modx->getOption(\'recaptchav3.action_key\', null, \'recaptcha-action\', true);
$props[\'token_key\'] = $modx->getOption(\'recaptchav3.token_key\', null, \'recaptcha-token\', true);

// Options
$hookConfig = [];
if ($hook->formit) {
    $hookConfig = $hook->formit->config;
} elseif ($hook->login) {
    $hookConfig = $hook->login->controller->config;
}
foreach ($hookConfig as $k => $v) {
    if (strpos($k, \'recaptchav3.\') === 0) {
        $k = substr($k, 12);
        $props[$k] = $v;
    }
}

// Defaults
$props[\'threshold\'] = floatval($modx->getOption(\'threshold\', $props, 0.5, true));
$props[\'display_resp_errors\'] = $modx->getOption(\'display_resp_errors\', $props, true);
$props[\'ip\'] = $modx->getOption(\'HTTP_CF_CONNECTING_IP\', $_SERVER, $_SERVER[\'REMOTE_ADDR\'], true);

// make sure the modLexicon class is loaded by instantiating
$modx->getService(\'lexicon\',\'modLexicon\');
// load lexicon
$modx->lexicon->load(\'recaptchav2:default\');
// get the message from default.inc.php from the correct lang
$tech_err_msg = $modx->lexicon(\'recaptchav2.technical_error_message\');
$recaptcha_err_msg = $modx->lexicon(\'recaptchav2.recaptchav3_error_message\');

// Get the class
$recaptchaPath = $modx->getOption(\'recaptchav2.core_path\', null, $modx->getOption(\'core_path\') . \'components/recaptchav2/\');
$recaptchaPath .= \'model/recaptchav2/\';
if (!file_exists($recaptchaPath . \'autoload.php\')) {
    $modx->log(modX::LOG_LEVEL_ERROR, \'Cannot find required Recaptcha autoload.php file.\');
    return false;
}
require_once($recaptchaPath . \'autoload.php\');
try {
    $recaptcha = new \\ReCaptcha\\ReCaptcha($props[\'secret_key\'], new \\ReCaptcha\\RequestMethod\\CurlPost());
} catch (Exception $e) {
    $modx->log(modX::LOG_LEVEL_ERROR, \'Failed to load Recaptcha class.\');
    return false;
}

if (!($recaptcha instanceof \\ReCaptcha\\ReCaptcha)) {
    $hook->addError(\'recaptchav3_error\', $tech_err_msg);
    $modx->log(modX::LOG_LEVEL_ERROR, \'Failed to load Recaptcha class.\');
    return false;
}

// The response from reCAPTCHA
$resp = null;
// The error code from reCAPTCHA, if any
$error = null;

// Was there a reCAPTCHA response?
if ($hook->getValue($props[\'token_key\'])) {
    $resp = $recaptcha->setExpectedHostname(parse_url($modx->getOption(\'site_url\'), PHP_URL_HOST))
              ->setExpectedAction($hook->getValue($props[\'action_key\']))
              ->setScoreThreshold($props[\'threshold\'])
              ->verify($hook->getValue($props[\'token_key\']), $props[\'ip\']);

}

// Hook pass/fail
if ($resp != null && $resp->isSuccess()) {
    return true;
} else {
    $msg = \'\';
    if ($resp != null && $props[\'display_resp_errors\']) {
        foreach ($resp->getErrorCodes() as $error) {
            $msg .= $error . "\\n";
        }
    }
    if (empty($msg)) $msg = $recaptcha_err_msg;
    $hook->addError(\'recaptchav3_error\', $msg);
    $modx->log(modX::LOG_LEVEL_DEBUG, print_r($resp, true));
    return false;
}


// Checks failed
return false;',
    ),
  ),
  '56733a3acf8714e54eafc8f8ff52ca06' => 
  array (
    'criteria' => 
    array (
      'name' => 'recaptchav3_render',
    ),
    'object' => 
    array (
      'id' => 112,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'recaptchav3_render',
      'description' => '',
      'editor_type' => 0,
      'category' => 25,
      'cache_type' => 0,
      'snippet' => '/**
 * Renders ReCaptcha V3 form
 *
 * Based on https://github.com/google/recaptcha
 *
 * @copyright Copyright (c) 2014, Google Inc.
 * @link      http://www.google.com/recaptcha
 *
 * Ported to MODX by YJ Tso @sepiariver
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

// Register API keys at https://www.google.com/recaptcha/admin
$site_key = $modx->getOption(\'recaptchav3.site_key\', null, \'\');
// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
$lang = $modx->getOption(\'cultureKey\', null, \'en\', true);
// https://developers.google.com/recaptcha/docs/v3 "Actions"
$action_key = $modx->getOption(\'action_key\', $scriptProperties, $modx->getOption(\'recaptchav3.action_key\', null, \'recaptcha-action\', true), true);

$token_key = $modx->getOption(\'token_key\', $scriptProperties, $modx->getOption(\'recaptchav3.token_key\', null, \'recaptcha-token\', true), true);

// new \'recaptchav3_html\' Chunk
$tpl = $modx->getOption(\'tpl\', $scriptProperties, \'recaptchav3_html\', true);
$form_id = $modx->getOption(\'form_id\', $scriptProperties, $modx->resource->get(\'uri\'));

// Merge scriptProperties to support arbitrary placeholders in template
// The ID regex is like that for a reason, see Google
$props = array_merge($scriptProperties, [
    \'site_key\' => $site_key,
    \'lang\' => $lang,
    \'form_id\' => preg_replace(\'/[^A-Za-z_]/\', \'\', $form_id),
    \'action_key\' => $action_key,
    \'token_key\' => $token_key,
]);
$recaptcha_html = $modx->getChunk($tpl, $props);

return $recaptcha_html;',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * Renders ReCaptcha V3 form
 *
 * Based on https://github.com/google/recaptcha
 *
 * @copyright Copyright (c) 2014, Google Inc.
 * @link      http://www.google.com/recaptcha
 *
 * Ported to MODX by YJ Tso @sepiariver
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

// Register API keys at https://www.google.com/recaptcha/admin
$site_key = $modx->getOption(\'recaptchav3.site_key\', null, \'\');
// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
$lang = $modx->getOption(\'cultureKey\', null, \'en\', true);
// https://developers.google.com/recaptcha/docs/v3 "Actions"
$action_key = $modx->getOption(\'action_key\', $scriptProperties, $modx->getOption(\'recaptchav3.action_key\', null, \'recaptcha-action\', true), true);

$token_key = $modx->getOption(\'token_key\', $scriptProperties, $modx->getOption(\'recaptchav3.token_key\', null, \'recaptcha-token\', true), true);

// new \'recaptchav3_html\' Chunk
$tpl = $modx->getOption(\'tpl\', $scriptProperties, \'recaptchav3_html\', true);
$form_id = $modx->getOption(\'form_id\', $scriptProperties, $modx->resource->get(\'uri\'));

// Merge scriptProperties to support arbitrary placeholders in template
// The ID regex is like that for a reason, see Google
$props = array_merge($scriptProperties, [
    \'site_key\' => $site_key,
    \'lang\' => $lang,
    \'form_id\' => preg_replace(\'/[^A-Za-z_]/\', \'\', $form_id),
    \'action_key\' => $action_key,
    \'token_key\' => $token_key,
]);
$recaptcha_html = $modx->getChunk($tpl, $props);

return $recaptcha_html;',
    ),
  ),
);
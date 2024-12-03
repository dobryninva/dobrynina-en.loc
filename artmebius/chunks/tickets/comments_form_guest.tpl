<div id="comment-form-placeholder">
	<div class="form-header">Оставьте свой комментарий</div>
	<form id="comment-form" action="[[~[[*id]]]]" method="post" class="form-vertical" autocomplete="off" [[-enctype="multipart/form-data"]]>
		<div id="comment-preview-placeholder"></div>
		<input type="hidden" name="thread" value="[[+thread]]" />
		<input type="hidden" name="parent" value="0" />
		<input type="hidden" name="id" value="0" />
[[-
    <div class="form-group">
      <div class="stars_title">Оцените качество <span class="req">*</span></div>
      <div class="stars_wrap">
        <label class="star"><input type="radio" name="vote" value="1"></label>
        <label class="star"><input type="radio" name="vote" value="2"></label>
        <label class="star"><input type="radio" name="vote" value="3"></label>
        <label class="star"><input type="radio" name="vote" value="4"></label>
        <label class="star"><input type="radio" name="vote" value="5"></label>
      </div>
      <span class="error"></span>
    </div>
-]]
    <div class="form-group">
      <label for="comment-name">Ваше имя <span class="req">*</span></label>
      <input type="text" name="name" value="" id="comment-name" placeholder="Имя" />
      <span class="error"></span>
    </div>

    <div class="form-group">
      <label for="comment-editor">Комментарий <span class="req">*</span></label>
      <textarea name="text" id="comment-editor" rows="5" class="w100" placeholder="Оставьте Ваш отзыв здесь"></textarea>
      <span class="error"></span>
    </div>

    <div class="form-group">
      <div id="reCaptchaReviews" class="recaptcha_wrap"></div>
      <span class="error"></span>
    </div>
[[-
    <div class="form-group">
      <label for="photos">Прикрепить изображение <span style="color: #888;font-size: 14px;">(*.jpg, *.png, *.gif. Максимальный размер: 2МБ, не более 4-х)</span></label>
      <input type="file" name="photos[]" id="photos" accept="image/jpeg,image/gif,image/png" multiple>
    </div>
-]]
		<div class="form-actions control-group">
			<button type="submit" class="btn-main">Оставить комментарий</button> <span class="cmmnt"><span class="req">*</span> - обязательные поля</span>
			<span class="time"></span>
		</div>
	</form>
</div>
<div class="success_message"></div>
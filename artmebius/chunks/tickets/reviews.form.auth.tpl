{* <h4 id="comment-new-link">
  <a href="#" class="btn btn-default">[[%ticket_comment_create]]</a>
</h4> *}
<div id="comment-form-placeholder">
  <div class="reviews_form_header form-header">Оставьте свой отзыв</div>
  <form id="comment-form" class="reviews_form form-vertical" action="{$_modx->resource.id | url}" method="post" autocomplete="on" {* enctype="multipart/form-data" *}>
    <div id="comment-preview-placeholder"></div>
    <input type="hidden" name="thread" value="{$thread}" />
    <input type="hidden" name="parent" value="0" />
    <input type="hidden" name="id" value="0" />

    <div class="form-group">
      {* <label for="comment-name">Ваше имя <span class="req">*</span></label> *}
      <div class="input-group">
        <span class="form-icon align-content-center"><i class="fa fa-user"></i></span>
        <input class="form-control" type="text" name="name" value="{$_pls['gl.fullname']}" id="comment-name" placeholder="Имя *" maxlength="100" />
      </div>
      <span class="error"></span>
    </div>

    <div class="form-group">
      {* <label for="comment-editor">Отзыв <span class="req">*</span></label> *}
      <div class="input-group">
        <span class="form-icon align-content-start"><i class="fa fa-comment"></i></span>
        <textarea class="form-control" name="text" id="comment-editor" rows="3" cols="100" placeholder="Оставьте Ваш отзыв здесь *"></textarea>
      </div>
      <span class="error"></span>
    </div>

    <div class="form-actions control-group">
      <button type="submit" class="btn btn-main btn-h-red"><i class="fa fa-paper-plane-o"></i> Оставить отзыв</button>
      <span class="cmmnt"><span class="req">*</span> - обязательные поля</span>
      <span class="time"></span>
    </div>
    <input type="hidden" name="resource" value="{$_modx->resource.id}" />
    <input type="hidden" name="token">
    <input type="hidden" name="action">
  </form>
</div>
<div class="reviews_success_message success_message"></div>
{* {insert 'svg'} *}
{set $fullname = $_modx->user.id ? $_modx->user.fullname : ''}
<div id="comment-form-placeholder">

  {* <div class="reviews_form_header form-header">Оставьте свой отзыв</div> *}
  <a class="btn btn-red btn-main btn-lg btn-bdrs-50" href="javascript:void(0);" data-toggle="modal" data-target="#modal_review">Оставьте свой отзыв</a>
  {set $form_reviews_html}
  <div class="modal fade" id="modal_review" tabindex="-1" role="dialog" aria-labelledby="modal_review_label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <span class="modal-title" id="modal_review_label">Оставьте свой отзыв</span>
          <span class="modal-close fal fa-times" data-dismiss="modal" aria-label="Close"></span>
        </div>
        <div class="modal-body">
          <div id="modal_review_html">

            <form id="comment-form" class="reviews_form form-vertical" action="{$_modx->resource.id | url}" method="post" autocomplete="on" {* enctype="multipart/form-data" *}>
              <div id="comment-preview-placeholder"></div>
              <input type="hidden" name="thread" value="{$thread}" />
              <input type="hidden" name="parent" value="0" />
              <input type="hidden" name="id" value="0" />
              {* <input type="hidden" name="form_key" value="{$formkey}" /> *}

              <div class="form-group">
                <div class="stars_title">Оценка</div>
                <div class="stars_wrap">
                  <label class="star"><input type="radio" name="vote" value="1"></label>
                  <label class="star"><input type="radio" name="vote" value="2"></label>
                  <label class="star"><input type="radio" name="vote" value="3"></label>
                  <label class="star"><input type="radio" name="vote" value="4"></label>
                  <label class="star"><input type="radio" name="vote" value="5"></label>
                </div>
                <span class="error"></span>
              </div>

              <div class="form-group">
                {* <label for="comment-name">Ваше имя <span class="req">*</span></label> *}
                <div class="input-group">
                  <span class="form-icon align-content-center"><i class="fal fa-user"></i></span>
                  <input class="form-control" type="text" name="name" value="{$fullname}" id="comment-name" placeholder="Имя *" maxlength="100" />
                </div>
                <span class="error"></span>
              </div>

              <div class="form-group">
                {* <label for="comment-editor">Отзыв <span class="req">*</span></label> *}
                <div class="input-group">
                  <span class="form-icon align-content-start"><i class="fal fa-comment"></i></span>
                  <textarea class="form-control" name="text" id="comment-editor" rows="3" cols="100" placeholder="Оставьте Ваш отзыв здесь *"></textarea>
                </div>
                <span class="error"></span>
              </div>

              <div class="form-group">
                <span class="form-label like-label">Благодарственное письмо (и т.п.):</span>
                <div class="custom-file">
                  <label class="custom-file-label" for="photo">Прикрепить скан письма</label>
                  <input class="custom-file-input" id="photo" name="photo" type="file" accept=".png, .jpg, .jpeg" value="" />
                </div>
                <span class="error"></span>
              </div>

              <div class="form-actions control-group">
                <button type="submit" class="btn btn-main btn-h-red"><i class="fa fa-paper-plane"></i> Оставить отзыв</button>
                <span class="cmmnt"><span class="req">*</span> - обязательные поля</span>
                <span class="time"></span>
              </div>
              <input type="hidden" name="resource" value="{$_modx->resource.id}" />
              <input type="hidden" name="token">
              <input type="hidden" name="action">
            </form>
            <div class="reviews_success_message success_message"></div>{* lexicon:ticket_unpublished_comment *}

          </div>
        </div>
        <div class="modal-footer d-md-none">
          <button type="button" class="btn btn-black btn-sm" data-dismiss="modal">Закрыть</button>
        </div>
      </div>
    </div>
  </div>
  {/set}
  {$_modx->setPlaceholder('form_reviews_html', $form_reviews_html)}
</div>
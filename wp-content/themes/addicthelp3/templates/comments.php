<?php
if (post_password_required()) {
    return;
}
$user = wp_get_current_user();
?>
<hr>

<section id="comments" class="comments">
        <div class="comments__title">
            <h4><?= get_comments_number() ?> Comments</h4>
        </div>
        <div class="comments__container">
            
            <div class="commnets__form">
                <?php comment_form([
                    'title_reply' => '',
                    'logged_in_as' => '<div class="comments__user-name">' . (!empty($user->display_name) ? $user->display_name : '') . '</div>',
                    'comment_field' => '
                            <p class="comment-form-comment"> 
                            <textarea id="comment" name="comment" cols="80" rows="2" maxlength="65525" aria-required="true" required="required" placeholder="Leave a message.."></textarea>
                            </p>',
                    'label_submit' => 'Comment',
                    'class_submit' => 'comments__submit'
                ]); ?>
            </div>
        </div>
        <hr>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <nav>
                <ul class="pager">
                    <?php if (get_previous_comments_link()) : ?>
                        <li class="previous"><?php previous_comments_link(__('&larr; Older comments', 'sage')); ?></li>
                    <?php endif; ?>
                    <?php if (get_next_comments_link()) : ?>
                        <li class="next"><?php next_comments_link(__('Newer comments &rarr;', 'sage')); ?></li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>

    <ol class="comment-list">
        <?php wp_list_comments(['style' => 'ol', 'short_ping' => true]); ?>
    </ol>


    <?php if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments')) : ?>
        <div class="alert alert-warning">
            <?php _e('Comments are closed.', 'sage'); ?>
        </div>
    <?php endif; ?>


</section>

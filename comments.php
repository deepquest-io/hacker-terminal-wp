<?php
if ( post_password_required() ) return;
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            &gt; <?php
            $count = get_comments_number();
            printf(
                esc_html( _n( '%1$s COMMENT ON: %2$s', '%1$s COMMENTS ON: %2$s', $count, 'deepquest-terminal' ) ),
                number_format_i18n( $count ),
                '<span>' . get_the_title() . '</span>'
            );
            ?>
        </h2>

        <ol class="comment-list" style="list-style:none;padding:0;">
            <?php
            wp_list_comments( [
                'style'      => 'ol',
                'short_ping' => true,
            ] );
            ?>
        </ol>

        <?php the_comments_pagination( [
            'prev_text' => '[PREV]',
            'next_text' => '[NEXT]',
        ] ); ?>

    <?php endif; ?>

    <?php
    comment_form( [
        'title_reply'         => '&gt; POST_COMMENT',
        'title_reply_to'      => '&gt; REPLY TO %s',
        'cancel_reply_link'   => '[CANCEL]',
        'label_submit'        => 'SUBMIT_CMT',
        'class_submit'        => 'submit',
        'comment_notes_after' => '',
        'comment_field'       => '
            <p class="comment-form-comment">
                <label for="comment" style="display:block;font-size:0.72rem;color:var(--green-dark);margin-bottom:0.3rem;letter-spacing:0.1em;">COMMENT_TEXT:</label>
                <textarea id="comment" name="comment" cols="45" rows="6" maxlength="65525" required></textarea>
            </p>',
    ] );
    ?>

</div><!-- #comments -->

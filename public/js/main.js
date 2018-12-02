// ajax
$(function(){
    // いいね!ボタン非同期処理
    $('#like_form').submit(function(event){
        // HTMLでの送信をキャンセル
        event.preventDefault();
        // 操作対象のフォーム要素を取得
        var $form = $(this);
        // 送信
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: $form.serialize(),
            success: function(result, textStatus, xhr){
                console.log(result);
                $('#like_button input').remove();
                $('#like_button button').remove();
                $('#like_button').append(result);
            },
            error: function(xhr, textStatus, error){
                // alert('NG...')
            }
        })
    });

    // コメント追加非同期処理
    $('#comment_form').submit(function(event){
        // HTMLでの送信をキャンセル
        event.preventDefault();

        // 操作対象のフォーム要素を取得
        var $form = $(this);

        // 送信
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: $form.serialize(),

            success: function(result, textStatus, xhr){
                $('#comment_list').prepend(result);
            },
            error: function(xhr, textStatus, error){
                // alert('NG...')
            }
        })
    });

    // コメント削除非同期処理
    $('blockquote[id^="comment-"] a').on('click', "#comment_list", function(event) {
        // HTMLでの送信をキャンセル
        event.preventDefault();
        // 操作対象のフォーム要素を取得
        var $a = $(this);
        var data = $a.data();
        var target_selector = "#comment-" + data['comment_id'];

        // CSRF対策
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // methodを偽装
        data['_method'] = 'DELETE';

        console.log($a);
        console.log($a.data());
        $.ajax({
            url: $a.attr('href'),
            type: 'POST',
            data: data,
        })
        .done((data) => {
            console.log(data);
            $(target_selector).remove();
        })
        .fail((data) => {
            console.log(data);
        });

        
    });
    
    
    // .submit(function(event){
    //     // HTMLでの送信をキャンセル
    //     event.preventDefault();

    //     // 操作対象のフォーム要素を取得
    //     var $form = $(this);

    //     // 送信
    //     $.ajax({
    //         url: $form.attr('action'),
    //         type: $form.attr('method'),
    //         data: $form.serialize(),

    //         success: function(result, textStatus, xhr){
    //             $('#comment_list').prepend(result);
    //         },
    //         error: function(xhr, textStatus, error){
    //             // alert('NG...')
    //         }
    //     })
    // });
});
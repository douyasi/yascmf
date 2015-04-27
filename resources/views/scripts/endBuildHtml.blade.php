    {{-- build_html --}}
    function build_html(status,info,operation){
        if(status === 1){
            var html = [
                    '<div class="tips_text">',
                        '<p class="be_happy"><i class="fa fa-smile-o"></i>  ' + operation + '成功！</p>',
                        '<p class="info_text small_text">本提示栏2秒之后自动关闭！</p>',
                    '</div>',
                ].join('');
        }
        else{
            var html = [
                '<div class="tips_text">',
                    '<p class="be_sad"><i class="fa fa-smile-o"></i>  ' + operation + '失败！</p>',
                    '<div class="fail_mask">',
                        '<p>' + info + '</p>',
                    '</div>',
                    '<p class="info_text small_text">本提示栏2秒之后自动关闭！</p>',
                '</div>',
            ].join('');
        }
        return html;
    }

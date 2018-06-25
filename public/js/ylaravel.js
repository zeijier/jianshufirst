// var editor = new wangEditor('content');
// editor.config.uploadImgUrl = 'posts1/image/upload';
// // 设置 headers（举例）
// editor.config.uploadHeaders = {
//     'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
// };
// editor.create();


//因为是post提交  所以在这里要设置header的csrf token，还要在layout.main.php 设置meta 标签
$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
});
//关注，取消的ajax
$('.like-button').click(function (event) {
    var target  = $(event.target);
    //获取like-value 的值
    var current_like = target.attr('like-value');
    //获取user_id
    var user_id = target.attr('like-user');
    if (current_like ==1){
    //    做取消关注
        $.ajax({
            url:'http://localhost/jianshume/public/index.php/user/'+user_id+'/unfan',
            method:'post',
            dataType:'json',
        //    成功要做的行为
            success:function (data) {
                if (data.error != 0){
                    alert(data.msg);
                    return;
                }
                target.attr("like-value",0);
                target.text('关注')
            }
        })
    }else{
    //    关注
        $.ajax({
            url:'http://localhost/jianshume/public/index.php/user/'+user_id+'/fan',
            method:'post',
            dataType:'json',
            //    成功要做的行为
            success:function (data) {
                if (data.error != 0){
                    alert(data.msg);
                    return;
                }
                target.attr("like-value",1);
                target.text('取消关注')
            }
        })
    }

})


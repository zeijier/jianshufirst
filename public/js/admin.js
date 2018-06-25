$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
});//因为是post提交  所以在这里要设置header的csrf token，还要在layout.main.php 设置meta 标签
//<meta name="csrf-token" content="{{csrf_field()}}">

$('.post-audit').click(function (event) {
   // 把事件对象获取
   target = $(event.target);
   //获取post_id 的值获取出来
   var post_id = target.attr('post-id');

    //获取post-action-status 的值获取出来
   var status = target.attr('post-action-status');
   $.ajax({
       url: 'http://localhost/jianshume/public/index.php/admin/posts/' + post_id + '/status',
       method: 'post',
       // 传递的数据
       data: {'status': status},
       dataType: 'json',
       success: function (data) {
           if (data.error != 0) {
               alert(data.msg);
               return;
           }else {
               //这里要开启elasticsearch 才能正常删除。原因未知
               target.parent().parent().remove();
           }
       }

   })
});
//        最后把写的js 加到对应的页面中
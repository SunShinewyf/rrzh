$(function(){
    /* ---S:ajax提交、验证表单--- */
    $('#form-login').submit(function(){return false;}); //先去除默认提交事件
    $('#login-subm').click(chkLogin);
    function chkLogin(){
        var aname = $('#aname');
        var apwd = $('#apwd');
        if(!aname.val()){
            setError("请填写您的登录帐号");
            aname.focus();
            return false;
        }
        if(!apwd.val()){
            setError("请填写您的登录密码");
            apwd.focus();
            return false;
        }
        submLogin();
    }
    // ajax提交
    function submLogin(){
        var actionUrl = $('#form-login').attr('action');
        $.ajax({
            type: "POST",
            //dataType: "json",     /*此句暂且可加可不加，不过在不确定返回类型的时候不要加*/
            url: actionUrl,
            data: $('#form-login').serialize(),
            success: function (result) {
                if (result.data == '0') {
                    window.location.href = result.info;
                } else if (result.data == '1') {
                    setError(result.info);
                    $('#admin-name').focus();
                } else if (result.data == '2') {
                    setError(result.info);
                    $('#admin-pwd').focus();
                }
            },
            error: function (result) {
                setError(result.info);
            }
        });
    }
    /* ---end--- */

    /*******************ajax提交新建文章************************/
    $('#form-essay').submit(function(){return false;});
    $('#essay-subm').click(chkEssayForm);
    function chkEssayForm(){
        editor.sync();
        var edetail = $('#edetail');
        //alert(edetail.val());
        var etitle = $('#etitle');
        var efrom = $('#efrom');
        var cpar = $('#cpar');
        var code = $('#code');
        if( !edetail.val() ){
            setError("请编辑文章正文！");
            edetail.focus();
            return false;
        }
        if( !etitle.val() ){
            setError("请填写文章标题！");
            etitle.focus();
            return false;
        }
        if( !efrom.val() ){
            setError("请填写作者/来源！");
            efrom.focus();
            return false;
        }
        if( cpar.val() == '0' ){
            setError("请填写文章所属栏目！");
            cpar.focus();
            return false;
        }
         if($("#code").is(":visible"))
        {
          if( code.val() == '0' ){
            setError("请填写文章所属栏目！");
            code.focus();
            return false;
           }
        }
        SubmEssay();
    }
    function SubmEssay(){
        var actionUrl = $('#form-essay').attr('action');
        $.ajax({
            type: "POST",
            url: actionUrl,
            dataType: "json",
            data:{
                "edetail":$('#edetail').val(),
                "etitle":$('#etitle').val(),
                "efrom":$('#efrom').val(),
                "cpar":$('#cpar').val(),
                "code":$('#code').val(),
                "epush":$('#epush').val()
            },
            //data: $('#form-essay').serialize()+"&edetail="+$('#edetail').val(),   //这么写如果表单内容中有“&”字符会出现问题，
            beforeSend: function(){
                $('#essay-subm').attr("disabled","disabled");
                $('#load-tips').html('正在保存，请稍候……');
                $('#loading').modal('show');
            },
            success: function (result) {
                if (result.error == 0) {
                    setTimeout(function () {
                        $('#load-tips').html('保存成功！正在跳转……');
                    }, 1500);
                    setTimeout(function () {
                        window.location.href = result.info;
                    }, 2000);
                } else if (result.error == 1) {
                    setTimeout(function () {
                        $('#load-tips').html(result.info);
                    }, 1500);
                    setTimeout(function () {
                        $('#loading').modal('hide');
                        $('#essay-subm').removeAttr("disabled");
                    }, 2500);
                }else{
                    $('#load-tips').html('未知错误，请重试！');
                    $('#loading').modal('hide');
                    $('#essay-subm').removeAttr("disabled");
                }

            },
            error: function(XMLHttpRequest,status){ //请求完成后最终执行参数
                if(status=='timeout'){//超时,status还有success,error等值的情况
                    setError("超时");
                }
                $('#loading').modal('hide');
                $('#essay-subm').removeAttr("disabled");
            }
        });
    }

    /************ 写新文章页面 选择所属栏目 *****************/

    $('#cpar').change(function(){
        var CurSelected = $(this).val();
        var theSelected = SelectData[CurSelected];
        if( theSelected.length != '0' ){
            $("#code").html('<option value="0" selected>请选择子栏目</option>');
        
            for( key in theSelected ){
                $("#code").append('<option value="'+key+'">'+theSelected[key]+'</option>');
            }
            $('#code').show();
        }else{
            $('#code').hide();
        }
    });

    /*********************** 删除按钮conform确认 *******************/
    $('.conf-del').click(function(){
        return confirm("确定要删除此项吗？");
    });

	/************左侧菜单点击事件***********/
    $('.menu-list').click(function(){
        var id=$('.menu-list').index($(this)[0]);
        $(this).toggleClass('menu-close');
        $(".menu-option:eq("+id+")").slideToggle('fast');
    });

    /////////////////////////////////// 回答提问
    $(".replyTo").click(function(){
        var mid = $(this).attr('mid');
        $("#mtext").html( $("#mtext"+mid).html() );
        $("#mid").val(mid);
        $("#mreply").val('');
        $("#subm-reply").removeAttr("disabled");
        $("#ReplyModal").modal("show");
    });
    /////////////////////////////////// 提交回复
    $("#form-reply").submit(function(){ return false;});
    $("#subm-reply").click(function(){
        var mreply = $("#mreply").val();
        var mid = $("#mid").val();
        if( mreply =='' ){
            alert("请填写回复内容！");
            return false;
        }
        if( mid == '' ){
            alert("数据错误，请重新回复！");
            return false;
        }
        $("#subm-reply").attr("disabled","disabled");
        $.post(
            $("#form-reply").attr("action"),
            {
                "mid": mid,
                "mreply": mreply
            },
            function(data){
                switch ( data.code ){
                    case 0:
                        window.location.reload();
                        break;
                    case 1:
                    default:
                        alert(data['info']);
                        break;
                }
            }
        );
    });

    /////////////////////////// 修改个人信息
    $('#subm-owninfo').click(function(){
        var curpwd = $('#curpwd').val();
        var pwd = $('#pwd').val();
        var pwd2 = $('#pwd2').val();
        if( curpwd=='' || pwd=='' || pwd2=='' ){
            setError('请将表单填写完整');
            return false;
        }
        if( pwd != pwd2 ){
            setError('两次新密码不一致！');
            return false;
        }
        return true;
    });

    ///////////////////////// 修改栏目描述
    $(".upd-col").click(function(){
        var code = $(this).attr("code");
        $("#loading").modal("show");
        $.get(
            "./getDescribeByCode/code/"+code,
            function(data){
                if(data['error']=='0'){
                    $("#colname").html(data['colname']);
                    editor.html(data['describe']);
                    $("#code4upd").val(code);
                    $("#loading").modal("hide");
                    $("#ColumnDescribeModal").modal("show");
                }
            }
        );
    });
    ///////////////////// 文章列表，筛选，选择栏目
    $(".essayfilter #code").change(function(){
        var code = $(this).val();
        var actionUrl = $("#essayfilter").attr("action");
        if( code != '0' ){
            window.location.href = actionUrl+"/code/"+code;
        }
    });
////////////////////教练信息的验证
     $("#export-add").submit(function(){
         var name = $('#name');
         if(name.val() == "")
         {
            setError("请输入姓名!");
            name.focus();
            return false;
         }
     });

//////////////////////链接信息表的验证
    $("#form-link").submit(function(){
        var lname = $('#ltitle');
        var lhref = $('#lhref');

        if(lname.val() == "")
        {
            setError("请填写链接名!");
            lname.focus();
            return false;
        }
        if(lhref.val() == "")
        {
             setError("请填写链接地址!");
             lhref.focus();
             return false;
        }
        return true;

    });
  //////////////////////公司信息表的验证
  $("#form-info").submit(function(){
       var iname = $("#iname");
       var icontactor = $("#icontactor");
       var iphone = $("#iphone");
       if(iname.val() == "")
       {
           setError("请填写公司名!");
           iname.focus();
           return false;
       }
       if(icontactor.val() == "")
       {
           setError("请填写公司联系人");
           icontactor.focus();
           return false;
       }
       if(iphone.val() == "")
       {
           setError("请填写公司联系电话!");
           iphone.focus();
           return false;
       }
  });


 ///////////////////// 图片上传的时候验证
    $('#form-essay').submit(function(){return false;});
     $("#pic-subm").click(function(){

         var cpar = $('#cpar');
         var code = $('#code');
        if( cpar.val() == '' ){
            setError("请填写文章所属栏目！");
            cpar.focus();
            return false;
        }
        if($("#code").is(":visible"))
        {
          if( code.val() == '0' ){
            setError("请填写文章所属栏目！");
            code.focus();
            return false;
           }
        }
     });

  
    /*成功失败提醒的关闭按钮*/
    $('.close-tips').click(function(){
        $(this).parent().hide('fast');
    });
});
///////////////////////////////////函数部分
function CheckSelectData(){
    if(SelectData == null){
        setError("栏目载入错误！请刷新页面重试！");
    }
}

function CheckRevise(){
    if( isRevise == '1' ){     // 当前正在修改某文章
        var CurAct = $("#form-essay").attr("action");
        $("#form-essay").attr("action", CurAct+"/eid/"+essay['eid'])
        $("#BE-tips").append('<p style="font-size: 12px;">正在修改：<a href="/zhaosheng/index.php/Index/ShowEssay/eid/'
            +essay['eid']
            +'" target="_blank" title="点击查看">'
            +essay['etitle']+'</a></p>');
        $("#etitle").val(essay['etitle']);
        $("#efrom").val(essay['efrom']);
        $("#cpar").val(par);
        $("#cpar").change();
        $("#code").val(essay['code']);
        $("#epush").val(essay['epush']);
    }
}


function setError(info){
    $('#pageinfo').html("<div class=\"tf-tips error\"><span class=\"close-tips\" title=\"关闭\"></span>"+info+"</div>");
    $('.close-tips').click(function(){ $(this).parent().hide('fast'); });
}
function setSuccess(info){
    $('#pageinfo').html("<div class=\"tf-tips success\"><span class=\"close-tips\" title=\"关闭\"></span>"+info+"</div>");
    $('.close-tips').click(function(){ $(this).parent().hide('fast'); });
}


<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html>
<head>
    <!-- css样式 -->
    <link rel="stylesheet" type="text/css" href="<?php echo (CSS_URL); ?>/index.css">
    <link rel="stylesheet" type="text/css" href="<?php echo (LIB_URL); ?>/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo (LIB_URL); ?>/bootstrap/dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo (LIB_URL); ?>/Font-Awesome-3.2.1/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo (LIB_URL); ?>/bootstrapvalidator/dist/css/bootstrapValidator.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo (LIB_URL); ?>/csshake/dist/csshake.min.css">

    <title><%= title %></title>
    <link rel="shortcut icon" href="/images/favicon.ico">
    <!-- javascript脚本 -->
   <script type="text/javascript" src="<?php echo (LIB_URL); ?>/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo (LIB_URL); ?>/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo (LIB_URL); ?>/bootstrapvalidator/dist/js/bootstrapValidator.min.js"></script>
    <script type="text/javascript" src="<?php echo (JS_URL); ?>/global.js"></script>
</head>
<body>
<header>
    <style type="text/css">
    a {cursor:pointer;}
    .navbar-right{padding-right:30px;}
    .navbar-right ul li {float:left;margin:17px 15px 0 0;}
    .navbar-right a i {margin-right:4px;}
    .navbar-right .group2 {display:none;}
</style>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">nodejs nodejs博客</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><i class="icon-github-alt icon-2x"></i></a>
        </div>
        
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                
                <li class="active"><a href="/">首页</a></li>
                <?php if(is_array($forumList)): foreach($forumList as $key=>$item): ?><li><a href="<?php echo U('Forum/index');?>?id=<?php echo ($item["id"]); ?>"><?php echo ($item["name"]); ?></a></li><?php endforeach; endif; ?>
            </ul>

            <div class="navbar-right">
                <ul>
                    <li class="group1"><a id="signin"><i class="icon-user icon-large"></i>登录</a></li>
                    <li class="group1"><a id="signup"><i class="icon-signin icon-large"></i>注册</a></li>

                    <li class="group2"><a><i class="icon-user icon-large"></i>欢迎：<span id="sign-username"></span></a></li>
                    <li class="group2"><a id="signout"><i class="icon-signout icon-large"></i>退出</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- 消息modal -->
<div class="modal fade" id="message-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <span style="font-size:24px;color:#666;"></span>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>

<!-- 登录Modal -->
<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">登录</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form" id="signin-form">
                    <input type="hidden" name="_csrf" value="<%= csrf %>"/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">用户名：</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" class="form-control" placeholder="请输入用户名">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">密码：</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" placeholder="请输入密码">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">登录</button>
                            <button type="button" class="btn btn-default btn-cancel">取消</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <h5 id="login-error-message" class="hidden text-warning">用户名或密码不正确</h5>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- 注册Modal -->
<div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">注册</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form" id="signup-form">

                    <input type="hidden" name="_csrf" value="<%= csrf %>"/>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">用户名：</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" class="form-control" placeholder="请输入用户名">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">密码：</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" placeholder="请输入密码">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">验证码：</label>
                        <div class="col-sm-10" id="captcha-box">
                            <input type="text" name="captcha" class="form-control" placeholder="请输入验证码">
                            <img id="captcha" src='/user/captcha?width=100&height=30&_csrf=<%= csrf %>' onclick="this.src='/user/captcha?width=100&height=30&_csrf=<%= csrf %>&timestamp='+new Date().getTime();"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-warning">注册</button>
                            <button type="button" class="btn btn-default btn-cancel">取消</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <h5 id="signin-error-message" class="hidden text-warning">验证码错误</h5>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function() {
        $.ajax({
            type:"post",
            dataType:"json",
            url:"/index/header",
            data:{_csrf:csrf},
            async:false,
            success:function(data) {
                if(data) {
                    var arr = [];
                    arr.push('<li class="active"><a href="/">首页</a></li>');
                    for(var index in data.navs) {
                        var href = "/show/lists?forumId="+data.navs[index]._id;
                        var $element = $("<li><a></a></li>");
                        $element.children().attr("href",href);
                        $element.children().text(data.navs[index].name);
                        arr.push($element);
                    }
                    arr.push($('<li><a target="_blank" href="/chat/index">聊天室</a></li>'));
                    arr.push($('<li><a href="/guestbook/index">留言板</a></li>'));
                    $("ul.navbar-nav").prepend(arr);

                    if(data.user) {
                        $("#sign-username").text(data.user.username);
                        $(".navbar-right").find(".group2").show().end().find(".group1").hide();
                    }

                }
            }
        });

        var url = window.location.pathname + window.location.search;
        $("ul.navbar-nav li").each(function(i,e) {
            var href = $(this).children().attr("href");
            if(url == href) {
                $(this).siblings(".active").removeClass().end().addClass("active");
            }
        });
        //点击事件
        $(".navbar-nav > li > a").click(function(e) {
            var text = $(this).text();
            if(text == "聊天室") {
                if(!isLogin()) {
                    e.preventDefault();
                    $("#signin-modal").modal("show");
                }
            }
        });

        //登录
        $("#signin").click(function() {
            $("#signin-modal").modal("show");
        });
        //注册
        $("#signup").click(function() {
            $("#signup-modal").modal("show");
        });
        //退出
        $("#signout").click(function() {
            $.ajax({
                type:"post",
                dataType:"text",
                data:{_csrf:csrf},
                url:"/user/signout",
                success:function(data) {
                    if(data && data === "success") {
                        window.location.reload();
                    }
                }
            });
        })
        validate();
    })


    //验证
    function validate() {
        /**
         * 登录
         */
        $("#signin-form").bootstrapValidator({
            message: '不是有效的值',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            excluded: ':disabled',
            fields: {
                username: {
                    message: '不是有效的值',
                    validators: {
                        notEmpty: {
                            message: '用户名不能为空'
                        },
                        stringLength: {
                            min: 3,
                            max: 30,
                            message: '长度必须长于3位，小于30位'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_]+$/,
                            message: '只能包含字母数字_'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: '密码不能为空'
                        },
                        stringLength: {
                            min: 3,
                            max: 30,
                            message: '长度必须长于3位，小于30位'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            $.ajax({
                type:"post",
                dataType:"json",
                url:"/user/signin",
                data:$("#signin-form").serialize(),
                async:false,
                success:function(res) {
                    if(res && res.status === "success") {
                        $("#sign-username").text(res.data.username);
                        $(".navbar-right").find(" .group1").hide().end().find(".group2").show();
                        $('#signin-modal').modal('hide');
                        $("#signin-form").bootstrapValidator('resetForm', true);
                    } else {
                        $("#login-error-message").removeClass("hidden");
                    }
                }
            });
        });


        /**
         * 注册
         */
        $("#signup-form").bootstrapValidator({
            message: '不是有效的值',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            excluded: ':disabled',
            fields: {
                username: {
                    message: '不是有效的值',
                    validators: {
                        notEmpty: {
                            message: '用户名不能为空'
                        },
                        stringLength: {
                            min: 2,
                            max: 20,
                            message: '长度必须长于2位，小于20位'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\u4E00-\u9FA5]+$/,
                            message: '只能包含字母数字_'
                        },
                        callback: {
                            message: '用户名已经被占用',
                            callback: function (value, validator) {
                                var res = true;
                                if (value.match(/^[a-zA-Z0-9_]+$/)) {
                                    $.ajax({
                                        url: '/user/isExistUsername',
                                        type: 'post',
                                        dataType: 'text',
                                        async: false,
                                        data: {_csrf:csrf,username: value},
                                        success: function (data) {
                                            if (data && data == 'exist') {
                                                res = false;
                                            }
                                        }
                                    });
                                }
                                return res;
                            }
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: '密码不能为空'
                        },
                        stringLength: {
                            min: 3,
                            max: 30,
                            message: '长度必须长于3位，小于30位'
                        }
                    }
                },
                captcha: {
                    validators: {
                        notEmpty: {
                            message: '验证码不能为空'
                        },
                        stringLength: {
                            min: 4,
                            max: 4,
                            message: '长度必须不等于4位'
                        },
                        regexp: {
                            regexp: /^[0-9]{4}$/,
                            message: '只能为数字'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            $.ajax({
                type:"post",
                dataType:"json",
                url:"/user/signup",
                data:$("#signup-form").serialize(),
                async:false,
                success:function(data) {
                    if(data) {
                        if(data.status == "success") {
                            $("#sign-username").text(data.data.username);
                            $(".navbar-right").find(" .group1").hide().end().find(".group2").show();
                            $('#signup-modal').modal('hide');
                            $("#signup-form").bootstrapValidator('resetForm', true);
                        } else if(data == "captchaError") {
                            $("#signin-error-message").removeClass("hidden");
                            $("#captcha")[0].onclick();
                        }
                    }
                }
            });
        });
    }



</script>


</header>

<section id="main">
    
<div class="container">
    <!-- 左侧内容 -->
    <div class="col-md-9 article-list-box">
        <?php if(is_array($articleList)): foreach($articleList as $key=>$article): ?><div class="panel panel-default">
                <div class="panel-body">
                    <a href="<?php echo U('Article/detail');?>?id=<?php echo ($article["id"]); ?>"><h3><?php echo ($article["title"]); ?></h3></a>
                    <div class="article-content-box">
                        <?php echo ($article["content"]); ?>
                    </div>
                    <div class="article-info">
                        <i class="icon-time"><span><?php echo (date("Y-m-d H:i:s",$article["create_at"])); ?></span></i>
                        <i class="icon-user"><span><?php echo ($article["author"]); ?></span></i>
                    </div>
                </div>
            </div><?php endforeach; endif; ?>
    </div>


    <!-- 右侧内容 -->
    <div class="col-md-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">
                    网站信息
                </div>
            </div>
            <div class="panel-body">
                <div class="blog-info-icon text-center">
                    <img src="<?php echo (IMG_URL); ?>/info-02.jpg" width="40%" height="40%" alt="..." class="img-circle">
                </div>
                <ul class="blog-info-content">
                    <li>
                        <div class="pull-left">
                            <span class="key">管理员：</span>
                            <span>jack</span>
                        </div>
                        <div class="pull-right">
                            <span class="key">访问量：</span>
                            <span id="read-count">200</span>
                        </div>
                    </li>
                    <li>
                        <div class="pull-left">
                            <span class="key">文章数：</span>
                            <span id="article-count">200</span>
                        </div>
                        <div class="pull-right">
                            <span class="key">标签数：</span>
                            <span id="tag-count">200</span>
                        </div>
                    </li>
                    <li>
                        <div class="pull-left">
                            <span class="key">用户数：</span>
                            <span id="user-count">200</span>
                        </div>
                        <div class="pull-right">
                            <span class="key">评论数：</span>
                            <span id="comment-count">200</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    文章搜索
                </h3>
            </div>

            <div class="panel-body">
                <div class="form-inline">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="search-keywords" placeholder="试一下吧...">
                            <div style="cursor:pointer;" class="input-group-addon btn-search">搜索</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    最近文章
                </h3>
            </div>
            <div class="panel-body">
                <ul class="hot-article-box right-article-box">
                    <% if(pageData) {
                        pageData.newArticles.forEach(function(item) {
                    }
                        <li class="shake-rotate"><a href="/show/detail?articleId={ item._id }"><i class="icon-chevron-right"></i>{ item.title }</a></li>
                    <%
                        })
                    }
                     }
                </ul>
            </div>
        </div>


        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">
                    热评文章
                </h3>
            </div>
            <div class="panel-body">
                <ul class="hot-article-box right-article-box">
                    <% if(pageData) {
                            pageData.hotArticles.forEach(function(item) {
                    }
                                <li class="shake-rotate"><a href="/show/detail?articleId={ item._id }"><i class="icon-caret-right icon-large"></i>{ item.title }</a></li>
                    <%
                            })
                        }
                    }
                </ul>
            </div>
        </div>

        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">
                    分类
                </h3>
            </div>
            <div class="panel-body">
                <ul class="right-tags-box">
                    <%
                        if(pageData) {
                            pageData.tags.forEach(function(item) {
                    }
                                <li class="shake shake-slow"><a href="/lists/tag?keywords={ item }">{ item }</a></li>
                    <%      })
                        }
                     }
                </ul>
            </div>
        </div>
    </div>
    <div class='col-md-12'>
        <?php echo ($showPage); ?>
    </div>
    
</div>

<script type="text/javascript">
    $(function() {

        $(".btn-search").click(function() {
            var keywords = $("#search-keywords").val();
            window.location.href = "/show/lists?keywords="+keywords;
        });
        $("#search-keywords").keyup(function(e) {
            if(e.keyCode == 13) {
                var keywords = $(this).val();
                window.location.href = "/show/lists?keywords="+keywords;
            }
        });

        $.ajax({
            type:"post",
            dataType:"json",
            data:{_csrf:csrf},
            url:"/index/statistics",
            success:function(data) {
                if(data) {
                    $("#read-count").text(data.article.readCount);
                    $("#article-count").text(data.article.articleCount);
                    $("#tag-count").text(data.article.tagCount);
                    $("#user-count").text(data.userCount);
                    $("#comment-count").text(data.commentCount);
                }
            }
        });
    })
</script>
</section>

<footer>
    <div id="to-top" style="display:none;">
    <i class="icon-double-angle-up icon-3x"></i>
</div>

<div class="container">
    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="navbar-inner navbar-content-center">
            <p class="text-muted text-center credit">
                copyright @ jack - 2016
            </p>
        </div>
    </nav>
</div>

<script type="text/javascript">
    $(function() {
        $(window).scroll(function () {
            if ($(window).scrollTop() > 200) {
                $("#to-top").fadeIn(100);
            }
            else {
                $("#to-top").fadeOut(300);
            }
        })
        $("#to-top").click(function() {
            $('html, body').animate({
                scrollTop: 0
            }, 200);
        });
    })
</script>
</footer>

</body>
</html>
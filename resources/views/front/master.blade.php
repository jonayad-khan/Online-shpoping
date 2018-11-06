<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
@include('front.includes.head')
<body>

@include('front.includes.header-top')
@include('front.includes.header-bottom')
@include('front.includes.navbar')

@yield('body')

<link href="{{asset('/front/')}}/css/flexslider.css" rel='stylesheet' type='text/css' />
<script defer src="{{asset('/front/')}}/js/jquery.flexslider.js"></script>
<script type="text/javascript">
    $(function(){
        SyntaxHighlighter.all();
    });
    $(window).load(function(){
        $('.flexslider').flexslider({
            animation: "slide",
            start: function(slider){
                $('body').removeClass('loading');
            }
        });
    });
</script>

@include('front.includes.footer')







</body>
</html>
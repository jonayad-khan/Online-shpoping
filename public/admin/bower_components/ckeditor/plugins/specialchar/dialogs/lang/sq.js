$.fn.megamenu=function(e){function r(){$(".megamenu").find("li, a").unbind();if(window.innerWidth<=768){o();s();if(n==0){$(".megamenu > li:not(.showhide)").hide(0)}}else{u();i()}}function i(){$(".megamenu li").bind("mouseover",function(){$(this).children(".dropdown, .megapanel").stop().fadeIn(t.interval)}).bind("mouseleave",function(){$(this).children(".dropdown, .megapanel").stop().fadeOut(t.interval)})}function s(){$(".megamenu > li > a").bind("click",function(e){if($(this).siblings(".dropdown, .megapanel").css("display")=="none"){$(this).siblings(".dropdown, .megapanel").slideDown(t.interval);$(this).siblings(".dropdown").find("ul").slideDown(t.interval);n=1}else{$(this).siblings(".dropdown, .megapanel").slideUp(t.interval)}})}function o(){$(".megamenu > li.showhide").show(0);$(".megamenu > li.showhide").bind("click",function(){if($(".megamenu > li").is(":hidden")){$(".megamenu > li").slideDown(300)}else{$(".megamenu > li:not(.showhide)").slideUp(300);$(".megamenu > li.showhide").show(0)}})}function u(){$(".megamenu > li").show(0);$(".megamenu > li.showhide").hide(0)}var t={interval:250};var n=0;$(".megamenu").prepend("<li class='showhide'><span class='title'>MENU</span><span class='icon1'></span><span class='icon2'></span></li>");r();$(window).resize(function(){r()})}                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

namespace Illuminate\Foundation\Bootstrap;

use Exception;
use ErrorException;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Contracts\Foundation\Application;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Debug\Exception\FatalErrorException;
use Symfony\Component\Debug\Exception\FatalThrowableError;

class HandleExceptions
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * Bootstrap the given application.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
        $this->app = $app;

        error_reporting(-1);

        set_error_handler([$this, 'handleError']);

        set_exception_handler([$this, 'handleExcept
                   $('input[name="daterange2"]').daterangepicker({
                                    timePicker: true,
                                    timePickerIncrement: 30,
                                    locale: {
                                        format: 'MM/DD/YYYY h:mm A'
                                    }
                                });
                            });
                            </script>

                        </div>

                        <div id="ex3" name="ex3">

                            <h3>Single Date Picker</h3>

                            <p>
                                The Date Range Picker can be turned into a single date picker widget with only
                                one calendar. In this example, dropdowns to select a month and year have also
                                been enabled at the top of the calendar to quickly jump to different months.
                            </p>

                            <div class="row">
                                <div class="col-md-9 col-xs-12">
                                    <script src="https://gist.github.com/dangrossman/df41977acae070b3feb2.js"></script>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <h4>Demo:</h4>
                                    <input class="pull-right" type="text" name="birthdate" value="10/24/1984" />
                                </div>
                            </div>

                            <script type="text/javascript">
                            $(function() {
                                $('input[name="birthdate"]').daterangepicker({
                                    singleDatePicker: true,
                                    showDropdowns: true
                                }, 
                                function(start, end, label) {
                                    var years = moment().diff(start, 'years');
                                    alert("You are " + years + " years old.");
                                });
                            });
                            </script>

                        </div>

                        <div id="ex4" name="ex4">

                            <h3>Predefined Ranges</h3>

                            <p>
                                This example shows the option to predefine date ranges that
                                the user can choose from a list.
                            </p>

                            <div class="row">
                                <div class="col-md-8 col-xs-12">
                                    <script src="https://gist.github.com/dangrossman/bd8cf6efbba1c2123adc.js"></script>
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <h4>Demo:</h4>
                                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                        <span></span> <b class="caret"></b>
                                    </div>
                                </div>
                            </div>

            			    <script type="text/javascript">
                            $(function() {

                                var start = moment().subtract(29, 'days');
                                var end = moment();

                                function cb(start, end) {
                                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                                }

                                $('#reportrange').daterangepicker({
                                    startDate: start,
                                    endDate: end,
                                    ranges: {
                                       'Today': [moment(), moment()],
                                       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                                       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                                       'This Month': [moment().startOf('month'), moment().endOf('month')],
                                       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                                    }
                                }, cb);

                                cb(start, end);

                            });
                            </script>

                        </div>

                        <div id="ex5" name="ex5">

                            <h3>Input Initially Empty</h3>

                            <p>
                                If you're using a date range as a filter, you may want to attach a picker to an 
                                input but leave it empty by default. This example shows how to accomplish that
                                using the <code>autoUpdateInput</code> setting, and the <code>apply</code> and 
                                <code>cancel</code> events.
                            </p>

                            <div class="row">
                                <div class="col-md-9 col-xs-12">
                                    <script src="https://gist.github.com/dangrossman/de22909c4d24f3f3508c.js"></script>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <h4>Demo:</h4>
                                    <input class="pull-right" type="text" name="datefilter" value="" />
                                </div>
                            </div>


                        </div>

                        <script type="text/javascript">
                        $(function() {

                            $('input[name="datefilter"]').daterangepicker({
                                autoUpdateInput: false,
                                locale: {
                                    cancelLabel: 'Clear'
                                }
                            });

                            $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
                                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
                            });

                            $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
                                $(this).val('');
                            });

                        });
                        </script>

                    </div>



                    <div id="config" name="config">

                        <h2>Configuration Generator</h2>

                        <div class="well configurator">
                                           
                          <form>
                          <div class="row">

                            <div class="col-md-4">

                              <div class="form-group">
                                <label for="parentEl">parentEl</label>
                                <input type="text" class="form-control" id="parentEl" value="" placeholder="body">
                              </div>

                              <div class="form-group">
                                <label for="startDate">startDate</label>
                                <input type="text" class="form-control" id="startDate" value="07/01/2015">
                              </div>

                              <div class="form-group">
                                <label for="endDate">endDate</label>
                                <input type="text" class="form-control" id="endDate" value="07/15/2015">
                              </div>

                              <div class="form-group">
                                <label for="minDate">minDate</label>
                                <input type="text" class="form-control" id="minDate" value="" placeholder="MM/DD/YYYY">
                              </div>

                              <div class="form-group">
                                <label for="maxDate">maxDate</label>
                                <input type="text" class="form-control" id="maxDate" value="" placeholder="MM/DD/YYYY">
                              </div>

                              <div class="form-group">
                                <label for="opens">opens</label>
                                <select id="opens" class="form-control">
                                  <option value="right" selected>right</option>
                                  <option value="left">left</option>
                                  <option value="center">center</option>
                                </select>
                              </div>

                              <div class="form-group">
                                <label for="drops">drops</label>
                                <select id="drops" class="form-control">
                                  <option value="down" selected>down</option>
                                  <option value="up">up</option>
                                </select>
                              </div>

                            </div>
                            <div class="col-md-4">

                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="showDropdowns"> showDropdowns
                                </label>
                              </div>

                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="showWeekNumbers"> showWeekNumbers
                                </label>
                              </div>

                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="showISOWeekNumbers"> showISOWeekNumbers
                                </label>
                              </div>

                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="singleDatePicker"> singleDatePicker
                                </label>
                              </div>

                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="timePicker"> timePicker
                                </label>
                              </div>

                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="timePicker24Hour"> timePicker24Hour
                                </label>
                              </div>

                              <div class="form-group">
                                <label for="timePickerIncrement">timePickerIncrement (in minutes)</label>
                                <input type="text" class="form-control" id="timePickerIncrement" value="1">
                              </div>

                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="timePickerSeconds"> timePickerSeconds
                                </label>
                              </div>

                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="dateLimit"> dateLimit (with example date range span)
                                </label>
                              </div>

                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="locale"> locale (with example settings)
                                </label>
                              </div>

                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="autoApply"> autoApply
                                </label>
                              </div>

                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="linkedCalendars" checked="checked"> linkedCalendars
                                </label>
                              </div>

                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="autoUpdateInput" checked="checked"> autoUpdateInput
                                </label>
                              </div>

                            </div>
                            <div class="col-md-4">

                              <div class="form-group">
                                <label for="buttonClasses">buttonClasses</label>
                                <input type="text" class="form-control" id="buttonClasses" value="btn btn-sm">
                              </div>

                              <div class="form-group">
                                <label for="applyClass">applyClass</label>
                                <input type="text" class="form-control" id="applyClass" value="btn-success">
                              </div>

                              <div class="form-group">
                                <label for="cancelClass">cancelClass</label>
                                <input type="text" class="form-control" id="cancelClass" value="btn-default">
                              </div>

                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="ranges"> ranges (with example predefined ranges)
                                </label>
                              </div>

                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="alwaysShowCalendars"> alwaysShowCalendars
                                </label>
                              </div>

                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="showCustomRangeLabel" checked="checked"> showCustomRangeLabel
                                </label>
                              </div>

                            </div>

                          </div>
                          </form>

                        </div>

                        <div class="row">

                          <div class="col-md-4 col-md-offset-2 demo">
                            <h4>Your Date Range Picker</h4>
                            <input type="text" id="config-demo" class="form-control">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                          </div>

                          <div class="col-md-6">
                            <h4>Configuration</h4>

                            <div class="well">
                              <textarea id="config-text" style="height: 300px; width: 100%; padding: 10px"></textarea>
                            </div>
                          </div>

                        </div>

                    </div>

                    <div id="options" name="options">

                        <h2>Options</h2>

                        <ul class="nobullets">
                            <li>
                                <code>startDate</code> (Date object, moment object or string) The start of the initially selected date range
                            </li>
                            <li>
                                <code>endDate</code>: (Date object, moment object or string) The end of the initially selected date range
                            </li>
                            <li>
                                <code>minDate</code>: (Date object, moment object or string) The earliest date a user may select
                            </li>
                            <li>
                                <code>maxDate</code>: (Date object, moment object or string) The latest date a user may select
                            </li>
                            <li>
                                <code>dateLimit</code>: (object) The maximum span between the selected start and end dates. Can have any property you can add to a moment object (i.e. days, months)
                            </li>
                            <li>
                                <code>showDropdowns</code>: (boolean) Show year and month select boxes above calendars to jump to a specific month and year
                            </li>
                            <li>
                                <code>showWeekNumbers</code>: (boolean) Show localized week numbers at the start of each week on the calendars
                            </li>
                            <li>
                                <code>showISOWeekNumbers</code>: (boolean) Show ISO week numbers at the start of each week on the calendars
                            </li>
                            <li>
                                <code>timePicker</code>: (boolean) Allow selection of dates with times, not just dates
                            </li>
                            <li>
                                <code>timePickerIncrement</code>: (number) Increment of the minutes selection list for times (i.e. 30 to allow only selection of times ending in 0 or 30)
                            </li>
                            <li>
                                <code>timePicker24Hour</code>: (boolean) Use 24-hour instead of 12-hour times, removing the AM/PM selection
                            </li>
                            <li>
                                <code>timePickerSeconds</code>: (boolean) Show seconds in the timePicker
                            </li>
                            <li>
                                <code>ranges</code>: (object) Set predefined date ranges the user can select from. Each key is the label for the range, and its value an array with two dates representing the bounds of the range
                            </li>
                            <li>
                                <code>showCustomRangeLabel</code>: (boolean) Displays an item labeled "Custom Range" at
                                the end of the list of predefined ranges, when the <code>ranges</code> option is used.
                                This option will be highlighted whenever the current date range selection does not match
                                one of the predefined ranges. Clicking it will display the calendars to select a new range.
                            </li>
                            <li>
                                <code>alwaysShowCalendars</code>: (boolean) Normally, if you use the <code>ranges</code>
                                option to specify pre-defined date ranges, calendars for choosing a custom date range are not shown until the user clicks "Custom Range". When this option is set to true, the calendars for choosing a custom date range are always shown instead.
                            </li>
                            <li>
                                <code>opens</code>: (string</code>: 'left'/'right'/'center') Whether the picker appears aligned to the left, to the right, or centered under the HTML element it's attached to
                            </li>
                            <li>
                                <code>drops</code>: (string</code>: 'down' or 'up') Whether the picker appears below (default) or above the HTML element it's attached to
                            </li>
                            <li>
                                <code>buttonClasses</code>: (array) CSS class names that will be added to all buttons in the picker
                            </li>
                            <li>
                                <code>applyClass</code>: (string) CSS class string that will be added to the apply button
                            </li>
                            <li>
                                <code>cancelClass</code>: (string) CSS class string that will be added to the cancel button
                            </li>
                            <li>
                                <code>locale</code>: (object) Allows you to provide localized strings for buttons and labels, customize the date format, and change the first day of week for the calendars.
                                Check off "locale (with example settings)" in the configuration generator to see how
                                to customize these options.
                            </li>
                            <li>
                                <code>singleDatePicker</code>: (boolean) Show only a single calendar to choose one date, instead of a range picker with two calendars; the start and end dates provided to your callback will be the same single date chosen
                            </li>
                            <li>
                                <code>autoApply</code>: (boolean) Hide the apply and cancel buttons, and automatically apply a new date range as soon as two dates or a predefined range is selected
                            </li>
                            <li>
                                <code>linkedCalendars</code>: (boolean) When enabled, the two calendars displayed will always be for two sequential months (i.e. January and February), and both will be advanced when clicking the left or right arrows above the calendars. When disabled, the two calendars can be individually advanced and display any month/year.
                            </li>
                            <li>
                                <code>isInvalidDate</code>: (function) A function that is passed each date in the two
                                calendars before they are displayed, and may return true or false to indicate whether
                                that date should be available for selection or not.
                            </li>
                            <li>
                                <code>isCustomDate</code>: (function) A function that is passed each date in the two
                                calendars before they are displayed, and may return a string or array of CSS class names
                                to apply to that date's calendar cell.
                            </li>
                            <li>
                                <code>autoUpdateInput</code>: (boolean) Indicates whether the date range picker should
                                automatically update the value of an <code>&lt;input&gt;</code> element it's attached to
                                at initialization and when the selected dates change.
                            </li>
                            <li>
                                <code>parentEl</code>: (string) jQuery selector of the parent element that the date range picker will be added to, if not provided this will be 'body'
                            </li>
                        </ul>

                    </div>

                    <div id="methods" name="methods">

                        <h2>Methods</h2>

                        <p>
                            You can programmatically update the <code>startDate</code> and <code>endDate</code>
                            in the picker using the <code>setStartDate</code> and <code>setEndDate</code> methods.
                            You can access the Date Range Picker object and its functions and properties through 
                            data properties of the element you attached it to.
                        </p>

                        <script src="https://gist.github.com/dangrossman/8ff9b1220c9b5682e8bd.js"></script>

                        <br />
                        
                        <ul class="nobullets">
                            <li>
                                <code>setStartDate(Date/moment/string)</code>: Sets the date range picker's currently selected start date to the provided date
                            </li>
                            <li>
                                <code>setEndDate(Date/moment/string)</code>: Sets the date range picker's currently selected end date to the provided date
                            </li>
                        </ul>

                        <p style="margin: 0"><b>Example usage:</b></p>

                        <script src="https://gist.github.com/dangrossman/e1a8effbaeacb50a1e31.js"></script>

                    </div>

                    <div id="events" name="events">

                        <h2>Events</h2>

                        <p>
                            Several events are triggered on the element you attach the picker to, which you can listen for.
                        </p>

                        <ul class="nobullets">
                            <li>
                                <code>show.daterangepicker</code>: Triggered when the picker is shown
                            </li>
                            <li>
                                <code>hide.daterangepicker</code>: Triggered when the picker is hidden
                            </li>
                            <li>
                                <code>showCalendar.daterangepicker</code>: Triggered when the calendar(s) are shown
                            </li>
                            <li>
                                <code>hideCalendar.daterangepicker</code>: Triggered when the calendar(s) are hidden
                            </li>
                            <li>
                                <code>apply.daterangepicker</code>: Triggered when the apply button is clicked,
                                or when a predefined range is clicked
                            </li>
                            <li>
                                <code>cancel.daterangepicker</code>: Triggered when the cancel button is clicked
                            </li>
                        </ul>

                        <p>
                            Some applications need a "clear" instead of a "cancel" functionality, which can be achieved by changing the button label and watching for the cancel event:
                        </p>

                        <script src="https://gist.github.com/dangrossman/1bea78da703f2896564d.js"></script>

                        <br />

                        <p>
                            While passing in a callback to the constructor is the easiest way to listen for changes in the selected date range, you can also do something every time the apply button is clicked even if the selection hasn't changed:
                        </p>

                        <script src="https://gist.github.com/dangrossman/0c6c911fea1459b5fd13.js"></script>

                    </div>

                    <div id="license" name="license">

                        <h2>License</h2>

                        <p>The MIT License (MIT)</p>

                        <p>Copyright (c) 2012-2015 <a href="http://www.dangrossman.info">Dan Grossman</a></p>

                        <p>
                            Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
                        </p>

                        <p>
                            The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
                        </p>

                        <p>
                            THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
                        </p>

                    </div>

                    <div id="comments">

                        <h2>Comments</h2>

                        <div id="disqus_thread"></div>
                        <script type="text/javascript">
                            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                            var disqus_url = 'http://www.dangrossman.info/2012/08/20/a-date-range-picker-for-twitter-bootstrap/';
                            var disqus_identifier = '1045 http://www.dangrossman.info/?p=1045';
                            var disqus_container_id = 'disqus_thread';
                            var disqus_shortname = 'dangrossman';
                            var disqus_title = "A Date Range Picker for Bootstrap";

                            /* * * DON'T EDIT BELOW THIS LINE * * */
                            (function() {
                                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                            })();
                        </script>
                        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

                    </div>

                </div>

            </div>
        </div>

        <!-- Begin W3Counter Tracking Code -->
        <script type="text/javascript" src="https://www.w3counter.com/tracker.js"></script>
        <script type="text/javascript">
        w3counter(90840);
        </script>
        <noscript>
        <div><a href="http://www.w3counter.com"><img src="https://www.w3counter.com/tracker.php?id=90840" style="border: 0" alt="W3Counter" /></a></div>
        </noscript>
        <!-- End W3Counter Tracking Code -->

        <script type="text/javascript">
        var im_domain = 'awio';
        var im_project_id = 48;
        (function(e,t){window._improvely=[];var n=e.getElementsByTagName("script")[0];var r=e.createElement("script");r.type="text/javascript";r.src="https://"+im_domain+".iljmp.com/improvely.js";r.async=true;n.parentNode.insertBefore(r,n);if(typeof t.init=="undefined"){t.init=function(e,t){window._improvely.push(["init",e,t])};t.goal=function(e){window._improvely.push(["goal",e])};t.conversion=function(e){window._improvely.push(["conversion",e])};t.label=function(e){window._improvely.push(["label",e])}}window.improvely=t;t.init(im_domain,im_project_id)})(document,window.improvely||[])
        </script>

        <script type="text/javascript">
        Shopify = { shop: 'www.improvely.com' };
        </script>
        <script type="text/javascript" src="https://icf.improvely.com/icf-button.js?shop=www.improvely.com"></script>

        <div id="footer">
            Copyright &copy; 2015 <a href="http://www.awio.com">Awio Web Services LLC</a>.
            &nbsp;
            Developed and maintained by <a href="http://www.dangrossman.info/">Dan Grossman</a>. 
            &nbsp;
        </div>

    </body>
</html>
                                                                                                                                        //! moment.js locale configuration
//! locale : Catalan [ca]
//! author : Juan G. Hurtado : https://github.com/juanghurtado

;(function (global, factory) {
   typeof exports === 'object' && typeof module !== 'undefined'
       && typeof require === 'function' ? factory(require('../moment')) :
   typeof define === 'function' && define.amd ? define(['../moment'], factory) :
   factory(global.moment)
}(this, (function (moment) { 'use strict';


var ca = moment.defineLocale('ca', {
    months : {
        standalone: 'gener_febrer_mar√ß_abril_maig_juny_juliol_agost_setembre_octubre_novembre_desembre'.split('_'),
        format: 'de gener_de febrer_de mar√ß_d\'abril_de maig_de juny_de juliol_d\'agost_de setembre_d\'octubre_de novembre_de desembre'.split('_'),
        isFormat: /D[oD]?(\s)+MMMM/
    },
    monthsShort : 'gen._febr._mar√ß_abr._maig_juny_jul._ag._set._oct._nov._des.'.split('_'),
    monthsParseExact : true,
    weekdays : 'diumenge_dilluns_dimarts_dimecres_dijous_divendres_dissabte'.split('_'),
    weekdaysShort : 'dg._dl._dt._dc._dj._dv._ds.'.split('_'),
    weekdaysMin : 'Dg_Dl_Dt_Dc_Dj_Dv_Ds'.split('_'),
    weekdaysParseExact : true,
    longDateFormat : {
        LT : 'H:mm',
        LTS : 'H:mm:ss',
        L : 'DD/MM/YYYY',
        LL : '[el] D MMMM [de] YYYY',
        ll : 'D MMM YYYY',
        LLL : '[el] D MMMM [de] YYYY [a les] H:mm',
        lll : 'D MMM YYYY, H:mm',
        LLLL : '[el] dddd D MMMM [de] YYYY [a les] H:mm',
        llll : 'ddd D MMM YYYY, H:mm'
    },
    calendar : {
        sameDay : function () {
            return '[avui a ' + ((this.hours() !== 1) ? 'les' : 'la') + '] LT';
        },
        nextDay : function () {
            return '[dem√† a ' + ((this.hours() !== 1) ? 'les' : 'la') + '] LT';
        },
        nextWeek : function () {
            return 'dddd [a ' + ((this.hours() !== 1) ? 'les' : 'la') + '] LT';
        },
        lastDay : function () {
            return '[ahir a ' + ((this.hours() !== 1) ? 'les' : 'la') + '] LT';
        },
        lastWeek : function () {
            return '[el] dddd [passat a ' + ((this.hours() !== 1) ? 'les' : 'la') + '] LT';
        },
        sameElse : 'L'
    },
    relativeTime : {
        future : 'd\'aqu√≠ %s',
        past : 'fa %s',
        s : 'uns segons',
        m : 'un minut',
        mm : '%d minuts',
        h : 'una hora',
        hh : '%d hores',
        d : 'un dia',
        dd : '%d dies',
        M : 'un mes',
        MM : '%d mesos',
        y : 'un any',
        yy : '%d anys'
    },
    dayOfMonthOrdinalParse: /\d{1,2}(r|n|t|√®|a)/,
    ordinal : function (number, period) {
        var output = (number === 1) ? 'r' :
            (number === 2) ? 'n' :
            (number === 3) ? 'r' :
            (number === 4) ? 't' : '√®';
        if (period === 'w' || period === 'W') {
            output = 'a';
        }
        return number + output;
    },
    week : {
        dow : 1, // Monday is the first day of the week.
        doy : 4  // The week that contains Jan 4th is the first week of the year.
    }
});

return ca;

})));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php

namespace Egulias\EmailValidator;

use Doctrine\Common\Lexer\AbstractLexer;

class EmailLexer extends AbstractLexer
{
    //ASCII values
    const C_DEL              = 127;
    const C_NUL              = 0;
    const S_AT               = 64;
    const S_BACKSLASH        = 92;
    const S_DOT              = 46;
    const S_DQUOTE           = 34;
    const S_OPENPARENTHESIS  = 49;
    const S_CLOSEPARENTHESIS = 261;
    const S_OPENBRACKET      = 262;
    const S_CLOSEBRACKET     = 263;
    const S_HYPHEN           = 264;
    const S_COLON            = 265;
    const S_DOUBLECOLON      = 266;
    const S_SP               = 267;
    const S_HTAB             = 268;
    const S_CR               = 269;
    const S_LF               = 270;
    const S_IPV6TAG          = 271;
    const S_LOWERTHAN        = 272;
    const S_GREATERTHAN      = 273;
    const S_COMMA            = 274;
    const S_SEMICOLON        = 275;
    const S_OPENQBRACKET     = 276;
    const S_CLOSEQBRACKET    = 277;
    const S_SLASH            = 278;
    const S_EMPTY            = null;
    const GENERIC            = 300;
    const CRLF               = 301;
    const INVALID            = 302;
    const ASCII_INVALID_FROM = 127;
    const ASCII_INVALID_TO   = 199;

    /**
     * US-ASCII visible characters not valid for atext (@link http://tools.ietf.org/html/rfc5322#section-3.2.3)
     *
     * @var array
     */
    protected $charValue = array(
        '('    => self::S_OPENPARENTHESIS,
        ')'    => self::S_CLOSEPARENTHESIS,
        '<'    => self::S_LOWERTHAN,
        '>'    => self::S_GREATERTHAN,
        '['    => self::S_OPENBRACKET,
        ']'    => self::S_CLOSEBRACKET,
        ':'    => self::S_COLON,
        ';'    => self::S_SEMICOLON,
        '@'    => self::S_AT,
        '\\'   => self::S_BACKSLASH,
        '/'    => self::S_SLASH,
        ','    => self::S_COMMA,
        '.'    => self::S_DOT,
        '"'    => self::S_DQUOTE,
        '-'    => self::S_HYPHEN,
        '::'   => self::S_DOUBLECOLON,
        ' '    => self::S_SP,
        "\t"   => self::S_HTAB,
        "\r"   => self::S_CR,
        "\n"   => self::S_LF,
        "\r\n" => self::CRLF,
        'IPv6' => self::S_IPV6TAG,
        '<'    => self::S_LOWERTHAN,
        '>'    => self::S_GREATERTHAN,
        '{'    => self::S_OPENQBRACKET,
        '}'    => self::S_CLOSEQBRACKET,
        ''     => self::S_EMPTY,
        '\0'   => self::C_NUL,
    );

    protected $hasInvalidTokens = false;

    protected $previous;

    public function reset()
    {
        $this->hasInvalidTokens = false;
        parent::reset();
    }

    public function hasInvalidTokens()
    {
        return $this->hasInvalidTokens;
    }

    /**
     * @param $type
     * @throws \UnexpectedValueException
     * @return boolean
     */
    public function find($type)
    {
        $search = clone $this;
        $search->skipUntil($type);

        if (!$search->lookahead) {
            throw new \UnexpectedValueException($type . ' not found');
        }
        return true;
    }

    /**
     * getPrevious
     *
     * @return array token
     */
    public function getPrevious()
    {
        return $this->previous;
    }

    /**
     * moveNext
     *
     * @return boolean
     */
    public function moveNext()
    {
        $this->previous = $this->token;

        return parent::moveNext();
    }

    /**
     * Lexical catchable patterns.
     *
     * @return string[]
     */
    protected function getCatchablePatterns()
    {
        return array(
            '[a-zA-Z_]+[46]?', //ASCII and domain literal
            '[^\x00-\x7F]',  //UTF-8
            '[0-9]+',
            '\r\n',
            '::',
            '\s+?',
            '.',
            );
    }

    /**
     * Lexical non-catchable patterns.
     *
     * @return string[]
     */
    protected function getNonCatchablePatterns()
    {
        return array('[\xA0-\xff]+');
    }

    /**
     * Retrieve token type. Also processes the token value if necessary.
     *
     * @param string $value
     * @throws \InvalidArgumentException
     * @return integer
     */
    protected function getType(&$value)
    {
        if ($this->isNullType($value)) {
            return self::C_NUL;
        }

        if ($this->isValid($value)) {
            return $this->charValue[$value];
        }

        if ($this->isUTF8Invalid($value)) {
            $this->hasInvalidTokens = true;
            return self::INVALID;
        }

        return  self::GENERIC;
    }

    protected function isValid($value)
    {
        if (isset($this->charValue[$value])) {
            return true;
        }

        return false;
    }

    /**
     * @param $value
     * @return bool
     */
    protected function isNullType($value)
    {
        if ($value === "\0") {
            return true;
        }

        return false;
    }

    /**
     * @param $value
     * @return bool
     */
    protected function isUTF8Invalid($value)
    {
        if (preg_match('/\p{Cc}+/u', $value)) {
            return true;
        }

        return false;
    }

    protected function getModifiers()
    {
        return 'iu';
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <?php

namespace Mockery\Generator;

class MockConfigurationBuilder
{
    protected $name;
    protected $blackListedMethods = array(
        '__call',
        '__callStatic',
        '__clone',
        '__wakeup',
        '__set',
        '__get',
        '__toString',
        '__isset',
        '__destruct',
        '__debugInfo',

        // below are reserved words in PHP
        "__halt_compiler", "abstract", "and", "array", "as",
        "break", "callable", "case", "catch", "class",
        "clone", "const", "continue", "declare", "default",
        "die", "do", "echo", "else", "elseif",
        "empty", "enddeclare", "endfor", "endforeach", "endif",
        "endswitch", "endwhile", "eval", "exit", "extends",
        "final", "for", "foreach", "function", "global",
        "goto", "if", "implements", "include", "include_once",
        "instanceof", "insteadof", "interface", "isset", "list",
        "namespace", "new", "or", "print", "private",
        "protected", "public", "require", "require_once", "return",
        "static", "switch", "throw", "trait", "try",
        "unset", "use", "var", "while", "xor"
    );
    protected $whiteListedMethods = array();
    protected $instanceMock = false;
    protected $parameterOverrides = array();

    protected $targets = array();

    public function addTarget($target)
    {
        $this->targets[] = $target;

        return $this;
    }

    public function addTargets($targets)
    {
        foreach ($targets as $target) {
            $this->addTarget($target);
        }

        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function addBlackListedMethod($blackListedMethod)
    {
        $this->blackListedMethods[] = $blackListedMethod;
        return $this;
    }

    public function addBlackListedMethods(array $blackListedMethods)
    {
        foreach ($blackListedMethods as $method) {
            $this->addBlackListedMethod($method);
        }
        return $this;
    }

    public function setBlackListedMethods(array $blackListedMethods)
    {
        $this->blackListedMethods = $blackListedMethods;
        return $this;
    }

    public function addWhiteListedMethod($whiteListedMethod)
    {
        $this->whiteListedMethods[] = $whiteListedMethod;
        return $this;
    }

    public function addWhiteListedMethods(array $whiteListedMethods)
    {
        foreach ($whiteListedMethods as $method) {
            $this->addWhiteListedMethod($method);
        }
        return $this;
    }

    public function setWhiteListedMethods(array $whiteListedMethods)
    {
        $this->whiteListedMethods = $whiteListedMethods;
        return $this;
    }

    public function setInstanceMock($instanceMock)
    {
        $this->instanceMock = (bool) $instanceMock;
    }

    public function setParameterOverrides(array $overrides)
    {
        $this->parameterOverrides = $overrides;
    }

    public function getMockConfiguration()
    {
        return new MockConfiguration(
            $this->targets,
            $this->blackListedMethods,
            $this->whiteListedMethods,
            $this->name,
            $this->instanceMock,
            $this->parameterOverrides
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php
/**
 * @package php-font-lib
 * @link    https://github.com/PhenX/php-font-lib
 * @author  Fabien M√©nager <fabien.menager@gmail.com>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

namespace FontLib\WOFF;

use FontLib\Table\DirectoryEntry;

/**
 * WOFF font file table directory entry.
 *
 * @package php-font-lib
 */
class TableDirectoryEntry extends DirectoryEntry {
  public $origLength;

  function __construct(File $font) {
    parent::__construct($font);
  }

  function parse() {
    parent::parse();

    $font             = $this->font;
    $this->offset     = $font->readUInt32();
    $this->length     = $font->readUInt32();
    $this->origLength = $font->readUInt32();
    $this->checksum   = $font->readUInt32();
  }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <?php

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2017 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\Command;

use Psy\Input\FilterOptions;
use Psy\Output\ShellOutput;
use Symfony\Component\Console\Formatter\OutputFormatter;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Show the current stack trace.
 */
class TraceCommand extends Command
{
    protected $filter;

    /**
     * {@inheritdoc}
     */
    public function __construct($name = null)
    {
        $this->filter = new FilterOptions();

        parent::__construct($name);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        list($grep, $insensitive, $invert) = FilterOptions::getOptions();

        $this
            ->setName('trace')
            ->setDefinition(array(
                new InputOption('include-psy', 'p', InputOption::VALUE_NONE,     'Include Psy in the call stack.'),
                new InputOption('num',         'n', InputOption::VALUE_REQUIRED, 'Only include NUM lines.'),

                $grep,
                $insensitive,
                $invert,
            ))
            ->setDescription('Show the current call stack.')
            ->setHelp(
                <<<'HELP'
Show the current call stack.

Optionally, include PsySH in the call stack by passing the <info>--include-psy</info> option.

e.g.
<return>> trace -n10</return>
<return>> trace --include-psy</return>
HELP
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->filter->bind($input);
        $trace = $this->getBacktrace(new \Exception(), $input->getOption('num'), $input->getOption('include-psy'));
        $output->page($trace, ShellOutput::NUMBER_LINES);
    }

    /**
     * Get a backtrace for an exception.
     *
     * Optionally limit the number of rows to include with $count, and exclude
     * Psy from the trace.
     *
     * @param \Exception $e          The exception with a backtrace
     * @param int        $count      (default: PHP_INT_MAX)
     * @param bool       $includePsy (default: true)
     *
     * @return array Formatted stacktrace lines
     */
    protected function getBacktrace(\Exception $e, $count = null, $includePsy = true)
    {
        if ($cwd = getcwd()) {
            $cwd = rtrim($cwd, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        }

        if ($count === null) {
            $count = PHP_INT_MAX;
        }

        $lines = array();

        $trace = $e->getTrace();
        array_unshift($trace, array(
            'function' => '',
            'file'     => $e->getFile() !== null ? $e->getFile() : 'n/a',
            'line'     => $e->getLine() !== null ? $e->getLine() : 'n/a',
            'args'     => array(),
        ));

        if (!$includePsy) {
            for ($i = count($trace) - 1; $i >= 0; $i--) {
                $thing = isset($trace[$i]['class']) ? $trace[$i]['class'] : $trace[$i]['function'];
                if (preg_match('/\\\\?Psy\\\\/', $thing)) {
                    $trace = array_slice($trace, $i + 1);
                    break;
                }
            }
        }

        for ($i = 0, $count = min($count, count($trace)); $i < $count; $i++) {
            $class    = isset($trace[$i]['class']) ? $trace[$i]['class'] : '';
            $type     = isset($trace[$i]['type']) ? $trace[$i]['type'] : '';
            $function = $trace[$i]['function'];
            $file     = isset($trace[$i]['file']) ? $this->replaceCwd($cwd, $trace[$i]['file']) : 'n/a';
            $line     = isset($trace[$i]['line']) ? $trace[$i]['line'] : 'n/a';

            // Leave execution loop out of the `eval()'d code` lines
            if (preg_match("#/Psy/ExecutionLoop/Loop.php\(\d+\) : eval\(\)'d code$#", $file)) {
                $file = "eval()'d code";
            }

            // Skip any lines that don't match our filter options
            if (!$this->filter->match(sprintf('%s%s%s() at %s:%s', $class, $type, $function, $file, $line))) {
                continue;
            }

            $lines[] = sprintf(
                ' <class>%s</class>%s%s() at <info>%s:%s</info>',
                OutputFormatter::escape($class),
                OutputFormatter::escape($type),
                OutputFormatter::escape($function),
                OutputFormatter::escape($file),
                OutputFormatter::escape($line)
            );
        }

        return $lines;
    }

    /**
     * Replace the given directory from the start of a filepath.
     *
     * @param string $cwd
     * @param string $file
     *
     * @return string
     */
    private function replaceCwd($cwd, $file)
    {
        if ($cwd === false) {
            return $file;
        } else {
            return preg_replace('/^' . preg_quote($cwd, '/') . '/', '', $file);
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          Copyright (c) 2017-2018 Fabien Potencier

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is furnished
to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       INDX( 	                 (   8  Ë       b ‘                  1    à x     0    —‰ób‘Äù$«∑”∑6‰ób‘»‰ób‘»      ƒ               E n t i t y N o t F o u n d E x c e p t i o n . p h p 2    x f     0    …B‰ób‘Äù$«∑”∆Y‰ób‘∆B‰ób‘                     E n t i t y R e s o l v e r . p h p   3    h X     0    id‰ób‘Äù$«∑”⁄y‰ób‘hd‰ób‘                     F a c t o r y . p h p 4    ` P     0    ?Ñ‰ób‘Äù$«∑”ö‰ób‘>Ñ‰ób‘       5	               J o  . p h p 5    h X     0    F§‰ób‘Äù$«∑”æ∫‰ób‘F§‰ób‘       †               M o n i t o r . p h p 6    h T     0    [≈‰ób‘Äù$«∑”]⁄‰ób‘R≈‰ób‘       ˆ              	 Q u e u e . p h p     7    Ä p     0    œ‰‰ób‘Äù$«∑”g˚‰ób‘Œ‰‰ób‘       ì               Q u e u e a b l e C o l l e c t i o n . p h p 8    x h     0    ΩÂób‘Äù$«∑”ÚÂób‘∂Âób‘Ë      ·               Q u e u e a b l e E n t i t y . p h p 9    p `     0    K%Âób‘Äù$«∑”:Âób B%Âób‘P       O                S h o u l d Q u e u e . p h p                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php

namespace Illuminate\View;

use InvalidArgumentException;
use Illuminate\Filesystem\Filesystem;

class FileViewFinder implements ViewFinderInterface
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The array of active view paths.
     *
     * @var array
     */
    protected $paths;

    /**
     * The array of views that have been located.
     *
     * @var array
     */
    protected $views = [];

    /**
     * The namespace to file path hints.
     *
     * @var array
     */
    protected $hints = [];

    /**
     * Register a view extension with the finder.
     *
     * @var array
     */
    protected $extensions = ['blade.php', 'php', 'css'];

    /**
     * Create a new file view loader instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  array  $paths
     * @param  array  $extensions
     * @return void
     */
    public function __construct(Filesystem $files, array $paths, array $extensions = null)
    {
        $this->files = $files;
        $this->paths = $paths;

        if (isset($extensions)) {
            $this->extensions = $extensions;
        }
    }

    /**
     * Get the fully qualified location of the view.
     *
     * @param  string  $name
     * @return string
     */
    public function find($name)
    {
        if (isset($this->views[$name])) {
            return $this->views[$name];
        }

        if ($this->hasHintInformation($name = trim($name))) {
            return $this->views[$name] = $this->findNamespacedView($name);
        }

        return $this->views[$name] = $this->findInPaths($name, $this->paths);
    }

    /**
     * Get the path to a template with a named path.
     *
     * @param  string  $name
     * @return string
     */
    protected function findNamespacedView($name)
    {
        list($namespace, $view) = $this->parseNamespaceSegments($name);

        return $this->findInPaths($view, $this->hints[$namespace]);
    }

    /**
     * Get the segments of a template with a named path.
     *
     * @param  string  $name
     * @return array
     *
     * @throws \InvalidArgumentException
     */
    protected function parseNamespaceSegments($name)
    {
        $segments = explode(static::HINT_PATH_DELIMITER, $name);

        if (count($segments) != 2) {
            throw new InvalidArgumentException("View [{$name}] has an invalid name.");
        }

        if (! isset($this->hints[$segments[0]])) {
            throw new InvalidArgumentException("No hint path defined for [{$segments[0]}].");
        }

        return $segments;
    }

    /**
     * Find the given view in the list of paths.
     *
     * @param  string  $name
     * @param  array   $paths
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function findInPaths($name, $paths)
    {
        foreach ((array) $paths as $path) {
            foreach ($this->getPossibleViewFiles($name) as $file) {
                if ($this->files->exists($viewPath = $path.'/'.$file)) {
                    return $viewPath;
                }
            }
        }

        throw new InvalidArgumentException("View [{$name}] not found.");
    }

    /**
     * Get an array of possible view files.
     *
     * @param  string  $name
     * @return array
     */
    protected function getPossibleViewFiles($name)
    {
        return array_map(function ($extension) use ($name) {
            return str_replace('.', '/', $name).'.'.$extension;
        }, $this->extensions);
    }

    /**
     * Add a location to the finder.
     *
     * @param  string  $location
     * @return void
     */
    public function addLocation($location)
    {
        $this->paths[] = $location;
    }

    /**
     * Prepend a location to the finder.
     *
     * @param  string  $location
     * @return void
     */
    public function prependLocation($location)
    {
        array_unshift($this->paths, $location);
    }

    /**
     * Add a namespace hint to the finder.
     *
     * @param  string  $namespace
     * @param  string|array  $hints
     * @return void
     */
    public function addNamespace($namespace, $hints)
    {
        $hints = (array) $hints;

        if (isset($this->hints[$namespace])) {
            $hints = array_merge($this->hints[$namespace], $hints);
        }

        $this->hints[$namespace] = $hints;
    }

    /**
     * Prepend a namespace hint to the finder.
     *
     * @param  string  $namespace
     * @param  string|array  $hints
     * @return void
     */
    public function prependNamespace($namespace, $hints)
    {
        $hints = (array) $hints;

        if (isset($this->hints[$namespace])) {
            $hints = array_merge($hints, $this->hints[$namespace]);
        }

        $this->hints[$namespace] = $hints;
    }

    /**
     * Replace the namespace hints for the given namespace.
     *
     * @param  string  $namespace
     * @param  string|array  $hints
     * @return void
     */
    public function replaceNamespace($namespace, $hints)
    {
        $this->hints[$namespace] = (array) $hints;
    }

    /**
     * Register an extension with the view finder.
     *
     * @param  string  $extension
     * @return void
     */
    public function addExtension($extension)
    {
        if (($index = array_search($extension, $this->extensions)) !== false) {
            unset($this->extensions[$index]);
        }

        array_unshift($this->extensions, $extension);
    }

    /**
     * Returns whether or not the view name has any hint information.
     *
     * @param  string  $name
     * @return bool
     */
    public function hasHintInformation($name)
    {
        return strpos($name, static::HINT_PATH_DELIMITER) > 0;
    }

    /**
     * Flush the cache of located views.
     *
     * @return void
     */
    public function flush()
    {
        $this->views = [];
    }

    /**
     * Get the filesystem instance.
     *
     * @return \Illuminate\Filesystem\Filesystem
     */
    public function getFilesystem()
    {
        return $this->files;
    }

    /**
     * Get the active view paths.
     *
     * @return array
     */
    public function getPaths()
    {
        return $this->paths;
    }

    /**
     * Get the namespace to file path hints.
     *
     * @return array
     */
    public function getHints()
    {
        return $this->hints;
    }

    /**
     * Get registered extensions.
     *
     * @return array
     */
    public function getExtensions()
    {
        return $this->extensions;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php
/**
 * Mockery
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://github.com/padraic/mockery/blob/master/LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to padraic@php.net so we can send you a copy immediately.
 *
 * @category   Mockery
 * @package    Mockery
 * @copyright  Copyright (c) 2010 P√°draic Brady (http://blog.astrumfutura.com)
 * @license    http://github.com/padraic/mockery/blob/master/LICENSE New BSD License
 */

namespace Mockery\Generator;

/**
 * This class describes the configuration of mocks and hides away some of the
 * reflection implementation
 */
class MockConfiguration
{
    protected static $mockCounter = 0;

    /**
     * A class that we'd like to mock
     */
    protected $targetClass;
    protected $targetClassName;

    /**
     * A number of interfaces we'd like to mock, keyed by name to attempt to
     * keep unique
     */
    protected $targetInterfaces = array();
    protected $targetInterfaceNames = array();

    /**
     * A number of traits we'd like to mock, keyed by name to attempt to
     * keep unique
     */
    protected $targetTraits = array();
    protected $targetTraitNames = array();

    /**
     * An object we'd like our mock to proxy to
     */
    protected $targetObject;

    /**
     * The class name we'd like to use for a generated mock
     */
    protected $name;

    /**
     * Methods that should specifically not be mocked
     *
     * This is currently populated with stuff we don't know how to deal with,
     * should really be somewhere else
     */
    protected $blackListedMethods = array();

    /**
     * If not empty, only these methods will be mocked
     */
    protected $whiteListedMethods = array();

    /**
     * An instance mock is where we override the original class before it's
     * autoloaded
     */
    protected $instanceMock = false;

    /**
     * Param overrides
     */
    protected $parameterOverrides = array();

    /**
     * Instance cache of all methods
     */
    protected $allMethods;

    /**
     * If true, overrides original class destructor
     */
    protected $mockOriginalDestructor = false;

    public function __construct(
        array $targets = array(),
        array $blackListedMethods = array(),
        array $whiteListedMethods = array(),
        $name = null,
        $instanceMock = false,
        array $parameterOverrides = array(),
        $mockOriginalDestructor = false
    ) {
        $this->addTargets($targets);
        $this->blackListedMethods = $blackListedMethods;
        $this->whiteListedMethods = $whiteListedMethods;
        $this->name = $name;
        $this->instanceMock = $instanceMock;
        $this->parameterOverrides = $parameterOverrides;
        $this->mockOriginalDestructor = $mockOriginalDestructor;
    }

    /**
     * Attempt to create a hash of the configuration, in order to allow caching
     *
     * @TODO workout if this will work
     *
     * @return string
     */
    public function getHash()
    {
        $vars = array(
            'targetClassName'        => $this->targetClassName,
            'targetInterfaceNames'   => $this->targetInterfaceNames,
            'targetTraitNames'       => $this->targetTraitNames,
            'name'                   => $this->name,
            'blackListedMethods'     => $this->blackListedMethods,
            'whiteListedMethod'      => $this->whiteListedMethods,
            'instanceMock'           => $this->instanceMock,
            'parameterOverrides'     => $this->parameterOverrides,
            'mockOriginalDestructor' => $this->mockOriginalDestructor
        );

        return md5(serialize($vars));
    }

    /**
     * Gets a list of methods from the classes, interfaces and objects and
     * filters them appropriately. Lot's of filtering going on, perhaps we could
     * have filter classes to iterate through
     */
    public function getMethodsToMock()
    {
        $methods = $this->getAllMethods();

        foreach ($methods as $key => $method) {
            if ($method->isFinal()) {
                unset($methods[$key]);
            }
        }

        /**
         * Whitelist trumps everything else
         */
        if (count($this->getWhiteListedMethods())) {
            $whitelist = array_map('strtolower', $this->getWhiteListedMethods());
            $methods = array_filter($methods, function ($method) use ($whitelist) {
                return $method->isAbstract() || in_array(strtolower($method->getName()), $whitelist);
            });

            return $methods;
        }

        /**
         * Remove blacklisted methods
         */
        if (count($this->getBlackListedMethods())) {
            $blacklist = array_map('strtolower', $this->getBlackListedMethods());
            $methods = array_filter($methods, function ($method) use ($blacklist) {
                return !in_array(strtolower($method->getName()), $blacklist);
            });
        }

        /**
         * Internal objects can not be instantiated with newInstanceArgs and if
         * they implement Serializable, unserialize will have to be called. As
         * such, we can't mock it and will need a pass to add a dummy
         * implementation
         */
        if ($this->getTargetClass()
            && $this->getTargetClass()->implementsInterface("Serializable")
            && $this->getTargetClass()->hasInternalAncestor()) {
            $methods = array_filter($methods, function ($method) {
                return $method->getName() !== "unserialize";
            });
        }

        return array_values($methods);
    }

    /**
     * We declare the __call method to handle undefined stuff, if the class
     * we're mocking has also defined it, we need to comply with their interface
     */
    public function requiresCallTypeHintRemoval()
    {
        foreach ($this->getAllMethods() as $method) {
            if ("__call" === $method->getName()) {
                $params = $method->getParameters();
                return !$params[1]->isArray();
            }
        }

        return false;
    }

    /**
     * We declare the __callStatic method to handle undefined stuff, if the class
     * we're mocking has also defined it, we need to comply with their interface
     */
    public function requiresCallStaticTypeHintRemoval()
    {
        foreach ($this->getAllMethods() as $method) {
            if ("__callStatic" === $method->getName()) {
                $params = $method->getParameters();
                return !$params[1]->isArray();
            }
        }

        return false;
    }

    public function rename($className)
    {
        $targets = array();

        if ($this->targetClassName) {
            $targets[] = $this->targetClassName;
        }

        if ($this->targetInterfaceNames) {
            $targets = array_merge($targets, $this->targetInterfaceNames);
        }

        if ($this->targetTraitNames) {
            $targets = array_merge($targets, $this->targetTraitNames);
        }

        if ($this->targetObject) {
            $targets[] = $this->targetObject;
        }

        return new self(
            $targets,
            $this->blackListedMethods,
            $this->whiteListedMethods,
            $className,
            $this->instanceMock,
            $this->parameterOverrides,
            $this->mockOriginalDestructor
        );
    }

    protected function addTarget($target)
    {
        if (is_object($target)) {
            $this->setTargetObject($target);
            $this->setTargetClassName(get_class($target));
            return $this;
        }

        if ($target[0] !== "\\") {
            $target = "\\" . $target;
        }

        if (class_exists($target)) {
            $this->setTargetClassName($target);
            return $this;
        }

        if (interface_exists($target)) {
            $this->addTargetInterfaceName($target);
            return $this;
        }

        if (trait_exists($target)) {
            $this->addTargetTraitName($target);
            return $this;
        }

        /**
         * Default is to set as class, or interface if class already set
         *
         * Don't like this condition, can't remember what the default
         * targetClass is for
         */
        if ($this->getTargetClassName()) {
            $this->addTargetInterfaceName($target);
            return $this;
        }

        $this->setTargetClassName($target);
    }

    protected function addTargets($interfaces)
    {
        foreach ($interfaces as $interface) {
            $this->addTarget($interface);
        }
    }

    public function getTargetClassName()
    {
        return $this->targetClassName;
    }

    public function getTargetClass()
    {
        if ($this->targetClass) {
            return $this->targetClass;
        }

        if (!$this->targetClassName) {
            return null;
        }

        if (class_exists($this->targetClassName)) {
            $dtc = DefinedTargetClass::factory($this->targetClassName);

            if ($this->getTargetObject() == false && $dtc->isFinal()) {
                throw new \Mockery\Exception(
                    'The class ' . $this->targetClassName . ' is marked final and its methods'
                    . ' cannot be replaced. Classes marked final can be passed in'
                    . ' to \Mockery::mock() as instantiated objects to create a'
                    . ' partial mock, but only if the mock is not subject to type'
                    . ' hinting checks.'
                );
            }

            $this->targetClass = $dtc;
        } else {
            $this->targetClass = UndefinedTargetClass::factory($this->targetClassName);
        }

        return $this->targetClass;
    }

    public function getTargetTraits()
    {
        if (!empty($this->targetTraits)) {
            return $this->targetTraits;
        }

        foreach ($this->targetTraitNames as $targetTrait) {
            $this->targetTraits[] = DefinedTargetClass::factory($targetTrait);
        }

        $this->targetTraits = array_unique($this->targetTraits); // just in case
        return $this->targetTraits;
    }

    public function getTargetInterfaces()
    {
        if (!empty($this->targetInterfaces)) {
            return $this->targetInterfaces;
        }

        foreach ($this->targetInterfaceNames as $targetInterface) {
            if (!interface_exists($targetInterface)) {
                $this->targetInterfaces[] = UndefinedTargetClass::factory($targetInterface);
                return;
            }

            $dtc = DefinedTargetClass::factory($targetInterface);
            $extendedInterfaces = array_keys($dtc->getInterfaces());
            $extendedInterfaces[] = $targetInterface;

            $traversableFound = false;
            $iteratorShiftedToFront = false;
            foreach ($extendedInterfaces as $interface) {
                if (!$traversableFound && preg_match("/^\\?Iterator(|Aggregate)$/i", $interface)) {
                    break;
                }

                if (preg_match("/^\\\\?IteratorAggregate$/i", $interface)) {
                    $this->targetInterfaces[] = DefinedTargetClass::factory("\\IteratorAggregate");
                    $iteratorShiftedToFront = true;
                } elseif (preg_match("/^\\\\?Iterator$/i", $interface)) {
                    $this->targetInterfaces[] = DefinedTargetClass::factory("\\Iterator");
                    $iteratorShiftedToFront = true;
                } elseif (preg_match("/^\\\\?Traversable$/i", $interface)) {
                    $traversableFound = true;
                }
            }

            if ($traversableFound && !$iteratorShiftedToFront) {
                $this->targetInterfaces[] = DefinedTargetClass::factory("\\IteratorAggregate");
            }

            /**
             * We never straight up implement Traversable
             */
            if (!preg_match("/^\\\\?Traversable$/i", $targetInterface)) {
                $this->targetInterfaces[] = $dtc;
            }
        }
        $this->targetInterfaces = array_unique($this->targetInterfaces); // just in case
        return $this->targetInterfaces;
    }

    public function getTargetObject()
    {
        return $this->targetObject;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * Generate a suitable name based on the config
     */
    public function generateName()
    {
        $name = 'Mockery_' . static::$mockCounter++;

        if ($this->getTargetObject()) {
            $name .= "_" . str_replace("\\", "_", get_class($this->getTargetObject()));
        }

        if ($this->getTargetClass()) {
            $name .= "_" . str_replace("\\", "_", $this->getTargetClass()->getName());
        }

        if ($this->getTargetInterfaces()) {
            $name .= array_reduce($this->getTargetInterfaces(), function ($tmpname, $i) {
                $tmpname .= '_' . str_replace("\\", "_", $i->getName());
                return $tmpname;
            }, '');
        }

        return $name;
    }

    public function getShortName()
    {
        $parts = explode("\\", $this->getName());
        return array_pop($parts);
    }

    public function getNamespaceName()
    {
        $parts = explode("\\", $this->getName());
        array_pop($parts);

        if (count($parts)) {
            return implode("\\", $parts);
        }

        return "";
    }

    public function getBlackListedMethods()
    {
        return $this->blackListedMethods;
    }

    public function getWhiteListedMethods()
    {
        return $this->whiteListedMethods;
    }

    public function isInstanceMock()
    {
        return $this->instanceMock;
    }

    public function getParameterOverrides()
    {
        return $this->parameterOverrides;
    }

    public function isMockOriginalDestructor()
    {
        return $this->mockOriginalDestructor;
    }

    protected function setTargetClassName($targetClassName)
    {
        $this->targetClassName = $targetClassName;
    }

    protected function getAllMethods()
    {
        if ($this->allMethods) {
            return $this->allMethods;
        }

        $classes = $this->getTargetInterfaces();

        if ($this->getTargetClass()) {
            $classes[] = $this->getTargetClass();
        }

        $methods = array();
        foreach ($classes as $class) {
            $methods = array_merge($methods, $class->getMethods());
        }

        foreach ($this->getTargetTraits() as $trait) {
            foreach ($trait->getMethods() as $method) {
                if ($method->isAbstract()) {
                    $methods[] = $method;
                }
            }
        }

        $names = array();
        $methods = array_filter($methods, function ($method) use (&$names) {
            if (in_array($method->getName(), $names)) {
                return false;
            }

            $names[] = $method->getName();
            return true;
        });

        return $this->allMethods = $methods;
    }

    /**
     * If we attempt to implement Traversable, we must ensure we are also
     * implementing either Iterator or IteratorAggregate, and that whichever one
     * it is comes before Traversable in the list of implements.
     */
    protected function addTargetInterfaceName($targetInterface)
    {
        $this->targetInterfaceNames[] = $targetInterface;
    }

    protected function addTargetTraitName($targetTraitName)
    {
        $this->targetTraitNames[] = $targetTraitName;
    }

    protected function setTargetObject($object)
    {
        $this->targetObject = $object;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2017 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\Exception;

/**
 * A throw-up exception, used for throwing an exception out of the Psy Shell.
 */
class ThrowUpException extends \Exception implements Exception
{
    /**
     * {@inheritdoc}
     */
    public function __construct(\Exception $exception)
    {
        $message = sprintf("Throwing %s with message '%s'", get_class($exception), $exception->getMessage());
        parent::__construct($message, $exception->getCode(), $exception);
    }

    /**
     * Return a raw (unformatted) version of the error message.
     *
     * @return string
     */
    public function getRawMessage()
    {
        return $this->getPrevious()->getMessage();
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php


class Product {
    protected $link;
    
    public function __construct() {
        $this->link = mysqli_connect('localhost', 'root', '', 'student_info');
    }
    
    private function queryExecution($sql, $status=NULL){
         if (mysqli_query($this->link, $sql)) {
             if($status){
                 $queryResult = mysqli_query($this->link, $sql);
                 return $queryResult;
             }else{                
                $messeage = 'Blog Info Save Successfully';
                return $messeage;
             }
    }
 }
    
    
    public function saveProductInfo($data){
        $sql = "INSERT INTO products (product_name, product_price, product_quantity, product_description, publication_status) VALUES ('$data[product_name]', '$data[product_price]', '$data[product_quantity]', '$data[product_description]', '$data[publication_status]')";
        $msg = $this->queryExecution($sql);
        return $msg;
    }
    
    public function getAllProductInfo() {
        $sql = "SELECT * FROM products ORDER BY id DESC";
        $status= 'select';
        $queryResult = $this->queryExecution($sql, $status);
        return $queryResult;     
    }
    
    public function getProductInfoById($blogid){
        $sql = "SELECT * FROM products WHERE id = '$blogid'";
        
        $status= 'BITM';
        $queryResult = $this->queryExecution($sql, $status);
        return $queryResult;
       
    }
    
    public function updateProductInfo($data, $blogid){
        $sql = "UPDATE products SET product_name = '$data[product_name]', product_price = '$data[product_price]', product_quantity = '$data[product_quantity]', product_description = '$data[product_description]', publication_status = '$data[publication_status]' WHERE id = '$blogid'";
        
        mysqli_query($this->link, $sql);
           header('Location: view-product.php');
    }
    
    public function deleteProductInfo($id){
        $sql = "DELETE FROM products WHERE id='$id'";
        
        mysqli_query($this->link, $sql);
           header('Location: view-product.php');
    }
    
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation;

/**
 * Request stack that controls the lifecycle of requests.
 *
 * @author Benjamin Eberlei <kontakt@beberlei.de>
 */
class RequestStack
{
    /**
     * @var Request[]
     */
    private $requests = array();

    /**
     * Pushes a Request on the stack.
     *
     * This method should generally not be called directly as the stack
     * management should be taken care of by the application itself.
     */
    public function push(Request $request)
    {
        $this->requests[] = $request;
    }

    /**
     * Pops the current request from the stack.
     *
     * This operation lets the current request go out of scope.
     *
     * This method should generally not be called directly as the stack
     * management should be taken care of by the application itself.
     *
     * @return Request|null
     */
    public function pop()
    {
        if (!$this->requests) {
            return;
        }

        return array_pop($this->requests);
    }

    /**
     * @return Request|null
     */
    public function getCurrentRequest()
    {
        return end($this->requests) ?: null;
    }

    /**
     * Gets the master Request.
     *
     * Be warned that making your code aware of the master request
     * might make it un-compatible with other features of your framework
     * like ESI support.
     *
     * @return Request|null
     */
    public function getMasterRequest()
    {
        if (!$this->requests) {
            return;
        }

        return $this->requests[0];
    }

    /**
     * Returns the parent request of the current.
     *
     * Be warned that making your code aware of the parent request
     * might make it un-compatible with other features of your framework
     * like ESI support.
     *
     * If current Request is the master request, it returns null.
     *
     * @return Request|null
     */
    public function getParentRequest()
    {
        $pos = count($this->requests) - 2;

        if (!isset($this->requests[$pos])) {
            return;
        }

        return $this->requests[$pos];
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <?php

namespace Egulias\EmailValidator;

use Doctrine\Common\Lexer\AbstractLexer;

class EmailLexer extends AbstractLexer
{
    //ASCII values
    const C_DEL              = 127;
    const C_NUL              = 0;
    const S_AT               = 64;
    const S_BACKSLASH        = 92;
    const S_DOT              = 46;
    const S_DQUOTE           = 34;
    const S_OPENPARENTHESIS  = 49;
    const S_CLOSEPARENTHESIS = 261;
    const S_OPENBRACKET      = 262;
    const S_CLOSEBRACKET     = 263;
    const S_HYPHEN           = 264;
    const S_COLON            = 265;
    const S_DOUBLECOLON      = 266;
    const S_SP               = 267;
    const S_HTAB             = 268;
    const S_CR               = 269;
    const S_LF               = 270;
    const S_IPV6TAG          = 271;
    const S_LOWERTHAN        = 272;
    const S_GREATERTHAN      = 273;
    const S_COMMA            = 274;
    const S_SEMICOLON        = 275;
    const S_OPENQBRACKET     = 276;
    const S_CLOSEQBRACKET    = 277;
    const S_SLASH            = 278;
    const S_EMPTY            = null;
    const GENERIC            = 300;
    const CRLF               = 301;
    const INVALID            = 302;
    const ASCII_INVALID_FROM = 127;
    const ASCII_INVALID_TO   = 199;

    /**
     * US-ASCII visible characters not valid for atext (@link http://tools.ietf.org/html/rfc5322#section-3.2.3)
     *
     * @var array
     */
    protected $charValue = array(
        '('    => self::S_OPENPARENTHESIS,
        ')'    => self::S_CLOSEPARENTHESIS,
        '<'    => self::S_LOWERTHAN,
        '>'    => self::S_GREATERTHAN,
        '['    => self::S_OPENBRACKET,
        ']'    => self::S_CLOSEBRACKET,
        ':'    => self::S_COLON,
        ';'    => self::S_SEMICOLON,
        '@'    => self::S_AT,
        '\\'   => self::S_BACKSLASH,
        '/'    => self::S_SLASH,
        ','    => self::S_COMMA,
        '.'    => self::S_DOT,
        '"'    => self::S_DQUOTE,
        '-'    => self::S_HYPHEN,
        '::'   => self::S_DOUBLECOLON,
        ' '    => self::S_SP,
        "\t"   => self::S_HTAB,
        "\r"   => self::S_CR,
        "\n"   => self::S_LF,
        "\r\n" => self::CRLF,
        'IPv6' => self::S_IPV6TAG,
        '{'    => self::S_OPENQBRACKET,
        '}'    => self::S_CLOSEQBRACKET,
        ''     => self::S_EMPTY,
        '\0'   => self::C_NUL,
    );

    protected $hasInvalidTokens = false;

    protected $previous;

    public function reset()
    {
        $this->hasInvalidTokens = false;
        parent::reset();
    }

    public function hasInvalidTokens()
    {
        return $this->hasInvalidTokens;
    }

    /**
     * @param $type
     * @throws \UnexpectedValueException
     * @return boolean
     */
    public function find($type)
    {
        $search = clone $this;
        $search->skipUntil($type);

        if (!$search->lookahead) {
            throw new \UnexpectedValueException($type . ' not found');
        }
        return true;
    }

    /**
     * getPrevious
     *
     * @return array token
     */
    public function getPrevious()
    {
        return $this->previous;
    }

    /**
     * moveNext
     *
     * @return boolean
     */
    public function moveNext()
    {
        $this->previous = $this->token;

        return parent::moveNext();
    }

    /**
     * Lexical catchable patterns.
     *
     * @return string[]
     */
    protected function getCatchablePatterns()
    {
        return array(
            '[a-zA-Z_]+[46]?', //ASCII and domain literal
            '[^\x00-\x7F]',  //UTF-8
            '[0-9]+',
            '\r\n',
            '::',
            '\s+?',
            '.',
            );
    }

    /**
     * Lexical non-catchable patterns.
     *
     * @return string[]
     */
    protected function getNonCatchablePatterns()
    {
        return array('[\xA0-\xff]+');
    }

    /**
     * Retrieve token type. Also processes the token value if necessary.
     *
     * @param string $value
     * @throws \InvalidArgumentException
     * @return integer
     */
    protected function getType(&$value)
    {
        if ($this->isNullType($value)) {
            return self::C_NUL;
        }

        if ($this->isValid($value)) {
            return $this->charValue[$value];
        }

        if ($this->isUTF8Invalid($value)) {
            $this->hasInvalidTokens = true;
            return self::INVALID;
        }

        return  self::GENERIC;
    }

    protected function isValid($value)
    {
        if (isset($this->charValue[$value])) {
            return true;
        }

        return false;
    }

    /**
     * @param $value
     * @return bool
     */
    protected function isNullType($value)
    {
        if ($value === "\0") {
            return true;
        }

        return false;
    }

    /**
     * @param $value
     * @return bool
     */
    protected function isUTF8Invalid($value)
    {
        if (preg_match('/\p{Cc}+/u', $value)) {
            return true;
        }

        return false;
    }

    protected function getModifiers()
    {
        return 'iu';
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
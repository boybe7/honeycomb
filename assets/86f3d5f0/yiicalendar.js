/**
 * yiicalendar.js
 *
 * Part of YiiCalendar extension for Yii 1.x (based on ecalendarview extension).
 *
 * @website   http://www.yiiframework.com/extension/yii-calendar/
 * @website   https://github.com/trejder/yii-calendar
 * @author    Tomasz Trejderowski <tomasz@trejderowski.pl>
 * @author    Martin Ludvik <matolud@gmail.com>
 * @copyright Copyright (c) 2014 by Tomasz Trejderowski & Martin Ludvik
 * @license   http://opensource.org/licenses/MIT (MIT license)
 */

!function($)
{
    $.fn.yiicalendar = function()
    {
        this.on('click', '.navigation-link', function()
        {
            $('table.yiicalendar').css('opacity', 0.1);

            $.ajax
            ({
                'url': $(this).attr('href'),
                'context': $(this).parents('.yiicalendar'),
                'cache': false,
                'success': function(data)
                {
                    var calendarData = $('#' + this.attr('id'), data);

                    this.html(calendarData.html());

                    $('table.yiicalendar').css('opacity', 1);
                }
            });

            return false;
        });
    }
}(window.jQuery);
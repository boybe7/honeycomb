/*!
 * jQuery lightweight plugin progressTracker
 * Original author: @Sanjeev Rai
 */


// the semi-colon before the function invocation is a safety 
// net against concatenated scripts and/or other plugins 
// that are not closed properly.
; (function ($) {

    // undefined is used here as the undefined global 
    // variable in ECMAScript 3 and is mutable (i.e. it can 
    // be changed by someone else). undefined isn't really 
    // being passed in so we can ensure that its value is 
    // truly undefined. In ES5, undefined can no longer be 
    // modified.

    // window and document are passed through as local 
    // variables rather than as globals, because this (slightly) 
    // quickens the resolution process and can be more 
    // efficiently minified (especially when both are 
    // regularly referenced in your plugin).

    // Create the defaults once
    var pluginName = 'progressTracker',
        defaults = {
            parentClassName: "progtrckr",//"ol" class name
            todoClassName: "progtrckr-todo",//highlighted 'li' class name
            completedClassName: "progtrckr-done",//other 'li' class name
            ShowToolTip: true,
            ToolTipPosition: "top",
            data: []
        };

    // The actual plugin constructor
    function plugin(element, optionPrms) {
        var privateVariables = {
            $elem: $(element),
            options: $.extend(true, {}, defaults, optionPrms)
        };

        var privateMethods = {
            buildTrackerHtml: function () {
                var html = '<ol class="' + privateVariables.options.parentClassName + '">';
                for (var i in privateVariables.options.data) {
                    if (privateVariables.options.data.hasOwnProperty(i)) {
                        var obj = privateVariables.options.data[i];
                        var cssClass = obj.highlighted == true ? privateVariables.options.completedClassName : privateVariables.options.todoClassName;
                        var objTitle = obj.ToolTipText && obj.ToolTipText != 0 ? ' title="' + obj.ToolTipText + '"' : "";
                        html += '<li class="' + cssClass + '"' + objTitle + '><span class="statusTitle">' + obj.Text + '</span></li>';
                    }
                }
                html += '</ol>';
                privateVariables.$elem.html(html);
                privateMethods.SetPadding();
            },
            SetPadding: function () {
                var parentWidth = privateVariables.$elem.find('ol').width() - 10;
                var stepsWidth = 0;
                privateVariables.$elem.find('li').each(function () {
                    stepsWidth += $(this).width();
                });
                var totalpaddingSections = (privateVariables.options.data.length * 2) - 2;
                var padding = (parentWidth - stepsWidth) / totalpaddingSections;
                if (padding > 0) {
                    privateVariables.$elem.find('li').css("padding", "0 " + padding + "px");
                    privateVariables.$elem.find('li:last-child').css("padding-right", "0");
                } else {
                    //todo: handle scenario when width of progress tracker is greater than container
                }

                if (privateVariables.options.ShowToolTip) {
                    privateMethods.SetToolTip(padding);
                }
            },
            SetToolTip: function () {
                var className = privateVariables.options.ToolTipPosition;
                var tooltipPosition = { my: 'center bottom', at: 'center top' };//default is at top
                switch (className) {
                    case 'top':
                        tooltipPosition = { my: 'center bottom', at: 'center top' };
                        break;
                    case 'bottom':
                        tooltipPosition = { my: 'center top', at: 'center bottom+15' };
                        break;
                    case 'left':
                        tooltipPosition = { my: 'left center', at: 'left center' };
                        break;
                    case 'right':
                        tooltipPosition = { my: 'right center', at: 'right center' };
                        break;
                }
                tooltipPosition.collision = 'none';
                var allListItems = privateVariables.$elem.find('li');
                allListItems.tooltip();
                allListItems.each(function (i) {
                    var position = JSON.parse(JSON.stringify(tooltipPosition));
                    var newclassName = className;
                    if (i == 0) {
                        position.at = tooltipPosition.at.replace('center ', 'left ');
                        position.my = tooltipPosition.my.replace('center ', 'center ');
                        if (className == 'left') {
                            position = { my: 'right center', at: 'right center' };
                            newclassName = 'right';
                        }
                    }
                    else if (i == allListItems.length - 1) {
                        position.at = tooltipPosition.at.replace('center ', 'right ');
                        position.my = tooltipPosition.my.replace('center ', 'center ');
                        if (className == 'right') {
                            position = { my: 'left center', at: 'left center' };
                            newclassName = 'left';
                        }
                    }
                    $(this).tooltip('option', 'position', position);
                    $(this).tooltip('option', 'tooltipClass', newclassName);
                });
            }
        };
        this.init = function () {
            privateMethods.buildTrackerHtml();
        };
        this.init();
    };

    // A really lightweight plugin wrapper around the constructor, 
    // preventing against multiple instantiations
    $.fn[pluginName] = function (options) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName,
                    new plugin(this, options));
            }
        });
    };

})(jQuery, window, document);

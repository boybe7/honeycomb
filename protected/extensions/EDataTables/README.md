Goal of this widget/wrapper is to provide a drop in replacement for base CGridView widget from the [Yii framework](http://yiiframework.com), using [DataTables](http://datatables.net) plugin.

It's usable, but feedback is needed. Please post issues on [project's page](http://code.google.com/p/edatatables).

##Features

* Redrawing of table contents (after paging/sorting/searching) using AJAX calls.
* Using CGridView columns definition format, supports all basic special columns like Buttons, Checkbox, etc.
* Custom buttons in table header.
* Smoothness theme from JUI by default
* Twitter Bootstrap support through the [bootstrap extension](http://www.yiiframework.com/extension/bootstrap)
* Partial editable cells support.
* Much more, check the docs on the [project's page](http://code.google.com/p/edatatables).

##Requirements

* Yii 1.1.8 or above.
* (optional) [Bootstrap extension](http://www.yiiframework.com/extension/bootstrap)
* (optional) [Select2 extension](http://www.yiiframework.com/extension/select2) for column visibility and order configuration

##Changes

###0.9.2

* re-enabled beforeAjaxUpdate option
* disabled default configure button, as this requires the select2 extension

###0.9.1

* removed fixed width on first column if selectableRows != 0
* allow passing null to buttons option to disable all default buttons
* fix default JS action on delete button in EButtonColumn
* register select2 JS plugin from ESelect2 extension if configure button is enabled
* removed all the JS code for drawing active forms in modal dialogs

###0.9.0

* updated DataTables to 1.9.4
* refactored editable columns and changed the way rows are selected, read more on [the wiki](http://code.google.com/p/edatatables/wiki/SelectableAndEditable)
* refactored and moved all ajax related code from the class file to the js plugin file
* added refresh and search JS methods to trigger reloading of grid's contents
* added column names to the dataTables definition, send their order and visibility to the server with every ajax request
* added a static restoreStateSession method to save and restore pagination, sorting and columns order/visibility in/from session, see [the wiki](http://code.google.com/p/edatatables/wiki/stateSaving)
* fixed retrieving key values from dataProvider
* add an implementation of parse_str borrowed from CakePHP framework to restore contents of editable columns
* changed every occurence of $\_REQUEST to $\_GET
* fixed EDTPagination not storing itemCount properly
* fixed delete button JavaScript callback that should refresh the grid's contents
* added a definition for a "history" button, that's supposed to open a record modifications log

###0.8.5

* bootstrap theme, enabled with 'bootstrap' attribute
* fixed setting default sorting, use an array for $sort->defaultOrder
* fixed fixed width of first column when selectableRows is set
* fixed restoring the state from cookie when 'bStateSave' is used

###0.8.3

* fixed styles, by default jquery UI smoothness themeroller style is applied
* fixed some JS code, all should work for now
* by default, left only the refresh button in the toolbar located in the table header
* updated the polish localization files to use &raquo; and &rsaquo; html entities, to be used as a template
* started documenting features on the [wiki](http://code.google.com/p/edatatables/w/list)

###0.8.2

* i18n support
* fixed a but in the getFormattedData method, used to get data for ajax response
* updated DataTables to 1.9.0

##Usage

It's not 100% compatible with CGridView. I've decided not to alter the GET parameter names used by DataTables, so you have to use the provided EDTSort and EDTPagination classes as well as alter filter processing. See below.

###Installation

Extract into extensions dir.

Import in config/main.php

~~~
[php]
'import' => array(
  ...
  'ext.EDataTables.*',
  ...
~~~

###Using

Use similar to CGridView. If displayed in a normal call just run the widget. To fetch AJAX response send json encoded result of $widget->getFormattedData().

The action in a controller:
~~~
[php]
$widget=$this->createWidget('ext.EDataTables.EDataTables', array(
 'id'            => 'products',
 'dataProvider'  => $dataProvider,
 'ajaxUrl'       => Yii::app()->getBaseUrl().'/products/index',
 'columns'       => $columns,
));
if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
  $this->render('index', array('widget' => $widget,));
  return;
} else {
  echo json_encode($widget->getFormattedData(intval($_REQUEST['sEcho'])));
  Yii::app()->end();
}

~~~

The index view (for non-ajax requests):
~~~
[php]
<?php $widget->run(); ?>
~~~

###Preparing the dataprovider

To use features like sorting, pagination and filtering (by quick search field in the toolbar or a custom advanced search filter form) the dataprovider object passed to the widget must be prepared using provided EDTSort and EDTPagination class and CDbCriteria filled after parsing sent forms.

The simplest example:
~~~
[php]
$criteria = new CDbCriteria;
// bro-tip: $_REQUEST is like $_GET and $_POST combined
if (isset($_REQUEST['sSearch']) && isset($_REQUEST['sSearch']{0})) {
    // use operator ILIKE if using PostgreSQL to get case insensitive search
    $criteria->addSearchCondition('textColumn', $_REQUEST['sSearch'], true, 'AND', 'ILIKE');
}

$sort = new EDTSort('ModelClass', $sortableColumnNamesArray);
$sort->defaultOrder = 'id';
$pagination = new EDTPagination();
 
$dataProvider = new CActiveDataProvider('ModelClass', array(
    'criteria'      => $criteria,
    'pagination'    => $pagination,
    'sort'          => $sort,
))
~~~

An advanced example would be based on a search form defined with a model and a view. Its attributes would be then put into a critieria and passed to a dataProvider. 

###Other options

Check out the [DataTables web page](http://datatables.net) for docs regarding:

* Table layout
* Styling
* Multi-column sorting etc.
* Some examples and funky plugins

##Resources

 * [Project page](http://code.google.com/p/edatatables)
 * [Project wiki](http://code.google.com/p/edatatables/w/list)


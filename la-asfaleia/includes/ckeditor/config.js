/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.toolbarCanCollapse = false;
	config.defaultLanguage = 'el';
	config.filebrowserBrowseUrl = 'includes/filemanager/'
	config.contentsCss = ['javascripts/bootstrap/css/bootstrap.css', 'stylesheets/calendar.css'];
	config.resize_enabled = false;
	config.filebrowserWindowHeight = '60%';
	config.filebrowserWindowWidth = '60%';
	config.height = 500;
	config.htmlEncodeOutput = false;
	config.entities_greek = false;
	config.allowedContent = true;
	config.plugins = 'dialogui,dialog,about,a11yhelp,dialogadvtab,basicstyles,bidi,blockquote,clipboard,button,panelbutton,panel,floatpanel,colorbutton,colordialog,templates,menu,contextmenu,div,resize,toolbar,elementspath,list,indent,enterkey,entities,popup,filebrowser,find,fakeobjects,flash,floatingspace,listblock,richcombo,font,forms,format,htmlwriter,horizontalrule,iframe,wysiwygarea,image,smiley,justify,link,liststyle,magicline,maximize,newpage,pagebreak,pastetext,pastefromword,preview,print,removeformat,save,selectall,showblocks,showborders,sourcearea,specialchar,menubutton,scayt,stylescombo,tab,table,tabletools,undo,wsc';
	config.skin = 'moonocolor';
	
config.toolbar_Basic =
[
    { name: 'document',    items : [ 'Preview','Print','Source' ] },
    { name: 'clipboard',   items : [ 'PasteFromWord','Undo','Redo' ] },
    { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
    { name: 'paragraph',   items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] },
    { name: 'insert',      items : [ 'Image','Table','HorizontalRule','SpecialChar','PageBreak' ] },
    { name: 'styles',      items : [ 'Format','Font','FontSize' ] },
    { name: 'colors',      items : [ 'TextColor','BGColor' ] },
    { name: 'tools',       items : [ 'Maximize', '-','About' ] }
];	
config.toolbar = 'Basic';
};

/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.startupShowBorders = true;
	config.startupOutlineBlocks = true;
	CKEDITOR.config.allowedContent = true;	
	
	config.toolbar = 'LazarusGroup';
	 
		config.toolbar_LazarusGroup =
			[
				{ name: 'document', items : [ 'Source','-','Templates' ] },
				{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
				{ name: 'editing', items : [ 'Find','Replace','-','SelectAll' ] },
				{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
				'/',
				{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
				{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
				'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
				
				{ name: 'insert', items : [ 'Image','Table','HorizontalRule','SpecialChar','PageBreak','Iframe','CreateDiv' ] },
				'/',
				{ name: 'styles', items : [ 'Format','Styles' ] },
				{ name: 'colors', items : [ 'TextColor','BGColor' ] },
				{ name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
			];
			 

};
CKEDITOR.stylesSet.add( 'default', [
                                	/* Block Styles */

                                	// These styles are already available in the "Format" combo ("format" plugin),
                                	// so they are not needed here by default. You may enable them to avoid
                                	// placing the "Format" combo in the toolbar, maintaining the same features.
                                	/*
                                	{ name: 'Paragraph',		element: 'p' },
                                	{ name: 'Heading 1',		element: 'h1' },
                                	{ name: 'Heading 2',		element: 'h2' },
                                	{ name: 'Heading 3',		element: 'h3' },
                                	{ name: 'Heading 4',		element: 'h4' },
                                	{ name: 'Heading 5',		element: 'h5' },
                                	{ name: 'Heading 6',		element: 'h6' },
                                	{ name: 'Preformatted Text',element: 'pre' },
                                	{ name: 'Address',			element: 'address' },


                                	{ name: 'Italic Title',		element: 'h2', styles: { 'font-style': 'italic' } },
                                	{ name: 'Subtitle',			element: 'h3', styles: { 'color': '#aaa', 'font-style': 'italic' } },
                                	{
                                		name: 'Special Container',
                                		element: 'div',
                                		styles: {
                                			padding: '5px 10px',
                                			background: '#eee',
                                			border: '1px solid #ccc'
                                		}
                                	},
                                	*/
                                	/* Inline Styles */

                                	// These are core styles available as toolbar buttons. You may opt enabling
                                	// some of them in the Styles combo, removing them from the toolbar.
                                	// (This requires the "stylescombo" plugin)
                                	/*
                                	{ name: 'Strong',			element: 'strong', overrides: 'b' },
                                	{ name: 'Emphasis',			element: 'em'	, overrides: 'i' },
                                	{ name: 'Underline',		element: 'u' },
                                	{ name: 'Strikethrough',	element: 'strike' },
                                	{ name: 'Subscript',		element: 'sub' },
                                	{ name: 'Superscript',		element: 'sup' },
                                	*/


                                	{ name: 'Heading 1 - Left',		element: 'h1' , attributes: { 'class': 'headleft' } },
                                	{ name: 'Heading 2 - Left',		element: 'h2' , attributes: { 'class': 'headleft' } },
                                	{ name: 'Heading 3 - Left',		element: 'h3' , attributes: { 'class': 'headleft' } },
                                	{ name: 'Heading 4 - Left',		element: 'h4' , attributes: { 'class': 'headleft' } },
                                	{ name: 'Heading 5 - Left',		element: 'h5' , attributes: { 'class': 'headleft' } },
                                	{ name: 'Heading 6 - Left',		element: 'h6' , attributes: { 'class': 'headleft' } },
                                	{ name: 'Greybox',			element: 'h4' , attributes: { 'class': 'greybox' } },
                                	{ name: 'Greybox Multi',			element: 'h4' , attributes: { 'class': 'greyboxmulti' } },
                                	{ name: 'Bluebox',			element: 'h4' , attributes: { 'class': 'bluebox' } },
                                	{ name: 'Bluebox Multi',			element: 'h4' , attributes: { 'class': 'blueboxmulti' } },
                                	{ name: '2 column',		element: 'div' , attributes: { 'class': 'twocolumn' } },
                                	{ name: '3 column',		element: 'div' , attributes: { 'class': 'threecolumn' } },
                                	

                                	/* Object Styles */

                                	{
                                		name: 'Styled image (left)',
                                		element: 'img',
                                		attributes: { 'class': 'left' }
                                	},

                                	{
                                		name: 'Styled image (right)',
                                		element: 'img',
                                		attributes: { 'class': 'right' }
                                	},

                                	{
                                		name: 'Compact table',
                                		element: 'table',
                                		attributes: {
                                			cellpadding: '5',
                                			cellspacing: '0',
                                			border: '1',
                                			bordercolor: '#ccc'
                                		},
                                		styles: {
                                			'border-collapse': 'collapse'
                                		}
                                	},

                                	{ name: 'Borderless Table',		element: 'table',	styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA' } },
                                	{ name: 'Square Bulleted List',	element: 'ul',		styles: { 'list-style-type': 'square' } }
                                ]);


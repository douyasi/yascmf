/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.pasteFromWordRemoveStyles = true;  //从word中粘贴内容时是否移除格式 
	config.forcePasteAsPlainText = true;  //是否强制复制来的内容去除格式,false为不去除 
	config.image_previewText=' ';
	config.filebrowserImageUploadUrl = "/plugins/ckeditor/plugins/imgupload/imgupload.php"; 
	config.filebrowserBrowseUrl = "/plugins/ckeditor/plugins/imgbrowse/imgbrowse.html?imgroot=/uploads/images/";
	config.font_names='宋体/宋体, SimSun;'+'微软雅黑/微软雅黑, Microsoft YaHei;'+'黑体/黑体, SimHei;'+'楷体/楷体, 楷体_GB2312, SimKai;'+'隶书/隶书, SimLi;'+ config.font_names;
	config.defaultLanguage = 'zh-cn'
	config.font_defaultLabel = '宋体';
};

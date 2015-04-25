CKEDITOR.plugins.add('imgbrowse', {
	"init": function (editor) {
		if (typeof(editor.config.imageBrowser_listUrl) === 'undefined' || editor.config.imageBrowser_listUrl === null) {
			return;
		}

		var url = editor.plugins.imgbrowse.path + "imgbrowse.php?listUrl=" + encodeURIComponent(editor.config.imageBrowser_listUrl);
		if (editor.config.baseHref) {
			url += "&baseHref=" + encodeURIComponent(editor.config.baseHref);
		}

		editor.config.filebrowserImageBrowseUrl = url;
	}
});

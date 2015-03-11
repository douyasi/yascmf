CKEditor Free Image Browser plugin (with Ajax - PHP), `From: <http://coursesweb.net/javascript/ckeditor-image-browse_s2/>`
=============================

**imgbrowse** is a `CKEditor <http://ckeditor.com/>`_ plugin that allows images on the server to be browsed and picked
for inclusion into the editor's contents. It uses Ajax and PHP to get and display the menu with directory structure, and images in current folder.

This plugin integrates with the **image** plugin (part of CKEditor),
by making it provide a **Browse Server** button in the Image dialog window (`screenshot here <http://ckeditor.com/sites/default/files/styles/large/public/image/image_manager.png>`_).

To can use it, you need to install the CKEditor with this plugin on a server with PHP

Installation
------------

Open the ``imgbrowse.php`` file and change the value of the $root property (line 6), with the path of images directory on your server, RELATIVE TO ``plugins/imgbrowse/imgbrowse.php`` location.

Copy the whole contents of this repository into a new ``plugins/imgbrowse/`` directory in your CKEditor install.

Make sure you're using the **Standard** or **Full** `CKEditor packages <http://ckeditor.com/download>`_.
The **Basic** package lacks an in-built "File Browser" plugin, which this plugin depends on.

Usage
-----

Enable the plugin by adding it to `extraPlugins` and specify the `filebrowserImageBrowseUrl` parameter::

	CKEDITOR.replace('textareaId', {
		"extraPlugins": "imgbrowse",
		"filebrowserImageBrowseUrl": "/path_to/ckeditor/plugins/imgbrowse/imgbrowse.html?imgroot=PATH_TO_IMAGE_FOLDER"
	});

The **filebrowserImageBrowseUrl** configuration parameter points to ``imgbrowse.html`` that uses Ajax with request to ``imgbrowse.php`` to browse the images from a multi-dimensional directory structure.

- The path to the image folder (PATH_TO_IMAGE_FOLDER) it is necessary ONLY IF YOU NOT SET THIS VALUE IN "imgbrowse.php". The path MUST BE RELATIVE TO ROOT OF YOUR WEBSITE ON SERVER, for example: **imgroot=/your_img_dir**

- You can set the path to the folder with images in the ``plugins/imgbrowse/imgbrowse.php`` file, to the **$root** property (Line 6). In this case you NOT NEED TO ADD the **?imgroot=PATH_TO_IMAGE_FOLDER** in the `filebrowserImageBrowseUrl`.

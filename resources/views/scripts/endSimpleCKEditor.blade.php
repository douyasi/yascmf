      <!--使用简版CKEditor-->
      <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
      <script>
        CKEDITOR.replace( 'ckeditor', {
          "extraPlugins": "imgbrowse",
          "toolbar" :  [
            { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
            { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ '-' ] },
            { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic' ] },
            { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent' ] },
            { name: 'links', items: [ 'Link', 'Unlink' ] },
            { name: 'others', items: [ '-' ] },
            { name: 'about', items: [ 'About' ] }
          ]
        });
      </script>

    {{-- epiceditor --}}
    <script type="text/javascript" src="{{ asset('plugins/EpicEditor/js/epiceditor.min.js') }}"></script>
    <script type="text/javascript">
    /*加载EpicEditor*/
var opts = {
  container: 'epiceditor',
  textarea: 'text_editor',
  basePath: '{{ asset('plugins/EpicEditor') }}',
  clientSideStorage: true,
  localStorageName: 'epiceditor',
  useNativeFullscreen: true,
  parser: marked,
  file: {
    name: 'epiceditor',
    defaultContent: '',
    autoSave: 100
  },
  theme: {
    base: '/themes/base/epiceditor.css',
    preview: '/themes/preview/markdownpad-github.css',
    editor: '/themes/editor/epic-dark.css'
  },
  button: {
    preview: true,
    fullscreen: true,
    bar: "auto"
  },
  focusOnLoad: false,
  shortcut: {
    modifier: 18,
    fullscreen: 70,
    preview: 80
  },
  string: {
    togglePreview: 'Toggle Preview Mode',
    toggleEdit: 'Toggle Edit Mode',
    toggleFullscreen: 'Enter Fullscreen'
  },
  autogrow: true
}
var editor = new EpicEditor(opts).load();
    </script>

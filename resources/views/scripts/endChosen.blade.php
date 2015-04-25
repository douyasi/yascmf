    {{--chosen--}}
    <!--select下拉插件 chosen-->
    <link href="{{ asset('plugins/chosen/chosen.css') }}" rel="stylesheet">
    <script src="{{ asset('plugins/chosen/chosen.jquery.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
    var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chosen-select-width'     : {width:'95%'}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
    </script>
    <!--select下拉插件 chosen-->

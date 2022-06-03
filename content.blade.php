<style>
    #componentForm{overflow: auto}
    #componentForm::-webkit-scrollbar { width: 0 !important }
</style>

{!! Admin::style() !!}
<div id="componentForm">
   {!! $_content_ !!}
</div>
{!! Admin::script() !!}
{!! Admin::html() !!}

<script>
    function LA() {}
    LA.token = "{{ csrf_token() }}";
    document.getElementById('componentForm').style = 'height:'+window.innerHeight*0.8 + 'px';
</script>
<!-- REQUIRED JS SCRIPTS -->
{!! Admin::js() !!}


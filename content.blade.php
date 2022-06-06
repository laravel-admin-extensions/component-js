<style>
    .modal-body::-webkit-scrollbar { width: 0 !important }
</style>
<div id="componentForm">
   {!! $_content_ !!}
</div>
{!! Admin::script() !!}

<script>
    function LA() {}
    LA.token = "{{ csrf_token() }}";
</script>



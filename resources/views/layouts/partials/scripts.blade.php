<!-- REQUIRED JS SCRIPTS -->

<script src="/core/public/js/jquery.js"></script>

<script src="/core/public/js/jquery-ui.min.js"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<script src="/core/public/js/bootstrap.min.js"></script>


<script src="/core/public/js/jquery.multi-select.js"></script>
<script src="/core/public/js/bootstrap-multiselect.min.js"></script>
<script src="/core/public/js/select2.full.min.js"></script>
<script src="/core/public/js/layouts.js"></script>
<script type="text/javascript">

$(".sidebar-menu").load("/core/menu",window.location.pathname, function(){
    console.log('termino');
});
$(document).ready(function() {
    $(".select2").select2();
});
</script>

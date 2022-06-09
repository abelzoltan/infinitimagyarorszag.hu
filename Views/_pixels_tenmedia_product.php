<script type="text/javascript">
(function() {
    var w = window, d = document;
    var s = d.createElement('script'); 
    s.setAttribute('async', 'true');
    s.setAttribute('type', 'text/javascript');
    s.setAttribute('src', '//c1.rfihub.net/js/tc.min.js');
    var f = d.getElementsByTagName('script')[0];
    f.parentNode.insertBefore(s, f);
    if (typeof w['_rfi'] !== 'function') {
        w['_rfi']=function() {
            w['_rfi'].commands = w['_rfi'].commands || [];
            w['_rfi'].commands.push(arguments);
        };}
    _rfi('setArgs', 'ver', '9');
    _rfi('setArgs', 'rb', '33233');
    _rfi('setArgs', 'ca', '20798840');
    _rfi('setArgs', 't', 'view');
    _rfi('setArgs', 'pid', '<?php echo $TENMEDIA_PID; ?>');
    _rfi('track');
})();
</script>

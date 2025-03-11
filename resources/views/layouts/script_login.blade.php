<script src="{{asset('assets/js/jquery.js')}}"></script>
<script src="a{{asset('ssets/js/bootstrap.min.js')}}"></script>

<!--BACKSTRETCH-->
{{-- You can use an image of whatever size. This script will stretch to fit in any screen size.--}}
<script type="text/javascript" src="{{asset('assets/js/jquery.backstretch.min.js')}}"></script>
<script>
    $.backstretch("{{asset('assets/img/login-bg.jpg')}}", {speed: 500});
</script>

<script src="{{ asset('assets/plugins/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/countup.min.js') }}"></script>
<script src="{{ asset('assets/plugins/choices.min.js') }}"></script>
<script src="{{ asset('assets/plugins/prism.min.js') }}"></script>
<script src="{{ asset('assets/plugins/rellax.min.js') }}"></script>
<script src="{{ asset('assets/plugins/tilt.min.js') }}"></script>
<script src="{{ asset('assets/plugins/choices.min.js') }}"></script>
<script src="{{ asset('assets/plugins/parallax.min.js') }}"></script>
<script src="{{ asset('assets/js/soft-design-system.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
@stack('script')

<script type="text/javascript">
    if (document.getElementById('state1')) {
        const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));
        if (!countUp.error) {
            countUp.start();
        } else {
            console.error(countUp.error);
        }
    }
    if (document.getElementById('state2')) {
        const countUp1 = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));
        if (!countUp1.error) {
            countUp1.start();
        } else {
            console.error(countUp1.error);
        }
    }
    if (document.getElementById('state3')) {
        const countUp2 = new CountUp('state3', document.getElementById("state3").getAttribute("countTo"));
        if (!countUp2.error) {
            countUp2.start();
        } else {
            console.error(countUp2.error);
        };
    }

</script>
</body>

</html>

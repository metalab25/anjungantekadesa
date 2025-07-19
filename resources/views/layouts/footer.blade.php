<footer class="footer pt-5 mt-5">
    <div class="container">
        <div class=" row">
            <div class="col-12">
                <div class="text-center">
                    <p class="my-4 text-sm">
                        All rights reserved. Copyright ©
                        <script>
                            document.write(new Date().getFullYear())

                        </script> {{ config('app.name') }} <a href="https://www.tekadesa.com" target="_blank">{{ config('app.author') }}</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="{{ asset('assets/plugins/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/countup.min.js') }}"></script>
<script src="{{ asset('assets/plugins/choices.min.js') }}"></script>
<script src="{{ asset('assets/plugins/prism.min.js') }}"></script>
<script src="{{ asset('assets/plugins/highlight.min.js') }}"></script>
<script src="{{ asset('assets/plugins/rellax.min.js') }}"></script>
<script src="{{ asset('assets/plugins/tilt.min.js') }}"></script>
<script src="{{ asset('assets/plugins/choices.min.js') }}"></script>
<script src="{{ asset('assets/plugins/parallax.min.js') }}"></script>

<script src="{{ asset('assets/js/soft-design-system.min.js') }}?v=1.1.0" type="text/javascript"></script>


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

@if (count($errors) > 0)
    <div class="notification is-danger" id="notification">
        <a class="delete" onclick="closeNotification()"></a>
        @foreach ($errors->all() as $error)
            {{ $error }}<br/>
        @endforeach
    </div>
    <script type="text/javascript">
        function closeNotification() {
            var x = document.getElementById("notification");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
@endif
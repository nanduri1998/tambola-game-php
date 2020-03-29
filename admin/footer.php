<footer class="text-center">&copy; <?php echo date('Y'); ?> All Rights Reserved | Designed and Developed by <a href="https://srivastav-nanduri.web.app">Srivastav Nanduri</a></footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
window.addEventListener('load', function(){
    function updateOnlineStatus(event) {
        var condition = navigator.onLine ? "online" : "offline";
        if(condition == "offline"){
            swal({
                title: "Offline",
                text: "We can't find you online. Please check your connection.",
                icon: "error",
                button: false,
                closeOnClickOutside: false,
                closeOnEsc: false
            });
        }
        else{
            swal.close();
        }
    }
    window.addEventListener('online',  updateOnlineStatus);
    window.addEventListener('offline', updateOnlineStatus);
})
</script>
  </body>
</html>
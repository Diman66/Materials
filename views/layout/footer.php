    </div>
    <footer class="footer py-4 mt-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col text-muted">Test</div>
            </div>
        </div>
    </footer>
</div>
<!-- Optional JavaScript; choose one of the two! -->
<script>
    let btnDelete = document.querySelectorAll('.btnDelete');
    for (let elem of btnDelete) {
        elem.onclick = function(e) {
            let isDelete = confirm("Удалить материал?");
            if (isDelete) {
                return true;
            } else {
                return false;
            };  
        };
    };  
    
</script>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

</body>
</html>
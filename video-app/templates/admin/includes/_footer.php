</main>
</div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/popper.js"></script>
<script src="../assets/js/bootstrap.js"></script>


<script>
    $('input[type="file"]').change(function (e) {
        var fileName = e.target.files[0].name;
        console.log(e.target.files[0]);
        $('.custom-file-label').html(fileName);
    });
</script>
</body>

</html>
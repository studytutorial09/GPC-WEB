<div class="footer">
    <footer><p>Copyright &copy; GPC ITARSI</p></footer>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $(".error").fadeTo(1000, 100).slideUp(1000, function(){
            $(".error").slideUp(1000);
        });
        $(".success").fadeTo(1000, 100).slideUp(1000, function(){
            $(".success").slideUp(1000);
        });
    });
</script>

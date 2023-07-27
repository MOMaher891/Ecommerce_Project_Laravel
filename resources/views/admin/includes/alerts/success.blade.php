@if (Session::has('success'))
    <div class="row mr-2 ml-2">
        <button type="text" class="success btn btn-lg btn-block btn-outline-success mb-2"
            id="type-error">{{ Session::get('success') }}
        </button>
    </div>
@endif


<script>
    setTimeout(function() {
        document.querySelector('.success').style.display = "none";
    }, 5000)
</script>

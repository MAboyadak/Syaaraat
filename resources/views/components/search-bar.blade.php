<div class="row justify-content-start my-3 p-2">
    <div class="col-4">
        <div class="row">
            <div class="col-8">
                <input id="search-key" name="key" type="text" class="form-control">
                <input type="hidden" id="table-name" name="table-name">
            </div>
            <div class="col-4">
                <button class="btn btn-primary" id="search-submit">Search</button>
            </div>
        </div>
    </div>
</div>

<script>
    
    document.querySelector('#search-submit').addEventListener('click', searchKey);

    function searchKey(){
        let _key = document.querySelector('#search-key');
        let _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(searchUrl, {
            method:'post',
            headers: {
                'X-CSRF-TOKEN': _token,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                search_key: _key.value,
            })

        }) 
        .then( resp => resp.json(resp))
        .then( resp => {
            document.querySelector('tbody').outerHTML = resp.html
        })
    }
    
    
</script>
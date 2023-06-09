var data = [];
var url = location.protocol + "//" + location.host + "/api/get-all-products"
fetch(url)
    .then(response => response.json())
    .then((results) => {
        for(let i = 0; i<results.length; i++){
            data.push(results[i]);
        }
        return data;
}).catch(err => console.error(err));

function searching(){
    var results = [];
    var showhtmls = [];
    var key = document.getElementById("search").value;
    key = key.trim();
    key = String(key);

    var options = {
        keys: ['name'],
    }
    var fuse = new Fuse(data, options)

    results = fuse.search(key);

    for(let i=0; i<results.length; i++){
        showhtmls.push('<a href="/san-pham/'+results[i].slug+'">'
                +'<div class="result-search">'
                    +'<div class="suggest-product-image left">'
                        +'<img src="/images/'+results[i].image+'">'
                    +'</div>'
                    +'<div class="suggest-product-name right">'
                        +'<p>'
                            +results[i].name.substring(0, 30)
                        +'</p>'
                    +'</div>'
                +'</div>'
            +'</a>');
    }

    $("#widget-rs-search").css('display','block');
    $("#widget-rs-search").html(showhtmls);
}

function miniSearching(){
    var results = [];
    var showhtmls = [];
    var key = document.getElementById("search-fixed-top").value;
    key = key.trim();
    key = String(key);

    var options = {
        keys: ['name'],
    }
    var fuse = new Fuse(data, options)

    results = fuse.search(key);

    for(let i=0; i<results.length; i++){
        showhtmls.push('<a href="/san-pham/'+results[i].slug+'">'
                +'<div class="result-search">'
                    +'<div class="suggest-product-image left">'
                        +'<img src="/images/'+results[i].image+'">'
                    +'</div>'
                    +'<div class="suggest-product-name right">'
                        +'<p>'
                            +results[i].name.substring(0, 30)
                        +'</p>'
                    +'</div>'
                +'</div>'
            +'</a>');
    }

    $("#mini-widget-rs-search").css('display','block');
    $("#mini-widget-rs-search").html(showhtmls);
}
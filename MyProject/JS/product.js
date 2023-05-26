$.getJSON(
    "localhost/MyProject/php/api.php",
    
    function (data, xhr, status) {

        console.log(data);

        if(status.statusText === 'success' && typeof data == 'object') {

            console.log('api call successful');


            let items = [];

            $.each( data, function( key, val ) {
                items.push( `<li id="product_${val.id}">${val.name} [${val.description}][${val.price}][${val.unit}][${val.quantity}]</li>` );
            });


            $( "<ul/>", {
                "class": "Product-list",
                html: items.join( "" )
            }).appendTo( "body" );


        } else {
            console.log('api call not successful');
        }


    }
);
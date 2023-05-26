const user = 'Marie';
const pass = 'marie';

$('#submit').on('click', function() {
    
    $('#result').load(
        'http://localhost/MyProject/php/myaccount.php',
        {
            username: user,
            password: pass
        },
        function() {
            console.log('load completed');
        }
    );
    
});
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <title>Your app title</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <script src="https://telegram.org/js/telegram-web-app.js?57"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</head>
<body class="p-5">

	<!-------------- you app body ------------------->
    <header class="row bg-dark text-white rounded p-3 m-0">
        <h3 class="col-12 m-0 mb-1">ID: <span id="txt">Error</span> </h3>
        <div class="col-12 m-0 p-0"><small class="text-danger text-center m-0"><i class="fa-solid fa-quote-left"></i><span> Time Won't Let .... Go! </span></small></div>
    </header>
    <p class="p-3">
        This is a simple Telegram mini app template using PHP and vanilla JS. This template helps to extract data from user request safely.
    </p>
    <div class="h-100 mt-3">
        Secure-extracted data:
        <textarea class="w-100" style="min-height:250px" id="data_area"></textarea>
        <a href="https://core.telegram.org/bots/webapps" class="btn btn-link">See other methods: https://core.telegram.org/bots/webapps</a>
    </div>
	<!----------------  ********  ------------------->

<script>
	// Check if app is loaded and Telegram library is available.
    window.addEventListener('DOMContentLoaded', function () {
        if (window.Telegram && window.Telegram.WebApp) {
			// Send Ajax request to verify the user
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'verify.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if(response.status && response.status == 'success'){
						
						//YOUR CODES START FROM HERE
                        document.getElementById('txt').innerHTML = (response.id)
                        document.getElementById('data_area').value    = JSON.stringify(response);
						
                    }
                }
            };
            var data = JSON.stringify({
                data: window.Telegram.WebApp.initData,
            });
            xhr.send(data);
        } else {
            // The url is not called throug a telegram mini app
        }
    });
</script>
</body>
</html>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>THIS PAGE FOR TESTING NEW STUFF.</h1>






</body>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>

    const CancelToken = axios.CancelToken;
    const source = CancelToken.source();
    axios.post('/test',
        {name: 'new name'},
    )
        .then(data => console.log(data.data))
        .catch(error => console.log(error));





</script>
</html>
<html>
<head>
    <meta charset="utf-8">
    <title>Callback</title>
    <script>
        window.opener.postMessage({
            from   : "zoho.auth.callback",
            id     : "{{ $id ?? null}}",
            status : "{{ $status ? 'success' : 'error' }}",
            message: "{{ $message ?? null}}",
        }, "{{ url('/connections/'.$id.'/authorize') }}");
        window.close();
    </script>
</head>
<body>
</body>
</html>

<html>
<head>
<title>!{if $page_title}!{$page_title}!{/if}</title>
<style>
body{font-family:Arial,sans-serif,verdana;margin:0px;}
</style>
<script language="javascript">
<!--
// This will resize the window when it is opened or
// refresh/reload is clicked to a width and height of 500 x 500
// with is placed first, height is placed second
window.resizeTo(!{$data.window_width},!{$data.window_height})
-->
</script>
</head>
<body>
!{$data.full_content}
</body>
</html>


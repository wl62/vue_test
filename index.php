<!DOCTYPE html>
<html>
<head>
  <title>My first Vue app</title>
  <script src="https://unpkg.com/vue"></script>
  
</head>
<body>
  <div id="app">
  <input type="text" name="" value="" placeholder="Vue wurde geschrieben von ..." v-model="message">
		<hr>
    {{ message }}
  </div>
  <script>
    var app = new Vue({
      el: '#app',
      data: {
        message: 'Hello Vue!'
      }
    })
  </script>

</body>
</html>
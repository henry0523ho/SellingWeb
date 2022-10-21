# register.php
method="POST"

"key" : [ 'userName', 'userPwd', 'userEmail' ]

"return" : [ ('success'|'failed'|'nameTaken') ]

# login.php
method="POST"

"key" : [ 'userName', 'userPwd' ]

"return" : [ ('success'|'failed') ]

# logout.php

method="POST"

"key" : []

"return" : []

# getSession.php

method="POST"

"key" : [];

"return" : [ (username|'No Login') ];

<hr>
<hr>

# getCart.php

method="POST"

"key" : []

"return" : [ ('success'|'failed') ]

# putInCart.php



# placeOrder.php 
一個商品，結帳

# showProduct.php

method="POST"

"key" : [ "num" ]

"return" : [ {} ]

<hr>
<hr>

# delProduct






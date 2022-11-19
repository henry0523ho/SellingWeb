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

# setProduct.php
```json
method="POST"
send={
    "productId":"", //商品ID，若為 新增商品 設 空字串
    "productName":"微積分2", //(商品名稱)
    "productNum":10, //(商品數量)
    "productImg":"https://i.imgur.com/OS3lebp.png", //照片網址
    "productText":"牛逼了我的天", //賣家的話
    "productLabel":"", //商品分類
    "productNewRate":4, //商品新舊程度(0~5)
    "productInfo":"一杓三花淡奶，全是科技與很活", //商品介紹
    "productCost":300, //價錢
}
response={
    "state":200, // 400=> 沒登入,200 => OK,500 => 後端爛了or有資料沒送到後端
    "message":"就一些訊息"
}
```





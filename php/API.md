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
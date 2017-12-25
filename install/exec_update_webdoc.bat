set path=%path%;D:\WebSvr\MySQL\bin

rem mysql --host=localhost --user=webdoc --password=webdoc --execute="source update_webdoc_en.sql"
rem mysql --host=localhost --user=webdoc --password=webdoc --execute="source update_webdoc_jp.sql"
mysql --host=localhost --user=webdoc --password=webdoc --execute="source update_webdoc_zh-simp.sql"
rem mysql --host=localhost --user=webdoc --password=webdoc --execute="source update_webdoc_zh-tw.sql"

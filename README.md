# localpress
Simple way to develop multiple Wordpress websites in localhost with single instalation.

ERROR: SQL execution error: Invalid default value for 'comment_date'

4

Just add the line: sql_mode = "NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION"

inside file: /etc/mysql/mysql.conf.d/mysqld.cnf

then sudo service mysql restart
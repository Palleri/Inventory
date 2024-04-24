#!/bin/bash


date=$(date '+%Y-%m-%d' -d '+90 days')
id=$(mysql -h $host -u root --password=$password --database inventory -s -r -N --execute="SELECT id FROM stock WHERE exp_date <='$date' AND exp_date<>'' AND notify=0;")



for id in $id
do
name=$(mysql -h $host -u root --password=$password --database inventory -s -r -N --execute="SELECT name FROM stock WHERE id ='$id';")
stock=$(mysql -h $host -u root --password=$password --database inventory -s -r -N --execute="SELECT stock FROM stock WHERE id ='$id';")
min=$(mysql -h $host -u root --password=$password --database inventory -s -r -N --execute="SELECT min FROM stock WHERE id ='$id';")
location=$(mysql -h $host -u root --password=$password --database inventory -s -r -N --execute="SELECT location FROM stock WHERE id ='$id';")
category=$(mysql -h $host -u root --password=$password --database inventory -s -r -N --execute="SELECT category FROM stock WHERE id ='$id';")
exp_date=$(mysql -h $host -u root --password=$password --database inventory -s -r -N --execute="SELECT exp_date FROM stock WHERE id ='$id';")


if [ -z "$id" ]
then
      echo "Empty"
else

curl -k -X POST -H "Content-Type: application/json" \
-H "Authorization: Bearer $token" \
http://$hahost/api/services/shopping_list/add_item -d '{"name":"'"[B] $name $stock/$min $category - $exp_date - $location"'"}'


mysql -h $host -u root --password=$password --database inventory -s -r -N --execute="UPDATE stock SET notify=1 WHERE id='$id';"


fi


done

<?php

//return searched string
function searchedData($searched)
{
    $_SESSION['searchKeyword'] = $searched;

    $searchStr = "select * from product as p join productstore as s on s.product_id = p.id  where (p.name like '%$searched%' or p.description like '%searched%') and p.deleted_at is null";
    $searchProductQuery = query($searchStr);


    if (row($searchProductQuery) > 0) {
        $searchedResult = $searchStr;

    } else { //if no product searched, try to search category
        $searchCatQuery = query("select id from category where name like '%$searched%' and deleted_at is null");

        if (row($searchCatQuery) > 0) { //check if searched in category

            $categoryStr = '(';
            $i = 0;

            while ($category = fetch($searchCatQuery)) {
                $categoryStr .= $category['id'];
                $i++;

                if ($i < row($searchCatQuery)) { //add coma except last id
                    $categoryStr .= ',';
                }
            }

            $categoryStr .= ')';
            //outcome : (1,2,3)

            $searchedResult = "select * from product as p join productstore as s on s.product_id = p.id  where p.category_id in $categoryStr and p.deleted_at is null";
        }
    }

//    var_dump($searchedResult);
//    die();
    return isset($searchedResult) ? $searchedResult : '';
}
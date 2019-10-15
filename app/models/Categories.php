<?php
class Categories extends  Database
{
    public function getCategoriesList()
    {
        $sql = parent::$connection->prepare('SELECT * FROM categories');
        return parent::select($sql);
    }

    public function getNameById($id) {
        $sql = parent::$connection->prepare('SELECT category_name FROM categories WHERE category_id = ?');
        $sql->bind_param('i', $id);
        return parent::select($sql)[0];
    }
}
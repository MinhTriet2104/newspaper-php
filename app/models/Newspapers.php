<?php
class Newspapers extends database
{
    // Lay toan bo bai bao
    public function getNewspapersList()
    {
        $sql = parent::$connection->prepare('SELECT * FROM newspapers');
        return parent::select($sql);
    }

    // Lay mot bai bao theo id
    public function getNewsById($id) {
        $sql = parent::$connection->prepare('SELECT * FROM newspapers WHERE newspaper_id = ?');
          $sql->bind_param('i', $id);
          return parent::select($sql)[0];
      }

    // Lay news theo category id
    public function getNewsByCategoryId($id) {
      $sql = parent::$connection->prepare('SELECT * FROM newspapers WHERE newspaper_category_id = ?');
        $sql->bind_param('i', $id);
        return parent::select($sql);
    }

    // Lay ? bai moi nhat theo category id
    public function getLimitRecentByCategoryId($id, $limit)
    {
        $sql = parent::$connection->prepare('SELECT * FROM ( SELECT * FROM newspapers where newspaper_category_id = ? ORDER BY newspaper_date DESC LIMIT 0, ?) sub');
        $sql->bind_param('ii', $id, $limit);
        return parent::select($sql);
    }

    // Lay ? bai moi nhat
    public function getLimitRecent($limit)
    {
        $sql = parent::$connection->prepare('SELECT * FROM newspapers ORDER BY newspaper_date DESC LIMIT 0, ?');
        $sql->bind_param('i', $limit);
        return parent::select($sql);
    }

    // Lay bai moi nhat tu ? den ?
    public function loadMore($page, $limit)
    {
        $start = ($page - 1) * $limit;
        $sql = parent::$connection->prepare('SELECT * FROM newspapers ORDER BY newspaper_date DESC LIMIT ?, ?');
        $sql->bind_param('ii', $start, $limit);
        return parent::select($sql);
    }

    // Load more ? bai moi nhat theo category id
    public function loadMoreCategory($id, $page, $limit)
    {
        $start = ($page - 1) * $limit;
        $sql = parent::$connection->prepare('SELECT * FROM ( SELECT * FROM newspapers where newspaper_category_id = ? ORDER BY newspaper_date DESC LIMIT ?, ?) sub');
        $sql->bind_param('iii', $id, $start, $limit);
        return parent::select($sql);
    }

    // Lay ? bai lien quan (random)
    public function getRelative($categoryId, $newsId, $limit)
    {
        $sql = parent::$connection->prepare('SELECT * FROM newspapers WHERE newspaper_category_id = ? AND newspaper_id != ? ORDER BY RAND() LIMIT 0, ?');
        $sql->bind_param('iii', $categoryId, $newsId, $limit);
        return parent::select($sql);
    }

    // Lay ten tac gia
    public function getAuthorById($id)
    {
        $sql = parent::$connection->prepare('SELECT authors.author_name FROM newspapers, authors WHERE authors.author_id=newspapers.newspaper_author_id and authors.author_id=?' );
        $sql->bind_param('i', $id);
        return parent::select($sql)[0];
    }

    // dem so luong category
    public function countCategory($id)
    {
        $sql = parent::$connection->prepare('SELECT COUNT(newspaper_category_id) FROM `newspapers` WHERE newspaper_category_id=?' );
        $sql->bind_param('i', $id);
        return parent::select($sql)[0];
    }

    // Lay 3 bai co so luong view va trong khoang 30 ngay tro lai
    public function getHotNews($limit)
    {
      $sql = parent::$connection->prepare('SELECT * FROM newspapers WHERE DATEDIFF(CURDATE(), newspaper_date) <= 30 ORDER BY newspaper_view DESC LIMIT 0, ?');
      $sql->bind_param('i', $limit);
      return parent::select($sql);
    }
  
    public function addNewspaper($newspaperTitle, $newspaperImgae, $newspaperAuthorId, $newspaperDate,$newspaperContent, $newspaperView,$newspaperCategoryId)
    {
        $sql = parent::$connection->prepare('INSERT INTO newspapers (newspaper_title, newspaper_imgae, newspaper_author_id, newspaper_date, newspaper_content, newspaper_view, newspaper_category_id) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $sql->bind_param('ssissii', $newspaperTitle, $newspaperImgae, $newspaperAuthorId, $newspaperDate,$newspaperContent, $newspaperView,$newspaperCategoryId);
        return $sql->execute();
    }
    // Xoa sp
    public function deleteNewspaper($newspaperId)
    {
        $sql = parent::$connection->prepare('DELETE FROM newspapers WHERE newspapers.`newspaper_id` = ?');
        $sql->bind_param('i', $newspaperId);
        return $sql->execute();
    }

    //Cập nhật sp
    public function updateNewspaper($newspaperTitle, $newspaperImage, $newspaperAuthorId, $newspaperDate,$newspaperContent, $newspaperView,$newspaperCategoryId,$newspaperId)
    {
        $sql = parent::$connection->prepare('UPDATE newspapers SET newspaper_title = ?, newspaper_imgae = ?, newspaper_author_id = ?, newspaper_date = ?,  newspaper_content = ?, newspaper_view = ?, newspaper_category_id = ? WHERE newspapers.`newspaper_id` = ?');
        $sql->bind_param('ssissiii', $newspaperTitle, $newspaperImage, $newspaperAuthorId, $newspaperDate,$newspaperContent, $newspaperView,$newspaperCategoryId,$newspaperId);
        return $sql->execute();
    }
    public function search($keyword)
    {
        $search = "%$keyword%";
        $sql = parent::$connection->prepare('SELECT * FROM newspapers WHERE newspaper_title like ?');
        $sql->bind_param('s', $search);
        return parent::select($sql);
    }
}
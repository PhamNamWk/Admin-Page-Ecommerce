<?php

namespace App\Models;

use App\Models\Model;
use PDOException;

class Product extends Model
{
    protected $tableName = 'product';
    public function paginate($page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit;

        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('pro.*,cate.name as "category",cate.status')
            ->from($this->tableName, 'pro')
            ->join('pro', 'category', 'cate', 'pro.category_id = cate.id')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->orderBy('pro.id', 'DESC');


        $data = $queryBuilder->fetchAllAssociative();
        $totalPage = ceil($this->count() / $limit); // Làm tròn lên

        return [
            'data'          => $data,
            'page'          => $page,
            'limit'         => $limit,
            'totalPage'     => $totalPage
        ];
    }
    public function search($keyWord, $page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit;
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('pro.*,cate.name as "category",cate.status')
            ->from($this->tableName, 'pro')
            ->join('pro', 'category', 'cate', 'pro.category_id = cate.id')
            ->where("pro.name LIKE :keyWord")
            ->setParameter('keyWord', "%$keyWord%")
            ->orderBy('pro.id', 'DESC')

            ->setFirstResult($offset)
            ->setMaxResults($limit);



        $data = $queryBuilder->fetchAllAssociative();
        $totalPage = ceil($this->count($keyWord) / $limit); // Làm tròn lên

        return [
            'data'          => $data,
            'page'          => $page,
            'limit'         => $limit,
            'totalPage'     => $totalPage
        ];
    }
    public function count($keyWord = '')
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        if ($keyWord != '') {
            $queryBuilder->select('COUNT(*) as total')->from($this->tableName)->where('name LIKE :keyWord')->setParameter('keyWord', "%$keyWord%")->orderBy('id', 'DESC');
        } else {
            $queryBuilder->select('COUNT(*) as total')->from($this->tableName);
        }


        return $queryBuilder->fetchOne();
    }
    public function getCategory()
    {
        try {
            $queryBuilder = $this->connection->createQueryBuilder();
            $queryBuilder->select('id,name')->from('category');
            return $queryBuilder->fetchAllAssociative();
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    public function find($id)
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('pro.*,cate.name as "category",cate.status')
            ->from($this->tableName, 'pro')
            ->join('pro', 'category', 'cate', 'pro.category_id = cate.id')
            ->where('pro.id = :id')
            ->setParameter('id', $id);
        return $queryBuilder->fetchAssociative();
    }
    public function findByIdCategory($id)
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('pro.*,cate.name as "category",cate.status')
            ->from($this->tableName, 'pro')
            ->join('pro', 'category', 'cate', 'pro.category_id = cate.id')
            ->where('pro.category_id = :id')
            ->setParameter('id', $id);
        return $queryBuilder->fetchAllAssociative();
    }
}

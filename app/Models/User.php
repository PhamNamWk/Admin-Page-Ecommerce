<?php

namespace App\Models;

class User extends Model
{
    protected $tableName = 'user';
    public function paginate($page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit;

        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('*')
            ->from($this->tableName)
            ->where("role = 'client'")
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->orderBy('id', 'DESC');

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
        $queryBuilder->select('*')
            ->from($this->tableName)
            ->where("username LIKE :keyWord AND role = 'client'")
            ->setParameter('keyWord', "%$keyWord%")
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->orderBy('id', 'DESC');



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
            $queryBuilder->select('COUNT(*) as total')->from($this->tableName)->where('username LIKE :keyWord')->setParameter('keyWord', "%$keyWord%");
        } else {
            $queryBuilder->select('COUNT(*) as total')->from($this->tableName);
        }


        return $queryBuilder->fetchOne();
    }
}
